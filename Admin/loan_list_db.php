<?php
require_once 'connection.php';

// SQL query to retrieve data from the loan table
$query = "SELECT l.loanId, CONCAT(m.fName, ' ', m.lName) AS fullName, l.loanPurpose, l.loanAmount, l.repayment_period, l.loanStatus
          FROM loan l 
          JOIN members m ON l.member_id = m.memberId
          WHERE l.loanStatus != 'paid'";

$result = mysqli_query($conn, $query);

// Check for errors
if (!$result) {
    echo "Error: " . mysqli_error($conn);
    exit;
}

// Check if there are any rows returned
if (mysqli_num_rows($result) > 0) {
    echo '<div class="table">';
    echo '<h2>Loan Details</h2>';
    echo '<table>';
    echo '<thead>';
    echo '<tr>';
    echo '<th>Loan ID</th>';
    echo '<th>Full Name</th>';                
    echo '<th>Loan Purpose</th>';
    echo '<th>Amount</th>';                
    echo '<th>Repayment Period</th>';
    echo '<th>Status</th>';
    echo '<th>Action</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';

    // Loop through the fetched data and output each row in the table
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr>';
        echo '<td>' . $row['loanId'] . '</td>';
        echo '<td>' . $row['fullName'] . '</td>';                
        echo '<td>' . $row['loanPurpose'] . '</td>';
        echo '<td>KSH ' . number_format($row['loanAmount'], 2) . '</td>';                
        echo '<td>' . $row['repayment_period'] . '</td>';
        echo '<td>' . $row['loanStatus'] . '</td>';
        echo '<td>';
        // Add button for action (e.g., mark as paid)
        echo '<button class="btn-paid" onclick="markAsPaid(' . $row['loanId'] . ')">Mark Cleared</button>';
        echo '</td>';
        echo '</tr>';
    }

    echo '</tbody>';
    echo '</table>';
    echo '</div>';
} else {
    echo "No loans found.";
}

// Free result set
mysqli_free_result($result);

// Close the database connection
mysqli_close($conn);
?>
