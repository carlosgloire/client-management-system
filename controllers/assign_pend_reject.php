<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $request_id = $_POST['request_id'];
    $project_status = $_POST['project_status'];
    $project_id = $_POST['project_id'];

    // Update the project status
    $stmt = $db->prepare("UPDATE projects SET project_status = :project_status WHERE request_id = :request_id");
    $stmt->execute(['project_status' => $project_status, 'request_id' => $request_id]);

    // If the status is "Rejected", delete all entries in the assignment table for that project
    if ($project_status === 'Rejected') {
        $stmt_delete = $db->prepare("DELETE FROM assignment WHERE project_id = :project_id");
        $stmt_delete->execute(['project_id' => $project_id]);
        echo '<script>alert("Project status updated to '.$project_status.' and employees assigned to this project are nolonger assigned to it");</script>';
        echo '<script>window.location.href="../pages/detail-request.php?request_id=' . $request_id . '";</script>';
        exit;
    }

    if ($stmt->rowCount()) {
        echo '<script>alert("Project status updated to ' . htmlspecialchars($project_status) . '");</script>';
        echo '<script>window.location.href="../pages/detail-request.php?request_id=' . $request_id . '";</script>';
        exit;
    } else {
        echo '<script>alert("Failed to update the project status.");</script>';
        echo '<script>window.location.href="../pages/detail-request.php?request_id=' . $request_id . '";</script>';
        exit;
    }
}
