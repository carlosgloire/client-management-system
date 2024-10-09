<?php

require_once('../database/db.php'); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $request_id = $_POST['request_id'];
    $goals_number = isset($_POST['goals_number']) ? trim($_POST['goals_number']) : '';

    // Validate the number of goals
    if (empty($goals_number)) {
        echo '<script>alert("Please enter the number of goals");</script>';
        echo '<script>window.location.href="../admin/pages/detail-project.php?request_id=' . $request_id . '";</script>';
        exit;
    }

    // Prepare and execute the insert query
    $stmt = $db->prepare("INSERT INTO goal (request_id, goals_number) VALUES (:request_id, :goals_number)");
    $stmt->bindParam(':request_id', $request_id);
    $stmt->bindParam(':goals_number', $goals_number);

    if ($stmt->execute()) {
        echo '<script>alert("Goal successfully set!");</script>';
        echo '<script>window.location.href="../admin/pages/detail-project.php?request_id=' . $request_id . '";</script>';
    } else {
        echo '<script>alert("Error setting goal. Please try again.");</script>';
        echo '<script>window.location.href="../admin/pages/detail-project.php?request_id=' . $request_id . '";</script>';
    }
}
?>
