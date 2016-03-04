<?php
	class User {
		private $dbconnect = '';
		public function __construct() {
			require('dbconnect.php');
			// DB接続の値を代入
			$this->dbconnect = $db;
		}

		public function add() {
			// $sql = 'SELECT * FROM `users` WHERE `delete_flag`=0 ORDER BY `created` DESC';
			// $results = mysqli_query($this->dbconnect, $sql) or die(mysqli_error());

			// $rtn = array();
			// while($result = mysqli_fetch_assoc($results)) {
			// 	$rtn[] = $result;
			// }
			//取得結果を返す
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

		public function confirm() {
			// $sql = sprintf('SELECT * FROM `users` WHERE `delete_flag`=0 AND `id`=%d', $id);
			// $results = mysqli_query($this->dbconnect, $sql) or die(mysqli_error());

			// $rtn = mysqli_fetch_assoc($results);
			// //取得結果を返す
			return $rtn;
		}

	}
 ?>