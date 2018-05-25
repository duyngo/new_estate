<?php
function listings_enquiries_index( $lines ){
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
	$sql .= " from";
	$sql .= " listings_enquiries t1";
	$sql .= " left join";
	$sql .= " listings t2";
	$sql .= " on";
	$sql .= " (t1.listings_id = t2.id)";
	$sql .= " where";
	$sql .= " t1.is_deleted = 0";
	$sql .= " and";
	$sql .= " t1.send_date <> '0000-00-00 00:00:00'";
	$sql .= " and";
	$sql .= " t2.companies_id in (" . $companies_id . ")";
	$sql .= " ";
	if(strpos($_SERVER['SCRIPT_NAME'],"/listings_enquiries/")!==false){
		if(!empty( $_SESSION['listings_enquiries']['name'])){
			$sql .= " and";
			$sql .= " t1.name like '%" . mysql_real_escape_string($_SESSION['listings_enquiries']['name']) . "%'";
		}
		if(!empty( $_SESSION['listings_enquiries']['email'])){
			$sql .= " and";
			$sql .= " t1.email like '%" . mysql_real_escape_string($_SESSION['listings_enquiries']['email']) . "%'";
		}
		if(!empty( $_SESSION['listings_enquiries']['phone'])){
			$sql .= " and";
			$sql .= " t1.phone like '%" . mysql_real_escape_string($_SESSION['listings_enquiries']['phone']) . "%'";
		}
	}
	$sql .= " order by t1.created desc";
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
function listings_enquiries_insert(){
	$sql = "insert into listings_enquiries(";
	$sql .= " listings_id";
	$sql .= ",members_id";
	$sql .= ",name";
	$sql .= ",email";
	$sql .= ",phone";
	$sql .= ",good_point";
	$sql .= ",contact_type";
	$sql .= ",nationality";
	$sql .= ",created";
	$sql .= ",created";
	$sql .= ",created_by";
	$sql .= ",modified";
	$sql .= ",modified_by";
	$sql .= ")values(";
	$sql .= " '" . mysql_real_escape_string( $_POST['listings_id'] ) . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['members_id'] ) . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['name'] ) . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['email'] ) . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['phone'] ) . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['good_point'] ) . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['contact_type'] ) . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['nationality'] ) . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['created'] ) . "'";
	$sql .= ",now()";
	$sql .= ",'" . $_SESSION['users_id'] . "'";
	$sql .= ",now()";
	$sql .= ",'" . $_SESSION['users_id'] . "'";
	$sql .= ")";
	common_exec_sql($sql);
	return common_get_max("listings_enquiries");
}
function listings_enquiries_update(){
	$sql = "update listings_enquiries set";
	$sql .= " listings_id = '" . mysql_real_escape_string( $_POST['listings_id'] ) . "'";
	$sql .= ",members_id = '" . mysql_real_escape_string( $_POST['members_id'] ) . "'";
	$sql .= ",name = '" . mysql_real_escape_string( $_POST['name'] ) . "'";
	$sql .= ",email = '" . mysql_real_escape_string( $_POST['email'] ) . "'";
	$sql .= ",phone = '" . mysql_real_escape_string( $_POST['phone'] ) . "'";
	$sql .= ",good_point = '" . mysql_real_escape_string( $_POST['good_point'] ) . "'";
	$sql .= ",contact_type = '" . mysql_real_escape_string( $_POST['contact_type'] ) . "'";
	$sql .= ",nationality = '" . mysql_real_escape_string( $_POST['nationality'] ) . "'";
	$sql .= ",created = '" . mysql_real_escape_string( $_POST['created'] ) . "'";
	$sql .= ",modified = now()";
	$sql .= ",modified_by = " . $_SESSION['users_id'];
	$sql .= " where";
	$sql .= " id = " . $_POST['id'];
	common_exec_sql($sql);
	return;
}
function listings_enquiries_delete( $id ){
	$sql = "update listings_enquiries set";
	$sql .= " is_deleted = 1 ";
	$sql .= ",modified = now()";
	$sql .= ",modified_by = " . $_SESSION['users_id'];
	$sql .= " where";
	$sql .= " id = " . $id;
	common_exec_sql($sql);
	return;
}
function listings_enquiries_err_check( $column_name ){
	$err_msg = NULL;
	if(empty($column_name)||$column_name=="listings_id"){
		if(empty($_POST['listings_id'])){
			$err_msg .= "<li><a href=\"#listings_id\">Please Enter [Listings]</a></li>";
		}
	}
	if(empty($column_name)||$column_name=="members_id"){
		if(empty($_POST['members_id'])){
			$err_msg .= "<li><a href=\"#members_id\">Please Enter [Member]</a></li>";
		}
	}
	if(empty($column_name)||$column_name=="name"){
		if(empty($_POST['name'])){
			$err_msg .= "<li><a href=\"#name\">Please Enter [Name]</a></li>";
		}
		if(!empty($_POST['name'])){
			if(mb_strlen($_POST['name'],"UTF-8") > 128){
				$err_msg .= "<li><a href=\"#name\">Please Enter [Name] within 128 characters.</a></li>";
			}
		}
	}
	if(empty($column_name)||$column_name=="email"){
		if(empty($_POST['email'])){
			$err_msg .= "<li><a href=\"#email\">Please Enter [Email]</a></li>";
		}
		if(!empty($_POST['email'])){
			if(mb_strlen($_POST['email'],"UTF-8") > 128){
				$err_msg .= "<li><a href=\"#email\">Please Enter [Email] within 128 characters.</a></li>";
			}
		}
	}
	if(empty($column_name)||$column_name=="phone"){
		if(empty($_POST['phone'])){
			$err_msg .= "<li><a href=\"#phone\">Please Enter [Phone]</a></li>";
		}
		if(!empty($_POST['phone'])){
			if(mb_strlen($_POST['phone'],"UTF-8") > 64){
				$err_msg .= "<li><a href=\"#phone\">Please Enter [Phone] within 64 characters.</a></li>";
			}
		}
	}
	if(empty($column_name)||$column_name=="good_point"){
	}
	if(empty($column_name)||$column_name=="contact_type"){
		if(empty($_POST['contact_type'])){
			$err_msg .= "<li><a href=\"#contact_type\">Please Enter [Contact me via]</a></li>";
		}
	}
	if(empty($column_name)||$column_name=="nationality"){
		if(empty($_POST['nationality'])){
			$err_msg .= "<li><a href=\"#nationality\">Please Enter [Nationality]</a></li>";
		}
	}
	if(empty($column_name)||$column_name=="created"){
		if(empty($_POST['created'])){
			$err_msg .= "<li><a href=\"#created\">Please Enter [EnquiryDate]</a></li>";
		}
	}
	return $err_msg;
}
function client_listings_enquiries_change_contact_type($str){
        $rtn = NULL;
        $tmp_arr = explode(",",$str);
        foreach($tmp_arr as $key){
		if(!empty($rtn)){
			$rtn .= ",";
		}
                $rtn .= $GLOBALS['listings_enquiries_contact_type_list'][$key];
        }
        return $rtn;
}
?>
