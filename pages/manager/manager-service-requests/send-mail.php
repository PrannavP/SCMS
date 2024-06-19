<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../../phpmailer/src/Exception.php';
require '../../../phpmailer/src/PHPMailer.php';
require '../../../PHPMailer/src/SMTP.php';

require '../../../middlewares/connection.php';
require_once '../../../middlewares/checkAuth.php';

// Check if the user is authenticated
if (!isManagerAuthenticated()) {
    // Redirect to the login page or display a message
    header("Location: ../../index.html");
    exit();
}

function getCustomerDetails($connection){
    $req_id = $_POST['request_id'];

    // sql query to get customer name and email
    $sql_query_to_get_name_and_email = "SELECT requested_by, email FROM service_request WHERE request_id = $req_id";

    $result = mysqli_query($connection, $sql_query_to_get_name_and_email);

    // Checking if query was successful or not
    if(!$result){
        die("Query failed:" . mysqli_error($connection));
        echo "Query Failed";
    }

    // Initialize variables
    $customer_name = null;
    $customer_email = null;

    // Fetch data from the result and store it
    if($row = mysqli_fetch_assoc($result)){
        $customer_name = $row['requested_by'];
        $customer_email = $row['email'];
    }else{
        // No rows returned
        $customer_name = null;
        $customer_email = null;
    }

    return [$customer_name, $customer_email, $req_id];
}

// Get customer details from the above function
list($customer_name, $customer_email, $req_id) = getCustomerDetails($conn);

// Function to send email to the customer
function sendEmailToCustomer($c_name, $c_email){
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
    $mail->addAddress($c_email);
    $mail->isHTML(true);
    $mail->CharSet = 'UTF-8';

    $mail->Subject = "Service Request Accepted";
    $mail->Body = '
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Service Request Accepted</title>
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
        </style>
    </head>
    <body>
        <div class="container">
            <div class="header">
                <h1>Service Request Accepted</h1>
            </div>
            <div class="content">
                <p>Dear ' . $c_name . ',</p>
                <p>Your servicing request has been accepted by the service center. Please visit the service center at the requested time.</p>
                <p>Thank you.</p>
            </div>
        </div>
    </body>
    </html>
    ';

    $mail->send();
}

sendEmailToCustomer($customer_name, $customer_email);

// Change the servicing status after email has been sent
function changeServicingStatus($connection, $request_id){
    $sql_query_to_change_status = "UPDATE service_request SET servicing_status = 'Pending Servicing' WHERE request_id = '$request_id'";

    $result = mysqli_query($connection, $sql_query_to_change_status);

    // Checking if query was successful or not
    if(!$result){
        die("Query failed:" . mysqli_error($connection));
    }

    // header("Location: manager-service-requests.php");
}

changeServicingStatus($conn, $req_id);

// assigning mechanics to service requests
function assignMechanics($connection, $request_id){
    $mechanic_name = $_POST["mechanic_name"];

    $sql_query_to_assign_mechanic = "UPDATE `service_request` SET `mechanic_assigned`='$mechanic_name' WHERE `request_id` = '$request_id'";

    mysqli_query($connection, $sql_query_to_assign_mechanic);

    // header("Location: manager-service-requests.php");
}

assignMechanics($conn, $req_id);

// function to update servicing details
function updateDetails($connection, $request_id){
    $details = $_POST['servicing-details'];

    $sql_query_to_update_details = "UPDATE `service_request` SET `details` = '$details' WHERE `request_id` = '$request_id'";

    mysqli_query($connection, $sql_query_to_update_details);
}

updateDetails($conn, $req_id);

// function to update servicing amount
function updateAmount($connection, $request_id){
    $amount = $_POST["amount"];

    $sql_query_to_update_amount = "UPDATE `service_request` SET `amount` = '$amount' WHERE `request_id` = '$request_id'";

    mysqli_query($connection, $sql_query_to_update_amount);
}

updateAmount($conn, $req_id);

function decreaseAvailableServicingSlot($connection){
    $service_center = $_SESSION["manager"]["service-center"];

    $sql_query_to_decrease_available_slot = "UPDATE `servicecenter` SET `available_slots` = `available_slots` - 1 WHERE `name` = '$service_center'";

    mysqli_query($connection, $sql_query_to_decrease_available_slot);
}

decreaseAvailableServicingSlot($conn);

header("Location: manager-service-requests.php");
?>
