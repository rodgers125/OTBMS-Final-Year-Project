<?php
require 'session.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $member = $_POST['member'];
    $date = $_POST['date'];
    $amount = $_POST['amount'];
    $payment_method = $_POST['payment_method'];

    // SQL query to insert data into the "contributions" table
    $query = "INSERT INTO contributions (fullname, date, amount, description) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        // Bind parameters and execute the statement
        mysqli_stmt_bind_param($stmt, "ssds", $member, $date, $amount, $payment_method);
        mysqli_stmt_execute($stmt);

        // Check for success
        if (mysqli_stmt_affected_rows($stmt) > 0) {
            echo "<script>alert('Transaction recorded successfully');</script>";
        } else {
            echo "<script>alert('Failed to record Transaction');</script>";
            
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        echo "<script>alert('Error in prepared statement');</script>";
        // Add more detailed error message for development purposes
        // echo "<script>alert('".mysqli_error($conn)."');</script>";
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
    <title>Admin-record-transactions</title>
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/record_transaction.css">
    <link rel="stylesheet" href="css/loan_analytics.css">
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
           
           
            <a href="contributions.php">
                <span class="material-icons-sharp">insights</span>
                <h3>Contributions</h3>
            </a>
            <a href="loans.php">
                <span class="material-icons-sharp">insights</span>
                <h3>Loans</h3>
            </a>
            <a href="transactions.php" class="active">
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
        <h1>► Payment Receipts</h1>
        <button class="btn-back"><a href="transactions.php">Back</a></button>

      
    <div class="recent-transactions">
        <h2>Record a Payment</h2>               
        <div class="form-container">
            <div class="contribution-form">                
                <form action="record_transaction_db.php" method="post">

                <div class="form-group">
                    <label for="memberId">Member Id</label>
                    <input type="number" id="member_id" name="member_id" required>                    
                </div>
               
                <div class="form-group">
                    <label for="date">Date of Payment:</label><br>
                    <input type="date" id="date" name="date"/>                 
                                       
                </div>
                <div class="form-group">
                    <label for="amount">Amount:</label>
                    <input type="number" id="amount" name="amount" step="0.01" required>
                    
                </div>
                <div class="form-group">
                    <label for="purpose">Purpose</label>
                    <select id="purpose" name="purpose" required onchange="toggleMemberIdInput()"> 
                    <option value="default"><small>Click to Select Purpose</small></option>
                    <option value="loanRepayment">Loan Repayment</option>
                        <option value="contribution">Contribution Payment</option>                       
</select>                  
                </div>
                
                <div class="form-group" id="memberIdField" style="display: none;">
        <label for="memberId">Member Id for Contribution:</label>
        <input type="number" id="member_id_for_contribution" name="member_id_for_contribution">
    </div>

    <div class="form-group" id="loanIdField" style="display: none;">
        <label for="loanId">Loan Id for Payment:</label>
        <input type="number" id="loan_id_for_payment" name="loan_id_for_payment">
    </div>

                <div class="form-group">
                    <label for="payment_method">Payment Method:</label><br>
                    <select id="payment_method" name="payment_method" required>
                        <option value="Mpesa">Mpesa</option>
                        <option value="Bank Payment">Bank Payment</option>                        
                        
                    </select>
                </div>

                <div class="form-group">
                    <label for="paymentCode">Payment Code</label>
                    <input type="text" id="payment_code" name="payment_code" required>                    
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

<div class="events">
<ul>
        <li><a href="transactions_history.php">View Payment Receipts</a><img src="images/view.png" alt="Request Icon" class="view-icon"></li>
        <li><a href="payment_codes.php">Payment Codes</a><img src="images/view.png" alt="Request Icon" class="view-icon"></li>

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
   <script src="js/record_transaction.js"></script>

</body>
</html>