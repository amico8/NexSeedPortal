<?php 
	require('models/content.php');

	//コントローラのクラスをインスタンス化
	$controller = new ContentsController();

	//アクション名によって、呼び出すメソッドを変える
	//$action (グローバル変数)は、routes.phpで定義されているもの

	switch ($action) {
		case 'index';
		    $controller -> index($id,$post);
		    break;

		case 'add':
		// $controller->add();
		// $controller->add($sessionAdd);
		$controller->add();

			break;

		case 'confirm':
			if($id == 0) {
				// $sessionAdd = $_SESSION['add'];
				// var_dump($_SESSION['add']);
				// $_SESSION['add'] = $post;
				$controller->addConfirm($sessionAdd, $files, $fileName);
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
       		header('Location: /NexSeedPortal/contents/index');
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

		// private $session = array();
		// private $creater = '';
		// private $categories = '';
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

	// public function add($files,$fileName,$post){
  //   	public function add($sessionAdd){

		// $content = new Content();
		// 			// var_dump($_POST);
		// $this->categories = $content->selectCategories();
		// $this->action='add';
		// $this->resource='contents';
		// if (!empty($_POST)) {
		// 	$kakuninn = $_POST;

		// 	if ($kakuninn['Store_Name']=='') {
		// 		$erorr['Store_Name'] = 'blank';
			// }
			
		// $this->files = $files;
		// $this->post = $post;
			    // check.phpへ遷移
			    // header('Location: confirm');
			    // // これより以下のコードを処理しないようにexit()で抜ける
			    // exit();
			public function add(){
 			$content = new Content();
 			$this->categories = $content->selectCategories();
 			$this->action='add';
 			$this->resource='contents';

			  }

		include('views/layout/application.php');
		}

	public function addConfirm( $files, $fileName) {
        $content = new Content();
        $this->categories = $content->selectCategories();
        $this->resource = 'contents';
        $this->action = 'add_confirm';
        include('views/layout/application.php');

	}

    public function create($sessionAdd) {
		
		var_dump($sessionAdd);
	    $content = new Content();
	    
		$content->create($sessionAdd);
	   
	    include('views/layout/application.php');
	    // header('Location: /NexSeedPortal/contents/index');

	}

    public function editConfirm($id) {
	    // $content = new Content();
	    $this->resource = 'contents';
	    $this->action = 'edit_confirm';
	    include('views/layout/application.php');

	}
	
	}
 ?>