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

    //idがあった場合idも取得する
    if (isset($params[2])) {
        $id = $params[2];
    }
    //POST送信されたらtitle,bodyを取得
    // if (isset($_POST['title'])&&isset($_POST['body'])) {
    if(isset($_POST)&&!empty($_POST)){
    	$post = $_POST;
    }

    if(isset($_FILES) && !empty($_FILES)) {
        $fileName = $_FILES['picture_path']['name'];
        var_dump($fileName);
    }

    // if (!empty($fileName)) {
    //     $ext = substr($fileName, -3);
    //     if ($ext != 'jpg' && $ext != 'gif' && $ext != 'JPG'){
    //         $error['picture_path'] = 'type';
    //     }
    // }

    $_SESSION['edit'] = $post;
    // 画像をアップロードする
    if (isset($fileName) && !empty($fileName)) {
        $picture_path = date('YmdHis') . $fileName;
        move_uploaded_file($_FILES['picture_path']['tmp_name'], 'NexSeedPortal/webroot/asset/images/post_images/' . $picture_path);
        $_SESSION['edit']['picture_path'] = $picture_path;
        header('Location: /NexSeedPortal/contents/editConfirm/'.$id);
    }
    // check.phpへ遷移
    // header('Location: check.php');

    // echo ("routes.phpにきました。");
    //コントローラの呼び出し
    require('controllers/'.$resource.'_controller.php');
?>