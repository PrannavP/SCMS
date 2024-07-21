<?php
header('Content-Type: application/json');

error_reporting(E_ALL);
ini_set('display_error', 1);

$conn = mysqli_connect("localhost", "root", "", "scms");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$data = json_decode(file_get_contents('php://input'), true);
$parts = $data['parts'];

$total_price = 0;

foreach ($parts as $part) {
    $part = mysqli_real_escape_string($conn, $part);
    $price_sql = "SELECT item_price FROM inventory WHERE item_name = '$part'";
    $price_result = mysqli_query($conn, $price_sql);
    if ($price_row = mysqli_fetch_assoc($price_result)) {
        $total_price += $price_row['item_price'];
    }
}

echo json_encode(array("totalPrice" => $total_price));

mysqli_close($conn);
?>