<?php
require "connection.php";

// Approving of loan
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

        // Insert data into the loan table using prepared statement
        $insertQuery = "INSERT INTO loan (loanAmount, loanPurpose, member_id, loanStatus, repayment_period) VALUES (?, ?, ?, ?, ?)";
        $loanStatus = 'active'; // Default value for loanStatus
        $stmt = mysqli_prepare($conn, $insertQuery);
        mysqli_stmt_bind_param($stmt, "dssss", $row['loanAmount'], $row['loanType'], $row['memberId'], $loanStatus, $row['loanPeriod']);
        $insertResult = mysqli_stmt_execute($stmt);

        // Delete record from loan_requests table
        $deleteQuery = "DELETE FROM loan_requests WHERE requestId = ?";
        $stmt = mysqli_prepare($conn, $deleteQuery);
        mysqli_stmt_bind_param($stmt, "i", $requestId);
        $deleteResult = mysqli_stmt_execute($stmt);

        if ($insertResult && $deleteResult) {
            // Send success response to the client
            echo "<script>
            alert('Loan request Approved successfully and now visible in Loan List Page');
            // Redirect to loan_request.php
            window.location.href = 'loan_request.php';
            </script>";
        } else {
            // Send error response to the client
            echo "Failed  to approve the loan.";
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