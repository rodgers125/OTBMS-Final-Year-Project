<?php
require 'connection.php';if (isset($_REQUEST['contribution_id'])) {
    // Extract contribution_id
    $contribution_id = $_REQUEST['contribution_id'];

    // Query to retrieve data from the contribution_schedule table
    $query = "SELECT cs.member_id, SUM(cl.amount) AS total_amount, cs.cont_dateline 
              FROM contribution_schedule cs 
              JOIN contributionlog cl ON cs.member_id = cl.member_id_for_contribution
              WHERE cs.contribution_id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $contribution_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) > 0) {
        // Fetch the data
        $row = mysqli_fetch_assoc($result);

        // Extract the data
        $member_id = $row['member_id'];
        $contribution_amount = $row['total_amount']; // Updated to use total_amount from contributionlog
        $contribution_date = $row['cont_dateline'];

        // Insert data into the contribution_history table
        $insert_query = "INSERT INTO contribution_history (member_id, contribution_amount, contribution_date, contribution_id) 
                         VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $insert_query);
        mysqli_stmt_bind_param($stmt, "iisi", $member_id, $contribution_amount, $contribution_date, $contribution_id);
        $insert_result = mysqli_stmt_execute($stmt);

        // Update status in the contribution_schedule table
        $updateQuery = "UPDATE contribution_schedule SET status = 'completed' WHERE contribution_id = ?";
        $stmt = mysqli_prepare($conn, $updateQuery);
        mysqli_stmt_bind_param($stmt, "i", $contribution_id);
        $updateResult = mysqli_stmt_execute($stmt);

        if ($insert_result && $updateResult) {
            // Successfully updated the status and inserted into contribution_history
            echo "<script> alert('Contribution marked as complete successfully!')
            window.location.href = 'contribution_schedule.php';
            </script>";
        } else {
            // Failed to insert into contribution_history or update the status
            echo "<script> alert('Failed to mark contribution as complete.')
            window.location.href = 'contribution_schedule.php';
            </script>";
        }
    } else {
        // No data found for the provided contribution_id
        echo "<script> alert('No contribution found for the provided contribution ID.')
        window.location.href = 'contribution_schedule.php';
        </script>";
    }
}


?>