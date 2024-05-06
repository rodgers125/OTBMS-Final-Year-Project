<?php
require 'session.php';
require 'connection.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ONLINE CHAMA - Contribution</title>
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/loan.css"> 
    <link rel="stylesheet" href="css/contribution.css">    
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
            <a href="index.php">
                <span class="material-icons-sharp">grid_view</span>
                <h3>Account Overview</h3>
            </a>
            
            <a href="contribution.php"  class="active">
                <span class="material-icons-sharp">person_outline</span>
                <h3>Contribution</h3>
            </a>
           
            <a href="loan.php">
                <span class="material-icons-sharp">insights</span>
                <h3>Loans</h3>
            </a>
           
            
            <a href="transaction.php">
                <span class="material-icons-sharp">receipt</span>
                <h3>Transactions</h3>
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

    <?php
       include 'contribution_schedule_db.php';
       ?>
    <main>
    <h1>► Contribution</h1>
    <br>
    <div class="loan-details">
        <!-- Loan Balance Card -->
        <div class="loan-card">
        <h2>Your Total Contributions</h2> 
        <br>
                        <p>KSH 50,600.50</p>  
                        
                        
        </div>

        <!-- Loan Limit Card -->
        <div class="loan-card">
        <h2>Your Next Contribution</h2> 
        <br>
                        <p><?php echo $yourContributionDate; ?></p>
                        
        </div>
        
    </div>
<br>
<div class="loan-details">
    <div class="loan-card">
        <h2>Current Member Being Contributed:</h2>
        <br>
        <p><b>Member ID :</b><?php echo $member_id; ?></li>
        <p><b>Full Name :</b><?php echo $fullName; ?></p>
        <p><b>Email :</b><?php echo $email; ?></p>
        <p><b>Phone Number :</b><?php echo $phone_number; ?></p>
    </div>

    <div class="loan-card">
        <h2>Contribution Details:</h2>
        <br>
        <p><b>Total Amount To Be Contributed By Each Member :</b> <?php echo $cont_amount; ?></p>
        <p><b>Payment Details :</p>
        <li>
            <ul class="payment-options">
                <h3>Option 1: Mpesa</h3>
                <p>Mpesa Send Money - <?php echo $mpesa_number; ?></p>                
                <p>or</p>
                <p>Mpesa Till Number - <?php echo $mpesa_till; ?></p>
                <h3>Option 2</h3>
                <p>Bank Deposit.
                    <br> 
                     Account Holder: <?php echo $acc_holder; ?>.
                     <br>
                 Bank: <?php echo $bank_name; ?>.
                 <br>
                  Account No.: <?php echo $acc_number; ?></p>
            </ul>
        </li>
        <p><b>DateLine :</b> <?php echo $cont_dateline; ?></p>
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
                <small class="text-muted">Member</small>
            </div>
            <div class="profile-photo">
                <img src="./images/profile-1.png" alt="">
            </div>
        </div>
    </div>
                    
<!--end of top-->

<div class="side-card">
<h2>Next Contributions</h2>
<div class="side-card-info">
    <div class="card-detail">
       <?php
       include 'contribution_schedule_db.php';
       ?>
        <ul>
            <p><b>Next Member:</b> <?php echo $nextMember; ?></p>
            <br>
            <p><b>Contribution Date:</b> <?php echo $contributionDate; ?> </p>
        </ul>
       
       
   
    </div>
    
    
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