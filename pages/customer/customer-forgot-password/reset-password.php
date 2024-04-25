<?php

    require '../../../middlewares/connection.php';

    // starting session
    session_start();

    $email = $_SESSION["reset_requested_email"];
    $new_password = $_POST["password"];

    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

    function changeCustomerPassword($connection, $email, $password){
        // update the password
        $sql_query_to_update_password = "UPDATE `customer` SET `password`='$password' WHERE `email` = '$email'";

        mysqli_query($connection, $sql_query_to_update_password);

        // echo $result;

        unset($_SESSION['reset_requested_email']);
    };

    function changeStatus($connection){
        // update the status
        $sql_query_to_update_otp_status = "UPDATE `forgot_password` SET `status` = 'USED'";

        mysqli_query($connection, $sql_query_to_update_otp_status);

    };

    changeStatus($conn);

    function deleteResetToken($connection, $email){
        // delete the specific row
        $sql_query_to_delete_token = "DELETE FROM `forgot_password` WHERE `reset_requested_email` = '$email'";

        mysqli_query($connection, $sql_query_to_delete_token);
    };

    // deleteResetToken($conn, $email);

    changeCustomerPassword($conn, $email, $hashed_password);

    header("Location: ../customer-login.php" );

?>