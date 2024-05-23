<?php
session_start();
require 'connection.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
        $currentPassword = $_POST['currentPassword'];

        // Verify current password
        if (password_verify($currentPassword, $currentPasswordDB)) {
            $newPassword = $_POST['password'];
            $confirmPassword = $_POST['confirmPassword'];

            // Check if new password and confirm password match
            if ($newPassword === $confirmPassword) {
                $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

                // Update the password in the database
                $updateQuery = "UPDATE members SET password = ? WHERE memberId = ?";
                $updateStmt = mysqli_prepare($conn, $updateQuery);
                mysqli_stmt_bind_param($updateStmt, "si", $hashedPassword, $userID);
                $updateResult = mysqli_stmt_execute($updateStmt);

                if ($updateResult) {
                    echo "<script>
                            alert('Password has been updated successfully.');
                            window.location.href = 'settings.php';
                          </script>";
                    exit();
                } else {
                    $errorMessage = "Failed to update password. Please try again.";
                }
            } else {
                $errorMessage = "New password and confirm password do not match. Please try again.";
            }
        } else {
            $errorMessage = "Current password is incorrect. Please try again.";
        }
    } else {
        $errorMessage = "Unable to fetch current password. Please try again later.";
    }

    echo "<script>
            alert('$errorMessage');
            window.location.href = 'settings.php';
          </script>";
    exit();
}

// Close database connection
mysqli_close($conn);
?>

