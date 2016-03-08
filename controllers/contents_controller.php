<?php 
	require('models/content.php');

	//コントローラのクラスをインスタンス化
	$controller = new ContentsController();

	//アクション名によって、呼び出すメソッドを変える
	//$action (グローバル変数)は、routes.phpで定義されているもの

	switch ($action) {
		case 'show':
			$controller->show($id);
			break;

		case 'edit':
			$controller->edit($id);
			break;

		case 'delete':
			$controller->delete($id);
			break;

		case 'edit_confirm':
			$controller->edit_confirm($id);
			break;

		default:
			break;
	}

	class ContentsController {
		//プロパティ
		private $action = '';
		private $resource = '';
		private $viewOptions = '';
		private $categories = '';

		public function show($id) {
			// モデルを呼び出す
			$content = new Content();
			$this->viewOptions = $content->show($id);

			// アクション名を設定する
			$this->resource = 'contents';
			$this->action = 'show';

			// ビューを呼び出す
			include('views/layout/application.php');
		}

		public function edit($id) {
			$content = new Content();
			$this->viewOptions = $content->selectContents($id);
			$this->categories = $content->selectCategories();
			$this->resource = 'contents';
			$this->action = 'edit';

			include('views/layout/application.php');
		}

		public function edit_confirm($id) {
			$content = new Content();
			$this->categories = $content->selectCategories();
			$this->resource = 'contents';
			$this->action = 'edit_confirm';

			include('views/layout/application.php');
		}

		public function delete($id) {
			$content = new content();
			$content->delete($id);

			header('Location: /NexSeedPortal/contents/index');
		}



	}

 ?>