<?php
require 'session.php';
require 'connection.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin-dashboard</title>
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="profile.css">
    <link rel="stylesheet" href="contribution.css">
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
            <a href="profile.php">
                <span class="material-icons-sharp">insights</span>
                <h3>Profile</h3>
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
                <span class="material-icons-sharp">report_gmailerrorred</span>
                <h3>Transactions</h3>
            </a>
            <a href="notifications.php">
                <span class="material-icons-sharp">inventory</span>
                <h3>Notifications</h3>
            </a>
          
                      
            <a href="logout.php" id="logoutLink">
                <span class="material-icons-sharp">logout</span>
                <h3>Logout</h3>
            </a>
        </div>
    </aside>

    <!-- Main Content -->
    <main>
        <h1>► Contribution</h1>
        <div class="user-details">
            <div class="details-card">
                <h3><b>Current Member Being Contributed:</b></h3>
               
                <ul>            
              <li><b>Member ID :</b>1234</li>
              <li><b>Full Name :</b> Rodgers Kipkurui</li>
              <li><b>Email :</b> dfkjfdk@gmail.com</li>
              <li><b>Phone Number :</b> 0701163576</li>
             
            </ul>
</div>

            <br>
            <br>
            <div class="details-card">
    <h3><b>Contribution Details:</b></h3>
    <ul>
        <li><b>Total Amount To Be Contributed By Each Member :</b> 2000</li>
        <li><b>Payment Details :</b>
            <ul class="payment-options">
                <li>Mpesa Send Money - 0701163576</li>
                <li>Bank Deposit -  Account Holder: John Doe, Bank:  Barclays, Account No.: 1234567890123456</li>
            </ul>
        </li>
        <li><b>DateLine :</b> 1987/05/23</li>
    </ul>
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
       
        <ul>
            <li><b>Next Member:</b> korir kipkurui</li>
            <br>
            <li><b>Contribution Date:</b>12/5/2025 </li>
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

   <script src="index.js"></script>
</body>
</html>