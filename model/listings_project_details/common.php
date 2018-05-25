<?php
function listings_project_details_get_body( $listings_id ){
	$body = NULL;
	$sql = "select";
	$sql .= " *";
	$sql .= " from";
	$sql .= " listings_project_details";
	$sql .= " where";
	$sql .= " listings_id = $listings_id";
	$sql .= " order by sort";
	$sql .= " limit 1";
	$result = mysql_query($sql);
	if( mysql_num_rows( $result )){
		$arr = mysql_fetch_array( $result );
		$body = $arr['body'];
		$body = substr($body,0,200) . "...";
	}
	return $body;
}
?>
