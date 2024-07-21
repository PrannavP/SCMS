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

if (isset($_POST['option'])) {
    $option = $_POST['option'];

    // Construct the SQL query
    $sql = "SELECT request_id, requested_by, parts FROM service_request WHERE requested_by = '$option'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Parts</th>
                </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["request_id"] . "</td>
                    <td>" . $row["requested_by"] . "</td>
                    <td>" . $row["parts"] . "</td>
                </tr>";
        }
        echo "</table>";
    } else {
        echo "0 results";
    }
}

$conn->close();
?>
