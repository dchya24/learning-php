<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Upload | <?php echo config('APP_NAME'); ?></title>    
    <link rel="stylesheet" href="<?php echo url('assets/css/master.css'); ?>" >
    <link rel="stylesheet" href="<?php echo url('assets/css/upload.css'); ?>" >
    <link rel="stylesheet" href="<?php echo url('assets/css/style.css'); ?>" >
    <link rel="stylesheet" href="<?php echo url('assets/font-awesome-4.7.0/css/font-awesome.min.css'); ?>" >

    <style>

    </style>
    <script>
        window.BASE_URL = "<?php echo base_url(); ?>"
    </script>
</head>
<body>
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
    <div class="sidebar">
        <div class="logo"> Arsip</div>
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
        <h1 style="padding: 0.5rem">Upload Arsip </h1>
        <div class="isi">
            <form method="post" class="form" action="<?php echo base_url() . 'api/post/upload';?>" enctype="multipart/form-data">
                <label><b>File Name</b></label>    <br>
                <input type="text" name="name" id="name" placeholder="name"> <br>
                <label for="file" class="btn-success">Input File
                </label>
                <input type="file" name="file[]" id="file" accept="image/*,video/*,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.openxmlformats-officedocument.presentationml.presentation,application/vnd.openxmlformats-officedocument.wordprocessingml.document"> <br>
                <button type="submit" class="btn-submit" value="upload" name="upload"> Upload</button>
            </form>
            <div class="container_img">
                <p id="text_size"></p>                
                <div class="img">
                    <img src="" alt="" id="img">
                </div>
            </div>
            
        </div>
    </div>

 
    <!-- <div class="alert success">
        <span class="closebtn" onclick="this.parentElement.style.display='none'"> &times;</span>
        asd
    </div> -->

    <script src="<?php echo base_url() . 'assets/js/upload.js';?>"></script>
</body>
</html>