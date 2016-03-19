<?php 
	// session_start();
	require('models/content.php');

	//ログインチェックを実装
	// require('function.php');
	// require('dbconnect.php');

	//コントローラのクラスをインスタンス化
	$controller = new ContentsController();

	//アクション名によって、呼び出すメソッドを変える
	//$action (グローバル変数)は、routes.phpで定義されているもの

	switch ($action) {
		case 'show':
			$controller->show($id);
			unset($_SESSION['edit']);
			unset($_SESSION['error']);
			break;

		case 'edit':
			$controller->edit($id);
			break;

		case 'delete':
			$controller->delete($id);
			break;

		case 'confirm':
			$_SESSION['edit'] = $post;
			$controller->editConfirm($id, $fileName, $files);
			break;

		case 'update':
			$controller->update($id);
			unset($_SESSION['edit']);
			unset($_SESSION['error']);
			break;

		default:
			break;
	}

	class ContentsController {
		private $content = '';
		private $action = '';
		private $resource = '';
		private $viewOptions = '';
		private $categories = '';
		private $post = array();


		public function __construct() {
			$this->content = new Content();
		}

		public function show($id) {
			$this->viewOptions = $this->content->show($id);
			$this->resource = 'contents';
			$this->action = 'show';

			include('views/layout/application.php');
		}

		public function edit($id) {
			$this->viewOptions = $this->content->selectContents($id);
			$this->categories = $this->content->selectCategories();
			$this->resource = 'contents';
			$this->action = 'edit';

			include('views/layout/application.php');
		}

		public function editConfirm($id, $fileName, $files) {
			if (isset($_FILES['picture_path']['name']) && !empty($_FILES['picture_path']['name'])) {
				$fileName = $_FILES['picture_path']['name'];
				$files = $_FILES['picture_path'];
				if (!empty($fileName)) {
					$ext = substr($fileName, -3);
					if ($ext != 'jpg' && $ext != 'gif' && $ext != 'png' && $ext != 'JPG' && $ext != 'GIF' && $ext != 'PNG'){
						$_SESSION['error'] = 'error_prefix';
						header('Location: /NexSeedPortal/contents/edit/'. $id);
					} else {
						$_SESSION['error'] = 'select_again';
						$picture_path = date('YmdHis') . $fileName;
						move_uploaded_file($_FILES['picture_path']['tmp_name'], 'webroot/asset/images/post_images/'. $picture_path);
						$files = $picture_path;
					}
				} else {
					$_SESSION['error'] = 'no_error';
				}
				$_SESSION['edit'] += array('picture_path'=>$files);
			}
			$this->categories = $this->content->selectCategories();
			$this->files = $files;
			$this->resource = 'contents';
			$this->action = 'edit_confirm';

			include('views/layout/application.php');
		}

		public function update($id) {
			$this->content->update($id);

			header('Location: /NexSeedPortal/contents/show/'.$id);
		}


		public function delete($id) {
			$this->content->delete($id);

			header('Location: /NexSeedPortal/contents/index');
		}

	}

 ?>