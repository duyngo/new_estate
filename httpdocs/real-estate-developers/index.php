<?php
//ini_set( 'display_errors', 1 );
//ファイルインクルード
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

$tmp_arr = explode("/",$_SERVER['REQUEST_URI']);
if(strpos($_SERVER['REQUEST_URI'],"/sp/")===false){
        $developer_code = $tmp_arr[2];
        $states_code = $tmp_arr[3];
        $condition_str = $tmp_arr[4];
}else{
        $developer_code = $tmp_arr[3];
        $states_code = $tmp_arr[4];
        $condition_str = $tmp_arr[5];
}
if(empty($developer_code)){
	$mode = "index";
}else{
	if(strlen($developer_code)==1){
		$mode = "index";
	}else{
		$mode = "index2";
		$sql = "select";
		$sql .= " *";
		$sql .= " from";
		$sql .= " companies";
		$sql .= " where";
		$sql .= " code = '" . mysql_real_escape_string($developer_code) . "'";
		$sql .= " and";
		$sql .= " is_deleted = 0";
		$result = mysql_query( $sql );
		if(mysql_num_rows($result)){
			$arr = mysql_fetch_array( $result );
			$developer_id = $arr['id'];
			$developer_name = $arr['name'];
			$developer_address = $arr['address'];
			$developer_logo_image_path = $arr['logo_image_path'];
			//$developer_body = $arr['body_1'] . $arr['body_2'] . $arr['body_3'];
			$developer_body = $arr['body_1'];

			if(!empty($states_code)){
				if( strpos($states_code,"page:") === false ){
					$states_code = $states_code;
					if( $states_code == "all-state" ){
						$states_name = "All State";
					}else{
						$result = common_get_value_all_2("states","code",$states_code);
						if( mysql_num_rows( $result )){
							$arr = mysql_fetch_array( $result );
							$states_id = $arr['id'];
							$states_name = $arr['name'];
							$states_description = $arr['description'];
						}else{
							$mode = "404";
						}
					}
				}else{
					$states_code = "all-state";
					$states_name = "All State";
				}
			}else{
				if(!empty($condition_str)){
					//Stateが空で且つState以降のURLがあるURLはおかしいので404
					// http://newpropertylist.my/features/klang-valley//new-condominium-for-sale みたいなURL
					$mode = "404";
				}else{
					$states_code = "all-state";
					$states_name = "All State";
				}
			}
			if( $mode != "404" ){
				//states_codeより後ろの文字列には複数の条件がアンダーバー区切りで入っている為それらを分割
				if(!empty($condition_str)){
					$condition_arr = explode("_",$condition_str);
					foreach( $condition_arr as $condition ){
						if( strpos($condition,"in-") !== false ){
							$locations_id = NULL;
							$locations_code = str_replace("in-","",$condition);
							$result = common_get_value_all_2("locations","code",$locations_code);
							if( mysql_num_rows( $result )){
								$mode = "index2";
								$arr = mysql_fetch_array( $result );
								$locations_id = $arr['id'];
								$locations_name = $arr['name'];
							}else{
								$mode = "404";
							}
						}else if( strpos($condition,"-for-sale") !== false ){
							$property_type_groups_id = NULL;
							$property_type_groups_code = str_replace("new-","",$condition);
							$property_type_groups_code = str_replace("-for-sale","",$property_type_groups_code);
							$result = common_get_value_all_2("property_type_groups","code",$property_type_groups_code);
							if( mysql_num_rows( $result )){
								$mode = "index2";
								$arr = mysql_fetch_array( $result );
								$property_type_groups_id = $arr['id'];
								$property_type_groups_name = $arr['name'];
								$property_type_groups_description = $arr['description'];
							}else{
								$mode = "404";
							}
						}else if( strpos($condition,"over") !== false || strpos($condition,"under") !== false ){
							$prices_id = NULL;
							$result = common_get_value_all_2("prices","code",$condition);
							if( mysql_num_rows( $result )){
								$mode = "index2";
								$arr = mysql_fetch_array( $result );
								$prices_id = $arr['id'];
								$prices_code = $arr['code'];
								$prices_name = $arr['name'];
								$prices_short_name = $arr['short_name'];
							}else{
								$mode = "404";
							}
						}else if( strpos($condition,"bed") !== false || strpos($condition,"studio") !== false ){
							$bedrooms_id = NULL;
							$result = common_get_value_all_2("bedrooms","code",$condition);
							if( mysql_num_rows( $result )){
								$mode = "index2";
								$arr = mysql_fetch_array( $result );
								$bedrooms_id = $arr['id'];
								$bedrooms_code = $arr['code'];
								$bedrooms_name = $arr['name'];
								$bedrooms_short_name = $arr['short_name'];
							}else{
								$mode = "404";
							}
						}else if( strpos($condition,"sqft") !== false ){
							$sizes_id = NULL;
							$result = common_get_value_all_2("sizes","code",$condition);
							if( mysql_num_rows( $result )){
								$mode = "index2";
								$arr = mysql_fetch_array( $result );
								$sizes_id = $arr['id'];
								$sizes_code = $arr['code'];
								$sizes_name = $arr['name'];
								$sizes_short_name = $arr['short_name'];
							}else{
								$mode = "404";
							}
						}else if( strpos($condition,"complete") !== false ){
							$completion_years_id = NULL;
							$result = common_get_value_all_2("completion_years","code",$condition);
							if( mysql_num_rows( $result )){
								$mode = "index2";
								$arr = mysql_fetch_array( $result );
								$completion_years_id = $arr['id'];
								$completion_years_code = $arr['code'];
								$completion_years_name = $arr['name'];
							}else{
								$mode = "404";
							}
						}else{
							$groups_id = NULL;
							$result = common_get_value_all_2("groups","code",$condition);
							if( mysql_num_rows( $result )){
								$mode = "index2";
								$arr = mysql_fetch_array( $result );
								$groups_id = $arr['id'];
								$groups_code = $arr['code'];
								$groups_name = $arr['name'];
								$groups_description = $arr['description'];
							}else{
								$mode = "404";
							}
						}
					}
				}
				//絞り込み條件が揃った段階で対象物件が存在するか確認。0件の場合は404
				//1.その上で、まずdeveloper_idに子会社があるか確認する（ある場合は子会社の管理物件も表示する必要有り）
				$search_developer_id = $developer_id;
				$sql_child = "select";
				$sql_child .= " *";
				$sql_child .= " from";
				$sql_child .= " companies";
				$sql_child .= " where";
				$sql_child .= " parent_id = " . $developer_id;
				$sql_child .= " and";
				$sql_child .= " is_deleted = 0";
				$result_child = mysql_query( $sql_child );
				if(mysql_num_rows($result_child)){
					while( $arr_child = mysql_fetch_array( $result_child )){
						$search_developer_id .= "," . $arr_child['id'];
					}
				}
				//2.対象総件数を取得
				$result = listings_index( $search_developer_id,$states_id,$groups_id,$locations_id,$property_type_groups_id,$prices_id,$features_id,$completion_years_id,$bedrooms_id,$sizes_id,$tenures_id,"","");
				if(!mysql_num_rows($result)){
					$mode = "404";
				}
			}
		}else{
			$mode = "404";
		}
	}
}
/*-----------------------------------------------------------
以下は画面毎の処理
-----------------------------------------------------------*/
if( $mode == "index" ){

	$h1 = "Real estate develoers list in Malaysia";

	//ページネーション用の設定ここから
	$now_page = 1;
	$limit = 50;    //1ページあたりの表示件数
	$offset = 0;

	//URIのチェック及び値の設定
	$tmp_arr = explode("/",$_SERVER['REQUEST_URI']);
	foreach( $tmp_arr as $str ){
		if( $str != "developers" ){
			if(strpos($str,"page:")!==false){
				$page_arr = explode("page:",$str);
				$now_page = $page_arr[1];
				$offset = ($now_page-1) * $limit;
			}else{
				$initials = $str;
			}
		}
	}
	$result = companies_developer_index( $initials,"","" );
	$row_num_pager = mysql_num_rows( $result );
	if(strpos($_SERVER['REQUEST_URI'],"/sp/")===false){
		include $_SERVER['BASE_DIR'] ."/view/real-estate-developers/index.php";
	}else{
		include $_SERVER['BASE_DIR'] ."/view/sp/real-estate-developers/index.php";
	}
}else if( $mode == "index2" ){
	//右サイドの検索条件エリアの表示で利用する各変数の初期化
	$states_id_arr = array();
	$groups_id_arr = array();
	$locations_id_arr = array();
	$property_types_id_arr = array();
	$prices_id_arr = array();
	$sizes_id_arr = array();
	$bedrooms_id_arr = array();
	$completion_years_id_arr = array();

	//メタタイトルの設定
	$title .= $developer_name . " | NewPropertyList.my";

	//h1タグの設定
	$h1 = $developer_name . " .Project list";

	//メタディスクリプションの設定
	$description = $developer_name . ".";
	$description .= "Find your ";
	if($completion_years_name){
		$description .= $completion_years_name . " ";
	}
	$description .= "New ";
	if(empty($property_type_groups_id)){
		$description .= "Property";
	}else{
		$description .= $property_type_groups_name;
	}
	$description .= " in ";
	if(!empty($locations_name)){
		$description .= $locations_name;
	}else if(!empty($groups_name)){
		$description .= $groups_name;
	}else if(!empty($states_name)){
		if( $states_name != "All State"){
			$description .= $states_name;
		}else{
			$description .= "Malaysia";
		}
	}else{
		$description .= "Malaysia";
	}
	if(!empty($prices_short_name)){
		$description .= ", " . $prices_short_name;
	}
	if(!empty($sizes_short_name)){
		$description .= ", " . $sizes_short_name;
	}
	if(!empty($bedrooms_short_name)){
		$description .= ", " . $bedrooms_short_name;
	}
	$description .= " on NewPropertyList.my.";
	$description .= " You can narrow down this latest list ";
	if(empty($property_type_groups_id)){
		$description .= ", including new Condominiums, Terrace/Link Houses, Semi-detached/Bungalows and Apartments, ";
	}
	$description .= "by its ";
	if(empty($groups_id)){
		$description .= "area";
		if(empty($property_type_groups_id)||empty($bedrooms_id)||empty($sizes_id)||empty($prices_id)||empty($completion_years_id)){
			if(empty($bedrooms_id)||empty($sizes_id)||empty($prices_id)){
				$description .= ", ";
			}
		}else{
			$description .= ".";
		}
	}
	if(empty($property_type_groups_id)){
		$description .= "property type";
		if(empty($bedrooms_id)||empty($sizes_id)||empty($prices_id)||empty($completion_years_id)){
			if(empty($bedrooms_id)||empty($sizes_id)||empty($prices_id)){
				$description .= ", ";
			}
		}else{
			$description .= ".";
		}
	}
	if(empty($bedrooms_id)){
		$description .= "number of bedrooms";
		if(empty($sizes_id)||empty($prices_id)||empty($completion_years_id)){
			if(empty($sizes_id)||empty($prices_id)){
				$description .= ", ";
			}
		}else{
			$description .= ".";
		}
	}
	if(empty($sizes_id)){
		$description .= "size";
		if(empty($prices_id)||empty($completion_years_id)){
			if(empty($prices_id)){
				$description .= ", ";
			}
		}else{
			$description .= ".";
		}
	}
	if(empty($prices_id)){
		$description .= "prices";
		if(!empty($completion_years_id)){
			$description .= ".";
		}
	}
	if(empty($completion_years_id)){
		$description .= " and completion years.";
	}

	//メタキーワードの設定
	$keywords = "NewPropertyList.my,new property for sale, " . $developer_name;
	if($states_name != "All State"){
		$keywords .= ", " . $states_name;
	}else{
		$keywords .= ", Malaysia";
	}
	if(!empty($groups_name)){
		$keywords .= ", " . $groups_name;
	}
	if(!empty($locations_name)){
		$keywords .= ", " . $locations_name;
	}
	if(!empty($property_type_groups_name)){
		$keywords .= ", " . $property_type_groups_name;
	}
	if(!empty($bedrooms_short_name)){
		$keywords .= ", " . $bedrooms_short_name;
	}
	if(!empty($sizes_short_name)){
		$keywords .= ", " . $sizes_short_name;
	}
	if(!empty($prices_short_name)){
		$keywords .= ", " . $prices_short_name;
	}
	if(!empty($completion_years_name)){
		$keywords .= ", " . $completion_years_name;
	}


	//パンくずの設定
	$bread = "<li class=\"mdCMN06Cell01\"><a href=\"/\"><span>NewPropertyList</span></a></li>";
	$bread .= "<li class=\"mdCMN06Cell01\"><a href=\"/real-estate-developers/\"><span>Developers</span></a></li>";
	if($states_code!="all-state"||!empty($groups_code)||!empty($property_type_groups_code)||!empty($bedrooms_code)||!empty($sizes_code)||!empty($prices_code)||!empty($completion_years_code)){
		$bread .= "<li class=\"mdCMN06Cell01\"><a href=\"/real-estate-developers/" . $developer_code . "\"><span>" . $developer_name . "</span></a></li>";
	}else{
		$bread .= "<li class=\"mdCMN06Cell01\"> <span>" . $developer_name . "</span> </li>";
	}
	if($states_code != "all-state"){
		if(!empty($groups_code)||!empty($property_type_groups_code)||!empty($bedrooms_code)||!empty($sizes_code)||!empty($prices_code)||!empty($completion_years_code)){
			$bread .= "<li class=\"mdCMN06Cell01\"><a href=\"/real-estate-developers/" . $developer_code . "/" . $states_code . "\"><span>" . $states_name . "</span></a></li>";
		}else{
			$bread .= "<li class=\"mdCMN06Cell01\"> <span>" . $states_name . "</span> </li>";
		}
	}
	if(!empty($groups_code)){
		$href = "/real-estate-developers/" . $developer_code . "/" . $states_code . "/" . $groups_code;
		if(!empty($property_type_groups_code)||!empty($bedrooms_code)||!empty($sizes_code)||!empty($prices_code)||!empty($completion_years_code)){
			$bread .= "<li class=\"mdCMN06Cell01\"><a href=\"" . $href . "\"><span>" . $groups_name . "</span></a></li>";
		}else{
			$bread .= "<li class=\"mdCMN06Cell01\"> <span>" . $groups_name . "</span> </li>";
		}
	}
	if(!empty($locations_code)){
		$href = "/real-estate-developers/" . $developer_code;
		$href .= "/" . $states_code . "/in-" . $locations_code . "_" . $groups_code;
		if(!empty($property_type_groups_code)||!empty($bedrooms_code)||!empty($sizes_code)||!empty($prices_code)||!empty($completion_years_code)){
			$bread .= "<li class=\"mdCMN06Cell01\"><a href=\"" . $href . "\"><span>" . $locations_name . "</span></a></li>";
		}else{
			$bread .= "<li class=\"mdCMN06Cell01\"> <span>" . $locations_name . "</span> </li>";
		}
	}
	if(!empty($property_type_groups_code)){
		$href = "/real-estate-developers/" . $developer_code;
		$href .= "/" . $states_code . "/";
		if(!empty($locations_code)){
			$href .= $locations_code;
		}
		if(!empty($groups_code)){
			if(!empty($locations_code)){
				$href .= "_";
			}
			$href .= $groups_code;
		}
		if(!empty($locations_code)||!empty($groups_code)){
			$href .= "_";
		}
		$href .= "new-" . $property_type_groups_code . "-for-sale";
		if(!empty($bedrooms_code)||!empty($sizes_code)||!empty($prices_code)||!empty($completion_years_code)){
			$bread .= "<li class=\"mdCMN06Cell01\"><a href=\"" . $href . "\"><span>" . $property_type_groups_name . "</span></a></li>";
		}else{
			$bread .= "<li class=\"mdCMN06Cell01\"> <span>" . $property_type_groups_name . "</span> </li>";
		}
	}
	if(!empty($bedrooms_code)){
		$href = "/real-estate-developers/" . $developer_code;
		$href .= "/" . $states_code . "/";
		if(!empty($locations_code)){
			$href .= $locations_code;
		}
		if(!empty($groups_code)){
			if(!empty($locations_code)){
				$href .= "_";
			}
			$href .= $groups_code;
		}
		if(!empty($property_type_groups_code)){
			if(!empty($locations_code)||!empty($groups_code)){
				$href .= "_";
			}
			$href .= "new-" . $property_type_groups_code . "-for-sale";
		}
		if(!empty($locations_code)||!empty($groups_code)||!empty($property_type_groups_code)){
			$href .= "_";
		}
		$href .= $bedrooms_code;
		if(!empty($sizes_code)||!empty($prices_code)||!empty($completion_years_code)){
			$bread .= "<li class=\"mdCMN06Cell01\"><a href=\"" . $href . "\"><span>" . $bedrooms_short_name . "</span></a></li>";
		}else{
			$bread .= "<li class=\"mdCMN06Cell01\"> <span>" . $bedrooms_short_name . "</span> </li>";
		}
	}
	if(!empty($sizes_code)){
		$href = "/real-estate-developers/" . $developer_code;
		$href .= "/" . $states_code . "/";
		if(!empty($locations_code)){
			$href .= $locations_code;
		}
		if(!empty($groups_code)){
			if(!empty($locations_code)){
				$href .= "_";
			}
			$href .= $groups_code;
		}
		if(!empty($property_type_groups_code)){
			if(!empty($locations_code)||!empty($groups_code)){
				$href .= "_";
			}
			$href .= "new-" . $property_type_groups_code . "-for-sale";
		}
		if(!empty($bedrooms_code)){
			if(!empty($locations_code)||!empty($groups_code)||!empty($property_type_groups_code)){
				$href .= "_";
			}
			$href .= $bedrooms_code;
		}
		if(!empty($locations_code)||!empty($groups_code)||!empty($property_type_groups_code)||!empty($bedrooms_code)){
			$href .= "_";
		}
		$href .= $sizes_code;
		if(!empty($prices_code)||!empty($completion_years_code)){
			$bread .= "<li class=\"mdCMN06Cell01\"><a href=\"" . $href . "\"><span>" . $sizes_short_name . "</span></a></li>";
		}else{
			$bread .= "<li class=\"mdCMN06Cell01\"> <span>" . $sizes_short_name . "</span> </li>";
		}
	}
	if(!empty($prices_code)){
		$href = "/real-estate-developers/" . $developer_code;
		$href .= "/" . $states_code . "/";
		if(!empty($locations_code)){
			$href .= $locations_code;
		}
		if(!empty($groups_code)){
			if(!empty($locations_code)){
				$href .= "_";
			}
			$href .= $groups_code;
		}
		if(!empty($property_type_groups_code)){
			if(!empty($locations_code)||!empty($groups_code)){
				$href .= "_";
			}
			$href .= "new-" . $property_type_groups_code . "-for-sale";
		}
		if(!empty($bedrooms_code)){
			if(!empty($locations_code)||!empty($groups_code)||!empty($property_type_groups_code)){
				$href .= "_";
			}
			$href .= $bedrooms_code;
		}
		if(!empty($sizes_code)){
			if(!empty($locations_code)||!empty($groups_code)||!empty($property_type_groups_code)||!empty($bedrooms_code)){
				$href .= "_";
			}
			$href .= $sizes_code;
		}
		if(!empty($locations_code)||!empty($groups_code)||!empty($property_type_groups_code)||!empty($bedrooms_code)||!empty($sizes_code)){
			$href .= "_";
		}
		$href .= $prices_code;
		if(!empty($completion_years_code)){
			$bread .= "<li class=\"mdCMN06Cell01\"><a href=\"" . $href . "\"><span>" . $prices_short_name . "</span></a></li>";
		}else{
			$bread .= "<li class=\"mdCMN06Cell01\"> <span>" . $prices_short_name . "</span> </li>";
		}
	}
	if(!empty($completion_years_code)){
		$bread .= "<li class=\"mdCMN06Cell01\"> <span>";
		$bread .= $completion_years_name;
		$bread .= "</span> </li>";
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
	//子会社があるか確認する（ある場合は子会社の管理物件も表示する必要有り）
	$search_developer_id = $developer_id;
	$sql_child = "select";
	$sql_child .= " *";
	$sql_child .= " from";
	$sql_child .= " companies";
	$sql_child .= " where";
	$sql_child .= " parent_id = " . $developer_id;
	$sql_child .= " and";
	$sql_child .= " is_deleted = 0";
	$result_child = mysql_query( $sql_child );
	if(mysql_num_rows($result_child)){
		while( $arr_child = mysql_fetch_array( $result_child )){
			$search_developer_id .= "," . $arr_child['id'];
		}
	}

	//総件数を取得（pagerで利用）
	$result = listings_index( $search_developer_id,$states_id,$groups_id,$locations_id,$property_type_groups_id,$prices_id,$features_id,$completion_years_id,$bedrooms_id,$sizes_id,$tenures_id,"","");
	$row_num_pager = mysql_num_rows( $result );
	//h1タグの先頭に対象件数を追加
	if($row_num_pager>1){
		$h1 = "Latest " . $row_num_pager . " " . $h1;
	}else{
		//meta name="robots"の内容を決定（0件だったらnoindexを不可）
		$robots = "noindex";
	}
	while( $arr = mysql_fetch_array( $result )){
		if(!in_array($arr['states_id'],$states_id_arr)){
			$states_id_arr[] = $arr['states_id'];
		}
		if(!in_array($arr['groups_id'],$groups_id_arr)){
			$groups_id_arr[] = $arr['groups_id'];
		}
		if(!in_array($arr['locations_id'],$locations_id_arr)){
			$locations_id_arr[] = $arr['locations_id'];
		}
		$tmp_arr = explode(",",$arr['property_types_id']);
		foreach( $tmp_arr as $property_types_id ){
			if(!in_array($property_types_id,$property_types_id_arr)){
				$property_types_id_arr[] = $property_types_id;
			}
		}
		$tmp_arr = explode(",",$arr['prices_id']);
		foreach( $tmp_arr as $key ){
			if(!in_array($key,$prices_id_arr)){
				$prices_id_arr[] = $key;
			}
		}
		$tmp_arr = explode(",",$arr['sizes_id']);
		foreach( $tmp_arr as $key ){
			if(!empty($key)){
				if(!in_array($key,$sizes_id_arr)){
					$sizes_id_arr[] = $key;
				}
			}
		}
		$tmp_arr = explode(",",$arr['bedrooms_id']);
		foreach( $tmp_arr as $key ){
			if(!empty($key)){
				if(!in_array($key,$bedrooms_id_arr)){
					$bedrooms_id_arr[] = $key;
				}
			}
		}
		$tmp_arr = explode(",",$arr['completion_years_id']);
		foreach( $tmp_arr as $key ){
			if(!empty($key)){
				if(!in_array($key,$completion_years_id_arr)){
					$completion_years_id_arr[] = $key;
				}
			}
		}
	}
	//ページネーション用の設定ここまで

	$result_main = listings_index($search_developer_id,$states_id,$groups_id,$locations_id,$property_type_groups_id,$prices_id,$features_id,$completion_years_id,$bedrooms_id,$sizes_id,$tenures_id,$limit,$offset);
	$row_num = mysql_num_rows( $result_main );

        //ajax用に結果リストをもう１つ取得
        $result_ajax = listings_index($search_developer_id,$states_id,$groups_id,$locations_id,$property_type_groups_id,$prices_id,$features_id,$completion_years_id,$bedrooms_id,$sizes_id,$tenures_id,$limit,$offset);
        $result_ajax2 = listings_index($search_developer_id,$states_id,$groups_id,$locations_id,$property_type_groups_id,$prices_id,$features_id,$completion_years_id,$bedrooms_id,$sizes_id,$tenures_id,$limit,$offset);

	if(strpos($_SERVER['REQUEST_URI'],"/sp/")===false){
		include $_SERVER['BASE_DIR'] . "/view/real-estate-developers/index2.php";
	}else{
		include $_SERVER['BASE_DIR'] . "/view/sp/real-estate-developers/index2.php";
	}

}else{
	header("Location:/404/");
	exit;
}
?>
