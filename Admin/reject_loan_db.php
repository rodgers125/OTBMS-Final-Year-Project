<?php
require "connection.php";


// Check if the requestId is set and not empty
if (isset($_POST['requestId']) && !empty($_POST['requestId'])) {
    // Sanitize the input
    $requestId = intval($_POST['requestId']); // Ensure it's an integer

    // Delete record from loan_requests table
    $deleteQuery = "DELETE FROM loan_requests WHERE requestId = ?";
    $stmt = mysqli_prepare($conn, $deleteQuery);
    mysqli_stmt_bind_param($stmt, "i", $requestId);
    $deleteResult = mysqli_stmt_execute($stmt);

    if ($deleteResult) {
        // Send success response to the client
        echo "<script>
    alert('Loan request rejected successfully.');
    // Redirect to loan_request.php
    window.location.href = 'loan_request.php';
    </script>";
    } else {
        // Send error response to the client
        echo "Failed to Reject loan request.";
    }
} else {
    // Send error response to the client if requestId is not provided
    echo "Request ID is missing.";
}





// Close the database connection
mysqli_close($conn);


?>