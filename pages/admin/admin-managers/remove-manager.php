<?php

    require '../../../middlewares/connection.php';
    require_once '../../../middlewares/checkAuth.php';

    // Check if the user is authenticated
    if (!isAdminAuthenticated()) {
        // Redirect to the login page or display a message
        header("Location: ../../index.html");
        exit();
    }

    $id = $_GET['manager_id'];

    function removeManager($manager_id, $conn){
        $remove_manager = "DELETE FROM manager WHERE id = '$manager_id'";

        mysqli_query($conn, $remove_manager);

        header("Location: admin-managers.php");
    };

    removeManager($id, $conn);

?>