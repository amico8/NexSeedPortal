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
		$controller->add($sessionAdd);
			break;

		case 'confirm':
			if($id == 0) {
				// $sessionAdd = $_SESSION['add'];
				// var_dump($_SESSION['add']);
				$_SESSION['add'] = $post;
				$controller->addConfirm($_SESSION['add']);
			} else {
				$controller->editConfirm($id);
			}
            break;
        // メソッドを呼び出す時のみスーパーグローバル変数を使う。
        case 'create':
        	// var_dump($_SESSION['add']);
			$controller->create($_SESSION['add']);
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
		private $creater = '';
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

	public function add($sessionAdd){
		$content = new Content();
		$this->categories = $content->selectCategories();
		$this->action='add';
		$this->resource='contents';

		include('views/layout/application.php');
	}

    public function addConfirm($session) {
        $content = new Content();
        $this->categories = $content->selectCategories();
        $this->resource = 'contents';
        $this->action = 'add_confirm';
		// $this->session = $post;
		// echo $this->session['Category'];
        include('views/layout/application.php');

	}

    public function create($session) {
		// 上で入れた$_SESSIONは↑ここでは$sessionに
		// var_dump($session);
	    $content = new Content();
	    // echo "createきたよ";
		$this->creater = $content->create($session);
	    // $this->resource = 'contents';
	    // $this->action = 'add_confirm';
		// $this->session = $post;
		// echo $this->session['Category'];
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
