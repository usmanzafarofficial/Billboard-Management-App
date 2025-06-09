<?php
session_start(); // Start the session

// Redirect to login if the user is not logged in or is not an advertiser
if (!isset($_SESSION['user_id']) || $_SESSION['user_type_id'] != 2) {
    header('Location: ../login.php');
    exit;
}

include '../includes/header_user.php'; // Include advertiser header
?>

<!-- Advertiser Dashboard Content -->
<div class="container mt-5">
    <h1 class="text-center">Advertiser Dashboard</h1>
    <p>Welcome, Advertiser!</p>
    <ul>
        <li><a href="view_billboards.php">View Billboards</a></li>
        <li><a href="book_billboard.php">Book Billboard</a></li>
        <li><a href="my_bookings.php">My Bookings</a></li>
    </ul>
</div>

<?php
include '../includes/footer.php'; // Include footer
?>