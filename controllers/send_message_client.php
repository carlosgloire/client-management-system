<?php
require_once('../database/db.php');
$role = 'ADMIN';
if ($_SERVER['REQUEST_METHOD'] === 'POST' AND isset($_POST['send_message'])) {
    $client_id = $_POST['client_id'];
    $request_id = $_POST['request_id'];
    $messages =htmlspecialchars($_POST['message_text']);
    $message_text = $_POST['message_text'];
    $sender = $role;
    $file_name = '';

    // Handle file upload
    if (isset($_FILES['file']) && $_FILES['file']['error'] === 0) {
        $file_name = str_replace([' ', "'"], '_', $_FILES["file"]["name"]);
        $file_name = basename($_FILES['file']['name']);
        move_uploaded_file($_FILES['file']['tmp_name'], '../admin/assets/client_chats_attachments/' . $file_name);
    }
 
    $query = $db->prepare("INSERT INTO messages (client_id, sender, message_text, file_name) VALUES (:client_id, :sender, :message_text, :file_name)");
    $query->execute([
        'client_id' => $client_id,
        'sender' => $sender,
        'message_text' => $message_text,
        'file_name' => $file_name
    ]);

    echo '<script>window.location.href="../admin/pages/detail-project.php?request_id=' . $request_id . '";</script>';
    exit;
}