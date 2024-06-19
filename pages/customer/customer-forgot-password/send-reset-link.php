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

    $mail->Subject = "Password Reset OTP";
    $mail->Body = '
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>OTP Email</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f4f4f4;
                margin: 0;
                padding: 0;
            }
            .container {
                max-width: 600px;
                margin: 0 auto;
                background-color: #ffffff;
                padding: 20px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }
            .header {
                background-color: #2C3E50;
                color: #ffffff;
                padding: 10px 0;
                text-align: center;
            }
            .content {
                padding: 20px;
            }
            .otp {
                font-size: 24px;
                font-weight: bold;
                background-color: #f8f9fa;
                padding: 10px;
                text-align: center;
                border: 1px dashed #5183A5;
                margin: 20px 0;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="header">
                <h1>OTP Verification</h1>
            </div>
            <div class="content">
                <p>Hello,</p>
                <p>You have requested to reset your password. Please use the following One-Time Password (OTP) to complete your request:</p>
                <div class="otp">' . $otp . '</div>
                <p>If you did not request a password reset, please ignore this email or contact support.</p>
                <p>Thank you!</p>
                <p>Best regards,<br>Your Company Name</p>
            </div>
        </div>
    </body>
    </html>
    ';

    $mail->send();
};

sendEmailToCustomer($reset_email, $randomOtp);

header('Location: ./otp-verification.php');

?>
