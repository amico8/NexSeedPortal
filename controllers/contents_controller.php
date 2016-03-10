<?php 
	require('models/content.php');

	//コントローラのクラスをインスタンス化
	$controller = new ContentsController();

	//アクション名によって、呼び出すメソッドを変える
	//$action (グローバル変数)は、routes.phpで定義されているもの

	switch ($action) {

		case 'add';
		$controller->add();
			break;

		case 'add_confirm':
			if($id == 0) {
				$controller->addConfirm($_SESSION['add']);
			} else {
				$controller->editConfirm($id);
			}
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
		// private $categories = '';

	public function add(){
		$content = new Content();
					var_dump($_POST);
		$this->categories = $content->selectCategories();
		$this->action='add';
		$this->resource='contents';
		if (!empty($_POST)) {
			$kakuninn = $_POST;

			if ($kakuninn['Store_Name']=='') {
				$erorr['Store_Name'] = 'blank';
			}
			var_dump($_FILES);
			
			$fileName = $_FILES['Photo']['name'];
			  if (!empty($fileName)) {
			    $ext = substr($fileName, -3);
			    if ($ext != 'jpg' && $ext != 'gif') {
			      $error['picture_path'] = 'type';
			    }
			  }
			  if (empty($error)) {
		    // エラーがなかったら処理する
			    $picture_path = date('YmdHis') . $fileName;
			    move_uploaded_file($_FILES['picture_path']['tmp_name'], '../member_picture/' . $picture_path);
			    $_SESSION['join'] = $_POST;
			    $_SESSION['join']['picture_path'] = $picture_path;
			    // check.phpへ遷移
			    header('Location: add_confirm');
			    // これより以下のコードを処理しないようにexit()で抜ける
			    exit();
			  }

		}
		include('views/layout/application.php');


	}
    public function addConfirm($id) {
    	// var_dump($session);
        $content = new Content();
        $this->categories = $content->selectCategories();
        $this->resource = 'contents';
        $this->action = 'add_confirm';
		// $this->session = $post;
		// echo $this->session['Category'];
        include('views/layout/application.php');

	}
    public function editConfirm($id) {
	    // $content = new Content();
	    $this->resource = 'contents';
	    $this->action = 'edit_confirm';
	    include('views/layout/application.php');

	}
	
	}
 ?>