<?php
// Include database connection
include('../database/db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $request_id = $_POST['request_id'];
    $selected_goals = $_POST['goals'] ?? []; // Array of selected goal IDs

    // Step 0: Verify if the request is assigned to employees
    $sql_check_employees_assigned = "SELECT COUNT(*) FROM assignment WHERE project_id = :request_id";
    $stmt_check_employees_assigned = $db->prepare($sql_check_employees_assigned);
    $stmt_check_employees_assigned->execute([':request_id' => $request_id]);
    $employees_assigned = $stmt_check_employees_assigned->fetchColumn();

    if ($employees_assigned == 0) {
        // No employees are assigned to the project, alert the user
        echo '<script>alert("Before updating the goals of this project, assign it to employees first."); window.history.back();</script>';
        exit;
    }

    $completed_goals = [];
    $already_completed_goals = [];

    if (!empty($selected_goals)) {
        foreach ($selected_goals as $goal_id) {
            // Check if the goal is already completed
            $sql_check_completed = "SELECT COUNT(*) FROM progress WHERE goals_id = :goals_id AND status = 'completed'";
            $stmt_check_completed = $db->prepare($sql_check_completed);
            $stmt_check_completed->execute([':goals_id' => $goal_id]);
            $is_completed = $stmt_check_completed->fetchColumn();

            if ($is_completed) {
                // If goal is already completed, add to already_completed_goals
                $sql_get_goal_name = "SELECT goal_name FROM goals WHERE goals_id = :goals_id";
                $stmt_get_goal_name = $db->prepare($sql_get_goal_name);
                $stmt_get_goal_name->execute([':goals_id' => $goal_id]);
                $goal_name = $stmt_get_goal_name->fetchColumn();
                if ($goal_name) {
                    $already_completed_goals[] = htmlspecialchars($goal_name);
                }
            } else {
                // Insert the goal as completed in the progress table
                $sql_insert_progress = "INSERT INTO progress (goals_id, status) VALUES (:goals_id, 'completed')";
                $stmt_insert_progress = $db->prepare($sql_insert_progress);
                if (!$stmt_insert_progress->execute([':goals_id' => $goal_id])) {
                    // Log failure or alert as needed
                } else {
                    $sql_get_goal_name = "SELECT goal_name FROM goals WHERE goals_id = :goals_id";
                    $stmt_get_goal_name = $db->prepare($sql_get_goal_name);
                    $stmt_get_goal_name->execute([':goals_id' => $goal_id]);
                    $goal_name = $stmt_get_goal_name->fetchColumn();
                    if ($goal_name) {
                        $completed_goals[] = htmlspecialchars($goal_name);
                    }
                }
            }
        }

        // Step 2: Check if all goals are completed for the project
        $sql_goal_count = "
            SELECT sg.goals_number 
            FROM goal sg
            JOIN requests r ON sg.request_id = r.request_id
            WHERE r.request_id = :request_id
        ";
        $stmt_goal_count = $db->prepare($sql_goal_count);
        $stmt_goal_count->execute([':request_id' => $request_id]);
        $total_goals = $stmt_goal_count->fetchColumn();


        $query = "
         SELECT COUNT(p.goals_id) as goal_count
        FROM progress p
        JOIN goals g ON p.goals_id = g.goals_id
        JOIN goal go ON g.goal_id = go.goal_id
        JOIN requests r ON go.request_id = r.request_id
        WHERE r.request_id = :request_id AND p.status = 'completed'
        ";
        
        $stmt = $db->prepare($query);
        $stmt->bindParam(':request_id', $request_id, PDO::PARAM_INT);
        $stmt->execute();
        
         $completed_goals_count = $stmt->fetchColumn();

        if ($completed_goals_count == $total_goals) {
            // Step 2.1: Insert into completed_project table
            $sql_insert_completed_project = "INSERT INTO completed_project (request_id, completed_date) 
                                             VALUES (:request_id, NOW())";
            $stmt_insert_completed_project = $db->prepare($sql_insert_completed_project);
            if (!$stmt_insert_completed_project->execute([':request_id' => $request_id])) {
                echo "<script>alert('Failed to insert into completed_project table.');</script>";
                exit;
            }

            // Get the last inserted completed_id
            $completed_id = $db->lastInsertId();

            // Step 3: Transfer employees to completed_project_team table
            $sql_select_employees = "SELECT employee_id FROM assignment WHERE project_id = :request_id";
            $stmt_select_employees = $db->prepare($sql_select_employees);
            $stmt_select_employees->execute([':request_id' => $request_id]);

            $employees = $stmt_select_employees->fetchAll(PDO::FETCH_ASSOC);

            if (!empty($employees)) {
                foreach ($employees as $employee) {
                    $sql_insert_team = "INSERT INTO completed_project_team (employee_id, completed_id) 
                                        VALUES (:employee_id, :completed_id)";
                    $stmt_insert_team = $db->prepare($sql_insert_team);
                    if (!$stmt_insert_team->execute([
                        ':employee_id' => $employee['employee_id'],
                        ':completed_id' => $completed_id
                    ])) {
                        echo "<script>alert('Failed to insert employee ID {$employee['employee_id']} into completed_project_team table.');</script>";
                        exit;
                    }
                }

                // Step 3.1: Delete employees from assignment table
                $sql_delete_assignment = "DELETE FROM assignment WHERE project_id = :request_id";
                $stmt_delete_assignment = $db->prepare($sql_delete_assignment);
                if (!$stmt_delete_assignment->execute([':request_id' => $request_id])) {
                    echo "<script>alert('Failed to delete employees from assignment table.');</script>";
                    exit;
                }
            }

            // Step 4: Update project status to 'completed'
            $sql_update_project_status = "UPDATE projects SET project_status = 'completed' WHERE request_id = :request_id";
            $stmt_update_project_status = $db->prepare($sql_update_project_status);
            if (!$stmt_update_project_status->execute([':request_id' => $request_id])) {
                echo "<script>alert('Failed to update project status to completed.');</script>";
                exit;
            }
           
        }
    }

    // Prepare the alert messages
    if (!empty($already_completed_goals)) {
        echo '<script>alert("The following goals were already completed: ' . implode(', ', $already_completed_goals) . '");</script>';
    }

    if (!empty($completed_goals)) {
        echo '<script>alert("The following goals have been marked as completed: ' . implode(', ', $completed_goals) . '");</script>';
    }

    // Redirect to the project detail page
    echo '<script>window.location.href="../admin/pages/detail-project.php?request_id=' . $request_id . '";</script>';
    exit;
}
?>
