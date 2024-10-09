<?php
// Include the database connection
include 'database/db.php';

// Simulate user roles (in a real application, this would come from session data)
$role = 'CLIENT'; // or 'ADMIN'
$client_id = 3;   // Example client ID

// Fetch client details (used for both client and admin views)
$clientQuery = $db->prepare("SELECT username, profile FROM clients WHERE client_id = :client_id");
$clientQuery->execute(['client_id' => $client_id]);
$client = $clientQuery->fetch(PDO::FETCH_ASSOC);

// Fetch messages between the client and admin
$query = $db->prepare("SELECT * FROM messages WHERE client_id = :client_id ORDER BY timestamp ASC");
$query->execute(['client_id' => $client_id]);
$messages = $query->fetchAll(PDO::FETCH_ASSOC);

// Handle message submission (for both client and admin)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $message_text = $_POST['message_text'];
    $sender = $role;
    $file_name = '';

    // Handle file upload
    if (isset($_FILES['file']) && $_FILES['file']['error'] === 0) {
        $file_name = basename($_FILES['file']['name']);
        move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/' . $file_name);
    }

    // Insert the message into the database
    $query = $db->prepare("INSERT INTO messages (client_id, sender, message_text, file_name) VALUES (:client_id, :sender, :message_text, :file_name)");
    $query->execute([
        'client_id' => $client_id,
        'sender' => $sender,
        'message_text' => $message_text,
        'file_name' => $file_name
    ]);

    // Redirect to prevent form resubmission
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Interface</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f8f9fa; }
        .chat-container { max-width: 600px; margin: 50px auto; background-color: #ffffff; border-radius: 10px; padding: 20px; }
        .message { padding: 10px 15px; border-radius: 10px; margin-bottom: 10px; position: relative; }
        .message.client { background-color: #e6f2ff; }
        .message.admin { background-color: #e6ffe6; }
        .message p { margin: 0; }
        .message .file-link { color: #e6005c; display: block; margin-top: 5px; }
        .message .timestamp { font-size: 12px; color: #999; position: absolute; top: 10px; right: 15px; }
        .message .sender { font-weight: bold; display: block; margin-bottom: 5px; }
        .client-image { width: 40px; height: 40px; border-radius: 50%; float: left; margin-right: 10px; }
        form { margin-top: 20px; }
        textarea { width: 100%; height: 100px; padding: 10px; margin-bottom: 10px; border-radius: 5px; border: 1px solid #ccc; }
        button { padding: 10px 15px; border: none; border-radius: 5px; background-color: #007bff; color: white; cursor: pointer; }
        button:hover { background-color: #0056b3; }
    </style>
</head>
<body>
    <div class="chat-container">
        <h2><?= ($role === 'CLIENT') ? 'Your Chat with Admin' : 'Chat with Client: ' . htmlspecialchars($client['username']) ?></h2>

        <?php foreach ($messages as $message): ?>
            <div class="message <?= strtolower($message['sender']) ?>">
                <?php if ($message['sender'] === 'CLIENT'): ?>
                    <img src="admin/assets/img/client_profile/<?= htmlspecialchars($client['profile']) ?>" class="client-image" alt="Client Image">
                    <span class="sender"><?= htmlspecialchars($client['username']) ?></span>
                <?php else: ?>
                    <span class="sender">ADMIN</span>
                <?php endif; ?>

                <p><?= nl2br(htmlspecialchars($message['message_text'])) ?></p>

                <?php if (!empty($message['file_name'])): ?>
                    <a href="uploads/<?= htmlspecialchars($message['file_name']) ?>" class="file-link"><?= htmlspecialchars($message['file_name']) ?></a>
                <?php endif; ?>

                <span class="timestamp"><?= date('h:i A', strtotime($message['timestamp'])) ?></span>
            </div>
        <?php endforeach; ?>

        <!-- Message Form (both client and admin can send messages) -->
        <h3><?= ($role === 'CLIENT') ? 'Reply to Admin' : 'Reply to Client' ?></h3>
        <form method="POST" enctype="multipart/form-data">
            <textarea name="message_text" placeholder="<?= ($role === 'CLIENT') ? 'Enter your message to the admin...' : 'Enter your reply to the client...' ?>" required></textarea><br>
            <input type="file" name="file"><br>
            <button type="submit">Send Message</button>
        </form>
    </div>
</body>
</html>
