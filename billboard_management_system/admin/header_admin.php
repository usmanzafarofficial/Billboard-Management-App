<?php
session_start(); // Start the session

// Redirect to login if the user is not logged in or is not an owner
if (!isset($_SESSION['user_id']) || $_SESSION['user_type_id'] != 1) {
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Owner Portal - Digital Vision Board</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../assets/css/style.css" rel="stylesheet">
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <i class="fas fa-ad"></i> Owner Portal
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="manage_billboards.php">Manage Billboards</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="manage_bookings.php">Manage Bookings</a>
                    </li>
                    <li class="nav-item">
    <a class="nav-link" href="messages.php">
        Messages
        
    </a>
</li>
<li class="nav-item">
    <a class="nav-link" href="analytics.php">Analytics</a>
</li>
                    <li class="nav-item">
                        <a class="nav-link" href="../logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Function to check for new notifications
    function checkNotifications() {
        $.ajax({
            url: '../includes/check_notifications.php', // Script to check notifications
            method: 'GET',
            success: function(response) {
                // Update the notification badge
                $('#notification-badge').text(response);
            }
        });
    }

    // Check for notifications every 5 seconds
    setInterval(checkNotifications, 5000);

    // Check notifications immediately when the page loads
    $(document).ready(function() {
        checkNotifications();
    });
</script>