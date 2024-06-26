<?php
require 'session.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin-schedule-contribution</title>
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/event.css">
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
           
            <a href="contributions.php"  class="active">
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
        <h1> Schedule Contribution</h1>
        <button class="btn-back"><a href="contributions.php">Back</a></button>
        <div class="events">
            <h3>Schedule Member Contribution</h3>
            <div class="form-container">
            <div class="events-form">                
                <form action="schedule_contribution_db.php" method="post">
               
                <div class="form-group">
                    <label for="id">Member's ID</label>
                    <input type="number" id="memberId" name="memberId" required>                    
                </div>

                <div class="form-group">
                    <label for="id">Contribution Amount From Each Member</label>
                    <input type="number" id="contributionAmount" name="contributionAmount" required>                    
                </div>
            
            
              
    
                <div class="form-group">
                    <label for="date">Contribution Dateline</label>
                    <input type="date" id="contribution_date" name="contribution_date" required>                     
                </div>
             
               
                <div class="form-group">
                    <button type="submit" name="submit">Schedule</button>
                </div>
                </form>
                
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

<div class="events">
    <ul>
        <li><a href="contribution_progress.php">Contribution Progress</a><img src="images/view.png" alt="Request Icon" class="view-icon"></li>
        <li><a href="contribution_history.php">View Contribution History</a><img src="images/view.png" alt="Request Icon" class="view-icon"></li>
        <li><a href="contribution_schedule.php">Contribution Schedule</a><img src="images/view.png" alt="Request Icon" class="view-icon"></li>
          </ul>
          </ul>
   
    
    
    
</div>
                </div>

</div>
    
   </div>  

   


<!--footer starts here-->


   <div class="footer">
    <div class="row">
        <div class="copyright">
            © 2023 All rights reserved.
        </div>
    </div>
   </div>
   <script src="js/contribution.js"></script>
   <script src="js/admin.js"></script>
  
</body>
</html>