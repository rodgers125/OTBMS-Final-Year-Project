<?php
require 'connection.php'; // Connect to the database

// Check if notification ID is provided via GET request
if (isset($_GET['id'])) {
    $notification_id = $_GET['id'];

    // Prepare the SQL query to delete the notification
    $query = "DELETE FROM notification WHERE notification_id = ?";
    
    // Use a prepared statement to prevent SQL injection
    $stmt = mysqli_prepare($conn, $query);
    
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $notification_id);
        mysqli_stmt_execute($stmt);

        // Check if the delete operation was successful
        $success = mysqli_stmt_affected_rows($stmt) > 0;
        $response = ['success' => $success];
        
        mysqli_stmt_close($stmt);
    } else {
        // If the prepared statement fails
        $response = ['success' => false, 'error' => mysqli_error($conn)];
    }

    // Send JSON response indicating success or failure
    echo json_encode($response);
}
?>
