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
			$controller->edit($id, $sessionEdit);
			break;

		case 'delete':
			$controller->delete($id);
			break;

		case 'confirm':
			$controller->editConfirm($id, $post, $fileName, $files);
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
		private $files = array();
		private $post = array();
		private $session = array();


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

		public function edit($id, $sessionEdit) {
			$content = new Content();
			$this->viewOptions = $content->selectContents($id);
			$this->categories = $content->selectCategories();
			$this->session = $sessionEdit;
			$this->resource = 'contents';
			$this->action = 'edit';
			// $this->error = $content->error;
			// $this->post = $content->edit($id);
			// if (isset($content->rewrite) && !empty($content->rewrite)) {
			// 	$this->post = $content->rewrite;
			// }
			

			// $this->session = $_SESSION['edit'];
			// if (isset($this->get['action']) && $this->get['action'] == 'rewrite') {
			//   $this->get = $this->session;
			//   $error['rewrite'] = true;
			// }

			include('views/layout/application.php');
		}

		public function editConfirm($id, $post, $fileName, $files) {
			 $content = new Content();
			// var_dump($files);
			$this->categories = $content->selectCategories();
			$this->post = $post;
			//ここに書く！！画像アップロード！！
			//エラーが出たら、エラーの値をreturn値で表示し、それをedit.phpに表示する
			//エラーの表示は番号で分ける
			if (isset($fileName)) {
				//エラーが無かったら処理する
				$picture_path = date('YmdHis') . $fileName;
				move_uploaded_file($_FILES['picture_path']['tmp_name'], 'webroot/asset/images/post_images/'. $picture_path);
				$files = $picture_path;
				$this->files = $files;
			}

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