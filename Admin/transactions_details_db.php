<?php
require_once 'connection.php';

// Check if loanId parameter is received via POST
if (isset($_POST['loanId'])) {
    // Sanitize the loanId to prevent SQL injection
    $loanId = mysqli_real_escape_string($conn, $_POST['loanId']);

    // Query to fetch transaction details based on loanId
    $query = "SELECT * FROM transactions WHERE loan_id_for_payment = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $loanId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // Initialize response object
    $response = array();

    if ($result && mysqli_num_rows($result) > 0) {
        // Fetch the first row (assuming there's only one transaction per loanId)
        $row = mysqli_fetch_assoc($result);

        // Populate response with transaction details
        $response['transaction_id'] = $row['transaction_id'];
        $response['transaction_date'] = $row['transaction_date'];
        $response['transaction_amount'] = $row['transaction_amount'];
        $response['transaction_method'] = $row['transaction_method'];
    } else {
        // No transactions found for the provided loanId
        $response['error'] = 'No transactions found for the provided loan ID.';
    }

    // Send JSON response back to the AJAX request
    echo json_encode($response);
} else {
    // loanId parameter is missing
    $response['error'] = 'Loan ID is missing.';
    echo json_encode($response);
}
?>
