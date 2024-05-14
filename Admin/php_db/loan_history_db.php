<?php
require 'connection.php';

// Fetch data from the loan_history table
$query = "SELECT lh.loan_history_id, m.fName, m.lName, lh.loan_amount, lh.loan_purpose, lh.date_cleared, lh.loanId
          FROM loan_history lh
          INNER JOIN members m ON lh.member_id = m.memberId";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    echo '<div class="table">
            <h2>List of Loans Borrowed up to date</h2>
            <table>
                <thead>
                    <tr>
                        <th>Loan ID</th>
                        <th>Full Name</th>
                        <th>Loan Amount</th>
                        <th>Loan Type</th>
                        <th>Date Cleared</th>
                        <th>Transaction Details</th>
                    </tr>
                </thead>
                <tbody>';

    while ($row = mysqli_fetch_assoc($result)) {
        // Format loan amount with currency symbol and commas
        $formattedLoanAmount = "KSH " . number_format($row['loan_amount'], 2);

        // Output table row with loan data
        echo "<tr>
                <td>{$row['loan_history_id']}</td>
                <td>{$row['fName']} {$row['lName']}</td>
                <td>{$formattedLoanAmount}</td>
                <td>{$row['loan_purpose']}</td>
                <td>{$row['date_cleared']}</td>
                <td>
                <button class='view-btn' onclick='openDetailsModal({$row['loanId']})'>View Details</button>
                </td>
              </tr>";
    }

    echo '</tbody>
        </table>
        <div class="btn-download">
            <button onclick="printTable()">Print</button>
        </div>
    </div>';
} else {
    echo 'No loans found.';
}

// Close the database connection
mysqli_close($conn);
?>
