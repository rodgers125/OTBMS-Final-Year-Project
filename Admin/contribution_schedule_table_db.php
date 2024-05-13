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
          WHERE cs.status = 'pending'
          ORDER BY cs.cont_dateline DESC";
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
        $member_id = $row['member_id'];

        echo '<tr>';
        echo '<td>' . $row['member_id'] . '</td>';
        echo '<td>' . $row['fullName'] . '</td>';
        echo '<td>KSH ' . number_format($row['cont_amount'], 2) . '</td>';   //format numbers with thousands separators and decimal points. It takes two parameters: the number to format and the number of decimal places. 
        echo '<td>' . $row['cont_dateline'] . '</td>';
        echo '<td>';
        echo '<button class="btn-complete" onclick="markComplete(' . $row['contribution_id'] . ')">Mark Complete</button>';
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
