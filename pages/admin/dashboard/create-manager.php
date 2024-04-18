<?php

    require '../../../middlewares/connection.php';
    require_once '../../../middlewares/checkAuth.php';

    // Check if the user is authenticated
    if (!isAdminAuthenticated()) {
        // Redirect to the login page or display a message
        header("Location: ../../../index.html");
        exit();
    }

    function create_new_manager_account($connection){
        $manager_full_name = $_POST["manager-fullname"];
        $manager_contactnumber = $_POST["manager-contactnumber"];
        $manager_email = $_POST["manager-email"];
        $manager_password = $_POST["manager-password"];
        $manager_servicecenter = $_POST["service_center"];

        $sql_query_to_create_new_manager = "INSERT INTO `manager`(`fullname`, `contact_number`, `email`, `password`, `service_center`) VALUES ('$manager_full_name','$manager_contactnumber','$manager_email','$manager_password','$manager_servicecenter')";

        // mysqli_query($connection, $sql_query_to_create_new_manager);

        echo $manager_full_name;
        echo $manager_contactnumber;
    };

    create_new_manager_account($conn);

    // header("Location: ./admin-dashboard.php");

?>