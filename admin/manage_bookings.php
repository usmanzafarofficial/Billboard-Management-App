<?php
include 'header_admin.php'; // Include the header
include '../includes/db.php'; // Include database connection

// Handle booking approval
if (isset($_GET['approve'])) {
    $booking_id = intval($_GET['approve']);
    $stmt = $pdo->prepare("UPDATE bookings SET status = 'confirmed' WHERE id = ?");
    $stmt->execute([$booking_id]);
    $success_message = "Booking approved successfully!";
}

// Handle booking rejection
if (isset($_GET['reject'])) {
    $booking_id = intval($_GET['reject']);
    $stmt = $pdo->prepare("UPDATE bookings SET status = 'rejected' WHERE id = ?");
    $stmt->execute([$booking_id]);
    $success_message = "Booking rejected successfully!";
}

// Fetch all bookings
$stmt = $pdo->query("
    SELECT bookings.*, billboards.title AS billboard_title, users.name AS advertiser_name
    FROM bookings
    JOIN billboards ON bookings.billboard_id = billboards.id
    JOIN users ON bookings.advertiser_id = users.id
");
$bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- Include Font Awesome for Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<!-- Include Animate.css for Animations -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

<!-- Manage Bookings Content -->
<div class="container mt-5">
    <h1 class="text-center animate__animated animate__fadeInDown">Manage Bookings</h1>

    <!-- Display success message if set -->
    <?php if (isset($success_message)): ?>
        <div class="alert alert-success animate__animated animate__fadeIn">
            <i class="fas fa-check-circle"></i> <?php echo $success_message; ?>
        </div>
    <?php endif; ?>

    <!-- Bookings Table -->
    <div class="card animate__animated animate__fadeIn">
        <div class="card-body">
            <h5 class="card-title"><i class="fas fa-calendar-check"></i> Bookings List</h5>
            <div class="table-responsive"> <!-- Make the table responsive -->
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th><i class="fas fa-hashtag"></i> ID</th>
                            <th><i class="fas fa-ad"></i> Billboard</th>
                            <th><i class="fas fa-user"></i> Advertiser</th>
                            <th><i class="fas fa-calendar-day"></i> Start Date</th>
                            <th><i class="fas fa-calendar-day"></i> End Date</th>
                            <th><i class="fas fa-dollar-sign"></i> Total Cost</th>
                            <th><i class="fas fa-info-circle"></i> Status</th>
                            <th><i class="fas fa-cogs"></i> Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($bookings as $booking): ?>
                            <tr>
                                <td><?php echo $booking['id']; ?></td>
                                <td><?php echo $booking['billboard_title']; ?></td>
                                <td><?php echo $booking['advertiser_name']; ?></td>
                                <td><?php echo $booking['start_date']; ?></td>
                                <td><?php echo $booking['end_date']; ?></td>
                                <td>$<?php echo number_format($booking['total_cost'], 2); ?></td>
                                <td>
                                    <span class="badge 
                                        <?php
                                        switch ($booking['status']) {
                                            case 'pending':
                                                echo 'bg-warning';
                                                break;
                                            case 'confirmed':
                                                echo 'bg-success';
                                                break;
                                            case 'rejected':
                                                echo 'bg-danger';
                                                break;
                                            default:
                                                echo 'bg-secondary';
                                        }
                                        ?>">
                                        <?php echo ucfirst($booking['status']); ?>
                                    </span>
                                </td>
                                <td>
                                    <a href="manage_bookings.php?approve=<?php echo $booking['id']; ?>" class="btn btn-success btn-sm">
                                        <i class="fas fa-check"></i> Approve
                                    </a>
                                    <a href="manage_bookings.php?reject=<?php echo $booking['id']; ?>" class="btn btn-danger btn-sm">
                                        <i class="fas fa-times"></i> Reject
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php
include '../includes/footer.php'; // Include the footer
?>