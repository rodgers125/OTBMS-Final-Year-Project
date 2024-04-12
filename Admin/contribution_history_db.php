<?php
require 'connection.php';

$response = array(); // Initialize response array

// Check if contribution_id is provided
if (!isset($_POST['contribution_id'])) {
    $response['error'] = "Contribution ID is missing.";
} else {
    $contribution_id = $_POST['contribution_id'];

    // SQL query to retrieve member_id, cont_dateline, and total contribution_amount for the given contribution_id
    $query = "SELECT cs.member_id, cs.cont_dateline, SUM(cl.amount) AS contribution_amount
              FROM contribution_schedule cs
              INNER JOIN contribution_log cl ON cs.contribution_id = cl.contribution_id
              WHERE cs.contribution_id = '$contribution_id'
              AND MONTH(cs.cont_dateline) = MONTH(cl.contribution_date)
              AND YEAR(cs.cont_dateline) = YEAR(cl.contribution_date)
              GROUP BY cs.member_id, cs.cont_dateline";

    $result = mysqli_query($conn, $query);

    if (!$result) {
        $response['error'] = "Error: " . mysqli_error($conn);
    } else {
        // Fetch the first row only (assuming only one record is expected)
        $row = mysqli_fetch_assoc($result);

        $member_id = $row['member_id'];
        $cont_dateline = $row['cont_dateline'];
        $contribution_amount = $row['contribution_amount'];

        // Insert values into contribution_history table
        $insert_query = "INSERT INTO contribution_history (member_id, contribution_id, contribution_date, contribution_amount) 
                         VALUES ('$member_id', '$contribution_id', '$cont_dateline', '$contribution_amount')";
        $insert_result = mysqli_query($conn, $insert_query);

        if (!$insert_result) {
            $response['error'] = "Error inserting data into contribution_history: " . mysqli_error($conn);
        } else {
            $response['success'] = "Record added successfully into contribution_history table.";
        }
    }
}

echo json_encode($response); // Output response as JSON

mysqli_close($conn);
?>
