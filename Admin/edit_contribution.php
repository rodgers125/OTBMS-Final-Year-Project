<?php
require 'session.php';
require 'connection.php';


// Fetching contribution_schedule details from the database based on contribution_id
if (isset($_GET['contribution_id'])) {
    $contribution_id = $_GET['contribution_id'];

    $query = "SELECT * FROM contribution_schedule WHERE contribution_id = $contribution_id";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $scheduleData = mysqli_fetch_assoc($result);
    } else {
        echo "<script> alert('The Contribution Schedule wasn't found!');</script>";
        exit();
    }
} else {
    echo "<script> alert('The Contribution Schedule wasn't found!');</script>";
    exit();
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    
    $member_id = $_POST['member_id'];
    $cont_amount = $_POST['cont_amount'];
    $payment_option = $_POST['payment_option'];
    $mpesa_till = $_POST['mpesa_till'];
    $mpesa_number = $_POST['mpesa_number'];
    $acc_holder = $_POST['acc_holder'];
    $bank_name = $_POST['bank_name'];
    $acc_number = $_POST['acc_number'];
    $cont_dateline = $_POST['cont_dateline'];


    // Update 'events' table in db
    $query = "UPDATE contribution_schedule SET member_id = '$member_id', cont_amount = '$cont_amount',
     payment_option = '$payment_option', mpesa_till = '$mpesa_till', mpesa_number = '$mpesa_number',
      acc_holder = '$acc_holder', bank_name = '$bank_name', acc_number = '$acc_number',
       cont_dateline = '$cont_dateline' WHERE contribution_id = '$contribution_id'";

    // Execute the query
    $result = mysqli_query($conn, $query);

    // Display a success or error message
    if ($result) {
        echo "<script> alert('Contribution Schedule updated successfully!');</script>";
    } else {
        echo "<script> alert('Error Updating the Contribution Schedule!');</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin-contributions</title>    
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/event.css">
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
            <a href="members.php">
                <span class="material-icons-sharp">person_outline</span>
                <h3>Members</h3>
            </a>
           
            <a href="contributions.php"  class="active">
                <span class="material-icons-sharp">insights</span>
                <h3>Contributions</h3>
            </a>
            <a href="loans.php">
                <span class="material-icons-sharp">insights</span>
                <h3>Loans</h3>
            </a>
            <a href="transactions.php">
                <span class="material-icons-sharp">receipt</span>
                <h3>Payment Receipts</h3>
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

<!-- edit event-->
<h2>► Edit Member Contribution Schedule</h2>

    
    <!-- Form to edit member information -->
    <div class="form-container">
            <div class="events-form">                
                <form action="" method="post">
               
                <div class="form-group">
                    <label for="id">Member's ID</label>
                    <input type="number" id="member_id" name="member_id" value="<?php echo $scheduleData['member_id']; ?>" required>                    
                </div>

                <div class="form-group">
                    <label for="id">Contribution Amount From Each Member</label>
                    <input type="number" id="cont_amount" name="cont_amount" value="<?php echo $scheduleData['cont_amount']; ?>" required>                    
                </div>
                <div class="form-group">
                <label for="payment_options">Payment Options:</label>
                <select id="payment_options" name="payment_option">
                <option value="">Select Payment Option</option>
                <option value="mpesa">M-Pesa</option>
                <option value="bank_deposit">Bank Deposit</option>
               </select>
                </div>

                <div class = "form-group" id="mpesa_options" style="display: none;">
                     <label for="mpesa_sub_options">Select M-Pesa Options:</label>
                     <select id="mpesa_sub_options" name="mpesa_sub_options">
                        <option value="">Select M-Pesa Option</option>
                        <option value="till_number">Till Number</option>
                        <option value="send_money">Send Money</option>
                     </select>
                     <div id="mpesa_till" style="display: none;">
                        <label for="mpesa_input_field">Enter Till Number:</label>
                   <input type="number" id="mpesa_till" name = "mpesa_till" value="<?php echo $scheduleData['mpesa_till']; ?>">
                 </div>
                 <div id="mpesa_number" style="display: none;">
                        <label for="mpesa_input_field">Enter Mpesa Number:</label>
                   <input type="number" id="mpesa_number" name = "mpesa_number" value="<?php echo $scheduleData['mpesa_number']; ?>">
                 </div>
                </div>

                    <div  class = "form-group" id="bank_deposit_options" style="display: none;">
               <label for="account_holder">Account Holder:</label>
              <input type="text" id="acc_holder" name = "acc_holder" value="<?php echo $scheduleData['acc_holder']; ?>">
                 <label for="bank">Bank:</label>
             <input type="text" id="bank_name" name = "bank_name" value="<?php echo $scheduleData['bank_name']; ?>">
             <label for="account_number">Account Number:</label>
             <input type="text" id="acc_number" name ="acc_number" value="<?php echo $scheduleData['acc_number']; ?>">
                </div>
              
              
    
                <div class="form-group">
                    <label for="date">Contribution Dateline</label>
                    <input type="date" id="cont_dateline" name="cont_dateline" value="<?php echo $scheduleData['cont_dateline']; ?>" required>                     
                </div>
             
               
                <div class="form-group">
                    <button type="submit" name="submit">Update</button>
                </div>
                </form>
                
            </div>
           
    </div>
    <button class="back">
        <a href="contribution_schedule.php">Back</a>
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
                
   
   <script src="js/contribution.js"></script>
   <script src="js/admin.js"></script>
    
   
</body>
</html>
