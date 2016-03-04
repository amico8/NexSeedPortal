<?php 
	require('models/content.php');

	//コントローラのクラスをインスタンス化
	$controller = new ContensController();

	//アクション名によって、呼び出すメソッドを変える
	//$action (グローバル変数)は、routes.phpで定義されているもの

	switch ($action) {



		default:
			break;
	}

	class ContentsController {
		//プロパティ
		private $action = '';
		private $resource = '';
		private $viewOptions = '';



	}

 ?>