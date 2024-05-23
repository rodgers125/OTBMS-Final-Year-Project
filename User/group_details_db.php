<?php
require 'connection.php';

function fetchSingleValue($conn, $query, $paramType, $param) {
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, $paramType, $param);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
    return $row ? array_values($row)[0] : null;
}

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    // Fetch group name
    $group_name_query = "SELECT g.groupname 
                         FROM `group` AS g
                         INNER JOIN members AS m ON g.groupid = m.group_id
                         WHERE m.memberId = ?";
    $group_name = fetchSingleValue($conn, $group_name_query, "i", $user_id) ?? "N/A";

    // Fetch date joined
    $date_joined_query = "SELECT registration_date 
                          FROM members 
                          WHERE memberId = ?";
    $date_joined = fetchSingleValue($conn, $date_joined_query, "i", $user_id) ?? "N/A";

    // Calculate total members in the group
    $total_members_query = "SELECT COUNT(*) AS total_members 
                            FROM members 
                            WHERE group_id = (
                                SELECT group_id 
                                FROM members 
                                WHERE memberId = ?
                            )";
    $total_members = fetchSingleValue($conn, $total_members_query, "i", $user_id) ?? 0;

    // Calculate total group contributions
    $total_contributions_query = "SELECT SUM(ch.contribution_amount) AS total_contributions
                                  FROM contribution_history AS ch
                                  JOIN members AS m ON ch.member_id = m.memberId
                                  WHERE m.group_id = (
                                      SELECT group_id 
                                      FROM members 
                                      WHERE memberId = ?
                                  )";
    $total_contributions = fetchSingleValue($conn, $total_contributions_query, "i", $user_id) ?? 0;
//This query joins the contribution_history table with the members table to 
//sum the contribution_amount for all members in the same group as the user.

} else {
    // Handle the case when the user is not logged in
    $group_name = "N/A";
    $date_joined = "N/A";
    $total_members = 0;
    $total_contributions = 0;
}
?>

