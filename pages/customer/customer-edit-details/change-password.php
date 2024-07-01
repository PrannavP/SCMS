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

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $old_password = $_POST["old_password"];
        $new_password = $_POST["new_password"];
        $full_name = $_SESSION["customer"]["name"];

        $sql_query_to_fetch_current_password = "SELECT password FROM `customer` WHERE full_name = '$full_name'";
        $result = mysqli_query($conn, $sql_query_to_fetch_current_password);

        if(mysqli_num_rows($result) == 1){
            $customer = mysqli_fetch_assoc($result);

            if(password_verify($old_password, $customer['password'])){
                // Old password matches, so update with new password
                $new_password_hashed = password_hash($new_password, PASSWORD_DEFAULT);
                $sql_query_to_change_password = "UPDATE `customer` SET password = '$new_password_hashed' WHERE full_name = '$full_name'";

                if(mysqli_query($conn, $sql_query_to_change_password)){
                    echo "Password Changed Successfully";
                    header("Location: ./customer-profile.php");
                }else{
                    echo "Error updaating password: " . mysqli_errno($conn);
                }
            }else{
                // echo "Old password does not match.";
                echo "<p id='old-password-error-text' class='old-password-error'>Old Password didnt match.</p>";
            }
        }else{
            echo "Customer not found";
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ServEase | Customer</title>
    <link rel="stylesheet" href="../../../styles/customer-changepassword.css">
</head>
<body>

    <header>

        <h2>SERVEASE</h2>

    </header>

    <main class="forgot-password-form-container">

        <div class="change-text">

            <h3>Change Your Password</h3>
        
        </div>

       <form action="./change-password.php" method="post">

            <div class="old-password-field">

                <input type="password" name="old_password" placeholder="Enter Your Old Password">

            </div>

            <div class="new-password-field">

                <input type="password" name="new_password" placeholder="Enter Your New Password">

            </div>

            <div class="change-password-button">

                <button>Change Password</button>

            </div>

       </form> 

    </main>

    <script src="../../../scripts/customer-changepsw.js"></script>
    
</body>
</html>