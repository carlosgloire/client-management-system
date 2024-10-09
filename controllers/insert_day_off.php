<?php
require_once('../database/db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $employee_id = $_POST['employee_id'];
    $start_date = $_POST['start'];
    $end_date = $_POST['end'];

    // Insert a new day off record
    $insert_query = "INSERT INTO off_employees (employee_id, start_date, end_date) VALUES (:employee_id, :start_date, :end_date)";
    $insert_stmt = $db->prepare($insert_query);
    $insert_stmt->execute([
        'employee_id' => $employee_id,
        'start_date' => $start_date,
        'end_date' => $end_date
    ]);

    header("Location: ../admin/pages/detail-employee.php?employee_id=" . $employee_id);
    exit();
}
?>
