<?php
//ini_set( 'display_errors', 1 );
//ファイルインクルード
include "../../model/common/common.php";
include "../../model/common/list.php";
include "../../model/mysql/common.php";
include "../../model/companies/common.php";
include "../../model/groups/common.php";
include "../../model/listings/common.php";
include "../../model/prices/common.php";
include "../../model/property_type_groups/common.php";
include "../../model/states/common.php";
session_start();
mysql_mysql_connect();

$h1 = "Malaysian property portal specializing in new property launched for sale";

//ページネーション用の設定ここから
$now_page = 1;
$limit = 30;	//1ページあたりの表示件数
$offset = 0;

//URIのチェック及び値の設定
$tmp_arr = explode("/",$_SERVER['REQUEST_URI']);
if(!empty($tmp_arr[2])){
	if(strpos($tmp_arr[2],"page:")!==false){
		$page_arr = explode("page:",$tmp_arr[2]);
		$now_page = $page_arr[1];
		$offset = ($now_page-1) * $limit;
	}else{
		header("Location:/404/");
	}
}
//ページネーション用の設定ここまで

if(empty($_SESSION['members_id'])){
	if(isset($_COOKIE['newpropertylist']['RecentSearches'])){
		$listings_id = $_COOKIE['newpropertylist']['RecentSearches'];
	}
}else{
	$listings_id = common_get_value("members","recent_searches",$_SESSION['members_id'],"");
}
//まず総件数を取得（pagerで利用）
$result = listings_favorites_index( $listings_id,"","" );
$row_num_pager = mysql_num_rows( $result );

//次に現在のページに表示すべきレコードを取得
$result = listings_favorites_index( $listings_id,$limit,$offset );

include "../../view/recent_searches/index.php";
?>
