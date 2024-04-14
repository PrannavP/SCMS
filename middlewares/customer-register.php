<?php

    require './connection.php';

    if(isset($_POST["customer-register"])){
        $fullname = $_POST["fullname"];
        $phone_number = $_POST["pnumber"];
        $email = $_POST["email"];
        $model = $_POST["model"];
        $password = $_POST["psw"];
        
        // hash the password
        $hashed_password = password_hash($password, PASSWORD_BCRYPT, );

        $query = "INSERT INTO `customer`(`full_name`, `email`, `password`, `phone_number`, `model`) VALUES ('$fullname', '$email', '$hashed_password', '$phone_number', '$model')";

        $query_run = mysqli_query($conn, $query);

        header("Location: ../pages/customer/customer-login.php");
    }

?>