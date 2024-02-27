<?php
require 'connection.php';

if (isset($_GET['id'])) {
    $event_id = $_GET['id'];

    // if event_id' is the primary key
    $query = "DELETE FROM events WHERE event_id = ?";

    // prepared statement to prevent SQL injection
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $event_id);
        mysqli_stmt_execute($stmt);

        // Check if the delete operation was successful
        if (mysqli_stmt_affected_rows($stmt) > 0) {
            $response = ['success' => true];
        } else {
            $response = ['success' => false];
        }

        mysqli_stmt_close($stmt);
    } else {
        $response = ['success' => false];
    }

    echo json_encode($response);
} else {
    $response = ['success' => false];
    echo json_encode($response);
}
?>