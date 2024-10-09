<?php
require_once('../database/db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['goals']) && is_array($_POST['goals'])) {
        $goals_ids = $_POST['goals']; // Array of goal IDs to be deleted

        if (!empty($goals_ids)) {
            // Prepare the SQL delete query with placeholders
            $placeholders = implode(',', array_fill(0, count($goals_ids), '?'));
            $stmt = $db->prepare("DELETE FROM goals WHERE goals_id IN ($placeholders)");

            // Execute the delete query
            if ($stmt->execute($goals_ids)) {
                echo '<script>alert("Goals successfully deleted!");</script>';
                echo '<script>window.location.href="../admin/pages/detail-project.php?request_id=' . $_POST['request_id'] . '";</script>';
            } else {
                echo '<script>alert("Error deleting goals. Please try again.");</script>';
                echo '<script>window.location.href="../admin/pages/detail-project.php?request_id=' . $_POST['request_id'] . '";</script>';
            }
        } else {
            echo '<script>alert("No goals selected for deletion.");</script>';
            echo '<script>window.location.href="../admin/pages/detail-project.php?request_id=' . $_POST['request_id'] . '";</script>';
        }
    } else {
        echo '<script>alert("No goals selected for deletion.");</script>';
        echo '<script>window.location.href="../admin/pages/detail-project.php?request_id=' . $_POST['request_id'] . '";</script>';
    }
}
?>
