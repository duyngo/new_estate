<?php include "/home/newpropertylist.my/controller/admin/property_types/edit.php"; ?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Property type Add/Edit</title>
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
	$(".property_type_groups_id").chosen();
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
		<h2>Property type Add/Edit</h2>
		<form id="Login" name="Login" action="<?php echo $_SERVER['SCRIPT_NAME'];?>" method="post" ENCTYPE="multipart/form-data">
<?php
if( $_POST['act'] == "err" ){
?>
	<ul class="errorTxt"><?php echo property_types_err_check(NULL); ?></ul>
<?php
}
?>
		<table>
			<tr id="property_type_groups_id">
				<th>Property Type Group</th>
				<td class="<?php if(property_types_err_check("property_type_groups_id")){ echo "errorInput"; }?> must">
				<select name="property_type_groups_id" data-placeholder="Please Choose Property Type Group..." style="width:250px;" class="property_type_groups_id" />
				<option value="0">Not selected(NULL)</option>
<?php
$result = property_type_groups_index();
while( $arr = mysql_fetch_array( $result )){
?>
				<option value="<?php echo $arr['id'];?>" <?php if( $arr['id'] == $_POST['property_type_groups_id'] ){ echo "selected"; } ?>><?php echo $arr['name'];?>(<?php echo $arr['id'];?>)</option>
<?php
}
?>
				</select>
				</td>
			</tr>
			<tr id="name">
				<th>Property type name</th>
				<td class="<?php if(property_types_err_check("name")){ echo "errorInput"; }?> must">
					<input name="name" size="128" id="name" class="TextInput" type="text" title="name" value="<?php echo $_POST['name'];?>">
				</td>
			</tr>
			<tr id="code">
				<th>code</th>
				<td class="<?php if(property_types_err_check("code")){ echo "errorInput"; }?> must">
					<input name="code" size="32" id="code" class="TextInput" type="text" title="code" value="<?php echo $_POST['code'];?>">
				</td>
			</tr>
			<tr id="image_path">
				<th>Picture</th>
				<td class="<?php if(property_types_err_check("image_path")){ echo "errorInput"; }?>">
<?php if(!empty($_SESSION['property_types']['image_path'])){ ?>
				<div>
					<div><img src="/admin/images/property_types/<?php echo $_SESSION['property_types']['image_path'];?>" width="100"></div>
					<div><input type="checkbox" name="image_path" value="delete">delete this image</div>
				</div>
<?php } ?>
				<input type="file" name="image_path" />
				</td>
			</tr>
			<tr id="description">
				<th>Description</th>
				<td class="<?php if(property_types_err_check("description")){ echo "errorInput"; }?>">
					<textarea name="description" title="" rows="5" cols="50" id="description" ><?php echo $_POST['description'];?></textarea>
				</td>
			</tr>
			<tr id="sort">
				<th>Sort</th>
				<td class="<?php if(property_types_err_check("sort")){ echo "errorInput"; }?> must">
					<input name="sort" size="10" id="sort" class="TextInput" type="text" title="sort" value="<?php echo $_POST['sort'];?>">
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
		<h2>Property typeAdd/Edit</h2>
		<table>
			<tr>
				<th>Property Type Group</th>
				<td><?php echo common_get_value("property_type_groups","name",$_POST['property_type_groups_id'],"");?></td>
			</tr>
			<tr>
				<th>Property type name</th>
				<td><?php echo htmlspecialchars($_POST['name'],ENT_QUOTES);?></td>
			</tr>
			<tr>
				<th>code</th>
				<td><?php echo htmlspecialchars($_POST['code'],ENT_QUOTES);?></td>
			</tr>
			<tr>
				<th>Picture</th>
				<td><?php if(!empty($_SESSION['property_types']['image_path'])){ ?> <img src="/admin/images/property_types/<?php echo $_SESSION['property_types']['image_path'];?>" width="100"> <?php } ?>
</td>
			</tr>
			<tr>
				<th>Description</th>
				<td><?php echo str_replace("\n","<br />",htmlspecialchars($_POST['description'],ENT_QUOTES));?></td>
			</tr>
			<tr>
				<th>Sort</th>
				<td><?php echo htmlspecialchars($_POST['sort'],ENT_QUOTES);?></td>
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
