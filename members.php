<?php
require 'session.php';


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin-contributions</title>
    <link rel="stylesheet" href="admin.css">
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
            <a href="members.php" class="active">
                <span class="material-icons-sharp">person_outline</span>
                <h3>Members</h3>
            </a>
           
            <a href="analytics.php">
                <span class="material-icons-sharp">insights</span>
                <h3>Analytics</h3>
            </a>
           
            <a href="contributions.php">
                <span class="material-icons-sharp">inventory</span>
                <h3>Record Contributions</h3>
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
        <h1>Group Members</h1>
        <table>
            <thead>
                <tr>
                    <th>Member Id</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Phone Number</th>
                    <th>Email</th>
                    <th>Role</th>                                    
                </tr>
            </thead>
            <tbody>
           
            
          
               
               
            </tbody>
        </table>

      
    
        
   
    </main>
<!--this ends main-->

<div class="right">
    <div class="top">
        <button id="menu-btn">
            <span class="material-icons-sharp">menu</span>
        </button>
      
        <div class="profile">
            <div class="info">
                <p>Hi, <b><?php echo $user_name; ?></b></p>
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