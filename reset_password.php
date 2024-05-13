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