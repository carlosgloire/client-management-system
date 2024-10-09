<?php
require '../database/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $employee_id = $_POST['employee_id'];
    $start_date = $_POST['start'];
    $end_date = $_POST['end'];

    // Update the day off record
    $update_query = "UPDATE off_employees SET start_date = :start_date, end_date = :end_date WHERE employee_id = :employee_id";
    $update_stmt = $db->prepare($update_query);
    $update_stmt->execute([
        'start_date' => $start_date,
        'end_date' => $end_date,
        'employee_id' => $employee_id
    ]);
    // Redirect or display success message
    header("Location: ../admin/pages/detail-employee.php?employee_id=" . $employee_id);
    exit();
}
?>
