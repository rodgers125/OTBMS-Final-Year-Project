<?php

require 'connection.php';

// Fetch user ID from session
$user_id = $_SESSION['user_id'];



// Query to fetch user's active loans
$query = "SELECT loanId, loanPurpose, loanAmount, repayment_period, loanStatus 
          FROM loan 
          WHERE member_id = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($result && mysqli_num_rows($result) > 0) {
    // Start the active loans table
    echo '<div class="table">
            <h2>Active Loans</h2>
            <table>
                <thead>
                    <tr>
                        <th>Loan Id</th>
                        <th>Loan Purpose</th>
                        <th>Amount</th>
                        <th>Repayment Period</th>
                        <th>Loan Status</th>                   
                    </tr>
                </thead>
                <tbody>';

    // Loop through each loan record and output table rows
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr>
                <td>' . $row['loanId'] . '</td>
                <td>' . $row['loanPurpose'] . '</td>
                <td>' . $row['loanAmount'] . '</td>
                <td>' . $row['repayment_period'] . '</td>
                <td>' . $row['loanStatus'] . '</td>
              </tr>';
    }

    // Close the loan history table
    echo '</tbody>
          </table>
        </div>
        </br></br>';
} 










// Query to fetch user's loan history
$query = "SELECT loan_history_id, loan_purpose, loan_amount, repayment_period, date_cleared 
          FROM loan_history 
          WHERE member_id = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($result && mysqli_num_rows($result) > 0) {
    // Start the loan history table
    echo '<div class="table">
            <h2>Loan History</h2>
            <table>
                <thead>
                    <tr>
                        <th>Loan Id</th>
                        <th>Loan Purpose</th>
                        <th>Amount</th>
                        <th>Repayment Period</th>                        
                        <th>Date Cleared</th>                   
                    </tr>
                </thead>
                <tbody>';

    // Loop through each loan record and output table rows
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr>
                <td>' . $row['loan_history_id'] . '</td>
                <td>' . $row['loan_purpose'] . '</td>
                <td>' . $row['loan_amount'] . '</td>
                <td>' . $row['repayment_period'] . '</td>                
                <td>' . $row['date_cleared'] . '</td>
              </tr>';
    }

    // Close the loan history table
    echo '</tbody>
          </table>
        </div>';
} else {
    // If no loan history found, display a message
    echo 'No loan history found.';
}

// Close the database connection
mysqli_close($conn);
?>