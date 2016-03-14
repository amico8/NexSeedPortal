<?php
    //$GETパラメータ取得
    session_start();
    //explode関数:第二引数の文字列を第一引数で分割し、配列で返す関数
    $params = explode('/', $_GET['url']);
    //パラメータの分解
    $resource = $params[0];
    $action = $params[1];
    $id = 0;
    $post = array();
    //idがあった場合idも取得する
    if (isset($params[2])) {
        $id = $params[2];
    }

    //POST送信されたら値を取得
    if(isset($_POST)&&!empty($_POST)){
        $post = $_POST;
    } else if (isset($_SESSION['post']) && !empty($_SESSION['post'])) {
        //セッションでpostを引き渡す場合
        $post = $_SESSION['post'];
    }
    //コントローラの呼び出し
    require('controllers/'.$resource.'_controller.php');
?>