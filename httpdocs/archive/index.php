<?php
//ini_set( 'display_errors', 1 );
//ファイルインクルード
include $_SERVER['BASE_DIR'] ."/model/archive/common.php";
include $_SERVER['BASE_DIR'] ."/model/common/common.php";
include $_SERVER['BASE_DIR'] ."/model/common/list.php";
include $_SERVER['BASE_DIR'] ."/model/mysql/common.php";
include $_SERVER['BASE_DIR'] ."/model/bedrooms/common.php";
include $_SERVER['BASE_DIR'] ."/model/companies/common.php";
include $_SERVER['BASE_DIR'] ."/model/completion_years/common.php";
include $_SERVER['BASE_DIR'] ."/model/favorites/common.php";
include $_SERVER['BASE_DIR'] ."/model/groups/common.php";
include $_SERVER['BASE_DIR'] ."/model/listings/common.php";
include $_SERVER['BASE_DIR'] ."/model/listings_project_details/common.php";
include $_SERVER['BASE_DIR'] ."/model/locations/common.php";
include $_SERVER['BASE_DIR'] ."/model/prices/common.php";
include $_SERVER['BASE_DIR'] ."/model/property_type_groups/common.php";
include $_SERVER['BASE_DIR'] ."/model/property_types/common.php";
include $_SERVER['BASE_DIR'] ."/model/sizes/common.php";
include $_SERVER['BASE_DIR'] ."/model/states/common.php";

common_pc_sp();
session_start();
common_cookie_check();
mysql_mysql_connect();
$fav_num = favorites_num();

$mode = NULL;

//URIを/で分割
$tmp_arr = explode("/",$_SERVER['REQUEST_URI']);
if(strpos($_SERVER['REQUEST_URI'],"/sp/")===false){
	$states_code = $tmp_arr[2];
	$str = $tmp_arr[3];
}else{
	$states_code = $tmp_arr[3];
	$str = $tmp_arr[4];
}
if(empty($states_code)){
	$mode = "index";
}else{
	$result = common_get_value_all_2("states","code",$states_code);
	if(!mysql_num_rows($result)){
		$mode = "404";
	}else{
		$arr = mysql_fetch_array( $result );
		$states_id = $arr['id'];
		$states_name = $arr['name'];
		$states_description = $arr['description'];
	
		if(empty($str)){
			$mode = "index";
		}else{
			$mode = "detail";

			//istings.codeの整合性チェック
			$tmp_arr2 = explode("-in-",$str);						//URIからlistings.codeを取得
			$listings_id = NULL;								//初期化
			$locations_id = NULL;								//初期化
			$listings_code = $tmp_arr2[0];
			$locations_code = $tmp_arr2[1];
			$listings_id = common_get_value_2("listings","id",$listings_code,"code");
			if(!empty($listings_id)){
				$locations_id = common_get_value_2("locations","id",$locations_code,"code");
				if(!empty($listings_id)&&!empty($locations_id)){
					$sql = "select";
					$sql .= " states_id";
					$sql .= ",groups_id";
					$sql .= ",locations_id";
					$sql .= ",status";
					$sql .= " from";
					$sql .= " listings";
					$sql .= " where";
					$sql .= " id = " . $listings_id;
					$sql .= " and";
					$sql .= " states_id = " . $states_id;
					$sql .= " and";
					$sql .= " locations_id = " . $locations_id;
					$sql .= " and";
					$sql .= " is_deleted = 0";
					$result = mysql_query( $sql );
					if( mysql_num_rows( $result )){
						$arr = mysql_fetch_array( $result );
						if( $arr['status'] == "current" ){
							$url = str_replace("archive/","",$_SERVER['REQUEST_URI']);
							header('Location:' . $url );
							exit;
						}else if( $arr['status'] != "archived" ){
							$mode = "404";
						}
					}else{
						$mode = "404";
					}
				}else{
					$mode = "404";
				}
			}else{
				$mode = "404";
			}
		}
	}
}
if( $mode == "index" ){

        //パンくずの設定
        $bread = "<li class=\"mdCMN06Cell01\"><a href=\"/\"><span>NewPropertyList</span></a></li>";
	if(empty($states_code)){
		$bread .= "<li class=\"mdCMN06Cell01\"><span>Archive</span></li>";
	}else{
		$bread .= "<li class=\"mdCMN06Cell01\"><a href=\"/archive/\"><span>Archive</span></a></li>";
                $bread .= "<li class=\"mdCMN06Cell01\"> <span>" . $states_name . "</span> </li>";
        }

	//ページネーション用の設定ここから
        $now_page = 1;
        $limit = 20;    //1ページあたりの表示件数
        $offset = 0;

        //URIのチェック及び値の設定
        $tmp_arr = explode("/",$_SERVER['REQUEST_URI']);
        foreach( $tmp_arr as $str ){
                if(strpos($str,"page:")!==false){
                        $page_arr = explode("page:",$str);
                        $now_page = $page_arr[1];
                        $offset = ($now_page-1) * $limit;
                }
        }
        //総件数を取得（pagerで利用）
	$result = archive_index($states_id,"","");
        $row_num_pager = mysql_num_rows( $result );

	//右サイドの検索条件エリアの表示で利用する各変数の初期化
	$states_id_arr = array();
        while( $arr = mysql_fetch_array( $result )){
                if(!in_array($arr['states_id'],$states_id_arr)){
                        $states_id_arr[] = $arr['states_id'];
                }
	}
	$result_main = archive_index($states_id,$limit,$offset);
	$row_num = mysql_num_rows( $result_main );
	if(strpos($_SERVER['REQUEST_URI'],"/sp/")===false){
		include $_SERVER['BASE_DIR'] . "/view/archive/index.php";
	}else{
		include $_SERVER['BASE_DIR'] . "/view/sp/archive/index.php";
	}

}else if( $mode == "detail" ){

	//RecentSearchesの数を取得
	$rs_num = mb_substr_count($_COOKIE['newpropertylist']['RecentSearches'],",");

	//取得したlistings.codeの存在確認
	$result = listings_detail( $tmp_arr2[0] );
	if( mysql_num_rows( $result )){

		$arr = mysql_fetch_array( $result );

                //Company Informationに表示させる情報を取得
                if( $arr['companies_id'] == $arr['parent_id'] ){
			$parent_id = $arr['companies_id'];
		}else{
			$parent_id = $arr['parent_id'];
		}
                $result_parent = common_get_value_all_2("companies","id",$parent_id);
                $arr_parent = mysql_fetch_array( $result_parent );

		//写真一覧を取得
		$result_listings_photos = listings_photos_index( $arr['id'] );
		$result_listings_photos2 = listings_photos_index( $arr['id'] );

		//説明文一覧を取得
		$result_listings_project_details = listings_project_details_index( $arr['id'] );

		//floor plan一覧を取得
		$result_listings_plans = listings_plans_index( $arr['id'] );

		//近隣の物件一覧を取得
		$result_compare  = listings_index("",$states_id,"","","","","","","","","","");

		$h1 = $arr['name'] . " in " . $arr['locations_name'] . "(" . $arr['developer_name'] . ")";
		if(strpos($_SERVER['REQUEST_URI'],"/sp/")===false){
			include $_SERVER['BASE_DIR'] . "/view/property/detail.php";
		}else{
			include $_SERVER['BASE_DIR'] . "/view/sp/property/detail.php";
		}
	}
}else{
        header("Location:/404/");
        exit;
}
?>
