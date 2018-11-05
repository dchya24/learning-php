<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login | <?php echo config('APP_NAME') ?></title>
    <link rel="stylesheet" href="<?php echo url('assets/css/login.css'); ?>">
    <link rel="stylesheet" href="<?php echo url('assets/css/color-pallete.css'); ?>">
    <link rel="stylesheet" href="<?php echo url('assets/css/style.css'); ?>">
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
            Login
        </div>
        <div class="content">
            <form class="form" method="post" action="<?php echo base_url() . 'api/post/login';?>">
                <input type="email" name="email" id="" value="" placeholder="Email"> <br>
                <input type="password" name="password" value="" placeholder="Password"> <br>
                <button type="submit" name="login" value="login">Login</button>
            </form>
        </div>
        <div class="footer">
            <a href="<?php echo url('register'); ?>"> Register?</a>
        </div>
    </div>
    
    
</body>
</html>