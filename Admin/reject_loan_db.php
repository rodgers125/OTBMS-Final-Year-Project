<?php
require "connection.php";

// Check if the requestId is set and not empty
if (isset($_POST['requestId']) && !empty($_POST['requestId'])) {
    // Sanitize the input
    $requestId = intval($_POST['requestId']); // Ensure it's an integer

    // Fetch loan request details from loan_requests table using prepared statement
    $query = "SELECT * FROM loan_requests WHERE requestId = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $requestId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // Delete record from loan_requests table
        $deleteQuery = "DELETE FROM loan_requests WHERE requestId = ?";
        $stmt = mysqli_prepare($conn, $deleteQuery);
        mysqli_stmt_bind_param($stmt, "i", $requestId);
        $deleteResult = mysqli_stmt_execute($stmt);

        if ($deleteResult) {
            // Generate notification message
            $notificationMessage = "Your loan request of KSH".$row['loanAmount']." for ".$row['loanType']." use has been rejected.";

            // Insert notification into the notification table
            $notificationQuery = "INSERT INTO notification (member_id, notification_date_time, title, message) VALUES (?, NOW(), 'Loan Request Rejected', ?)";
            $stmt = mysqli_prepare($conn, $notificationQuery);
            mysqli_stmt_bind_param($stmt, "is", $row['memberId'], $notificationMessage);
            mysqli_stmt_execute($stmt);

            // Send success response to the client
            echo "<script>
            alert('Loan request rejected successfully.');
            // Redirect to loan_request.php
            window.location.href = 'loan_request.php';
            </script>";
        } else {
            // Send error response to the client
            echo "Failed to reject the loan request.";
        }
    } else {
        // Send error response to the client if loan request not found
        echo "Loan request not found.";
    }
} else {
    // Send error response to the client if requestId is not provided
    echo "Request ID is missing.";
}

// Close the database connection
mysqli_close($conn);
?>
