<?php
function listings_index( $lines ){
        //check child
        $companies_id = $_SESSION['external_users_companies_id'];
        $sql = "select";
        $sql .= " published_range_of_inquiry";
        $sql .= " from";
        $sql .= " external_users";
        $sql .= " where";
        $sql .= " id = " . $_SESSION['external_users_id'];
        $result = mysql_query( $sql );
        $arr=mysql_fetch_array($result);
        if(!empty($arr['published_range_of_inquiry'])){
                $companies_id .= "," . $arr['published_range_of_inquiry'];
        }

	$sql = "select";
	$sql .= " t1.*";
	$sql .= ",t3.code as states_code";
	$sql .= ",t4.code as locations_code";
	$sql .= " from";
	$sql .= " listings t1";
	$sql .= " left join";
	$sql .= " companies t2";
	$sql .= " on";
	$sql .= " ( t1.companies_id = t2.id )";
	$sql .= " left join";
	$sql .= " states t3";
	$sql .= " on";
	$sql .= " ( t1.states_id = t3.id )";
	$sql .= " left join";
	$sql .= " locations t4";
	$sql .= " on";
	$sql .= " ( t1.locations_id = t4.id )";
	$sql .= " where";
	$sql .= " t1.companies_id in (" . $companies_id . ")";
	$sql .= " and";
	$sql .= " t1.is_deleted = 0";
	if(strpos($_SERVER['SCRIPT_NAME'],"/listings/")!==false){
		if(!empty( $_SESSION['listings']['id'])){
			$sql .= " and";
			$sql .= " t1.id like '%" . mysql_real_escape_string($_SESSION['listings']['id']) . "%'";
		}
		if(!empty( $_SESSION['listings']['name'])){
			$sql .= " and";
			$sql .= " t1.name like '%" . mysql_real_escape_string($_SESSION['listings']['name']) . "%'";
		}
		if(!empty( $_SESSION['listings']['companies_id'])){
			$sql .= " and";
			$sql .= " t2.name like '%" . mysql_real_escape_string($_SESSION['listings']['companies_id']) . "%'";
		}
		if(!empty( $_SESSION['listings']['property_name'])){
			$sql .= " and";
			$sql .= " t1.property_name like '%" . mysql_real_escape_string($_SESSION['listings']['property_name']) . "%'";
		}
		if(!empty( $_SESSION['listings']['status'])){
			$sql .= " and";
			$sql .= " t1.status = '" . $_SESSION['listings']['status'] . "'";
		}
	}
	$sql .= " order by t1.id desc";
	if(!empty($lines)){
		if(empty($_REQUEST['page'])){
			$offset = 0;
		}else{
			$offset = ($_REQUEST['page']-1) * $lines;
		}
		$sql .= " limit " . $lines . " offset " . $offset;
	}
	return mysql_query($sql);
}
?>
