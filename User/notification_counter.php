<?php
require 'connection.php';

$userID = $_SESSION['user_id'];

// Query to count notifications for the logged-in user
$countQuery = "SELECT COUNT(*) AS notification_count FROM notification WHERE member_id = ?";
$countStmt = mysqli_prepare($conn, $countQuery);
mysqli_stmt_bind_param($countStmt, "i", $userID);
mysqli_stmt_execute($countStmt);
$countResult = mysqli_stmt_get_result($countStmt);
$row = mysqli_fetch_assoc($countResult);
$notificationCount = $row['notification_count'];
?>