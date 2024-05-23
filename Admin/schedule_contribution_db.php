<?php
require_once 'connection.php'; // Include your database connection file

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    // Get form data
    $cont_amount = $_POST['contributionAmount'];
    $cont_dateline = $_POST['contribution_date'];    
    $member_id = $_POST['memberId'];
  
    // Prepare and execute SQL statement to insert data into the table
    $stmt = $conn->prepare("INSERT INTO contribution_schedule (cont_amount, cont_dateline, member_id) VALUES (?, ?, ?)");
    
    // Bind parameters
    $stmt->bind_param("dsi", $cont_amount, $cont_dateline, $member_id);
    
    // Execute the statement
    if ($stmt->execute()) {
        echo "<script>alert('Contribution scheduled successfully');</script>";

        echo "<script>window.location.href = 'schedule_contribution.php';</script>";
            exit();
        // Redirect to a success page or display a success message
    } else {
        echo "<script>alert('Failed to schedule contribution');</script>";
        // Handle error
    }

    // Close statement
    $stmt->close();
    
    // Close connection
    $conn->close();
}
?>
