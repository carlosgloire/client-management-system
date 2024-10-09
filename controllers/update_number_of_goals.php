<?php
require_once('../database/db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $request_id = $_POST['request_id'];
    $goals_number = htmlspecialchars($_POST['goals_number']);

    // Validate the number of goals
    if (empty($goals_number)) {
        echo '<script>alert("Please enter the number of goals");</script>';
        echo '<script>window.location.href="../admin/pages/detail-project.php?request_id=' . htmlspecialchars($request_id) . '";</script>';
        exit;
    }

    // Prepare and execute the update query
    $stmt = $db->prepare("UPDATE goal SET goals_number = :goals_number WHERE request_id = :request_id");
    $stmt->bindParam(':request_id', $request_id, PDO::PARAM_INT);
    $stmt->bindParam(':goals_number', $goals_number, PDO::PARAM_INT);

    if ($stmt->execute()) {
        echo '<script>alert("Goal successfully updated!");</script>';
        echo '<script>window.location.href="../admin/pages/detail-project.php?request_id=' . htmlspecialchars($request_id) . '";</script>';
    } else {
        echo '<script>alert("Error updating goal. Please try again.");</script>';
        echo '<script>window.location.href="../admin/pages/detail-project.php?request_id=' . htmlspecialchars($request_id) . '";</script>';
    }
}
