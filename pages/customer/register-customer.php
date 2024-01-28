<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Login</title>
    <link rel="stylesheet" href="../../styles/customer-register.css">
</head>
<body>

    <header>

        <h2>TVS Service Center</h2>

    </header>

    <main>

        <form action="../../middlewares/customer-register.php" method="post">

            <h4 class="form-title">Customer Register</h4>

            <div class="fullname">

                <label for="fullname">Full Name:</label><br>
                <input type="text" name="fullname" id="fullname">

            </div>

            <div class="phonenumber">

                <label for="pnumber">Phone Number:</label><br>
                <input type="number" name="pnumber" id="pnumber">

            </div>

            <div class="email">

                <label for="email">Email:</label><br>
                <input type="email" name="email" id="email">

            </div>

            <div class="model">

                <label for="model">Model: </label><br>
                <select name="model" id="model">
                    <option value="" selected>SELECT YOUR MODEL</option>
                    <?php 
                        require '../../middlewares/connection.php';

                        // query to retireve the models from database
                        $result = $conn->query("SHOW COLUMNS FROM customer WHERE Field = 'model'");
                        $row = $result->fetch_assoc();

                        $models = explode("','", substr($row['Type'], 6, -2));

                        // Displaying the models as options
                        foreach($models as $model){
                            echo "<option value=\"$model\">$model</option>";
                        }

                        // closing the db connection
                        $conn->close();
                    ?>
                </select>

            </div>

            <div class="password">

                <label for="psw">Password:</label><br>
                <input type="password" name="psw" id="psw">

            </div>
            

            <center><button id="customer-register" name="customer-register">Register</button></center>

        </form>

    </main>
    
</body>
</html>