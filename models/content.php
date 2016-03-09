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
