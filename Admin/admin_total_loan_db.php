<?php
require 'connection.php';

// Initialize variables
$total_loan_amount = 0;

// SQL query to calculate the total amount of loans issued out
$query = "SELECT SUM(loanAmount) AS total_loan_amount FROM loan";
$result = mysqli_query($conn, $query);

// Check if the query was successful
if ($result) {
    // Fetch the total loan amount
    $row = mysqli_fetch_assoc($result);
    $total_loan_amount = $row['total_loan_amount'];

    // Format the total loan amount with currency symbol and commas
    $formatted_total_loan_amount = number_format($total_loan_amount, 2);

    // Output the result
    echo $formatted_total_loan_amount;
} else {
    // Display an error message if the query fails
    echo "Error executing query: " . mysqli_error($conn);
}

// Close the result set
mysqli_free_result($result);

// Close the database connection
mysqli_close($conn);
?>
