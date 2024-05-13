<?php
session_start(); // Start the session

if (isset($_SESSION['user_id'])) {
    // Unset all session variables
    $_SESSION = array();

    // Destroy the session
    session_destroy();

    // Redirect to the login page
    header("Location: ../login.php");
    exit();
} else {
    // If the user is not logged in, you might want to redirect them to the login page
    header("Location: ../login.php");
    exit();
}
?>
