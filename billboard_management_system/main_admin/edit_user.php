<?php
include 'header.php'; // Include admin header
include '../includes/db.php'; // Include database connection

// Redirect if no user ID is provided
if (!isset($_GET['id'])) {
    header("Location: manage_users.php");
    exit();
}

$user_id = intval($_GET['id']);

// Fetch user details
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch();

// Redirect if user not found
if (!$user) {
    header("Location: manage_users.php");
    exit();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $user_type_id = intval($_POST['user_type_id']);

    // Update user details
    $stmt = $pdo->prepare("UPDATE users SET name = ?, email = ?, user_type_id = ? WHERE id = ?");
    $stmt->execute([$name, $email, $user_type_id, $user_id]);
    $_SESSION['success_message'] = "User updated successfully!";
    header("Location: manage_users.php");
    exit();
}
?>

<div class="container mt-5">
    <h1 class="text-center">Edit User</h1>

    <!-- Edit User Form -->
    <form method="POST" class="mt-4">
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="user_type_id" class="form-label">Role</label>
            <select class="form-select" id="user_type_id" name="user_type_id" required>
                <option value="1" <?php echo $user['user_type_id'] == 1 ? 'selected' : ''; ?>>Owner</option>
                <option value="2" <?php echo $user['user_type_id'] == 2 ? 'selected' : ''; ?>>Advertiser</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update User</button>
        <a href="manage_users.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<?php include 'footer.php'; ?>