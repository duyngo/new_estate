<?php
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
			$result2 = mysql_query($sql2);
			$arr2 = mysql_fetch_array( $result2 );

			$sql_upd = "update $tables_name set";
			$sql_upd .= " listings_num = '" . $arr2['listings_num'] . "'";
			$sql_upd .= ",modified = now()";
			$sql_upd .= ",modified_by = " . $_SESSION['users_id'];
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
                $sql_upd .= ",modified = now()";
                $sql_upd .= ",modified_by = " . $_SESSION['users_id'];
                $sql_upd .= " where";
                $sql_upd .= " id = " . $arr['property_type_groups_id'];
                common_exec_sql($sql_upd);
        }
	return;
}
?>
