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
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="loan.css">
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
                <h2>ONLINE<span class="success">CHAMA</span></h2>
            </div>
            <div class="close" id="close-btn">
                <span class="material-icons-sharp">close</span>
            </div>
        </div>

        <div class="sidebar">
            <a href="index.php">
                <span class="material-icons-sharp">grid_view</span>
                <h3>Account Overview</h3>
            </a>
            <a href="profile.php">
                <span class="material-icons-sharp">insights</span>
                <h3>Profile</h3>
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
                <span class="material-icons-sharp">report_gmailerrorred</span>
                <h3>Transactions</h3>
            </a>
            <a href="notifications.php">
                <span class="material-icons-sharp">inventory</span>
                <h3>Notifications</h3>
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
        <h2>Loan Balance</h2> 
        <br>
                        <p>KSH 20,600.50</p>  
                        <br>
                        <h3>To Be Paid Before 12/4/2015</h3>
        </div>

        <!-- Loan Limit Card -->
        <div class="loan-card">
        <h2>Loan Limit</h2> 
        <br>
                        <p>KSH 30,500.00</p>
                        <button class="btn-apply">Apply for a loan</button>
        </div>
        
    </div>
<br>

    <!--Applied  Loans Table-->
    <div class="table">
    <h2>Loan History</h2>
   <table>
    <thead>
        <tr>
          <th>Loan Id</th>
          <th>Date Applied</th>
          <th>Amount</th>
          <th>Purpose</th>
          <th>Status</th>          
        </tr>
    </thead>

    <tbody>
        <tr>
            <td>1234</td>
            <td>1/2/2023</td>
            <td>20000</td>
            <td>Business</td>
            <td>Pending Approval</td>
        </tr>
        <tr>
            <td>1234</td>
            <td>1/2/2023</td>
            <td>20000</td>
            <td>Personal</td>
            <td>Active</td>
        </tr>
        <tr>
            <td>1234</td>
            <td>1/2/2023</td>
            <td>20000</td>
            <td>Business</td>
            <td>Paid</td>
        </tr>
    </tbody>
   </table>
            </div>

    <!-- Loan Application Modal -->
<div id="loanApplicationModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <h2>Loan Application</h2>
    <form id="loanApplicationForm">
      <div class="form-group">
        <label for="loanType">Loan Type:</label>
        <select id="loanType" name="loanType">
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
        <label for="loanAmount">Enter The Amount</label>
        <input type="number"></input>
      
      </div>
      <button type="submit">Apply</button>
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

   <script src="index.js"></script>
   <script src="loan.js"></script>
</body>
</html>