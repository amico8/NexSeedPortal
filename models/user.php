<?php
	class User {
		private $dbconnect = '';
		public function __construct() {
			require('dbconnect.php');
			// DB接続の値を代入
			$this->dbconnect = $db;
		}

		public function login($post) {
			if (isset($_COOKIE['email']) && $_COOKIE['email'] != '') {
			    $post['email'] = $_COOKIE['email'];
			    $post['password'] = $_COOKIE['password'];
			    $post['save'] = 'on';
			}

			if (!empty($post)) {
		    	if ($post['email'] != '' && $post['password'] != '') {
			    	$sql = sprintf('SELECT * FROM users WHERE email="%s" AND password="%s"',
			        mysqli_real_escape_string($db, $post['email']),
			        mysqli_real_escape_string($db, sha1($post['password']))
		        	);
		      		$record = mysqli_query($db, $sql) or die(mysqli_error($db));
		      		if ($table = mysqli_fetch_assoc($record)) {
			        	//ログイン成功
			        	$_SESSION['user_id'] = $table['user_id'];
			        	$_SESSION['time'] = time();
			        	if ($post['save'] == 'on') {
				          	setcookie('email', $post['email'], time()+60*60*24*14);
				          	setcookie('password', $post['password'], time()+60*60*24*14);
			        	}
			        	header('Location: /NexSeedPortal/contents/check/');
			        	exit();
			      	} else {
			        	$error['login'] = 'failed';
			      	}
		    	} else {
		      		$error['login'] = 'blank';
		    	}
			}
		}

		public function confirm($post) {
			$error = array();
			$name = '';
			$email = '';
			$password = '';

			if(isset($post) && !empty($post)) {
			    $name = htmlspecialchars($post['name'], ENT_QUOTES, 'UTF-8');
			    $email = htmlspecialchars($post['email'], ENT_QUOTES, 'UTF-8');
			    $password = htmlspecialchars($post['password1'], ENT_QUOTES, 'UTF-8');
			    //$picture_path = htmlspecialchars($_POST['picture_path'], ENT_QUOTES, 'UTF-8');

			    if($post['name']=='') {
			    	$error['name'] = 'blank';
			    }
			    if($post['email']=='') {
			    	$error['email'] = 'blank';
			    }
			    if($post['password']=='') {
			     	$error['password'] = 'blank';
			    } elseif (strlen($post['password1']) < 4 || strlen($post['password1']) > 16) {
			    	$error['password'] = 'length';
			    } elseif ($post['password1'] != $post['password2']) {
			    	$error['password'] = 'incorrect';
			    }

			    if (empty($error)) {
			    	//重複アカウントのチェック
			    	$sql = sprintf('SELECT COUNT(*) AS cnt FROM users WHERE email="%s"',
			        	mysqli_real_escape_string($db, $post['email'])
			    	);
				    $record = mysqli_query($db, $sql);
				    $table = mysqli_fetch_assoc($record);
				    if ($table['cnt'] > 0) {
				        $error['email'] = 'duplicate';
				    } else {
				        $_SESSION['join'] = $post;
				        header('Location: /NexSeedPortal/users/check/');
				        exit();
				    }

			    }
			}

			if (isset($_REQUEST['action']) && $_REQUEST['action']=='rewrite') {
			    $post = $_SESSION['join'];
			    $name = htmlspecialchars($post['nname'], ENT_QUOTES, 'UTF-8');
			    $email = htmlspecialchars($post['email'], ENT_QUOTES, 'UTF-8');
			    $password = htmlspecialchars($post['password1'], ENT_QUOTES, 'UTF-8');
			    $error['rewrite'] = true;
			}
		}

		public function create($post) {
			if (!empty($post)) {
			    //登録処理
			    $sql = sprintf('INSERT INTO users SET name="%s", email="%s", password="%s", created=now()',
			    	mysqli_real_escape_string($db, $_SESSION['join']['name']),
			    	mysqli_real_escape_string($db, $_SESSION['join']['email']),
			    	mysqli_real_escape_string($db, sha1($_SESSION['join']['password'])),
			    );

			    mysqli_query($db, $sql) or die(mysqli_error($db));
			    //登録したので、セッション情報を破棄
			    unset($_SESSION['join']);
			    header('Location: /NexSeedPortal/users/login/');
			    exit();
			}
		}

	}
 ?>