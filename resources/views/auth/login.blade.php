<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login | <?php echo config('APP_NAME') ?></title>
</head>
<body>
    <form method="post" action="<?php echo base_url() . 'api/post/login';?>">
        <input type="email" name="email" id=""> <br>
        <input type="password" name="password"> <br>
        <button type="submit" name="login" value="login">Login</button>
    </form>
    <?php 
        if(array_key_exists('message', $_SESSION)) {
            print_r($_SESSION['message']);
            unset($_SESSION['message']);
        }
    ?>
</body>
</html>