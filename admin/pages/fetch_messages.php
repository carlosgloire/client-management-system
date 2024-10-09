<?php
require_once('../../database/db.php');

// Fetch messages from the database
$request_id = $_GET['request_id'];
$messages = $db->prepare("SELECT * FROM messages WHERE request_id = :request_id ORDER BY timestamp ASC");
$messages->execute([':request_id' => $request_id]);
$messages = $messages->fetchAll(PDO::FETCH_ASSOC);

// Return messages as JSON
header('Content-Type: application/json');
echo json_encode($messages);
?>
