<?php

    require '../../../middlewares/connection.php';
    require_once '../../../middlewares/checkAuth.php';

    // Check if the user is authenticated
    if (!isManagerAuthenticated()) {
        // Redirect to the login page or display a message
        header("Location: ../../index.html");
        exit();
    }

    echo "Edit Drivers Page";

    function editDriver($conn){
        $id = $_POST['driverid'];
        $fullname = $_POST['fullname'];
        $contact = $_POST['contactnumber'];
        $licenseNumber = $_POST['licensenumber'];

        $sql_query_to_edit_driver = "UPDATE `drivers` SET `full_name`='$fullname',`contact_number`='$contact',`license_number`='$licenseNumber' WHERE `driver_id` = '$id'";

        mysqli_query($conn, $sql_query_to_edit_driver);
        
        // Redirect to mechanics page
        header("Location: manager-drivers.php");
    };

    editDriver($conn);

?>