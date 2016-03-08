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

		case 'confirm':
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
		private $session = array();

	public function add(){

		$this->action='add';
		$this->resource='contents';
		include('views/layout/application.php');


	}
    public function addConfirm($post) {
    	// var_dump($session);
        // $content = new Content();
        $this->resource = 'contents';
        $this->action = 'add_confirm';
		$this->session = $post;
		echo $this->session['Category'];
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