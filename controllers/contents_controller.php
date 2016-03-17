<?php
    session_start();
    require('models/content.php');
    require('function.php');

    // テスト用（後で消す）
    // $_SESSION['user_id'] = '5';
    // $_SESSION['created'] = time();
    // $_SESSION['user_name'] = 'maiko';

    //ログインチェック
    if (isset($_SESSION['user_id'])&&!empty($_SESSION['user_id'])) {
        if (login2($_SESSION)) {
            $_SESSION['created'] = time();
        } else {
            header('Location: /NexSeedPortal/users/login/');
        }
    } else{
        header('Location: /NexSeedPortal/users/login/');
    }
    //コントローラのクラスをインスタンス化
    $controller = new ContentsController();
    switch ($action) {
        case 'index':
            $controller->index($id,$post);
            break;

        default:
            break;
    }

    class ContentsController{
        //プロパティ
        private $content = '';
        private $action = '';
        private $resource = '';
        private $viewOptions = '';

        public function __construct(){
            //モデルを呼び出す
            $this->content = new Content();
        }

        public function index($id,$post){
            $this->viewOptions = $this->content->index($id,$post);
            //アクション名を設定
            $this->resource = 'contents';
            $this->action = 'index';
            //ビューを呼び出す
            require('views/layout/application.php');
        }
    }
 ?>