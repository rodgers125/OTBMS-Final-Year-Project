<?php
require 'session.php';
require 'connection.php';



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ONLINECHAMA-Loans</title>
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/loan.css">
    <link rel="stylesheet" href="css/contribution.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp">

</head>
<body>

   <div class="container">
   <?php
  include 'notification_counter.php';
  ?>
    <!--sidebar menu-->
    <aside>
        <div class="top">
            <div class="logo">
                <img src="images/hero.png">
                <h2>ONLINE<span class="success">CHAMA</span></h2>
            </div>
            <div class="close" id="close-btn">
                <span class="material-icons-sharp">close</span>
            </div>
        </div>

        <div class="sidebar">
            <a href="member_dashboard.php">
                <span class="material-icons-sharp">grid_view</span>
                <h3>Account Overview</h3>
            </a>
            
            <a href="contribution.php">
                <span class="material-icons-sharp">person_outline</span>
                <h3>Contribution</h3>
            </a>
           
            <a href="loan.php"  class="active">
                <span class="material-icons-sharp">insights</span>
                <h3>Loans</h3>
            </a>
           
            
            <a href="transaction.php">
                <span class="material-icons-sharp">receipt</span>
                <h3>Payment Receipts</h3>
            </a>
            <a href="notifications.php">
                <span class="material-icons-sharp">notifications</span>
                <h3>Notifications <span class="notification-counter"><?= $notificationCount ?></span></h3>
            </a>
            <a href="settings.php">
                <span class="material-icons-sharp">settings</span>
                <h3>Settings</h3>
            </a>
          
                      
            <a href="logout.php" id="logoutLink">
                <span class="material-icons-sharp">logout</span>
                <h3>Logout</h3>
            </a>
        </div>
    </aside>

    <!-- Main Content -->
    <main>
    <h1> ► Loans</h1>
    <br>
    <div class="loan-details">
        <!-- Loan Balance Card -->
        <div class="loan-card">
        <?php
// Include the loan_db.php file to access $total_loan_balance
include 'loan_db.php';
?>
        <h2>Loan Balance</h2> 
        <br>
                        <p>KSH <?php echo $total_loan_balance; ?></p>  
                        <br>
                        
        </div>

        <!-- Loan Limit Card -->
        <div class="loan-card">
        <h2>Loan Application</h2> 
        <br>
                        
                        <button class="btn-apply">Apply for a loan</button>
        </div>
        
    </div>
<br>

   <?php
   include 'loan_history.php';
   ?>

    <!-- Loan Application Modal -->
<div id="loanApplicationModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <h2>Loan Application</h2>
    <form id="loanApplicationForm" action="send_loan_application.php" method="post">
    <div class="form-group">
    <input type="hidden" id="memberId" name="memberId" value="<?php echo isset($_SESSION['user_id']) ? $_SESSION['user_id'] : ''; ?>">
    </div>
      <div class="form-group">
        <label for="loanType">Loan Type:</label>
        <select id="loanType" name="loanType">
        <option value="Default">Click to Select Type</option>
          <option value="personal">Personal</option>
          <option value="business">Business</option>
        </select>
      </div>
      <div class="form-group">
        <label for="repaymentPeriod">Repayment Period:</label>
        <select id="repaymentPeriod" name="repaymentPeriod">
          
        </select>
      </div>
      <div class="form-group">
    <label for="loanAmount">Enter Amount you want to borrow</label>
    <input type="number" id="loanAmount" name="loanAmount">
</div>

      <button type="submit">Apply</button>
    </form>
  </div>
</div>

<!-- Payment Modal -->
<div id="contPaymentModal" class="modal">
  <div class="modal-content">
  <form id="paymentProof" action="paymentProof_loan.php" method="post">
    <span class="close">&times;</span>
    <h2>Payment Proof for Loan Repayment:</h2>
    <br>
    <div class="form-group">
        
      <label for="payment_method">Loan Type:</label>
      <select id="payment_method" name="payment_method" onchange="showPaymentDetails()">
        <option value="Default">Click to Select Payment Method</option>
        
        <option value="Mpesa">Mpesa Paybill</option>
        <option value="Bank">Bank Transfer</option>
      </select>
      <br>
      <br>
      
      <!-- Mpesa paybill option -->
      <div id="mpesa" style="display:none">
        <h3>Mpesa Paybill</h3>
        <ul>
          <li>Paybill - <b>247247</b></li>
          <li>Account Number - <b>1840179997117</b></li>
        </ul>
      </div>
      <!-- Bank transfer option -->
      <div id="bank_transfer" style="display:none">
        <h3>Bank Transfer</h3>
        <ul>
          <li>Bank Name - <b>Equity Bank</b></li>
          <li>Account Number - <b>1840179997117</b></li>
        </ul>
      </div>
    </div>
    <br>
    <small id="paymentCodeLabel" style="display:none">Enter the Payment Code here (Mpesa or Bank Code you received after paying).</small>
    
      <div class="form-group">
        <input type="hidden" id="memberId" name="memberId" value="<?php echo isset($_SESSION['user_id']) ? $_SESSION['user_id'] : ''; ?>">
      </div>
      <div class="form-group">
        <input type="hidden" id="loanId" name="loanId" value="<?php echo $loanId; ?>">
      </div>
      <div class="form-group" id="paymentCodeGroup" style="display:none">
        <input type="text" id="paymentCode" name="paymentCode" placeholder="Payment Code">
      </div>
      <div class="form-group">
        <input type="hidden" id="purpose" name="purpose" value="loanRepayment">
      </div>
      <button type="submit" id="submitButton" style="display:none">Submit</button>
    </form>
  </div>
</div>

</main>

<!--this ends main-->

<div class="right">
    <div class="top">
        
      
        <div class="profile">
            <div class="info">
                <?php if (isset($_SESSION['user_name'])) : ?>
                    <p>Hi, <b><?php echo $_SESSION['user_name']; ?></b></p>
                <?php else : ?>
                    <p>Hi, <b>Guest</b></p>
                <?php endif; ?>
                <small class="text-muted">Member</small>
            </div>
            <div class="profile-photo">
                <a href="settings.php"><img src="./images/profile-1.png" alt=""></a>
            </div>
        </div>
    </div>
                    
<!--end of top-->



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

   <script src="js/index.js"></script>
   <script src="js/loan.js"></script>
   <script src="js/repay.js"></script>
</body>
</html>