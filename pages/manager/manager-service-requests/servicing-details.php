<?php

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


// function to update servicing details
function updateServicingDetails($connection, $request_id){
    $details = $_POST["servicing-details"];

    $sql_query_to_update_details = "UPDATE `service_request` SET `details` = '$details' WHERE `request_id` = $request_id";

    mysqli_query($connection, $sql_query_to_update_details);
};

updateServicingDetails($conn, $req_id);

// function to update servicing amount
function updateAmount($connection, $request_id){
    $amount = $_POST["details-amount"];

    $sql_query_to_update_amount = "UPDATE `service_request` SET `amount` = '$amount' WHERE `request_id` = '$request_id'";

    mysqli_query($connection, $sql_query_to_update_amount);
};

updateAmount($conn, $req_id);

header("Location: manager-service-requests.php");