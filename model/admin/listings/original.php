<?php
function listings_get_property_type_name($str){
	$property_type_name = NULL;
	$tmp_arr = explode(",",$str);
	foreach( $tmp_arr as $property_type_id ){
		if(!empty($property_type_name)){
			$property_type_name .= ",";
		}
		$property_type_name .= common_get_value("property_types","name",$property_type_id,"");
	}
	return $property_type_name;
}
function listings_update_achievement_rate($id,$monthly_enquiry_limit){
        $sql = "select";
        $sql .= " monthly_enquiry_num";
        $sql .= " from";
        $sql .= " listings";
        $sql .= " where";
        $sql .= " id = " . $id;
	$result = mysql_query($sql);
	$arr = mysql_fetch_array( $result );
	$monthly_enquiry_num = $arr['monthly_enquiry_num'];
        $achievement_rate = floor(($monthly_enquiry_num/$monthly_enquiry_limit)*100);

        $sql = "update listings set";
        $sql .= " achievement_rate = " . $achievement_rate;
        $sql .= ",modified = now()";
        $sql .= ",modified_by = " . $_SESSION['users_id'];
        $sql .= " where";
        $sql .= " id = " . $id;
        common_exec_sql($sql);
}
function listings_update_listings_num(){
	$tables = array("property_types","states","groups","locations","prices");
	foreach( $tables as $tables_name ){
		$key = $tables_name . "_id";
		$sql = "select";
		$sql .= " id";
		$sql .= " from";
		$sql .= " $tables_name";
		$sql .= " where";
		$sql .= " is_deleted = 0";
		$result = mysql_query($sql);
		while($arr = mysql_fetch_array( $result )){
			$sql2 = "select";
			$sql2 .= " count(*) as listings_num";
			$sql2 .= " from";
			$sql2 .= " listings";
			$sql2 .= " where";
			if( $tables_name == "property_types" ){
				$sql2 .= " $key like '%" . $arr['id'] . "%'";
			}else{
				$sql2 .= " $key = " . $arr['id'];
			}
			$sql2 .= " and";
			$sql2 .= " status = 'current'";
			$sql2 .= " and";
			$sql2 .= " is_deleted = 0";
			$result2 = mysql_query($sql2);
			$arr2 = mysql_fetch_array( $result2 );

			$sql_upd = "update $tables_name set";
			$sql_upd .= " listings_num = '" . $arr2['listings_num'] . "'";
			$sql_upd .= " where";
			$sql_upd .= " id = " . $arr['id'];
			common_exec_sql($sql_upd);
		}
	}
        //property_type_groupsだけは直接listingsにセットされている訳ではないので別処理
        $sql = "select";
        $sql .= " property_type_groups_id";
        $sql .= ",sum(listings_num) as listings_num";
        $sql .= " from";
        $sql .= " property_types";
        $sql .= " group by";
        $sql .= " property_type_groups_id";
        $result = mysql_query($sql);
        while($arr = mysql_fetch_array( $result )){
                $sql_upd = "update property_type_groups set";
                $sql_upd .= " listings_num = '" . $arr['listings_num'] . "'";
                $sql_upd .= " where";
                $sql_upd .= " id = " . $arr['property_type_groups_id'];
                common_exec_sql($sql_upd);
        }
	return;
}
function listings_get_ui_detail_url($id){
	$url = NULL;
        $sql = "select";
        $sql .= " t1.code";
        $sql .= ",t2.code as states_code";
        $sql .= ",t3.code as locations_code";
        $sql .= " from";
        $sql .= " listings t1";
        $sql .= " left join";
        $sql .= " states t2";
        $sql .= " on";
        $sql .= " ( t1.states_id = t2.id )";
        $sql .= " left join";
        $sql .= " locations t3";
        $sql .= " on";
        $sql .= " ( t1.locations_id = t3.id )";
        $sql .= " where";
        $sql .= " t1.id = " . $id;
	$result = mysql_query($sql);
	$arr = mysql_fetch_array( $result );
	$url = "/" . $arr['states_code'] . "/" . $arr['code'] . "-in-" . $arr['locations_code'];
	return $url;
}
function listings_update_urls($id){
	$sql = "select";
	$sql .= " t2.id";
	$sql .= " from";
	$sql .= " listings_urls t1";
	$sql .= " left join";
	$sql .= " urls t2";
	$sql .= " on";
	$sql .= " (t1.urls_id = t2.id)";
	$sql .= " where";
	$sql .= " t1.listings_id = " . $id;
	$sql .= " and";
	$sql .= " t2.type = 'detail'";
	$result = mysql_query($sql);
	while( $arr = mysql_fetch_array( $result )){
		$sql_upd = "update urls set";
		$sql_upd .= " modified = now()";
		$sql_upd .= " where";
		$sql_upd .= " id = " . $arr['id'];
		common_exec_sql($sql_upd);
	}
	return;
}
?>
