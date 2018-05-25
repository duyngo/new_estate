<?php include "/home/newpropertylist.my/controller/admin/listings_enquiries/edit.php"; ?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Enquiries Add/Edit</title>
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

<script type="text/javascript" src="/admin/js/jquery-1.9.1.min.js"></script>
<script src="/admin/js/chosen.jquery.js"></script>
<script type="text/javascript">
$(function(){
	$(".listings_id").chosen();
});
</script>
<script type="text/javascript">
$(function(){
	$(".members_id").chosen();
});
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
		<h2>Enquiries Add/Edit</h2>
		<form id="Login" name="Login" action="<?php echo $_SERVER['SCRIPT_NAME'];?>" method="post" ENCTYPE="multipart/form-data">
<?php
if( $_POST['act'] == "err" ){
?>
	<ul class="errorTxt"><?php echo listings_enquiries_err_check(NULL); ?></ul>
<?php
}
?>
		<table>
			<tr id="listings_id">
				<th>Listings</th>
				<td class="<?php if(listings_enquiries_err_check("listings_id")){ echo "errorInput"; }?> must">
				<select name="listings_id" data-placeholder="Please Choose Listings..." style="width:250px;" class="listings_id" />
				<option value="0">Not selected(NULL)</option>
<?php
$result = listings_index();
while( $arr = mysql_fetch_array( $result )){
?>
				<option value="<?php echo $arr['id'];?>" <?php if( $arr['id'] == $_POST['listings_id'] ){ echo "selected"; } ?>><?php echo $arr['name'];?>(<?php echo $arr['id'];?>)</option>
<?php
}
?>
				</select>
				</td>
			</tr>
			<tr id="members_id">
				<th>Member</th>
				<td class="<?php if(listings_enquiries_err_check("members_id")){ echo "errorInput"; }?> must">
				<select name="members_id" data-placeholder="Please Choose Member..." style="width:250px;" class="members_id" />
				<option value="0">Not selected(NULL)</option>
<?php
$result = members_index();
while( $arr = mysql_fetch_array( $result )){
?>
				<option value="<?php echo $arr['id'];?>" <?php if( $arr['id'] == $_POST['members_id'] ){ echo "selected"; } ?>><?php echo $arr['name'];?>(<?php echo $arr['id'];?>)</option>
<?php
}
?>
				</select>
				</td>
			</tr>
			<tr id="name">
				<th>Name</th>
				<td class="<?php if(listings_enquiries_err_check("name")){ echo "errorInput"; }?> must">
					<input name="name" size="128" id="name" class="TextInput" type="text" title="name" value="<?php echo $_POST['name'];?>">
				</td>
			</tr>
			<tr id="email">
				<th>Email</th>
				<td class="<?php if(listings_enquiries_err_check("email")){ echo "errorInput"; }?> must">
					<input name="email" size="128" id="email" class="TextInput" type="text" title="email" value="<?php echo $_POST['email'];?>">
				</td>
			</tr>
			<tr id="phone">
				<th>Phone</th>
				<td class="<?php if(listings_enquiries_err_check("phone")){ echo "errorInput"; }?> must">
					<input name="phone" size="64" id="phone" class="TextInput" type="text" title="phone" value="<?php echo $_POST['phone'];?>">
				</td>
			</tr>
			<tr id="good_point">
				<th>Good Points</th>
				<td class="<?php if(listings_enquiries_err_check("good_point")){ echo "errorInput"; }?>">
<div><label><?php
if(is_array($_POST['good_point'])){
	$_POST['good_point'] = implode(",",$_POST['good_point']);
}
?>
<?php
foreach( $listings_enquiries_good_point_list as $key => $val ){
?>
	<input type="checkbox" name="good_point[]" value="<?php echo $key;?>" <?php if(strpos($_POST['good_point'],$key)!==false){ echo "checked"; } ?>><?php echo $val;?>
<?php
}
?>
</label></div>				</td>
			</tr>
			<tr id="contact_type">
				<th>Contact me via</th>
				<td class="<?php if(listings_enquiries_err_check("contact_type")){ echo "errorInput"; }?> must">
<div><label><?php
foreach( $listings_enquiries_contact_type_list as $key => $val ){
?>
				<input id="contact_type" name="contact_type" type="radio" value="<?php echo $key;?>" <?php if( $key == $_POST['contact_type'] ){ echo "checked"; } ?>><?php echo $val;?><?php
}
?>
</label></div>				</td>
			</tr>
			<tr id="nationality">
				<th>Nationality</th>
				<td class="<?php if(listings_enquiries_err_check("nationality")){ echo "errorInput"; }?> must">
<div><label><?php
foreach( $listings_enquiries_nationality_list as $key => $val ){
?>
				<input id="nationality" name="nationality" type="radio" value="<?php echo $key;?>" <?php if( $key == $_POST['nationality'] ){ echo "checked"; } ?>><?php echo $val;?><?php
}
?>
</label></div>				</td>
			</tr>
			<tr id="created">
				<th>EnquiryDate</th>
				<td class="<?php if(listings_enquiries_err_check("created")){ echo "errorInput"; }?> must">
					<input name="created" size="" id="created" class="TextInput" type="date" title="created" value="<?php echo $_POST['created'];?>">
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
		<h2>EnquiriesAdd/Edit</h2>
		<table>
			<tr>
				<th>Listings</th>
				<td><?php echo common_get_value("listings","name",$_POST['listings_id'],"");?></td>
			</tr>
			<tr>
				<th>Member</th>
				<td><?php echo common_get_value("members","name",$_POST['members_id'],"");?></td>
			</tr>
			<tr>
				<th>Name</th>
				<td><?php echo htmlspecialchars($_POST['name'],ENT_QUOTES);?></td>
			</tr>
			<tr>
				<th>Email</th>
				<td><?php echo htmlspecialchars($_POST['email'],ENT_QUOTES);?></td>
			</tr>
			<tr>
				<th>Phone</th>
				<td><?php echo htmlspecialchars($_POST['phone'],ENT_QUOTES);?></td>
			</tr>
			<tr>
				<th>Good Points</th>
				<td><?php echo implode(",",$_POST['good_point']);?></td>
			</tr>
			<tr>
				<th>Contact me via</th>
				<td><?php echo $listings_enquiries_contact_type_list[$_POST['contact_type']];?></td>
			</tr>
			<tr>
				<th>Nationality</th>
				<td><?php echo $listings_enquiries_nationality_list[$_POST['nationality']];?></td>
			</tr>
			<tr>
				<th>EnquiryDate</th>
				<td><?php echo $_POST['created'];?></td>
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
