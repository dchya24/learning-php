<?php

function directory($request) {
    return BASE_URL . "/$request";
}

function base_url(){
    // $base =  sprintf(
    //   "%s://%s%s",
    //   isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
    //   $_SERVER['SERVER_NAME'],
    //   $_SERVER['REQUEST_URI']
    // );

    $http =  isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http';
    $base = $_SERVER['SERVER_NAME'];
    $path = explode('/', $_SERVER['REQUEST_URI']);
    if($path[1] == config("APP_FOLDER")) {
        $url = "$http://$base/$path[1]/public/";

        return $url;
    }else {
        $url = "$http://$base/";

        return $url;
    }
}

function redirect($url) {
    header('Location: '. $url);
}

function redirect_back() {
    header("Location: " . $_SERVER['HTTP_REFERER']);
}