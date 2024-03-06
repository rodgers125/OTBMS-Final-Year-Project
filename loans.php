<?php
require 'session.php';
require 'connection.php';

$query = "SELECT * FROM contributions ORDER BY date DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin-dashboard</title>
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="icons.css"> 
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
           
            <a href="analytics.php">
                <span class="material-icons-sharp">insights</span>
                <h3>Contributions</h3>
            </a>
            <a href="loans.php" class="active">
                <span class="material-icons-sharp">insights</span>
                <h3>Loans</h3>
            </a>
            <a href="events.php">
                <span class="material-icons-sharp">inventory</span>
                <h3>Events</h3>
            </a>
            <a href="reports.php">
                <span class="material-icons-sharp">report_gmailerrorred</span>
                <h3>Reports</h3>
            </a>
                      
            <a href="logout.php" id="logoutLink">
                <span class="material-icons-sharp">logout</span>
                <h3>Logout</h3>
            </a>
        </div>
    </aside>

    <!-- Main Content -->
    <main>
        <h1>Loans</h1>

        <div class="insights">

            <!--loan requests-->
            <div class="groups">               
                <img src="images/loan-request.png" alt="Request Icon" class="icon">   
               
                <div class="middle">
                    <div class="left">
                        <a href="loan_request.php"><h3>View Loan Requests</h3>
                        <img src="images/view.png" alt="Request Icon" class="view-icon">
                        </a>
                        <small class="text-muted">25 pending requests</small>
                    </div>
                   
                </div>
                <br>
             
            </div>
            
            <!--view loan details-->
            <div class="groups">               
                <img src="images/loan-list.png" alt="Request Icon" class="icon">   
               
                <div class="middle">
                    <div class="left">
                        <a href="loan_list.php"><h3>View Loan List and Details</h3>
                        <img src="images/view.png" alt="Request Icon" class="view-icon">
                        </a>
                        <small class="text-muted">25 Total Active Loans</small>
                      
                    </div>
                   
                </div>
                <br>
             
            </div>
            
            <!--loan analytics-->
            <div class="groups">               
                <img src="images/loan-analytics.png" alt="Request Icon" class="icon">   
               
                <div class="middle">
                    <div class="left">
                        <a href="loan_analytics.php"><h3>View Loan Analytics</h3>
                        <img src="images/view.png" alt="Request Icon" class="view-icon">
                        </a>
                        <small class="text-muted">loan insights</small>
                    </div>
                   
                </div>
                <br>
             
            </div>

            <!--loan history-->
            <div class="groups">               
                <img src="images/loan-history.png" alt="Request Icon" class="icon">   
               
                <div class="middle">
                    <div class="left">
                        <a href="loan_history.php"><h3>View Loan History</h3>
                        <img src="images/view.png" alt="Request Icon" class="view-icon">
                        </a>
                        <small class="text-muted">25 Total all time Loans</small>
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


<div class="upcoming-events">
<h2>Upcoming Events</h2>
<div class="events">
    <div class="event">
        <div class="event-photo">
            <img src="./images/event.png" alt="">
        </div>
        <div class="event-about">
            <p><b>2/1/2024</b> Group Meeting</p>
        </div>
    </div>
    <div class="event">
        <div class="event-photo">
            <img src="./images/event.png" alt="">
        </div>
        <div class="event-about">
            <p><b>17/2/2024</b> Group Meeting</p>
        </div>
    </div>
    <div class="event">
        <div class="event-photo">
            <img src="./images/event.png" alt="">
        </div>
        <div class="event-about">
            <p><b>20/3/2024</b> Group Meeting</p>
        </div>
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

   <script src="admin.js"></script>
</body>
</html>