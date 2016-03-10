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

		// ↓ 修正中
		
		public function addConfirm($id,$post){
		
		// $sql = sprintf('INSERT INTO `contents`(`category_id`, `user_id`, `shop_name`, `lat`, `lng`, `picture_path`, `review`, `comment`, `delete_flag`, `created`) VALUES ("%d","%d","%s","%d","%d",null,"%d","%s",0,now())',
		// 	mysqli_real_escape_string($this->dbconnect, $post['category_id']),
		// 	mysqli_real_escape_string($this->dbconnect, $post['user_id`']),
		// 	mysqli_real_escape_string($this->dbconnect, $post['shop_name']),
		// 	mysqli_real_escape_string($this->dbconnect, $post['lat']),
		// 	mysqli_real_escape_string($this->dbconnect, $post['lng']),
		// 	mysqli_real_escape_string($this->dbconnect, $post['picture_path']),
		// 	mysqli_real_escape_string($this->dbconnect, $post['review']),
		// 	mysqli_real_escape_string($this->dbconnect, $post['comment']),
		// 	mysqli_real_escape_string($this->dbconnect, $post['delete_flag']),
		// 	mysqli_real_escape_string($this->dbconnect, $post['created']),
		// 	$id
		// );
			mysqli_query($this->dbconnect, $sql) or die(mysqli_error($this->dbconnect));
	    	header('Location: ');
		    // これ以下のコードを無駄に処理しないように終了する
		    exit();
		}

		public function selectCategories(){
			$sql = 'SELECT * FROM `categories` WHERE 1';
			$results =mysqli_query($this->dbconnect, $sql) or die(mysqli_error($this->dbconnect));
			$categories = array();
			while(1){
				$result = mysqli_fetch_assoc($results);
					if ($result == false){
						break;
					}
					$categories[] = $result;
			}
			return $categories;
		}
	}

?>


 <!--  $sql = sprintf('INSERT INTO members SET nick_name = "%s" , email = "%s" , password = "%s" , picture_path = "%s" ,created = now() ',   
  mysqli_real_escape_string($db, $_SESSION['join']['nick_name']),
  mysqli_real_escape_string($db, $_SESSION['join']['email']),
  mysqli_real_escape_string($db, sha1($_SESSION['join']['password'])),
  mysqli_real_escape_string($db, $_SESSION['join']['picture_path']) //⬅️最後なので,いらない
  );
 -->
