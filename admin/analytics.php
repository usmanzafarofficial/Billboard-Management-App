<?php
include '../includes/db.php'; // Include database connection
include 'header_admin.php'; // Include admin header

// Redirect if the user is not logged in or is not a billboard owner
if (!isset($_SESSION['user_id']) || $_SESSION['user_type_id'] != 1) {
    header('Location: ../login.php');
    exit;
}

// Fetch total messages sent and received
$admin_id = $_SESSION['user_id'];

// Total messages sent by the admin
$stmt = $pdo->prepare("SELECT COUNT(*) AS sent_count FROM messages WHERE sender_id = ?");
$stmt->execute([$admin_id]);
$sent_count = $stmt->fetch(PDO::FETCH_ASSOC)['sent_count'];

// Total messages received by the admin
$stmt = $pdo->prepare("SELECT COUNT(*) AS received_count FROM messages WHERE receiver_id = ?");
$stmt->execute([$admin_id]);
$received_count = $stmt->fetch(PDO::FETCH_ASSOC)['received_count'];
?>

<!-- Include Font Awesome for Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<!-- Include Animate.css for Animations -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

<div class="container mt-5">
    <h1 class="text-center animate__animated animate__fadeInDown">Analytics</h1>

    <!-- Analytics Cards -->
    <div class="row mt-4">
        <!-- Messages Sent Card -->
        <div class="col-md-6 animate__animated animate__fadeInLeft">
            <div class="card h-100">
                <div class="card-body text-center">
                    <i class="fas fa-paper-plane fa-3x mb-3 text-primary"></i>
                    <h5 class="card-title">Messages Sent</h5>
                    <p class="card-text display-4"><?php echo $sent_count; ?></p>
                </div>
            </div>
        </div>

        <!-- Messages Received Card -->
        <div class="col-md-6 animate__animated animate__fadeInRight">
            <div class="card h-100">
                <div class="card-body text-center">
                    <i class="fas fa-envelope fa-3x mb-3 text-success"></i>
                    <h5 class="card-title">Messages Received</h5>
                    <p class="card-text display-4"><?php echo $received_count; ?></p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include '../includes/footer.php'; // Include footer
?>