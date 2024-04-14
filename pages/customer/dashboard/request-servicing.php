<?php

    require '../../../middlewares/connection.php';
    require_once '../../../middlewares/checkAuth.php';

    // Check if the user is authenticated
    if(!isCustomerAuthenticated()) {
        // Redirect to the login page or display a message
        header("Location: ../customer-login.php");
        exit();
    }

    function requestServicing($connection){
        $customer_email = $_SESSION["customer"]["email"];
        $customer_name = $_SESSION["customer"]["name"];

        $service_center = $_POST["service_center"];
        $request_date = $_POST["date"];
        $request_time = $_POST["time"];
        $request_model = $_POST["model"];
        $request_contact_number = $_POST["contact-number"];
        $request_details = $_POST["detail"];

        $sql_query_to_request_servicing = "INSERT INTO `service_request`(`requested_by`, `email`, `service_center`, `model`, `details`, `contact_number`, `requested_date`, `requested_time`) VALUES ('$customer_name','$customer_email','$service_center','$request_model','$request_details','$request_contact_number','$request_date','$request_time')";

        echo $sql_query_to_request_servicing;
        
        mysqli_query($connection, $sql_query_to_request_servicing);

        header("Location: ./customer.php");
    };

    requestServicing($conn);
?>