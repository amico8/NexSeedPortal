<?php
	require('models/content.php');
	// unset($_SESSION['add']);
	// unset($_SESSION['error']);

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
				$controller->addConfirm($files, $fileName);
			} else {
				$controller->editConfirm($id);
			}
            break;
        // メソッドを呼び出す時のみスーパーグローバル変数を使う。
        case 'create':
        	// var_dump($_SESSION['add']);
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

		public function index($id,$post){
    		//モデルを呼び出す
        	$content = new Content();
            $this->viewOptions = $content->index($id,$post);
        	//アクション名を設定
            $this->resource = 'contents';
            $this->action = 'index';
        	//ビューを呼び出す
            require('views/layout/application.php');
    	}

		public function add(){
 			$content = new Content();
 			$this->categories = $content->selectCategories();
 			$this->action='add';
 			$this->resource='contents';
			include('views/layout/application.php');
		}

		public function addConfirm($files, $fileName) {
			if (!empty($fileName)) {
				$ext = substr($fileName, -3);
				if ($ext != 'jpg' && $ext != 'gif' && $ext != 'png' && $ext != 'JPG' && $ext != 'GIF' && $ext != 'PNG'){
					$_SESSION['error'] = 'error_prefix';
					header('Location: /NexSeedPortal/contents/confirm/'. $id);
				} else {
					$_SESSION['error'] = 'select_again';
				}
			} else {
				$_SESSION['error'] = 'no_error';
			}
			$content = new Content();
			$this->categories = $content->selectCategories();
			$this->resource = 'contents';
			$this->action = 'add_confirm';
			include('views/layout/application.php');
		}

	    public function create($sessionAdd) {

			// var_dump($sessionAdd);
		    $content = new Content();
			$content->create($sessionAdd);
		    include('views/layout/application.php');

		}

	    public function editConfirm($id) {
		    $this->resource = 'contents';
		    $this->action = 'edit_confirm';
		    include('views/layout/application.php');

		}

	}
 ?>