<?php
require 'session.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $member = $_POST['member'];
    $date = $_POST['date'];
    $amount = $_POST['amount'];
    $description = $_POST['description'];

    // SQL query to insert data into the "contributions" table
    $query = "INSERT INTO contributions (fullname, date, amount, description) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        // Bind parameters and execute the statement
        mysqli_stmt_bind_param($stmt, "ssds", $member, $date, $amount, $description);
        mysqli_stmt_execute($stmt);

        // Check for success
        if (mysqli_stmt_affected_rows($stmt) > 0) {
            echo "<script>alert('Contribution recorded successfully');</script>";
        } else {
            echo "<script>alert('Failed to record contribution');</script>";
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        echo "<script>alert('Error in prepared statement');</script>";
    }

    // Close the database connection
    mysqli_close($conn);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin-contributions</title>
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="contribution.css">
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
           
           
            <a href="contributions.php">
                <span class="material-icons-sharp">insights</span>
                <h3>Contributions</h3>
            </a>
            <a href="loans.php">
                <span class="material-icons-sharp">insights</span>
                <h3>Loans</h3>
            </a>
            <a href="transactions.php" class="active">
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
        <h1>Transactions</h1>

      
        <div class="insights">

<!--record a transaction-->
<div class="groups">               
    <img src="images/transaction-record.png" alt="Request Icon" class="icon">   
   
    <div class="middle">
        <div class="left">
            <a href="record_transaction.php"><h3>Record a Transaction</h3>
            <img src="images/view.png" alt="Request Icon" class="view-icon">
            </a>
            <small class="text-muted">Loans and Contribution</small>
        </div>
       
    </div>
    <br>
 
</div>

<!--view Transaction history-->
<div class="groups">               
    <img src="images/transaction-history.png" alt="Request Icon" class="icon">   
   
    <div class="middle">
        <div class="left">
            <a href="transactions_history.php"><h3>View Transactions</h3>
            <img src="images/view.png" alt="Request Icon" class="view-icon">
            </a>
            <small class="text-muted">25 Total Transactions</small>
          
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