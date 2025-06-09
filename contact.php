<?php
session_start(); // Start the session
include 'includes/db.php'; // Include database connection
include 'includes/header.php'; // Include header

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars($_POST['name']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $contact_number = htmlspecialchars($_POST['contact_number']);
    $message = htmlspecialchars($_POST['message']);

    // Validate inputs
    $errors = [];
    if (empty($name)) {
        $errors[] = 'Name is required.';
    }
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Valid email is required.';
    }
    if (empty($contact_number)) {
        $errors[] = 'Contact number is required.';
    }
    if (empty($message)) {
        $errors[] = 'Message is required.';
    }

    // If no errors, insert the message into the database
    if (empty($errors)) {
        try {
            // Prepare the SQL query
            $stmt = $pdo->prepare("INSERT INTO contact_submissions (name, email, contact_number, message) VALUES (?, ?, ?, ?)");
            // Execute the query with the form data
            $stmt->execute([$name, $email, $contact_number, $message]);

            // Set success message
            $success = 'Thank you for contacting us! We will get back to you soon.';
        } catch (PDOException $e) {
            // Handle database errors
            $errors[] = 'An error occurred while saving your message. Please try again later.';
        }
    }
}
?>

<!-- Contact Us Content -->
<div class="container mt-5 animate__animated animate__fadeIn">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class="text-center mb-4">Contact Us</h1>

            <!-- Display success message -->
            <?php if (isset($success)): ?>
                <div class="alert alert-success animate__animated animate__fadeIn">
                    <i class="fas fa-check-circle"></i> <?php echo $success; ?>
                </div>
            <?php endif; ?>

            <!-- Display errors -->
            <?php if (!empty($errors)): ?>
                <div class="alert alert-danger animate__animated animate__shakeX">
                    <ul class="mb-0">
                        <?php foreach ($errors as $error): ?>
                            <li><i class="fas fa-exclamation-circle"></i> <?php echo $error; ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <!-- Contact Form -->
            <form action="contact.php" method="POST" class="shadow p-4 rounded bg-light">
                <div class="mb-3">
                    <label for="name" class="form-label"><i class="fas fa-user"></i> Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label"><i class="fas fa-envelope"></i> Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                </div>
                <div class="mb-3">
                    <label for="contact_number" class="form-label"><i class="fas fa-phone"></i> Contact Number</label>
                    <input type="text" class="form-control" id="contact_number" name="contact_number" placeholder="Enter your contact number" required>
                </div>
                <div class="mb-3">
                    <label for="message" class="form-label"><i class="fas fa-comment"></i> Message</label>
                    <textarea class="form-control" id="message" name="message" rows="5" placeholder="Enter your message" required></textarea>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="fas fa-paper-plane"></i> Send Message
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
include 'includes/footer.php'; // Include footer
?>