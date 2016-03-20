<?php
	require('models/content.php');

	//コントローラのクラスをインスタンス化
	$controller = new ContentsController();

	switch ($action) {
		case 'index';
			$controller -> index($id,$post);
			break;

		case 'add':
			$controller->add();
			break;

		case 'confirm':
			if($id == 0) {
				unset($_SESSION['error']);
				$_SESSION['add'] = $post;
				$controller->addConfirm($_SESSION['add']);
			} else {
				$controller->editConfirm($id);
			}
			break;
		// メソッドを呼び出す時のみスーパーグローバル変数を使う。
		case 'create':
			$controller->create();
			unset($_SESSION['add']);
			unset($_SESSION['error']);
	   		header('Location:/NexSeedPortal/contents/index');
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

		public function __construct() {
			$this->content = new Content();
		}

		public function index($id,$post){
			$this->viewOptions = $this->content->index($id,$post);
			$this->resource = 'contents';
			$this->action = 'index';

			require('views/layout/application.php');
		}

		public function add(){
 			$this->categories = $this->content->selectCategories();
 			$this->action='add';
 			$this->resource='contents';

			include('views/layout/application.php');
		}

		public function addConfirm($session) {
			if (isset($_FILES['picture_path']['name']) && !empty($_FILES['picture_path']['name'])) {
				$fileName = $_FILES['picture_path']['name'];
				$files = $_FILES['picture_path'];
				if (!empty($fileName)) {
					$ext = substr($fileName, -3);
					if ($ext != 'jpg' && $ext != 'gif' && $ext != 'png' && $ext != 'JPG' && $ext != 'GIF' && $ext != 'PNG'){
						$_SESSION['error'] = 'error_prefix';
						header('Location: /NexSeedPortal/contents/add/');
					} else {
						$_SESSION['error'] = 'select_again';
						$picture_path = date('YmdHis') . $fileName;
						move_uploaded_file($_FILES['picture_path']['tmp_name'], 'webroot/asset/images/post_images/'. $picture_path);
						$files = $picture_path;
					}
					$this->files = $files;
				} else {
					$_SESSION['error'] = 'no_error';
				}
			}
			// カテゴリが未選択の場合はエラー
			if (empty($session['category_id'])) {
				$_SESSION['error'] = 'category';
				header('Location: /NexSeedPortal/contents/add/');
			}
			$_SESSION['add'] += array('picture_path'=>$this->files);
			$this->categories = $this->content->selectCategories();
			$this->resource = 'contents';
			$this->action = 'add_confirm';

			include('views/layout/application.php');
		}
		public function create() {
			$this->content->create();
		}
	}
 ?>