<?php 

	class Content {

		//プロパティに設定
		private $dbconnect = '';

		//NEWされる時最初にいるやつ →コンストラクタ
		public function __construct(){
			// DB接続ファイルの読み込み
			require('dbconnect.php');
			// DB接続設定の値を代入
			$this->dbconnect = $db;
		}

		public function show($id) {
			$sql = sprintf('SELECT c.category_name, u.user_name, co.* FROM `categories` c, `users` u, `contents` co WHERE `delete_flag` = 0 AND c.category_id=co.category_id AND u.user_id = co.user_id AND co.content_id=%d',
			mysqli_real_escape_string($this->dbconnect, $id)
			);
			$results = mysqli_query($this->dbconnect, $sql) or die(mysqli_error($this->dbconnect));
			$result = mysqli_fetch_assoc($results);
			//取得結果を返す
			return $result;
		}

		public function delete($id) {
			$sql = 'UPDATE `contents` SET `delete_flag`=1 WHERE `content_id`='.$id;
			mysqli_query($this->dbconnect, $sql) or die(mysqli_error($this->dbconnect));
		}

		public function update($id, $sessionEdit) {
			var_dump($sessionEdit);
			$sql = sprintf('UPDATE `contents` SET `category_id`= %d, `shop_name`="%s",`lat`=%d,`lng`=%d,`picture_path`="%s",`review`=%d,`comment`="%s" WHERE `content_id` = %d',
			mysqli_real_escape_string($this->dbconnect, $sessionEdit['category_id']),
			mysqli_real_escape_string($this->dbconnect, $sessionEdit['shop_name']),
			mysqli_real_escape_string($this->dbconnect, $sessionEdit['lat']),
			mysqli_real_escape_string($this->dbconnect, $sessionEdit['lng']),
			mysqli_real_escape_string($this->dbconnect, $sessionEdit['picture_path']),
			mysqli_real_escape_string($this->dbconnect, $sessionEdit['review']),
			mysqli_real_escape_string($this->dbconnect, $sessionEdit['comment']),
			mysqli_real_escape_string($this->dbconnect, $id)
			);
			echo $sql;
			// $result = mysqli_query($this->dbconnect, $sql) or die(mysqli_error($this->dbconnect));
			unset($sessionEdit);
			unset($_SESSION['error']);
		}


		public function selectContents($id) {
			$sql = sprintf('SELECT c.category_name, co.* FROM `categories` c, `contents` co WHERE `delete_flag` = 0 AND c.category_id=co.category_id AND co.content_id=%d',
			mysqli_real_escape_string($this->dbconnect, $id)
			);
			$results = mysqli_query($this->dbconnect, $sql) or die(mysqli_error($this->dbconnect));
			$result = mysqli_fetch_assoc($results);
			//取得結果を返す
			return $result;

		}

		public function selectCategories() {
			$sql = 'SELECT * FROM `categories` WHERE 1';
			$results = mysqli_query($this->dbconnect, $sql) or die(mysqli_error($this->dbconnect));
			$categories = array();
			while(1){
				$result = mysqli_fetch_assoc($results);
					if ($result == false) {
						break;
					}
					$categories[] = $result;
			}
			//取得結果を返す
			return $categories;
		}

	}


?>
