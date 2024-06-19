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

        <h2>SERVEASE</h2>

    </header>

    <main>

        <form action="../../middlewares/login.php" method="post">

            <center><h4 class="form-title">Customer Login</h4></center>

            <div class="email">

                <label for="email">Email:</label><br>
                <input type="email" name="email" id="email">

            </div>

            <div class="password">

                <label for="psw">Password:</label><br>
                <input type="password" name="psw" id="psw">

            </div>

            <center><button id="customer-login" name="customer-login">Login</button></center>

            <!-- <p class="forgot-password"><a href="./customer-forgot-password/customer-forgot-password.html">Forgot Password?</a></p><br> -->

        </form>

    </main>

    <!-- <center><p class="create-account-text"><a href="../customer/register-customer/register-customer.html">Create Account</a></p></center> -->
    <div class="buttons-container">

        <button class="forgot-password-button control-button">

            <a href="./customer-forgot-password/customer-forgot-password.html">Forgot Password</a>

        </button>

        <button class="create-account-button control-button">

            <a href="../customer/register-customer/register-customer.html">
                Create Account
            </a>

        </button>

    </div>
    
</body>
</html>