<?php
require_once('../database/db.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $team_id = $_POST['team_id'];
    $status = $_POST['status'];
    $employee_id =$_POST['employee_id'];
    $updateQuery = "UPDATE completed_project_team SET status = :status WHERE team_id = :team_id";
    $updateStmt = $db->prepare($updateQuery);
    $updateStmt->execute(['status' => $status, 'team_id' => $team_id]);

    // Redirect to avoid form resubmission
    header("Location: ../admin/pages/detail-employee.php?employee_id=" . $employee_id);
    exit();
}