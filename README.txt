
---

### How to Use These Files

1. **CSS**:
   - Link the `style.css` file in your HTML/PHP files using:
     ```html
     <link href="assets/css/style.css" rel="stylesheet">
     ```

2. **JavaScript**:
   - Link the `script.js` file in your HTML/PHP files using:
     ```html
     <script src="assets/js/script.js"></script>
     ```

3. **Images**:
   - Use the images in your HTML/PHP files. For example:
     ```html
     <img src="assets/images/logo.png" alt="Logo">
     ```

4. **Configuration**:
   - Include the `constants.php` file in your PHP files to access configuration constants:
     ```php
     include 'config/constants.php';
     ```

5. **README**:
   - Update the `README.md` file with your project details and instructions.

---

### Example Usage in `index.php`

Here’s how you can use these files in `index.php`:

```php
<?php
session_start(); // Start the session
include 'includes/db.php'; // Include database connection
include 'includes/header.php'; // Include header
?>

<!-- Main Content -->
<div class="container mt-5">
    <h1 class="text-center">Welcome to Billboard Management System</h1>
    <p class="text-center">Manage your billboards and bookings efficiently.</p>

    <!-- Billboard Showcase -->
    <div class="row mt-5">
        <div class="col-md-4">
            <div class="card">
                <img src="assets/images/digital-billboard.jpg" class="card-img-top" alt="Digital Billboard">
                <div class="card-body">
                    <h5 class="card-title">Digital Billboards</h5>
                    <p class="card-text">High-tech digital billboards with dynamic content.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <img src="assets/images/traditional-billboard.jpg" class="card-img-top" alt="Traditional Billboard">
                <div class="card-body">
                    <h5 class="card-title">Traditional Billboards</h5>
                    <p class="card-text">Classic billboards with printed advertisements.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <img src="assets/images/mobile-billboard.jpg" class="card-img-top" alt="Mobile Billboard">
                <div class="card-body">
                    <h5 class="card-title">Mobile Billboards</h5>
                    <p class="card-text">Advertisements on vehicles and portable structures.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Call to Action -->
    <div class="row mt-5">
        <div class="col-md-6 text-center">
            <a href="login.php" class="btn btn-primary btn-lg">Login</a>
        </div>
        <div class="col-md-6 text-center">
            <a href="register.php" class="btn btn-success btn-lg">Register</a>
        </div>
    </div>
</div>

<?php
include 'includes/footer.php'; // Include footer
?>