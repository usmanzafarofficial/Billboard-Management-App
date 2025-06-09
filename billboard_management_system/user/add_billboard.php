<?php
session_start(); // Start the session

// Redirect to login if the user is not logged in or is not a billboard owner
if (!isset($_SESSION['user_id']) || $_SESSION['user_type_id'] != 1) {
    header('Location: ../login.php');
    exit;
}

include '../includes/db.php'; // Include database connection
include '../includes/header_user.php'; // Include user header

// Fetch billboard types
$stmt = $pdo->prepare("SELECT * FROM billboard_types");
$stmt->execute();
$billboard_types = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = htmlspecialchars($_POST['title']);
    $description = htmlspecialchars($_POST['description']);
    $location = htmlspecialchars($_POST['location']);
    $dimensions = htmlspecialchars($_POST['dimensions']);
    $daily_rate = floatval($_POST['daily_rate']);
    $weekly_rate = floatval($_POST['weekly_rate']);
    $monthly_rate = floatval($_POST['monthly_rate']);
    $billboard_type_id = intval($_POST['billboard_type_id']);
    $features = json_encode($_POST['features']);

    // Insert new billboard
    $stmt = $pdo->prepare("
        INSERT INTO billboards (owner_id, title, description, location, dimensions, daily_rate, weekly_rate, monthly_rate, billboard_type_id, features)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");
    $stmt->execute([$_SESSION['user_id'], $title, $description, $location, $dimensions, $daily_rate, $weekly_rate, $monthly_rate, $billboard_type_id, $features]);

    // Redirect to view billboards
    header('Location: view_billboards.php');
    exit;
}
?>

<!-- Add Billboard Content -->
<div class="container mt-5">
    <h1 class="text-center">Add Billboard</h1>

    <form action="add_billboard.php" method="POST">
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
        </div>
        <div class="mb-3">
            <label for="location" class="form-label">Location</label>
            <input type="text" class="form-control" id="location" name="location" required>
        </div>
        <div class="mb-3">
            <label for="dimensions" class="form-label">Dimensions</label>
            <input type="text" class="form-control" id="dimensions" name="dimensions" required>
        </div>
        <div class="mb-3">
            <label for="daily_rate" class="form-label">Daily Rate</label>
            <input type="number" step="0.01" class="form-control" id="daily_rate" name="daily_rate" required>
        </div>
        <div class="mb-3">
            <label for="weekly_rate" class="form-label">Weekly Rate</label>
            <input type="number" step="0.01" class="form-control" id="weekly_rate" name="weekly_rate" required>
        </div>
        <div class="mb-3">
            <label for="monthly_rate" class="form-label">Monthly Rate</label>
            <input type="number" step="0.01" class="form-control" id="monthly_rate" name="monthly_rate" required>
        </div>
        <div class="mb-3">
            <label for="billboard_type_id" class="form-label">Billboard Type</label>
            <select class="form-select" id="billboard_type_id" name="billboard_type_id" required>
                <?php foreach ($billboard_types as $type): ?>
                    <option value="<?php echo $type['id']; ?>"><?php echo $type['type_name']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="features" class="form-label">Features (JSON)</label>
            <textarea class="form-control" id="features" name="features" rows="3" required></textarea>
        </div>
        <div class="d-grid">
            <button type="submit" class="btn btn-primary">Add Billboard</button>
        </div>
    </form>
</div>

<?php
include '../includes/footer.php'; // Include footer
?>