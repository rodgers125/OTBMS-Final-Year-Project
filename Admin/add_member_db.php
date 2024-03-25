<?php
require 'connection.php';


if (isset($_POST["submit"])) {    
    $fName = $_POST["fName"];
    $lName = $_POST["lName"];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    
    if ($password !== $confirmPassword) {               //checking if passwords really march
        echo "<script>alert('Passwords do not match');</script>";
    } else {
        
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT); //hashing the password

        // Use prepared statements to prevent SQL injection
        $query = "INSERT INTO members (fName, lName, email, phone, gender, password, registration_date) VALUES (?, ?, ?, ?,?, ?, NOW())";

        $preparedSql = mysqli_prepare($conn, $query);

        if ($preparedSql) {
            mysqli_stmt_bind_param($preparedSql, 'ssssss', $fName, $lName, $email, $phone, $gender, $hashedPassword);
            mysqli_stmt_execute($preparedSql);

            echo "<script>alert(' Member has been Added Successfully');</script>";
            echo "<script>window.location.href = 'add_members.php';</script>";
            exit();
           
           
        } else {
            echo "<script>alert('Error in prepared statement');</script>";
        }

        mysqli_stmt_close($preparedSql);
    }
}
?>