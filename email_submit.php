<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';


require 'User/connection.php';


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
            echo "";
        } else {
            echo "" . mysqli_error($conn);
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
$message .= "Regards,\nROYWEA";

// Set headers
$headers = "From: OTBMS <kipkuruikorir968@gmail.com>\r\n";
$headers .= "Reply-To: kipkuruikorir968@gmail.com\r\n";

$mail = new PHPMailer(true);

$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'kipkuruikorir968@gmail.com';
$mail->Password = 'strlujcjgyzvkvnf';
$mail->SMTPSecure = 'ssl';
$mail->Port = 465;

$mail->setFrom('kipkuruikorir968@gmail.com');
$mail->addAddress($email);
$mail->isHTML(true);

$mail->Subject = $subject;
$mail->Body = $message;

$mail->send();


/// Send the email
if (mail($email, $subject, $message, $headers)) {
    echo "<script> alert('Password reset link sent successfully! Check your Email Inbox.') </script>";
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