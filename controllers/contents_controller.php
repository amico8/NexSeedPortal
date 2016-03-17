<?php
    session_start();
    require('models/content.php');

    //ログインチェックを実装
    require('function.php');
    require('dbconnect.php');
    if (isset($post['email'])&&!empty($post['email'])) {
        login($post,$db);
    } elseif (isset($_SESSION['user_id'])&&!empty($_SESSION['user_id'])) {
        login2($_SESSION,$db);
    }else{
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
        private $loginAction = '';

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