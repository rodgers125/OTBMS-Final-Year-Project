<?php
require "connection.php";

// SQL query to select data from the loan_requests table
$query = "SELECT lr.requestId, lr.memberId, lr.requestDate, lr.loanAmount, lr.loanType, lr.loanPeriod, CONCAT(m.fName, ' ', m.lName) AS fullName
        FROM loan_requests lr
          JOIN members m ON lr.memberId = m.memberId
         
         ORDER BY requestDate DESC";
$result = mysqli_query($conn, $query);

// Check if there are any rows returned
if (mysqli_num_rows($result) > 0) {
    echo "<h2>Loan Requests</h2>";
    echo "<table>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>Date</th>";
    echo "<th>Request ID</th>"; 
    echo "<th>Name</th>";        
    echo "<th>Loan Amount</th>";
    echo "<th>Purpose</th>";
    echo "<th>Period</th>";
    echo "<th>Action</th>"; // Fixed the column header
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";

    // Loop through each row in the result set
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['requestDate'] . "</td>";
        echo "<td>" . $row['requestId'] . "</td>";
        echo "<td>" . $row['fullName'] . "</td>";     
        echo "<td>KSH " . number_format($row['loanAmount'], 2) . "</td>"; // Format loan amount with currency symbol and commas
        echo "<td>" . $row['loanType'] . "</td>";
        echo "<td>" . $row['loanPeriod'] . "</td>";
        echo "<td>
        
        <button class='btn-approve' onclick='approveLoan(" . $row['requestId'] . ")'>Approve</button>
        <button class='btn-reject' onclick='rejectLoan(" . $row['requestId'] . ")'>Reject</button>
        </td>";
        
        echo "</tr>";
    }

    echo "</tbody>";
    echo "</table>";
} else {
    echo "No loan requests at the moment.";
}



// Close the database connection
mysqli_close($conn);
?>
