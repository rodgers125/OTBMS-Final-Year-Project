<?php
require 'connection.php';

session_start();


// Get user ID from session
$userID = $_SESSION['user_id'];

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $fName = $_POST['fName'];
    $lName = $_POST['lName'];
    $phone_number = $_POST['phone_number'];
    $gender = $_POST['gender'];

    // Update user details in the database
    $query = "UPDATE members SET fName=?, lName=?, phone=?, gender=? WHERE memberId=?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ssssi", $fName, $lName, $phone_number, $gender, $userID);
    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        // User details updated successfully
        echo "<script>alert(' Your Personal Details has been Updated successfuly');</script>";
            echo "<script>window.location.href = 'index.php';</script>";
            exit();
    } else {
        // Failed to update user details
        echo "<script>alert('Error While  Updating your Personal Details');</script>";
            echo "<script>window.location.href = 'index.php';</script> ";
            exit();
    }
} 





?>