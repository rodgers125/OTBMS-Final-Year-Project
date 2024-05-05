<?php
require 'session.php';
require 'connection.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ONLINE CHAMA - notifications</title>
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/notifications.css">
    <link rel="stylesheet" href="css/loan.css">
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
                <h3>Transactions</h3>
            </a>
            <a href="notifications.php" class = "active">
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
    <h1>► Notifications</h1>
    <div class="user-details">
        <div class="details-card" id="notificationList">             
            <?php
            include 'notification_db.php';
            ?>
        </div>

        <div class="details-card" id="notificationContent" style="display: none;">
            <!-- This is where the notification content will be displayed -->
            <button class="btn-back"><a href="notifications.php">Go Back</a></button> <!-- Button to go back to notifications list -->
            <br>
            <br>
            <h2 id="notificationTitle"></h2> <!-- Title of the notification will be displayed here -->
            <br>
            <p id="notificationMessage"></p> <!-- Notification message will be displayed here -->
          
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
   <script src="js/notification.js"></script>

</body>
</html>