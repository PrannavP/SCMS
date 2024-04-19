<?php 

    require '../../../middlewares/connection.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require '../../../phpmailer/src/Exception.php';
    require '../../../phpmailer/src/PHPMailer.php';
    require '../../../PHPMailer/src/SMTP.php';

    require './otp-gen.php';

    $reset_email = $_POST["reset_email"];
    $randomOtp = generateDigit();

    // function to store email in session
    function store_email_in_session($email){
        session_start();

        $_SESSION["reset_requested_email"] = $email;
    };

    store_email_in_session($reset_email);

    // function to store the otp in db
    function storeOTP($connection, $r_email, $otp){

        $sql_query_to_store_otp = "INSERT INTO `forgot_password`(`reset_requested_email`, `reset_token`) VALUES ('$r_email','$otp')";

        mysqli_query($connection, $sql_query_to_store_otp);
    };

    storeOTP($conn, $reset_email, $randomOtp);

    function sendEmailToCustomer($r_email, $otp){
        

        require '../../../../sendmail/credentials.php';

        $mail = new PHPMailer(true);

        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = $email;
        $mail->Password = $password;
        $mail->SMTPSecure = "ssl";
        $mail->Port = 465;

        $mail->setFrom($email);
        $mail->addAddress($r_email);
        $mail->isHTML(true);

        $mail->CharSet = 'UTF-8';

        $mail->Subject = "Password Reset Link";
        $mail->Body = '
            <p>Your OTP is ' . $otp . '</p>
        ';

        $mail->send();
    };

    sendEmailToCustomer($reset_email, $randomOtp);

    header('Location: ./otp-verification.php');

?>