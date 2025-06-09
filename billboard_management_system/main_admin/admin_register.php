<?php
session_start();
include '../includes/db.php'; // Include database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password
    $user_type_id = 3; // Admin role

    try {
        // Check if the email already exists
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user) {
            $error_message = "Email already exists!";
        } else {
            // Check if the user_type_id exists in the user_types table
            $stmt = $pdo->prepare("SELECT * FROM user_types WHERE id = ?");
            $stmt->execute([$user_type_id]);
            $user_type = $stmt->fetch();

            if (!$user_type) {
                $error_message = "Invalid user type!";
            } else {
                // Insert new admin user
                $stmt = $pdo->prepare("INSERT INTO users (name, email, password, user_type_id) VALUES (?, ?, ?, ?)");
                $stmt->execute([$name, $email, $password, $user_type_id]);
                $_SESSION['success_message'] = "Admin registered successfully!";
                header("Location: admin_login.php");
                exit();
            }
        }
    } catch (PDOException $e) {
        $error_message = "Database error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Admin Registration</h1>

        <!-- Display error message if set -->
        <?php if (isset($error_message)): ?>
            <div class="alert alert-danger"><?php echo $error_message; ?></div>
        <?php endif; ?>

        <!-- Display success message if set -->
        <?php if (isset($_SESSION['success_message'])): ?>
            <div class="alert alert-success"><?php echo $_SESSION['success_message']; ?></div>
            <?php unset($_SESSION['success_message']); // Clear the message ?>
        <?php endif; ?>

        <!-- Registration Form -->
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
            <button type="submit" class="btn btn-primary">Register</button>
        </form>

        <p class="text-center mt-3">
            Already have an account? <a href="admin_login.php">Login here</a>.
        </p>
    </div>
</body>
</html>