<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification Error</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            text-align: center;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #ff0000;
        }

        p {
            color: #555555;
            margin-bottom: 20px;
        }

        .btn-container {
            margin-top: 20px;
        }

        .btn {
            display: inline-block;
            padding: 15px 30px;
            text-decoration: none;
            color: #ffffff;
            background-color: #007BFF;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Error: Invalid or Expired Verification Link</h1>
        <p>The verification link is either invalid or has expired. Please click the button below to resend the verification email.</p>
        <div class="btn-container">
            <a href="<?=site_url('login/resendVerificationToken/'.$token)?>" class="btn">Resend Verification Email</a>
        </div>
    </div>
</body>
</html>
