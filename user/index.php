<?php
session_start(); // Start the session

// Redirect to login if the user is not logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
    exit;
}

include '../includes/header_user.php'; // Include user header
?>

<!-- Dashboard Content -->
<div class="container mt-5">
    <h1 class="text-center">Welcome to Your Dashboard</h1>

    <div class="row mt-5">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Your Profile</h5>
                    <p class="card-text">View and update your profile information.</p>
                    <a href="profile.php" class="btn btn-primary">Go to Profile</a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Your Billboards</h5>
                    <p class="card-text">Manage your billboards and bookings.</p>
                    <a href="view_billboards.php" class="btn btn-primary">View Billboards</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include '../includes/footer.php'; // Include footer
?>