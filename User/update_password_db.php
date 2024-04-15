<?php
session_start();
require 'connection.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    

    // Get the current user's ID from the session
    $userID = $_SESSION['user_id'];

    // Retrieve the current password from the database for the user
    $query = "SELECT password FROM members WHERE memberId = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $userID);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $currentPasswordDB = $row['password'];

        // Verify if the current password matches the one provided in the form
        $currentPassword = $_POST['currentPassword'];
        if (password_verify($currentPassword, $currentPasswordDB)) {
            // Check if the new password and the confirm password match
            $newPassword = $_POST['password'];
            $confirmPassword = $_POST['confirmPassword'];

            if ($newPassword === $confirmPassword) {
                // Hash the new password before storing it in the database
                $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

                // Update the password in the database
                $updateQuery = "UPDATE members SET password = ? WHERE memberId = ?";
                $updateStmt = mysqli_prepare($conn, $updateQuery);
                mysqli_stmt_bind_param($updateStmt, "si", $hashedPassword, $userID);
                $updateResult = mysqli_stmt_execute($updateStmt);

                if ($updateResult) {
                    // Password updated successfully
                    echo "<script>alert(' Password has been Updated successfuly');</script>";
            echo "<script>window.location.href = 'settings.php';</script>";
            exit();}                
            } else {
                // New password and confirm password do not match
              
                echo "<script>alert(' New password and confirm password do not match. Please try again');</script>";
            echo "<script>window.location.href = 'settings.php';</script>";
            exit();
            }
        } else {
            // Current password provided does not match the one in the database            
            echo "<script>alert(' Current password you provided is incorrect. Please try again');</script>";
            echo "<script>window.location.href = 'settings.php';</script>";
            exit();
            
        }
    } else {
        // Unable to fetch current password from the database
       
        echo "<script>alert(' Unable to fetch current password. Please try again later');</script>";
        echo "<script>window.location.href = 'settings.php';</script>";
        exit();
        
        
    }

    // Close database connection
    mysqli_close($conn);
} 
?>
