<!DOCTYPE html>
<html lang="en">
<head>
<?php 
    $array_type = [
        "application/postscript" => "adobe", // ilustrator
        "application/vnd.openxmlformats-officedocument.wordprocessingml.document" => "document", // word
        "application/vnd.openxmlformats-officedocument.presentationml.presentation" =>  "presentation" , // presention
        "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" => "sheet", // excel
        "application/zip" => "zip", // zip
        "image/jpeg" => "foto", // jpg image
        "image/png" => "foto", // png image
        "video/mp4" => "video",
        "video/x-matroska" => "video", // mkv
        "application/octet-stream" => "subtitle", // srt (subtitle film)
        "application/pdf" => "zip"
    ];
?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="current_url" content="<?php echo CURRENT_URL; ?>">
    <title> Dashobard | <?php echo config('APP_NAME'); ?> </title>
    <link rel="stylesheet" href="<?php echo url('assets/css/master.css'); ?>" >
    <link rel="stylesheet" href="<?php echo url('assets/css/style.css'); ?>" >
    <link rel="stylesheet" href="<?php echo url('assets/font-awesome-4.7.0/css/font-awesome.min.css'); ?>" >
    <style>
        .alert {
            position: fixed;
            bottom: 2%;
            right: 2%;
        }
    </style>
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
            <div class="__header">
                <form mtehod="get" class="form">
                    <div class="form-input">
                        <label for=""> <b>Search </b></label> <br>
                        <input type="text" placeholder="Search arsip" name="search">
                    </div>
                    <div class="form-input">
                        <label for=""> <b> Paginate: </b> </label> <br>
                        <select name="paginate" id="paginate">
                            <option value="3"> 3 </option>
                            <option value="5"> 5 </option>
                            <option value="10"> 10 </option>
                        </select>
                    </div> <br>
                    <button type="submit"> Search </button>
                </form>
            </div>
            <div class="__content">
                <?php
                    foreach($arsip as $data) {
                ?>
                    <div class="card">
                        <?php 
                            $explode = explode('/', $data['type']);
                            if($explode[0] == 'image') { ?>
                                <img src="<?php echo url('could/' . $data['url']); ?>" alt="">
                            <?php } else { ?> 
                                <img src="<?php echo url('image/'.$array_type[$data['type']].'.svg'); ?>" alt="">                                
                            <?php } ?>
                        <div class="container">
                            <?php echo $data['name']; ?>
                            <br>
                            Upload Date : <?php echo date('d M Y', strtotime($data['uploaded_at']) ); ?>
                            <br> 
                            download : <a href="<?php echo url('could/'.$data['url']); ?>" download> download</a>
                            <br> <a href="<?php echo url('api/post/delete?id=' .$data['id']); ?>"> Delete</a>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <div class="pagination">
                <?php
                    $url = explode('&page=', CURRENT_URL);
                    for ($i=1; $i<=$pages ; $i++){ 
                        
                        if($current_page == $i) {?>
                            
                        <a class="active" href="<?php echo $url[0] ."&page=$i"; ?>"><?php echo $i; ?></a>   
                    <?php } else {?>
                        <a href="<?php echo $url[0] ."&page=$i"; ?>"><?php echo $i; ?></a>                        
                <?php } } ?>
            </div>    
        </div>
    </div>
</body>
</html>