<?php
session_start(); // Start the session

// Redirect to login if the user is not logged in or is not an advertiser
if (!isset($_SESSION['user_id']) || $_SESSION['user_type_id'] != 2) {
    header('Location: ../login.php');
    exit;
}

include '../includes/db.php'; // Include database connection
include 'header_user.php'; // Include user header

// Fetch billboard details
if (isset($_GET['id'])) {
    $billboard_id = $_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM billboards WHERE id = ?");
    $stmt->execute([$billboard_id]);
    $billboard = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$billboard) {
        die("Billboard not found.");
    }
} else {
    die("Invalid request.");
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $advertiser_id = $_SESSION['user_id'];
    $ad_message = htmlspecialchars($_POST['ad_message']); // Get the advertisement message

    // Calculate total cost
    $days = (strtotime($end_date) - strtotime($start_date)) / (60 * 60 * 24);
    $total_cost = $billboard['daily_rate'] * $days;

    // Handle file upload
    $content_url = '';
    if ($_FILES['content']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = '../assets/uploads/';
        
        // Create the uploads directory if it doesn't exist
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }

        $file_name = basename($_FILES['content']['name']);
        $target_file = $upload_dir . $file_name;

        // Move the uploaded file
        if (move_uploaded_file($_FILES['content']['tmp_name'], $target_file)) {
            $content_url = $target_file;
        } else {
            die("Failed to upload file.");
        }
    }

    // Insert booking into the database
    $stmt = $pdo->prepare("
        INSERT INTO bookings (billboard_id, advertiser_id, start_date, end_date, total_cost, content_url, ad_message, status)
        VALUES (?, ?, ?, ?, ?, ?, ?, 'pending')
    ");
    $stmt->execute([$billboard_id, $advertiser_id, $start_date, $end_date, $total_cost, $content_url, $ad_message]);

    // Set success message
    $_SESSION['success_message'] = "Your booking has been placed successfully!";

    // Redirect to my_bookings.php
    header('Location: my_bookings.php');
    exit;
}
?>

<!-- Book Billboard Content -->
<div class="container mt-5">
    <h1 class="text-center">Book Billboard: <?php echo $billboard['title']; ?></h1>

    <!-- Display success message if set -->
    <?php if (isset($_SESSION['success_message'])): ?>
        <div class="alert alert-success">
            <?php echo $_SESSION['success_message']; ?>
            <?php unset($_SESSION['success_message']); // Clear the message ?>
        </div>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="start_date" class="form-label">Start Date</label>
            <input type="date" class="form-control" id="start_date" name="start_date" required>
        </div>
        <div class="mb-3">
            <label for="end_date" class="form-label">End Date</label>
            <input type="date" class="form-control" id="end_date" name="end_date" required>
        </div>
        <div class="mb-3">
            <label for="ad_message" class="form-label">Advertisement Message</label>
            <textarea class="form-control" id="ad_message" name="ad_message" rows="3" required></textarea>
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Upload Content (Image)</label>
            <input type="file" class="form-control" id="content" name="content" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit Booking</button>
    </form>
</div>

<?php
include '../includes/footer.php'; // Include the footer
?>