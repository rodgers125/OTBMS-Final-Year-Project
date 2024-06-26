<?php
require 'connection.php';
require 'session.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin-Contributions</title>
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/contribution.css">
    <link rel="stylesheet" href="css/icons.css"> 
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp">

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
           
           
            <a href="contributions.php"   class="active">
                <span class="material-icons-sharp">insights</span>
                <h3>Contributions</h3>
            </a>
            <a href="loans.php">
                <span class="material-icons-sharp">insights</span>
                <h3>Loans</h3>
            </a>
            <a href="transactions.php">
                <span class="material-icons-sharp">receipt</span>
                <h3>Payment Records</h3>
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
        <h1>► Contributions</h1>

      
        <div class="insights">

        <!--current contribution progress-->        

        <div class="groups">               
    <img src="images/cont-progress.png" alt="Request Icon" class="icon">   
   
    <div class="middle">
        <div class="left">
            <a href="contribution_progress.php"><h3>View Current Contribution Progress</h3>
            <img src="images/view.png" alt="Request Icon" class="view-icon">
            </a>
            <small class="text-muted"> view members who have paid.</small>
          
        </div>
       
    </div>
    <br>
 
</div>

<!--schedule contribution-->
<div class="groups">               
    <img src="images/contribution-schedule.png" alt="Request Icon" class="icon">   
   
    <div class="middle">
        <div class="left">
            <a href="schedule_contribution.php"><h3>Schedule  Contribution</h3></a> 
            <img src="images/view.png" alt="Request Icon" class="view-icon">
            </a>
            <small class="text-muted">schedule a contribution for future date and amount.</small>
        </div>
       
    </div>
    <br>
 
</div>

<!--view contribution schedule-->
<div class="groups">               
    <img src="images/cont-schedule.png" alt="Request Icon" class="icon">   
   
    <div class="middle">
        <div class="left">
            <a href="contribution_schedule.php"><h3>View Contribution Schedule</h3>
            <img src="images/view.png" alt="Request Icon" class="view-icon">
            </a>
            <small class="text-muted">List of Scheduled Contributions</small>
          
        </div>
       
    </div>
    <br>
 
</div>

<!--view Transaction history-->
<div class="groups">               
    <img src="images/contribution-history.png" alt="Request Icon" class="icon">   
   
    <div class="middle">
        <div class="left">
            <a href="contribution_history.php"><h3>View Contribution History</h3>
            <img src="images/view.png" alt="Request Icon" class="view-icon">
            </a>
            <small class="text-muted"> contributions made by members are shown here.</small>
          
        </div>
       
    </div>
    <br>
 
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




</div>
    
   </div>  


   <div class="footer">
    <div class="row">
        <div class="copyright">
            © 2023 All rights reserved.
        </div>
    </div>
   </div>

   <script src="js/admin.js"></script>
</body>
</html>