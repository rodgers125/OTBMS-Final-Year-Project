<?php
require 'session.php';
require 'connection.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin-members</title>
    <link rel="stylesheet" href="css/members.css">
    <link rel="stylesheet" href="css/loan_analytics.css">
    <link rel="stylesheet" href="css/icons.css">
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/contribution.css"> 
    
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
        <h1>► Group Members</h1>
        <button class="btn-back"><a href="members.php">Back</a></button>

       
        <?php
            $query = "SELECT memberId, fName, lName, phone, email, gender, role, status FROM members";
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
                    <th>#Id</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Phone Number</th>
                    <th>Email</th>
                    <th>Gender</th>
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
        echo '<td>' . $row['gender'] . '</td>';
        echo '<td>' . $row['role'] . '</td>';
       
        echo '<td>                
                
                <button class="edit-btn" onclick="editMember(' . $row['memberId'] . ')">Edit</button>';
                

        if ($row['status'] === 'active') {
            echo '<button class="deactivate-btn" onclick="toggleStatus(' . $row['memberId'] . ', \'deactivate\')">Deactivate</button>';
        } else {
            echo '<button class="deactivate-btn" onclick="toggleStatus(' . $row['memberId'] . ', \'activate\')">Activate</button>';
        }

        echo '</td>';

        echo '</tr>';
    }

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

<div class="upcoming-events">

<div class="events">
<ul>
        <li><a href="add_members.php">Add User</a><img src="images/view.png" alt="Request Icon" class="view-icon"></li>
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
                
   <script src="js/admin.js"></script>
   <script src="js/members.js"></script>
   
</body>
</html>

