<?php

require_once('../database/db.php'); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $request_id = $_POST['request_id'];
    $goal_name = isset($_POST['goal']) ? trim($_POST['goal']) : '';

    // Validate the goal description
    if (empty($goal_name)) {
        echo '<script>alert("Please enter a goal description.");</script>';
        echo '<script>window.location.href="../admin/pages/detail-project.php?request_id=' . $request_id . '";</script>';
        exit;
    }

    // Select the goal_id and goals_number from the goal table where request_id matches
    $stmt = $db->prepare("SELECT goal_id, goals_number FROM goal WHERE request_id = :request_id");
    $stmt->bindParam(':request_id', $request_id);
    $stmt->execute();
    $goal = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($goal) {
        $goal_id = $goal['goal_id'];
        $goals_number = $goal['goals_number'];

        // Count the number of goals already added for this goal_id
        $stmt = $db->prepare("SELECT COUNT(*) AS goal_count FROM goals WHERE goal_id = :goal_id");
        $stmt->bindParam(':goal_id', $goal_id);
        $stmt->execute();
        $goal_count = $stmt->fetch(PDO::FETCH_ASSOC)['goal_count'];

        if ($goal_count >= $goals_number) {
            echo '<script>alert("The number of goals you set is already reached.");</script>';
            echo '<script>window.location.href="../admin/pages/detail-project.php?request_id=' . $request_id . '";</script>';
            exit;
        }

        // Check if the goal description already exists in the goals table
        $stmt = $db->prepare("SELECT goal_name FROM goals WHERE goal_id = :goal_id AND goal_name = :goal_name");
        $stmt->bindParam(':goal_id', $goal_id);
        $stmt->bindParam(':goal_name', $goal_name);
        $stmt->execute();
        $existing_goal = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($existing_goal) {
            echo '<script>alert("The goal you entered is already added to this request.");</script>';
            echo '<script>window.location.href="../admin/pages/detail-project.php?request_id=' . $request_id . '";</script>';
        } else {
            // Insert the goal description into the goals table
            $stmt = $db->prepare("INSERT INTO goals (goal_id, goal_name) VALUES (:goal_id, :goal_name)");
            $stmt->bindParam(':goal_id', $goal_id);
            $stmt->bindParam(':goal_name', $goal_name);

            if ($stmt->execute()) {
                echo '<script>alert("Goal description successfully saved!");</script>';
                echo '<script>window.location.href="../admin/pages/detail-project.php?request_id=' . $request_id . '";</script>';
            } else {
                echo '<script>alert("Error saving goal description. Please try again.");</script>';
                echo '<script>window.location.href="../admin/pages/detail-project.php?request_id=' . $request_id . '";</script>';
            }
        }
    } else {
        echo '<script>alert("You did not set the number of goals for this project.");</script>';
        echo '<script>window.location.href="../admin/pages/detail-project.php?request_id=' . $request_id . '";</script>';
    }
}
?>
