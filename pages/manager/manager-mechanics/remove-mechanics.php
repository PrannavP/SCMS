<?php

    require '../../../middlewares/connection.php';
    require_once '../../../middlewares/checkAuth.php';

    // Check if the user is authenticated
    if (!isManagerAuthenticated()) {
        // Redirect to the login page or display a message
        header("Location: ../../index.html");
        exit();
    }

    $id = $_GET['mechanic_id'];

    function removeMechanic($mechanic_id, $conn){
        $remove_mechanic = "DELETE FROM mechanic WHERE mechanic_id = '$mechanic_id'";

        mysqli_query($conn, $remove_mechanic);

        header("Location: manager-mechanics.php");
    };

    removeMechanic($id, $conn);

?>