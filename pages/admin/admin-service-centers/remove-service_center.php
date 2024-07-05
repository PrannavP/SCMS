<?php

    require '../../../middlewares/connection.php';
    require_once '../../../middlewares/checkAuth.php';

    // Check if the user is authenticated
    if (!isAdminAuthenticated()) {
        // Redirect to the login page or display a message
        header("Location: ../../index.html");
        exit();
    }

    $id = $_GET['service_center_id'];

    function removeServiceCenter($service_center_id, $conn){
        $remove_service_center = "DELETE FROM servicecenter WHERE id = '$service_center_id'";

        mysqli_query($conn, $remove_service_center);

        header("Location: admin-service-centers.php");

    };

    removeServiceCenter($id, $conn);

?>