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


if (isset($_REQUEST['contribution_id'])) {
    // Sanitize the input to prevent SQL injection
    $contribution_id = mysqli_real_escape_string($conn, $_REQUEST['contribution_id']);

    // Query to retrieve data from the contribution_schedule table
    $query = "SELECT member_id, cont_amount, cont_dateline FROM contribution_schedule WHERE contribution_id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $contribution_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) > 0) {
        // Fetch the data
        $row = mysqli_fetch_assoc($result);

        // Extract the data
        $member_id = $row['member_id'];
        $contribution_amount = $row['cont_amount'];
        $contribution_date = $row['cont_dateline'];

        // Insert data into the contribution_history table
        $insert_query = "INSERT INTO contribution_history (member_id, contribution_amount, contribution_date, contribution_id) 
                         VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $insert_query);
        mysqli_stmt_bind_param($stmt, "iisi", $member_id, $contribution_amount, $contribution_date, $contribution_id);
        $insert_result = mysqli_stmt_execute($stmt);

        
        if (!$insert_result) {
            // Handle insertion error
            error_log("Error inserting data into contribution_history: " . mysqli_error($conn));
            echo "Failed to mark contribution as complete.";
        }
    } else {
        // No data found for the provided contribution_id
        echo "No contribution found for the provided contribution ID.";
    }
}

?>
