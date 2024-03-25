<?php

require "connection.php";

// SQL query to select data from the loan_requests table
$query = "SELECT requestId, memberId, requestDate, loanAmount, loanType FROM loan_requests
         
         ORDER BY requestDate DESC LIMIT 3";
$result = mysqli_query($conn, $query);

// Check if there are any rows returned
if (mysqli_num_rows($result) > 0) {
    echo "<h2>Loan Requests</h2>";
    echo "<table>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>Request ID</th>";
    echo "<th>Member ID</th>";   
    echo "<th>Date</th>";
    echo "<th>Loan Amount</th>";
    echo "<th>Purpose</th>";
    echo "<th></th>"; // Empty cell for the "View" button
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";

    // Loop through each row in the result set
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['requestId'] . "</td>";
        echo "<td>" . $row['memberId'] . "</td>";       
        echo "<td>" . $row['requestDate'] . "</td>";
        echo "<td>KSH " . number_format($row['loanAmount'], 2) . "</td>"; // Format loan amount with currency symbol and commas
        echo "<td>" . $row['loanType'] . "</td>";
        echo "<td><button class='btn-view'>View</button></td>";
        echo "</tr>";
    }

    echo "</tbody>";
    echo "</table>";
} else {
    echo "No loan requests found.";
}

// Close the database connection
mysqli_close($conn);
?>
