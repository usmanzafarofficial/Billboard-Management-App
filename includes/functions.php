<?php
// Function to sanitize input data
function sanitizeInput($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}

// Function to validate email
function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

// Function to redirect to a specific page
function redirect($url) {
    header("Location: $url");
    exit;
}

// Function to display success/error messages
function displayMessage($type, $message) {
    return "<div class='alert alert-$type'>$message</div>";
}
?>