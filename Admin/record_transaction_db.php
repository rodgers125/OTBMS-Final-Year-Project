<?php
require 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input data
    $member_id = $_POST["member_id"];
    $date = $_POST["date"];
    $amount = $_POST["amount"];
    $purpose = $_POST["purpose"];
    $payment_method = $_POST["payment_method"];
    $member_id_for_contribution = $_POST["member_id_for_contribution"];

    // Prepare and execute the SQL statement to insert data into the transactions table
    $query = "INSERT INTO transactions (member_id, transaction_date, transaction_amount, transaction_purpose, transaction_method, member_id_for_contribution) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        // Bind parameters and execute the statement
        mysqli_stmt_bind_param($stmt, "isdsss", $member_id, $date, $amount, $purpose, $payment_method, $member_id_for_contribution);
        if (mysqli_stmt_execute($stmt)) {
            echo "<script>alert('Transaction recorded successfully');</script>";
            echo "<script>window.location.href = 'record_transaction.php';</script>";
        } else {
            echo "<script>alert('Failed to record transaction');</script>";
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        echo "<script>alert('Error in prepared statement');</script>";
    }


    
}


?>
