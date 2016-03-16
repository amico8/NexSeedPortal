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
    		}
    		//あいまい検索したときの件数取得のSQL文
    		elseif(isset($post['search'])&&!empty($post['search'])){
    				$sq = sprintf('SELECT COUNT(*) AS cnt FROM `contents` WHERE (`shop_name` LIKE "%%%s%%" OR `comment` LIKE "%%%s%%") AND `delete_flag`=0',
    				      mysqli_real_escape_string($this->dbconnect,$post['search']),
    				      mysqli_real_escape_string($this->dbconnect,$post['search']));
    		}
    		//検索しないときの件数取得(デフォルト)のSQL文
    		else{
    		    $sq = 'SELECT COUNT(*) AS cnt FROM `contents` WHERE `delete_flag`=0';
    		}
    		$records = mysqli_query($this->dbconnect,$sq) or die(mysqli_error($this->dbconnect));
    		$maxp = mysqli_fetch_assoc($records);
    		$maxpage = ceil($maxp['cnt'] /5);
    		$page = min($page,$maxpage);
    		$return['maxpage'][] = $maxpage;
    		$start = ($page-1)*5;
            $start = max(0,$start);
            // $contents = array();
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
    		}
    		else{
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
    	    // else{
    	    	// $return['comment'][] = "該当する結果は存在しません。";
    	    // }
    	    //状況確認ように$returnに$postを入れておく
    	    $return['post'] = $post;
    		return $return;
		}
		// ↓ 修正中

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
					// mysqli_real_escape_string($this->dbconnect, $session['user_id']),
					echo $sql;
					mysqli_query($this->dbconnect, $sql) or die(mysqli_error($this->dbconnect));
					// return値はいらない
		}


	}

?>
