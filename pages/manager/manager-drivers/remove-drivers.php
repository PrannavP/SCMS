<?php

    require '../../../middlewares/connection.php';
    require_once '../../../middlewares/checkAuth.php';

    // Check if the user is authenticated
    if (!isManagerAuthenticated()) {
        // Redirect to the login page or display a message
        header("Location: ../../index.html");
        exit();
    }

    $id = $_GET['driver_id'];

    function removeDriver($driver_id, $conn){
        $delete_request_query = "DELETE FROM drivers WHERE driver_id = '$driver_id'";

        mysqli_query($conn, $delete_request_query);

        header("Location: manager-drivers.php");
    };

    removeDriver($id, $conn);

?>