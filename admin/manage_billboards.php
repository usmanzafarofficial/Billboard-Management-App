<?php
include 'header_admin.php'; // Include the header
include '../includes/db.php'; // Include database connection

// Handle form submission for adding a billboard
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_billboard'])) {
    $title = htmlspecialchars($_POST['title']);
    $location = htmlspecialchars($_POST['location']);
    $daily_rate = floatval($_POST['daily_rate']);

    $stmt = $pdo->prepare("INSERT INTO billboards (title, location, daily_rate, status) VALUES (?, ?, ?, 'available')");
    $stmt->execute([$title, $location, $daily_rate]);
    $success_message = "Billboard added successfully!";
}

// Handle billboard deletion
if (isset($_GET['delete'])) {
    $billboard_id = intval($_GET['delete']);
    $stmt = $pdo->prepare("DELETE FROM billboards WHERE id = ?");
    $stmt->execute([$billboard_id]);
    $success_message = "Billboard deleted successfully!";
}

// Fetch all billboards
$stmt = $pdo->query("SELECT * FROM billboards");
$billboards = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- Include Font Awesome for Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<!-- Include Animate.css for Animations -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

<!-- Manage Billboards Content -->
<div class="container mt-5">
    <h1 class="text-center animate__animated animate__fadeInDown">Manage Billboards</h1>

    <!-- Display success message if set -->
    <?php if (isset($success_message)): ?>
        <div class="alert alert-success animate__animated animate__fadeIn">
            <i class="fas fa-check-circle"></i> <?php echo $success_message; ?>
        </div>
    <?php endif; ?>

    <!-- Add Billboard Form -->
    <div class="card mb-4 animate__animated animate__fadeInUp">
        <div class="card-body">
            <h5 class="card-title"><i class="fas fa-plus-circle"></i> Add Billboard</h5>
            <form method="POST">
                <div class="mb-3">
                    <label for="title" class="form-label"><i class="fas fa-heading"></i> Title</label>
                    <input type="text" class="form-control" id="title" name="title" required>
                </div>
                <div class="mb-3">
                    <label for="location" class="form-label"><i class="fas fa-map-marker-alt"></i> Location</label>
                    <input type="text" class="form-control" id="location" name="location" required>
                </div>
                <div class="mb-3">
                    <label for="daily_rate" class="form-label"><i class="fas fa-dollar-sign"></i> Daily Rate</label>
                    <input type="number" class="form-control" id="daily_rate" name="daily_rate" step="0.01" required>
                </div>
                <button type="submit" name="add_billboard" class="btn btn-primary">
                    <i class="fas fa-save"></i> Add Billboard
                </button>
            </form>
        </div>
    </div>

    <!-- Billboards Table -->
    <div class="card animate__animated animate__fadeIn">
        <div class="card-body">
            <h5 class="card-title"><i class="fas fa-list"></i> Billboards List</h5>
            <div class="table-responsive"> <!-- Make the table responsive -->
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th><i class="fas fa-hashtag"></i> ID</th>
                            <th><i class="fas fa-heading"></i> Title</th>
                            <th><i class="fas fa-map-marker-alt"></i> Location</th>
                            <th><i class="fas fa-dollar-sign"></i> Daily Rate</th>
                            <th><i class="fas fa-info-circle"></i> Status</th>
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
                                    <span class="badge bg-<?php echo $billboard['status'] === 'available' ? 'success' : 'danger'; ?>">
                                        <?php echo ucfirst($billboard['status']); ?>
                                    </span>
                                </td>
                                <td>
                                    <a href="edit_billboard.php?id=<?php echo $billboard['id']; ?>" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <a href="manage_billboards.php?delete=<?php echo $billboard['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this billboard?')">
                                        <i class="fas fa-trash"></i> Delete
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