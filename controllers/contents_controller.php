<?php
	require('models/content.php');

	//ログインチェックを実装
	require('function.php');
	require('dbconnect.php');
	if (isset($post['email'])&&!empty($post['email'])) {
		login($post,$db);
	} elseif (isset($_SESSION['user_id'])&&!empty($_SESSION['user_id'])) {
		loginCheck($_SESSION,$db);
	}else{
		header('Location: /NexSeedPortal/users/login/');
	}
	//コントローラのクラスをインスタンス化
	$controller = new ContentsController();

	//アクション名によって、呼び出すメソッドを変える
	//$action (グローバル変数)は、routes.phpで定義されているもの
	switch ($action) {
		case 'index':
			$controller->index($id,$post);
			break;
		default:
			break;
	}

	class ContentsController{
		//プロパティ
		private $action = '';
		private $resource = '';
		private $viewOptions = '';
		private $content = '';

		public function __construct(){
			//モデルを呼び出す
			$this->content = new Content();
		}

		public function index($id,$post){
			//indexメソッドを呼び出す
			$this->viewOptions = $this->content->index($id,$post);
			//アクション名を設定
			$this->resource = 'contents';
			$this->action = 'index';
			//ビューを呼び出す
			require('views/layout/application.php');
		}

	}

 ?>