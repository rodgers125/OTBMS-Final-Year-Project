<?php
require 'connection.php';

// Get the current month and year
$current_month = date('m');
$current_year = date('Y');

// SQL query to retrieve data from the transactions table for contributions made in the current month and year
$query = "SELECT t.transaction_id, t.member_id, CONCAT(m.fName, ' ', m.lName) AS fullName, t.transaction_date, t.transaction_amount, t.member_id_for_contribution
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

        // Insert data into the contributionLog table
        $member_id = $row['member_id'];
        $contribution_date = $row['transaction_date'];
        $amount = $row['transaction_amount'];
        $member_id_for_contribution = $row['member_id_for_contribution'];
        $transaction_id = $row['transaction_id'];

        $insert_query = "INSERT IGNORE INTO contributionlog (member_id, contribution_date, amount, member_id_for_contribution, transaction_id) 
                         VALUES ('$member_id', '$contribution_date', '$amount', '$member_id_for_contribution', '$transaction_id')";
        $insert_result = mysqli_query($conn, $insert_query);

        if (!$insert_result) {
            // Handle insertion error
            error_log("Error inserting data into contributionLog: " . mysqli_error($conn));
            // Optionally, you can continue processing other rows even if one fails
            // or exit the script entirely
            // exit;
        }
    }

    echo '</tbody>';
    echo '</table>';

    echo '<script>';
echo 'const totalAmount = ' . $total_amount . ';';
echo 'updateProgressBar(totalAmount);'; // Pass the total contributed amount to the JavaScript function
echo '</script>';

} else {
    echo "No contributions found for the current month.";
}

// Free result set
mysqli_free_result($result);
?>