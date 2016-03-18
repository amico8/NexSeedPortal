<?php
	class Content{
		//プロパティに設定
		private $dbconnect = '';
		//NEWされる時最初にいるやつ →コンストラクタ
		public function __construct(){
			// DB接続ファイルの読み込み
			require('dbconnect.php');
			// DB接続設定の値を代入
			$this->dbconnect = $db;
		}

		public function index($id,$post){
			//DBからカテゴリを取得
			$sql = 'SELECT * FROM `categories` WHERE 1';
			$record = mysqli_query($this->dbconnect,$sql) or die(mysqli_error($this->dbconnect));
			$categories = array();
			while ($result = mysqli_fetch_assoc($record)) {
				$return['category'][] = $result;
			}
			//ページング
			$page = '';
			if(isset($id)){
				$page = $id;
			}
			if($page == ''){
				$page = 1;
			}
			$page = max($page,1);
			$return['page'][] = $page;

			if(isset($post['category'])&&!empty($post['category'])){
				if (isset($post['search'])&&!empty($post['search'])) {
					//カテゴリ検索とあいまい検索の両方を行うときのSQL文
					$sq = sprintf('SELECT COUNT(*) AS cnt FROM `contents` WHERE (`category_id`=%s OR `shop_name` LIKE "%%%s%%" OR `comment` LIKE "%%%s%%") AND `delete_flag`=0',
						  mysqli_real_escape_string($this->dbconnect,$post['category']),
						  mysqli_real_escape_string($this->dbconnect,$post['search']),
						  mysqli_real_escape_string($this->dbconnect,$post['search']));
				}else{
					//カテゴリ検索のみを行うときのSQL文
					$sq = sprintf('SELECT COUNT(*) AS cnt FROM `contents` WHERE `delete_flag`=0 AND `category_id`=%s',
						  mysqli_real_escape_string($this->dbconnect,$post['category']));
				}
			}elseif(isset($post['search'])&&!empty($post['search'])){
				//あいまい検索したときの件数取得のSQL文
					$sq = sprintf('SELECT COUNT(*) AS cnt FROM `contents` WHERE (`shop_name` LIKE "%%%s%%" OR `comment` LIKE "%%%s%%") AND `delete_flag`=0',
						  mysqli_real_escape_string($this->dbconnect,$post['search']),
						  mysqli_real_escape_string($this->dbconnect,$post['search']));
			}else{
				//検索しないときの件数取得(デフォルト)のSQL文
				$sq = 'SELECT COUNT(*) AS cnt FROM `contents` WHERE `delete_flag`=0';
			}
			$records = mysqli_query($this->dbconnect,$sq) or die(mysqli_error($this->dbconnect));
			$maxp = mysqli_fetch_assoc($records);
			$maxpage = ceil($maxp['cnt'] /5);
			$page = min($page,$maxpage);
			$return['maxpage'][] = $maxpage;
			$start = ($page-1)*5;
			$start = max(0,$start);

			if(isset($post['category'])&&!empty($post['category'])){
				if (isset($post['search'])&&!empty($post['search'])) {
					//カテゴリ検索とあいまい検索の両方を行うときの投稿取得SQL文
					$sqls = sprintf('SELECT `content_id`,`shop_name`, `review`, `comment`,`delete_flag` FROM `contents` WHERE 
									 (`category_id`=%s OR `shop_name` LIKE "%%%s%%" OR `comment` LIKE "%%%s%%") AND `delete_flag`=0 ORDER BY created DESC LIMIT %d,5',
							mysqli_real_escape_string($this->dbconnect,$post['category']),
							mysqli_real_escape_string($this->dbconnect,$post['search']),
							mysqli_real_escape_string($this->dbconnect,$post['search']),$start);
				}else{
					//カテゴリのみ検索するときの投稿取得SQL文
					$sqls = sprintf('SELECT `content_id`,`shop_name`, `review`, `comment`,`delete_flag` FROM `contents`
										   WHERE `delete_flag`=0 AND `category_id`=%s ORDER BY created DESC LIMIT %d,5',
							mysqli_real_escape_string($this->dbconnect,$post['category']),$start);
				}
			}elseif(isset($post['search'])&&!empty($post['search'])){
				//あいまい検索のみするときの投稿取得SQL文
				$sqls = sprintf('SELECT `content_id`,`shop_name`, `review`, `comment`,`delete_flag` FROM `contents`
										   WHERE (`shop_name` LIKE "%%%s%%" OR `comment` LIKE "%%%s%%") AND `delete_flag` = 0 ORDER BY created DESC LIMIT %d,5',
						mysqli_real_escape_string($this->dbconnect,$post['search']),
						mysqli_real_escape_string($this->dbconnect,$post['search']),$start);
			}else{
				//何も検索するときの投稿取得SQL文
				$sqls = sprintf('SELECT `content_id`,`shop_name`, `review`, `comment`,`delete_flag` FROM `contents`
										   WHERE `delete_flag`=0 ORDER BY created DESC LIMIT %d,5',$start);
			}
			$recordset = mysqli_query($this->dbconnect,$sqls) or die(mysqli_error($this->dbconnect));
			while ($recordsets = mysqli_fetch_assoc($recordset)) {
				$return['contents'][] = $recordsets;
			}
			if(isset($return['contents'])&&!empty($return['contents'])){
				$numbers = count($return['contents']);
				for ($i=0; $i < $numbers ; $i++) {
					$number = $return['contents'][$i]['review'];
					$return['contents'][$i]['review'] = "";
					for ($j=0; $j < $number ; $j++) {
						$return['contents'][$i]['review'] = $return['contents'][$i]['review']."★";
					}
				}
			}

			//状況確認ように$returnに$postを入れておく
			$return['post'] = $post;
			$return['session'] = $_SESSION;
			return $return;
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

		public function create() {
					$sql = sprintf('INSERT INTO `contents`(`category_id`, `user_id`, `shop_name`, `lat`, `lng`, `picture_path`, `review`, `comment`, `delete_flag`, `created`) VALUES (%s,%d,"%s",%.20f,%.20f,"%s",%s,"%s",0,now())',
					mysqli_real_escape_string($this->dbconnect, $_SESSION['add']['category_id']),
					mysqli_real_escape_string($this->dbconnect, $_SESSION['add']['user_id']),
					mysqli_real_escape_string($this->dbconnect, $_SESSION['add']['shop_name']),
					mysqli_real_escape_string($this->dbconnect, $_SESSION['add']['lat']),
					mysqli_real_escape_string($this->dbconnect, $_SESSION['add']['lng']),
					mysqli_real_escape_string($this->dbconnect, $_SESSION['add']['picture_path']),
					mysqli_real_escape_string($this->dbconnect, $_SESSION['add']['review']),
					mysqli_real_escape_string($this->dbconnect, $_SESSION['add']['comment'])
					);
					echo $sql;
					mysqli_query($this->dbconnect, $sql) or die(mysqli_error($this->dbconnect));
					// return値はいらない
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

		public function edit($id) {
			$content = new Content();
			$this->viewOptions = $content->selectContents($id);
			$this->categories = $content->selectCategories();
			$this->resource = 'contents';
			$this->action = 'edit';

			include('views/layout/application.php');
		}

		public function editConfirm($id, $fileName, $files) {
			if (isset($_FILES['picture_path']['name']) && !empty($_FILES['picture_path']['name'])) {
				$fileName = $_FILES['picture_path']['name'];
				$files = $_FILES['picture_path'];
				if (!empty($fileName)) {
					$ext = substr($fileName, -3);
					if ($ext != 'jpg' && $ext != 'gif' && $ext != 'png' && $ext != 'JPG' && $ext != 'GIF' && $ext != 'PNG'){
						$_SESSION['error'] = 'error_prefix';
						header('Location: /NexSeedPortal/contents/edit/'. $id);
					} else {
						$_SESSION['error'] = 'select_again';
						$picture_path = date('YmdHis') . $fileName;
						move_uploaded_file($_FILES['picture_path']['tmp_name'], 'webroot/asset/images/post_images/'. $picture_path);
						$files = $picture_path;
					}
				} else {
					$_SESSION['error'] = 'no_error';
				}
				$_SESSION['edit'] += array('picture_path'=>$files);
			}
			$content = new Content();
			$this->categories = $content->selectCategories();
			$this->files = $files;
			$this->resource = 'contents';
			$this->action = 'edit_confirm';

			include('views/layout/application.php');
		}

		public function update($id) {
			// 画像を上書きで消さないように、if文で分岐している
			if (isset($_SESSION['edit']['picture_path']) && !empty($_SESSION['edit']['picture_path'])) {
				$sql = sprintf('UPDATE `contents` SET `category_id`= %d, `shop_name`="%s",`lat`=%.20f,`lng`=%.20f,`picture_path`="%s",`review`=%d,`comment`="%s" WHERE `content_id` = %d',
					mysqli_real_escape_string($this->dbconnect, $_SESSION['edit']['category_id']),
					mysqli_real_escape_string($this->dbconnect, $_SESSION['edit']['shop_name']),
					mysqli_real_escape_string($this->dbconnect, $_SESSION['edit']['lat']),
					mysqli_real_escape_string($this->dbconnect, $_SESSION['edit']['lng']),
					mysqli_real_escape_string($this->dbconnect, $_SESSION['edit']['picture_path']),
					mysqli_real_escape_string($this->dbconnect, $_SESSION['edit']['review']),
					mysqli_real_escape_string($this->dbconnect, $_SESSION['edit']['comment']),
					mysqli_real_escape_string($this->dbconnect, $id)
					);
			} else {
				$sql = sprintf('UPDATE `contents` SET `category_id`= %d, `shop_name`="%s",`lat`=%.20f,`lng`=%.20f,`review`=%d,`comment`="%s" WHERE `content_id` = %d',
					mysqli_real_escape_string($this->dbconnect, $_SESSION['edit']['category_id']),
					mysqli_real_escape_string($this->dbconnect, $_SESSION['edit']['shop_name']),
					mysqli_real_escape_string($this->dbconnect, $_SESSION['edit']['lat']),
					mysqli_real_escape_string($this->dbconnect, $_SESSION['edit']['lng']),
					mysqli_real_escape_string($this->dbconnect, $_SESSION['edit']['review']),
					mysqli_real_escape_string($this->dbconnect, $_SESSION['edit']['comment']),
					mysqli_real_escape_string($this->dbconnect, $id)
					);
			}
			$result = mysqli_query($this->dbconnect, $sql) or die(mysqli_error($this->dbconnect));
		}

		public function delete($id) {
			$sql = 'UPDATE `contents` SET `delete_flag`=1 WHERE `content_id`='.$id;
			mysqli_query($this->dbconnect, $sql) or die(mysqli_error($this->dbconnect));
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
	}
?>