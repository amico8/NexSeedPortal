<?php 
	require('models/content.php');

	//コントローラのクラスをインスタンス化
	$controller = new ContentsController();

	//アクション名によって、呼び出すメソッドを変える
	//$action (グローバル変数)は、routes.phpで定義されているもの

	switch ($action) {
		case 'edit':
			$controller->edit($id);
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

		public function edit($id) {
			$content = new Content();
			$this->viewOptions = $content->edit($id);
			$this->resource = 'contents';
			$this->action = 'edit';

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