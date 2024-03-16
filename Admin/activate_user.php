<?php

require 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['memberId']) && isset($_POST['action'])) {
    $memberId = $_POST['memberId'];
    $action = $_POST['action'];

    // Update the status based on the action
    $newStatus = ($action === 'deactivate') ? 'inactive' : 'active';
    $query = "UPDATE members SET status = '$newStatus' WHERE memberId = $memberId";
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo "Account " . ucfirst($action) . "d successfully!";
    } else {
        echo "Error " . $action . "ing account: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request.";
}
?>