<?php
require 'connection.php';

if (isset($_GET['id'])) {
    $contributionId = $_GET['id'];

    // Assuming 'contributions' is the name of your table and 'contid' is the primary key
    $query = "DELETE FROM contributions WHERE contid = ?";

    // Use prepared statement to prevent SQL injection
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $contributionId);
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
