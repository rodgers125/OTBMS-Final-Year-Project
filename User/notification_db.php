<?php

require 'connection.php';

$userID = $_SESSION['user_id'];

// Query to fetch data from the notification table for a specific member
$query = "SELECT notification_id, notification_date_time, title, message FROM notification WHERE member_id = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "i", $userID);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($result && mysqli_num_rows($result) > 0) {
    // Output table header
    echo '<table>';
    
    echo '<tbody>';

    // Loop through the results and output each row
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr onclick="handleRowClick(' . $row['notification_id'] . ')">'; 
        echo '<td>' . $row['notification_date_time'] . '</td>';
        echo '<td><b>' . $row['title'] . '</b></td>';
        echo '<td class="unread-notification-about">';
        echo '<button class="clear-btn" onclick="handleDeleteClick(' . $row['notification_id'] . ')">';
        echo '<img src="images/clear.png" alt="clear">';
        echo '</button>';
        echo '</td>';
        echo '</tr>';

        
    }

    // Close table body and table tags
    echo '</tbody>';
    echo '</table>';
} else {
    // Handle case when no notifications are found
    echo 'You do not have any notifications at the moment.';
}

?>
