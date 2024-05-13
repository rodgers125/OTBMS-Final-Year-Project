<?php
session_start(); // Starting the session

// Checking if the user is not logged in, redirecting to the login page
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

require 'connection.php'; // Including the connection file to establish database connection

$user_id = $_SESSION['user_id']; // Getting the user ID from the session
$query = "SELECT fName, lName FROM members WHERE memberId = ?"; // Query to retrieve user's first and last name
$preparedQuery = mysqli_prepare($conn, $query); // Preparing the SQL statement

if ($preparedQuery) { // Checking if the SQL statement is prepared successfully
    mysqli_stmt_bind_param($preparedQuery, "i", $user_id); // Binding parameters
    mysqli_stmt_execute($preparedQuery); // Executing the prepared statement
    $result = mysqli_stmt_get_result($preparedQuery); // Getting the result set
    $user = mysqli_fetch_assoc($result); // Fetching user data

    // Closing the prepared statement
    mysqli_stmt_close($preparedQuery);

    // Assigning user's name to a session variable or using it as needed
    $_SESSION['user_name'] = isset($user['fName']) ? $user['fName'] : '';
}


?>
