<?php
//ini_set( 'display_errors', 1 );
//ファイルインクルード
include $_SERVER['BASE_DIR'] ."/model/common/common.php";
include $_SERVER['BASE_DIR'] ."/model/common/list.php";
include $_SERVER['BASE_DIR'] ."/model/mysql/common.php";
include $_SERVER['BASE_DIR'] ."/model/companies/common.php";
include $_SERVER['BASE_DIR'] ."/model/favorites/common.php";
include $_SERVER['BASE_DIR'] ."/model/groups/common.php";
include $_SERVER['BASE_DIR'] ."/model/listings/common.php";
include $_SERVER['BASE_DIR'] ."/model/listings_enquiries/common.php";
include $_SERVER['BASE_DIR'] ."/model/members/common.php";
include $_SERVER['BASE_DIR'] ."/model/prices/common.php";
include $_SERVER['BASE_DIR'] ."/model/property_type_groups/common.php";
include $_SERVER['BASE_DIR'] ."/model/states/common.php";

common_pc_sp();
session_start();
mysql_mysql_connect();

//20160608 スマホ版のカート画面下部「continue to search」のリンク先を設定ここから
if(empty($_SESSION['continue_to_search'])){
	$_SESSION['continue_to_search'] = "/";
}
//20160608 スマホ版のカート画面下部「continue to search」のリンク先を設定ここまで

$fav_num = favorites_num();
//RecentSearchesの数を取得
$rs_num = 0;
$rs_arr = explode(",",$_COOKIE['newpropertylist']['RecentSearches']);
foreach( $rs_arr as $key ){
        if( listings_display_check( $key )){
                $rs_num++;
        }
}
$h1 = "Malaysian property portal specializing in new property launched for sale";
$listings_id = $_COOKIE['newpropertylist']['Favorites'];

//URIのチェック及び値の設定
$tmp_arr = explode("/",$_SERVER['REQUEST_URI']);
if(strpos($_SERVER['REQUEST_URI'],"/sp/")===false){
	$mode = $tmp_arr[2];
	$mode2 = $tmp_arr[3];
}else{
	$mode = $tmp_arr[3];
	$mode2 = $tmp_arr[4];
}
if( $mode == "once_for_all" ){
	$favorites = $listings_id;
	foreach( $_SESSION['result_list'] as $key ){
		if(strpos($listings_id,$key)===false){
			if(empty($favorites)){
				$favorites = $key;
			}else{
				$favorites = $key . "," . $favorites;
			}
		}
	}
	setcookie("newpropertylist[Favorites]","$favorites",time() + 1825 * 24 * 60 * 60,"/" );
	if(!empty($_SESSION['members_id'])){
		$sql = "update members set";
		$sql .= " favorites = '$favorites'";
		$sql .= ",modified = now()";
		$sql .= " where";
		$sql .= " id = " . $_SESSION['members_id'];
		common_exec_sql( $sql );
	}
	header("Location:/enquiry/collection");
	exit;
}else if( $mode == "delete" ){
	$favorites = NULL;
	$listings_id_arr = explode(",",$listings_id);
	foreach( $listings_id_arr as $key ){
		if( $mode2 != $key ){
			if(!empty($favorites)){
				$favorites .= ",";
			}
			$favorites .= $key;
		}
	}
	setcookie("newpropertylist[Favorites]","$favorites",time() + 1825 * 24 * 60 * 60,"/" );
	if(!empty($_SESSION['members_id'])){
		$sql = "update members set";
		$sql .= " favorites = '$favorites'";
		$sql .= ",modified = now()";
		$sql .= " where";
		$sql .= " id = " . $_SESSION['members_id'];
		common_exec_sql( $sql );
	}
	header("Location:/enquiry/collection");
	exit;
}else if( $mode == "collection" ){
	//ページネーション用の設定ここから
	$now_page = 1;
	$limit = 1000;	//1ページあたりの表示件数
	$offset = 0;
	if(!empty($mode2)){
		if(strpos($mode2,"page:")!==false){
			$page_arr = explode("page:",$mode2);
			$now_page = $page_arr[1];
			$offset = ($now_page-1) * $limit;
		}else{
			header("Location:/404/");
		}
	}
	//次に現在のページに表示すべきレコードを取得
	$result = listings_favorites_index( $listings_id,$limit,$offset );
	if(strpos($_SERVER['REQUEST_URI'],"/sp/")===false){
		include $_SERVER['BASE_DIR'] . "/view/enquiry/collection.php";
	}else{
		include $_SERVER['BASE_DIR'] . "/view/sp/enquiry/collection.php";
	}
}else if( $mode == "input" ){

	//カゴの状態を調べる
	$i=0;
	$tmp_arr = explode(",",$_COOKIE['newpropertylist']['Favorites']);
	foreach( $tmp_arr as $listings_id ){
		if(listings_display_check($listings_id)){	//掲載チェック
			$i++;
		}
	}
	if(!$i){
		header('Location:/enquiry/collection');
		exit;
	}
	if( $_POST['act'] == "enquiry" ){
		$err_msg = listings_enquiries_err_check();
		if(empty($err_msg)){
			if(!empty($_SESSION['members_id'])){
				$members_id = $_SESSION['members_id'];
			}else{
				$members_id = common_get_value_2("members","id",$_POST['email'],"email");
				if(empty($members_id)){
					if( $_POST['signup'] == "yes" ){
						$_POST['password'] = random_string();
						$members_id = members_insert();
						members_signup_send_mail($_POST['email'],$_POST['name'],$_POST['password']);
					}else{
						$members_id = 0;
					}
				}
			}
			$listings_arr = array();
			$tmp_arr = explode(",",$_COOKIE['newpropertylist']['Favorites']);
			foreach( $tmp_arr as $listings_id ){
				if(listings_display_check($listings_id)){	//掲載チェック
					listings_enquiries_insert($listings_id,$members_id );
					$listings_arr[] = $listings_id;
				}
			}
			if( $_POST['newsletter'] == "yes" ){
				listings_enquiries_update_members_newsletter($members_id,$_POST['newsletter']);
			}
			listings_enquiries_send_mail_to_member($_POST['email'],$_POST['name'],$listings_arr);
			listings_enquiries_send_mail_to_samurai($listings_arr);

			//問い合わせ完了後はカゴを空にする
			setcookie("newpropertylist[Favorites]","",time() + 1825 * 24 * 60 * 60,"/" );
			if(!empty($_SESSION['members_id'])){
				$sql = "update members set";
				$sql .= " favorites = ''";
				$sql .= ",modified = now()";
				$sql .= " where";
				$sql .= " id = " . $_SESSION['members_id'];
				common_exec_sql( $sql );
			}
			header('Location:/enquiry/completion');
			exit;
		}
	}
	if(strpos($_SERVER['REQUEST_URI'],"/sp/")===false){
		include $_SERVER['BASE_DIR'] . "/view/enquiry/input.php";
	}else{
		include $_SERVER['BASE_DIR'] . "/view/sp/enquiry/input.php";
	}
}else if( $mode == "completion" ){
	if(strpos($_SERVER['REQUEST_URI'],"/sp/")===false){
		include $_SERVER['BASE_DIR'] . "/view/enquiry/completion.php";
	}else{
		include $_SERVER['BASE_DIR'] . "/view/sp/enquiry/completion.php";
	}
}
?>
