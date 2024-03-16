<?php
require 'connection.php';

if (isset($_POST["submit"])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Use prepared statement to prevent SQL injection
    $query = "SELECT memberid, password, status FROM members WHERE email = ?";
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $user = mysqli_fetch_assoc($result);

        if ($user && password_verify($password, $user['password'])) {
            if ($user['status'] === 'active') {
                // Start the session
                session_start();

                // Set the session variables
                $_SESSION['user_id'] = $user['memberid'];

                // Close the prepared statement
                mysqli_stmt_close($stmt);

                // Redirect to the admin dashboard
                header("Location: admin.php");
                exit;
            } else {
                echo "<script>alert('This account is inactive. Please contact the administrator.');</script>";
            }
        } else {
            echo "<script>alert('Incorrect email or password');</script>";
        }


        // Close the prepared statement
        mysqli_stmt_close($stmt);
    } else {
        echo "<script>alert('Error in prepared statement');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="admin.css">
    <title>Login</title>
</head>
<body>
    <div class="login-container">
        <div class="image-container">
            <img src="images/hero.png" alt="Login Image">
        </div>
        <div class="form-container">
            <div class="login-form">
                <h2>Login</h2>
                <form action="" method="post">
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" name="submit">Login</button>
                    </div>
                </form>
                <div class="acc">
                    Don't have an account? <a href="register.php">Register Now</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
