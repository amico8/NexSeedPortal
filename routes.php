<?php

    session_start();
    //$GETパラメータ取得
    //explode関数:第二引数の文字列を第一引数で分割し、配列で返す関数
    $params = explode('/', $_GET['url']);

    //パラメータの分解
    $resource = $params[0];
    $action = $params[1];
    $id = 0;
    $post = array();
    $files = '';
    $fileName = '';

    //idがあった場合idも取得する
    if (isset($params[2])) {
        $id = $params[2];
    }
    //POST送信されたらtitle,bodyを取得
    if(isset($_POST)&&!empty($_POST)){
        $post = $_POST;
        $_SESSION['add'] = $post;
    }

    
    if (isset($_FILES['picture_path']['name']) && !empty($_FILES['picture_path']['name'])) {
        $fileName = $_FILES['picture_path']['name'];
        $files = $_FILES['picture_path'];
        if (isset($fileName)) {
                $picture_path = date('YmdHis') . $fileName;
                move_uploaded_file($_FILES['picture_path']['tmp_name'], 'webroot/asset/images/post_images/'. $picture_path);
                $files = $picture_path;
            }
    }

    if (isset($_SESSION['add']) && !empty($_SESSION['add'])) {
        $_SESSION['add'] += array('picture_path'=>$files);

    }


    //コントローラの呼び出し
    require('controllers/'.$resource.'_controller.php');
?>