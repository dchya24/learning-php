<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> Dashobard | <?php echo config('APP_NAME'); ?> </title>
    <link rel="stylesheet" href="<?php echo base_url(). 'assets/css/style.css'; ?>" >
    <style>
    * {
        margin: 0;
        padding: 0;
    }
    </style>
</head>
<body>
<?php
    array_key_exists("message", $_SESSION) ? print_r($_SESSION['message']) : $lol = "lol" ;
    unset($_SESSION['message']);

    foreach($arsip as $data) {
        echo "<p> nama arsip : " . $data['name'].
            " <br> download : <a href='". url('could/' . $data['url']) ."' download> {$data['url']}</a>
            <br> hapus : delete <a href='". url('api/post/delete?id=' . $data['id'])."' > Hapus aja</a>
            </p> <br>";

    }
?>
</body>
</html>