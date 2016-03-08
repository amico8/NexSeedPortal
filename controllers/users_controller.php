<?php

	require('models/user.php');

	$controller = new UsersController();
	//アクションによって呼び出すメソッドを変える
	//$actionはroutes.phpで定義されているもの
	switch ($action) {
		case 'login':
			$controller->login($post);
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

		public function login($post) {
			//ここでモデルを呼び出す
			$user = new User();
			$this->viewOptions = $user->login($post);
			$this->action = 'login';

			//ビューを呼び出す
			include('views/layout/application.php');
		}

		public function add($post) {
			$this->action = 'add';

			//ビューを呼び出す
			include('views/layout/application.php');
		}

		public function confirm($post) {
			//ここでモデルを呼び出す
			$user = new User();
			$this->viewOptions = $user->confirm($post);
			$this->action = 'confirm';

			//ビューを呼び出す
			include('views/layout/application.php');
		}

		public function create($post) {
			//ここでモデルを呼び出す
			$user = new User();
			$this->viewOptions = $user->create($post);
			$this->action = 'create';

			//ビューを呼び出す
			include('views/layout/application.php');
		}

	}

 ?>