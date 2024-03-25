<?php
require 'connection.php';


//total members
// Query to get the total number of members
$query = "SELECT COUNT(*) AS total_members FROM members";
$result = mysqli_query($conn, $query);

if ($result) {
    // Fetch the result as an associative array
    $row = mysqli_fetch_assoc($result);
    
    // Extract the total number of members
    $total_members = $row['total_members'];
    
    // Output the total number of members
    echo $total_members;
} 

else {
    // Display an error message if the query fails
    echo "Error executing query: " . mysqli_error($conn);
}


// Close the database connection
mysqli_close($conn);
?>