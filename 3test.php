<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "scms";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch parts from the inventory table
$sql = "SELECT `id`, `item_name` FROM inventory";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<option value="' . $row["id"] . '">' . $row["item_name"] . '</option>';
    }
} else {
    echo '<option value="">No parts available</option>';
}

$conn->close();
?>
