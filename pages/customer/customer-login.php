<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Login</title>
    <link rel="stylesheet" href="../../styles/customer-login.css">
</head>
<body>

    <header>

        <h2>TVS Service Center</h2>

    </header>

    <main>

        <form action="../../middlewares/login.php" method="post">

            <h4 class="form-title">Customer Login</h4>

            <div class="email">

                <label for="email">Email:</label><br>
                <input type="email" name="email" id="email">

            </div>

            <div class="password">

                <label for="psw">Password:</label><br>
                <input type="password" name="psw" id="psw">

            </div>

            <center><button id="customer-login" name="customer-login">Login</button></center>
            <center><p class="create-account-text"><a href="./register-customer/register-customer.php">Create account here</a></p></center>

        </form>

    </main>
    
</body>
</html>