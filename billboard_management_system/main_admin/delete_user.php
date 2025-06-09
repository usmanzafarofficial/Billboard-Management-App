<?php
session_start();
include '../includes/db.php'; // Include database connection

// Redirect if not admin
if (!isset($_SESSION['user_id']) || $_SESSION['user_type_id'] != 3) {
    header("Location: admin_login.php");
    exit();
}

if (isset($_GET['id'])) {
    $user_id = intval($_GET['id']);
    $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
    $stmt->execute([$user_id]);
    $_SESSION['success_message'] = "User deleted successfully!";
}
header("Location: admin_dashboard.php");
exit();
?>