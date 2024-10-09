<?php
// Include the database connection
require_once('database/db.php');

// Fetch employee details (assume the employee is logged in)
$employee_id = 10; // Example employee ID (replace with the actual employee ID)
$employeeQuery = $db->prepare("SELECT username, profile FROM employees WHERE employee_id = :employee_id");
$employeeQuery->execute(['employee_id' => $employee_id]);
$employee = $employeeQuery->fetch(PDO::FETCH_ASSOC);

// Assume request_id is passed in the URL
$request_id = 1;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $message = $_POST['message'];
    $sender = $employee['username']; // Employee name as sender
    $employee_profile = $employee['profile']; // Employee profile (image or other data)

    $file_name = '';

    // Handle file upload
    if (isset($_FILES['file']) && $_FILES['file']['error'] === 0) {
        $file_name = basename($_FILES['file']['name']);
        move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/' . $file_name);
    }


    $query = $db->prepare("INSERT INTO messages_with_employees (request_id, sender, message_text, file_name, employee_profile) VALUES (:request_id, :sender, :message_text, :file_name, :employee_profile)");
    $query->execute([
        'request_id' => $request_id,
        'sender' => $sender,
        'message_text' => $message,
        'file_name' => $file_name,
        'employee_profile' => $employee_profile
    ]);

    // Redirect or display a success messa
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Reply Interface</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>Reply to Message</h2>
    <form action="" method="post" enctype="multipart/form-data">
    
        <!-- Message Textarea -->
        <div class="mb-3">
            <label for="message" class="form-label">Message</label>
            <textarea class="form-control" id="message" name="message" rows="4" placeholder="Enter your message" required></textarea>
        </div>

        <!-- File Attachment -->
        <div class="mb-3">
            <label for="file" class="form-label">Attach Files (Optional)</label>
            <input class="form-control" type="file" id="file" name="file" multiple>
        </div>

        <!-- Submit Button -->
        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">Send</button>
        </div>
    </form>
</div>
</body>
</html>
