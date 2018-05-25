<?php
//ini_set( 'display_errors', 1 );
//ファイルインクルード
include $_SERVER['BASE_DIR']."/model/common/common.php";
include $_SERVER['BASE_DIR']."/model/common/list.php";
include $_SERVER['BASE_DIR']."/model/mysql/common.php";
include $_SERVER['BASE_DIR']."/model/bedrooms/common.php";
include $_SERVER['BASE_DIR']."/model/companies/common.php";
include $_SERVER['BASE_DIR']."/model/completion_years/common.php";
include $_SERVER['BASE_DIR']."/model/favorites/common.php";
include $_SERVER['BASE_DIR']."/model/groups/common.php";
include $_SERVER['BASE_DIR']."/model/listings/common.php";
include $_SERVER['BASE_DIR']."/model/listings_call_clicks/common.php";
include $_SERVER['BASE_DIR']."/model/listings_project_details/common.php";
include $_SERVER['BASE_DIR']."/model/locations/common.php";
include $_SERVER['BASE_DIR']."/model/prices/common.php";
include $_SERVER['BASE_DIR']."/model/property_type_groups/common.php";
include $_SERVER['BASE_DIR']."/model/property_types/common.php";
include $_SERVER['BASE_DIR']."/model/sizes/common.php";
include $_SERVER['BASE_DIR']."/model/states/common.php";
include $_SERVER['BASE_DIR']."/model/tenures/common.php";

common_pc_sp();
session_start();
common_cookie_check();
mysql_mysql_connect();

//20160505groups.code変更によるイレギュラー処理
if(strpos($_SERVER['REQUEST_URI'],"cheras")!==false && strpos($_SERVER['REQUEST_URI'],"cheras-south")===false && strpos($_SERVER['REQUEST_URI'],"in-cheras")===false ){
	$url = str_replace("cheras","cheras-south",$_SERVER['REQUEST_URI']);
	header( "HTTP/1.1 301 Moved Permanently" ); 
	header('Location:' . $url );
	exit;
}

if( $_POST['act'] == "src" ){
	$url = "/sp/";
	if(empty($_POST['states_id'])){
		$url .= "all-state";
	}else{
		$url .= common_get_value_2("states","code",$_POST['states_id'],"id");
	}
	$url .= "/";
	if(!empty($_POST['locations_id'])){
                $url .= "in-" . common_get_value_2("locations","code",$_POST['locations_id'],"id");
	}
	if(!empty($_POST['groups_id'])){
                if(!empty($_POST['locations_id'])){
                        $url .= "_";
                }
                $url .= common_get_value_2("groups","code",$_POST['groups_id'],"id");
	}
	if(!empty($_POST['property_type_groups_id'])){
                if(!empty($_POST['locations_id'])||!empty($_POST['groups_id'])){
                        $url .= "_";
                }
                $url .= "new-" . common_get_value_2("property_type_groups","code",$_POST['property_type_groups_id'],"id")  . "-for-sale";
	}
	if(!empty($_POST['prices_id'])){
		if(!empty($_POST['locations_id'])||!empty($_POST['groups_id'])||!empty($_POST['property_type_groups_id'])){
                        $url .= "_";
                }
                $url .= common_get_value_2("prices","code",$_POST['prices_id'],"id");
	}
	if(!empty($_POST['sizes_id'])){
		if( !empty($_POST['locations_id'])|| !empty($_POST['groups_id']) || !empty($_POST['property_type_groups_id']) || !empty($_POST['prices_id']) ){
                        $url .= "_";
                }
                $url .= common_get_value_2("sizes","code",$_POST['sizes_id'],"id");
	}
	if(!empty($_POST['bedrooms_id'])){
		if(!empty($_POST['locations_id'])||!empty($_POST['groups_id'])||!empty($_POST['property_type_groups_id'])||!empty($_POST['prices_id'])||!empty($_POST['sizes_id'])){
                        $url .= "_";
                }
                $url .= common_get_value_2("bedrooms","code",$_POST['bedrooms_id'],"id");
	}
	if(!empty($_POST['completion_years_id'])){
		if(!empty($_POST['locations_id'])||!empty($_POST['groups_id'])||!empty($_POST['property_type_groups_id'])||!empty($_POST['prices_id'])||!empty($_POST['sizes_id'])||!empty($_POST['bedrooms_id']) ){
                        $url .= "_";
                }
                $url .= common_get_value_2("completion_years","code",$_POST['completion_years_id'],"id");
	}
	if(!empty($_POST['tenures_id'])){
		if(!empty($_POST['locations_id'])||!empty($_POST['groups_id'])||!empty($_POST['property_type_groups_id'])||!empty($_POST['prices_id'])||!empty($_POST['sizes_id'])||!empty($_POST['bedrooms_id'])||!empty($_POST['completion_years_id']) ){
                        $url .= "_";
                }
                $url .= common_get_value_2("tenures","code",$_POST['tenures_id'],"id");
	}
	header('Location:' . $url);
	exit;
}


//URL解析処理
//1.AdwordsによりURLにパラメーターが付加される事があるので、まず「?」以降の文字列は切り捨てる
$init_arr = explode("?",$_SERVER['REQUEST_URI']);
$tmp_arr = explode("/",$init_arr[0]);

if(strpos($init_arr[0],"/sp/")===false){	//PCの場合
	$device = "pc";
	$states_code = $tmp_arr[1];
	$str = $tmp_arr[2];
	$tab = $tmp_arr[3];
}else{
	$device = "sp";
	$states_code = $tmp_arr[2];		//スマホの場合
	$str = $tmp_arr[3];
	$tab = $tmp_arr[4];
}

//$tmp_arr[1]が間違えている場合はディレクトリ自体が存在せず404になる為、以下のstates_idは必ず正しい
$result = common_get_value_all_2("states","code",$states_code);
if( mysql_num_rows( $result )){
	$arr = mysql_fetch_array( $result );
	$states_id = $arr['id'];
	$states_name = $arr['name'];
	$states_description = $arr['description'];
}else{
	$states_name = "All State";
}
//states_codeより後ろの文字列で検索結果ページか詳細ページかを判定する
if(empty($str)){
	$mode = "index";
}else{
	if( strpos($str,"-in-")!==false ){
		//istings.codeの整合性チェック
		$tmp_arr2 = explode("-in-",$str);						//URIからlistings.codeを取得
		$listings_id = NULL;								//初期化
		$locations_id = NULL;								//初期化
		$listings_code = $tmp_arr2[0];
		$locations_code = $tmp_arr2[1];
		$listings_id = common_get_value_2("listings","id",$listings_code,"code");
		if(!empty($listings_id)){
			//詳細ページにて「Add EnquiryCollection」が押された場合
			if( strpos($tmp_arr2[1],"save")!==false ){
				$mode2 = "save";
				//Favoritesに追加
				favorites_add( $listings_id );

				//$location = str_replace(":save","",$_SERVER['REQUEST_URI']);
				header("Location:/enquiry/collection");
				exit;
			}else if( strpos($tmp_arr2[1],"delete")!==false ){
				favorites_delete( $listings_id );
				$location = str_replace(":delete","",$_SERVER['REQUEST_URI']);
				header("Location:" . $location );
				exit;
			}else if( strpos($tmp_arr2[1],"call_to_developer")!==false ){
				listings_call_clicks_insert($listings_id,$_SESSION['members_id']);
				$result_lcc = listings_call_clicks_index($listings_id);
				listings_update_call_click_num( $listings_id,mysql_num_rows($result_lcc));
				$_SESSION['call_to_developer'] = 1;
				$location = str_replace(":call_to_developer","#mdDTL01AddBtn",$_SERVER['REQUEST_URI']);
				header("Location:" . $location );
				exit;
			}
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
						$mode = "detail";
					}else if( $arr['status'] == "archived" ){
						$url = "/archive" . $_SERVER['REQUEST_URI'];
						header('Location:' . $url );
						exit;
					}else{
						if(!empty($_SESSION['users_id'])||!empty($_SESSION['external_users_id'])){
							$mode = "detail";
						}else{
							$mode = "404";
						}
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
	}else if( strpos($str,"page:") !== false ){
		$mode = "index";
	}else{
		//states_codeより後ろの文字列には複数の条件がアンダーバー区切りで入っている為それらを分割
		$condition_arr = explode("_",$str);
		foreach( $condition_arr as $condition ){
			if( strpos($condition,"in-") !== false ){
				$locations_id = NULL;	
				$locations_code = str_replace("in-","",$condition);
				$result = common_get_value_all_2("locations","code",$locations_code);
				if( mysql_num_rows( $result )){
					$mode = "index";
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
					$mode = "index";
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
					$mode = "index";
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
					$mode = "index";
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
					$mode = "index";
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
					$mode = "index";
					$arr = mysql_fetch_array( $result );
					$completion_years_id = $arr['id'];
					$completion_years_code = $arr['code'];
					$completion_years_name = $arr['name'];
				}else{
					$mode = "404";
				}
			}else if( strpos($condition,"freehold") !== false || strpos($condition,"leasehold") !== false || strpos($condition,"malay-reserved") !== false ){
				$tenures_id = NULL;
				$result = common_get_value_all_2("tenures","code",$condition);
				if( mysql_num_rows( $result )){
					$mode = "index";
					$arr = mysql_fetch_array( $result );
					$tenures_id = $arr['id'];
					$tenures_code = $arr['code'];
					$tenures_name = $arr['name'];
					$tenures_short_name = $arr['short_name'];
				}else{
					$mode = "404";
				}
			}else{
				$groups_id = NULL;
				$result = common_get_value_all_2("groups","code",$condition);
				if( mysql_num_rows( $result )){
					$mode = "index";
					$arr = mysql_fetch_array( $result );
					$groups_id = $arr['id'];
					$groups_code = $arr['code'];
					$groups_name = $arr['name'];
					$groups_description = $arr['description'];
				}else{
					$mode = "404";
				}
			}
			if( $mode == "404" ){
				break;
			}
		}
		//絞り込み條件が揃った段階で対象物件の存在確認を行い、0件の場合は404に飛ばす
		//但しスマホの場合はやらない
		if( strpos($_SERVER['REQUEST_URI'],"/sp/")===false){
			$result = listings_index("",$states_id,$groups_id,$locations_id,$property_type_groups_id,$prices_id,$features_id,$completion_years_id,$bedrooms_id,$sizes_id,$tenures_id,"","");
			if(!mysql_num_rows($result)){
				$mode = "404";
			}
		}
	}
}
//Enquiry Collectionの数を取得
$fav_num = favorites_num();

//RecentSearchesの数を取得
$rs_num = 0;
$rs_arr = explode(",",$_COOKIE['newpropertylist']['RecentSearches']);
foreach( $rs_arr as $key ){
        if( listings_display_check( $key )){
                $rs_num++;
	}
}
/*-----------------------------------------------------------
以下は画面毎の処理
-----------------------------------------------------------*/
if( $mode == "index" ){

	//20160608 スマホ版のカート画面下部「continue to search」のリンク先を設定
	$_SESSION['continue_to_search'] = $_SERVER['REQUEST_URI'];


	//右サイドの検索条件エリアの表示で利用する各変数の初期化
	$states_id_arr = array();
	$groups_id_arr = array();
	$locations_id_arr = array();
	$property_types_id_arr = array();
	$prices_id_arr = array();
	$sizes_id_arr = array();
	$bedrooms_id_arr = array();
	$completion_years_id_arr = array();
	$tenures_id_arr = array();

	//メタタイトルの設定
	$conditions_num = 0;
	if(!empty($completion_years_id)){
		$conditions_num++;
		$title = $completion_years_name;
	}
	if(!empty($tenures_short_name)){
		$conditions_num++;
		$title .= " " . $tenures_short_name . ",";
	}
	if(!empty($prices_short_name)){
		$conditions_num++;
		$title .= " " . $prices_short_name . ",";
	}
	if(!empty($bedrooms_short_name)){
		$conditions_num++;
		$title .= " " . $bedrooms_short_name . ",";
	}
	if(!empty($sizes_short_name)){
		$conditions_num++;
		$title .= " " . $sizes_short_name . ",";
	}
	$title .= " New ";
	if(empty($property_type_groups_id)){
		$title .= "Property";
	}else{
		$conditions_num++;
		$title .= $property_type_groups_name;
	}
	$title .= " for Sale";
	$title .= " in ";
	if(!empty($locations_name)){
		$conditions_num++;
		$title .= $locations_name;
	}else{
		if(!empty($groups_name)){
			$conditions_num += 2;
			$title .= $groups_name . ", " . $states_name;
		}else{
			if($states_name != "All State"){
				$conditions_num++;
				$title .= $states_name;
			}else{
				$title .= "Malaysia";

			}
		}
	}
	if( $conditions_num < 2 ){
		$title .= " | NewPropertyList.my";
	}

	//メタディスクリプションの設定
	$description = "Find your ";
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
	if(!empty($tenures_short_name)){
		$description .= ", " . $tenures_short_name;
	}
	$description .= " on NewPropertyList.my.";

	if(empty($property_type_groups_id)||empty($bedrooms_id)||empty($sizes_id)||empty($prices_id)||empty($completion_years_id)){
		$description .= " You can narrow down this latest list ";
		if(empty($property_type_groups_id)){
			$description .= ", including new Condominiums, Terrace/Link Houses, Semi-detached/Bungalows and Apartments, ";
		}
		$description .= "by its ";
		if(empty($groups_id)){
			$description .= "area";
			if(empty($property_type_groups_id)||empty($bedrooms_id)||empty($sizes_id)||empty($prices_id)||empty($completion_years_id)){
				$description .= ", ";
			}
		}
		if(empty($property_type_groups_id)){
			$description .= "property type";
			if(empty($bedrooms_id)||empty($sizes_id)||empty($prices_id)||empty($completion_years_id)){
				$description .= ", ";
			}
		}
		if(empty($bedrooms_id)){
			$description .= "number of bedrooms";
			if(empty($sizes_id)||empty($prices_id)||empty($completion_years_id)){
				$description .= ", ";
			}
		}
		if(empty($sizes_id)){
			$description .= "size";
			if(empty($prices_id)||empty($completion_years_id)){
				$description .= ", ";
			}
		}
		if(empty($prices_id)){
			$description .= "prices";
			if(empty($completion_years_id)){
				$description .= ", ";
			}
		}
		if(empty($completion_years_id)){
			$description .= "completion years";
			if(empty($tenures_id)){
				$description .= ", ";
			}
		}
		if(empty($tenures_id)){
			$description .= "tenure";
		}
		$description .= ".";
	}

	//メタキーワードの設定
	$keywords = "NewPropertyList.my";
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
	if(!empty($tenures_name)){
		$keywords .= ", " . $tenures_name;
	}

	//パンくずの設定
	$bread = "<li class=\"mdCMN06Cell01\"><a href=\"/all-state/\"><span>New Properties</span></a></li>";
	if(!empty($groups_code)||!empty($property_type_groups_code)||!empty($bedrooms_code)||!empty($sizes_code)||!empty($prices_code)||!empty($completion_years_code)||!empty($tenures_code)){
	$bread .= "<li class=\"mdCMN06Cell01\"><a href=\"/" . $states_code . "\"><span>" . $states_name . "</span></a></li>";
	}else{
		$bread .= "<li class=\"mdCMN06Cell01\"> <span>" . $states_name . "</span> </li>";
	}
	if(!empty($groups_code)){
		$href = "/" . $states_code . "/" . $groups_code;
		if(!empty($locations_code)||!empty($property_type_groups_code)||!empty($bedrooms_code)||!empty($sizes_code)||!empty($prices_code)||!empty($completion_years_code)||!empty($tenures_code)){
		$bread .= "<li class=\"mdCMN06Cell01\"><a href=\"" . $href . "\"><span>" . $groups_name . "</span></a></li>";
		}else{
			$bread .= "<li class=\"mdCMN06Cell01\"> <span>" . $groups_name . "</span> </li>";
		}
	}
	if(!empty($locations_code)){
		$href = "/" . $states_code . "/" . $locations_code . "_" . $groups_code;
		if(!empty($property_type_groups_code)||!empty($bedrooms_code)||!empty($sizes_code)||!empty($prices_code)||!empty($completion_years_code)||!empty($tenures_code)){
		$bread .= "<li class=\"mdCMN06Cell01\"><a href=\"" . $href . "\"><span>" . $locations_name . "</span></a></li>";
		}else{
			$bread .= "<li class=\"mdCMN06Cell01\"> <span>" . $locations_name . "</span> </li>";
		}
	}
	if(!empty($property_type_groups_code)){
		$href = "/" . $states_code . "/";
		if(!empty($groups_code)){
			$href .= $groups_code . "_";
		}
		$href .= "new-" . $property_type_groups_code . "-for-sale";
		if(!empty($bedrooms_code)||!empty($sizes_code)||!empty($prices_code)||!empty($completion_years_code)||!empty($tenures_code)){
			$bread .= "<li class=\"mdCMN06Cell01\"><a href=\"" . $href . "\"><span>" . $property_type_groups_name . "</span></a></li>";
		}else{
			$bread .= "<li class=\"mdCMN06Cell01\"> <span>" . $property_type_groups_name . "</span></li>";
		}
	}
	if(!empty($bedrooms_code)){
		$href = "/" . $states_code . "/";
		if(!empty($groups_code)){
			$href .= $groups_code;
		}
		if(!empty($property_type_groups_code)){
			if(!empty($groups_code)){
				$href .= "_";
			}
			$href .= "new-" . $property_type_groups_code . "-for-sale";
		}
		if(!empty($groups_code)||!empty($property_type_groups_code)){
			$href .= "_";
		}
		$href .= $bedrooms_code;
		if(!empty($sizes_code)||!empty($prices_code)||!empty($completion_years_code)||!empty($tenures_code)){
			$bread .= "<li class=\"mdCMN06Cell01\"><a href=\"" . $href . "\"><span>" . $bedrooms_short_name . "</span></a></li>";
		}else{
			$bread .= "<li class=\"mdCMN06Cell01\"> <span>" . $bedrooms_short_name . "</span> </li>";
		}
	}
	if(!empty($sizes_code)){
		$href = "/" . $states_code . "/";
		if(!empty($groups_code)){
			$href .= $groups_code;
		}
		if(!empty($property_type_groups_code)){
			if(!empty($groups_code)){
				$href .= "_";
			}
			$href .= "new-" . $property_type_groups_code . "-for-sale";
		}
		if(!empty($bedrooms_code)){
			if(!empty($groups_code)||!empty($property_type_groups_code)){
				$href .= "_";
			}
			$href .= $bedrooms_code;
		}
		if(!empty($groups_code)||!empty($property_type_groups_code)||!empty($bedrooms_code)){
			$href .= "_";
		}
		$href .= $sizes_code;
		if(!empty($prices_code)||!empty($completion_years_code)||!empty($tenures_code)){
			$bread .= "<li class=\"mdCMN06Cell01\"><a href=\"" . $href . "\"><span>" . $sizes_short_name . "</span></a></li>";
		}else{
			$bread .= "<li class=\"mdCMN06Cell01\"> <span>" . $sizes_short_name . "</span> </li>";
		}
	}



	if(!empty($prices_code)){
		$href = "/" . $states_code . "/";
		if(!empty($groups_code)){
			$href .= $groups_code;
		}
		if(!empty($property_type_groups_code)){
			if(!empty($groups_code)){
				$href .= "_";
			}
			$href .= "new-" . $property_type_groups_code . "-for-sale";
		}
		if(!empty($bedrooms_code)){
			if(!empty($groups_code)||!empty($property_type_groups_code)){
				$href .= "_";
			}
			$href .= $bedrooms_code;
		}
		if(!empty($sizes_code)){
			if(!empty($groups_code)||!empty($property_type_groups_code)||!empty($bedrooms_code)){
				$href .= "_";
			}
			$href .= $sizes_code;
		}
		if(!empty($groups_code)||!empty($property_type_groups_code)||!empty($bedrooms_code)||!empty($sizes_code)){
			$href .= "_";
		}
		$href .= $prices_code;
		if(!empty($completion_years_code)||!empty($tenures_code)){
			$bread .= "<li class=\"mdCMN06Cell01\"><a href=\"" . $href . "\"><span>" . $prices_short_name . "</span></a></liu>";
		}else{
			$bread .= "<li class=\"mdCMN06Cell01\"> <span>" . $prices_short_name . "</span> </li>";
		}
	}
	if(!empty($completion_years_code)){
		$href = "/" . $states_code . "/";
		if(!empty($groups_code)){
			$href .= $groups_code;
		}
		if(!empty($property_type_groups_code)){
			if(!empty($groups_code)){
				$href .= "_";
			}
			$href .= "new-" . $property_type_groups_code . "-for-sale";
		}
		if(!empty($bedrooms_code)){
			if(!empty($groups_code)||!empty($property_type_groups_code)){
				$href .= "_";
			}
			$href .= $bedrooms_code;
		}
		if(!empty($sizes_code)){
			if(!empty($groups_code)||!empty($property_type_groups_code)||!empty($bedrooms_code)){
				$href .= "_";
			}
			$href .= $sizes_code;
		}
		if(!empty($prices_code)){
			if(!empty($groups_code)||!empty($property_type_groups_code)||!empty($bedrooms_code)||!empty($sizes_code)){
				$href .= "_";
			}
			$href .= $prices_code;
		}
		if(!empty($groups_code)||!empty($property_type_groups_code)||!empty($bedrooms_code)||!empty($sizes_code)){
			$href .= "_";
		}
		$href .= $completion_years_code;
		if(!empty($tenures_code)){
			$bread .= "<li class=\"mdCMN06Cell01\"><a href=\"" . $href . "\"><span>" . $completion_years_name . "</span></a></liu>";
		}else{
			$bread .= "<li class=\"mdCMN06Cell01\"> <span>" . $completion_years_name . "</span> </li>";
		}
	}
	if(!empty($tenures_code)){
		$bread .= "<li class=\"mdCMN06Cell01\"> <span>";
		$bread .= $tenures_name;
		$bread .= "</span> </li>";
	}




	//ページネーション用の設定ここから
	$now_page = 1;

	//1ページあたりの表示件数
	if(strpos($_SERVER['REQUEST_URI'],"/sp/")===false){
		$limit = 20;    //PC
	}else{
		$limit = 10;    //スマホ
	}
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
	$result = listings_index("",$states_id,$groups_id,$locations_id,$property_type_groups_id,$prices_id,$features_id,$completion_years_id,$bedrooms_id,$sizes_id,$tenures_id,"","");
	$row_num_pager = mysql_num_rows( $result );
	if($row_num_pager < 1 ){
		//meta name="robots"の内容を決定（0件だったらnoindexを不可）
		$robots = "noindex";
	}

	//h1タグの設定
	if(strpos($_SERVER['REQUEST_URI'],"/sp/")===false){
		$h1 = "We found ";
		$h1 .= "<span>" . $row_num_pager . "</span>";
		$h1 .= "<new> new </new>";
		$h1 .= "<span>";
		if(!empty($property_type_groups_name)){
			$h1 .= $property_type_groups_name;
		}else{
			$h1 .= "properties";
		}
		$h1 .= " </span>";
		$h1 .= "<for>for sale in </for>";
		$h1 .= "<span>";
		if(!empty($groups_name)){
			//$h1 .= $groups_name . ", " . $states_name;
			$h1 .= $groups_name;
		}else if(!empty($states_name) && $states_code != "all-state" ){
			$h1 .= $states_name;
		}else{
			$h1 .= "Malaysia";
		}
		$h1 .= "</span>";
	}else{
		//スマホ用
		$h1 = "<span>We found </span> ";
		$h1 .= $row_num_pager;
		$h1 .= "<span> new ";
		if(!empty($property_type_groups_name)){
			$h1 .= $property_type_groups_name;
		}else{
			$h1 .= "properties";
		}
		$h1 .= " for sale in ";
		if(!empty($groups_name)){
			//$h1 .= $groups_name . ", " . $states_name;
			$h1 .= $groups_name;
		}else if(!empty($states_name) && $states_code != "all-state" ){
			$h1 .= $states_name;
		}else{
			$h1 .= "Malaysia";
		}
		$h1 .= "</span>";
		if($row_num_pager < 1 ){
			$h1 = "Sorry there is no result for your search";
		}
	}

	
	$_SESSION['result_list'] = array();
	while( $arr = mysql_fetch_array( $result )){
		//Enquiry once for allが押された場合に備えて対象の物件idをセッションに格納しておく
		$_SESSION['result_list'][] = $arr['id'];

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
		if(!in_array($arr['tenures_id'],$tenures_id_arr)){
			$tenures_id_arr[] = $arr['tenures_id'];
		}
	}
	//ページネーション用の設定ここまで

	//スマホajax用に各検索条件をSESSION登録
	if(!empty($states_id)){
		$_SESSION['states_id'] = $states_id;
	}else{
		$_SESSION['states_id'] = NULL;
	}
	if(!empty($groups_id)){
		$_SESSION['groups_id'] = $groups_id;
	}else{
		$_SESSION['groups_id'] = NULL;
	}
	if(!empty($locations_id)){
		$_SESSION['locations_id'] = $locations_id;
	}else{
		$_SESSION['locations_id'] = NULL;
	}
	if(!empty($property_type_groups_id)){
		$_SESSION['property_type_groups_id'] = $property_type_groups_id;
	}else{
		$_SESSION['property_type_groups_id'] = NULL;
	}
	if(!empty($prices_id)){
		$_SESSION['prices_id'] = $prices_id;
	}else{
		$_SESSION['prices_id'] = NULL;
	}
	if(!empty($completion_years_id)){
		$_SESSION['completion_years_id'] = $completion_years_id;
	}else{
		$_SESSION['completion_years_id'] = NULL;
	}
	if(!empty($bedrooms_id)){
		$_SESSION['bedrooms_id'] = $bedrooms_id;
	}else{
		$_SESSION['bedrooms_id'] = NULL;
	}
	if(!empty($sizes_id)){
		$_SESSION['sizes_id'] = $sizes_id;
	}else{
		$_SESSION['sizes_id'] = NULL;
	}

	$result_main = listings_index("",$states_id,$groups_id,$locations_id,$property_type_groups_id,$prices_id,$features_id,$completion_years_id,$bedrooms_id,$sizes_id,$tenures_id,$limit,$offset);
	$row_num = mysql_num_rows( $result_main );

	//ajax用に結果リストをもう１つ取得
	$result_ajax = listings_index("",$states_id,$groups_id,$locations_id,$property_type_groups_id,$prices_id,$features_id,$completion_years_id,$bedrooms_id,$sizes_id,$tenures_id,"","");
	$result_ajax2 = listings_index("",$states_id,$groups_id,$locations_id,$property_type_groups_id,$prices_id,$features_id,$completion_years_id,$bedrooms_id,$sizes_id,$tenures_id,$limit,$offset);


	//検索結果ページのメインビジュアルを設定
	$image = NULL;
	$image = common_get_value_2("property_type_groups","image_path",$property_type_groups_id);
	if(!empty($image)){
		$image = "/admin/images/property_type_groups/" . $image;
	}else{
		$image = "/assets/img/non_type.jpg";	 //デフォルト画像
	}
	if( $device == "pc" ){
		include $_SERVER['BASE_DIR']."/view/property/index.php";
	}else{
		include $_SERVER['BASE_DIR']."/view/sp/property/index.php";
	}

}else if( $mode == "detail" ){
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
		//表示対象企業がagencyだった場合、更に表示対象企業を変更
		if( $arr_parent['class'] == "agency" ){
			$result_parent = common_get_value_all_2("companies","id",$arr['developer_id']);
			$arr_parent = mysql_fetch_array( $result_parent );
			if( $arr_parent['id'] != $arr_parent['parent_id'] ){
				$result_parent = common_get_value_all_2("companies","id",$arr_parent['parent_id']);
				$arr_parent = mysql_fetch_array( $result_parent );
			}
		}


		//RecentSearchesに追加
		if(empty($_COOKIE['newpropertylist']['RecentSearches']) || strpos($_COOKIE['newpropertylist']['RecentSearches'],$arr['id'])===false ){
			if(empty($_COOKIE['newpropertylist']['RecentSearches'])){
				$rs = $arr['id'];
			}else{
				$rs = $arr['id'] . "," . $_COOKIE['newpropertylist']['RecentSearches'];
			}
			setcookie("newpropertylist[RecentSearches]","$rs",time() + 1825 * 24 * 60 * 60,"/");
			if(!empty($_SESSION['members_id'])){
				$sql_upd = "update members set";
				$sql_upd .= " recent_searches = '" . $rs . "'";
				$sql_upd .= ",modified = now()";
				$sql_upd .= " where";
				$sql_upd .= " id = " . $_SESSION['members_id'];
				common_exec_sql( $sql_upd );
			}
		}
		//写真一覧を取得
		$result_listings_photos = listings_photos_index( $arr['id'] );
		$result_listings_photos2 = listings_photos_index( $arr['id'] );
		$result_listings_photos3 = listings_photos_index( $arr['id'] );

		//説明文一覧を取得
		$result_listings_project_details = listings_project_details_index( $arr['id'] );

		//floor plan一覧を取得
		$result_listings_plans = listings_plans_index( $arr['id'] );

		//近隣の物件一覧を取得
		$result_compare  = listings_index("",$states_id,"","","","","","","","","","");

		//myfavorites用URL
		if(strpos($_COOKIE['newpropertylist']['Favorites'],$listings_id)===false){
			$favorites_url = "/" . $states_code . "/" . $listings_code . "-in-" . $locations_code . ":save/" . $tab;
		}else{
			$favorites_url = "/" . $states_code . "/" . $listings_code . "-in-" . $locations_code . ":delete/" . $tab;
		}


		$h1 = $arr['name'] . " in " . $arr['locations_name'] . "(" . $arr['developer_name'] . ")";
		if( $device == "pc" ){
			include $_SERVER['BASE_DIR']."/view/property/detail.php";
		}else{
			include $_SERVER['BASE_DIR']."/view/sp/property/detail.php";
		}
/*
		if(empty($tmp_arr[3])){
			if( $device == "pc" ){
				include $_SERVER['BASE_DIR']."/view/property/detail.php";
			}else{
				include $_SERVER['BASE_DIR']."/view/sp/property/detail.php";
			}
		}else if( $tmp_arr[3] == "Floor-Plan" ){
			//20151017 詳細ページが3枚構成から1枚構成に変わったので、リダイレクト設定
			header('Location:/' . $tmp_arr[1] . "/" . $tmp_arr[2] );
			exit;

			//floorPlanのページはdescriptionキーワードが複雑なのでここで作る
			$description = "The floor plan of " . $arr['name'] . " in " . $arr['locations_name'] . ", " . $arr['states_name'] . ",";
			$description .= " by " . $arr['developer_name'] . ", ";
			while( $arr_listings_plans = mysql_fetch_array( $result_listings_plans )){
				$description .= $arr_listings_plans['name'] . " is " . $arr_listings_plans['size'] . "," . $arr_listings_plans['bedrooms'] . "," . $arr_listings_plans['bathrooms'] . "," . $arr_listings_plans['price'] . ".";
			}
			$description .= ". See the floor plan of " . $arr['name'] . " - NewPropertyList.my";
			include "../../view/property/floor.php";
		}else if( $tmp_arr[3] == "Location-Map" ){
			//20151017 詳細ページが3枚構成から1枚構成に変わったので、リダイレクト設定
			header('Location:/' . $tmp_arr[1] . "/" . $tmp_arr[2] );
			exit;

			include "../../view/property/map.php";
		}
*/
	}
}else{
	header("Location:/404/");
	exit;
}
?>
