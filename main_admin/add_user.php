<?php include 'header.php'; ?>
<?php
include '../includes/db.php'; // Include database connection

// Redirect if not admin
if (!isset($_SESSION['user_id']) || $_SESSION['user_type_id'] != 3) {
    header("Location: admin_login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $user_type_id = intval($_POST['user_type_id']);

    // Insert new user
    $stmt = $pdo->prepare("INSERT INTO users (name, email, password, user_type_id) VALUES (?, ?, ?, ?)");
    $stmt->execute([$name, $email, $password, $user_type_id]);
    $_SESSION['success_message'] = "User added successfully!";
    header("Location: admin_dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Add User</h1>
        <form method="POST" class="mt-4">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="mb-3">
                <label for="user_type_id" class="form-label">Role</label>
                <select class="form-select" id="user_type_id" name="user_type_id" required>
                    <option value="1">Owner</option>
                    <option value="2">Advertiser</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Add User</button>
        </form>
    </div>
</body>
</html>
<?php include 'footer.php'; ?>