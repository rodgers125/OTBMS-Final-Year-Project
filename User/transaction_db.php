<?php
require 'connection.php';

// session variable storing the logged-in user's ID
$userID = $_SESSION['user_id'];

// SQL query to retrieve recent transactions for the logged-in user
$query = "SELECT * FROM transactions WHERE member_id = $userID ORDER BY transaction_date DESC LIMIT 3";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    // Output the fetched data in a table
    echo '<div class="table">';
    echo '<h3><b>Recent Payments</b></h3>';
    echo '<table>';
    echo '<thead>';
    echo '<tr>';
    echo '<th>Transaction Id</th>';
    echo '<th>Transaction Date</th>';
    echo '<th>Amount</th>';
    echo '<th>Method</th>';
    echo '<th>Purpose</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';

    // Loop through the fetched data and output each row in the table
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr>';
        echo '<td>' . $row['transaction_id'] . '</td>';
        echo '<td>' . $row['transaction_date'] . '</td>';
        echo '<td>' . $row['transaction_amount'] . '</td>';
        echo '<td>' . $row['transaction_method'] . '</td>';
        echo '<td>' . $row['transaction_purpose'] . '</td>';
        echo '</tr>';
    }

    echo '</tbody>';
    echo '</table>';   
    echo '</div>';
} else {
    // Handle case when no transactions found or query fails
    echo 'No recent transactions found.';
}

// Close the database connection

?>
