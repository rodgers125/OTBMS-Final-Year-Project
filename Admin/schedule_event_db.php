<?php
require 'session.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $event_title = $_POST['event_title'];
    $event_description = $_POST['event_description'];
    $event_type = $_POST['event_type'];
    $event_date = $_POST['event_date'];

    // SQL query to insert data into the "events" table
    $query = "INSERT INTO events (event_title, event_description, event_type, event_date) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        // Bind parameters and execute the statement
        mysqli_stmt_bind_param($stmt, "ssss", $event_title, $event_description, $event_type, $event_date);
        mysqli_stmt_execute($stmt);

        // Check for success
        if (mysqli_stmt_affected_rows($stmt) > 0) {
            echo "<script>alert('Event has been scheduled successfully');</script>";
        } else {
            echo "<script>alert('Failed to Schedule the event');</script>";
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        echo "<script>alert('Error in prepared statement');</script>";
    }

    // Close the database connection
    mysqli_close($conn);
}


?>