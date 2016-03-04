<?php 
	require('models/content.php');

	//コントローラのクラスをインスタンス化
	$controller = new ContentsController();

	//アクション名によって、呼び出すメソッドを変える
	//$action (グローバル変数)は、routes.phpで定義されているもの

	switch ($action) {
		case 'show':
			$controller->show();
			break;



		default:
			break;
	}

	class ContentsController {
		//プロパティ
		private $action = '';
		private $resource = '';
		private $viewOptions = '';

		public function show() {
			// モデルを呼び出す
			$content = new Content();
			// $this->viewOptions = $content->show();

			// アクション名を設定する
			$this->resource = 'contents';
			$this->action = 'show';

			// ビューを呼び出す
			include('views/layout/application.php');
		}



	}

 ?>