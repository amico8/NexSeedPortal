<?php
	require('models/content.php');

	//コントローラのクラスをインスタンス化
	$controller = new ContentsController();

	//アクション名によって、呼び出すメソッドを変える
	//$action (グローバル変数)は、routes.phpで定義されているもの

	switch ($action) {
		case 'index';
		    $controller -> index();
		    break;



		default:
			break;
	}

	class ContentsController{
		//プロパティ
		private $action = '';
		private $resource = '';
		private $viewOptions = '';

    public function index(){
    	//モデルを呼び出す
        	$blog = new Blog();
            $this->viewOptions = $blog->index();

        //アクション名を設定
            $this->action = 'index';

        //ビューを呼び出す
            require('views/layout/application.php');
    }


	}

 ?>