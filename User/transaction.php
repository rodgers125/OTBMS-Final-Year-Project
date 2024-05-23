<?php
require 'session.php';
require 'connection.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transactions</title>
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/profile.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp">

</head>
<body>

   <div class="container">
   <?php
  include 'notification_counter.php';
  ?>
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
            <a href="member_dashboard.php">
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
           
           
            <a href="transaction.php" class = "active">
                <span class="material-icons-sharp">receipt</span>
                <h3>Payment Receipts</h3>
            </a>
            <a href="notifications.php">
                <span class="material-icons-sharp">notifications</span>
                <h3>Notifications <span class="notification-counter"><?= $notificationCount ?></span></h3>
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
        <h1>► Payment Receipts</h1>
        <br>
      
<?php
include 'transaction_db.php'
?>
    </main>

<!--this ends main-->

<div class="right">
    <div class="top">
        
      
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
                <a href="settings.php"><img src="./images/profile-1.png" alt=""></a>
            </div>
        </div>
    </div>
                    
<!--end of top-->




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