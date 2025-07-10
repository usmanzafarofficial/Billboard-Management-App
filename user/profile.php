<?php
include 'header_user.php'; // Include the header
include '../includes/db.php'; // Include database connection

// Fetch user details
$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!-- Profile Content -->
<div class="container mt-5">
    <h1 class="text-center mb-4" style="font-size: 2.5rem; font-weight: bold; color: #333;">User Profile</h1>
    
    <!-- Profile Card -->
    <div class="card shadow-sm border-light">
        <div class="row no-gutters">
            <!-- User Avatar Section -->
            <div class="col-md-4">
                <div class="card-img-top text-center">
                    <img src="../assets/images/Basic_Ui__28186_29.jpg" class="rounded-circle mt-3" alt="User Avatar" style="width: 150px; height: 150px;">
                </div>
            </div>
            
            <!-- User Info Section -->
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $user['name']; ?></h5>
                    <p class="card-text"><strong>Email:</strong> <?php echo $user['email']; ?></p>
                    <p class="card-text"><strong>Joined:</strong> <?php echo date("F j, Y", strtotime($user['created_at'])); ?></p>
                    
                    <a href="edit_profile.php" class="btn btn-primary mt-3">Edit Profile</a>
                    <a href="change_password.php" class="btn btn-secondary mt-3 ml-2">Change Password</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include '../includes/footer.php'; // Include the footer
?>
