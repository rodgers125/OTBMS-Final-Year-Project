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
$query = "SELECT cs.contribution_id, cs.cont_amount, cs.cont_dateline, cs.payment_option, cs.member_id, cs.acc_holder, cs.bank_name, cs.acc_number, cs.mpesa_number, cs.mpesa_till, m.fName, m.lName, m.email, m.phone
          FROM contribution_schedule cs
          JOIN members m ON cs.member_id = m.memberId
          WHERE MONTH(cs.cont_dateline) = $current_month AND YEAR(cs.cont_dateline) = $current_year";
$result = mysqli_query($conn, $query);

// Check if there are any rows returned
if (mysqli_num_rows($result) > 0) {
    // Fetch the contribution details
    $row = mysqli_fetch_assoc($result);

    // Extract the contribution details
    $contribution_id = $row['contribution_id'];
    $cont_amount = $row['cont_amount'];
    $cont_dateline = $row['cont_dateline'];
    $payment_option = $row['payment_option'];
    $member_id = $row['member_id'];
    $acc_holder = $row['acc_holder'];
    $bank_name = $row['bank_name'];
    $acc_number = $row['acc_number'];
    $mpesa_number = $row['mpesa_number'];
    $mpesa_till = $row['mpesa_till'];
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

?>
