<?php
header('Content-Type: application/json');

$conn = mysqli_connect("localhost", "root", "", "scms");

if (!$conn) {
    die(json_encode(array("error" => "Connection failed: " . mysqli_connect_error())));
}

$requested_by = $_POST['requested_by'];
$new_parts = $_POST['parts'];
$total_price = $_POST['totalPrice'];

// First, get the existing parts
$get_existing_sql = "SELECT parts FROM service_request WHERE requested_by = '$requested_by'";
$existing_result = mysqli_query($conn, $get_existing_sql);

if ($existing_row = mysqli_fetch_assoc($existing_result)) {
    $existing_parts = explode(', ', $existing_row['parts']);
    $new_parts = array_merge($existing_parts, $new_parts);
}

$new_parts = array_filter($new_parts); // Remove any empty values
$new_parts = array_unique($new_parts); // Remove duplicates
$parts_string = implode(', ', $new_parts);

$update_sql = "UPDATE service_request SET parts = '$parts_string', amount = $total_price WHERE requested_by = '$requested_by'";

if (mysqli_query($conn, $update_sql)) {
    echo json_encode(array(
        "message" => "Parts and price updated successfully",
        "parts" => $parts_string,
        "amount" => $total_price
    ));
} else {
    echo json_encode(array("error" => "Error updating parts and price: " . mysqli_error($conn)));
}

mysqli_close($conn);
?>