<?php
require_once 'User/connection.php'; // Include your database connection file

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];

    // Validate the email address
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email address";
    } else {
        // Generate a unique token
        $token = bin2hex(random_bytes(16)); // Generate a random 32-character hexadecimal string

        // Set expiration time (30 minutes)
        $expirationTime = date("Y-m-d H:i:s", time() + 60 * 90);

        // Insert the token into the database
        $query = "INSERT INTO password_reset_tokens (member_id, token, expiration_time, created_at) 
                  SELECT memberId, ?, ?, NOW() FROM members WHERE email = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "sss", $token, $expirationTime, $email);
        if (mysqli_stmt_execute($stmt)) {
            echo "<script>alert('Token generated successfully. Check your email for instructions.');</script>";
        } else {
            echo "Error generating token: " . mysqli_error($conn);
        }
        mysqli_stmt_close($stmt);

// Construct the password reset link with the token as a query parameter
$resetLink = "http://localhost/project/reset_password.php?token=$token";

// Prepare the email content
$subject = "Password Reset Link";
$message = "Dear User,\n\n";
$message .= "You have requested to reset your password. Please click on the following link to reset your password:\n";
$message .= $resetLink; // Append the reset link to the message
$message .= "\n\nIf you did not request a password reset, you can safely ignore this email.\n\n";
$message .= "Regards,\nYour Website";

// Set headers
$headers = "From: OTBMS <kipkuruikorir968@gmail.com>\r\n";
$headers .= "Reply-To: kipkuruikorir968@gmail.com\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

// Send the email
if (mail($email, $subject, $message, $headers)) {
    echo "<script> alert('Password reset link sent successfully!') </script>";
} else {
    echo "<script> alert('Failed to send password reset link.') </script>";
}
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
    <title>Login</title>
</head>
<body>
    <div class="login-container">
        <div class="image-container">
            <img src="User/images/hero.png" alt="Login Image">
        </div>
        <div class="form-container">
            <div class="login-form">
                
                <form action="" method="post">
                <div class="form-group">
                            <label for="email">Enter your email<span>*</span></label>
                            <input type="email" id="email" name="email" placeholder="e.g abc@gmail.com" required>
                        </div>
                    <div class="form-group">
                        <button type="submit" name="submit">Submt</button>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
</body>
</html>