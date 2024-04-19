<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ServEase</title>
    <link rel="stylesheet" href="../../../styles/customer-otp-verification.css">
</head>
<body>

    <div class="container">

        <form action="./verify-otp-logic.php" method="post">

            <h3>Password Reset OTP Verification</h3>

            <div class="otp-field">

                <label for="otp">OTP</label><br>

                <input type="number" name="otp" id="otp">

            </div>

            <button>Submit</button>

        </form>

    </div>
    
</body>
</html>