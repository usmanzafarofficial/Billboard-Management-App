<?php
// Function to check if the user is logged in
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

// Function to check if the user is an admin
function isAdmin() {
    return isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1;
}

// Function to check if the user is a billboard owner
function isBillboardOwner() {
    return isset($_SESSION['user_type_id']) && $_SESSION['user_type_id'] == 1;
}

// Function to check if the user is an advertiser
function isAdvertiser() {
    return isset($_SESSION['user_type_id']) && $_SESSION['user_type_id'] == 2;
}
?>