<?php
require 'connection.php';

// SQL query to select data from the transactions table
$query = "SELECT ts.transaction_id, ts.member_id, CONCAT(m.fName, ' ', m.lName) AS fullName, ts.transaction_date, ts.transaction_amount,
          ts.transaction_method, ts.transaction_purpose, ts.payment_code
          FROM transactions ts
          JOIN members m ON ts.member_id = m.memberId
          ORDER BY transaction_date DESC";

$result = mysqli_query($conn, $query);

// Check if there are any rows returned
if (mysqli_num_rows($result) > 0) {
    echo "<table>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>#</th>";
    echo "<th>Full Name</th>";
    echo "<th>Date and Time</th>";
    echo "<th>Amount</th>";
    echo "<th>Payment Method</th>";
    echo "<th>Purpose</th>";
    echo "<th>Code</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";

    // Loop through each row in the result set
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['transaction_id'] . "</td>";
        echo "<td>" . $row['fullName'] . "</td>";
        echo "<td>" . $row['transaction_date'] . "</td>";
        echo "<td>KSH " . number_format($row['transaction_amount'], 2) . "</td>";
        echo "<td>" . $row['transaction_method'] . "</td>";
        echo "<td>" . $row['transaction_purpose'] . "</td>";
        echo "<td>" . $row['payment_code'] . "</td>";
        echo "</tr>";
    }

    echo "</tbody>";
    echo "</table>";
} else {
    echo "No transactions found.";
}

// Close the database connection
mysqli_close($conn);
?>
