<?php
// Include database connection
include('../database/db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $project_id = $_POST['project_id'];
    $request_id = $_POST['request_id'];
    $employee_ids = $_POST['employee_ids'] ?? [];

    // Check the project status based on request_id
    $stmt = $db->prepare("SELECT project_status FROM projects WHERE request_id = ?");
    $stmt->execute([$request_id]);
    $project_status = $stmt->fetchColumn(); // Fetch the project status

    if (is_null($project_status) || $project_status == '') {
        // If the project status is null or empty, alert the user and redirect
        echo '<script>alert("This project is not assigned to employees. To assign employees, first click on the ASSIGN button.");</script>';
        echo '<script>window.location.href="../admin/pages/detail-project.php?request_id=' . $request_id . '";</script>';
        exit;
    } elseif ($project_status == 'Pending') {
        echo '<script>alert("This project is in PENDING mode. You cannot assign it to employees. Click on the ASSIGN button if you want to assign it to employees.");</script>';
        echo '<script>window.location.href="../admin/pages/detail-project.php?request_id=' . $request_id . '";</script>';
        exit;
    } elseif ($project_status == 'Rejected') {
        echo '<script>alert("This project is REJECTED. You cannot assign it to employees. Click on the ASSIGN button if you want to assign it to employees.");</script>';
        echo '<script>window.location.href="../admin/pages/detail-project.php?request_id=' . $request_id . '";</script>';
        exit;
    } else {
        if (!empty($project_id) && !empty($employee_ids)) {
            $stmt_insert = $db->prepare("INSERT INTO assignment (project_id, employee_id, date) VALUES (?, ?, NOW())");
            $stmt_check = $db->prepare("SELECT COUNT(*) FROM assignment WHERE project_id = ? AND employee_id = ?");
            $stmt_username = $db->prepare("SELECT username FROM employees WHERE employee_id = ?");
            $assigned_usernames = [];
            $already_assigned_usernames = [];
            foreach ($employee_ids as $employee_id) {
                // Get the username corresponding to the employee_id
                $stmt_username->execute([$employee_id]);
                $username = $stmt_username->fetchColumn();
                if ($username) {
                    // Check if the employee is already assigned to the project
                    $stmt_check->execute([$project_id, $employee_id]);
                    $count = $stmt_check->fetchColumn();

                    if ($count > 0) {
                        $already_assigned_usernames[] = htmlspecialchars($username);
                    } else {
                        // Insert the assignment with employee_id
                        $stmt_insert->execute([$project_id, $employee_id]);
                        $assigned_usernames[] = htmlspecialchars($username);
                    }
                }
            }

            // Prepare the alert message
            if (!empty($already_assigned_usernames)) {
                echo '<script>alert("The following employees are already assigned to this project: ' . implode(', ', $already_assigned_usernames) . '");</script>';
                echo '<script>window.location.href="../admin/pages/detail-project.php?request_id=' . $request_id . '";</script>';
                exit;
            }

            if (!empty($assigned_usernames)) {
                echo '<script>alert("The following employees were successfully assigned to the project: ' . implode(', ', $assigned_usernames) . '");</script>';
                echo '<script>window.location.href="../admin/pages/detail-project.php?request_id=' . $request_id . '";</script>';
                exit;
            }

        } else {
            echo '<script>alert("Please select a project and at least one employee.");</script>';
            echo '<script>window.location.href="../admin/pages/detail-project.php?request_id=' . $request_id . '";</script>';
            exit;
        }
    }
}
?>
