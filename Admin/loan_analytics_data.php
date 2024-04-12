<?php

require_once 'connection.php';

// Query to fetch loan data
$query = "SELECT loan_amount, loan_purpose FROM loan_history" ; 
$result = mysqli_query($conn, $query);

$personalLoanTotal = 0;
$businessLoanTotal = 0;

// Loop through the data to calculate totals
while ($row = mysqli_fetch_assoc($result)) {
    if ($row['loan_purpose'] === 'personal') {
        $personalLoanTotal += $row['loan_amount'];
    } elseif ($row['loan_purpose'] === 'business') {
        $businessLoanTotal += $row['loan_amount'];
    }
}

// Return totals as JSON
echo json_encode(array(
    'personalLoanTotal' => $personalLoanTotal,
    'businessLoanTotal' => $businessLoanTotal
));

?>



