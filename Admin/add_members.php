<?php

require 'session.php';
require 'connection.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin-add-member</title>
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="record_transaction.css">
    <link rel="stylesheet" href="loan_analytics.css">
    <link rel="stylesheet" href="members.css"> 
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
                <span class="material-icons-sharp">report_gmailerrorred</span>
                <h3>Transactions</h3>
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
        <h1>Members Form</h1>

      
    <div class="recent-transactions">
        <h2>Add Member</h2>               
        <div class="form-container">
            <div class="contribution-form">                
                <form action="add_member_db.php" method="post">
                <div class="form-group">
                    <label for="firstname">First Name<span>*</span></label>
                    <input type="text" id="fName" name="fName" placeholder="e.g Andrew" required>
                </div>
                <div class="form-group">
                    <label for="lastname">Last Name<span>*</span></label>
                    <input type="text" id="lName" name="lName" placeholder="e.g maina" required>
                </div>
                <div class="form-group">
                    <label for="email">Email<span>*</span></label>
                    <input type="email" id="email" name="email" placeholder="e.g abc@gmail.com" required>
                </div>
                <div class="form-group">
                    <label for="phone">Phone Number<span>*</span></label>
                    <input type="text" id="phone" name="phone" pattern="07\d{8}" placeholder="e.g 0712345678" required>
                    <small class="text-muted">Please enter a 10-digit phone number starting with '07'.</small>
                </div>
                <div class="form-group">
        <label for="gender">Gender</label>
        <select id="gender" name="gender">
          <option value="male">Male</option>
          <option value="female">Female</option>
        </select>
      </div>
                <div class="form-group">
                    <label for="password">Default Password<span>*</span></label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="form-group">
                    <label for="password">Confirm Password</label>
                    <input type="password" id="ConfirmPassword" name="confirmPassword" required>
                    <p class="error-message" id="passwordError"></p>
                </div>

                <div class="form-group">
                    <button type="submit" name="submit">Record</button>
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
<h2>Related Pages</h2>
<div class="events">
<ul>
        <li><a href="members_list.php">View Members List</a><img src="images/view.png" alt="Request Icon" class="view-icon"></li>
      </ul>
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
   <script src="record_transaction.js"></script>

</body>
</html>