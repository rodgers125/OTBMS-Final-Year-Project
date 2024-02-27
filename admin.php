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
            <a href="admin.php" class="active">
                <span class="material-icons-sharp">grid_view</span>
                <h3>Dashboard</h3>
            </a>
            <a href="members.php">
                <span class="material-icons-sharp">person_outline</span>
                <h3>Members</h3>
            </a>
           
            <a href="analytics.php">
                <span class="material-icons-sharp">insights</span>
                <h3>Analytics</h3>
            </a>
            <a href="loans.php">
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
        <h1>Dashboard</h1>

        <div class="insights">

            <!--groups-->
            <div class="groups">
                <span class="material-icons-sharp">analytics</span>
                <div class="middle">
                    <div class="left">
                        <h3>Total Group Members</h3>
                        <h1>25</h1>
                    </div>
                   
                </div>
                <br>
                <small class="text-muted">All Time</small>
            </div>
            
            <!--members-->
            <div class="group_members">
                <span class="material-icons-sharp">bar_chart</span>
                <div class="middle">
                    <div class="left">
                        <h3>Total Amount of Loaned Issued</h3>
                        <h1>KSh72,500</h1>
                    </div>
                 
                </div>
                <small class="text-muted">Last 1 Month</small>
            </div>

            
            <!--contributions-->
            <div class="group_contributions">
                <span class="material-icons-sharp">stacked_line_chart</span>
                <div class="middle">
                    <div class="left">
                        <h3>Total Contributions</h3>
                        <h1>KSh20,000</h1>
                    </div>
                    <div class="progress">
                        <svg>
                            <circle cx='38' cy='38' r='36'></circle>
                        </svg>
                        <div class="number">
                            <p>80%</p>
                        </div>
                    </div>
                </div>
                <small class="text-muted">This Month Alone</small>
            </div>


        </div>
        <!--table of transactions-->

    <div class="recent-transactions">
        <h2>Contributions</h2>
        <table>
            <thead>
                <tr>
                    <th>Contribution ID</th>
                    <th>Member Name</th>
                    <th>Date of Payment</th>
                    <th>Amount</th>
                    <th>Description</th>
                    <th>Delete Record</th>
                    
                </tr>
            </thead>
            <tbody>
           
            <?php
                    // Check if there are any records
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $row['contid'] . "</td>";
                            echo "<td>" . $row['fullname'] . "</td>";
                            echo "<td>" . $row['date'] . "</td>";
                            echo "<td>" . $row['amount'] . "</td>";
                            echo "<td>" . $row['description'] . "</td>";
                            echo "<td><button class='delete-btn' onclick=\"deleteContribution(" . $row['contid'] . ")\">Delete</button></td>";
                          
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>No records found.</td></tr>";
                    }
                    ?>
               
               
            </tbody>
        </table>
        <a href="analytics.php">Show All</a>
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