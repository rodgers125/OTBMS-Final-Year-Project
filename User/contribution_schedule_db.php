<?php
// Fetch contribution schedule data from the database
require_once 'connection.php';


// checking user locked in
// Get the member_id of the logged-in user (assuming you have a session variable for that)
$user_id = $_SESSION['user_id'];

// Query to check if the user's member_id exists in the contribution_schedule table
$query = "SELECT * FROM contribution_schedule WHERE member_id = $user_id";
$result = mysqli_query($conn, $query);

// Check if the user's member_id exists in the contribution_schedule table
if (mysqli_num_rows($result) > 0) {
    // If the user's member_id exists, fetch the contribution schedule data
    $row = mysqli_fetch_assoc($result);
    
    // Extract the contribution date from the row
    $yourContributionDate = $row['cont_dateline'];

    
} else{
    $yourContributionDate = 'Not Yet Scheduled';
}
// Free the result set
mysqli_free_result($result);


//next member schedule


// Query to fetch contribution schedule data
$query = "SELECT cs.member_id, CONCAT(m.fName, ' ', m.lName) AS fullName, cs.cont_dateline
          FROM contribution_schedule cs
          JOIN members m ON cs.member_id = m.memberId
          ORDER BY cs.cont_dateline ASC";
$result = mysqli_query($conn, $query);

// Check if there are any rows returned
if (mysqli_num_rows($result) > 0) {
    // Fetch the next contribution schedule data
    $row = mysqli_fetch_assoc($result);
    
    // Extract data into variables
    $nextMember = $row['fullName'];
    $contributionDate = $row['cont_dateline'];

    
} else{
    $nextMember = 'Not Yet Scheduled';
    $contributionDate = 'Not Yet Scheduled';
}

// Free the result set
mysqli_free_result($result);


//current member card

$current_month = date('m');
$current_year = date('Y');

// Query to retrieve contribution details for the current month and year
$query = "SELECT cs.contribution_id, cs.cont_amount, cs.cont_dateline, cs.member_id, m.fName, m.lName, m.email, m.phone
          FROM contribution_schedule cs
          JOIN members m ON cs.member_id = m.memberId
          WHERE MONTH(cs.cont_dateline) = $current_month AND YEAR(cs.cont_dateline) = $current_year
          AND cs.status = 'pending'";
$result = mysqli_query($conn, $query);

// Check if there are any rows returned
if (mysqli_num_rows($result) > 0) {
    // Fetch the contribution details
    $row = mysqli_fetch_assoc($result);

    // Extract the contribution details
    $contribution_id = $row['contribution_id'];
    $cont_amount = $row['cont_amount'];
    $cont_dateline = $row['cont_dateline'];    
    $member_id = $row['member_id'];    
    $fullName = $row['fName'] . ' ' . $row['lName'];
    $email = $row['email'];
    $phone_number = $row['phone'];
    
} else {
    // If no contribution details are found for the current month, display "Not Available" for all variables
    $contribution_id = "Not Available";
    $cont_amount = "Not Available";
    $cont_dateline = "Not Available";
    $payment_option = "Not Available";
    $member_id = "Not Available";
    $acc_holder = "Not Available";
    $bank_name = "Not Available";
    $acc_number = "Not Available";
    $mpesa_number = "Not Available";
    $mpesa_till = "Not Available";
    $fullName = "Not Available";
    $email = "Not Available";
    $phone_number = "Not Available";
}
// Query to check if the user's member_id exists in the contributionlog table
$query = "SELECT SUM(amount) AS total_amount FROM contributionlog WHERE member_id = ?";
$preparedQuery = mysqli_prepare($conn, $query);

if ($preparedQuery) {
    mysqli_stmt_bind_param($preparedQuery, "i", $user_id); // Binding parameters
    mysqli_stmt_execute($preparedQuery); // Executing the prepared statement
    $result = mysqli_stmt_get_result($preparedQuery); // Getting the result set

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $contributedAmount = $row['total_amount']; // Fetching the total contributed amount
    } else {
        // If no rows found, set the contributed amount to 0
        $contributedAmount = 0;
    }
    
 } else {
     // Handle the case where the prepared statement fails
     $contributedAmount = 0;
 }
?>
