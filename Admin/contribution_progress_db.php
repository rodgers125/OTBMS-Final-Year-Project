<?php
require 'connection.php';

// Get the current month and year
$current_month = date('m');
$current_year = date('Y');

// SQL query to retrieve data from the transaction table for contributions made in the current month and year
$query = "SELECT t.member_id, CONCAT(m.fName, ' ', m.lName) AS fullName, t.transaction_date, t.transaction_amount
          FROM transactions t
          JOIN members m ON t.member_id = m.memberId
          WHERE t.transaction_purpose = 'contribution'
          AND MONTH(t.transaction_date) = $current_month
          AND YEAR(t.transaction_date) = $current_year";
$result = mysqli_query($conn, $query);

// Check for errors
if (!$result) {
    // Handle the error gracefully
    error_log("Error executing query: " . mysqli_error($conn));
    echo "An unexpected error occurred. Please try again later.";
    exit;
}

$total_amount = 0;

// Check if there are any rows returned
if (mysqli_num_rows($result) > 0) {
    // Output the fetched data in a table
    echo '<table>';
    echo '<thead>';
    echo '<tr>';
    echo '<th>Member ID</th>';
    echo '<th>Full Name</th>';
    echo '<th>Total Amount Paid</th>';
    echo '<th>Date</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';

    // Loop through the fetched data and output each row in the table
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr>';
        echo '<td>' . $row['member_id'] . '</td>';
        echo '<td>' . $row['fullName'] . '</td>';
        echo '<td>KSH ' . number_format($row['transaction_amount'], 2) . '</td>';
        echo '<td>' . $row['transaction_date'] . '</td>';
        echo '</tr>';

        // Add up the total amount paid by all members
        $total_amount += $row['transaction_amount'];
    }

    echo '</tbody>';
    echo '</table>';

    // Output the total amount paid as a JavaScript variable
    echo '<script>';
    echo 'const totalAmount = ' . $total_amount . ';';
    echo 'updateProgressBar(totalAmount);'; // Pass the total amount to the JavaScript function
    echo '</script>';

} else {
    echo "No contributions found for the current month.";
}

// Insert retrieved data into the contribution_log table
$query = "SELECT t.member_id, t.transaction_id, t.transaction_date, t.transaction_amount, t.member_id_for_contribution
          FROM transactions t
          WHERE t.transaction_purpose = 'contribution'";
$result = mysqli_query($conn, $query);

if (!$result) {
    // Handle the error gracefully
    error_log("Error executing query: " . mysqli_error($conn));
    exit;
}

while ($row = mysqli_fetch_assoc($result)) {   
    $member_id = $row["member_id"];
    $member_id_for_contribution = $row["member_id_for_contribution"];
    $transaction_date = $row['transaction_date'];
    $transaction_amount = $row['transaction_amount'];
    $transaction_id = $row['transaction_id'];
    
    // SQL query to insert data into the contribution_log table
    $insert_query = "INSERT IGNORE INTO contributionLog (member_id, contribution_id, contribution_date, amount, transaction_id) 
    VALUES ('$member_id', '$member_id_for_contribution', '$transaction_date', '$transaction_amount', '$transaction_id')";
$insert_result = mysqli_query($conn, $insert_query);
    
    // Check for insertion errors
    if (!$insert_result) {
        // Handle the error gracefully
        error_log("Error inserting data into contribution_log: " . mysqli_error($conn));
        exit;
    }
}
// Free result set
mysqli_free_result($result);

?>