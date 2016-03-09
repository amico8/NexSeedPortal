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
				$controller->addConfirm();
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

	public function add(){
		$content = new Content();
		$this->categories = $content->selectCategories();
		$this->action='add';
		$this->resource='contents';
		include('views/layout/application.php');


	}
    public function addConfirm() {
        // $content = new Content();
        $this->resource = 'contents';
        $this->action = 'add_confirm';
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