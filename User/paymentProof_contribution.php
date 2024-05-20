<?php
 require_once "connection.php";
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") { 

    
    $payment_method = $_POST["payment_method"];
    $user_id = $_POST["memberId"];
    $contribution_id = $_POST["contribution_id"];   
    $paymentCode = $_POST["paymentCode"];
    $purpose = $_POST["purpose"];

    // Prepare and execute the SQL statement to insert data into the payments_proof table
    $query = "INSERT INTO payments_proof (member_id, payment_method, payment_proof_code, purpose, contribution_id) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        // Bind parameters and execute the statement
        mysqli_stmt_bind_param($stmt, "sssss", $user_id, $payment_method, $paymentCode, $purpose, $contribution_id);
        mysqli_stmt_execute($stmt);

        // Check if the query was successful
        if (mysqli_stmt_affected_rows($stmt) > 0) {
            echo "<script>
            alert('Code Submitted Successfully. Thank you for your Contribution.');";
            echo "window.location.href = 'contribution.php';</script>";
            exit();
        } else {
            echo "<script>alert('Failed to submit Code. Try again.');</script>";
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        echo "<script>alert('Error in prepared statement');</script>";
    }
   
   
}
?>
