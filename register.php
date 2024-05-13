<?php
require 'User/connection.php';

if (isset($_POST["submit"])) {    
    $fName = $_POST["fName"];
    $lName = $_POST["lName"];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];
    $role = $_POST['role'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    if ($password !== $confirmPassword) {
        echo "<script>alert('Passwords do not match');</script>";
    } else {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // Hash the password

        $query = "INSERT INTO members (fName, lName, email, phone, gender, password, registration_date, role) VALUES (?, ?, ?, ?, ?, ?, NOW(), ?)";
        $preparedSql = mysqli_prepare($conn, $query);

        if ($preparedSql) {
            mysqli_stmt_bind_param($preparedSql, 'sssssss', $fName, $lName, $email, $phone, $gender, $hashedPassword, $role);
            
            try {
                if (mysqli_stmt_execute($preparedSql)) {
                    // Retrieve memberId from members
                    $getMemberIdQuery = "SELECT memberId FROM members WHERE email = ?";
                    $stmt = mysqli_prepare($conn, $getMemberIdQuery);
                    mysqli_stmt_bind_param($stmt, "s", $email);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_bind_result($stmt, $memberId);
                    mysqli_stmt_fetch($stmt);
                    mysqli_stmt_close($stmt);

                    // Insert notification into the notification table
                    $notificationQuery = "INSERT INTO notification (member_id, notification_date_time, title, message) VALUES (?, NOW(), ?, ?)";
                    $notificationStmt = mysqli_prepare($conn, $notificationQuery);
                    
                    if ($notificationStmt) {
                        $title = "Account Creation";
                        $message = "Your account has been successfully created.";
                        mysqli_stmt_bind_param($notificationStmt, 'iss', $memberId, $title, $message);
                        mysqli_stmt_execute($notificationStmt);
                        mysqli_stmt_close($notificationStmt);
                    }

                    echo "<script>
                        if (confirm('Your Account has been Created Successfully. WELCOME!! Click OK to continue to login.')) {
                            window.location.href = 'login.php';
                        }
                    </script>";
                } else {
                    echo "<script>alert('Error in registration');</script>";
                }
            } catch (mysqli_sql_exception $exception) {
                // Handle duplicate entry error
                if ($exception->getCode() == 1062) { // MySQL error code for duplicate entry
                    echo "<script>alert('The email entered already exists. Please try again!');</script>";
                } else {
                    echo "<script>alert('An unexpected error occurred');</script>";
                }
            }
        } else {
            echo "<script>alert('Error in prepared statement');</script>";
        }

        mysqli_stmt_close($preparedSql);
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="User/css/register.css">
    <link rel="stylesheet" href="User/css/login.css">
    <link rel="stylesheet" href="User/css/admin.css">
    <title>Register</title>
</head>
<body>
    <form action="" method="post">

        <div class="login-container">
            
            <div class="form-container">
                <div class="register-form">
                    <h2>Register</h2>

                    <div class="grid-container">
                        <div class="form-group">
                            <label for="firstname">First Name<span>*</span></label>
                            <input type="text" id="fName" name="fName" placeholder="e.g Andrew" required>
                        </div>
                        <div class="form-group">
                            <label for="lastname">Last Name<span>*</span></label>
                            <input type="text" id="lName" name="lName" placeholder="e.g maina" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email<span>*</span></label>
                            <input type="email" id="email" name="email" placeholder="e.g abc@gmail.com" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone Number<span>*</span></label>
                            <input type="text" id="phone" name="phone" pattern="07\d{8}" placeholder="e.g 0712345678" required>
                            <small class="text-muted">Please enter a 10-digit phone number starting with '07'.</small>
                        </div>
                        <div class="form-group">
                            <label for="password">Password<span>*</span></label>
                            <input type="password" id="password" name="password" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Confirm Password</label>
                            <input type="password" id="ConfirmPassword" name="confirmPassword" required>
                            <p class="error-message" id="passwordError"></p>
                        </div>
                        <div class="form-group">
                            <label for="gender">Gender:</label>
                            <select id="gender" name="gender">
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="role">Role:<span>*</span></label>
                            <select id="role" name="role" required>
                                <option value="admin">Admin</option>
                                <option value="member">Member</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" name="submit">Register</button>
                    </div>
                    <div class="acc">
                        Already have an account? <a href="login.php">Login</a>
                    </div>
                </div>
            </div>
        </div>

    </form>

    <script src="Admin/js/index.js"></script>
</body>

</html>