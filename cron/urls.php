<?php
//ini_set( 'display_errors', 1 );
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
include "/home/newpropertylist.my/model/states/common.php";

mysql_mysql_connect();


//
$sql = "delete from listings_for_urls";
mysql_query( $sql );


//掲載中and論理削除されていないListingを探す
$sql = "select";
$sql .= " t1.*";
$sql .= ",t2.code as states_code";
$sql .= ",t3.code as groups_code";
$sql .= ",t4.code as locations_code";
$sql .= " from";
$sql .= " listings t1";
$sql .= " left join";
$sql .= " states t2";
$sql .= " on";
$sql .= " (t1.states_id = t2.id)";
$sql .= " left join";
$sql .= " groups t3";
$sql .= " on";
$sql .= " (t1.groups_id = t3.id)";
$sql .= " left join";
$sql .= " locations t4";
$sql .= " on";
$sql .= " (t1.locations_id = t4.id)";
$sql .= " where";
$sql .= " t1.status = 'current'";
$sql .= " and";
$sql .= " t1.is_deleted = 0";
$sql .= " order by t1.id";
$result = mysql_query( $sql );
while( $arr = mysql_fetch_array( $result )){

	////////////////////////////////////////////
	/////// 詳細ページのURLをチェック
	////////////////////////////////////////////
	$url = "http://newpropertylist.my/" . $arr['states_code'] . "/" . $arr['code'] . "-in-" . $arr['locations_code'];
	$sql2 = "select";
	$sql2 .= " *";
	$sql2 .= " from";
	$sql2 .= " urls";
	$sql2 .= " where";
	$sql2 .= " url = '" . $url . "'";
	$result2 = mysql_query( $sql2 );
	if(mysql_num_rows($result2)){	//詳細ページのURLが既に存在する
		$arr2 = mysql_fetch_array( $result2 );
		if( $arr2['is_deleted'] == 1 ){
			//論理削除済の場合は論理削除状態を解除
			$sql_upd = "update urls set";
			$sql_upd .= " is_deleted = 0";
			$sql_upd .= ",modified = now()";
			$sql_upd .= " where";
			$sql_upd .= " id = " . $arr2['id'];
			mysql_query( $sql_upd );
		}
	}else{				//詳細ページのURLが登録されていない
		$sql_ins = "insert into urls (";
		$sql_ins .= " url";
		$sql_ins .= ",type";
		$sql_ins .= ",created";
		$sql_ins .= ",modified";
		$sql_ins .= ")values(";
		$sql_ins .= "'" . $url . "'";
		$sql_ins .= ",'detail'";
		$sql_ins .= ",now()";
		$sql_ins .= ",now()";
		$sql_ins .= ")";
		mysql_query( $sql_ins );

		$urls_id = common_get_max("urls");
		$sql_ins = "insert into listings_urls (";
		$sql_ins .= " listings_id";
		$sql_ins .= ",urls_id";
		$sql_ins .= ",created";
		$sql_ins .= ")values(";
		$sql_ins .= "'" . $arr['id'] . "'";
		$sql_ins .= "," . $urls_id;
		$sql_ins .= ",now()";
		$sql_ins .= ")";
		mysql_query( $sql_ins );
	}
	////////////////////////////////////////////
	/////// 検索結果ページのURLをチェック
	////////////////////////////////////////////

	$property_type_groups_code_arr = array();
	$tmp_arr = explode(",",$arr['property_types_id']);
	foreach( $tmp_arr as $key ){
		$property_type_groups_id = common_get_value_2("property_types","property_type_groups_id",$key,"");
		$tmp_code = common_get_value_2("property_type_groups","code",$property_type_groups_id,"");
		if(!in_array($tmp_code,$property_type_groups_code_arr)){
			$property_type_groups_code_arr[] = $tmp_code;
		}
	}

	$prices_code_arr = array();
	$tmp_arr = explode(",",$arr['prices_id']);
	foreach( $tmp_arr as $key ){
		$prices_code_arr[] = common_get_value_2("prices","code",$key,"");
	}

	$sizes_code_arr = array();
	$tmp_arr = explode(",",$arr['sizes_id']);
	foreach( $tmp_arr as $key ){
		$sizes_code_arr[] = common_get_value_2("sizes","code",$key,"");
	}

	$bedrooms_code_arr = array();
	$tmp_arr = explode(",",$arr['bedrooms_id']);
	foreach( $tmp_arr as $key ){
		$bedrooms_code_arr[] = common_get_value_2("bedrooms","code",$key,"");
	}

	$completion_years_code_arr = array();
	$tmp_arr = explode(",",$arr['completion_years_id']);
	foreach( $tmp_arr as $key ){
		$completion_years_code_arr[] = common_get_value_2("completion_years","code",$key,"");
	}

	foreach( $property_type_groups_code_arr as $property_type_groups_code ){
		foreach( $prices_code_arr as $prices_code ){
			foreach( $sizes_code_arr as $sizes_code ){
				foreach( $bedrooms_code_arr as $bedrooms_code ){
					foreach( $completion_years_code_arr as $completion_years_code ){
						$sql_ins = "insert into listings_for_urls (";
						$sql_ins .= " listings_id";
						$sql_ins .= ",code";
						$sql_ins .= ",states_code";
						$sql_ins .= ",groups_code";
						//$sql_ins .= ",locations_code";
						$sql_ins .= ",property_type_groups_code";
						$sql_ins .= ",prices_code";
						$sql_ins .= ",sizes_code";
						$sql_ins .= ",bedrooms_code";
						$sql_ins .= ",completion_years_code";
						$sql_ins .= ")values(";
						$sql_ins .= " " . $arr['id'];
						$sql_ins .= ",'" . $arr['code'] . "'";
						$sql_ins .= ",'" . $arr['states_code'] . "'";
						$sql_ins .= ",'" . $arr['groups_code'] . "'";
						//$sql_ins .= ",'" . $arr['locations_code'] . "'";
						$sql_ins .= ",'" . $property_type_groups_code . "'";
						$sql_ins .= ",'" . $prices_code . "'";
						$sql_ins .= ",'" . $sizes_code . "'";
						$sql_ins .= ",'" . $bedrooms_code . "'";
						$sql_ins .= ",'" . $completion_years_code . "'";
						$sql_ins .= ")";
						mysql_query( $sql_ins );
					}
				}
			}
		}
	}
}


$sql = "select * from listings_for_urls order by id";
$result = mysql_query( $sql );
while( $arr = mysql_fetch_array( $result )){

	//echo $arr['id'] . "\n";

	$url = array();
	$states_flag_array = array("on","off");
	$groups_flag_array = array("on","off");
	//$locations_flag_array = array("on","off");
	$locations_flag_array = array("off");
	$property_type_groups_flag_array = array("on","off");
	$prices_flag_array = array("on","off");
	$sizes_flag_array = array("on","off");
	$bedrooms_flag_array = array("on","off");
	$completion_years_flag_array = array("on","off");

	foreach( $states_flag_array as $states_flag ){
		foreach( $groups_flag_array as $groups_flag ){
			foreach( $locations_flag_array as $locations_flag ){
				foreach( $property_type_groups_flag_array as $property_type_groups_flag ){
					foreach( $prices_flag_array as $prices_flag ){
						foreach( $sizes_flag_array as $sizes_flag ){
							foreach( $bedrooms_flag_array as $bedrooms_flag ){
								foreach( $completion_years_flag_array as $completion_years_flag ){
									$str = "http://newpropertylist.my/";
									if( $states_flag == "on" ){
										$str .= $arr['states_code'] . "/";
										if( $locations_flag == "on" ){
											$str .= "in-" . $arr['locations_code'] . "_" . $arr['groups_code'];
										}else{
											if( $groups_flag == "on" ){
												$str .= $arr['groups_code'];
											}
										}
									}else{
										$str .= "all-state/";
									}
									if( $property_type_groups_flag == "on" && !empty($arr['property_type_groups_code'])){
										if( $states_flag == "on" && ($groups_flag == "on" || $locations_flag == "on") ){
											$str .= "_";
										}
										$str .= "new-" . $arr['property_type_groups_code'] . "-for-sale";
									}
									if( $prices_flag == "on" && !empty($arr['prices_code'])){
										if( ($states_flag == "on" && ($groups_flag == "on" || $locations_flag == "on")) || ($property_type_groups_flag == "on" && !empty($arr['property_type_groups_code']))){
											$str .= "_";
										}
										$str .= $arr['prices_code'];
									}
									if( $sizes_flag == "on" && !empty($arr['sizes_code'])){
										if( ($states_flag == "on" && ($groups_flag == "on" || $locations_flag == "on")) || ($property_type_groups_flag == "on" && !empty($arr['property_type_groups_code'])) || ($prices_flag == "on" && !empty($arr['prices_code'])) ){
											$str .= "_";
										}
										$str .= $arr['sizes_code'];
									}
									if( $bedrooms_flag == "on" && !empty($arr['bedrooms_code'])){
										if( ($states_flag == "on" && ($groups_flag == "on" || $locations_flag == "on")) || ($property_type_groups_flag == "on" && !empty($arr['property_type_groups_code'])) || ($prices_flag == "on" && !empty($arr['prices_code'])) || ($sizes_flag == "on" && !empty($arr['sizes_code']))){
											$str .= "_";
										}
										$str .= $arr['bedrooms_code'];
									}
									if( $completion_years_flag == "on" && !empty( $arr['completion_years_code'] )){
										if( ($states_flag == "on" && ($groups_flag == "on" || $locations_flag == "on")) || ($property_type_groups_flag == "on" && !empty($arr['property_type_groups_code'])) || ($prices_flag == "on" && !empty($arr['prices_code'])) || ($sizes_flag == "on" && !empty($arr['sizes_code'])) || ($bedrooms_flag == "on" && !empty($arr['bedrooms_code']))){
											$str .= "_";
										}
										$str .= $arr['completion_years_code'];
									}
									$url[] = $str;
								}
							}
						}
					}
				}
			}
		}
	}

	foreach( $url as $key ){
		$sql2 = "select";
		$sql2 .= " *";
		$sql2 .= " from";
		$sql2 .= " urls";
		$sql2 .= " where";
		$sql2 .= " url = '" . $key . "'";
//echo $sql2 . "\n";
		$result2 = mysql_query( $sql2 );
		if(!mysql_num_rows($result2)){		//URLがまだ登録されていない

			//この段階ではまだ登録日は設定しない（url2.phpで設定する）

			$sql_ins = "insert into urls (";
			$sql_ins .= " url";
			$sql_ins .= ",type";
			$sql_ins .= ",is_deleted";
			$sql_ins .= ")values(";
			$sql_ins .= "'" . $key . "'";
			$sql_ins .= ",'search'";
			$sql_ins .= ",1";
			$sql_ins .= ")";
			mysql_query( $sql_ins );

			$urls_id = common_get_max("urls");
			$sql_ins = "insert into listings_urls (";
			$sql_ins .= " listings_id";
			$sql_ins .= ",urls_id";
			$sql_ins .= ",created";
			$sql_ins .= ")values(";
			$sql_ins .= "'" . $arr['listings_id'] . "'";
			$sql_ins .= "," . $urls_id;
			$sql_ins .= ",now()";
			$sql_ins .= ")";
			mysql_query( $sql_ins );
		}else{
			$arr2 = mysql_fetch_array( $result2 );
			$urls_id = $arr2['id'];
			$sql3 = "select";
			$sql3 .= " *";
			$sql3 .= " from";
			$sql3 .= " listings_urls";
			$sql3 .= " where";
			$sql3 .= " listings_id = '" . $arr['listings_id'] . "'";
			$sql3 .= " and";
			$sql3 .= " urls_id = '" . $urls_id . "'";
			$result3 = mysql_query( $sql3 );
			if(!mysql_num_rows($result3)){
				$sql_ins = "insert into listings_urls (";
				$sql_ins .= " listings_id";
				$sql_ins .= ",urls_id";
				$sql_ins .= ",created";
				$sql_ins .= ")values(";
				$sql_ins .= "'" . $arr['listings_id'] . "'";
				$sql_ins .= "," . $urls_id;
				$sql_ins .= ",now()";
				$sql_ins .= ")";
				mysql_query( $sql_ins );
			}
		}
	}
}
exit;
?>
