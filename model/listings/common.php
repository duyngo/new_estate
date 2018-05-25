<?php
function listings_index($developer_id,$states_id,$groups_id,$locations_id,$property_type_groups_id,$prices_id,$features_id,$completion_years_id,$bedrooms_id,$sizes_id,$tenures_id,$limit,$offset){
	$sql = "select";
	$sql .= " t1.*";
        $sql .= ",t2.name as developer_name";
        $sql .= ",t2.logo_image_path";
	$sql .= ",t3.name as states_name";
	$sql .= ",t3.code as states_code";
	$sql .= ",t4.name as groups_name";
	$sql .= ",t4.code as groups_code";
	$sql .= ",t5.name as locations_name";
	$sql .= ",t5.code as locations_code";
	$sql .= " from";
	$sql .= " listings t1";
	$sql .= " left join";
	$sql .= " companies t2";
	$sql .= " on";
	$sql .= " ( t1.developer_id = t2.id )";
	$sql .= " left join";
	$sql .= " states t3";
	$sql .= " on";
	$sql .= " ( t1.states_id = t3.id )";
	$sql .= " left join";
	$sql .= " groups t4";
	$sql .= " on";
	$sql .= " ( t1.groups_id = t4.id )";
	$sql .= " left join";
	$sql .= " locations t5";
	$sql .= " on";
	$sql .= " ( t1.locations_id = t5.id )";
	$sql .= " where";
	$sql .= " t1.is_deleted = 0";
	$sql .= " and";
	$sql .= " t1.status = 'current'";
	if(!empty($developer_id)){
		$sql .= " and";
		$sql .= " t1.developer_id in (" . $developer_id . ")";
	}
	if(!empty($states_id)){
		$sql .= " and";
		$sql .= " t1.states_id = " . $states_id;
	}
	if(!empty($groups_id)){
		$sql .= " and";
		$sql .= " t1.groups_id = " . $groups_id;
	}
	if(!empty($locations_id)){
		$sql .= " and";
		$sql .= " t1.locations_id = " . $locations_id;
	}
	if(!empty($property_type_groups_id)){
		//listingsには複数のproperty_typeが設定される事があるので、それ用のSQLにする
		$cond = NULL;
		$result = property_types_index( $property_type_groups_id );
		while( $arr = mysql_fetch_array( $result )){
			if(!empty($cond)){
				$cond .= " or";
			}
			$cond .= " t1.property_types_id like '%" . $arr['id'] . "%'";
		}
		$sql .= " and";
		$sql .= " (";
		$sql .= $cond;
		$sql .= " )";
	}
	if(!empty($prices_id)){
		$sql .= " and";
		$sql .= " t1.prices_id like '%" . $prices_id . "%'";
	}
	if(!empty($features_id)){
		//listingsには複数のfeaturesが設定される事があるので、それ用のSQLにする
		$cond = NULL;
		$tmp_arr = explode(",",$features_id);
		foreach( $tmp_arr as $key){
			if(!empty($cond)){
				$cond .= " or";
			}
			$cond .= " t1.features_id like '%" . $key . "%'";
		}
		$sql .= " and";
		$sql .= " (";
		$sql .= $cond;
		$sql .= " )";
	}
	if(!empty($sizes_id)){
		$sql .= " and";
		$sql .= " t1.sizes_id like '%" . $sizes_id . "%'";
	}
	if(!empty($bedrooms_id)){
		$sql .= " and";
		$sql .= " t1.bedrooms_id like '%" . $bedrooms_id . "%'";
	}
	if(!empty($completion_years_id)){
		$sql .= " and";
		$sql .= " t1.completion_years_id like '%" . $completion_years_id . "%'";
	}
	if(!empty($tenures_id)){
		$sql .= " and";
		$sql .= " t1.tenures_id = " . $tenures_id;
	}
	$sql .= " order by field(t1.charge_type,'variable','fixed','free'),t1.monthly_enquiry_limit desc,t1.achievement_rate asc,t1.search_rank desc,t1.modified desc";
	if(!empty($limit)){
		$sql .= " limit " . $limit . " offset " . $offset;
	}
	return mysql_query($sql);
}
//TOPページに表示するlisting一覧
function listings_top_index(){
	$sql = "select";
	$sql .= " t1.*";
	$sql .= ",t2.name as developer_name";
	$sql .= ",t3.code as states_code";
	$sql .= ",t4.code as locations_code";
	$sql .= ",t5.name as property_types_name";
	$sql .= " from";
	$sql .= " listings t1";
	$sql .= " left join";
	$sql .= " companies t2";
	$sql .= " on";
	$sql .= " ( t1.developer_id = t2.id )";
	$sql .= " left join";
	$sql .= " states t3";
	$sql .= " on";
	$sql .= " ( t1.states_id = t3.id )";
	$sql .= " left join";
	$sql .= " locations t4";
	$sql .= " on";
	$sql .= " ( t1.locations_id = t4.id )";
	$sql .= " left join";
	$sql .= " property_types t5";
	$sql .= " on";
	$sql .= " ( t1.property_types_id = t5.id )";
	$sql .= " where";
	$sql .= " t1.type = 'normal'";
	$sql .= " and";
	$sql .= " t1.status = 'current'";
	$sql .= " and";
	$sql .= " t1.search_rank >= 6";
	$sql .= " and";
	$sql .= " t1.is_deleted = 0";
	$sql .= " order by t1.modified desc";
	$sql .= " limit 3";
	return mysql_query($sql);
}
//favoritesに表示するlisting一覧
function listings_favorites_index( $listings_id,$limit,$offset ){
	$sql = "select";
	$sql .= " t1.*";
	$sql .= ",t2.name as developer_name";
	$sql .= ",t3.code as states_code";
	$sql .= ",t4.code as locations_code";
	$sql .= ",t5.name as property_types_name";
	$sql .= " from";
	$sql .= " listings t1";
	$sql .= " left join";
	$sql .= " companies t2";
	$sql .= " on";
	$sql .= " ( t1.developer_id = t2.id )";
	$sql .= " left join";
	$sql .= " states t3";
	$sql .= " on";
	$sql .= " ( t1.states_id = t3.id )";
	$sql .= " left join";
	$sql .= " locations t4";
	$sql .= " on";
	$sql .= " ( t1.locations_id = t4.id )";
	$sql .= " left join";
	$sql .= " property_types t5";
	$sql .= " on";
	$sql .= " ( t1.property_types_id = t5.id )";
	$sql .= " where";
	$sql .= " t1.id in (" . $listings_id . ")";
	$sql .= " and";
	$sql .= " t1.status = 'current'";
	$sql .= " and";
	$sql .= " t1.is_deleted = 0";
	$sql .= " order by field(t1.id," . $listings_id . ")";
	if(!empty($limit)){
		$sql .= " limit " . $limit . " offset " . $offset;
	}
	return mysql_query($sql);
}
function listings_developer_index(){
	$sql = "select";
	$sql .= " distinct t1.developer_id";
	$sql .= ",t2.name as developer_name";
	$sql .= ",t2.code as developer_code";
	$sql .= ",t2.logo_image_path";
	$sql .= ",t2.body_1";
	$sql .= " from";
	$sql .= " listings t1";
	$sql .= " left join";
	$sql .= " companies t2";
	$sql .= " on";
	$sql .= " ( t1.developer_id = t2.id )";
	$sql .= " where";
	$sql .= " t1.type = 'normal'";
	$sql .= " and";
	$sql .= " t1.is_deleted = 0";
	$sql .= " order by rand()";
	return mysql_query($sql);
}
function listings_detail( $listings_code ){
	$sql = "select";
	$sql .= " t1.*";
	$sql .= ",t2.parent_id";
	$sql .= ",t2.name as developer_name";
	$sql .= ",t2.address as developer_address";
	$sql .= ",t2.logo_image_path as developer_logo_image_path";
	$sql .= ",t2.body_1 as developer_body_1";
	$sql .= ",t2.body_2 as developer_body_2";
	$sql .= ",t3.name as states_name";
	$sql .= ",t3.code as states_code";
	$sql .= ",t4.name as groups_name";
	$sql .= ",t4.code as groups_code";
	$sql .= ",t5.name as locations_name";
	$sql .= ",t5.code as locations_code";
	$sql .= " from";
	$sql .= " listings t1";
	$sql .= " left join";
	$sql .= " companies t2";
	$sql .= " on";
	$sql .= " ( t1.developer_id = t2.id )";
	$sql .= " left join";
	$sql .= " states t3";
	$sql .= " on";
	$sql .= " ( t1.states_id = t3.id )";
	$sql .= " left join";
	$sql .= " groups t4";
	$sql .= " on";
	$sql .= " ( t1.groups_id = t4.id )";
	$sql .= " left join";
	$sql .= " locations t5";
	$sql .= " on";
	$sql .= " ( t1.locations_id = t5.id )";
	$sql .= " where";
	$sql .= " t1.code = '$listings_code'";
	$sql .= " and";
	$sql .= " t1.is_deleted = 0";
	return mysql_query($sql);
}
function listings_photos_index( $listings_id ){
	$sql = "select";
	$sql .= " *";
	$sql .= " from";
	$sql .= " listings_photos";
	$sql .= " where";
	$sql .= " listings_id = $listings_id";
	$sql .= " and";
	$sql .= " display_flag = 'on'";
	$sql .= " and";
	$sql .= " is_deleted = 0";
	$sql .= " order by sort";
	return mysql_query($sql);
}
function listings_project_details_index( $listings_id ){
	$sql = "select";
	$sql .= " *";
	$sql .= " from";
	$sql .= " listings_project_details";
	$sql .= " where";
	$sql .= " listings_id = $listings_id";
	$sql .= " and";
	$sql .= " display_flag = 'on'";
	$sql .= " and";
	$sql .= " is_deleted = 0";
	$sql .= " order by sort";
	return mysql_query($sql);
}
function listings_plans_index( $listings_id ){
	$sql = "select";
	$sql .= " *";
	$sql .= " from";
	$sql .= " listings_plans";
	$sql .= " where";
	$sql .= " listings_id = $listings_id";
	$sql .= " and";
	$sql .= " display_flag = 'on'";
	$sql .= " and";
	$sql .= " is_deleted = 0";
	$sql .= " order by sort";
	return mysql_query($sql);
}
function listings_get_plans_info( $listings_id ){
	$rtn = NULL;
	$sql = "select";
	$sql .= " *";
	$sql .= " from";
	$sql .= " listings_plans";
	$sql .= " where";
	$sql .= " listings_id = $listings_id";
	$sql .= " and";
	$sql .= " display_flag = 'on'";
	$sql .= " and";
	$sql .= " is_deleted = 0";
	$sql .= " order by sort limit 3";
	$result = mysql_query($sql);
	if(mysql_num_rows($result)){
		while( $arr = mysql_fetch_array( $result )){
			if(!empty($rtn)){
				$rtn .= ",";
			}
			$rtn .= $arr['bedrooms'] . "(" . $arr['name'] . ")";
		}
	}
	return $rtn;
}
function listings_display_check( $listings_id ){
	$rtn = false;
	$sql = "select";
	$sql .= " status";
	$sql .= ",is_deleted";
	$sql .= " from";
	$sql .= " listings";
	$sql .= " where";
	$sql .= " id = $listings_id";
	$result = mysql_query($sql);
	$arr = mysql_fetch_array( $result );
	if( $arr['status'] == "current" && $arr['is_deleted'] == 0 ){
		$rtn = true;
	}
	return $rtn;
}
function listings_get_url( $column,$states_code,$groups_code,$locations_code,$property_type_groups_code,$prices_code,$sizes_code,$bedrooms_code,$completion_years_code,$tenures_code ){
	if( $column == "states" ){
		$url = "/all-state/";
		if(!empty($property_type_groups_code)){
			$url .= "new-" . $property_type_groups_code . "-for-sale";
		}
		if(!empty($prices_code)){
			if(!empty($property_type_groups_code)){
				$url .= "_";
			}
			$url .= $prices_code;
		}
		if(!empty($sizes_code)){
			if(!empty($property_type_groups_code)||!empty($prices_code)){
				$url .= "_";
			}
			$url .= $sizes_code;
		}
		if(!empty($bedrooms_code)){
			if(!empty($property_type_groups_code)||!empty($prices_code)||!empty($sizes_code)){
				$url .= "_";
			}
			$url .= $bedrooms_code;
		}
		if(!empty($completion_years_code)){
			if(!empty($property_type_groups_code)||!empty($prices_code)||!empty($sizes_code)||!empty($bedrooms_code)){
				$url .= "_";
			}
			$url .= $completion_years_code;
		}
		if(!empty($tenures_code)){
			if(!empty($property_type_groups_code)||!empty($prices_code)||!empty($sizes_code)||!empty($bedrooms_code)||!empty($completion_years_code)){
				$url .= "_";
			}
			$url .= $tenures_code;
		}
	}else if( $column == "groups" ){
		$url = "/" . $states_code . "/";
		if(!empty($property_type_groups_code)){
			$url .= "new-" . $property_type_groups_code . "-for-sale";
		}
		if(!empty($prices_code)){
			if(!empty($property_type_groups_code)){
				$url .= "_";
			}
			$url .= $prices_code;
		}
		if(!empty($sizes_code)){
			if(!empty($property_type_groups_code)||!empty($prices_code)){
				$url .= "_";
			}
			$url .= $sizes_code;
		}
		if(!empty($bedrooms_code)){
			if(!empty($property_type_groups_code)||!empty($prices_code)||!empty($sizes_code)){
				$url .= "_";
			}
			$url .= $bedrooms_code;
		}
		if(!empty($completion_years_code)){
			if(!empty($property_type_groups_code)||!empty($prices_code)||!empty($sizes_code)||!empty($bedrooms_code)){
				$url .= "_";
			}
			$url .= $completion_years_code;
		}
		if(!empty($tenures_code)){
			if(!empty($property_type_groups_code)||!empty($prices_code)||!empty($sizes_code)||!empty($bedrooms_code)||!empty($completion_years_code)){
				$url .= "_";
			}
			$url .= $tenures_code;
		}
	}else if( $column == "locations" ){
		$url = "/" . $states_code . "/";
		if(!empty($groups_code)){
			$url .= $groups_code;
		}
		if(!empty($prices_code)){
			if(!empty($locations_code)||!empty($groups_code)){
				$url .= "_";
			}
			$url .= $prices_code;
		}
		if(!empty($sizes_code)){
			if(!empty($locations_code)||!empty($groups_code)||!empty($prices_code)){
				$url .= "_";
			}
			$url .= $sizes_code;
		}
		if(!empty($bedrooms_code)){
			if(!empty($locations_code)||!empty($groups_code)||!empty($prices_code)||!empty($sizes_code)){
				$url .= "_";
			}
			$url .= $bedrooms_code;
		}
		if(!empty($completion_years_code)){
			if(!empty($locations_code)||!empty($groups_code)||!empty($prices_code)||!empty($sizes_code)||!empty($bedrooms_code)){
				$url .= "_";
			}
			$url .= $completion_years_code;
		}
		if(!empty($tenures_code)){
			if(!empty($property_type_groups_code)||!empty($prices_code)||!empty($sizes_code)||!empty($bedrooms_code)||!empty($completion_years_code)){
				$url .= "_";
			}
			$url .= $tenures_code;
		}
	}else if( $column == "property_type_groups" ){
		$url = "/" . $states_code . "/";
		if(!empty($locations_code)){
			$url .= "in-" . $locations_code;
		}
		if(!empty($groups_code)){
			if(!empty($locations_code)){
				$url .= "_";
			}
			$url .= $groups_code;
		}
		if(!empty($prices_code)){
			if(!empty($locations_code)||!empty($groups_code)){
				$url .= "_";
			}
			$url .= $prices_code;
		}
		if(!empty($sizes_code)){
			if(!empty($locations_code)||!empty($groups_code)||!empty($prices_code)){
				$url .= "_";
			}
			$url .= $sizes_code;
		}
		if(!empty($bedrooms_code)){
			if(!empty($locations_code)||!empty($groups_code)||!empty($prices_code)||!empty($sizes_code)){
				$url .= "_";
			}
			$url .= $bedrooms_code;
		}
		if(!empty($completion_years_code)){
			if(!empty($locations_code)||!empty($groups_code)||!empty($prices_code)||!empty($sizes_code)||!empty($bedrooms_code)){
				$url .= "_";
			}
			$url .= $completion_years_code;
		}
		if(!empty($tenures_code)){
			if(!empty($locations_code)||!empty($groups_code)||!empty($prices_code)||!empty($sizes_code)||!empty($bedrooms_code)||!empty($completion_years_code)){
				$url .= "_";
			}
			$url .= $tenures_code;
		}
	}else if( $column == "prices" ){
		$url = "/" . $states_code . "/";
		if(!empty($locations_code)){
			$url .= "in-" . $locations_code;
		}
		if(!empty($groups_code)){
			if(!empty($locations_code)){
				$url .= "_";
			}
			$url .= $groups_code;
		}
		if(!empty($property_type_groups_code)){
			if(!empty($locations_code)||!empty($groups_code)){
				$url .= "_";
			}
			$url .= "new-" . $property_type_groups_code . "-for-sale";
		}
		if(!empty($sizes_code)){
			if(!empty($locations_code)||!empty($groups_code)||!empty($property_type_groups_code)){
				$url .= "_";
			}
			$url .= $sizes_code;
		}
		if(!empty($bedrooms_code)){
			if(!empty($locations_code)||!empty($groups_code)||!empty($property_type_groups_code)||!empty($sizes_code)){
				$url .= "_";
			}
			$url .= $bedrooms_code;
		}
		if(!empty($completion_years_code)){
			if(!empty($locations_code)||!empty($groups_code)||!empty($property_type_groups_code)||!empty($sizes_code)||!empty($bedrooms_code)){
				$url .= "_";
			}
			$url .= $completion_years_code;
		}
		if(!empty($tenures_code)){
			if(!empty($locations_code)||!empty($groups_code)||!empty($property_type_groups_code)||!empty($sizes_code)||!empty($bedrooms_code)||!empty($completion_years_code)){
				$url .= "_";
			}
			$url .= $tenures_code;
		}
	}else if( $column == "sizes" ){
		$url = "/" . $states_code . "/";
		if(!empty($locations_code)){
			$url .= "in-" . $locations_code;
		}
		if(!empty($groups_code)){
			if(!empty($locations_code)){
				$url .= "_";
			}
			$url .= $groups_code;
		}
		if(!empty($property_type_groups_code)){
			if(!empty($locations_code)||!empty($groups_code)){
				$url .= "_";
			}
			$url .= "new-" . $property_type_groups_code . "-for-sale";
		}
		if(!empty($prices_code)){
			if(!empty($locations_code)||!empty($groups_code)||!empty($property_type_groups_code)){
				$url .= "_";
			}
			$url .= $prices_code;
		}
		if(!empty($bedrooms_code)){
			if(!empty($locations_code)||!empty($groups_code)||!empty($property_type_groups_code)||!empty($prices_code)){
				$url .= "_";
			}
			$url .= $bedrooms_code;
		}
		if(!empty($completion_years_code)){
			if(!empty($locations_code)||!empty($groups_code)||!empty($property_type_groups_code)||!empty($prices_code)||!empty($bedrooms_code)){
				$url .= "_";
			}
			$url .= $completion_years_code;
		}
		if(!empty($tenures_code)){
			if(!empty($locations_code)||!empty($groups_code)||!empty($property_type_groups_code)||!empty($prices_code)||!empty($bedrooms_code)||!empty($completion_years_code)){
				$url .= "_";
			}
			$url .= $tenures_code;
		}
	}else if( $column == "bedrooms" ){
		$url = "/" . $states_code . "/";
		if(!empty($locations_code)){
			$url .= "in-" . $locations_code;
		}
		if(!empty($groups_code)){
			if(!empty($locations_code)){
				$url .= "_" ;
			}
			$url .= $groups_code;
		}
		if(!empty($property_type_groups_code)){
			if(!empty($locations_code)||!empty($groups_code)){
				$url .= "_";
			}
			$url .= "new-" . $property_type_groups_code . "-for-sale";
		}
		if(!empty($prices_code)){
			if(!empty($locations_code)||!empty($groups_code)||!empty($property_type_groups_code)){
				$url .= "_";
			}
			$url .= $prices_code;
		}
		if(!empty($sizes_code)){
			if(!empty($locations_code)||!empty($groups_code)||!empty($property_type_groups_code)||!empty($prices_code)){
				$url .= "_";
			}
			$url .= $sizes_code;
		}
		if(!empty($completion_years_code)){
			if(!empty($locations_code)||!empty($groups_code)||!empty($property_type_groups_code)||!empty($prices_code)||!empty($sizes_code)){
				$url .= "_";
			}
			$url .= $completion_years_code;
		}
		if(!empty($tenures_code)){
			if(!empty($locations_code)||!empty($groups_code)||!empty($property_type_groups_code)||!empty($prices_code)||!empty($sizes_code)||!empty($bedrooms_code)||!empty($completion_years_code)){
				$url .= "_";
			}
			$url .= $tenures_code;
		}
	}else if( $column == "completion_years" ){
		$url = "/" . $states_code . "/";
		if(!empty($locations_code)){
			$url .= "in-" . $locations_code;
		}
		if(!empty($groups_code)){
			if(!empty($locations_code)){
				$url .= "_";
			}
			$url .= $groups_code;
		}
		if(!empty($property_type_groups_code)){
			if(!empty($locations_code)||!empty($groups_code)){
				$url .= "_";
			}
			$url .= "new-" . $property_type_groups_code . "-for-sale";
		}
		if(!empty($prices_code)){
			if(!empty($locations_code)||!empty($groups_code)||!empty($property_type_groups_code)){
				$url .= "_";
			}
			$url .= $prices_code;
		}
		if(!empty($sizes_code)){
			if(!empty($locations_code)||!empty($groups_code)||!empty($property_type_groups_code)||!empty($prices_code)){
				$url .= "_";
			}
			$url .= $sizes_code;
		}
		if(!empty($bedrooms_code)){
			if(!empty($locations_code)||!empty($groups_code)||!empty($property_type_groups_code)||!empty($prices_code)||!empty($sizes_code)){
				$url .= "_";
			}
			$url .= $bedrooms_code;
		}
		if(!empty($tenures_code)){
			if(!empty($locations_code)||!empty($groups_code)||!empty($property_type_groups_code)||!empty($prices_code)||!empty($sizes_code)||!empty($bedrooms_code)){
				$url .= "_";
			}
			$url .= $tenures_code;
		}
	}else if( $column == "tenures" ){
		$url = "/" . $states_code . "/";
		if(!empty($locations_code)){
			$url .= "in-" . $locations_code;
		}
		if(!empty($groups_code)){
			if(!empty($locations_code)){
				$url .= "_";
			}
			$url .= $groups_code;
		}
		if(!empty($property_type_groups_code)){
			if(!empty($locations_code)||!empty($groups_code)){
				$url .= "_";
			}
			$url .= "new-" . $property_type_groups_code . "-for-sale";
		}
		if(!empty($prices_code)){
			if(!empty($locations_code)||!empty($groups_code)||!empty($property_type_groups_code)){
				$url .= "_";
			}
			$url .= $prices_code;
		}
		if(!empty($sizes_code)){
			if(!empty($locations_code)||!empty($groups_code)||!empty($property_type_groups_code)||!empty($prices_code)){
				$url .= "_";
			}
			$url .= $sizes_code;
		}
		if(!empty($bedrooms_code)){
			if(!empty($locations_code)||!empty($groups_code)||!empty($property_type_groups_code)||!empty($prices_code)||!empty($sizes_code)){
				$url .= "_";
			}
			$url .= $bedrooms_code;
		}
		if(!empty($completion_years_code)){
			if(!empty($locations_code)||!empty($groups_code)||!empty($property_type_groups_code)||!empty($prices_code)||!empty($sizes_code)||!empty($bedrooms_code)){
				$url .= "_";
			}
			$url .= $completion_years_code;
		}
	}
	return $url;
}
function listings_update_call_click_num( $id,$call_click_num ){
	$sql = "update listings set";
	$sql .= " call_click_num = " .$call_click_num;
	$sql .= " where";
	$sql .= " id = " . $id;
	common_exec_sql( $sql );
	return;
}
?>
