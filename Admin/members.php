<?php
require 'connection.php';
require 'session.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin-Members</title>
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
            <a href="members.php"  class="active">
                <span class="material-icons-sharp">person_outline</span>
                <h3>Members</h3>
            </a>
           
           
            <a href="contributions.php">
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
        <h1>► Members</h1>

      
        <div class="insights">

<!--add member-->
<div class="groups">               
    <img src="images/member.png" alt="Request Icon" class="icon">   
   
    <div class="middle">
        <div class="left">
            <a href="add_members.php"><h3>Add a Member</h3>
            <img src="images/view.png" alt="Request Icon" class="view-icon">
            </a>
            <small class="text-muted">members added to a group</small>
        </div>
       
    </div>
    <br>
 
</div>

<!--view members list-->
<div class="groups">               
    <img src="images/transaction-history.png" alt="Request Icon" class="icon">   
   
    <div class="middle">
        <div class="left">
            <a href="members_list.php"><h3>View Members List</h3>
            <img src="images/view.png" alt="Request Icon" class="view-icon">
            </a>
            <small class="text-muted">25 Total Group Members</small>
          
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