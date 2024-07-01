<?php

    require '../../../middlewares/connection.php';
    require_once '../../../middlewares/checkAuth.php';

    // Check if the user is authenticated
    if (!isCustomerAuthenticated()) {
        // Redirect to the login page or display a message
        header("Location: ../customer-login.php");
        exit();
    }

?>

<?php

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $fullname = $_POST["fullname"];
        $contact_number = $_POST["contact_number"];
        $email = $_POST["email"];
        $model = $_POST["model"];

        // updating the customer details
        $sql_query_to_update_customer_details = "UPDATE `customer` SET full_name = '$fullname', phone_number = '$contact_number', email = '$email', model = '$model'";

        if(mysqli_query($conn, $sql_query_to_update_customer_details)){
            echo "<p class='update-profile-success' id='profile-update-text'>Profile updated successfully</p>";
        }else{
            echo "<p class='update-profile-error'>Error while updating!</p>";
        };
    }

    // getting customer details
    $customer_full_name = $_SESSION["customer"]["name"];

    // fetching customer details
    $sql_query_to_get_customer_details = "SELECT * FROM `customer` WHERE full_name = '$customer_full_name'";
    $result = mysqli_query($conn, $sql_query_to_get_customer_details);

    if($result){
        $customer = mysqli_fetch_assoc($result);
    }else{
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ServEase | Customer</title>
    <link rel="stylesheet" href="../../../styles/customer-editprofile.css">
</head>
<body>

    <header>

        <h2>SERVEASE</h2>

    </header>

    <main>

        <div class="change-text">

            <h3>Update Your Profile</h3>
        
        </div>

        <form action="./edit-profile.php" method="post">

            <div class="customer-name-field">

                <input type="text" name="fullname" value="<?php echo $customer["full_name"] ?>">

            </div>

            <div class="customer-email-field">

                <input type="email" name="email" value="<?php echo $customer["email"] ?>">

            </div>

            <div class="customer-phonenumber-field">

                <input type="number" name="contact_number" value="<?php echo $customer['phone_number'] ?>">

            </div>

            <div class="customer-model-field">

                <input type="text" name="model" value="<?php echo $customer['model'] ?>">
            
            </div>

            <div class="edit-button-field">

                <button class="edit-button">Edit</button>

            </div>

        </form>

    </main>

    <script src="../../../scripts/customer-edit.js"></script>

</body>
</html>