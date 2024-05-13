<?php
require 'connection.php'; // Including the connection file to establish database connection

if (isset($_POST["submit"])) { // Checking if the form is submitted

    // Retrieving form data
    $fName = $_POST["fName"];
    $lName = $_POST["lName"];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    if ($password !== $confirmPassword) { // Checking if passwords match
        echo "<script>alert('Passwords do not match');</script>"; // Alerting the user if passwords don't match
    } else {

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // Hashing the password for security

        // Using prepared statements to prevent SQL injection
        $query = "INSERT INTO members (fName, lName, email, phone, gender, password, registration_date) VALUES (?, ?, ?, ?,?, ?, NOW())";

        $preparedSql = mysqli_prepare($conn, $query); // Preparing the SQL statement

        if ($preparedSql) { // Checking if the SQL statement is prepared successfully
            // Binding parameters and executing the prepared statement
            mysqli_stmt_bind_param($preparedSql, 'ssssss', $fName, $lName, $email, $phone, $gender, $hashedPassword);
            mysqli_stmt_execute($preparedSql);

            // Notifying of successful member addition
            echo "<script>alert(' Member has been Added Successfully');</script>";
            echo "<script>window.location.href = 'add_members.php';</script>"; // Redirecting  to a new page
            exit(); // Exiting the script
        } else {
            echo "<script>alert('Error in prepared statement');</script>"; // Alerting  of error in prepared statement
        }

        mysqli_stmt_close($preparedSql); // Closing the prepared statement
    }
}

?>