<?php
require 'session.php';
require 'connection.php';


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin-Loan-Analytics</title>
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="icons.css"> 
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp"> 
    <link rel="stylesheet" href="loan_analytics.css">

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
           
            <a href="contributions.php">
                <span class="material-icons-sharp">insights</span>
                <h3>Contributions</h3>
            </a>
            <a href="loans.php" class="active">
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
       
               
    <h1>► Loan Analytics</h1>
        <button class="btn-back"><a href="loans.php">Back</a></button>

        <div class="insights">

            <!--pie chart-->
            <div class="groups">
                <div class="middle">
                    <div class="left">
                        <h2>Total Amount Disbursed</h2>
                        <div class="pie-chart">
                            <canvas id="pieChart"></canvas>
                            <div class="legend">
                                <div class="legend-item">
                                    <div class="legend-color" style="background-color: #FFD700;"></div>
                                    <div>
                                        <p>Personal Loans</p>
                                        <p>Amount: <b>KSH 35000</b></p>
                                    </div>
                                </div>
                                <div class="legend-item">
                                    <div class="legend-color" style="background-color: #00FFFF;"></div>
                                    <div>
                                        <p>Business Loans</p>
                                        <p>Amount: <b>KSH 60000</b></p>
                                    </div>
                                </div>
                            </div>
                        </div>            
                    </div>
                </div>
            </div>

            

        </div>

        <!--top borrowers table-->
        <div class="table">
        <h2>Top Borrowers</h2>
        <table>
          
        <thead>
       
            <tr>
           
                <th>Member ID</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Total Amount Borrowed</th>
            </tr>
        </thead>
        <tbody>
            <!-- Table rows will be dynamically generated here based on data from the database -->
            <tr>
                <td>1</td>
                <td>John Doe</td>
                <td>johndoe@example.com</td>
                <td>KSH5,000.00</td>
            </tr>
            <!-- Add more rows as needed -->
        </tbody>
    </table>

        </div>

        <!--Frequent Borrowers  table-->

        <div class="table">
        <h2>Frequent Borrowers</h2>
        <table>
          
        <thead>
       
            <tr>
           
                <th>Member ID</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Times Borrowed</th>
            </tr>
        </thead>
        <tbody>
           
            <tr>
                <td>1</td>
                <td>John Doe</td>
                <td>johndoe@example.com</td>
                <td>10 times</td>
            </tr>
            <!-- Add more rows as needed -->
        </tbody>
    </table>

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
        <li><a href="loan_request.php">View Loan Request</a><img src="images/view.png" alt="Request Icon" class="view-icon"></li>
        <li><a href="loan_list.php">View Loans List and Details</a><img src="images/view.png" alt="Request Icon" class="view-icon"></li>
        <li><a href="loan_history.php">View Loans History</a><img src="images/view.png" alt="Request Icon" class="view-icon"></li>       
    </ul>
   
    
    
    
</div>
                </div>
            
<!--end of upcoming events-->


</div>
    
   </div>  


   <div class="footer">
    <div class="row">
        <div class="copyright">
            © 2023 All rights reserved.
        </div>
    </div>
   </div>

   
   <script src="chart.js"></script>
   <script src="admin.js"></script>
</body>
</html>