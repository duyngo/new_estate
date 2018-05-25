<?php include "../../../controller/admin/listings/edit.php"; ?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Listing Add/Edit</title>
<meta charset="utf-8">
<meta name="description" content="">
<meta name="author" content="">
<link rel="stylesheet" href="/admin/css/import.css">
<script src="/admin/js/common.js"></script>
<script type="text/javascript" language="javascript" src="/admin/js/jquery.dropdownPlain.js"></script>
<script type="text/javascript" src="/admin/js/jquery.js"></script>
<script type="text/javascript" src="/admin/js/placeholder.js"></script>
<script type="text/javascript" src="/admin/js/sortable.js"></script>
<script type="text/javascript" src="/admin/js/function.js"></script>

<!--script type="text/javascript" src="/admin/js/jquery-1.9.1.min.js"></script-->
<script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
<script src="/admin/js/chosen.jquery.js"></script>
<script type="text/javascript">
$(function(){
	$(".companies_id").chosen();
});
</script>
<script type="text/javascript">
$(function(){
	$(".developer_id").chosen();
});
</script>
<script type="text/javascript">
$(function(){
	$(".billing_id").chosen();
});
</script>
<script type="text/javascript">
$(function(){
	$(".states_id").chosen();
});
</script>
<script type="text/javascript">
$(function(){
	$('select[name="states_id"]').change(function() {
		var states_id = $('select[name="states_id"] option:selected').attr("class");
		var count = $('select[name="groups_id"]').children().length;
		for (var i=0; i<count; i++) {
			var groups_id = $('select[name="groups_id"] option:eq(' + i + ')');
			if(groups_id.attr("class") === states_id) {
				groups_id.show();
			}else {
                                if(groups_id.attr("class") === "msg") {
					groups_id.show(); 
                                } else {
                                        groups_id.hide();
                                }
			}
		}
	})
})
</script>
<script type="text/javascript">
function loc(){
	var states_id = document.Login.states_id.value;
	var groups_id = document.Login.groups_id.value;
	$.ajax({
		type: "POST",
		url: "locations.php",
		data:{
			states_id: states_id,
			groups_id: groups_id,
		},
		cache: false,
		success: function(html){
			$(".locations_id").html(html);
		}			 
	});
}
function loc2(){
	var companies_id = document.Login.companies_id.value;
	$.ajax({
		type: "POST",
		url: "sales_garellies.php",
		data:{
			companies_id: companies_id,
		},
		cache: false,
		success: function(html){
			$(".aaa").html(html);
		}			 
	});
}
$(document).ready(function(){
	loc();
	loc2();
});
$(document).ready(function(){
	$(".companies_id").change(function(){
		loc2();
	});
	$(".states_id").change(function(){
		loc();
	});
	$(".groups_id").change(function(){
		loc();
	});
});
</script>
<script type="text/javascript">
<!--
function status_change(){
	now = new Date();
	y = now.getFullYear();
	m = now.getMonth() + 1;
	if( m < 10 ){
		m = "0" + m;
	}
	d = now.getDate();
	if( d < 10 ){
		d = "0" + d;
	}
	today = y + "-" + m + "-" + d;
	if(document.Login.status.value == "current" ){
		if( document.Login.expiry_date.value < today && document.Login.expiry_date.value != "" ){
			alert("Expirydate has passed.");
			document.Login.status.value = "upcoming";
		}else{
			document.Login.posted_date.value = today;
		}
	}
	if(document.Login.status.value == "completed" ){
		if( document.Login.posted_date.value > today && document.Login.posted_date.value != "" ){
			alert("You can't change status to completed,because posted date is future date.");
			document.Login.status.value = "current";
		}else{
			document.Login.expiry_date.value = today;
		}
	}
}
// -->
</script>
</head>
<body>
<div id="wrapper">
<div id="contents">
<?php include "../common/header.php"; ?>
<article id="contBox">
<?php
if(empty($_POST['act']) || $_POST['act'] == "err" || $_POST['act'] == "back" ){	
?>
	<section id="editForm">
		<h2>Listing Add/Edit</h2>
		<form id="Login" name="Login" action="<?php echo $_SERVER['SCRIPT_NAME'];?>" method="post" ENCTYPE="multipart/form-data">
<?php
if( $_POST['act'] == "err" ){
?>
	<!--ul class="errorTxt"><?php echo listings_err_check(NULL); ?></ul-->
	<ul class="errorTxt"><?php echo $err_msg; ?></ul>
<?php
}
?>
		<table>
			<tr id="evernote_id">
				<th>Developer id @ Evernote</th>
				<td>
					<input name="evernote_id" size="16" id="evernote_id" class="TextInput" type="text" title="" value="<?php echo $_POST['evernote_id'];?>">
				</td>
			</tr>
			<tr id="name">
				<th>Name</th>
				<td class="<?php if(listings_err_check("name")){ echo "errorInput"; }?> must">
					<input name="name" size="128" id="name" class="TextInput" type="text" title="name" value="<?php echo $_POST['name'];?>">
				</td>
			</tr>
			<tr id="code">
				<th>code(Used as part of URL)</th>
				<td class="<?php if(listings_err_check("code")){ echo "errorInput"; }?> must">
					<input name="code" size="64" id="code" class="TextInput" type="text" title="code" value="<?php echo $_POST['code'];?>">
				</td>
			</tr>
			<tr id="companies_id">
				<th>Company</th>
				<td class="<?php if(listings_err_check("companies_id")){ echo "errorInput"; }?> must">
				<select name="companies_id" data-placeholder="Please Choose Company..." style="width:250px;" class="companies_id" />
				<option value="0">Not selected(NULL)</option>
<?php
$result = companies_index();
while( $arr = mysql_fetch_array( $result )){
?>
				<option value="<?php echo $arr['id'];?>" <?php if( $arr['id'] == $_POST['companies_id'] ){ echo "selected"; } ?>><?php echo $arr['name'];?>(<?php echo $arr['id'];?>)</option>
<?php
}
?>
				</select>
				</td>
			</tr>
			<tr id="developer_id">
				<th>Developer</th>
				<td class="<?php if(listings_err_check("developer_id")){ echo "errorInput"; }?> must">
				<select name="developer_id" data-placeholder="Please Choose Developer..." style="width:250px;" class="developer_id" />
				<option value="0">Not selected(NULL)</option>
<?php
$result = companies_index();
while( $arr = mysql_fetch_array( $result )){
?>
				<option value="<?php echo $arr['id'];?>" <?php if( $arr['id'] == $_POST['developer_id'] ){ echo "selected"; } ?>><?php echo $arr['name'];?>(<?php echo $arr['id'];?>)</option>
<?php
}
?>
				</select>
				</td>
			</tr>
			<tr id="billing_id">
				<th>Billing Company</th>
				<td class="<?php if(listings_err_check("billing_id")){ echo "errorInput"; }?> must">
				<select name="billing_id" data-placeholder="Please Choose Billing Company..." style="width:250px;" class="billing_id" />
				<option value="0">Not selected(NULL)</option>
<?php
$result = companies_index();
while( $arr = mysql_fetch_array( $result )){
?>
				<option value="<?php echo $arr['id'];?>" <?php if( $arr['id'] == $_POST['billing_id'] ){ echo "selected"; } ?>><?php echo $arr['name'];?>(<?php echo $arr['id'];?>)</option>
<?php
}
?>
				</select>
				</td>
			</tr>
			<tr id="states_id">
				<th>Area > State</th>
				<td class="<?php if(listings_err_check("states_id")){ echo "errorInput"; }?> must">
				<select name="states_id" data-placeholder="Please Choose Area > State..." style="width:250px;" class="states_id" />
				<option value="0">Not selected(NULL)</option>
<?php
$result = states_index();
while( $arr = mysql_fetch_array( $result )){
?>
				<option value="<?php echo $arr['id'];?>" class="<?php echo $arr['id'];?>" <?php if( $arr['id'] == $_POST['states_id'] ){ echo "selected"; } ?>><?php echo $arr['name'];?>(<?php echo $arr['id'];?>)</option>
<?php
}
?>
				</select>
				</td>
			</tr>
			<tr id="groups_id">
				<th>Area > Group</th>
				<td>
				<select name="groups_id" data-placeholder="Please Choose Area > Group..." style="width:250px;" class="groups_id" />
				<option value="0" class="msg">Not selected(NULL)</option>
<?php
$result = groups_index();
while( $arr = mysql_fetch_array( $result )){
?>
				<option value="<?php echo $arr['id'];?>" class="<?php echo $arr['states_id'];?>" <?php if( $arr['id'] == $_POST['groups_id'] ){ echo "selected"; } ?>><?php echo $arr['name'];?>(<?php echo $arr['id'];?>)</option>
<?php
}
?>
				</select>
				</td>
			</tr>
			<tr>
				<th>Area > Location</th>
				<td class="<?php if(listings_err_check("locations_id")){ echo "errorInput"; }?> must">
				<select id="locations_id" name="locations_id" class="locations_id" style="width:250px;" />
				</select>
				</td>
			</tr>
			<tr id="property_types_id">
				<th>Property type(for search)</th>
				<td class="<?php if(listings_err_check("property_types_id")){ echo "errorInput"; }?> must">
<div><label><?php
if(is_array($_POST['property_types_id'])){
	$_POST['property_types_id'] = implode(",",$_POST['property_types_id']);
}
?>
<?php
$result = property_types_index();
while( $arr = mysql_fetch_array( $result )){
?>
	<input type="checkbox" name="property_types_id[]" value="<?php echo $arr['id'];?>" <?php if(strpos($_POST['property_types_id'],$arr['id'])!==false){ echo "checked"; } ?>><?php echo $arr['name'];?><br />
<?php
}
?>
</label></div>				</td>
			</tr>
			<tr id="property_name">
				<th>PropertyName</th>
				<td class="<?php if(listings_err_check("property_name")){ echo "errorInput"; }?>">
					<input name="property_name" size="128" id="property_name" class="TextInput" type="text" title="property_name" value="<?php echo $_POST['property_name'];?>">
				</td>
			</tr>
			<tr id="prices_id">
				<th>PriceType(for search)</th>
				<td class="<?php if(listings_err_check("prices_id")){ echo "errorInput"; }?>">
<div><label><?php
if(is_array($_POST['prices_id'])){
	$_POST['prices_id'] = implode(",",$_POST['prices_id']);
}
?>
<?php
$result = prices_index();
while( $arr = mysql_fetch_array( $result )){
?>
	<input type="checkbox" name="prices_id[]" value="<?php echo $arr['id'];?>" <?php if(strpos($_POST['prices_id'],$arr['id'])!==false){ echo "checked"; } ?>><?php echo $arr['name'];?><br />
<?php
}
?>
</label></div>				</td>
			</tr>
			<tr id="price_name">
				<th>PriceName</th>
				<td class="<?php if(listings_err_check("price_name")){ echo "errorInput"; }?>">
					<textarea name="price_name" title="" rows="5" cols="50" id="price_name" ><?php echo $_POST['price_name'];?></textarea>
				</td>
			</tr>
			<tr id="price_minimum">
				<th>Minimum Price</th>
				<td>
					<input name="price_minimum" size="16" id="price_minimum" class="TextInput" type="text" title="price_minimum" value="<?php echo $_POST['price_minimum'];?>">
				</td>
			</tr>
			<tr id="price_minimum_per_sqft">
				<th>Minimum Price per sqft</th>
				<td>
					<input name="price_minimum_per_sqft" size="16" id="price_minimum_per_sqft" class="TextInput" type="text" title="" value="<?php echo $_POST['price_minimum_per_sqft'];?>">
				</td>
			</tr>
			<tr id="features_id">
				<th>Features</th>
				<td class="<?php if(listings_err_check("features_id")){ echo "errorInput"; }?>">
<div><label><?php
if(is_array($_POST['features_id'])){
	$_POST['features_id'] = implode(",",$_POST['features_id']);
}
?>
<?php
$result = features_index();
while( $arr = mysql_fetch_array( $result )){
?>
	<input type="checkbox" name="features_id[]" value="<?php echo $arr['id'];?>" <?php if(strpos($_POST['features_id'],$arr['id'])!==false){ echo "checked"; } ?>><?php echo $arr['name'];?><br />
<?php
}
?>
</label></div>				</td>
			</tr>
                        <tr id="catch_copy">
                                <th>CatchCopy</th>
                                <td>
                                        <textarea name="catch_copy" title="" rows="5" cols="50" id="catch_copy" ><?php echo $_POST['catch_copy'];?></textarea>
                                </td>
                        </tr>
			<tr id="image_path">
				<th>Project Logo</th>
				<td class="<?php if(listings_err_check("image_path")){ echo "errorInput"; }?>">
<?php if(!empty($_SESSION['listings']['image_path'])){ ?>
				<div>
					<div><img src="/admin/images/listings/<?php echo $_SESSION['listings']['image_path'];?>" width="100"></div>
					<div><input type="checkbox" name="image_path" value="delete">delete this image</div>
				</div>
<?php } ?>
				<input type="file" name="image_path" />
				<p class="note">※width:200 * height:200 size required</p>
				</td>
			</tr>
			<tr id="main_picture">
				<th>Main Picture</th>
				<td class="<?php if(listings_err_check("main_picture")){ echo "errorInput"; }?>">
<?php if(!empty($_SESSION['listings']['main_picture'])){ ?>
				<div>
					<div><img src="/admin/images/listings/<?php echo $_SESSION['listings']['main_picture'];?>" width="100"></div>
					<div><input type="checkbox" name="main_picture" value="delete">delete this image</div>
				</div>
<?php } ?>
				<input type="file" name="main_picture" />
				<p class="note">※width:600 * height:450 size required</p>
				</td>
			</tr>
			<tr id="water">
				<th>Water Mark</th>
				<td>
				<input type="radio" name="water" value="on" <?php if( empty($_POST['water']) || $_POST['water'] == "on"){ echo "checked"; } ?>/>On
				<input type="radio" name="water" value="off" <?php if( $_POST['water'] == "off"){ echo "checked"; } ?> />Off
				</td>
			</tr>
			<tr id="address">
				<th>Address</th>
				<td class="<?php if(listings_err_check("address")){ echo "errorInput"; }?> must">
					<input name="address" size="128" id="address" class="TextInput" type="text" title="address" value="<?php echo $_POST['address'];?>">
				</td>
			</tr>
			<tr id="latitude">
				<th>Latitude</th>
				<td class="<?php if(listings_err_check("latitude")){ echo "errorInput"; }?>">
					<input name="latitude" size="11" id="latitude" class="TextInput" type="text" title="latitude" value="<?php echo $_POST['latitude'];?>">
<p class="note">※ex) 35.6813680</p>				</td>
			</tr>
			<tr id="longitude">
				<th>Longitude</th>
				<td class="<?php if(listings_err_check("longitude")){ echo "errorInput"; }?>">
					<input name="longitude" size="11" id="longitude" class="TextInput" type="text" title="longitude" value="<?php echo $_POST['longitude'];?>">
<p class="note">※ex) 139.7660760</p>				</td>
			</tr>
			<tr id="completion_years_id">
				<th>Completion year(for search)</th>
				<td class="<?php if(listings_err_check("completion_years_id")){ echo "errorInput"; }?>">
<div><label><?php
if(is_array($_POST['completion_years_id'])){
	$_POST['completion_years_id'] = implode(",",$_POST['completion_years_id']);
}
?>
<?php
$result = completion_years_index();
while( $arr = mysql_fetch_array( $result )){
?>
	<input type="checkbox" name="completion_years_id[]" value="<?php echo $arr['id'];?>" <?php if(strpos($_POST['completion_years_id'],$arr['id'])!==false){ echo "checked"; } ?>><?php echo $arr['name'];?><br />
<?php
}
?>
</label></div>				</td>
			</tr>
			<tr id="completion_year">
				<th>Completion year</th>
				<td class="<?php if(listings_err_check("completion_year")){ echo "errorInput"; }?>">
					<input name="completion_year" size="64" id="completion_year" class="TextInput" type="text" title="completion_year" value="<?php echo $_POST['completion_year'];?>">
				</td>
			</tr>
                        <tr id="bedrooms_id">
                                <th>Number of Bedrooms(for search)</th>
                                <td class="<?php if(listings_err_check("bedrooms_id")){ echo "errorInput"; }?>">
<div><label><?php
if(is_array($_POST['bedrooms_id'])){
        $_POST['bedrooms_id'] = implode(",",$_POST['bedrooms_id']);
}
?>
<?php
$result = bedrooms_index();
while( $arr = mysql_fetch_array( $result )){
?>
        <input type="checkbox" name="bedrooms_id[]" value="<?php echo $arr['id'];?>" <?php if(strpos($_POST['bedrooms_id'],$arr['id'])!==false){ echo "checked"; } ?>><?php echo $arr['name'];?><br />
<?php
}
?>
</label></div>                          </td>
                        </tr>
                        <tr id="sizes_id">
                                <th>Sizes(for search)</th>
                                <td class="<?php if(listings_err_check("sizes_id")){ echo "errorInput"; }?>">
<div><label><?php
if(is_array($_POST['sizes_id'])){
        $_POST['sizes_id'] = implode(",",$_POST['sizes_id']);
}
?>
<?php
$result = sizes_index();
while( $arr = mysql_fetch_array( $result )){
?>
        <input type="checkbox" name="sizes_id[]" value="<?php echo $arr['id'];?>" <?php if(strpos($_POST['sizes_id'],$arr['id'])!==false){ echo "checked"; } ?>><?php echo $arr['name'];?><br />
<?php
}
?>
</label></div>                          </td>
                        </tr>
			<tr id="states_id">
				<th>Tenure</th>
				<td>
<?php
$result = tenures_index();
while( $arr = mysql_fetch_array( $result )){
?>
				<input type="radio" name="tenures_id" value="<?php echo $arr['id'];?>" <?php if( $arr['id'] == $_POST['tenures_id'] ){ echo "checked"; } ?>/><?php echo $arr['name'];?>
<?php
}
?>
				</td>
			</tr>
			<tr id="sales_ga">
                                <th>Sales Gallery</th>
                                <td> <div id="aaa" name="aaa" class="aaa"></div> </td>
                        </tr>
			<tr id="youtube_url">
				<th>Youtube Url</th>
					<td>
					<input name="youtube_url" size="128" id="youtube_url" class="TextInput" type="text" title="address" value="<?php echo $_POST['youtube_url'];?>">
					</td>
			</tr>
			<tr id="type">
				<th>ListingType</th>
				<td class="<?php if(listings_err_check("type")){ echo "errorInput"; }?> must">
<div><label><?php
foreach( $listings_type_list as $key => $val ){
?>
				<input id="type" name="type" type="radio" value="<?php echo $key;?>" <?php if( $key == $_POST['type'] ){ echo "checked"; } ?>><?php echo $val;?><?php
}
?>
</label></div>				</td>
			</tr>
			<tr id="search_rank">
				<th>SearchRank</th>
				<td class="<?php if(listings_err_check("search_rank")){ echo "errorInput"; }?> must">
<div><label><?php
foreach( $listings_search_rank_list as $key => $val ){
?>
				<input id="search_rank" name="search_rank" type="radio" value="<?php echo $key;?>" <?php if( $key == $_POST['search_rank'] ){ echo "checked"; } ?>><?php echo $val;?><?php
}
?>
</label></div>				</td>
			</tr>
			<tr id="status">
				<th>Status</th>
				<td class="<?php if(listings_err_check("status")){ echo "errorInput"; }?> must">
<div><label><?php
foreach( $listings_status_list as $key => $val ){
?>
				<input id="status" name="status" type="radio" value="<?php echo $key;?>" <?php if( $key == $_POST['status'] ){ echo "checked"; } ?> onclick="status_change();"><?php echo $val;?><?php
}
?>
</label></div>				</td>
			</tr>
			<tr id="posted_date">
				<th>Posted date</th>
				<td class="<?php if(listings_err_check("posted_date")){ echo "errorInput"; }?>">
					<input name="posted_date" size="" id="posted_date" class="TextInput" type="date" title="posted_date" value="<?php echo $_POST['posted_date'];?>">
				</td>
			</tr>
			<tr id="expiry_date">
				<th>Expiry date</th>
				<td class="<?php if(listings_err_check("expiry_date")){ echo "errorInput"; }?>">
					<input name="expiry_date" size="" id="expiry_date" class="TextInput" type="date" title="expiry_date" value="<?php echo $_POST['expiry_date'];?>">
				</td>
			</tr>
			<tr id="launch_date">
				<th>Launch date</th>
				<td>
					<input name="launch_date" size="" id="launch_date" class="TextInput" type="date" title="launch_date" value="<?php echo $_POST['launch_date'];?>">
				</td>
			</tr>
			<tr id="monthly_enquiry_limit">
				<th>Monthly enquiry limit</th>
				<td>
					<input name="monthly_enquiry_limit" size="16" id="monthly_enquiry_limit" class="TextInput" type="text" title="" value="<?php echo $_POST['monthly_enquiry_limit'];?>">
				</td>
			</tr>
			<tr id="service_fee">
				<th>Service Fee</th>
				<td>
					<input name="service_fee" size="16" id="service_fee" class="TextInput" type="text" title="" value="<?php echo $_POST['service_fee'];?>">
				</td>
			</tr>
			<tr id="call_option">
				<th>Call Option</th>
				<td>
<div><label><?php
foreach( $listings_call_option_list as $key => $val ){
?>
				<input id="call_option" name="call_option" type="radio" value="<?php echo $key;?>" <?php if( $key == $_POST['call_option'] ){ echo "checked"; } ?> ><?php echo $val;?><?php
}
?>
</label></div>				</td>
			</tr>
			<tr id="contact_no">
				<th>Contact No</th>
				<td>
					<input name="contact_no" size="30" id="contact_no" class="TextInput" type="text" title="" value="<?php echo $_POST['contact_no'];?>">
				</td>
			</tr>
			<tr id="charge_type">
				<th>Charge type</th>
				<td>
<div><label><?php
foreach( $listings_charge_type_list as $key => $val ){
?>
				<input id="charge_type" name="charge_type" type="radio" value="<?php echo $key;?>" <?php if( $key == $_POST['charge_type'] ){ echo "checked"; } ?>><?php echo $val;?><?php
}
?>
</label></div>				</td>
			</tr>
			<tr id="fixed_fee">
				<th>Fixed fee</th>
				<td>
					<input name="fixed_fee" size="30" id="fixed_fee" class="TextInput" type="number" title="" value="<?php echo $_POST['fixed_fee'];?>">
				</td>
			</tr>
			<tr id="call_option_fee">
				<th>Call option fee</th>
				<td>
					<input name="call_option_fee" size="30" id="call_option_fee" class="TextInput" type="number" title="" value="<?php echo $_POST['call_option_fee'];?>">
				</td>
			</tr>
		</table>
		<p class="confirmBtn"><input value="Confirm" id="submit" type="submit"></p>
		<input type="hidden" name="act" value="conf">
		<input type="hidden" name="id" value="<?php echo $_POST['id'];?>">
		</form>
	</section>
	
<?php
}else if( $_POST['act'] == "conf"){
?>
	<section id="editForm">
		<h2>ListingAdd/Edit</h2>
		<table>
			<tr>
				<th>Developer id @ Evernote</th>
				<td><?php echo htmlspecialchars($_POST['evernote_id'],ENT_QUOTES);?></td>
			</tr>
			<tr>
				<th>Name</th>
				<td><?php echo htmlspecialchars($_POST['name'],ENT_QUOTES);?></td>
			</tr>
			<tr>
				<th>code(Used as part of URL)</th>
				<td><?php echo htmlspecialchars($_POST['code'],ENT_QUOTES);?></td>
			</tr>
			<tr>
				<th>Company</th>
				<td><?php echo common_get_value("companies","name",$_POST['companies_id'],"");?></td>
			</tr>
			<tr>
				<th>Developer</th>
				<td><?php echo common_get_value("companies","name",$_POST['developer_id'],"");?></td>
			</tr>
			<tr>
				<th>Billing Company</th>
				<td><?php echo common_get_value("companies","name",$_POST['billing_id'],"");?></td>
			</tr>
			<tr>
				<th>Area > State</th>
				<td><?php echo common_get_value("states","name",$_POST['states_id'],"");?></td>
			</tr>
			<tr>
				<th>Area > Group</th>
				<td><?php echo common_get_value("groups","name",$_POST['groups_id'],"");?></td>
			</tr>
			<tr>
				<th>Area > Location</th>
				<td><?php echo common_get_value("locations","name",$_POST['locations_id'],"");?></td>
			</tr>
			<tr>
				<th>Property type(for search)</th>
				<td><?php echo admin_common_get_name_from_csv($_POST['property_types_id'],"property_types");?></td>
			</tr>
			<tr>
				<th>PropertyName</th>
				<td><?php echo htmlspecialchars($_POST['property_name'],ENT_QUOTES);?></td>
			</tr>
			<tr>
				<th>PriceType(for search)</th>
				<td><?php echo admin_common_get_name_from_csv($_POST['prices_id'],"prices");?></td>
			</tr>
			<tr>
				<th>PriceName</th>
				<td><?php echo str_replace("\n","<br />",htmlspecialchars($_POST['price_name'],ENT_QUOTES));?></td>
			</tr>
			<tr>
				<th>Minimum Price</th>
				<td><?php echo htmlspecialchars($_POST['price_minimum'],ENT_QUOTES);?></td>
			</tr>
			<tr>
				<th>Minimum Price per sqft</th>
				<td><?php echo htmlspecialchars($_POST['price_minimum_per_sqft'],ENT_QUOTES);?></td>
			</tr>
			<tr>
				<th>Features</th>
				<td><?php echo admin_common_get_name_from_csv($_POST['features_id'],"features");?></td>
			</tr>
			<tr>
				<th>CatchCopy</th>
				<td><?php echo htmlspecialchars($_POST['catch_copy'],ENT_QUOTES);?></td>
			</tr>
			<tr>
				<th>Project Logo</th>
				<td><?php if(!empty($_SESSION['listings']['image_path'])){ ?> <img src="/admin/images/listings/<?php echo $_SESSION['listings']['image_path'];?>" width="100"> <?php } ?>
</td>
			</tr>
			<tr>
				<th>Main Picture</th>
				<td><?php if(!empty($_SESSION['listings']['main_picture'])){ ?> <img src="/admin/images/listings/<?php echo $_SESSION['listings']['main_picture'];?>" width="100"> <?php } ?>
</td>
			</tr>
			<tr>
				<th>Address</th>
				<td><?php echo htmlspecialchars($_POST['address'],ENT_QUOTES);?></td>
			</tr>
			<tr>
				<th>Latitude</th>
				<td><?php echo htmlspecialchars($_POST['latitude'],ENT_QUOTES);?></td>
			</tr>
			<tr>
				<th>Longitude</th>
				<td><?php echo htmlspecialchars($_POST['longitude'],ENT_QUOTES);?></td>
			</tr>
			<tr>
				<th>Completion year(for search)</th>
				<td><?php echo admin_common_get_name_from_csv($_POST['completion_years_id'],"completion_years");?></td>
			</tr>
			<tr>
				<th>Completion year</th>
				<td><?php echo htmlspecialchars($_POST['completion_year'],ENT_QUOTES);?></td>
			</tr>
			<tr>
				<th>Number of Bedrooms(for search)</th>
				<td><?php echo admin_common_get_name_from_csv($_POST['bedrooms_id'],"bedrooms");?></td>
			</tr>
			<tr>
				<th>sizes(for search)</th>
				<td><?php echo admin_common_get_name_from_csv($_POST['sizes_id'],"sizes");?></td>
			</tr>
			<tr>
				<th>Tenures</th>
				<td><?php echo common_get_value("tenures","name",$_POST['tenures_id'],"");?></td>
			</tr>
			<tr>
				<th>Sales Gallery</th>
				<td><?php echo admin_common_get_name_from_csv($_POST['sales_garellies_id'],"sales_garellies");?></td>
			</tr>
			<tr>
				<th>Youtube Url</th>
				<td><?php echo htmlspecialchars($_POST['youtube_url'],ENT_QUOTES);?></td>
			</tr>
			<tr>
				<th>ListingType</th>
				<td><?php echo $listings_type_list[$_POST['type']];?></td>
			</tr>
			<tr>
				<th>SearchRank</th>
				<td><?php echo $listings_search_rank_list[$_POST['search_rank']];?></td>
			</tr>
			<tr>
				<th>Status</th>
				<td><?php echo $listings_status_list[$_POST['status']];?></td>
			</tr>
			<tr>
				<th>Posted date</th>
				<td><?php echo $_POST['posted_date'];?></td>
			</tr>
			<tr>
				<th>Expiry date</th>
				<td><?php echo $_POST['expiry_date'];?></td>
			</tr>
			<tr>
				<th>Launch date</th>
				<td><?php echo $_POST['launch_date'];?></td>
			</tr>
			<tr>
				<th>Monthly enquiry limit</th>
				<td><?php echo $_POST['monthly_enquiry_limit'];?></td>
			</tr>
			<tr>
				<th>Service Fee</th>
				<td><?php echo $_POST['service_fee'];?></td>
			</tr>
			<tr>
				<th>Call Option</th>
				<td><?php echo $listings_call_option_list[$_POST['call_option']];?></td>
			</tr>
			<tr>
				<th>Contact No</th>
				<td><?php echo $_POST['contact_no'];?></td>
			</tr>
			<tr>
				<th>Charge type</th>
				<td><?php echo $_POST['charge_type'];?></td>
			</tr>
			<tr>
				<th>Fixed fee</th>
				<td><?php echo $_POST['fixed_fee'];?></td>
			</tr>
			<tr>
				<th>Call option fee</th>
				<td><?php echo $_POST['call_option_fee'];?></td>
			</tr>
		</table>
		<table width="50%">
		<tr>
		<td>
		<form id="Login" name="Login" action="<?php echo $_SERVER['SCRIPT_NAME'];?>" method="post">
		<p class="confirmBtn"><input value="Back" id="submit" type="submit"></p>
		<input type="hidden" name="act" value="back">
		<?php include "./form_input.php"; ?>
		</form>
		</td><td>
		<form id="Login" name="Login" action="<?php echo $_SERVER['SCRIPT_NAME'];?>" method="post">
		<p class="confirmBtn"><input value="Edit" id="submit" type="submit"></p>
		<input type="hidden" name="act" value="edit">
		<?php include "./form_input.php"; ?>
		</form>
		</td>
		</tr>
		</table>
	</section>
<?php
}
?>
<div id="pagetop"><a href="#wrapper"><img src="/admin/images/pagetop.gif" alt="ページトップへ" width="50" height="50"></a></div>
</article>

</div><!--contents-->

<?php include "../common/footer.php"; ?>

</div><!--wrapper-->

<!-- SCRIPTS -->

<!--script type="text/javascript" src="/admin/js/jquery-1.3.1.min.js"></script-->

</body>
</html>
