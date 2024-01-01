<?php
$system=$this->home_model->system();
$contact=$this->home_model->contact();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Confirmation - <?=$contact['company_name']?></title>
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
            color: #333333;
        }

        p {
            color: #555555;
            margin-bottom: 20px;
        }

        a {
            display: inline-block;
            margin: 20px 0;
            padding: 15px 30px;
            text-decoration: none;
            color: #ffffff;
            background-color: #007BFF;
            border-radius: 5px;
        }

        a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Welcome to <?=$contact['company_name']?>!</h1>
        <img class="text-center  " src="<?= base_url($system['system_logo'])?>" width="50px" alt="Icon">
        <p>Your account has been successfully created. To activate your account and start enjoying our services, please confirm your registration by clicking the button below:</p>
        <a href="<?=$link?>" target="_blank">Confirm Your Account</a>
        <p>If the button above doesn't work, you can also copy and paste the following link into your browser:</p>
        <p><?=$link?></p>
        <p>This link will expire in <?=$expireTime?>.</p>
        <p>If you have any questions or need assistance, please contact our support team at <?=$contact['email']?>.</p>
        <p>Thank you for choosing <?=$contact['company_name']?>.</p>
    </div>
</body>
</html>
