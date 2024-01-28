<?php

    require './connection.php';

    if(isset($_POST["customer-register"])){
        $fullname = $_POST["fullname"];
        $phone_number = $_POST["phonenumber"];
        $email = $_POST["email"];
        $model = $_POST["model"];
        $password = $_POST["psw"];

        $query = "INSERT INTO `customer`(`full_name`, `email`, `password`, `phone_number`, `model`) VALUES ('$fullname', '$email', '$password', '$phone_number', '$model')";

        $query_run = mysqli_query($conn, $query);

        header("Location: ../pages/customer/customer-login.php");
    }

?>