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
            <a href="profile.php"  class="active">
                <span class="material-icons-sharp">insights</span>
                <h3>Profile</h3>
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
        <h1>► Personal Details</h1>
        <div class="user-details">
            <div class="details-card">
                <h3><b>Personal Details:</b></h3>
                <form action="update_profile.php" method="POST">
                    <ul>            
                        <li><b>Member ID :</b> 4</li>
                        <li>
                            <label for="full_name">Full Name :</label>
                            <input type="text" id="full_name" name="full_name" value="John Doe" required>
                        </li>
                        <li><b>Date Joined :</b> 1987/05/23</li>
                        <li><b>Email :</b> fhdf@gmail.com</li>                  
                        <li>
                            <label for="phone_number">Phone Number :</label>
                            <input type="tel" id="phone_number" name="phone_number" value="0701163576" required>
                        </li>
                        <li><b>Gender :</b> Male</li>
                        <small>Note: You can only edit your Name and Phone Number</small>
                        <button type="submit" class="btn-edit">Update Personal Details</button>
                    </ul>
                </form>
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

   <script src="index.js"></script>
</body>
</html>