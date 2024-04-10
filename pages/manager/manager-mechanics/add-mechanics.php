<?php

    require '../../../middlewares/connection.php';
    require_once '../../../middlewares/checkAuth.php';

    // Check if the user is authenticated
    if (!isManagerAuthenticated()) {
        // Redirect to the login page or display a message
        header("Location: ../../index.html");
        exit();
    }

    function addMechanic($conn){
        $serviceCenter = $_SESSION['manager']['service-center'];
        $mechanic_name = $_POST["mechanicname"];
        $mechanic_number = $_POST["mechanic-contactnumber"];
        $mechanic_address = $_POST["mechanic-address"];

        $query_to_add_mechanic = "INSERT INTO `mechanic`(`fullname`, `contactnumber`, `address`, `service_center`) VALUES ('$mechanic_name','$mechanic_number','$mechanic_address','$serviceCenter')";

        mysqli_query($conn, $query_to_add_mechanic);

        header("Location: manager-mechanics.php");
    };

    addMechanic($conn);

?>