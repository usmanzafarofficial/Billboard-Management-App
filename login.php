<?php
session_start(); // Start the session
include 'includes/db.php'; // Include database connection
include 'includes/header.php'; // Include header

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];

    // Validate inputs
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Valid email is required.';
    }
    if (empty($password)) {
        $errors[] = 'Password is required.';
    }

    // If no errors, check user credentials
    if (empty($errors)) {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            // Login successful
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_type_id'] = $user['user_type_id'];

            // Redirect based on user type
            if ($user['user_type_id'] == 1) { // Owner
                header('Location: admin/index.php');
            } elseif ($user['user_type_id'] == 2) { // Advertiser
                header('Location: user/dashboard.php');
            }
            exit;
        } else {
            $errors[] = 'Invalid email or password.';
        }
    }
}
?>

<!-- Login Form -->
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2 class="text-center mb-4">Login</h2>

            <!-- Display errors -->
            <?php if (!empty($errors)): ?>
                <div class="alert alert-danger">
                    <ul>
                        <?php foreach ($errors as $error): ?>
                            <li><?php echo $error; ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <!-- Login Form -->
            <form action="login.php" method="POST">
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>
            </form>

            <!-- Link to Registration Page -->
            <div class="mt-3 text-center">
                <p>Don't have an account? <a href="register.php">Register here</a>.</p>
            </div>
        </div>
    </div>
</div>

<?php
include 'includes/footer.php'; // Include footer
?>