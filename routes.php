<?php
    //セッションを挿入
    session_start();

    //$GETパラメータ取得
    //explode関数:第二引数の文字列を第一引数で分割し、配列で返す関数
    $params = explode('/', $_GET['url']);

    //パラメータの分解
    $resource = $params[0];
    $action = $params[1];
    $id = 0;
    $post = array();
    $get = array();

    //idがあった場合idも取得する
    if (isset($params[2])) {
        $id = $params[2];
    }
    //POST送信されたらtitle,bodyを取得
    // if (isset($_POST['title'])&&isset($_POST['body'])) {
    if(isset($_POST)&&!empty($_POST)){
    	$post = $_POST;
    }

    if(isset($_GET) && !empty($_GET)) {
        $get = $_GET;
    }

    if(isset($_FILES['picture_path']['name']) && !empty($_FILES['picture_path']['name'])) {
        $files = $_FILES['picture_path']['name'];
    }



    // if (!empty($fileName)) {
    //     $ext = substr($fileName, -3);
    //     if ($ext != 'jpg' && $ext != 'gif' && $ext != 'JPG'){
    //         $error['picture_path'] = 'type';
    //     }
    // }

    $_SESSION['edit'] = $post;
    // 画像をアップロードする
    
    // check.phpへ遷移
    // header('Location: check.php');

    // echo ("routes.phpにきました。");
    //コントローラの呼び出し
    require('controllers/'.$resource.'_controller.php');
?>