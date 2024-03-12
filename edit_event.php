<?php
require 'session.php';
require 'connection.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $event_id = $_POST['event_id'];
    $event_title = $_POST['event_title'];
    $event_description = $_POST['event_description'];
    $event_type = $_POST['event_type'];
    $event_date = $_POST['event_date'];

    // Update 'events' table in db
    $query = "UPDATE events SET event_title = '$event_title', event_description = '$event_description', event_type = '$event_type', event_date = '$event_date' WHERE event_id = '$event_id'";

    // Execute the query
    $result = mysqli_query($conn, $query);

    // Display a success or error message
    if ($result) {
        $message = 'Event updated successfully!';
        $color = 'var(--color-success)';
    } else {
        $message = 'Error updating event: ' . mysqli_error($conn);
        $color = 'red';
    }
}

// Fetching event details from the database based on event_id
if (isset($_GET['event_id'])) {
    $event_id = $_GET['event_id'];

    $query = "SELECT * FROM events WHERE event_id = $event_id";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $eventData = mysqli_fetch_assoc($result);
    } else {
        echo "The Event wasn't found";
        exit();
    }
} else {
    echo "The Event wasn't found";
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
            <a href="transactions.php">
                <span class="material-icons-sharp">report_gmailerrorred</span>
                <h3>Transactions</h3>
            </a>
            <a href="events.php" class="active">
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
        <input type="hidden" name="event_id" value="<?php echo $eventData['event_id']; ?>">
        <label for="event_title">Title</label>
        <input type="text" id="event_title" name="event_title" value="<?php echo $eventData['event_title']; ?>" required><br>

        <label for="event_description">Description</label>
        <input type="text" id="event_description" name="event_description" value="<?php echo $eventData['event_description']; ?>" required><br>

        <label for="event_type">Event Type</label>
        <input type="text" id="event_type" name="event_type" value="<?php echo $eventData['event_type']; ?>" required><br>

        <label for="event_date">When?</label>
        <input type="date" id="event_date" name="event_date" value="<?php echo $memberData['event_date']; ?>" required><br>

       
        <button type="submit">Update</button>
        <?php if (isset($message)) : ?>
        <p class="message"><?php echo $message; ?></p>
    <?php endif; ?>
    </form>
    <button class="back">
        <a href="all_events.php">Back</a>
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
