<?php
require 'connection.php'; 

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    // Query to fetch group name based on user's group_id
    $query_group_name = "SELECT g.groupname 
                         FROM `group` AS g
                         INNER JOIN members AS m ON g.groupid = m.group_id
                         WHERE m.memberId = ?";
    $stmt_group_name = mysqli_prepare($conn, $query_group_name);
    mysqli_stmt_bind_param($stmt_group_name, "i", $user_id);
    mysqli_stmt_execute($stmt_group_name);
    $result_group_name = mysqli_stmt_get_result($stmt_group_name);
    $group_name_row = mysqli_fetch_assoc($result_group_name);
    $group_name = ($group_name_row !== null) ? $group_name_row['groupname'] : "N/A";

    // Query to fetch date joined based on user's member_id
    $query_date_joined = "SELECT registration_date 
                          FROM members 
                          WHERE memberId = ?";
    $stmt_date_joined = mysqli_prepare($conn, $query_date_joined);
    mysqli_stmt_bind_param($stmt_date_joined, "i", $user_id);
    mysqli_stmt_execute($stmt_date_joined);
    $result_date_joined = mysqli_stmt_get_result($stmt_date_joined);
    $date_joined_row = mysqli_fetch_assoc($result_date_joined);
    $date_joined = ($date_joined_row !== null) ? $date_joined_row['registration_date'] : "N/A";

    // Query to calculate total members in the group
    $query_total_members = "SELECT COUNT(*) AS total_members 
                            FROM members 
                            WHERE group_id = (
                                SELECT group_id 
                                FROM members 
                                WHERE memberId = ?
                            )";
    $stmt_total_members = mysqli_prepare($conn, $query_total_members);
    mysqli_stmt_bind_param($stmt_total_members, "i", $user_id);
    mysqli_stmt_execute($stmt_total_members);
    $result_total_members = mysqli_stmt_get_result($stmt_total_members);
    $total_members_row = mysqli_fetch_assoc($result_total_members);
    $total_members = ($total_members_row !== null) ? $total_members_row['total_members'] : 0;
} else {
    // Handle the case when the user is not logged in
    $group_name = "N/A";
    $date_joined = "N/A";
    $total_members = 0;
}
?>
