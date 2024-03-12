<?php
require 'session.php';
require 'connection.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $memberId = $_POST['memberId'];
    $fName = $_POST['fName'];
    $lName = $_POST['lName'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
   

   
    // Update member information in the database
    $query = "UPDATE members SET fName = '$fName', lName = '$lName', phone = '$phone', email = '$email' WHERE memberId = $memberId";

    // Execute the query
    $result = mysqli_query($conn, $query);

    // Display a success or error message
    if ($result) {
        $message = 'User information updated successfully!';
        $color = 'var(--color-success)';
    } else {
        $message = 'Error updating member: ' . mysqli_error($conn);
        $color = 'red';
    }
}

// Fetch member details from the database based on memberId
if (isset($_GET['memberId'])) {
    $memberId = $_GET['memberId'];

    // Replace the following with your actual database connection and query logic
    $query = "SELECT * FROM members WHERE memberId = $memberId";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $memberData = mysqli_fetch_assoc($result);
    } else {
        echo "Member not found.";
        exit();
    }
} else {
    echo "Member ID not provided.";
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin-contributions</title>    
    <link rel="stylesheet" href="edit_member.css">    
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="contribution.css">   
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp">

    <style>
        .message {
            color: <?php echo $color; ?>;
        }
    </style>

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

<!-- edit member information fom-->
<h2>Edit User Details</h2>

    
    <!-- Form to edit member information -->
    <form action="" method="post">
        <input type="hidden" name="memberId" value="<?php echo $memberData['memberId']; ?>">
        <label for="fName">First Name:</label>
        <input type="text" id="fName" name="fName" value="<?php echo $memberData['fName']; ?>" required><br>

        <label for="lName">Last Name:</label>
        <input type="text" id="lName" name="lName" value="<?php echo $memberData['lName']; ?>" required><br>

        <label for="phone">Phone Number:</label>
        <input type="text" id="phone" name="phone" value="<?php echo $memberData['phone']; ?>" required><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo $memberData['email']; ?>" required><br>

       

        
        <button type="submit">Update</button>
        <?php if (isset($message)) : ?>
        <p class="message"><?php echo $message; ?></p>
    <?php endif; ?>
    </form>
    <button class="back">
        <a href="members.php">Back</a>
    </button> 
   
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

   <div class="footer">
    <div class="row">
        <div class="copyright">
            © 2023 All rights reserved.
        </div>
    </div>
   </div>
                
   
   
   
</body>
</html>

