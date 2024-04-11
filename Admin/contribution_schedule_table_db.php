<?php

require_once 'connection.php';


// get_contribution.php

// Function to get contribution data by ID
function getContributionData($conn, $contribution_id) {
    $query = "SELECT * FROM contribution_schedule WHERE contribution_id = $contribution_id";
    $result = mysqli_query($conn, $query);
    if ($result && mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result);
    } else {
        return null;
    }
}


// SQL query to retrieve data from the contribution_schedule table
$query = "SELECT cs.contribution_id, cs.member_id, CONCAT(m.fName, ' ', m.lName) AS fullName, cs.cont_amount, cs.cont_dateline
          FROM contribution_schedule cs
          JOIN members m ON cs.member_id = m.memberId
          ORDER BY  cs.cont_dateline ASC";
$result = mysqli_query($conn, $query);

// Check if there are any rows returned
if (mysqli_num_rows($result) > 0) {
    echo '<table>';
    echo '<thead>';
    echo '<tr>';
    echo '<th>Member ID</th>';
    echo '<th>Full Name</th>';
    echo '<th>Amount by Each Member</th>';
    echo '<th>Date to be Contributed</th>';
    echo '<th>Action</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';

    // Loop through each row in the result set
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr>';
        echo '<td>' . $row['member_id'] . '</td>';
        echo '<td>' . $row['fullName'] . '</td>';
        echo '<td>KSH ' . number_format($row['cont_amount'], 2) . '</td>';   //format numbers with thousands separators and decimal points. It takes two parameters: the number to format and the number of decimal places. 
        echo '<td>' . $row['cont_dateline'] . '</td>';
        echo '<td>';
        echo '<button class="btn-complete" onclick="markComplete(\'' . $row['contribution_id'] . '\')">Mark Complete</button>';
        echo '<button class="edit-btn" onclick="openEditModal(' . $row['contribution_id'] . ')">Edit</button>';
        echo '<button class="btn-delete" onclick="deleteContribution(' . $row['contribution_id'] . ')">Delete</button>';
        echo '</td>';
       
      
        echo '</tr>';
    }

    echo '</tbody>';
    echo '</table>';
} else {
    echo 'No data found.';
    
}

// Modal for Editing Contribution Schedule
echo '<div id="editModal" class="modal" style="display: none;">';
echo '<div class="modal-content">';
echo '<span class="close">&times;</span>';
echo '<div class="events">';
echo '<h3>Schedule Member Contribution</h3>';
echo '<div class="form-container">';
echo '<div class="events-form">';
echo '<form id="editForm" action="schedule_contribution_db.php" method="post">';
// form fields here
echo '<div class="form-group">';
echo '<label for="id">Members ID</label>';
echo '<input type="number" id="memberId" name="memberId" value="' . $member_id . '"  required>';                    
echo '</div>';

echo'<div class="form-group">';
echo '<label for="id">Contribution Amount From Each Member</label>';
echo '<input type="number" id="contributionAmount" name="contributionAmount" required>';                                        
echo '</div>';                
echo '<div class="form-group">';               
echo '<label for="payment_options">Payment Options:</label>';                
echo '<select id="payment_options" name="payment_options">';                
echo '<option value="">Select Payment Option</option>';                
echo '<option value="mpesa">M-Pesa</option>';                
echo '<option value="bank_deposit">Bank Deposit</option>';                
echo '</select>';               
echo '</div>';               

echo '<div class = "form-group" id="mpesa_options" style="display: none;">';            
echo '<label for="mpesa_sub_options">Select M-Pesa Options:</label>';                     
echo '<select id="mpesa_sub_options" name="mpesa_sub_options">';                     
echo '<option value="">Select M-Pesa Option</option>';                        
echo '<option value="till_number">Till Number</option>';                        
echo '<option value="send_money">Send Money</option>';                        
echo '</select>';                     
echo '<div id="mpesa_input" style="display: none;">';                     
echo '<label for="mpesa_input_field">Enter Number:</label>';                        
echo '<input type="text" id="mpesa_input_field" name = "mpesa_input_field" >';                   
echo '</div>';                 
echo '</div>';                

echo '<div  class = "form-group" id="bank_deposit_options" style="display: none;">';                    
echo '<label for="account_holder">Account Holder:</label>';               
echo '<input type="text" id="account_holder" name = "account_holder">';              
echo '<label for="bank">Bank:</label>';                 
echo '<input type="text" id="bank" name = "bank">';             
echo '<label for="account_number">Account Number:</label>';             
echo '<input type="text" id="account_number" name ="account_number">';             
echo '</div>';                
              
              
    
echo '<div class="form-group">';                
echo '<label for="date">Contribution Dateline</label>';                    
echo '<input type="date" id="contribution_date" name="contribution_date"/>';                                         
echo '</div>';                
             
               
echo '<div class="form-group">';                
echo '<button type="submit" name="submit">Save Changes</button>';                  
                 
echo '</div>';  

echo '</form>';
echo '</div>';
echo '</div>';
echo '</div>';
echo '</div>';
echo '</div>';


//delete contribution schedule record 
// Function to delete a contribution
// Function to delete a contribution
if(isset($_GET['delete_contribution_id'])) {
    $contribution_id = $_GET['delete_contribution_id'];

    // Attempt to delete the contribution
    $sql = "DELETE FROM contribution_schedule WHERE contribution_id = $contribution_id";
    if (mysqli_query($conn, $sql)) {
        echo "Contribution deleted successfully";
    } else {
        echo "Error deleting contribution: " . mysqli_error($conn);
    }
}
// Close the database connection
mysqli_close($conn);
?>
