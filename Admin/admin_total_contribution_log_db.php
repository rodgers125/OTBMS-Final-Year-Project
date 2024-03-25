<?php
require 'connection.php';

// Initialize total contribution amount
$totalContribution = 0;

// SQL query to calculate the total contributions
$query = "SELECT SUM(amount) AS total_contribution FROM contribution_log";
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
