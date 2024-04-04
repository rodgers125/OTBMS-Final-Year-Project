<?php
require 'session.php';
require 'connection.php';


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin-contribution-schedule</title>
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="icons.css"> 
    <link rel="stylesheet" href="css/contribution.css">
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
       
               
    <h1>► Contribution Schedule</h1>
        <button class="btn-back"><a href="contributions.php">Back</a></button>

        <!--Loan List Table table-->
        <div class="table">
        <h2>List of Scheduled Contributions</h2>
        <form action="" method="get">
            <label for="search">Search:</label>
            <input type="text" id="search" name="search">
            <button class="form-btn" type="submit">Search</button>
          </form>
        

          <?php
          include 'contribution_schedule_table_db.php'
          ?>

     <!-- Modal for Editing Contribution Schedule -->
     <div id="editModal" class="modal" style="display: none;">
    <div class="modal-content">
        <span class="close">&times;</span>
        <div class="events">
            <h3>Schedule Member Contribution</h3>
            <div class="form-container">
                <div class="events-form">                
                    <form id="editForm" action="schedule_contribution_db.php" method="post">
                        <!-- Form fields  -->
                        <div class="form-group">
                    <label for="id">Member's ID</label>
                    <input type="number" id="memberId" name="memberId" required>                    
                </div>

                <div class="form-group">
                    <label for="id">Contribution Amount From Each Member</label>
                    <input type="number" id="contributionAmount" name="contributionAmount" required>                    
                </div>
                <div class="form-group">
                <label for="payment_options">Payment Options:</label>
                <select id="payment_options" name="payment_options">
                <option value="">Select Payment Option</option>
                <option value="mpesa">M-Pesa</option>
                <option value="bank_deposit">Bank Deposit</option>
               </select>
                </div>

            <div class = "form-group" id="mpesa_options" style="display: none;">
                     <label for="mpesa_sub_options">Select M-Pesa Options:</label>
                     <select id="mpesa_sub_options" name="mpesa_sub_options">
                        <option value="">Select M-Pesa Option</option>
                        <option value="till_number">Till Number</option>
                        <option value="send_money">Send Money</option>
                     </select>
                     <div id="mpesa_input" style="display: none;">
                        <label for="mpesa_input_field">Enter Number:</label>
                   <input type="text" id="mpesa_input_field" name = "mpesa_input_field">
                 </div>
                </div>

                    <div  class = "form-group" id="bank_deposit_options" style="display: none;">
               <label for="account_holder">Account Holder:</label>
              <input type="text" id="account_holder" name = "account_holder">
                 <label for="bank">Bank:</label>
             <input type="text" id="bank" name = "bank">
             <label for="account_number">Account Number:</label>
             <input type="text" id="account_number" name ="account_number">
                </div>
              
              
    
                <div class="form-group">
                    <label for="date">Contribution Dateline</label>
                    <input type="date" id="contribution_date" name="contribution_date"/>                     
                </div>
             
               
                <div class="form-group">
                    <button type="submit" name="submit">Schedule</button>
                </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
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
        <li><a href="schedule_contribution.php">Schedule Contribution</a><img src="images/view.png" alt="Request Icon" class="view-icon"></li>
        <li><a href="contribution_progress.php">Contribution Progress</a><img src="images/view.png" alt="Request Icon" class="view-icon"></li>
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
   <script src="contribution.js"></script>
   <script src="admin.js"></script>
</body>
</html>