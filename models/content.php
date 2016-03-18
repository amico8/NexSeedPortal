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
			while ($result = mysqli_fetch_assoc($record)) {
				$return['category'][] = $result;
			}

			//ページング
			$page = 1;
			if ($id != 0){
				$page = $id;
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
					$sqls = sprintf('SELECT `content_id`,`shop_name`, `review`, `comment` FROM `contents` WHERE 
									 (`category_id`=%s OR `shop_name` LIKE "%%%s%%" OR `comment` LIKE "%%%s%%") AND `delete_flag`=0 ORDER BY created DESC LIMIT %d,5',
							mysqli_real_escape_string($this->dbconnect,$post['category']),
							mysqli_real_escape_string($this->dbconnect,$post['search']),
							mysqli_real_escape_string($this->dbconnect,$post['search']),$start);
				}else{
					//カテゴリのみ検索するときの投稿取得SQL文
					$sqls = sprintf('SELECT `content_id`,`shop_name`, `review`, `comment` FROM `contents`
										   WHERE `delete_flag`=0 AND `category_id`=%s ORDER BY created DESC LIMIT %d,5',
							mysqli_real_escape_string($this->dbconnect,$post['category']),$start);
				}
			}elseif(isset($post['search'])&&!empty($post['search'])){
				//あいまい検索のみするときの投稿取得SQL文
				$sqls = sprintf('SELECT `content_id`,`shop_name`, `review`, `comment` FROM `contents`
										   WHERE (`shop_name` LIKE "%%%s%%" OR `comment` LIKE "%%%s%%") AND `delete_flag` = 0 ORDER BY created DESC LIMIT %d,5',
						mysqli_real_escape_string($this->dbconnect,$post['search']),
						mysqli_real_escape_string($this->dbconnect,$post['search']),$start);
			}else{
				//何も検索するときの投稿取得SQL文
				$sqls = sprintf('SELECT `content_id`,`shop_name`, `review`, `comment` FROM `contents`
										   WHERE `delete_flag`=0 ORDER BY created DESC LIMIT %d,5',$start);
			}
			$recordset = mysqli_query($this->dbconnect,$sqls) or die(mysqli_error($this->dbconnect));
			while ($recordsets = mysqli_fetch_assoc($recordset)) {
				// reviewの数値を「★」に変換する
				$recordsets['review'] = str_repeat("★", $recordsets['review']);
				$return['contents'][] = $recordsets;
			}
			//検索した時に検索結果を保持するために検索結果を連想配列に追加
			$return['post'] = $post;
			return $return;
		}
	}
?>
