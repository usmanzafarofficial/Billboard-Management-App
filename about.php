<?php
session_start(); // Start the session
include 'includes/db.php'; // Include database connection
include 'includes/header.php'; // Include header
?>

<!-- About Us Content -->
<div class="container mt-5 animate__animated animate__fadeIn">
    <div class="row">
        <div class="col-md-12 text-center">
            <h1 class="mb-4">About Us</h1>
            <p class="lead">Welcome to <strong>Digital Vision Board</strong>, your one-stop solution for billboard advertising.</p>
        </div>
    </div>

    <div class="row mt-5">
        <!-- Mission Section -->
        <div class="col-md-6 animate__animated animate__fadeInLeft">
            <div class="card h-100 shadow">
                <div class="card-body">
                    <h2 class="card-title"><i class="fas fa-bullseye"></i> Our Mission</h2>
                    <p class="card-text">
                        Our mission is to provide a seamless platform for billboard owners and advertisers to connect and collaborate.
                        We aim to simplify the process of booking billboards and ensure transparency in pricing and availability.
                    </p>
                </div>
            </div>
        </div>

        <!-- Vision Section -->
        <div class="col-md-6 animate__animated animate__fadeInRight">
            <div class="card h-100 shadow">
                <div class="card-body">
                    <h2 class="card-title"><i class="fas fa-eye"></i> Our Vision</h2>
                    <p class="card-text">
                        Our vision is to become the leading platform for billboard advertising, offering innovative solutions and
                        exceptional customer service to our users.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Team Section -->
    <div class="row mt-5">
        <div class="col-md-12 animate__animated animate__fadeInUp">
            <div class="card shadow">
                <div class="card-body">
                    <h2 class="card-title"><i class="fas fa-users"></i> Our Team</h2>
                    <p class="card-text">
                        We are a team of passionate individuals dedicated to making billboard advertising accessible and efficient
                        for everyone. Our team includes experienced developers, designers, and marketing professionals.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Why Choose Us Section -->
    <div class="row mt-5">
        <div class="col-md-12 animate__animated animate__fadeInUp">
            <div class="card shadow">
                <div class="card-body">
                    <h2 class="card-title"><i class="fas fa-star"></i> Why Choose Us?</h2>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><i class="fas fa-check-circle text-success"></i> Easy-to-use platform for billboard booking.</li>
                        <li class="list-group-item"><i class="fas fa-check-circle text-success"></i> Transparent pricing and availability.</li>
                        <li class="list-group-item"><i class="fas fa-check-circle text-success"></i> Dedicated support for advertisers and billboard owners.</li>
                        <li class="list-group-item"><i class="fas fa-check-circle text-success"></i> Innovative features like auto-recommendation and auto-pricing.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include 'includes/footer.php'; // Include footer
?>