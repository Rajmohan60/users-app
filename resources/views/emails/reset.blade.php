<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 0;
            margin: 0;
            background-color: #f4f4f4;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .container {
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            text-align: center;
        }
        h2 {
            color: #007BFF;
            font-size: 24px;
            margin-bottom: 20px;
            font-weight: bold;
        }
        p {
            margin-bottom: 20px;
            font-size: 16px;
        }
        .button {
            background-color: #007BFF;
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Password Reset Request</h2>
        <p>Hi,</p>
        <p>You requested to reset your password. Click the button below to reset it:</p>
        <a href="{{ $link }}" class="button">Reset Password</a>
        <p>If you did not request a password reset, please ignore this email.</p>
        <p>Thank you!</p>
    </div>
</body>
</html>
