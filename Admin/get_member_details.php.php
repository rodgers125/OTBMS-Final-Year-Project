<?php
// Assume you have a function to fetch member details based on memberId
// Replace the following lines with your actual fetching logic

$memberId = $_GET['memberId'];

// Sample data (replace with actual database query)
$memberDetails = [
    'dateJoined' => '3/3/2014',
    'totalContributions' => 'KSH 10000',
    'lastContribution' => 'KSH 3000',
    'totalLoansBorrowed' => 'KSH 40000',
    'totalLoansRepaid' => 'KSH 30000',
    'loanLimit' => 'KSH 50000',
    'loanBalance' => 'KSH 6000'
];

// Return JSON response
echo json_encode($memberDetails);
?>
