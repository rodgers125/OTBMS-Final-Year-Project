<?php
require 'connection.php';

// SQL query to retrieve member_id and contribution_id from contribution_schedule table
$query = "SELECT member_id, contribution_id, cont_dateline
          FROM contribution_schedule";

$result = mysqli_query($conn, $query);

if (!$result) {
    echo "Error: " . mysqli_error($conn);
    exit;
}

while ($row = mysqli_fetch_assoc($result)) {
    $member_id = $row['member_id'];
    $contribution_id = $row['contribution_id'];
    $cont_dateline = $row['cont_dateline'];

    // Get the month and year from cont_dateline
    $cont_month = date('m', strtotime($cont_dateline));
    $cont_year = date('Y', strtotime($cont_dateline));

    // SQL query to calculate total contribution amount for the member and matched month
    $total_query = "SELECT SUM(amount) AS total_amount
                    FROM contribution_log
                    WHERE MONTH(contribution_date) = $cont_month
                    AND YEAR(contribution_date) = $cont_year";
    
    $total_result = mysqli_query($conn, $total_query);
    $total_row = mysqli_fetch_assoc($total_result);
    $contribution_amount = $total_row['total_amount'];

    // Insert values into contribution_history table
    $insert_query = "INSERT INTO contribution_history (member_id, contribution_id, contribution_date, contribution_amount) 
                     VALUES ('$member_id', '$contribution_id', '$cont_dateline', '$contribution_amount')";
    $insert_result = mysqli_query($conn, $insert_query);

    if (!$insert_result) {
        echo "Error inserting data into contribution_history: " . mysqli_error($conn);
        exit;
    }
}

echo "Values inserted successfully into contribution_history table.";

mysqli_close($conn); // Close the database connection
?>
