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
			$sessionEdit = array();
			if (isset($_SESSION['edit']) && !empty($_SESSION['edit'])) {
				// 「back」ボタン押下時は、セッションから値を取得して表示する
				$sessionEdit = $_SESSION['edit'];
			}
			$controller->edit($id, $sessionEdit);
			break;

		case 'delete':
			$controller->delete($id);
			break;

		case 'confirm':
			// セッションに$_FILESのデータを格納
			$_SESSION['edit'] = $post;
			$_SESSION['edit'] += array('picture_name'=>$_FILES['picture_path']['name']);
			$_SESSION['edit'] += array('picture_tmp'=>$_FILES['picture_path']['tmp_name']);
			$_SESSION['edit'] += array('picture_path'=>date('YmdHis').$_FILES['picture_path']['name']);
			$controller->editConfirm($id, $_SESSION['edit']);
			break;

		case 'update':
			$controller->update($id, $_SESSION['edit']);
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

		public function editConfirm($id, $sessionEdit) {
			// 画像をアップロードする場合
			if (!empty($sessionEdit['picture_name'])) {
				// 拡張子チェック
				$ext = substr($sessionEdit['picture_name'], -3);
				if ($ext != 'jpg' && $ext != 'gif' && $ext != 'png' && $ext != 'JPG' && $ext != 'GIF' && $ext != 'PNG'){
					$_SESSION['error'] = 'error_prefix';
					header('Location: /NexSeedPortal/contents/edit/'. $id);
				} else {
					// 問題なければアップロード
					move_uploaded_file(
						$sessionEdit['picture_tmp'],
						'webroot/asset/images/post_images/'. $sessionEdit['picture_path']);
					$this->files = $sessionEdit['picture_path'];
					$_SESSION['error'] = 'select_again';
				}
			} else {
				$_SESSION['error'] = 'no_error';
			}
			$content = new Content();
			$this->categories = $content->selectCategories();
			$this->resource = 'contents';
			$this->action = 'editConfirm';

			include('views/layout/application.php');
		}

		public function update($id, $sessionEdit) {
			// var_dump($sessionEdit);
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