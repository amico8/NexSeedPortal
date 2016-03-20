<?php
	require('models/user.php');
	require('function.php');
	$controller = new UsersController();
	//アクションによって呼び出すメソッドを変える
	//$actionはroutes.phpで定義されているもの
	switch ($action) {
		case 'login':
			$controller->login($post);
			break;
		case 'logout':
			$controller->logout();
			break;
		case 'add':
			$controller->add($post);
			break;
		case 'confirm':
			$controller->confirm($post);
			break;
		case 'create':
			$controller->create($post);
			break;
		default:
			break;
	}

	class UsersController {
		private $action = '';
		private $resource = '';
		private $viewOptions = '';
		private $name = '';
		private $email = '';
		private $password = '';
		private $error = '';

		public function __construct() {
			//ここでモデルを呼び出す
			$user = new User();
		}

		public function login($post) {
			$this->viewOptions = $this->user->login($post);
			$this->resource = 'users';
			$this->action = 'login';
			$this->error = $user->error;

			if($this->viewOptions == true) {
				header('Location: /NexSeedPortal/contents/index');
				exit();
			}
			if(isset($post) && !empty($post)) {
			    $this->email = h($post['email']);
			    $this->password = h($post['password']);
			}
			//ビューを呼び出す
			include('views/layout/application.php');
		}

		public function logout() {
			//セッション情報を削除
			$_SESSION = array();
			if (ini_get('session.use_cookies')) {
				$params = session_get_cookie_params();
				setcookie(session_name(), '', time() - 42000,
				$params['path'], $params['domain'],
				$params['secure'], $params['httponly']
				);
		 	}
			session_destroy();

			//Cookie情報も削除
			$_COOKIE = array();
			setcookie('email', '', time()-42000);
			setcookie('password', '', time()-42000);

			header('Location: /NexSeedPortal/users/login/');
			exit();
		}

		public function add($post) {
			$this->viewOptions = $this->user->add($post);
			$this->resource = 'users';
			$this->action = 'index';
			$this->error = $this->user->error;

			if($this->viewOptions == true) {
				header('Location: /NexSeedPortal/users/confirm/');
				exit();
			}

			if (isset($this->user->rewrite) && !empty($this->user->rewrite)) {
				$post = $this->user->rewrite;
			}

			if(isset($post) && !empty($post)) {
			    $this->name = h($post['name']);
			    $this->email = h($post['email']);
			    $this->password = h($post['password1']);
			}
			//ビューを呼び出す
			include('views/layout/application.php');
		}

		public function confirm($post) {
			$this->resource = 'users';
			$this->action = 'check';

			if(isset($post) && !empty($post)) {
				header('Location: /NexSeedPortal/users/create/');
				exit();
			}

			//ビューを呼び出す
			include('views/layout/application.php');
		}

		public function create($post) {
			$this->viewOptions = $this->user->create($post);
			$this->resource = 'users';
			$this->action = 'login';

			//登録したので、セッション情報を破棄
			unset($_SESSION['join']);
			header('Location: /NexSeedPortal/users/login/');
			exit();
		}
	}
 ?>