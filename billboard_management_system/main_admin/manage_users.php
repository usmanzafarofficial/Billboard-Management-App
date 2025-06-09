<?php
session_start();
include 'header.php'; // Include admin header
include '../includes/db.php'; // Include database connection

// Redirect if not admin
if (!isset($_SESSION['user_id']) || $_SESSION['user_type_id'] != 3) {
    header("Location: admin_login.php");
    exit();
}

// Fetch all users (advertisers and owners)
$stmt = $pdo->query("SELECT * FROM users WHERE user_type_id IN (1, 2)");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Handle user deletion
if (isset($_GET['delete'])) {
    $user_id = intval($_GET['delete']);

    try {
        // Start a transaction
        $pdo->beginTransaction();

        // Step 1: Delete dependent records in the billboards table
        $stmt = $pdo->prepare("DELETE FROM billboards WHERE owner_id = ?");
        $stmt->execute([$user_id]);

        // Step 2: Delete dependent records in the messages table
        $stmt = $pdo->prepare("DELETE FROM messages WHERE receiver_id = ? OR sender_id = ?");
        $stmt->execute([$user_id, $user_id]);

        // Step 3: Delete the user
        $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
        $stmt->execute([$user_id]);

        // Commit the transaction
        $pdo->commit();

        $_SESSION['success_message'] = "User and associated records deleted successfully!";
    } catch (PDOException $e) {
        // Rollback the transaction on error
        $pdo->rollBack();
        $_SESSION['error_message'] = "Error deleting user: " . $e->getMessage();
    }

    header("Location: manage_users.php");
    exit();
}
?>

<div class="container mt-5">
    <h1 class="text-center">Manage Users</h1>

    <!-- Display success message if set -->
    <?php if (isset($_SESSION['success_message'])): ?>
        <div class="alert alert-success"><?php echo $_SESSION['success_message']; ?></div>
        <?php unset($_SESSION['success_message']); ?>
    <?php endif; ?>

    <!-- Display error message if set -->
    <?php if (isset($_SESSION['error_message'])): ?>
        <div class="alert alert-danger"><?php echo $_SESSION['error_message']; ?></div>
        <?php unset($_SESSION['error_message']); ?>
    <?php endif; ?>

    <!-- Add User Button -->
    <a href="add_user.php" class="btn btn-success mb-3">
        <i class="fas fa-plus"></i> Add User
    </a>

    <!-- Users Table -->
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?php echo $user['id']; ?></td>
                    <td><?php echo htmlspecialchars($user['name']); ?></td>
                    <td><?php echo htmlspecialchars($user['email']); ?></td>
                    <td><?php echo $user['user_type_id'] == 1 ? 'Owner' : 'Advertiser'; ?></td>
                    <td>
                        <a href="edit_user.php?id=<?php echo $user['id']; ?>" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <a href="manage_users.php?delete=<?php echo $user['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this user and all associated records?')">
                            <i class="fas fa-trash"></i> Delete
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include 'footer.php'; ?>