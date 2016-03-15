<?php 
	// session_start();
	require('models/content.php');

	//ログインチェックを実装
	// require('function.php');
	// require('dbconnect.php');
	// if (isset($post['email']) && !empty($post['email'])) {
	// 	login($post,$db);
	// } elseif (isset($_SESSION['user_id'])&&!empty($_SESSION['user_id'])) {
	// 	login2($_SESSION,$db);
	// } else {
	// 	header('Location: /NexSeedPortal/users/login/');
	// }

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
			$controller->editConfirm($id, $post, $fileName, $files, $sessionEdit);
			break;

		case 'update':
			$controller->update($id, $sessionEdit);
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
		private $files = '';
		private $post = array();


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
			$this->resource = 'contents';
			$this->action = 'edit';

			include('views/layout/application.php');
		}

		public function editConfirm($id, $post, $fileName, $files, $sessionEdit) {
			if (!empty($fileName)) {
		    	$ext = substr($fileName, -3);
		    	if ($ext != 'jpg' && $ext != 'gif' && $ext != 'png' && $ext != 'JPG' && $ext != 'GIF' && $ext != 'PNG'){
		      		$_SESSION['error'] = 'error_prefix';
		      		header('Location: /NexSeedPortal/contents/edit/'. $id);
		    	} else {
		    		$_SESSION['error'] = 'select_again';
		    	}
		  	} else {
		  		$_SESSION['error'] = 'no_error';
		  	}
			$content = new Content();
			$this->categories = $content->selectCategories();
			$this->post = $post;
			$this->files = $files;
			//ここに書く！！画像アップロード！！
			//エラーが出たら、エラーの値をreturn値で表示し、それをedit.phpに表示する
			// if (isset($fileName)) {
			// 	$picture_path = date('YmdHis') . $fileName;
			// 	move_uploaded_file($_FILES['picture_path']['tmp_name'], 'webroot/asset/images/post_images/'. $picture_path);
			// 	$files = $picture_path;
			// 	$this->files = $files;
			// }

			$this->resource = 'contents';
			$this->action = 'editConfirm';

			include('views/layout/application.php');
		}

		public function update($id, $sessionEdit) {
			var_dump($sessionEdit);
			$content = new Content();
			$content->update($id, $sessionEdit);

			header('Location: /NexSeedPortal/contents/show/'.$id);
		}


		public function delete($id) {
			$content = new content();
			$content->delete($id);

			header('Location: /NexSeedPortal/contents/index');
		}

		


	}

 ?>