<?php

	require('models/user.php');

	$controller = new UsersController();
	//アクションによって呼び出すメソッドを変える
	//$actionはroutes.phpで定義されているもの
	switch ($action) {
		case 'add':
			$controller->add($post);
			break;
		case 'confirm':
			$controller->confirm();
			break;
		case 'create':
			$controller->create();
			break;
		default:
			break;
	}

	class UsersController {
		private $action = '';
		private $resource = '';
		private $viewOptions = '';

		public function add($post) {
			$this->action = 'add';

			//ビューを呼び出す
			include('views/layout/application.php');
		}

		public function confirm() {
			//ここでモデルを呼び出す
			$user = new User();
			$this->viewOptions = $user->confirm();

			$this->action = 'confirm';

			//ビューを呼び出す
			include('views/layout/application.php');
		}

		public function create() {
			//ここでモデルを呼び出す
			$user = new User();
			$this->viewOptions = $user->create();

			$this->action = 'create';

			//ビューを呼び出す
			include('views/layout/application.php');
		}

	}

 ?>