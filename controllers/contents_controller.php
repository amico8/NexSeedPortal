<?php 
	require('models/content.php');

	//コントローラのクラスをインスタンス化
	$controller = new ContentsController();

	//アクション名によって、呼び出すメソッドを変える
	//$action (グローバル変数)は、routes.phpで定義されているもの

	switch ($action) {

		case 'add';
		$controller->add();

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

	}

 ?>