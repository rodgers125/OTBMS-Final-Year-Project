<?php
require 'connection.php';

// Initialize total contribution amount
$totalContribution = 0;
$current_month = date('m');
$current_year = date('Y');

// SQL query to calculate the total contributions
$query = "SELECT SUM(transaction_amount) AS total_contribution FROM transactions
          WHERE transaction_purpose = 'contribution'
          AND MONTH(transaction_date) = $current_month
          AND YEAR(transaction_date) = $current_year";
$result = mysqli_query($conn, $query);

if ($result) {
    // Fetch the total contribution amount
    $row = mysqli_fetch_assoc($result);
    $totalContribution = $row['total_contribution'];

    if ($totalContribution === null) {
        $totalContribution = 0.00;
    }
} else {
    // Handle error if the query fails
    echo "Error executing query: " . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);

// Return the total contribution amount
echo $totalContribution;
?>

