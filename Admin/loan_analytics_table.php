<?php
require 'connection.php';

// SQL query to calculate the total amount borrowed for each member
$query = "SELECT l.member_id, CONCAT(m.fName, ' ', m.lName) AS fullName, m.email, SUM(l.loan_amount) AS totalAmountBorrowed
          FROM loan_history l
          JOIN members m ON l.member_id = m.memberId
          GROUP BY l.member_id
          ORDER BY totalAmountBorrowed DESC
          LIMIT 5"; // Limit to top 5 borrowers

$result = mysqli_query($conn, $query);

// Check if there are any rows returned
if (mysqli_num_rows($result) > 0) {
    echo '<div class="table">';
    echo '<h2>Top Borrowers</h2>';
    echo '<table>';
    echo '<thead>';
    echo '<tr>';
    echo '<th>Member ID</th>';
    echo '<th>Full Name</th>';
    echo '<th>Email</th>';
    echo '<th>Total Amount Borrowed</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';

    // Loop through each row in the result set
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr>';
        echo '<td>' . $row['member_id'] . '</td>';
        echo '<td>' . $row['fullName'] . '</td>';
        echo '<td>' . $row['email'] . '</td>';
        echo '<td>KSH ' . number_format($row['totalAmountBorrowed'], 2) . '</td>';
        echo '</tr>';
    }

    echo '</tbody>';
    echo '</table>';
    echo '</div>';
} else {
    echo 'No data found.';
}


// Calculate frequent borrowers based on the number of times they borrowed
$queryFrequentBorrowers = "SELECT l.member_id, CONCAT(m.fName, ' ', m.lName) AS fullName, m.email, COUNT(l.member_id) AS timesBorrowed
                           FROM loan_history l
                           JOIN members m ON l.member_id = m.memberId
                           GROUP BY l.member_id
                           ORDER BY timesBorrowed DESC
                           LIMIT 5"; // Limit to top 5 frequent borrowers

$resultFrequentBorrowers = mysqli_query($conn, $queryFrequentBorrowers);

// Check if there are any rows returned for frequent borrowers
if (mysqli_num_rows($resultFrequentBorrowers) > 0) {
    echo '<div class="table">';
    echo '<h2>Frequent Borrowers</h2>';
    echo '<table>';
    echo '<thead>';
    echo '<tr>';
    echo '<th>Member ID</th>';
    echo '<th>Full Name</th>';
    echo '<th>Email</th>';
    echo '<th>Times Borrowed</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';

    // Loop through each row in the result set for frequent borrowers
    while ($row = mysqli_fetch_assoc($resultFrequentBorrowers)) {
        echo '<tr>';
        echo '<td>' . $row['member_id'] . '</td>';
        echo '<td>' . $row['fullName'] . '</td>';
        echo '<td>' . $row['email'] . '</td>';
        echo '<td>' . $row['timesBorrowed'] . ' times</td>';
        echo '</tr>';
    }

    echo '</tbody>';
    echo '</table>';
    echo '</div>';
} else {
    echo 'No frequent borrowers found.';
}
// Close the database connection


?>