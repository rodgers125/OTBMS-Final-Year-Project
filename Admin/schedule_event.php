<?php
require 'session.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $event_title = $_POST['event_title'];
    $event_description = $_POST['event_description'];
    $event_type = $_POST['event_type'];
    $event_date = $_POST['event_date'];

    // SQL query to insert data into the "events" table
    $query = "INSERT INTO events (event_title, event_description, event_type, event_date) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        // Bind parameters and execute the statement
        mysqli_stmt_bind_param($stmt, "ssss", $event_title, $event_description, $event_type, $event_date);
        mysqli_stmt_execute($stmt);

        // Check for success
        if (mysqli_stmt_affected_rows($stmt) > 0) {
            echo "<script>alert('Event has been scheduled successfully');</script>";
        } else {
            echo "<script>alert('Failed to Schedule the event');</script>";
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
    <title>Admin-events</title>
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/event.css">
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
        <h1>► Events</h1>
        <button class="btn-back"><a href="events.php">Back</a></button>
        <div class="events">
            <h3>Schedule an Event</h3>
            <div class="form-container">
            <div class="events-form">                
                <form action="" method="post">
                <div class="form-group">
                    <label for="member">Title</label>
                    <input type="text" id="event_title" name="event_title" required>                    
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <input type="text" id="event_description" name="event_description" required>                    
                </div>
                <div class="form-group">
                    <label for="eventType">Event Type</label>
                    <select name="event_type" id="event_type" required>
                        <option value="virtual">Virtual</option>
                        <option value="physical">Physical</option>                        
                    </select>
                </div>
    
                <div class="form-group">
                    <label for="date">When?</label>
                    <input type="datetime-local" id="event_date" name="event_date"/>                     
                </div>
             
               
                <div class="form-group">
                    <button type="submit" name="submit">Schedule</button>
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
<h2>Upcoming Events</h2>
<div class="events">
<?php

require 'connection.php';

// Fetch events from the database, ordered by the most upcoming date
$query = "SELECT event_date, event_title FROM events ORDER BY event_date ASC LIMIT 3";
$result = mysqli_query($conn, $query);

if ($result) {
    // Loop through the events and generate HTML for each
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<div class="event">';
        echo '    <div class="event-photo">';
        echo '        <img src="./images/event.png" alt="">';
        echo '    </div>';
        echo '    <div class="event-about">';
        echo '        <p><b>' . $row['event_date'] . '</b> ' . $row['event_title'] . '</p>';
        echo '    </div>';
        echo '</div>';
    }

    // Free the result set
    mysqli_free_result($result);
} else {
    // Display an error message if the query fails
    echo "Error executing query: " . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
?>
<a href="all_events.php">View All</a>
    
    
</div>
</div>

</div>
    
   </div>  

   


<!--footer starts here-->


   <div class="footer">
    <div class="row">
        <div class="copyright">
            © 2023 All rights reserved.
        </div>
    </div>
   </div>
   <script src="events.js"></script>
   <script src="admin.js"></script>
  
</body>
</html>