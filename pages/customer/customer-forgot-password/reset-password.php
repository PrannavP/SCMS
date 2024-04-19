<?php

    require '../../../middlewares/connection.php';

    // starting session
    session_start();

    $email = $_SESSION["reset_requested_email"];
    $new_password = $_POST["password"];

    function changeCustomerPassword($connection, $email, $password){
        // update the password
        $sql_query_to_update_password = "UPDATE `customer` SET `password`='$password' WHERE `email` = '$email'";

        $result = mysqli_query($connection, $sql_query_to_update_password);

        header("Location: ../customer-login.php" );

        // echo $result;

        unset($_SESSION['reset_requested_email']);
    };

    changeCustomerPassword($conn, $email, $new_password);

?>