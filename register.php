<?php
session_start(); // Start the session
include 'includes/db.php'; // Include database connection
include 'includes/header.php'; // Include header

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars($_POST['name']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $user_type_id = intval($_POST['user_type_id']);

    // Validate inputs
    if (empty($name)) {
        $errors[] = 'Name is required.';
    }
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Valid email is required.';
    }
    if (empty($_POST['password'])) {
        $errors[] = 'Password is required.';
    }
    if (empty($user_type_id)) {
        $errors[] = 'User type is required.';
    }

    // Check if email already exists
    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->fetch()) {
        $errors[] = 'Email already exists.';
    }

    // If no errors, insert into database
    if (empty($errors)) {
        $stmt = $pdo->prepare("INSERT INTO users (name, email, password, user_type_id) VALUES (?, ?, ?, ?)");
        $stmt->execute([$name, $email, $password, $user_type_id]);

        // Redirect to login page after successful registration
        header('Location: login.php');
        exit;
    }
}
?>

<!-- Registration Form -->
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2 class="text-center mb-4">Register</h2>

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

            <!-- Registration Form -->
            <form action="register.php" method="POST">
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
                    <label for="user_type_id" class="form-label">Register As</label>
                    <select class="form-select" id="user_type_id" name="user_type_id" required>
                        <option value="">Select user type</option>
                        <option value="1">Billboard Owner</option>
                        <option value="2">Advertiser</option>
                    </select>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Register</button>
                </div>
            </form>

            <!-- Link to Login Page -->
            <div class="mt-3 text-center">
                <p>Already have an account? <a href="login.php">Login here</a>.</p>
            </div>
        </div>
    </div>
</div>

<?php
include 'includes/footer.php'; // Include footer
?>