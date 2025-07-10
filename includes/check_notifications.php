<?php
session_start(); // Start the session
include 'db.php'; // Include database connection

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    die("Unauthorized access.");
}

// Fetch the count of unread messages
$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("
    SELECT COUNT(*) AS unread_count
    FROM messages
    WHERE receiver_id = ? AND is_read = 0
");
$stmt->execute([$user_id]);
$result = $stmt->fetch(PDO::FETCH_ASSOC);

echo $result['unread_count']; // Return the count of unread messages
?>