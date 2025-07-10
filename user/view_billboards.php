<?php
include 'header_user.php'; // Include the header
include '../includes/db.php'; // Include database connection

// Fetch all available billboards
$stmt = $pdo->query("SELECT * FROM billboards WHERE status = 'available'");
$billboards = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- Include Font Awesome for Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<!-- Include Animate.css for Animations -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

<!-- View Billboards Content -->
<div class="container mt-5">
    <h1 class="text-center animate__animated animate__fadeInDown">Available Billboards</h1>

    <!-- Responsive Table -->
    <div class="card animate__animated animate__fadeIn">
        <div class="card-body">
            <div class="table-responsive"> <!-- Make the table responsive -->
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th><i class="fas fa-hashtag"></i> ID</th>
                            <th><i class="fas fa-heading"></i> Title</th>
                            <th><i class="fas fa-map-marker-alt"></i> Location</th>
                            <th><i class="fas fa-dollar-sign"></i> Daily Rate</th>
                            <th><i class="fas fa-cogs"></i> Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($billboards as $billboard): ?>
                            <tr>
                                <td><?php echo $billboard['id']; ?></td>
                                <td><?php echo $billboard['title']; ?></td>
                                <td><?php echo $billboard['location']; ?></td>
                                <td>$<?php echo number_format($billboard['daily_rate'], 2); ?></td>
                                <td>
                                    <a href="book_billboard.php?id=<?php echo $billboard['id']; ?>" class="btn btn-success btn-sm">
                                        <i class="fas fa-calendar-check"></i> Book
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