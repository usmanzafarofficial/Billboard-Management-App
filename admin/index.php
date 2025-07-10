<?php
include 'header_admin.php'; // Include the header
?>

<!-- Include Font Awesome for Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<!-- Include Animate.css for Animations -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

<!-- Dashboard Content -->
<div class="container mt-5">
    <h1 class="text-center animate__animated animate__fadeInDown">Welcome to Your Dashboard</h1>
    <div class="row mt-4">
        <!-- Manage Billboards Card -->
        <div class="col-md-4 animate__animated animate__fadeInLeft">
            <div class="card h-100">
                <div class="card-body text-center">
                    <i class="fas fa-ad fa-3x mb-3 text-primary"></i>
                    <h5 class="card-title">Manage Billboards</h5>
                    <p class="card-text">Add, edit, or delete billboards.</p>
                    <a href="manage_billboards.php" class="btn btn-primary">
                        <i class="fas fa-cogs"></i> Manage Billboards
                    </a>
                </div>
            </div>
        </div>

        <!-- Manage Bookings Card -->
        <div class="col-md-4 animate__animated animate__fadeInUp">
            <div class="card h-100">
                <div class="card-body text-center">
                    <i class="fas fa-calendar-check fa-3x mb-3 text-success"></i>
                    <h5 class="card-title">Manage Bookings</h5>
                    <p class="card-text">Approve or reject booking requests.</p>
                    <a href="manage_bookings.php" class="btn btn-success">
                        <i class="fas fa-tasks"></i> Manage Bookings
                    </a>
                </div>
            </div>
        </div>

        <!-- Messages Card -->
        <div class="col-md-4 animate__animated animate__fadeInRight">
            <div class="card h-100">
                <div class="card-body text-center">
                    <i class="fas fa-envelope fa-3x mb-3 text-warning"></i>
                    <h5 class="card-title">Messages</h5>
                    <p class="card-text">View and respond to user messages.</p>
                    <a href="messages.php" class="btn btn-warning">
                        <i class="fas fa-comments"></i> View Messages
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include '../includes/footer.php'; // Include the footer
?>