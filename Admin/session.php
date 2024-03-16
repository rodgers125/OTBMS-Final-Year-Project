<?php
session_start();

// Check if the user is not logged in, redirect to the login page
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Additional session-related tasks or user data retrieval can go here
// For example, fetching the user's name from the database based on the user_id
require 'connection.php';

$user_id = $_SESSION['user_id'];
$query = "SELECT fName, lName FROM members WHERE memberId = ?";
$preparedQuery = mysqli_prepare($conn, $query);

if ($preparedQuery) {
    mysqli_stmt_bind_param($preparedQuery, "i", $user_id);
    mysqli_stmt_execute($preparedQuery);
    $result = mysqli_stmt_get_result($preparedQuery);
    $user = mysqli_fetch_assoc($result);

    // Close the statement
    mysqli_stmt_close($preparedQuery);

    // Assign user's name to a session variable or use it as needed
    $_SESSION['user_name'] = isset($user['fName']) ? $user['fName'] : '';
}

// No need to close the database connection in this file
?>
