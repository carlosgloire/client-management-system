<?php
require_once('../database/db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $message = $_POST['message'];
    $project_id = $_POST['project_id']; 
    $request_id = $_POST['request_id'];
    $file_name = '';

    // Fetch all employees assigned to the project 
    $employeeQuery = $db->prepare("
        SELECT employee_id 
        FROM assignment 
        WHERE project_id = :project_id
    ");
    $employeeQuery->execute(['project_id' => $project_id]);
    $employees = $employeeQuery->fetchAll(PDO::FETCH_ASSOC);

    // Check if there are no employees assigned to the project
    if (empty($employees)) {
        echo '<script>alert("No employees already assigned to this project");</script>';
        echo '<script>window.location.href="../admin/pages/detail-project.php?request_id=' . $request_id . '";</script>';
        exit;
    }
    if (empty($message)) {
        echo '<script>alert("Plase write the message");</script>';
        echo '<script>window.location.href="../admin/pages/detail-project.php?request_id=' . $request_id . '";</script>';
        exit;
    }
    // Handle file upload
    if (isset($_FILES['file']) && $_FILES['file']['error'] === 0) {
        $filename = str_replace([' ', "'"], '_', $_FILES["uploadfile"]["name"]);
        $file_name = basename($_FILES['file']['name']);
        move_uploaded_file($_FILES['file']['tmp_name'], '../admin/assets/client_chats_attachments/' . $file_name);
    }
 

    $query = $db->prepare("
        INSERT INTO messages_with_employees (request_id,sender, message_text, file_name) 
        VALUES (:request_id, :sender, :message_text, :file_name)
    ");
    
    $query->execute([
        'request_id' =>$request_id,
        'sender' => 'ADMIN',
        'message_text' => $message,
        'file_name' => $file_name
    ]);

    echo '<script>window.location.href="../admin/pages/detail-project.php?request_id=' . $request_id . '";</script>';
    exit;
}
