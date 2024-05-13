<?php
require_once 'connection.php';

// Query to retrieve data from the contribution_history table and sort by contribution_date
$query = "SELECT ch.contribution_id, ch.member_id, CONCAT(m.fName, ' ', m.lName) AS fullName, 
                 ch.contribution_amount, 
                 ch.contribution_date
          FROM contribution_history ch
          JOIN members m ON ch.member_id = m.memberId
          ORDER BY ch.contribution_date DESC"; // ASC for ascending order, DESC for descending order
$result = mysqli_query($conn, $query);

// Check if there are any rows returned
if (mysqli_num_rows($result) > 0) {
    // Output table header
    echo '<table>';
    echo '<thead>';
    echo '<tr>';
    echo '<th>Contribution ID</th>';
    echo '<th>Member ID</th>';
    echo '<th>Full Name</th>';
    echo '<th>Total Contributions Made</th>';
    echo '<th>Date Contributed</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';

    // Loop through the fetched data and output each row in the table
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr>';
        echo '<td>' . $row['contribution_id'] . '</td>';
        echo '<td>' . $row['member_id'] . '</td>';
        echo '<td>' . $row['fullName'] . '</td>';
        echo '<td>' . $row['contribution_amount'] . '</td>';
        echo '<td>' . $row['contribution_date'] . '</td>';
        echo '</tr>';
    }

    echo '</tbody>';
    echo '</table>';
} else {
    echo 'No contribution history found.';
}


?>
