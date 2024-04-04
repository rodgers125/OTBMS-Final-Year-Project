<?php
require 'session.php';
require 'connection.php';


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin-contribution-progress</title>
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="icons.css"> 
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp"> 
    <link rel="stylesheet" href="loan_analytics.css">
    <link rel="stylesheet" href="event.css">
    <link rel="stylesheet" href="members.css">



</head>
<body>
   <div class="container">
    <!--sidebar menu-->
    <aside>
        <div class="top">
            <div class="logo">
                <img src="images/hero.png">
                <h2>OTB<span class="success">MS</span></h2>
            </div>
            <div class="close" id="close-btn">
                <span class="material-icons-sharp">close</span>
            </div>
        </div>

        <div class="sidebar">
            <a href="admin.php">
                <span class="material-icons-sharp">grid_view</span>
                <h3>Dashboard</h3>
            </a>
            <a href="members.php">
                <span class="material-icons-sharp">person_outline</span>
                <h3>Members</h3>
            </a>
           
            <a href="contributions.php"  class="active">
                <span class="material-icons-sharp">insights</span>
                <h3>Contributions</h3>
            </a>
            <a href="loans.php">
                <span class="material-icons-sharp">insights</span>
                <h3>Loans</h3>
            </a>
            <a href="transactions.php">
                <span class="material-icons-sharp">report_gmailerrorred</span>
                <h3>Transactions</h3>
            </a>
            <a href="events.php">
                <span class="material-icons-sharp">inventory</span>
                <h3>Events</h3>
            </a>
                                 
            <a href="logout.php" id="logoutLink">
                <span class="material-icons-sharp">logout</span>
                <h3>Logout</h3>
            </a>
        </div>
    </aside>

    <!-- Main Content -->
    <main>
       
               
    <h1>► Contribution Progress</h1>
        <button class="btn-back"><a href="contributions.php">Back</a></button>
<br>
<!--contribution progress bar-->

        <div class="progress-container">
  <div class="progress-bar" id="progress-bar">0%</div>  
</div>
<small><b> <i>Contribution Progress Bar</i></b></small>

        <!--Loan List Table table-->
        <div class="table">
        <h2>List of contributions made so far for this month</h2>
        <form action="" method="get">
            <label for="search">Search:</label>
            <input type="text" id="search" name="search">
            <button class="form-btn" type="submit">Search</button>
          </form>
       
          <?php

// Get the current month and year
$current_month = date('m');
$current_year = date('Y');

// SQL query to retrieve data from the transaction table for contributions made in the current month and year
$query = "SELECT t.member_id, CONCAT(m.fName, ' ', m.lName) AS fullName, t.transaction_date, t.transaction_amount
          FROM transactions t
          JOIN members m ON t.member_id = m.memberId
          WHERE t.transaction_purpose = 'contribution'
          AND MONTH(t.transaction_date) = $current_month
          AND YEAR(t.transaction_date) = $current_year";
$result = mysqli_query($conn, $query);

// Check for errors
if (!$result) {
    echo "Error: " . mysqli_error($conn);
    exit;
}

$total_amount = 0;

// Check if there are any rows returned
if (mysqli_num_rows($result) > 0) {
    // Output the fetched data in a table
    echo '<table>';
    echo '<thead>';
    echo '<tr>';
    echo '<th>Member ID</th>';
    echo '<th>Full Name</th>';
    echo '<th>Total Amount Paid</th>';
    echo '<th>Date</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';

    // Loop through the fetched data and output each row in the table
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr>';
        echo '<td>' . $row['member_id'] . '</td>';
        echo '<td>' . $row['fullName'] . '</td>';
        echo '<td>KSH ' . number_format($row['transaction_amount'], 2) . '</td>';
        echo '<td>' . $row['transaction_date'] . '</td>';
        echo '</tr>';

        // Add up the total amount paid by all members
        $total_amount += $row['transaction_amount'];
    }

    echo '</tbody>';
    echo '</table>';

    // Output the total amount paid as a JavaScript variable
    echo '<script>';
    echo 'const totalAmount = ' . $total_amount . ';';
    echo 'updateProgressBar(totalAmount);'; // Pass the total amount to the JavaScript function
    echo '</script>';
} else {
    echo "No contributions found for the current month.";
}

// Free result set
mysqli_free_result($result);
?>


     
   
    </main>
<!--this ends main-->

<div class="right">
    <div class="top">
        <button id="menu-btn">
            <span class="material-icons-sharp">menu</span>
        </button>
      
        <div class="profile">
            <div class="info">
                <?php if (isset($_SESSION['user_name'])) : ?>
                    <p>Hi, <b><?php echo $_SESSION['user_name']; ?></b></p>
                <?php else : ?>
                    <p>Hi, <b>Guest</b></p>
                <?php endif; ?>
                <small class="text-muted">Admin</small>
            </div>
            <div class="profile-photo">
                <img src="./images/profile-1.png" alt="">
            </div>
        </div>
    </div>
                    
<!--end of top-->

<div class="upcoming-events">
<h2>Related Pages</h2>
<div class="events">
    <ul>
        <li><a href="schedule_contribution.php">Schedule Contribution</a><img src="images/view.png" alt="Request Icon" class="view-icon"></li>
        <li><a href="contribution_history.php">View Contribution History</a><img src="images/view.png" alt="Request Icon" class="view-icon"></li>
        <li><a href="contribution_schedule.php">Contribution Schedule</a><img src="images/view.png" alt="Request Icon" class="view-icon"></li>
          </ul>
          </ul>
   
    
    
    
</div>
                </div>
            
<!--end of upcoming events-->


</div>
    
   </div>  


   <div class="footer">
    <div class="row">
        <div class="copyright">
            © 2023 All rights reserved.
        </div>
    </div>
   </div>

   
   <script src="members.js"></script>
   <script src="progress.js"></script>
   <script src="admin.js"></script>
</body>
</html>