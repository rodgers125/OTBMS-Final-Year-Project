<?php
require 'session.php';
require 'connection.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ONLINE CHAMA - Contribution</title>
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/loan.css"> 
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
            
            <a href="contribution.php"  class="active">
                <span class="material-icons-sharp">person_outline</span>
                <h3>Contribution</h3>
            </a>
           
            <a href="loan.php">
                <span class="material-icons-sharp">insights</span>
                <h3>Loans</h3>
            </a>
           
            
            <a href="transaction.php">
                <span class="material-icons-sharp">receipt</span>
                <h3>Payment Receipts</h3>
            </a>
            <a href="notifications.php">
                <span class="material-icons-sharp">notifications</span>
                <h3>Notifications</h3>
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

    <?php
       include 'contribution_schedule_db.php';
       ?>
    <main>
    <h1>► Contribution</h1>
    <br>
    <div class="loan-details">
        <!-- Loan Balance Card -->
        <div class="loan-card">
        <h2>Your Total Contributions</h2> 
        <br>
             <p>KSH <?php echo $contributedAmount; ?></p>                         
                        
        </div>

        <!-- Loan Limit Card -->
        <div class="loan-card">
        <h2>Your Next Contribution</h2> 
        <br>
                        <p><?php echo $yourContributionDate; ?></p>
                        
        </div>
        
    </div>
<br>
<div class="loan-details">
    <div class="loan-card">
        <h2>Current Member Being Contributed:</h2>
        <br>
        <p><b>Member ID :</b><?php echo $member_id; ?></li>
        <p><b>Full Name :</b><?php echo $fullName; ?></p>
        <p><b>Email :</b><?php echo $email; ?></p>
        <p><b>Phone Number :</b><?php echo $phone_number; ?></p>
    </div>

    <div class="loan-card">
        <h2>Contribution Details:</h2>
        <br>
        <p><b>Total Amount To Be Contributed By Each Member :</b> <?php echo $cont_amount; ?></p>
        
        
        <p><b>DateLine :</b> <?php echo $cont_dateline; ?></p>
        <br>
    <button class="btn-submit">Contribute Now</button>
    </div>
    

    <!-- Payment Modal -->
<div id="contPaymentModal" class="modal">
  <div class="modal-content">
  <form id="paymentProof" action="paymentProof_contribution.php" method="post">
    <span class="close">&times;</span>
    <h2>Payment Proof for Your Contribution:</h2>
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
        <input type="hidden" id="contribution_id" name="contribution_id" value="<?php echo $contribution_id; ?>">
      </div>
      <div class="form-group" id="paymentCodeGroup" style="display:none">
        <input type="text" id="paymentCode" name="paymentCode" placeholder="e.g. SEK7TJJD2Z">
      </div>
      <div class="form-group">
        <input type="hidden" id="purpose" name="purpose" value="contribution">
      </div>
      <button type="submit" id="submitButton" style="display:none">Submit</button>
    </form>
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
                <small class="text-muted">Member</small>
            </div>
            <div class="profile-photo">
                <img src="./images/profile-1.png" alt="">
            </div>
        </div>
    </div>
                    
<!--end of top-->

<div class="side-card">
<h2>Next Contributions</h2>
<div class="side-card-info">
    <div class="card-detail">
       <?php
       include 'contribution_schedule_db.php';
       ?>
        <ul>
            <p><b>Next Member:</b> <?php echo $nextMember; ?></p>
            <br>
            <p><b>Contribution Date:</b> <?php echo $contributionDate; ?> </p>
        </ul>
       
       
   
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

   <script src="js/index.js"></script>
   <script src="js/contribution.js"></script>
   <script src="js/repay.js"></script>
</body>
</html>