<?php include('../boards/header.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Digital Billboards</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <style>
        /* Additional styling for a polished look */
        .container {
            max-width: 1100px;
        }
        .highlight-text {
            color: #ff5733;
            font-weight: bold;
        }
        .custom-card {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .btn-custom {
            background: #ff5733;
            color: #fff;
            transition: 0.3s;
        }
        .btn-custom:hover {
            background: #c70039;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <h1 class="text-center" data-aos="fade-up" data-aos-duration="800">🚀 <b>Digital Billboards</b></h1>
    <p class="text-center text-muted" data-aos="fade-up" data-aos-delay="200">
        <b>Modern, dynamic, and high-impact advertising for brands.</b>
    </p>

    <div class="row mt-5 align-items-center">
        <div class="col-md-6" data-aos="fade-right" data-aos-duration="800">
            <img src="../assets/images/London-digital-billboard-1-1024x683.webp" 
                 class="img-fluid rounded shadow-lg">
        </div>
        <div class="col-md-6" data-aos="fade-left" data-aos-duration="800">
            <div class="custom-card">
                <h3 class="highlight-text"><b>Why Choose Digital Billboards?</b></h3>
                <p>Digital billboards <b>revolutionize advertising</b> with their flexibility and dynamic content.</p>
                <ul class="list-unstyled">
                    <li><i class="fas fa-check-circle text-success"></i> <b>Real-time updates</b> & scheduled ads.</li>
                    <li><i class="fas fa-check-circle text-success"></i> <b>Higher engagement</b> with animations.</li>
                    <li><i class="fas fa-check-circle text-success"></i> <b>Cost-effective</b> for multiple campaigns.</li>
                    <li><i class="fas fa-check-circle text-success"></i> <b>Attractive video & motion ads.</b></li>
                </ul>
                <a href="#" class="btn btn-custom mt-3"><b>Advertise Now</b></a>
            </div>
        </div>
    </div>

    <!-- Feature Section with Animations -->
    <div class="row mt-5">
        <div class="col-md-4 text-center" data-aos="zoom-in" data-aos-duration="800">
            <div class="p-4 border rounded bg-light shadow-sm">
                <i class="fas fa-bullhorn fa-3x text-primary"></i>
                <h5 class="mt-3"><b>High Visibility</b></h5>
                <p>Strategically placed for <b>maximum audience impact.</b></p>
            </div>
        </div>
        <div class="col-md-4 text-center" data-aos="zoom-in" data-aos-delay="200">
            <div class="p-4 border rounded bg-light shadow-sm">
                <i class="fas fa-chart-line fa-3x text-danger"></i>
                <h5 class="mt-3"><b>Dynamic Content</b></h5>
                <p>Update ads in <b>real-time</b> with <b>engaging animations.</b></p>
            </div>
        </div>
        <div class="col-md-4 text-center" data-aos="zoom-in" data-aos-delay="400">
            <div class="p-4 border rounded bg-light shadow-sm">
                <i class="fas fa-video fa-3x text-success"></i>
                <h5 class="mt-3"><b>Video Integration</b></h5>
                <p>Showcase <b>videos & motion graphics</b> for higher impact.</p>
            </div>
        </div>
    </div>
</div>

<script>
    AOS.init();
</script>

<?php include('../includes/footer.php'); ?>
</body>
</html>
