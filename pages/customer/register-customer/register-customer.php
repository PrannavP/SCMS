<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Register</title>
    <link rel="stylesheet" href="../../../styles/customer-register.css">
    <style>
        .error-message {
            position: fixed;
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

        <form action="../../../middlewares/customer-register.php" method="post">
            <h3 class="form-title">Create a new account</h3>

            <!-- Error message display -->
            <?php if (isset($_GET['error'])): ?>
                <p class="error-message"><?php echo htmlspecialchars($_GET['error']); ?></p>
            <?php endif; ?>

            <div class="input-containers">
                <div class="fullname">
                    <label for="fullname">Full Name:</label><br>
                    <input type="text" name="fullname" id="fullname" required>
                </div>
                <div class="phonenumber">
                    <label for="pnumber">Phone Number:</label><br>
                    <input type="tel" name="pnumber" id="pnumber" required>
                </div>
                <div class="email">
                    <label for="email">Email:</label><br>
                    <input type="email" name="email" id="email" required>
                </div>
                <div class="model">
                    <label for="model">Model: </label><br>
                    <select name="model" id="model" required>
                        <option value="" selected>SELECT YOUR MODEL</option>
                        <option value="TVS-NTORQ-REFI">TVS-NTORQ-REFI</option>
                        <option value="TVS-NTORQ">TVS-NTORQ</option>
                        <option value="TVS-RAIDER">TVS-RAIDER</option>
                        <option value="TVS-APACHE-RTR">TVS-APACHE-RTR</option>
                        <option value="TVS-JUPITER">TVS-JUPITER</option>
                        <option value="TVS-RAEDON">TVS-RAEDON</option>
                    </select>
                </div>
                <div class="password">
                    <label for="psw">Password:</label><br>
                    <input type="password" name="psw" id="psw" required>
                </div>
                <div class="confirm-password">
                    <label for="cpsw">Confirm Password:</label>
                    <input type="password" name="cpsw" id="cpsw" required>
                </div>
            </div>

            <center><button id="customer-register" name="customer-register">Register</button></center>

            <hr>

            <center>
                <button class="already-have-account-btn">
                    <a href="../customer-login.php">Already have account?</a>
                </button>
            </center>
        </form>
    </main>

    <script>
        setTimeout(function() {
            var errorMessage = document.querySelector('.error-message');
            if (errorMessage) {
                errorMessage.style.display = 'none';
            }
        }, 2500);
    </script>
    
</body>
</html>