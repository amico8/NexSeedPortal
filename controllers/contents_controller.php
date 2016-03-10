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

		case 'editConfirm':
			$controller->editConfirm($id, $post);
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
		private $session = array();
		private $fileName = '';
		private $get = array();


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
			

			// $this->session = $_SESSION['edit'];
			// if (isset($this->get['action']) && $this->get['action'] == 'rewrite') {
			//   $this->get = $this->session;
			//   $error['rewrite'] = true;
			// }

			include('views/layout/application.php');
		}

		public function editConfirm($id, $post) {
			$content = new Content();
			$this->categories = $content->selectCategories();
			$this->session = $post;
			//ここに書く！！画像アップロード！！
			//エラーが出たら、エラーの値をreturn値で表示し、それをedit.phpに表示する
			//エラーの表示は番号で分ける
			// if (!empty($post)) {
			// 	$fileName = $files['picture_path']['name'];
			// 	//エラーが無かったら処理する
			// 	$picture_path = date('YmdHis') . $fileName;
			// 	move_uploaded_file($files['picture_path']['tmp_name'], '../webroot/asset/images/post_images'. $picture_path)
			// 	$_SESSION['edit']['picture_path'] = $picture_path;
			// 	$this->session = $_SESSION['edit']['picture_path'];
			// }

			$this->resource = 'contents';
			$this->action = 'editConfirm';

			include('views/layout/application.php');
		}

		public function delete($id) {
			$content = new content();
			$content->delete($id);

			header('Location: /NexSeedPortal/contents/index');
		}



	}

 ?>