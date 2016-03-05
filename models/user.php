<?php
	class User {
		private $dbconnect = '';
		public function __construct() {
			require('dbconnect.php');
			// DB接続の値を代入
			$this->dbconnect = $db;
		}

		public function add($post) {
			$sql = sprintf('SELECT COUNT(*) AS cnt FROM `users` WHERE `email`=%s', 
			mysqli_real_escape_string($this->dbconnect, $post));
			$record = mysqli_query($this->dbconnect, $sql);
		    $table = mysqli_fetch_assoc($record);

		    if ($table['cnt'] > 0) {
		    	$error['email'] = 'duplicate';
		    } else {
		    	header('Location: /NexSeedPortal/users/confirm/');
		    }
		    exit();
		}

		public function confirm() {
			header('Location: /NexSeedPortal/users/create/');
			return $rtn;
		}

		public function create() {
		      // $sql = sprintf('INSERT INTO `users`(`title`, `body`, `delete_flag`, `created`) VALUES ("%s","%s",0,now())',
		      // mysqli_real_escape_string($this->dbconnect, $post['title']),
		      // mysqli_real_escape_string($this->dbconnect, $post['body']));
		      // var_dump($sql);

		      // mysqli_query($this->dbconnect, $sql) or die(mysqli_error());
		      // header('Location: /NexSeedPortal/users/index/');
		      exit();
		}

	}
 ?>