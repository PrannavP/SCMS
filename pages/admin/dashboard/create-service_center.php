<?php

    require '../../../middlewares/connection.php';
    require_once '../../../middlewares/checkAuth.php';

    // Check if the user is authenticated
    if (!isAdminAuthenticated()) {
        // Redirect to the login page or display a message
        header("Location: ../../../index.html");
        exit();
    }

    function create_new_service_center($connection){
        $service_center_name = $_POST["service_center-name"];
        $service_center_location = $_POST["service_center-location"];
        $service_center_contactnumber = $_POST["service_center-contactnumber"];
        $service_center_contactperson = $_POST["service_center-contactperson"];
        $service_center_slots = $_POST["service_center-slots"];

        $sql_query_to_create_new_service_center = "INSERT INTO `servicecenter`(`name`, `location`, `contact_number`, `contact_person`, `slots`, `available_slots`) VALUES ('$service_center_name','$service_center_location','$service_center_contactnumber','$service_center_contactperson','$service_center_slots', '$service_center_slots')";

        mysqli_query($connection, $sql_query_to_create_new_service_center);
    };

    create_new_service_center($conn);

    header("Location: ./admin-dashboard.php");

?>