<?php
require 'session.php';
require 'connection.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin-contributions</title>
    <link rel="stylesheet" href="members.css">
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
        <h1>Group Members</h1>
       
    <?php
            $query = "SELECT memberId, fName, lName, phone, email, role, registration_date FROM members";
            $result = mysqli_query($conn, $query);
            if ($result) {
                echo '<form action="" method="get">
                <label for="search">Search:</label>
                <input type="text" id="search" name="search">
                <button class="form-btn" type="submit">Search</button>
              </form>';

                echo '<table>
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Phone Number</th>
                                <th>Email</th>
                                <th>Role</th> 
                                <th>Actions</th>                                   
                            </tr>
                        </thead>
                        <tbody>';
            
             // Fetch data and populate the table
             while ($row = mysqli_fetch_assoc($result)) {
              echo '<tr>';
              echo '<td>' . $row['memberId'] . '</td>';
              echo '<td>' . $row['fName'] . '</td>';
              echo '<td>' . $row['lName'] . '</td>';
              echo '<td>' . $row['phone'] . '</td>';
              echo '<td>' . $row['email'] . '</td>';
              echo '<td>' . $row['role'] . '</td>';
              echo '<td>
                  <button class="view-btn" onclick="viewDetails(' . $row['memberId'] . ')">View Details</button>
                  <button class="edit-btn" onclick="editMember(' . $row['memberId'] . ')">Edit</button>
                  <button class="deactivate-btn" onclick="deactivateMember(' . $row['memberId'] . ')">Deactivate</button>
              </td>';
          
              echo '</tr>';}

            
                echo '</tbody></table>';                

                //getting total number of members
                $totalMembers = mysqli_num_rows($result);
                //showing number of entries being shown
                $entriesShown = mysqli_num_rows($result);
                echo '<p>Showing ' . $entriesShown . ' / ' . $totalMembers . '</p>';

    
                // Free the result set
                mysqli_free_result($result);
            } else {
                // Display an error message if the query fails
                echo "Error executing query: " . mysqli_error($conn);
            }
            
            // Close the database connection
            mysqli_close($conn);
            ?>

      
    
        
   
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


<div class="all-details" style="display:none;">
    <h2 class="details-heading">More Details</h2>
    <div class="events" id="memberDetails">       <!--style="display:none;" -->
        <div class="detail">
            <h3>Date Joined:</h3>
            <p class="date" id="dateJoined">3/3/2014</p>
            </div> 
        
        <div class="detail">
            <h3>Total Contributions made Upto Date:</h3>
            <p class="amount" id="totalContributions">KSH 10000 </p>
        </div>
        <div class="detail">
            <h3>Last Contribution Made:</h3>
            <p class="amount" id="lastContribution">KSH 3000</p>
        </div>
        <div class="detail">
            <h3>Total Loans Borrowed Upto date:</h3>
            <p class="amount" id="totalLoansBorrowed">KSH 40000</p>
        </div>
        <div class="detail">
            <h3>Total Loans Repayed Upto Date:</h3>
            <p class="amount" id="totalLoansRepaid">KSH 30000</p>
        </div>
        <div class="detail">
            <h3>Loan Limit:</h3>
            <p class="amount" id="loanLimit">KSH 50000</p>
        </div>
        <div class="detail">
            <h3>Loan Balance:</h3>
            <p class="amount" id="loanBalance">KSH 6000</p>
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
   <script src="members.js"></script>
   
</body>
</html>

