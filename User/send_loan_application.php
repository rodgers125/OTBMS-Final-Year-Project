<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include the database connection file
    require_once "connection.php";

    // Get form data and sanitize inputs
    $loanType = $_POST["loanType"];
    $loanAmount = $_POST["loanAmount"];
    $loanPeriod = $_POST["repaymentPeriod"];

    // Prepare and execute the SQL statement to insert data into the loan_requests table
    $query = "INSERT INTO loan_requests (loanType, loanAmount, loanPeriod) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        // Bind parameters and execute the statement
        mysqli_stmt_bind_param($stmt, "sds", $loanType, $loanAmount, $loanPeriod);
        mysqli_stmt_execute($stmt);

        // Check if the query was successful
        if (mysqli_stmt_affected_rows($stmt) > 0) {
            echo "<script>alert('Loan application submitted successfully. Now Wait for Loan Approval');";
            echo "window.location.href = 'loan.php';</script>";
            exit();
        } else {
            echo "<script>alert('Failed to submit loan application');</script>";
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
