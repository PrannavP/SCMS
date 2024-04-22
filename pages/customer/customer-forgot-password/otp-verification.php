<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ServEase</title>
    <link rel="stylesheet" href="../../../styles/customer-otp-verification-page.css">
</head>
<body>

    <header>

        <h2>SERVEASE</h2>

    </header>

    <main>

        <form action="./verify-otp-logic.php" method="post">

            <center>

                <h3>Password Reset OTP Verification</h3>

                <div class="otp-field">

                    <label for="otp">Enter the code that was sent to your email</label><br>

                    <input type="number" name="otp" id="otp" autocomplete="off">

                </div>

                <button>Verify</button>

            </center>

        </form>

    </main>
    
</body>
</html>