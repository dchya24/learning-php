<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Settings | <?php echo config('APP_NAME'); ?></title>
    <link rel="stylesheet" href="<?php echo url('assets/css/master.css'); ?>" >
    <link rel="stylesheet" href="<?php echo url('assets/css/style.css'); ?>">
    <link rel="stylesheet" href="<?php echo url('assets/css/color-pallete.css'); ?>">
    <link rel="stylesheet" href="<?php echo url('assets/css/login.css'); ?>">
    <link rel="stylesheet" href="<?php echo url('assets/font-awesome-4.7.0/css/font-awesome.min.css'); ?>" >
</head>
<style>
    input{
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        box-sizing: border-box;
    }
    .alert {
        position: relative !important;
        top: 0 !important;
        left: 0 !important;
        transform: translate(0,0) !important;
    }
    button { font-size : 1.5rem !important;}
</style>
<body>
    <div class="sidebar">
        <div class="logo"> <?php echo config('APP_NAME'); ?></div>
        <div class="user"> 
            <i class="fa fa-user-circle-o fa-3x"></i> <br>
            <?php echo $_SESSION['user']['name']; ?>
        </div>
        <a href="<?php echo url("dashboard"); ?>"> <i class="fa fa-home"></i> Home </a>
        <a href="<?php echo url("upload"); ?>"> <i class="fa fa-cloud-upload"></i> Upload</a>
        <a href="<?php echo url("settings"); ?>"> <i class="fa fa-cog"></i> Settings</a>
    </div>

    <div class="content">
        <div class="header">
            <div class="panjang"></div>
            <a href="<?php echo url("logout"); ?>" class="logout">
                Logout <i class="fa fa-sign-out"></i>
            </a>
        </div>
        <div class="isi">
            <div style="margin: auto; text-align: center;">
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
            </div>
            <form method="post" class="form"  style="width: 50%; margin: auto;" action="<?php echo url('api/post/update-user'); ?>">
        
                <div class="container">
                    <label><b>Name</b></label>
                    <input type="text" placeholder="Name" name="name" value="<?php echo $_SESSION['user']['name']; ?>" required>                        
                    <button type="submit" name="update" value="update">Update</button>
                </div>

            </form>
        </div>
    </div>
</body>
</html>