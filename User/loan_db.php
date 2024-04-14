<?php

// Fetch user ID from session
$user_id = $_SESSION['user_id'];

// Query to calculate total loan balance for the user
$query = "SELECT SUM(loanAmount) AS total_loan_balance FROM loan WHERE member_id = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($result && mysqli_num_rows($result) > 0) {
    // Fetch total loan balance from the result
    $row = mysqli_fetch_assoc($result);
    $total_loan_balance = $row['total_loan_balance'];

   
}
else {
    // If no loan balance found, set total loan balance to 0
    $total_loan_balance = "NAN";
}
?>
