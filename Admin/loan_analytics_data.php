<?php

require_once 'connection.php';

// Query to fetch loan data
$query = "SELECT loanAmount, loanPurpose FROM loan" ; 
$result = mysqli_query($conn, $query);

$personalLoanTotal = 0;
$businessLoanTotal = 0;

// Loop through the data to calculate totals
while ($row = mysqli_fetch_assoc($result)) {
    if ($row['loanPurpose'] === 'personal') {
        $personalLoanTotal += $row['loanAmount'];
    } elseif ($row['loanPurpose'] === 'business') {
        $businessLoanTotal += $row['loanAmount'];
    }
}

// Return totals as JSON
echo json_encode(array(
    'personalLoanTotal' => $personalLoanTotal,
    'businessLoanTotal' => $businessLoanTotal
));

?>



