<?php 

    require '../../../middlewares/connection.php';

    session_start();

    $entered_otp = $_POST["otp"];
    $email = $_SESSION["reset_requested_email"];

    // sql query to check if otp exists or not
    $sql_query_to_check_otp = "SELECT * FROM `forgot_password` WHERE `reset_requested_email` = '$email' AND `reset_token` = '$entered_otp'";

    $result = mysqli_query($conn, $sql_query_to_check_otp);

    // echo $entered_otp;
    // echo $email;

    if(mysqli_num_rows($result) > 0){
        // the otp exists
        $_SESSION["otp_verify"] = true;
        header('Location: ./reset-password.html');
    }else{
        // otp does not exist
        echo "OTP didn't match";
        $_SESSION["otp_verify"] = false;
    }
    
?>