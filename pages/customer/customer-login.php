<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Login</title>
    <link rel="stylesheet" href="../../styles/customer-login.css">
    <style>
        .error-message {
            position: absolute;
            top: 20px;
            right: 20px;
            background-color: #f8d7da;
            color: #721c24;
            padding: 10px;
            border: 1px solid #f5c6cb;
            border-radius: 5px;
            font-size: 14px;
            z-index: 1000;
        }
    </style>
</head>
<body>
    <header>
        <h2>SERVEASE</h2>
    </header>
    <main>
        <form action="../../middlewares/login.php" method="post">
            <center><h4 class="form-title">Customer Login</h4></center>

            <!-- Error message display -->
            <?php if (isset($_GET['error'])): ?>
                <p class="error-message" id="errorMessage"><?php echo htmlspecialchars($_GET['error']); ?></p>
            <?php endif; ?>

            <div class="email">
                <label for="email">Email:</label><br>
                <input type="email" name="email" id="email" required aria-label="Email">
            </div>
            <div class="password">
                <label for="psw">Password:</label><br>
                <input type="password" name="psw" id="psw" required aria-label="Password" autocomplete="off">
            </div>
            <center><button id="customer-login" name="customer-login">Login</button></center>
        </form>
    </main>
    <div class="buttons-container">
        <button class="forgot-password-button control-button">
            <a href="./customer-forgot-password/customer-forgot-password.html">Forgot Password</a>
        </button>
        <button class="create-account-button control-button">
            <a href="../customer/register-customer/register-customer.php">Create Account</a>
        </button>
    </div>
    <script>
        // Clear the error message after 5 seconds
        setTimeout(function() {
            var errorMessage = document.getElementById('errorMessage');
            if (errorMessage) {
                errorMessage.style.display = 'none';
            }
        }, 2500);

        // Clear the error message when the page is refreshed
        window.onload = function() {
            if (window.location.search.indexOf('error') !== -1) {
                var errorMessage = document.getElementById('errorMessage');
                if (errorMessage) {
                    var newURL = window.location.protocol + "//" + window.location.host + window.location.pathname;
                    window.history.replaceState({}, document.title, newURL);
                }
            }
        }
    </script>
</body>
</html>