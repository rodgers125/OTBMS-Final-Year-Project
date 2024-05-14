<?php
require_once 'connection.php';

// SQL query to retrieve data from the loan table
$query = "SELECT l.loanId, CONCAT(m.fName, ' ', m.lName) AS fullName, l.loanPurpose, l.loanAmount, l.repayment_period, l.loanStatus
          FROM loan l 
          JOIN members m ON l.member_id = m.memberId";

$result = mysqli_query($conn, $query);

// Check for errors
if (!$result) {
    echo "Error: " . mysqli_error($conn);
    exit;
}

// Check if there are any rows returned
if (mysqli_num_rows($result) > 0) {
    echo '<div class="table">';
    echo '<h2>Loan Details</h2>';
    echo '<table>';
    echo '<thead>';
    echo '<tr>';
    echo '<th>Loan ID</th>';
    echo '<th>Full Name</th>';                
    echo '<th>Loan Purpose</th>';
    echo '<th>Amount</th>';                
    echo '<th>Repayment Period</th>';
    echo '<th>Status</th>';
    echo '<th>Action</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';

    // Loop through the fetched data and output each row in the table
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr>';
        echo '<td>' . $row['loanId'] . '</td>';
        echo '<td>' . $row['fullName'] . '</td>';                
        echo '<td>' . $row['loanPurpose'] . '</td>';
        echo '<td>KSH ' . number_format($row['loanAmount'], 2) . '</td>';                
        echo '<td>' . $row['repayment_period'] . '</td>';
        echo '<td>' . $row['loanStatus'] . '</td>';
        echo '<td>';
        // Add button for action (e.g., mark as paid)
        echo '<button class="btn-paid" onclick="confirmMarkAsPaid(' . $row['loanId'] . ')">Mark Cleared</button>';
        echo '</td>';
        echo '</tr>';
    }

    echo '</tbody>';
    echo '</table>';
    echo '</div>';
} else {
    echo "No loans found.";
}

// Free result set
mysqli_free_result($result);




// Check if loanId is set and not empty
if (isset($_POST['loanId']) && !empty($_POST['loanId'])) {
    // Sanitize input (optional)
    $loanId = mysqli_real_escape_string($conn, $_POST['loanId']);

    // Get loan data from the loan table
    $query = "SELECT loanId, member_id, loanPurpose, loanAmount, repayment_period FROM loan WHERE loanId = $loanId";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // Prepare data for insertion into loan_history table
        $loanId = $row['loanId'];
        $memberId = $row['member_id'];
        $loanPurpose = $row['loanPurpose'];
        $loanAmount = $row['loanAmount'];
        $repaymentPeriod = $row['repayment_period'];
        $dateCleared = date('Y-m-d'); // Current date

        // Insert data into loan_history table
        $insertQuery = "INSERT INTO loan_history (member_id, loan_purpose, loan_amount, repayment_period, date_cleared, loanId) VALUES ('$memberId', '$loanPurpose', '$loanAmount', '$repaymentPeriod', '$dateCleared', '$loanId')";
        $insertResult = mysqli_query($conn, $insertQuery);

         // Delete record from loan table
         $deleteQuery = "DELETE FROM loan WHERE loanId = $loanId";
         $deleteResult = mysqli_query($conn, $deleteQuery);

      
         if ($insertResult && $deleteResult) {
            // Send success response to the client
            echo "<script>
            alert('Loan Marked as Paid successfully and now visible in Loan Loan History');
            // Redirect to loan_request.php
            window.location.href = 'loan_list.php';
            </script>";
        } else {
            // Error in insertion or deletion
            echo "error";
        }
    } else {
        echo "No loan found with the provided ID.";
    }
}  


// Close the database connection
mysqli_close($conn);
?>
