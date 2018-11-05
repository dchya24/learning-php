<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register | <?php echo config('APP_NAME') ?></title>
    <link rel="stylesheet" href="<?php echo url('assets/css/login.css'); ?>">
    <link rel="stylesheet" href="<?php echo url('assets/css/color-pallete.css'); ?>">
    <link rel="stylesheet" href="<?php echo url('assets/css/style.css'); ?>">
    <style>
        input {
            margin-bottom: 0.5rem;
        }
        .alert{
            top: 15%;
        }
    </style>
</head>
<body class="light-primary-color">
    <?php 
        if(array_key_exists('message', $_SESSION)) {
            
    ?>
    <div class="alert <?php echo $_SESSION['message']['status']; ?>">
        <span class="closebtn" onclick="this.parentElement.style.display='none'"> &times;</span>
        <?php  echo $_SESSION['message']['message']; ?>
    </div>
            
    <?php 
        }
        unset($_SESSION['message']);
    ?>
    <div class="card">
        <div class="header default-primary-color">
            Register
        </div>
        <div class="content">
            <form class="form" action="<?php echo base_url() . 'api/post/register'?>" method="post">
                <input type="text" name="name" placeholder="Name" required> <br>
                <input type="email" name="email" placeholder="Email" required> <br>
                <input type="password" name="password" id="password" placeholder="Password" required> <br>
                <input type="password" name="confirmation_password" id="confirm_password" placeholder="Confirmation Password" required> <br>
                <button type="submit" value="submit" name="submit" id="submit" disabled> Register</button>
            </form>
        </div>
        <div class="footer">
            <a href="<?php echo url('login'); ?>"> Login</a>
        </div>
    </div>

    <script src="<?php echo url('assets/js/register.js'); ?>"></script>
</body>
</html>