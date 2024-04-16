<?php

    require '../../../middlewares/connection.php';
    require_once '../../../middlewares/checkAuth.php';

    // Check if the user is authenticated
    if(!isCustomerAuthenticated()) {
        // Redirect to the login page or display a message
        header("Location: ../customer-login.php");
        exit();
    }

    function sendMessage($connection){
        $full_name = $_POST["full_name"];
        $email_phone = $_POST["email_phone"];
        $service_center = $_POST["service_center"];
        $message = $_POST["message"];

        $sql_query_to_send_message = "INSERT INTO `message`(`full_name`, `email_phone`, `service_center`, `message`) VALUES ('$full_name','$email_phone','$service_center','$message')";

        echo $sql_query_to_send_message;

        mysqli_query($connection, $sql_query_to_send_message);
    };

    sendMessage($conn);

    header("Location: ./customer-suggestion-issue.php");

?>