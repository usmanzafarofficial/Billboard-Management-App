<?php
session_start(); // Start the session
include 'db.php'; // Include database connection

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    die("Unauthorized access.");
}

// Get the logged-in user's ID
$user_id = $_SESSION['user_id'];

// Get the selected receiver ID from the query parameter
$receiver_id = isset($_GET['receiver_id']) ? intval($_GET['receiver_id']) : 0;

if ($receiver_id <= 0) {
    die("Invalid receiver ID.");
}

// Fetch messages between the logged-in user and the selected recipient
$stmt = $pdo->prepare("
    SELECT messages.*, users.name AS sender_name
    FROM messages
    JOIN users ON messages.sender_id = users.id
    WHERE (messages.sender_id = ? AND messages.receiver_id = ?) OR (messages.sender_id = ? AND messages.receiver_id = ?)
    ORDER BY messages.created_at ASC
");
$stmt->execute([$user_id, $receiver_id, $receiver_id, $user_id]);
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Mark messages as read when fetched by the recipient
$pdo->prepare("UPDATE messages SET is_read = 1 WHERE receiver_id = ? AND sender_id = ?")
    ->execute([$user_id, $receiver_id]);

// Display messages in a WhatsApp-like format
if (empty($messages)) {
    echo "<p>No messages found. Start the conversation!</p>";
} else {
    foreach ($messages as $message) {
        // Determine if the message is from the logged-in user or the recipient
        $message_class = ($message['sender_id'] == $user_id) ? 'sender' : 'receiver';
        $sender_name = ($message['sender_id'] == $user_id) ? 'You' : $message['sender_name'];

        echo '
        <div class="message ' . $message_class . '">
            <strong>' . $sender_name . '</strong>
            <small class="text-muted">' . $message['created_at'] . '</small>
            <p>' . $message['message'] . '</p>
        </div>';
    }
}
?>