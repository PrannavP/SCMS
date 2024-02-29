<?php

    require '../../../middlewares/connection.php';
    require_once '../../../middlewares/checkAuth.php';

    // Check if the user is authenticated
    if (!isManagerAuthenticated()) {
        // Redirect to the login page or display a message
        header("Location: ../../index.html");
        exit();
    }

    $id = $_GET['request_id'];

    function deleteCustomerRequest($req_id, $conn){
        $delete_request_query = "DELETE FROM service_request WHERE request_id = '$req_id'";

        mysqli_query($conn, $delete_request_query);

        header("Location: manager-service-requests.php");

        // Send Email
    };

    deleteCustomerRequest($id, $conn);

?>