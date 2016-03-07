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
		public function index($id){
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

    		$sq = 'SELECT COUNT(*) AS cnt FROM `contents` WHERE 1';
    		$records = mysqli_query($this->dbconnect,$sq) or die(mysqli_error($this->dbconnect));
    		$maxp = mysqli_fetch_assoc($records);
    		$maxpage = ceil($maxp['cnt'] /5);
    		$page = min($page,$maxpage);
    		$return['page'][] = $page;
    		$return['maxpage'][] = $maxpage;

    		$start = ($page-1)*5;
            $start = max(0,$start);
            //これまでの投稿表示
            $contents = array();
            $sqls = sprintf('SELECT `content_id`,`shop_name`, `review`, `comment`,`delete_flag` FROM `contents` WHERE `delete_flag`=0 ORDER BY created DESC LIMIT %d,5',$start);
            $recordset = mysqli_query($this->dbconnect,$sqls) or die(mysqli_error($this->dbconnect));
            while ($recordsets = mysqli_fetch_assoc($recordset)) {
    			$return['contents'][] = $recordsets;
    		}
    		// for ($i=0; $i <5 ; $i++) {
    		// 	$return['contents'][$i]['review'] = str_replace(1,"★", $return['contents'][$i]['review']);
    		// 	$return['contents'][$i]['review'] = str_replace(2,"★★", $return['contents'][$i]['review']);
    		// 	$return['contents'][$i]['review'] = str_replace(3,"★★★", $return['contents'][$i]['review']);
    		// 	$return['contents'][$i]['review'] = str_replace(4,"★★★★", $return['contents'][$i]['review']);
    		// 	$return['contents'][$i]['review'] = str_replace(5,"★★★★★", $return['contents'][$i]['review']);
    		// }
    		$numbers = count($return['contents']);
    		for ($i=0; $i < $numbers ; $i++) {
    			$number = $return['contents'][$i]['review'];
    			$return['contents'][$i]['review'] = "";
    			for ($j=0; $j < $number ; $j++) {
    				$return['contents'][$i]['review'] = $return['contents'][$i]['review']."★";
    			}
    		}
    		return $return;
}



	}


?>
