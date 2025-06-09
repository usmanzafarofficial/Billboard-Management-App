<?php
session_start(); // Start the session
include 'db.php'; // Include database connection

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    die("Unauthorized access.");
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sender_id = $_SESSION['user_id']; // Sender ID
    $receiver_id = intval($_POST['receiver_id']); // Receiver ID
    $message = htmlspecialchars($_POST['message']); // Message content

    // Validate inputs
    if (empty($message)) {
        die("Message cannot be empty.");
    }

    // Insert message into the database
    $stmt = $pdo->prepare("INSERT INTO messages (sender_id, receiver_id, message) VALUES (?, ?, ?)");
    $stmt->execute([$sender_id, $receiver_id, $message]);

    // Clear notifications for the recipient
    $pdo->prepare("UPDATE messages SET is_read = 1 WHERE receiver_id = ? AND sender_id = ?")
        ->execute([$receiver_id, $sender_id]);

    echo "Message sent successfully!";
}
?>