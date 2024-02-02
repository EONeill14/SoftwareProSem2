<?php
// Start a session
session_start();

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    // If the user is logged in, unset the 'user_id' session variable
    unset($_SESSION['user_id']);
}

// Redirect the user to the login page
header("Location: Login.php");
exit;
