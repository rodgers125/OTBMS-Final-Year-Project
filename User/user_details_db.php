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
    echo '<button class="btn-edit" onclick="openEditModal()">Edit Personal Details</button>';
    echo '</ul>';
    echo '</div>';
    echo '</div>';


    // User profile edit modal 
// Modal
echo '<div id="editModal" class="modal">';
echo '  <div class="modal-content">';
echo '    <span class="close" onclick="closeEditModal()">&times;</span>';
echo '    <form id="editForm" action="update_profile_db.php" method="POST">';
echo '      <h2>Edit Your Personal Information</h2>';
echo '      <div class="form-group">';
echo '        <label for="memberId"><b>Member ID:</b></label>';
echo '        <p>' . $row['memberId'] . '</p>';
echo '      </div>';
echo '      <div class="form-group">';
echo '        <label for="fName"><b>First Name:</b></label>';
echo '        <input type="text" id="fName" name="fName" value="' . $row['fName'] . '" required>';
echo '      </div>';
echo '      <div class="form-group">';
echo '        <label for="lName"><b>Last Name:</b></label>';
echo '        <input type="text" id="lName" name="lName" value="' . $row['lName'] . '" required>';
echo '      </div>';
echo '      <div class="form-group">';
echo '        <label for="dateJoined"><b>Date Joined:</b></label>';
echo '        <p>' . $row['registration_date'] . '</p>';
echo '      </div>';
echo '      <div class="form-group">';
echo '        <label for="email"><b>Email:</b></label>';
echo '        <p>' . $row['email'] . '</p>';
echo '      </div>';
echo '      <div class="form-group">';
echo '        <label for="phone_number"><b>Phone Number:</b></label>';
echo '        <input type="tel" id="phone_number" name="phone_number" value="' . $row['phone'] . '" required>';
echo '      </div>';
echo '      <div class="form-group">';
echo '        <label for="gender"><b>Gender:</b></label>';
echo '        <input type="text" id="gender" name="gender" value="' . $row['gender'] . '" required>';
echo '      </div>';
echo '      <small>Note: You can only edit your Name, Phone Number, and Gender</small>';
echo '      <button type="submit" class="btn-edit" id="updateBtn">Update Personal Details</button>';
echo '    </form>';
echo '  </div>';
echo '</div>';

} else {
    // Handle case when no user found or query fails
    echo 'Error: Unable to fetch user details.';
}


//receiving from data and updating the database






?>