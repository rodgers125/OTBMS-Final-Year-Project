<?php
require 'session.php';
require 'connection.php';


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin-Loan-History</title>
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/icons.css"> 
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp"> 
    <link rel="stylesheet" href="css/loan_analytics.css">
    <link rel="stylesheet" href="css/loan_request.css">
    <link rel="stylesheet" href="css/loan_history.css">



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
           
            <a href="contributions.php">
                <span class="material-icons-sharp">insights</span>
                <h3>Contributions</h3>
            </a>
            <a href="loans.php" class="active">
                <span class="material-icons-sharp">insights</span>
                <h3>Loans</h3>
            </a>
            <a href="transactions.php">
                <span class="material-icons-sharp">receipt</span>
                <h3>Payment Receipts</h3>
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
       
               
    <h1>► Loan History</h1>
        <button class="btn-back"><a href="loans.php">Back</a></button>

        <!--Loan history Table table-->
      
 <?php 
     include 'php_db/loan_history_db.php';
     ?>

<?php
   include 'transactions_details_db.php';
   ?>
     
   <!-- Transaction Details Modal -->
   <div class="details-modal" id="detailsModal">
                <h2 class="details-heading">More Details</h2>
                <div class="events" id="memberDetails">
     
                <table>
                    <tr>
                        <th>Transaction ID:</th>
                        <th>Date</th>
                        <th>Amount</th>       
                        <th>Method</th>             
                    </tr>

                    <tr>
                        <td><?php echo $transaction_id ?></td>

                        <td><?php echo $transaction_date ?></td>

                        <td><?php echo $transaction_amount ?></td>  
                        <td><?php echo $transaction_method ?></td>              
                    
                    </tr>
   
      </table>
                <button class="close-modal-btn" onclick="closeDetailsModal()">Close</button>
            </div>  


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
        <li><a href="loan_request.php">View Loan Request</a><img src="images/view.png" alt="Request Icon" class="view-icon"></li>
        <li><a href="loan_list.php">View Loan List and Details</Details></a><img src="images/view.png" alt="Request Icon" class="view-icon"></li>       
        <li><a href="loan_analytics.php">View Loan Analytics</a><img src="images/view.png" alt="Request Icon" class="view-icon"></li>
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

   
   <script src="js/loan_history.js"></script>
   <script src="js/admin.js"></script>
</body>
</html>