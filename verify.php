<?php
require 'User/connection.php';

if (isset($_GET['code'])) {
    $verificationCode = $_GET['code'];

    $query = "SELECT memberId FROM members WHERE verification_code = ? AND verification = 'unverified'";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $verificationCode);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $memberId = $row['memberId'];

        // Update the verification status
        $updateQuery = "UPDATE members SET verification = 'verified', verification_code = NULL WHERE memberId = ?";
        $updateStmt = mysqli_prepare($conn, $updateQuery);
        mysqli_stmt_bind_param($updateStmt, "i", $memberId);
        mysqli_stmt_execute($updateStmt);

        echo "<script>alert('Email verified successfully. You can now login.'); window.location.href = 'login.php';</script>";
    } else {
        echo "<script>alert('Invalid or expired verification link.'); window.location.href = 'register.php';</script>";
    }
} else {
    echo "<script>alert('No verification code provided.'); window.location.href = 'register.php';</script>";
}
?>
