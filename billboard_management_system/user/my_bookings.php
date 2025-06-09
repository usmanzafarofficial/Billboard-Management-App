<?php
include 'header_user.php'; // Include the header
include '../includes/db.php'; // Include database connection

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}

// Fetch user's bookings
$advertiser_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("
    SELECT bookings.*, billboards.title AS billboard_title
    FROM bookings
    JOIN billboards ON bookings.billboard_id = billboards.id
    WHERE bookings.advertiser_id = ?
");
$stmt->execute([$advertiser_id]);
$bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- Include Font Awesome for Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<!-- Include Animate.css for Animations -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

<!-- My Bookings Content -->
<div class="container mt-5">
    <h1 class="text-center animate__animated animate__fadeInDown"><b>My Bookings</b></h1>

    <!-- Display success message if set -->
    <?php if (isset($_SESSION['success_message'])): ?>
        <div class="alert alert-success alert-dismissible fade show animate__animated animate__fadeIn" role="alert">
            <i class="fas fa-check-circle"></i> <?php echo htmlspecialchars($_SESSION['success_message']); ?>
            <?php unset($_SESSION['success_message']); // Clear the message ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <!-- Display message if no bookings found -->
    <?php if (empty($bookings)): ?>
        <div class="alert alert-warning text-center animate__animated animate__fadeIn">
            <i class="fas fa-info-circle"></i> <b>No bookings found.</b> Start advertising now!
        </div>
    <?php else: ?>

    <!-- Bookings Table -->
    <div class="card animate__animated animate__fadeIn">
        <div class="card-body">
            <div class="table-responsive"> <!-- Make the table responsive -->
                <table class="table table-bordered table-hover shadow-sm">
                    <thead class="table-dark">
                        <tr>
                            <th><i class="fas fa-hashtag"></i> #</th>
                            <th><i class="fas fa-bullhorn"></i> Billboard</th>
                            <th><i class="fas fa-calendar-alt"></i> Start Date</th>
                            <th><i class="fas fa-calendar-alt"></i> End Date</th>
                            <th><i class="fas fa-dollar-sign"></i> Total Cost</th>
                            <th><i class="fas fa-comment"></i> Advertisement</th>
                            <th><i class="fas fa-image"></i> Content</th>
                            <th><i class="fas fa-info-circle"></i> Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($bookings as $index => $booking): ?>
                            <tr>
                                <td><b><?php echo $index + 1; ?></b></td>
                                <td><b><?php echo htmlspecialchars($booking['billboard_title']); ?></b></td>
                                <td><?php echo htmlspecialchars($booking['start_date']); ?></td>
                                <td><?php echo htmlspecialchars($booking['end_date']); ?></td>
                                <td><b>PKR <?php echo number_format($booking['total_cost'], 2); ?></b></td>
                                <td><?php echo htmlspecialchars($booking['ad_message']); ?></td>
                                <td>
                                    <?php if (!empty($booking['content_url'])): ?>
                                        <img src="<?php echo htmlspecialchars($booking['content_url']); ?>" alt="Ad Content" class="img-thumbnail" style="max-width: 100px; height: auto;">
                                    <?php else: ?>
                                        <span class="text-muted">No content uploaded.</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <span class="badge 
                                        <?php
                                        switch ($booking['status']) {
                                            case 'pending': echo 'bg-warning text-dark'; break;
                                            case 'confirmed': echo 'bg-success'; break;
                                            case 'cancelled': echo 'bg-danger'; break;
                                            case 'rejected': echo 'bg-dark text-white'; break;
                                            default: echo 'bg-secondary';
                                        }
                                        ?>">
                                        <?php echo ucfirst(htmlspecialchars($booking['status'])); ?>
                                    </span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <?php endif; ?>
</div>

<?php
include '../includes/footer.php'; // Include the footer
?>