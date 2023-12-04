<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Confirmation</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            text-align: center;
        }

        .card {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 40px 20px;
        }

        .card-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .card-header img {
            height: 100px;
            width: auto;
        }

        h1 {
            font-size: 28px;
            color: #333;
            margin-bottom: 20px;
        }

        p {
            font-size: 16px;
            color: #555;
            line-height: 1.6;
            margin-bottom: 10px;
        }

        .logo-svg {
            width: 120px;
            height: 39px;
        }
        /* CSS for the Verify Email button */
        a.verify-email-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #3490dc; /* Button background color */
            color: #ffffff; /* Button text color */
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }

        a.verify-email-button:hover {
            background-color: #0070cc; /* Hover background color */
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <img src="https://p4pfitness.online/storage/assets/img/landingpage/logo.png" alt="logo">
            </div>
            <h1>Verify Email Address</h1>
            
            <p>Thank you for signing up! Please click the button below to verify your email address.</p>
            
            <p><a class="verify-email-button" href="{{ route('user.verify', $token) }}">Verify Email Address</a></p>
            
            <p>If you did not create an account, Please ignore this email.</p>
        </div>
    </div>
</body>
</html>
