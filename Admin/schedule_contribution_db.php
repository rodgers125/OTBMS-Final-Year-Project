<?php
require_once 'connection.php'; // Include your database connection file

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    // Get form data
    $cont_amount = $_POST['contributionAmount'];
    $cont_dateline = $_POST['contribution_date'];
    $payment_option = $_POST['payment_options'];
    $member_id = $_POST['memberId'];
    $acc_holder = $_POST['account_holder'];
    $bank_name = $_POST['bank'];
    $acc_number = $_POST['account_number'];
    $mpesa_number = $_POST['mpesa_input_field'];
    $mpesa_till = $_POST['mpesa_sub_options'];

    // Prepare and execute SQL statement to insert data into the table
    $stmt = $conn->prepare("INSERT INTO contribution_schedule (cont_amount, cont_dateline, payment_option, member_id, acc_holder, bank_name, acc_number, mpesa_number, mpesa_till) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    
    // Bind parameters
    $stmt->bind_param("dssisssss", $cont_amount, $cont_dateline, $payment_option, $member_id, $acc_holder, $bank_name, $acc_number, $mpesa_number, $mpesa_till);
    
    // Execute the statement
    if ($stmt->execute()) {
        echo "<script>alert('Contribution scheduled successfully');</script>";

        echo "<script>window.location.href = 'schedule_contribution.php';</script>";
            exit();
        // Redirect to a success page or display a success message
    } else {
        echo "<script>alert('Failed to schedule contribution');</script>";
        // Handle error
    }

    // Close statement
    $stmt->close();
    
    // Close connection
    $conn->close();
}
?>
