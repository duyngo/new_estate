<?php
function companies_get_external_users( $id ){
	$str = array();
	$sql = "select";
	$sql .= " concat(first_name,\" \",last_name) as name";
	$sql .= " from";
	$sql .= " external_users";
	$sql .= " where";
	$sql .= " companies_id = $id";
	$sql .= " and";
	$sql .= " is_deleted = 0";
	$result = mysql_query( $sql );
	if(mysql_num_rows($result)){
		while( $arr = mysql_fetch_array( $result )){
			$str[] = $arr['name'];
		}
	}
	return implode(",",$str);
}
//for parent
function companies_index2(){
        $sql = "select";
        $sql .= " t1.*";
        $sql .= " from";
        $sql .= " companies t1";
        $sql .= " where";
        $sql .= " t1.is_deleted = 0";
        $sql .= " order by t1.name";
        return mysql_query($sql);
}
?>
