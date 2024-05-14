<?php
require 'session.php';
require 'connection.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ONLINE CHAMA -dashboard</title>
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/icons.css">
    <link rel="stylesheet" href="css/modal.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp">

</head>
<body>

   <div class="container">
  
    <!--sidebar menu-->
    <aside>
        <div class="top">
            <div class="logo">
                <img src="images/hero.png">
                <h2>ONLINE<span class="success">CHAMA</span></h2>
            </div>
            <div class="close" id="close-btn">
                <span class="material-icons-sharp">close</span>
            </div>
        </div>

        <div class="sidebar">
            <a href="member_dashboard.php" class="active">
                <span class="material-icons-sharp">grid_view</span>
                <h3>Account Overview</h3>
            </a>
            
            <a href="contribution.php">
                <span class="material-icons-sharp">person_outline</span>
                <h3>Contributions</h3>
            </a>
           
            <a href="loan.php">
                <span class="material-icons-sharp">insights</span>
                <h3>Loans</h3>
            </a>
           
            <a href="transaction.php">
                <span class="material-icons-sharp">receipt</span>
                <h3>Payment Receipts</h3>
            </a>
            <a href="notifications.php">
                <span class="material-icons-sharp">notifications</span>
                <h3>Notifications</h3>
            </a>

            <a href="settings.php">
                <span class="material-icons-sharp">settings</span>
                <h3>Settings</h3>
            </a>
          
          
                      
            <a href="logout.php" id="logoutLink">
                <span class="material-icons-sharp">logout</span>
                <h3>Logout</h3>
            </a>
        </div>
    </aside>

    <!-- Main Content -->
    <main>
        <h1>► Account Overview</h1>

        <div class="insights">

            <!--Account Balance-->
            <div class="groups">
                
                <div class="middle">
                    <div class="left">
                        <h3>Your Contributions To Date</h3> 
                        <?php
                       // Include the loan_db.php file to access $total_loan_balance
                          include 'contribution_schedule_db.php';
                        ?>
                        <p><b>KSH <?php echo $contributedAmount; ?></b></p> 
                        <a href="contribution.php"> 
                        <small>View More Details</Details></small>
                        <img src="images/view.png" alt="Request Icon" class="view-icon"> 
                        </a>                         
                    </div>                   
                </div>              
            </div>    
            
             <!--Loan Balance-->
             <div class="groups">
                
                <div class="middle">
                    <div class="left">
                        <h3>Loan Balance</h3> 
                        <?php
                       // Include the loan_db.php file to access $total_loan_balance
                          include 'loan_db.php';
                        ?>
                        <p><b>KSH <?php echo $total_loan_balance; ?></b></p>  
                        <a href="loan.php"> 
                        <small>View More Details</small>
                        <img src="images/view.png" alt="Request Icon" class="view-icon"> 
                        </a>                        
                    </div>                   
                </div>              
            </div> 
             <!--Loan Limit-->
             <div class="groups">
                
                <div class="middle">
                    <div class="left">
                        <h3>Loan Limit</h3> 
                        <p><b>--|--</b></p>
                        <a href="loan.php"> 
                        <small>Apply now</small>
                        <img src="images/view.png" alt="Request Icon" class="view-icon"> 
                        </a>                    
                    </div>                   
                </div>              
            </div> 

            
          
        </div>

        <!---personal details -->

     <?php
     include 'user_details_db.php'
     ?>


       
<!--Recent Transactions -->

<?php
include 'recent_transactions_db.php'
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
                <small class="text-muted">Member</small>
            </div>
            <div class="profile-photo">
                <img src="./images/profile-1.png" alt="">
            </div>
        </div>
    </div>
                    
<!--end of top-->


<div class="side-card">
<?php
     include 'group_details_db.php';
     ?>
<h2>Your Group Details</h2>
<div class="side-card-info">
    <div class="card-detail">
        <h3>Group Name:</h3>
        <p><?php echo $group_name; ?></p>  
            
       
    </div>
    <div class="card-detail">
    <h3>Date Joined:</h3>    
        <p><?php echo $date_joined; ?></p>
        
    </div>
    <div class="card-detail">
    <h3>Total Members:</h3>
        <p><?php echo $total_members; ?></p>
      
    </div>
    <div class="card-detail">
    <h3>Total Contributions made:</h3>
        <p>150000</p>
      
    </div>
       
</div>
</div>

<div class="upcoming-events">
<h2>Upcoming Events</h2>
<div class="events">
<?php



// Fetch events from the database, ordered by the most upcoming date
$query = "SELECT event_date, event_title FROM events ORDER BY event_date ASC LIMIT 4";
$result = mysqli_query($conn, $query);

if ($result) {
    // Loop through the events and generate HTML for each
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<div class="event">';
        echo '    <div class="event-photo">';
        echo '        <img src="./images/event.png" alt="">';
        echo '    </div>';
        echo '    <div class="event-about">';
        echo '        <p><b>' . $row['event_date'] . '</b> ' . $row['event_title'] . '</p>';
        echo '    </div>';
        echo '</div>';
    }

    // Free the result set
    mysqli_free_result($result);
} else {
    // Display an error message if the query fails
    echo "Error executing query: " . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
?>

    
    
</div>
</div>

</div>
    
   </div>  


   <div class="footer">
    <div class="row">
        <div class="copyright">
            © 2023 All rights reserved.
        </div>
    </div>
   </div>

   <script src="js/index.js"></script>
</body>
</html>