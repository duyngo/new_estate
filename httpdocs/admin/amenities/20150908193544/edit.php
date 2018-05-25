<?php include "/home/newpropertylist.my/controller/admin/amenities/edit.php"; ?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Amenity Add/Edit</title>
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
	$(".states_id").chosen();
});
</script>
<script type="text/javascript">
$(function(){
	$(".groups_id").chosen();
});
</script>
<script type="text/javascript">
$(function(){
	$(".amenity_categories_id").chosen();
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
		<h2>Amenity Add/Edit</h2>
		<form id="Login" name="Login" action="<?php echo $_SERVER['SCRIPT_NAME'];?>" method="post" ENCTYPE="multipart/form-data">
<?php
if( $_POST['act'] == "err" ){
?>
	<ul class="errorTxt"><?php echo amenities_err_check(NULL); ?></ul>
<?php
}
?>
		<table>
			<tr id="states_id">
				<th>State</th>
				<td class="<?php if(amenities_err_check("states_id")){ echo "errorInput"; }?> must">
				<select name="states_id" data-placeholder="Please Choose State..." style="width:250px;" class="states_id" />
				<option value="0">Not selected(NULL)</option>
<?php
$result = states_index();
while( $arr = mysql_fetch_array( $result )){
?>
				<option value="<?php echo $arr['id'];?>" <?php if( $arr['id'] == $_POST['states_id'] ){ echo "selected"; } ?>><?php echo $arr['name'];?>(<?php echo $arr['id'];?>)</option>
<?php
}
?>
				</select>
				</td>
			</tr>
			<tr id="groups_id">
				<th>Area Group</th>
				<td class="<?php if(amenities_err_check("groups_id")){ echo "errorInput"; }?>">
				<select name="groups_id" data-placeholder="Please Choose Area Group..." style="width:250px;" class="groups_id" />
				<option value="0">Not selected(NULL)</option>
<?php
$result = groups_index();
while( $arr = mysql_fetch_array( $result )){
?>
				<option value="<?php echo $arr['id'];?>" <?php if( $arr['id'] == $_POST['groups_id'] ){ echo "selected"; } ?>><?php echo $arr['name'];?>(<?php echo $arr['id'];?>)</option>
<?php
}
?>
				</select>
				</td>
			</tr>
			<tr id="amenity_categories_id">
				<th>Category</th>
				<td class="<?php if(amenities_err_check("amenity_categories_id")){ echo "errorInput"; }?> must">
				<select name="amenity_categories_id" data-placeholder="Please Choose Category..." style="width:250px;" class="amenity_categories_id" />
				<option value="0">Not selected(NULL)</option>
<?php
$result = amenity_categories_index();
while( $arr = mysql_fetch_array( $result )){
?>
				<option value="<?php echo $arr['id'];?>" <?php if( $arr['id'] == $_POST['amenity_categories_id'] ){ echo "selected"; } ?>><?php echo $arr['name'];?>(<?php echo $arr['id'];?>)</option>
<?php
}
?>
				</select>
				</td>
			</tr>
			<tr id="name">
				<th>Amenity name</th>
				<td class="<?php if(amenities_err_check("name")){ echo "errorInput"; }?> must">
					<input name="name" size="64" id="name" class="TextInput" type="text" title="name" value="<?php echo $_POST['name'];?>">
				</td>
			</tr>
			<tr id="image_path">
				<th>Picture</th>
				<td class="<?php if(amenities_err_check("image_path")){ echo "errorInput"; }?>">
<?php if(!empty($_SESSION['amenities']['image_path'])){ ?>
				<div>
					<div><img src="/admin/images/amenities/<?php echo $_SESSION['amenities']['image_path'];?>" width="100"></div>
					<div><input type="checkbox" name="image_path" value="delete">delete this image</div>
				</div>
<?php } ?>
				<input type="file" name="image_path" />
				</td>
			</tr>
			<tr id="description">
				<th>Description</th>
				<td class="<?php if(amenities_err_check("description")){ echo "errorInput"; }?>">
					<textarea name="description" title="" rows="5" cols="50" id="description" ><?php echo $_POST['description'];?></textarea>
				</td>
			</tr>
			<tr id="latitude">
				<th>Latitude</th>
				<td class="<?php if(amenities_err_check("latitude")){ echo "errorInput"; }?>">
					<input name="latitude" size="11" id="latitude" class="TextInput" type="text" title="latitude" value="<?php echo $_POST['latitude'];?>">
<p class="note">※ex) 35.6813680</p>				</td>
			</tr>
			<tr id="longitude">
				<th>Longitude</th>
				<td class="<?php if(amenities_err_check("longitude")){ echo "errorInput"; }?>">
					<input name="longitude" size="11" id="longitude" class="TextInput" type="text" title="longitude" value="<?php echo $_POST['longitude'];?>">
<p class="note">※ex) 139.7660760</p>				</td>
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
		<h2>AmenityAdd/Edit</h2>
		<table>
			<tr>
				<th>State</th>
				<td><?php echo common_get_value("states","name",$_POST['states_id'],"");?></td>
			</tr>
			<tr>
				<th>Area Group</th>
				<td><?php echo common_get_value("groups","name",$_POST['groups_id'],"");?></td>
			</tr>
			<tr>
				<th>Category</th>
				<td><?php echo common_get_value("amenity_categories","name",$_POST['amenity_categories_id'],"");?></td>
			</tr>
			<tr>
				<th>Amenity name</th>
				<td><?php echo htmlspecialchars($_POST['name'],ENT_QUOTES);?></td>
			</tr>
			<tr>
				<th>Picture</th>
				<td><?php if(!empty($_SESSION['amenities']['image_path'])){ ?> <img src="/admin/images/amenities/<?php echo $_SESSION['amenities']['image_path'];?>" width="100"> <?php } ?>
</td>
			</tr>
			<tr>
				<th>Description</th>
				<td><?php echo str_replace("\n","<br />",htmlspecialchars($_POST['description'],ENT_QUOTES));?></td>
			</tr>
			<tr>
				<th>Latitude</th>
				<td><?php echo htmlspecialchars($_POST['latitude'],ENT_QUOTES);?></td>
			</tr>
			<tr>
				<th>Longitude</th>
				<td><?php echo htmlspecialchars($_POST['longitude'],ENT_QUOTES);?></td>
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
