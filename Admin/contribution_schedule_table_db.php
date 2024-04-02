<?php

require_once 'connection.php';



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
        
        echo  '<td><button type="button" class="edit-btn" id='.$row["contribution_id"].' data-toggle
        ="modal" data-target="#editModal">Edit</button></td>';

        echo '<td> <button class="btn-delete" onclick="deleteContribution(' . $row['contribution_id'] . ')">Delete</button></td>';
        
        echo '</tr>';
    }

    echo '</tbody>';
    echo '</table>';
} else {
    echo 'No data found.';
    
}



// Close the database connection
mysqli_close($conn);
?>
