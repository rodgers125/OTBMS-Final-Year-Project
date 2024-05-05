<?php
require 'connection.php';

// Check if notification ID is provided via GET request
if (isset($_GET['id'])) {
    $notification_id = $_GET['id'];

    // Query to fetch the notification message and title based on the provided ID
    $query = "SELECT title, message FROM notification WHERE notification_id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $notification_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) > 0) {
        // Fetch the notification title and message
        $row = mysqli_fetch_assoc($result);
        $title = $row['title'];
        $message = $row['message'];

        // Output the notification title and message as JSON
        echo json_encode(array('title' => $title, 'message' => $message));
    } else {
        // If no notification found with the provided ID
        echo json_encode(array('title' => 'Notification not found', 'message' => ''));
    }
} else {
    // If no notification ID provided
    echo json_encode(array('title' => 'Invalid request', 'message' => ''));
}
?>
