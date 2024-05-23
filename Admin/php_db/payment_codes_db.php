<?php
require 'connection.php';

// SQL query to select data from the payments_proof table
$query = "SELECT pp.payment_id, pp.member_id, CONCAT(m.fName, ' ', m.lName) AS fullName, pp.payment_date, pp.payment_method,
          pp.purpose, pp.payment_proof_code, pp.loan_id
          FROM payments_proof pp
          JOIN members m ON pp.member_id = m.memberId
          WHERE pp.purpose = 'loanRepayment'
          ORDER BY pp.payment_date DESC";
$result = mysqli_query($conn, $query);

// Check if there are any rows returned
if (mysqli_num_rows($result) > 0) {
    echo "<h2>Loan Repayment</h2>";
    echo "<table>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>Member ID</th>";
    echo "<th>Full Name</th>";
    echo "<th>Date</th>";    
    echo "<th>Payment Method</th>";
    echo "<th>Loan ID</th>";
    echo "<th>Code</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";

    // Loop through each row in the result set
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['member_id'] . "</td>";
        echo "<td>" . $row['fullName'] . "</td>";
        echo "<td>" . $row['payment_date'] . "</td>";        
        echo "<td>" . $row['payment_method'] . "</td>";
        echo "<td>" . $row['loan_id'] . "</td>";
        echo "<td>" . $row['payment_proof_code'] . "</td>";

        echo "</tr>";
    }

    echo "</tbody>";
    echo "</table>";
    echo "<br>";
    echo "<br>";
} 



//for contribution
$query = "SELECT pp.payment_id, pp.member_id, CONCAT(m.fName, ' ', m.lName) AS fullName, pp.payment_date, pp.payment_method,
          pp.purpose, pp.payment_proof_code, pp.contribution_id
          FROM payments_proof pp
          JOIN members m ON pp.member_id = m.memberId
          WHERE pp.purpose = 'contribution'
          ORDER BY pp.payment_date DESC";
$contribution_result = mysqli_query($conn, $query);

if (mysqli_num_rows($contribution_result) > 0) {
    echo "<h2>Contribution Payment</h2>";
    echo "<table>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>Member ID</th>";
    echo "<th>Full Name</th>";
    echo "<th>Date</th>";    
    echo "<th>Payment Method</th>";
    echo "<th>Contribution ID</th>";
    echo "<th>Code</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";

    // Loop through each row in the result set
    while ($row = mysqli_fetch_assoc($contribution_result)) {
        echo "<tr>";
        echo "<td>" . $row['member_id'] . "</td>";
        echo "<td>" . $row['fullName'] . "</td>";
        echo "<td>" . $row['payment_date'] . "</td>";        
        echo "<td>" . $row['payment_method'] . "</td>";
        echo "<td>" . $row['contribution_id'] . "</td>";
        echo "<td>" . $row['payment_proof_code'] . "</td>";

        echo "</tr>";
    }

    echo "</tbody>";
    echo "</table>";
} 

// Close the database connection
mysqli_close($conn);
?>
