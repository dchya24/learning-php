<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Upload | <?php echo config('APP_NAME'); ?></title>
    <style>
        img {
            width: 100%;
            box-shadow : 0 0 1rem rgba(0,0,0, 0.5)
        }

        .img {
            width: 200px;
            display: none;
        }
    </style>
    <script>
        window.BASE_URL = "<?php echo base_url(); ?>"
    </script>
</head>
<body>
    <form method="post" action="<?php echo base_url() . 'api/post/upload';?>" enctype="multipart/form-data">
        <input type="text" name="name" id="name" placeholder="name"> <br>
        <input type="file" name="file[]" id="file" accept="image/*,video/*,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.openxmlformats-officedocument.presentationml.presentation,application/vnd.openxmlformats-officedocument.wordprocessingml.document"> <br>
        <button type="submit" value="upload" name="upload"> Upload</button>
    </form>
    <div class="img">
        <p id="text_size"></p>
        <img src="" alt="" id="img">
    </div>
    <?php 
        array_key_exists("message", $_SESSION) ? print_r($_SESSION['message']) : $lol = "lol" ;
        unset($_SESSION['message']);
    ?>
    <script src="<?php echo base_url() . 'assets/js/upload.js';?>"></script>
</body>
</html>