<?php
session_start();
require 'User/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve token from URL
    $token = $_GET['token'];
    $newPassword = $_POST['newPassword'];
    $confirmNewPassword = $_POST['confirmNewPassword'];

    // Validate the token
    $query = "SELECT member_id, expiration_time FROM password_reset_tokens WHERE token = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $token);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $memberID = $row['member_id'];
        $expirationTime = $row['expiration_time'];

        // Check if the token is expired
        if (new DateTime() > new DateTime($expirationTime)) {
            echo "<script>alert('Token has expired. Request a new one.'); window.location.href = 'email_submit.php';</script>";
            exit();
        }

        // Validate the new password and confirm password
        if ($newPassword === $confirmNewPassword) {
            // Hash the new password
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

            // Update the password in the database
            $updateQuery = "UPDATE members SET password = ? WHERE memberId = ?";
            $updateStmt = mysqli_prepare($conn, $updateQuery);
            mysqli_stmt_bind_param($updateStmt, "si", $hashedPassword, $memberID);
            $updateResult = mysqli_stmt_execute($updateStmt);

            if ($updateResult) {
                // Delete the used token from the database
                $deleteTokenQuery = "DELETE FROM password_reset_tokens WHERE token = ?";
                $deleteTokenStmt = mysqli_prepare($conn, $deleteTokenQuery);
                mysqli_stmt_bind_param($deleteTokenStmt, "s", $token);
                mysqli_stmt_execute($deleteTokenStmt);

                echo "<script>alert('Password has been reset successfully.'); window.location.href = 'login.php';</script>";
                exit();
            } else {
                echo "<script>alert('Failed to update password. Please try again.'); window.location.href = 'reset_password.php?token={$token}';</script>";
                exit();
            }
        } else {
            echo "<script>alert('Passwords do not match. Please try again.'); window.location.href = 'reset_password.php?token={$token}';</script>";
            exit();
        }
    } else {
        echo "<script>alert('Invalid token.'); window.location.href = 'email_submit.php';</script>";
        exit();
    }
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="User/css/login.css">
    <link rel="stylesheet" href="User/css/admin.css">
    <title>Password Reset</title>
</head>
<body>
    <div class="login-container">
        <div class="image-container">
            <img src="User/images/hero.png" alt="Login Image">
        </div>
        <div class="form-container">
            <div class="login-form">
                <h2>Reset Password</h2>
                <form action="" method="post">
                <div class="form-group">
                            <label for="password">New Password</label>
                            <input type="password" id="newPassword" name="newPassword" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Confirm New Password</label>
                            <input type="password" id="ConfirmNewPassword" name="confirmNewPassword" required>
                            <p class="error-message" id="passwordError"></p>
                        </div>
                    <div class="form-group">
                        <button type="submit" name="submit">Reset Password</button>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
</body>
</html>