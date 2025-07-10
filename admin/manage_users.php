<?php
session_start(); // Start the session

// Redirect to login if the user is not an admin
if (!isset($_SESSION['user_id']) || $_SESSION['is_admin'] != 1) {
    header('Location: ../login.php');
    exit;
}

include '../includes/db.php'; // Include database connection
include '../includes/header.php'; // Include header

// Fetch all users from the database
$stmt = $pdo->prepare("SELECT * FROM users");
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- Manage Users Content -->
<div class="container mt-5">
    <h1 class="text-center">Manage Users</h1>

    <!-- Add User Button -->
    <div class="text-end mb-3">
        <a href="add_user.php" class="btn btn-success">Add User</a>
    </div>

    <!-- Users Table -->
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>User Type</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?php echo $user['id']; ?></td>
                    <td><?php echo $user['name']; ?></td>
                    <td><?php echo $user['email']; ?></td>
                    <td>
                        <?php
                        if ($user['user_type_id'] == 1) {
                            echo 'Billboard Owner';
                        } elseif ($user['user_type_id'] == 2) {
                            echo 'Advertiser';
                        } else {
                            echo 'Unknown';
                        }
                        ?>
                    </td>
                    <td>
                        <a href="edit_user.php?id=<?php echo $user['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="delete_user.php?id=<?php echo $user['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php
include '../includes/footer.php'; // Include footer
?>