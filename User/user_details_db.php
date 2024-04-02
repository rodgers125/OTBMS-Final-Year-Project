<?php
$userID = $_SESSION['user_id'];

// SQL query to retrieve user details from the members table
$query = "SELECT * FROM members WHERE memberId = $userID";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    // Fetch user details
    $row = mysqli_fetch_assoc($result);

    // Display user details
    echo '<div class="user-details">';
    echo '<div class="details-card">';
    echo '<h3><b>Personal Details:</b></h3>';
    echo '<ul>';
    echo '<li><b>Member ID:</b> ' . $row['memberId'] . '</li>';
    echo '<li><b>Full Name:</b> ' . $row['fName'] . ' ' . $row['lName'] . '</li>';
    echo '<li><b>Date Joined:</b> ' . $row['registration_date'] . '</li>';
    echo '<li><b>Email:</b> ' . $row['email'] . '</li>';
    echo '<li><b>Phone Number:</b> ' . $row['phone'] . '</li>';
    echo '<li><b>Gender:</b> ' . $row['gender'] . '</li>';
    echo '<button class="btn-edit"><a href="profile.php">Update Personal Details</a></button>';
    echo '</ul>';
    echo '</div>';
    echo '</div>';
} else {
    // Handle case when no user found or query fails
    echo 'Error: Unable to fetch user details.';
}

// Close the database connection
mysqli_close($conn);
?>