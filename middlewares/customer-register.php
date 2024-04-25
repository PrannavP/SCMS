<?php

    // Validating form 

    $fullname = $_POST["fullname"];
    $phone_number = $_POST["pnumber"];
    $email = $_POST["email"];
    $model = $_POST["model"];
    $password = $_POST["psw"];
    $c_password = $_POST["cpsw"];

    function formValidation($name, $pnumber, $email, $model, $psw){
        // importing connection.php
        require './connection.php';

        if(empty($name) && empty($pnumber) && empty($email) && empty($model) && empty($psw)){
            echo "Please enter all the fields";
        }else{
            // echo "Forms are field";
            registerCustomer($conn, $name, $pnumber, $email, $model, $psw);
        };
        
    };

    formValidation($fullname, $phone_number, $email, $model, $password);

    // function to register new customer
    function registerCustomer($conn, $name, $pnumber, $email, $model, $psw){
        // hash the password
        $hashed_password = password_hash($psw, PASSWORD_DEFAULT);

        $query = "INSERT INTO `customer`(`full_name`, `email`, `password`, `phone_number`, `model`) VALUES ('$name', '$email', '$hashed_password', '$pnumber', '$model')";

        mysqli_query($conn, $query);

        echo $query;

        header("Location: ../pages/customer/customer-login.php");
    };

    function loggingFormInputs($name, $pnumber, $email, $model, $password, $c_psw){
        echo $name . "<br>";
        echo $pnumber . "<br>";
        echo $email . "<br>";
        echo $model . "<br>";
        echo $password . "<br>";
        echo $c_psw . "<br>";

        // hashed passwords
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        $hashed_confirm_password = password_hash($c_psw, PASSWORD_BCRYPT, );

        echo $hashed_password . "<br>";
        echo $hashed_confirm_password . "<br>";

    };

    // loggingFormInputs($fullname, $phone_number, $email, $model, $password, $c_password);

?>