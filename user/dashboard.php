<?php
include 'header_user.php'; // Include the header
?>

<!-- Include Font Awesome for Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<!-- Include Animate.css for Animations -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

<!-- Dashboard Content -->
<div class="container mt-5">
    <h1 class="text-center animate__animated animate__fadeInDown"><b>Welcome to Your Dashboard</b></h1>
    <p class="text-center text-muted animate__animated animate__fadeIn" data-wow-delay="0.4s">Manage your billboard bookings and profile easily.</p>

    <div class="row mt-4">
        <!-- View Billboards Card -->
        <div class="col-md-4 animate__animated animate__zoomIn" data-wow-delay="0.6s">
            <div class="card shadow-lg border-0 h-100">
                <div class="card-body text-center">
                    <i class="fas fa-eye fa-3x text-primary mb-3 animate__animated animate__pulse animate__infinite"></i>
                    <h5 class="card-title"><b>View Billboards</b></h5>
                    <p class="card-text">Explore available billboards for advertising.</p>
                    <a href="view_billboards.php" class="btn btn-primary">View Billboards</a>
                </div>
            </div>
        </div>
        
        <!-- My Bookings Card -->
        <div class="col-md-4 animate__animated animate__zoomIn" data-wow-delay="0.8s">
            <div class="card shadow-lg border-0 h-100">
                <div class="card-body text-center">
                    <i class="fas fa-bookmark fa-3x text-success mb-3 animate__animated animate__pulse animate__infinite"></i>
                    <h5 class="card-title"><b>My Bookings</b></h5>
                    <p class="card-text">Manage your booked billboards.</p>
                    <a href="my_bookings.php" class="btn btn-success">My Bookings</a>
                </div>
            </div>
        </div>
        
        <!-- Profile Card -->
        <div class="col-md-4 animate__animated animate__zoomIn" data-wow-delay="1s">
            <div class="card shadow-lg border-0 h-100">
                <div class="card-body text-center">
                    <i class="fas fa-user fa-3x text-danger mb-3 animate__animated animate__pulse animate__infinite"></i>
                    <h5 class="card-title"><b>Profile</b></h5>
                    <p class="card-text">Update your profile information.</p>
                    <a href="profile.php" class="btn btn-danger">Profile</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include '../includes/footer.php'; // Include the footer
?>