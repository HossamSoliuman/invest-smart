<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .header {
            background-color: #ffffff;
            color: #f08629;
            text-align: center;
            border-top-left-radius: 5px;
            border-top-right-radius: 5px;
        }

        .content {
            padding: 20px;
            color: #333333;
        }

        .content h1 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .content p {
            font-size: 16px;
            line-height: 1.5;
            margin: 10px 0;
        }

        .code {
            font-size: 20px;
            font-weight: bold;
            background-color: #f4f4f4;
            padding: 10px;
            margin: 20px 0;
            text-align: center;
            border: 1px dashed #ddd;
        }

        .footer {
            text-align: center;
            font-size: 14px;
            color: #666666;
            padding: 20px;
            border-top: 1px solid #ddd;
        }

        .footer a {
            color: #0056b3;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="header">
            <img src="https://admin.invest-smartnow.com/img/logo-trans.png" width="120px" alt="Invest Smart" />
        </div>
        <div class="content">
            <h1>Hello, {{ $userName }}</h1>
            <p>Thank you for joining <b>Invest Smart</b>. To complete your registration, please verify your email
                address by using the code below:</p>
            <div class="code">{{ $verificationCode }}</div>
            <p>If you did not create an account on <a href="https://invest-smartnow.com/">Invest Smart</a>, you can
                safely ignore this email. No further action is required.</p>
        </div>
        <div class="footer">
            <p>© {{ date('Y') }} Invest Smart. All rights reserved.</p>
        </div>
    </div>
</body>

</html>
