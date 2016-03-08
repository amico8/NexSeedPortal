<?php 
	require('models/content.php');

	//コントローラのクラスをインスタンス化
	$controller = new ContentsController();

	//アクション名によって、呼び出すメソッドを変える
	//$action (グローバル変数)は、routes.phpで定義されているもの

	switch ($action) {

		case 'add';
		$controller->add();
		 break;


		case 'confirm':
        $controller->confirm();
            break;


		default:
			break;
	}


	class ContentsController {
		//プロパティ
		private $action = '';
		private $resource = '';
		private $viewOptions = '';

	public function add(){

		$this->action='add';
		$this->resource='contents';
		include('views/layout/application.php');


	}
    public function confirm() {

        // $content = new Content();

        $this->resource = 'contents';
        $this->action = 'confirm';
        include('views/layout/application.php');
	}
	
	}
 ?>