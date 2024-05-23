<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../phpmailer/src/Exception.php';
require '../phpmailer/src/PHPMailer.php';
require '../phpmailer/src/SMTP.php';
require "../User/connection.php";

// Approving of loan
if (isset($_POST['requestId']) && !empty($_POST['requestId'])) {
    // Sanitize the input
    $requestId = $_POST['requestId'];

    // Fetch loan request details from loan_requests table using prepared statement
    $query = "SELECT lr.*, m.email, CONCAT(m.fName, ' ', m.lName) AS fullName
              FROM loan_requests lr
              JOIN members m ON lr.memberId = m.memberId
              WHERE lr.requestId = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $requestId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $email = $row['email'];        

        // Insert data into the loan table using prepared statement
        $insertQuery = "INSERT INTO loan (loanAmount, loanPurpose, member_id, loanStatus, repayment_period) VALUES (?, ?, ?, ?, ?)";
        $loanStatus = 'active'; // Default value for loanStatus
        $stmt = mysqli_prepare($conn, $insertQuery);
        mysqli_stmt_bind_param($stmt, "dssss", $row['loanAmount'], $row['loanType'], $row['memberId'], $loanStatus, $row['loanPeriod']);
        $insertResult = mysqli_stmt_execute($stmt);

        // Delete record from loan_requests table
        $deleteQuery = "DELETE FROM loan_requests WHERE requestId = ?";
        $stmt = mysqli_prepare($conn, $deleteQuery);
        mysqli_stmt_bind_param($stmt, "i", $requestId);
        $deleteResult = mysqli_stmt_execute($stmt);

        if ($insertResult && $deleteResult) {
            // Generate notification message with dynamic values
            $notificationMessage = "Hello " . $row['fullName'] . ",\n\n" . 
                       "Your loan request of KSH " . $row['loanAmount'] . 
                       " for " . $row['loanType'] . " use has been approved. " . 
                       "The loan is to be repaid in " . $row['loanPeriod'] . ".";

            // Insert notification into the notification table
            $notificationQuery = "INSERT INTO notification (member_id, notification_date_time, title, message) VALUES (?, NOW(), 'Loan Request Approved', ?)";
            $stmt = mysqli_prepare($conn, $notificationQuery);
            mysqli_stmt_bind_param($stmt, "is", $row['memberId'], $notificationMessage);
            mysqli_stmt_execute($stmt);

            // Prepare the email content
            $subject = "Loan Approval";
            $message  = $notificationMessage;
            $message .= "\n\nRegards,\nROYWEA";

            $mail = new PHPMailer(true);

            try {
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'kipkuruikorir968@gmail.com';
                $mail->Password = 'strlujcjgyzvkvnf';
                $mail->SMTPSecure = 'ssl';
                $mail->Port = 465;

                $mail->setFrom('kipkuruikorir968@gmail.com');
                $mail->addAddress($email);
                $mail->isHTML(false); // set to false for plain text email

                $mail->Subject = $subject;
                $mail->Body = $message;

                $mail->send();
                
                echo "<script>
                alert('Loan request approved successfully and notification email sent.');
                window.location.href = 'loan_request.php';
                </script>";
            } catch (Exception $e) {
                echo "<script>
                alert('Loan request approved successfully but email could not be sent. Mailer Error: {$mail->ErrorInfo}');
                window.location.href = 'loan_request.php';
                </script>";
            }

        } else {
            echo "<script>alert('Failed to approve the loan.'); window.location.href = 'loan_request.php';</script>";
        }
    } else {
        echo "<script>alert('Loan request not found.'); window.location.href = 'loan_request.php';</script>";
    }
} else {
    echo "<script>alert('Request ID is missing.'); window.location.href = 'loan_request.php';</script>";
}

// Close the database connection
mysqli_close($conn);
?>

