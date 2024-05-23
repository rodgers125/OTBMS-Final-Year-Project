<?php
require 'connection.php';

function calculateLoanLimit($userId, $conn) {
    // Fetch user contributions
    $query_contributions = "SELECT SUM(amount) AS total_contributions FROM contributionlog WHERE member_id = ?";
    $stmt_contributions = mysqli_prepare($conn, $query_contributions);
    mysqli_stmt_bind_param($stmt_contributions, "i", $userId);
    mysqli_stmt_execute($stmt_contributions);
    $result_contributions = mysqli_stmt_get_result($stmt_contributions);
    $row_contributions = mysqli_fetch_assoc($result_contributions);
    $total_contributions = $row_contributions['total_contributions'] ?? 0;

    // Fetching user’s existing loans
    $query_existing_loans = "SELECT SUM(loanAmount) AS total_loans FROM loan WHERE member_id = ?";
    $stmt_existing_loans = mysqli_prepare($conn, $query_existing_loans);
    mysqli_stmt_bind_param($stmt_existing_loans, "i", $userId);
    mysqli_stmt_execute($stmt_existing_loans);
    $result_existing_loans = mysqli_stmt_get_result($stmt_existing_loans);
    $row_existing_loans = mysqli_fetch_assoc($result_existing_loans);
    $total_loans = $row_existing_loans['total_loans'] ?? 0;

    // Fetch repayment history (sum of all repayments)
    $query_repayments = "SELECT SUM(loan_amount) AS total_repayments FROM loan_history WHERE member_id = ?";
    $stmt_repayments = mysqli_prepare($conn, $query_repayments);
    mysqli_stmt_bind_param($stmt_repayments, "i", $userId);
    mysqli_stmt_execute($stmt_repayments);
    $result_repayments = mysqli_stmt_get_result($stmt_repayments);
    $row_repayments = mysqli_fetch_assoc($result_repayments);
    $total_repayments = $row_repayments['total_repayments'] ?? 0;

    

    // Example calculation logic
    $base_limit = 500;//loan limit before any calculations.
    $contribution_factor = $total_contributions * 0.1; // 10% of total contributions
    $existing_loan_penalty = $total_loans * 0.2; // 20% of total existing loans
    $repayment_bonus = $total_repayments * 0.05; // 5% of total repayments
    

    // Calculate final loan limit
    $loan_limit = $base_limit + $contribution_factor + $repayment_bonus - $existing_loan_penalty;
    $loan_limit = max($loan_limit, 100); // minimum loan limit that can be borrowed

    return $loan_limit;
}

// Example usage
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $loan_limit = calculateLoanLimit($user_id, $conn);

    // Update the loan limit in the database
    $update_query = "UPDATE members SET loan_limit = ? WHERE memberId = ?";
    $stmt_update = mysqli_prepare($conn, $update_query);
    mysqli_stmt_bind_param($stmt_update, "di", $loan_limit, $user_id);
    mysqli_stmt_execute($stmt_update);

    
}
?>
