<?php
// Start session
session_start();

// Include database connection and header
require_once 'includes/db.php';
require_once 'includes/header.php';
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<!-- changes -->
<div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center">
                <a href="login.php" class="btn btn-primary">Login</a>
                <a href="register.php" class="btn btn-primary">Register</a>
            </div>
        </div>
    </div>

<!-- end -->
<style>
.billboard-showcase {
    background-color: #F7F7F7;
    padding: 50px 0;
}

.billboard-showcase h1 {
    color: #4CAF50;
    font-size: 36px;
    font-weight: bold;
    text-align: center;
    margin-bottom: 20px;
}

.billboard-showcase p {
    color: #666666;
    font-size: 18px;
    text-align: center;
    margin-bottom: 50px;
}

.card {
    border: 1px solid #ddd;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease-in-out;
}

.card:hover {
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
    transform: scale(1.05);
}

.card-img-top {
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
    height: 200px;
    object-fit: cover;
}

.card-title {
    color: #333333;
    font-size: 24px;
    font-weight: bold;
    margin-bottom: 10px;
}

.card-text {
    color: #666666;
    font-size: 18px;
    margin-bottom: 20px;
}

.btn-primary {
    background-color: #4CAF50;
    border-color: #4CAF50;
    color: #fff;
    padding: 10px 20px;
    font-size: 18px;
    font-weight: bold;
    border-radius: 5px;
    transition: all 0.3s ease-in-out;
}

.btn-primary:hover {
    background-color: #3e8e41;
    border-color: #3e8e41;
}

.animate__animated {
    animation-duration: 0.3s;
}

.animate__fadeInLeft {
    animation-name: fadeInLeft;
}

.animate__fadeInUp {
    animation-name: fadeInUp;
}

.animate__fadeInRight {
    animation-name: fadeInRight;
}

.carousel-item img {
    height: 400px;
    object-fit: cover;
}

.review-section {
    background-color: #f9f9f9;
    padding: 50px 0;
}

.review-card {
    border: 1px solid #ddd;
    border-radius: 10px;
    padding: 20px;
    margin: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    text-align: center;
}

.review-card img {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    object-fit: cover;
    margin-bottom: 15px;
}

.review-card h5 {
    color: #4CAF50;
    font-size: 20px;
    margin-bottom: 10px;
}

.review-card p {
    color: #666666;
    font-size: 16px;
}
</style>

<!-- Billboard Showcase Section -->
<section class="billboard-showcase container mt-5">
    <h1 class="text-center animate__animated animate__fadeIn">Welcome to Digital Vision Board</h1>
    <p class="text-center animate__animated animate__fadeIn">Your one-stop solution for billboard advertising.</p>

    <div class="row mt-5">
        <!-- Billboard Types -->
        <div class="col-md-4 col-lg-4 col-xl-4 animate__animated animate__fadeInLeft">
            <div class="card h-100">
                <img src="assets/images/images.jpeg" class="card-img-top" alt="Digital Billboard">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-tv"></i> Digital Billboards</h5>
                    <p class="card-text">High-tech digital billboards with dynamic content.</p>
                    <a href="boards/digital_billboards.php" class="btn btn-primary">View Digital Billboards</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-lg-4 col-xl-4 animate__animated animate__fadeInUp">
            <div class="card h-100">
                <img src="assets/images/digital-billboard-lg.jpg" class="card-img-top" alt="Traditional Billboard">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-image"></i> Traditional Billboards</h5>
                    <p class="card-text">Classic billboards with printed advertisements.</p>
                    <a href="boards/traditional_billboards.php" class="btn btn-primary">View Traditional Billboards</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-lg-4 col-xl-4 animate__animated animate__fadeInRight">
            <div class="card h-100">
                <img src="assets/images/mobile.jpg" class="card-img-top" alt="Mobile Billboard">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-bus"></i> Mobile Billboards</h5>
                    <p class="card-text">Advertisements on vehicles and portable structures.</p>
                    <a href="boards/mobile_billboards.php" class="btn btn-primary">View Mobile Billboards</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Image Slider Section -->
    <div id="billboardCarousel" class="carousel slide mt-5" data-ride="carousel" data-interval="3000">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="assets/images/1.png" class="d-block w-100" alt="Image 1">
            </div>
            <div class="carousel-item">
                <img src="assets/images/2.png" class="d-block w-100" alt="Image 2">
            </div>
            <div class="carousel-item">
                <img src="assets/images/3.png" class="d-block w-100" alt="Image 3">
            </div>
            <div class="carousel-item">
                <img src="assets/images/img4.jpg" class="d-block w-100" alt="Image 3">
            </div>
            <div class="carousel-item">
                <img src="assets/images/img5.jpeg" class="d-block w-100" alt="Image 3">
            </div>
            <div class="carousel-item">
                <img src="assets/images/img6.jpg" class="d-block w-100" alt="Image 3">
            </div>
        </div>
        <a class="carousel-control-prev" href="#billboardCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#billboardCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</section>

<!-- Customer Reviews Section -->
<section class="review-section container mt-5">
    <h2 class="text-center animate__animated animate__fadeIn">What Our Customers Say</h2>
    <div class="row mt-4">
        <div class="col-md-4">
            <div class="review-card animate__animated animate__fadeInLeft">
                <img src="assets/images/customer1.png" alt="Customer 1">
                <p>"Great service and amazing visibility for our ads!"</p>
                <h5>- Usama Bin Ladin</h5>
            </div>
        </div>
        <div class="col-md-4">
            <div class="review-card animate__animated animate__fadeInUp">
                <img src="assets/images/customer2.png" alt="Customer 2">
                <p>"The digital billboards are a game changer for our marketing!"</p>
                <h5>- Imran Khan</h5>
            </div>
        </div>
        <div class="col-md-4">
            <div class="review-card animate__animated animate__fadeInRight">
                <img src="assets/images/customer3.png" alt="Customer 3">
                <p>"Highly recommend for anyone looking to boost their brand!"</p>
                <h5>- Ali</h5>
            </div>
        </div>
    </div>
</section>

<!-- CEO Section -->
<section class="container mt-5 text-center">
    <h2 class="animate__animated animate__fadeIn">Meet Our CEO</h2>
    <img src="assets/images/7084424.png" alt="CEO" class="img-fluid rounded-circle mt-3" style="width: 200px; height: 200px;">
    <p class="mt-3">Our CEO, He is dedicated to providing the best advertising solutions.</p>
</section>

<!-- Bootstrap JS and Dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<?php
// Include footer
require_once 'includes/footer.php';
?>