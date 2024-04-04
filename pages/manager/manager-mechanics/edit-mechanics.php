<?php

    require '../../../middlewares/connection.php';
    require_once '../../../middlewares/checkAuth.php';

    // Check if the user is authenticated
    if (!isManagerAuthenticated()) {
        // Redirect to the login page or display a message
        header("Location: ../../index.html");
        exit();
    }

    echo "Edit Page";

    function editMechanic($conn){
        $id = $_POST['mechanicid'];
        $fullname = $_POST['fullname'];
        $contact = $_POST['contactnumber'];
        $address = $_POST['address'];

        $sql_query_to_edit_mechanic = "UPDATE `mechanic` SET `fullname`='$fullname',`contactnumber`='$contact',`address`='$address' WHERE `mechanic_id` = '$id'";

        mysqli_query($conn, $sql_query_to_edit_mechanic);

        header("Location: manager-mechanics.php");
    };

    editMechanic($conn);

?>