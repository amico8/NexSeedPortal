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

		public function login($post) {
			//ここでモデルを呼び出す
			$user = new User();
			$this->viewOptions = $user->login($post);
			$this->resource = 'users';
			$this->action = 'login';
			$this->error = $user->error;
			if(isset($post) && !empty($post)) {
			    $this->email = h($post['email']);
			    $this->password = h($post['password']);
			}
			//ビューを呼び出す
			include('views/layout/application.php');
		}

		public function logout() {
			//ここでモデルを呼び出す
			$user = new User();
			$this->viewOptions = $user->logout();
			$this->resource = 'users';
			$this->action = 'login';
			//ビューを呼び出す
			include('views/layout/application.php');
		}

		public function add($post) {
			//ここでモデルを呼び出す
			$user = new User();
			$this->viewOptions = $user->add($post);
			$this->resource = 'users';
			$this->action = 'index';
			$this->error = $user->error;
			if (isset($user->rewrite) && !empty($user->rewrite)) {
				$post = $user->rewrite;
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
			//ここでモデルを呼び出す
			$user = new User();
			$this->viewOptions = $user->confirm($post);
			$this->resource = 'users';
			$this->action = 'check';
			//ビューを呼び出す
			include('views/layout/application.php');
		}

		public function create($post) {
			//ここでモデルを呼び出す
			$user = new User();
			$this->viewOptions = $user->create($post);
			$this->resource = 'users';
			$this->action = 'login';
			//ビューを呼び出す
			include('views/layout/application.php');
		}
	}
 ?>