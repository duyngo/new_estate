<?php
function listings_index( $lines ){
	$sql = "select";
	$sql .= " t1.*";
	$sql .= " from";
	$sql .= " listings t1";
	$sql .= " left join";
	$sql .= " companies t2";
	$sql .= " on";
	$sql .= " ( t1.companies_id = t2.id )";
	$sql .= " left join";
	$sql .= " companies t3";
	$sql .= " on";
	$sql .= " ( t1.billing_id = t3.id )";
	$sql .= " where";
	$sql .= " t1.is_deleted = 0";
	if(strpos($_SERVER['SCRIPT_NAME'],"/listings/")!==false){
		if(!empty( $_SESSION['listings']['id'])){
			$sql .= " and";
			$sql .= " t1.id like '%" . mysql_real_escape_string($_SESSION['listings']['id']) . "%'";
		}
		if(!empty( $_SESSION['listings']['evernote_id'])){
			$sql .= " and";
			$sql .= " t1.evernote_id like '%" . mysql_real_escape_string($_SESSION['listings']['evernote_id']) . "%'";
		}
		if(!empty( $_SESSION['listings']['name'])){
			$sql .= " and";
			$sql .= " t1.name like '%" . mysql_real_escape_string($_SESSION['listings']['name']) . "%'";
		}
		if(!empty( $_SESSION['listings']['companies_id'])){
			$sql .= " and";
			$sql .= " t2.name like '%" . mysql_real_escape_string($_SESSION['listings']['companies_id']) . "%'";
		}
		if(!empty( $_SESSION['listings']['billing_id'])){
			$sql .= " and";
			$sql .= " t3.name like '%" . mysql_real_escape_string($_SESSION['listings']['billing_id']) . "%'";
		}
		if(!empty( $_SESSION['listings']['states_id'])){
			$sql .= " and";
			$sql .= " t1.states_id = " . $_SESSION['listings']['states_id'];
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
	//$sql .= " order by field(t1.status,'current','upcoming','archived','completed'),t1.monthly_enquiry_limit desc,t1.achievement_rate = 0 ASC,t1.achievement_rate asc,t1.search_rank desc,t1.modified desc";
	$sql .= " order by field(t1.status,'current','upcoming','archived','completed'),t1.monthly_enquiry_limit desc,t1.achievement_rate asc,t1.search_rank desc,t1.modified desc";
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
function listings_insert(){
	$sql = "insert into listings(";
	$sql .= " evernote_id";
	$sql .= ",name";
	$sql .= ",code";
	$sql .= ",companies_id";
	$sql .= ",developer_id";
	$sql .= ",billing_id";
	$sql .= ",states_id";
	$sql .= ",groups_id";
	$sql .= ",locations_id";
	$sql .= ",property_types_id";
	$sql .= ",property_name";
	$sql .= ",prices_id";
	$sql .= ",price_name";
	$sql .= ",price_minimum";
	$sql .= ",price_minimum_per_sqft";
	$sql .= ",features_id";
	$sql .= ",catch_copy";
	$sql .= ",image_path";
	$sql .= ",main_picture";
	$sql .= ",address";
	$sql .= ",latitude";
	$sql .= ",longitude";
	$sql .= ",completion_years_id";
	$sql .= ",completion_year";
	$sql .= ",bedrooms_id";
	$sql .= ",sizes_id";
	$sql .= ",tenures_id";
	$sql .= ",sales_garellies_id";
	$sql .= ",youtube_url";
	$sql .= ",type";
	$sql .= ",search_rank";
	$sql .= ",status";
	$sql .= ",posted_date";
	$sql .= ",expiry_date";
	$sql .= ",launch_date";
	$sql .= ",monthly_enquiry_limit";
	$sql .= ",service_fee";
	$sql .= ",call_option";
	$sql .= ",contact_no";
	$sql .= ",charge_type";
	$sql .= ",fixed_fee";
	$sql .= ",call_option_fee";
	$sql .= ",created";
	$sql .= ",created_by";
	$sql .= ",modified";
	$sql .= ",modified_by";
	$sql .= ")values(";
	$sql .= " '" . mysql_real_escape_string( $_POST['evernote_id'] ) . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['name'] ) . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['code'] ) . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['companies_id'] ) . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['developer_id'] ) . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['billing_id'] ) . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['states_id'] ) . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['groups_id'] ) . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['locations_id'] ) . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['property_types_id'] ) . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['property_name'] ) . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['prices_id'] ) . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['price_name'] ) . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['price_minimum'] ) . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['price_minimum_per_sqft'] ) . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['features_id'] ) . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['catch_copy'] ) . "'";
	$sql .= ",'" . $_SESSION['listings']['image_path'] . "'";
	$sql .= ",'" . $_SESSION['listings']['main_picture'] . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['address'] ) . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['latitude'] ) . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['longitude'] ) . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['completion_years_id'] ) . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['completion_year'] ) . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['bedrooms_id'] ) . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['sizes_id'] ) . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['tenures_id'] ) . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['sales_garellies_id'] ) . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['youtube_url'] ) . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['type'] ) . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['search_rank'] ) . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['status'] ) . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['posted_date'] ) . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['expiry_date'] ) . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['launch_date'] ) . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['monthly_enquiry_limit'] ) . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['service_fee'] ) . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['call_option'] ) . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['contact_no'] ) . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['charge_type'] ) . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['fixed_fee'] ) . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['call_option_fee'] ) . "'";
	$sql .= ",now()";
	$sql .= ",'" . $_SESSION['users_id'] . "'";
	$sql .= ",now()";
	$sql .= ",'" . $_SESSION['users_id'] . "'";
	$sql .= ")";
	common_exec_sql($sql);
	return common_get_max("listings");
}
function listings_update(){
	$sql = "update listings set";
	$sql .= " evernote_id = '" . mysql_real_escape_string( $_POST['evernote_id'] ) . "'";
	$sql .= ",name = '" . mysql_real_escape_string( $_POST['name'] ) . "'";
	$sql .= ",code = '" . mysql_real_escape_string( $_POST['code'] ) . "'";
	$sql .= ",companies_id = '" . mysql_real_escape_string( $_POST['companies_id'] ) . "'";
	$sql .= ",developer_id = '" . mysql_real_escape_string( $_POST['developer_id'] ) . "'";
	$sql .= ",billing_id = '" . mysql_real_escape_string( $_POST['billing_id'] ) . "'";
	$sql .= ",states_id = '" . mysql_real_escape_string( $_POST['states_id'] ) . "'";
	$sql .= ",groups_id = '" . mysql_real_escape_string( $_POST['groups_id'] ) . "'";
	$sql .= ",locations_id = '" . mysql_real_escape_string( $_POST['locations_id'] ) . "'";
	$sql .= ",property_types_id = '" . mysql_real_escape_string( $_POST['property_types_id'] ) . "'";
	$sql .= ",property_name = '" . mysql_real_escape_string( $_POST['property_name'] ) . "'";
	$sql .= ",prices_id = '" . mysql_real_escape_string( $_POST['prices_id'] ) . "'";
	$sql .= ",price_name = '" . mysql_real_escape_string( $_POST['price_name'] ) . "'";
	$sql .= ",price_minimum = '" . mysql_real_escape_string( $_POST['price_minimum'] ) . "'";
	$sql .= ",price_minimum_per_sqft = '" . mysql_real_escape_string( $_POST['price_minimum_per_sqft'] ) . "'";
	$sql .= ",features_id = '" . mysql_real_escape_string( $_POST['features_id'] ) . "'";
	$sql .= ",catch_copy = '" . mysql_real_escape_string( $_POST['catch_copy'] ) . "'";
	$sql .= ",image_path = '" . $_SESSION['listings']['image_path'] . "'";
	$sql .= ",main_picture = '" . $_SESSION['listings']['main_picture'] . "'";
	$sql .= ",address = '" . mysql_real_escape_string( $_POST['address'] ) . "'";
	$sql .= ",latitude = '" . mysql_real_escape_string( $_POST['latitude'] ) . "'";
	$sql .= ",longitude = '" . mysql_real_escape_string( $_POST['longitude'] ) . "'";
	$sql .= ",completion_years_id = '" . mysql_real_escape_string( $_POST['completion_years_id'] ) . "'";
	$sql .= ",completion_year = '" . mysql_real_escape_string( $_POST['completion_year'] ) . "'";
	$sql .= ",bedrooms_id = '" . mysql_real_escape_string( $_POST['bedrooms_id'] ) . "'";
	$sql .= ",sizes_id = '" . mysql_real_escape_string( $_POST['sizes_id'] ) . "'";
	$sql .= ",tenures_id = '" . mysql_real_escape_string( $_POST['tenures_id'] ) . "'";
	$sql .= ",sales_garellies_id = '" . mysql_real_escape_string( $_POST['sales_garellies_id'] ) . "'";
	$sql .= ",youtube_url = '" . mysql_real_escape_string( $_POST['youtube_url'] ) . "'";
	$sql .= ",type = '" . mysql_real_escape_string( $_POST['type'] ) . "'";
	$sql .= ",search_rank = '" . mysql_real_escape_string( $_POST['search_rank'] ) . "'";
	$sql .= ",status = '" . mysql_real_escape_string( $_POST['status'] ) . "'";
	$sql .= ",posted_date = '" . mysql_real_escape_string( $_POST['posted_date'] ) . "'";
	$sql .= ",expiry_date = '" . mysql_real_escape_string( $_POST['expiry_date'] ) . "'";
	$sql .= ",launch_date = '" . mysql_real_escape_string( $_POST['launch_date'] ) . "'";
	$sql .= ",monthly_enquiry_limit = '" . mysql_real_escape_string( $_POST['monthly_enquiry_limit'] ) . "'";
	$sql .= ",service_fee = '" . mysql_real_escape_string( $_POST['service_fee'] ) . "'";
	$sql .= ",call_option = '" . mysql_real_escape_string( $_POST['call_option'] ) . "'";
	$sql .= ",contact_no = '" . mysql_real_escape_string( $_POST['contact_no'] ) . "'";
	$sql .= ",charge_type = '" . mysql_real_escape_string( $_POST['charge_type'] ) . "'";
	$sql .= ",fixed_fee = '" . mysql_real_escape_string( $_POST['fixed_fee'] ) . "'";
	$sql .= ",call_option_fee = '" . mysql_real_escape_string( $_POST['call_option_fee'] ) . "'";
	$sql .= ",modified = now()";
	$sql .= ",modified_by = " . $_SESSION['users_id'];
	$sql .= " where";
	$sql .= " id = " . $_POST['id'];
	common_exec_sql($sql);
	return;
}
function listings_delete( $id ){
	$sql = "update listings set";
	$sql .= " is_deleted = 1 ";
	$sql .= ",modified = now()";
	$sql .= ",modified_by = " . $_SESSION['users_id'];
	$sql .= " where";
	$sql .= " id = " . $id;
	common_exec_sql($sql);
	return;
}
function listings_listings_photos_index( $listings_id ){
	$sql = "select";
	$sql .= " t1.*";
	$sql .= " from";
	$sql .= " listings_photos t1";
	$sql .= " where";
	$sql .= " t1.listings_id = $listings_id";
	$sql .= " and";
	$sql .= " t1.is_deleted = 0";
	$sql .= " order by t1.sort";
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
function listings_listings_project_details_index( $listings_id ){
	$sql = "select";
	$sql .= " t1.*";
	$sql .= " from";
	$sql .= " listings_project_details t1";
	$sql .= " where";
	$sql .= " t1.listings_id = $listings_id";
	$sql .= " and";
	$sql .= " t1.is_deleted = 0";
	if(!empty( $_SESSION['listings']['listings_project_details']['head'])){
		$sql .= " and";
		$sql .= " t1.head like '%" . mysql_real_escape_string($_SESSION['listings']['listings_project_details']['head']) . "%'";
	}
	if(!empty( $_SESSION['listings']['listings_project_details']['sub_head'])){
		$sql .= " and";
		$sql .= " t1.sub_head like '%" . mysql_real_escape_string($_SESSION['listings']['listings_project_details']['sub_head']) . "%'";
	}
	if(!empty( $_SESSION['listings']['listings_project_details']['body'])){
		$sql .= " and";
		$sql .= " t1.body like '%" . mysql_real_escape_string($_SESSION['listings']['listings_project_details']['body']) . "%'";
	}
	$sql .= " order by t1.sort";
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
function listings_listings_plans_index( $listings_id ){
	$sql = "select";
	$sql .= " t1.*";
	$sql .= " from";
	$sql .= " listings_plans t1";
	$sql .= " where";
	$sql .= " t1.listings_id = $listings_id";
	$sql .= " and";
	$sql .= " t1.is_deleted = 0";
	if(!empty( $_SESSION['listings']['listings_plans']['name'])){
		$sql .= " and";
		$sql .= " t1.name like '%" . mysql_real_escape_string($_SESSION['listings']['listings_plans']['name']) . "%'";
	}
	if(!empty( $_SESSION['listings']['listings_plans']['display_flag'])){
		$sql .= " and";
		$sql .= " t1.display_flag like '%" . $_SESSION['listings']['listings_plans']['display_flag'] . "%'";
	}
	$sql .= " order by t1.sort";
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
function listings_listings_amenities_index( $listings_id ){
	$sql = "select";
	$sql .= " t1.*";
	$sql .= " from";
	$sql .= " listings_amenities t1";
	$sql .= " where";
	$sql .= " t1.listings_id = $listings_id";
	$sql .= " and";
	$sql .= " t1.is_deleted = 0";
	if(!empty( $_SESSION['listings']['listings_amenities']['amenities_id'])){
		$sql .= " and";
		$sql .= " t1.amenities_id like '%" . $_SESSION['listings']['listings_amenities']['amenities_id'] . "%'";
	}
	if(!empty( $_SESSION['listings']['listings_amenities']['display_flag'])){
		$sql .= " and";
		$sql .= " t1.display_flag like '%" . $_SESSION['listings']['listings_amenities']['display_flag'] . "%'";
	}
	$sql .= " order by t1.sort";
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
function listings_listings_enquiries_index( $listings_id ){
	$sql = "select";
	$sql .= " t1.*";
	$sql .= " from";
	$sql .= " listings_enquiries t1";
	$sql .= " where";
	$sql .= " t1.listings_id = $listings_id";
	$sql .= " and";
	$sql .= " t1.is_deleted = 0";
	if(!empty( $_SESSION['listings']['listings_enquiries']['id'])){
		$sql .= " and";
		$sql .= " t1.id like '%" . mysql_real_escape_string($_SESSION['listings']['listings_enquiries']['id']) . "%'";
	}
	if(!empty( $_SESSION['listings']['listings_enquiries']['status'])){
		$sql .= " and";
		$sql .= " t1.status like '%" . $_SESSION['listings']['listings_enquiries']['status'] . "%'";
	}
	if(!empty( $_SESSION['listings']['listings_enquiries']['name'])){
		$sql .= " and";
		$sql .= " t1.name like '%" . mysql_real_escape_string($_SESSION['listings']['listings_enquiries']['name']) . "%'";
	}
	if(!empty( $_SESSION['listings']['listings_enquiries']['email'])){
		$sql .= " and";
		$sql .= " t1.email like '%" . mysql_real_escape_string($_SESSION['listings']['listings_enquiries']['email']) . "%'";
	}
	if(!empty( $_SESSION['listings']['listings_enquiries']['phone'])){
		$sql .= " and";
		$sql .= " t1.phone like '%" . mysql_real_escape_string($_SESSION['listings']['listings_enquiries']['phone']) . "%'";
	}
	if(!empty( $_SESSION['listings']['listings_enquiries']['send_date'])){
		$sql .= " and";
		$sql .= " t1.send_date like '%" . $_SESSION['listings']['listings_enquiries']['send_date'] . "%'";
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
function listings_err_check( $column_name ){
	$err_msg = NULL;
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
	if(empty($column_name)||$column_name=="code"){
		if(empty($_POST['code'])){
			$err_msg .= "<li><a href=\"#code\">Please Enter [code(Used as part of URL)]</a></li>";
		}
		if(!empty($_POST['code'])){
			if(mb_strlen($_POST['code'],"UTF-8") > 64){
				$err_msg .= "<li><a href=\"#code\">Please Enter [code(Used as part of URL)] within 64 characters.</a></li>";
			}else{
				$sql = "select";
				$sql .= " *";
				$sql .= " from";
				$sql .= " listings";
				$sql .= " where";
				if(!empty($_POST['id'])){
					$sql .= " id <> " . $_POST['id'];
					$sql .= " and";
				}
				$sql .= " code = '" . $_POST['code']. "'";
				$sql .= " and";
				$sql .= " is_deleted = 0";
				$result = mysql_query( $sql );
				if(mysql_num_rows($result)){
					$err_msg .= "<li><a href=\"#code\">This code is already used.</a></li>";
				}
			}
		}
	}
	if(empty($column_name)||$column_name=="companies_id"){
		if(empty($_POST['companies_id'])){
			$err_msg .= "<li><a href=\"#companies_id\">Please Enter [Company]</a></li>";
		}
	}
	if(empty($column_name)||$column_name=="developer_id"){
		if(empty($_POST['developer_id'])){
			$err_msg .= "<li><a href=\"#developer_id\">Please Enter [Developer]</a></li>";
		}
	}
	if(empty($column_name)||$column_name=="billing_id"){
		if(empty($_POST['billing_id'])){
			$err_msg .= "<li><a href=\"#billing_id\">Please Enter [Billing Company]</a></li>";
		}
	}
	if(empty($column_name)||$column_name=="states_id"){
		if(empty($_POST['states_id'])){
			$err_msg .= "<li><a href=\"#states_id\">Please Enter [Area > State]</a></li>";
		}
	}
	if(empty($column_name)||$column_name=="groups_id"){
	}
	if(empty($column_name)||$column_name=="locations_id"){
		if(empty($_POST['locations_id'])){
			$err_msg .= "<li><a href=\"#locations_id\">Please Enter [Area > Location]</a></li>";
		}
	}
	if(empty($column_name)||$column_name=="property_types_id"){
		if(empty($_POST['property_types_id'])){
			$err_msg .= "<li><a href=\"#property_types_id\">Please Enter [Property type(for search)]</a></li>";
		}
	}
	if(empty($column_name)||$column_name=="property_name"){
		if(!empty($_POST['property_name'])){
			if(mb_strlen($_POST['property_name'],"UTF-8") > 128){
				$err_msg .= "<li><a href=\"#property_name\">Please Enter [PropertyName] within 128 characters.</a></li>";
			}
		}
	}
	if(empty($column_name)||$column_name=="prices_id"){
	}
	if(empty($column_name)||$column_name=="price_name"){
	}
	if(empty($column_name)||$column_name=="price_minimum"){
		if(!empty($_POST['price_minimum'])){
			if(!preg_match("/^[0-9]+$/", $_POST['price_minimum'])){
				$err_msg .= "<li><a href=\"#price_minimum\">Please Enter [Minimum Price] in [0-9]</a></li>";
			}
		}
		if(!empty($_POST['price_minimum'])){
			if(mb_strlen($_POST['price_minimum'],"UTF-8") > 10){
				$err_msg .= "<li><a href=\"#price_minimum\">Please Enter [Minimum Price] within 10 characters.</a></li>";
			}
		}
	}
	if(empty($column_name)||$column_name=="price_minimum_per_sqft"){
		if(!empty($_POST['price_minimum_per_sqft'])){
			if(!preg_match("/^[0-9.]+$/", $_POST['price_minimum_per_sqft'])){
				$err_msg .= "<li><a href=\"#price_minimum_per_sqft\">Please Enter [Minimum Price per sqft] in [0-9.]</a></li>";
			}
		}
		if(!empty($_POST['price_minimum_per_sqft'])){
			if(mb_strlen($_POST['price_minimum_per_sqft'],"UTF-8") > 11){
				$err_msg .= "<li><a href=\"#price_minimum_per_sqft\">Please Enter [Minimum Price per sqft] within 11 characters.</a></li>";
			}
		}
	}
	if(empty($column_name)||$column_name=="features_id"){
	}
	if(empty($column_name)||$column_name=="catch_copy"){
	}
	if(empty($column_name)||$column_name=="image_path"){
		if(!empty($_FILES['image_path']["name"])){	//新たに画像がアップされた
			//強制的に過去ファイルを削除する
			admin_common_image_delete("listings","image_path",$_SESSION['listings']['image_path']);
			$upload_msg = admin_common_image_upload("listings","image_path");
			if($upload_msg){
				$err_msg .= "<li><a href=\"#image_path\">" . $upload_msg . "</a></li>";
			}
		}else{
			if( $_POST['image_path'] == "delete" ){
				admin_common_image_delete("listings","image_path",$_SESSION['listings']['image_path']);
			}
		}
	}
	if(empty($column_name)||$column_name=="main_picture"){
		if(!empty($_FILES['main_picture']["name"])){
			admin_common_image_delete("listings","main_picture",$_SESSION['listings']['main_picture']);
			$upload_msg = admin_common_image_upload("listings","main_picture");
			if($upload_msg){
				$err_msg .= "<li><a href=\"#main_picture\">" . $upload_msg . "</a></li>";
			}
		}else{
			if( $_POST['main_picture'] == "delete" ){
				admin_common_image_delete("listings","main_picture",$_SESSION['listings']['main_picture']);
			}
		}
	}
	if(empty($column_name)||$column_name=="address"){
		if(empty($_POST['address'])){
			$err_msg .= "<li><a href=\"#address\">Please Enter [Address]</a></li>";
		}
		if(!empty($_POST['address'])){
			if(mb_strlen($_POST['address'],"UTF-8") > 128){
				$err_msg .= "<li><a href=\"#address\">Please Enter [Address] within 128 characters.</a></li>";
			}
		}
	}
	if(empty($column_name)||$column_name=="latitude"){
		if(!empty($_POST['latitude'])){
			if(!preg_match("/^[0-9.]{8,11}+$/", $_POST['latitude'])){
				$err_msg .= "<li><a href=\"#latitude\">Please Enter [Latitude] in [0-9.]{8,11}</a></li>";
			}
		}
		if(!empty($_POST['latitude'])){
			if(mb_strlen($_POST['latitude'],"UTF-8") > 11){
				$err_msg .= "<li><a href=\"#latitude\">Please Enter [Latitude] within 11 characters.</a></li>";
			}
		}
	}
	if(empty($column_name)||$column_name=="longitude"){
		if(!empty($_POST['longitude'])){
			if(!preg_match("/^[0-9.]{8,11}+$/", $_POST['longitude'])){
				$err_msg .= "<li><a href=\"#longitude\">Please Enter [Longitude] in [0-9.]{8,11}</a></li>";
			}
		}
		if(!empty($_POST['longitude'])){
			if(mb_strlen($_POST['longitude'],"UTF-8") > 11){
				$err_msg .= "<li><a href=\"#longitude\">Please Enter [Longitude] within 11 characters.</a></li>";
			}
		}
	}
	if(empty($column_name)||$column_name=="completion_years_id"){
	}
	if(empty($column_name)||$column_name=="completion_year"){
		if(!empty($_POST['completion_year'])){
			if(mb_strlen($_POST['completion_year'],"UTF-8") > 64){
				$err_msg .= "<li><a href=\"#completion_year\">Please Enter [Completion year] within 64 characters.</a></li>";
			}
		}
	}
	if(empty($column_name)||$column_name=="bedrooms_id"){
	}
	if(empty($column_name)||$column_name=="sizes_id"){
	}
	if(empty($column_name)||$column_name=="sales_garellies_id"){
	}
	if(empty($column_name)||$column_name=="youtube_url"){
	}
	if(empty($column_name)||$column_name=="type"){
		if(empty($_POST['type'])){
			$err_msg .= "<li><a href=\"#type\">Please Enter [ListingType]</a></li>";
		}
	}
	if(empty($column_name)||$column_name=="search_rank"){
		if(empty($_POST['search_rank'])){
			$err_msg .= "<li><a href=\"#search_rank\">Please Enter [SearchRank]</a></li>";
		}
	}
	if(empty($column_name)||$column_name=="status"){
		if(empty($_POST['status'])){
			$err_msg .= "<li><a href=\"#status\">Please Enter [Status]</a></li>";
		}
	}
	if(empty($column_name)||$column_name=="posted_date"){
	}
	if(empty($column_name)||$column_name=="expiry_date"){
	}
	if(empty($column_name)||$column_name=="monthly_enquiry_limit"){
		if(!empty($_POST['monthly_enquiry_limit'])){
			if(!preg_match("/^[0-9]+$/", $_POST['monthly_enquiry_limit'])){
				$err_msg .= "<li><a href=\"#monthly_enquiry_limit\">Please Enter [Monthly enquiry limit] in [0-9]</a></li>";
			}
		}
		if(!empty($_POST['monthly_enquiry_limit'])){
			if(mb_strlen($_POST['monthly_enquiry_limit'],"UTF-8") > 10){
				$err_msg .= "<li><a href=\"#monthly_enquiry_limit\">Please Enter [Monthly enquiry limit] within 10 characters.</a></li>";
			}
		}
	}
	return $err_msg;
}
?>
