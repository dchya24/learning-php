<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register | <?php echo config('APP_NAME') ?></title>
</head>
<body>
    <form action="<?php echo base_url() . 'api/post/register'?>" method="post">
        <input type="text" name="name"> <br>
        <input type="email" name="email"> <br>
        <input type="password" name="password" id=""> <br>
        <button type="submit" value="submit" name="submit"> Register</button>
    </form>
    <?php 
        if(array_key_exists('message', $_SESSION)) {
            echo $_SESSION['message'];
            session_unregister($SESSION['message']);
        }
    ?>
</body>
</html>