<?php 

    require '../../../middlewares/connection.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require '../../../phpmailer/src/Exception.php';
    require '../../../phpmailer/src/PHPMailer.php';
    require '../../../PHPMailer/src/SMTP.php';

    function sendEmailToCustomer(){
        $reset_email = $_POST["reset_email"];

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
        $mail->addAddress($reset_email);
        $mail->isHTML(true);

        $mail->CharSet = 'UTF-8';

        $mail->Subject = "Password Reset Link";
        $mail->Body = '
            <p>Your reset link is <a href="#"></a>Link</p><br>
        ';

        $mail->send();
    };

    sendEmailToCustomer();

?>