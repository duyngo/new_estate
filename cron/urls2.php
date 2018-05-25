<?php
//ini_set( 'display_errors', 1 );
error_reporting(0);
//ファイルインクルード
include "/home/newpropertylist.my/model/common/common.php";
include "/home/newpropertylist.my/model/common/list.php";
include "/home/newpropertylist.my/model/mysql/common.php";
include "/home/newpropertylist.my/model/admin/listings/original.php";
include "/home/newpropertylist.my/model/companies/common.php";
include "/home/newpropertylist.my/model/features/common.php";
include "/home/newpropertylist.my/model/groups/common.php";
include "/home/newpropertylist.my/model/listings/common.php";
include "/home/newpropertylist.my/model/prices/common.php";
include "/home/newpropertylist.my/model/property_type_groups/common.php";
include "/home/newpropertylist.my/model/property_types/common.php";
include "/home/newpropertylist.my/model/states/common.php";

//States.listings_numが以下の値以上の場合、当該Stateに関するUrlのpriorityを0.8とする
$states_priority_standard_value = 7;
$groups_priority_standard_value = 7;
$property_type_groups_priority_standard_value = 7;

mysql_mysql_connect();

///////////////////////////////////////////////////////////
/// 1.詳細ページ
///////////////////////////////////////////////////////////
$sql_main = "select";
$sql_main .= " *";
$sql_main .= " from";
$sql_main .= " urls";
$sql_main .= " where";
$sql_main .= " type = 'detail'";
$sql_main .= " and";
$sql_main .= " is_deleted = 0";
$sql_main .= " order by id";
$result_main = mysql_query( $sql_main );
while( $arr_main = mysql_fetch_array( $result_main )){

	$listings_code = NULL;
	$states_id = NULL;      //初期化
	$locations_id = NULL;

	//URIを/で分割
	$tmp_arr = explode("/",$arr_main['url']);
	$states_code = $tmp_arr[3];

	$tmp_arr = explode("-in-",$tmp_arr[4]);
	$listings_code =  $tmp_arr[0];
	$locations_code =  $tmp_arr[1];

	$result = common_get_value_all_2("states","code",$states_code);
	if(mysql_num_rows($result)){
		$arr = mysql_fetch_array( $result );
		$states_id = $arr['id'];
		if( $arr['listings_num'] >= $states_priority_standard_value ){
			$priority = 0.8;
		}else{
			$priority = 0.5;
		}
	}
	$result = common_get_value_all_2("locations","code",$locations_code);
	if( mysql_num_rows( $result )){
		$arr = mysql_fetch_array( $result );
		$locations_id = $arr['id'];
	}
	$sql = "select";
	$sql .= " *";
	$sql .= " from";
	$sql .= " listings";
	$sql .= " where";
	$sql .= " code = '" . $listings_code . "'";
	$sql .= " and";
	$sql .= " states_id = " . $states_id;
	$sql .= " and";
	$sql .= " locations_id = " . $locations_id;
	$sql .= " and";
	$sql .= " status = 'current'";
	$sql .= " and";
	$sql .= " is_deleted = 0";
	$result = mysql_query( $sql );
	if(!mysql_num_rows($result)){	
		$sql_upd = "update urls set";
		$sql_upd .= " is_deleted = 1";
		$sql_upd .= ",modified = now()";	//今まで非表示だったものが表示になるので、更新日が変わってもOK
		$sql_upd .= " where";
		$sql_upd .= " id = " . $arr_main['id'];
		mysql_query( $sql_upd );
	}else{
		$sql_upd = "update urls set";
		$sql_upd .= " states_id = " . $states_id;
		$sql_upd .= ",priority = " . $priority;
		$sql_upd .= " where";
		$sql_upd .= " id = " . $arr_main['id'];
		mysql_query( $sql_upd );
	}
}
///////////////////////////////////////////////////////////
/// 2.検索結果ページ
///////////////////////////////////////////////////////////

//掲載中and論理削除されていないUrlを探す
$sql_main = "select";
$sql_main .= " *";
$sql_main .= " from";
$sql_main .= " urls";
$sql_main .= " where";
$sql_main .= " type = 'search'";
$sql_main .= " order by id";
$result_main = mysql_query( $sql_main );
while( $arr_main = mysql_fetch_array( $result_main )){

	//初期化
	$states_id = 0;
	$groups_id = 0;
	$locations_id = 0;
	$property_type_groups_id = 0;
	$prices_id = 0;
	$bedrooms_id = 0;
	$sizes_id = 0; 
	$completion_years_id = 0;
	$states_listings_num = 0;
	$groups_listings_num = 0;
	$property_type_groups_listings_num = 0;

	//URIを/で分割
	$tmp_arr = explode("/",$arr_main['url']);
	$states_code = $tmp_arr[3];
	$str = $tmp_arr[4];

	$conditions_num = 0;
	if( $states_code != "all-state"){
		$conditions_num++;
	}
	if(!empty($str)){
		$conditions_num += mb_substr_count($str,"_") + 1;
	}

	$result = common_get_value_all_2("states","code",$states_code);
	if(mysql_num_rows($result)){
		$arr = mysql_fetch_array( $result );
		$states_id = $arr['id'];
		$states_listings_num = $arr['listings_num'];
	}

	//states_codeより後ろの文字列には複数の条件がアンダーバー区切りで入っている為それらを分割
	$condition_arr = explode("_",$str);
	foreach( $condition_arr as $condition ){
		if( strpos($condition,"in-") !== false ){
			$locations_code = str_replace("in-","",$condition);
			$result = common_get_value_all_2("locations","code",$locations_code);
			if( mysql_num_rows( $result )){
				$mode = "index";
				$arr = mysql_fetch_array( $result );
				$locations_id = $arr['id'];
			}else{
				//20160114locations_codeが含まれているURLは強制的に対象外にする為、locationsテーブルにレコードが無くてもlocations_id
				//に値をセットして後半の処理をスキップさせるようにする
				$locations_id = "9999";
			}
		}else if( strpos($condition,"-for-sale") !== false ){
			$property_type_groups_code = str_replace("new-","",$condition);
			$property_type_groups_code = str_replace("-for-sale","",$property_type_groups_code);
			$result = common_get_value_all_2("property_type_groups","code",$property_type_groups_code);
			if( mysql_num_rows( $result )){
				$mode = "index";
				$arr = mysql_fetch_array( $result );
				$property_type_groups_id = $arr['id'];
				$property_type_groups_listings_num = $arr['listings_num'];
			}
		}else if( strpos($condition,"over") !== false || strpos($condition,"under") !== false ){
			$result = common_get_value_all_2("prices","code",$condition);
			if( mysql_num_rows( $result )){
				$mode = "index";
				$arr = mysql_fetch_array( $result );
				$prices_id = $arr['id'];
			}
		}else if( strpos($condition,"bed") !== false || strpos($condition,"studio") !== false ){
			$result = common_get_value_all_2("bedrooms","code",$condition);
			if( mysql_num_rows( $result )){
				$mode = "index";
				$arr = mysql_fetch_array( $result );
				$bedrooms_id = $arr['id'];
			}
		}else if( strpos($condition,"sqft") !== false ){
			$result = common_get_value_all_2("sizes","code",$condition);
			if( mysql_num_rows( $result )){
				$mode = "index";
				$arr = mysql_fetch_array( $result );
				$sizes_id = $arr['id'];
			}
		}else if( strpos($condition,"complete") !== false ){
			$result = common_get_value_all_2("completion_years","code",$condition);
			if( mysql_num_rows( $result )){
				$mode = "index";
				$arr = mysql_fetch_array( $result );
				$completion_years_id = $arr['id'];
			}
		}else{
			$result = common_get_value_all_2("groups","code",$condition);
			if( mysql_num_rows( $result )){
				$mode = "index";
				$arr = mysql_fetch_array( $result );
				$groups_id = $arr['id'];
				$groups_listings_num = $arr['listings_num'];
			}
		}
	}
	//priorityを決定
	if( $states_listings_num >= $states_priority_standard_value || $groups_listings_num >= $groups_priority_standard_value || $property_type_groups_listings_num >= $property_type_groups_priority_standard_value ){
		$priority = 0.8;
	}else{
		$priority = 0.5;
	}

	//総件数を取得（pagerで利用）
	$row_num_pager = 0;
	//20160114 $locationsが設定されているURLは強制的に除外する

	if( $locations_id == 0 ){
		$result = listings_index("",$states_id,$groups_id,$locations_id,$property_type_groups_id,$prices_id,$features_id,$completion_years_id,$bedrooms_id,$sizes_id,"","");
		$row_num_pager = mysql_num_rows( $result );
	}
	if($arr_main['is_deleted']){	//現在掲載されていない
		if( $row_num_pager > 1 || ($row_num_pager == 1 && $conditions_num == 3 && !empty($states_id) && !empty($groups_id) && !empty($locations_id))){
		//if( $row_num_pager > 0 ){
			$sql_upd = "update urls set";
			$sql_upd .= " states_id = " . $states_id;
			$sql_upd .= ",groups_id = " . $groups_id;
			$sql_upd .= ",property_type_groups_id = " . $property_type_groups_id;
			$sql_upd .= ",priority = " . $priority;
			$sql_upd .= ",conditions_num = " . $conditions_num;
			$sql_upd .= ",listings_num = " . $row_num_pager;
			$sql_upd .= ",is_deleted = 0";
			if( $arr_main['created'] == "0000-00-00 00:00:00" ){
				$sql_upd .= ",created = now()";
			}
			$sql_upd .= ",modified = now()";	//今まで非表示だったものが表示になるので、更新日が変わってもOK
			$sql_upd .= " where";
			$sql_upd .= " id = " . $arr_main['id'];
			mysql_query( $sql_upd );
		}
	}else{	//掲載中
		if( $row_num_pager > 1 || ($row_num_pager == 1 && $conditions_num == 3 && !empty($states_id) && !empty($groups_id) && !empty($locations_id))){
		//if( $row_num_pager > 0 ){
			//掲載条件を満たしている
			$sql_upd = "update urls set";
			$sql_upd .= " states_id = " . $states_id;
			$sql_upd .= ",groups_id = " . $groups_id;
			$sql_upd .= ",property_type_groups_id = " . $property_type_groups_id;
			$sql_upd .= ",priority = " . $priority;
			$sql_upd .= ",listings_num = " . $row_num_pager;
			//掲載件数が変わった場合に最終更新日を変更
			if( $arr_main['listings_num'] != $row_num_pager ){
				$sql_upd .= ",modified = now()";	//今まで非表示だったものが表示になるので、更新日が変わってもOK
			}
			$sql_upd .= " where";
			$sql_upd .= " id = " . $arr_main['id'];
			mysql_query( $sql_upd );
		}else{
			$sql_upd = "update urls set";
			$sql_upd .= " listings_num = " . $row_num_pager;
			$sql_upd .= ",is_deleted = 1";
			$sql_upd .= ",modified = now()";	//今まで表示だったものが非表示になるので、更新日が変わってもOK
			$sql_upd .= " where";
			$sql_upd .= " id = " . $arr_main['id'];
			mysql_query( $sql_upd );
		}
	}
}
exit;
?>
