<?php
require_once 'connection.php';

if (isset($_REQUEST['loanId'])) {
    // Sanitize the input to prevent SQL injection
    $loanId = mysqli_real_escape_string($conn, $_REQUEST['loanId']);

    // Query to fetch data from the transactions table
    $query = "SELECT * FROM transactions WHERE loan_id_for_payment = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $loanId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) > 0) {
        // Initialize variables to store transaction details
        $transaction_id = '';
        $transaction_date = '';
        $transaction_amount = '';
        $transaction_method = '';

        // Loop through each transaction
        while ($row = mysqli_fetch_assoc($result)) {
            // Store transaction details in variables
            $transaction_id = $row['transaction_id'];
            $transaction_date = $row['transaction_date'];
            $transaction_amount = $row['transaction_amount'];
            $transaction_method = $row['transaction_method'];
        }
    } else {
        // No transactions found for the provided loanId
        $transaction_id = 'N/A';
        $transaction_date = 'N/A';
        $transaction_amount = 'N/A';
        $transaction_method = 'N/A';
    }
} else {
    // loanId parameter is missing
    $transaction_id = 'N/A';
    $transaction_date = 'N/A';
    $transaction_amount = 'N/A';
    $transaction_method = 'N/A';
}
?>
