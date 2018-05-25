<?php include "../../../controller/admin/amenity_categories/edit.php"; ?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Amenity Category Add/Edit</title>
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
		<h2>Amenity Category Add/Edit</h2>
		<form id="Login" name="Login" action="<?php echo $_SERVER['SCRIPT_NAME'];?>" method="post" ENCTYPE="multipart/form-data">
<?php
if( $_POST['act'] == "err" ){
?>
	<ul class="errorTxt"><?php echo amenity_categories_err_check(NULL); ?></ul>
<?php
}
?>
		<table>
			<tr id="name">
				<th>Category name</th>
				<td class="<?php if(amenity_categories_err_check("name")){ echo "errorInput"; }?> must">
					<input name="name" size="64" id="name" class="TextInput" type="text" title="name" value="<?php echo $_POST['name'];?>">
				</td>
			</tr>
			<tr id="code">
				<th>Code</th>
				<td class="<?php if(amenity_categories_err_check("code")){ echo "errorInput"; }?> must">
					<input name="code" size="16" id="code" class="TextInput" type="text" title="code" value="<?php echo $_POST['code'];?>">
				</td>
			</tr>
			<tr id="image_path">
				<th>image_path</th>
				<td class="<?php if(amenity_categories_err_check("image_path")){ echo "errorInput"; }?>">
<?php if(!empty($_SESSION['amenity_categories']['image_path'])){ ?>
				<div>
					<div><img src="/admin/images/amenity_categories/<?php echo $_SESSION['amenity_categories']['image_path'];?>" width="100"></div>
					<div><input type="checkbox" name="image_path" value="delete">delete this image</div>
				</div>
<?php } ?>
				<input type="file" name="image_path" />
				</td>
			</tr>
			<tr id="icon">
				<th>icon</th>
				<td class="<?php if(amenity_categories_err_check("icon")){ echo "errorInput"; }?>">
<?php if(!empty($_SESSION['amenity_categories']['icon'])){ ?>
				<div>
					<div><img src="/admin/images/amenity_categories/<?php echo $_SESSION['amenity_categories']['icon'];?>" width="100"></div>
					<div><input type="checkbox" name="icon" value="delete">delete this image</div>
				</div>
<?php } ?>
				<input type="file" name="icon" />
				</td>
			</tr>
			<tr id="hit_radius">
				<th>Hit radius</th>
				<td class="<?php if(amenity_categories_err_check("hit_radius")){ echo "errorInput"; }?> must">
					<input name="hit_radius" size="64" id="hit_radius" class="TextInput" type="text" title="hit_radius" value="<?php echo $_POST['hit_radius'];?>">
				</td>
			</tr>
			<tr id="sort">
				<th>sort</th>
				<td class="<?php if(amenity_categories_err_check("sort")){ echo "errorInput"; }?> must">
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
		<h2>Amenity CategoryAdd/Edit</h2>
		<table>
			<tr>
				<th>Category name</th>
				<td><?php echo htmlspecialchars($_POST['name'],ENT_QUOTES);?></td>
			</tr>
			<tr>
				<th>Code</th>
				<td><?php echo htmlspecialchars($_POST['code'],ENT_QUOTES);?></td>
			</tr>
			<tr>
				<th>image_path</th>
				<td><?php if(!empty($_SESSION['amenity_categories']['image_path'])){ ?> <img src="/admin/images/amenity_categories/<?php echo $_SESSION['amenity_categories']['image_path'];?>" width="100"> <?php } ?>
</td>
			</tr>
			<tr>
				<th>icon</th>
				<td><?php if(!empty($_SESSION['amenity_categories']['icon'])){ ?> <img src="/admin/images/amenity_categories/<?php echo $_SESSION['amenity_categories']['icon'];?>" width="100"> <?php } ?>
</td>
			</tr>
			<tr>
				<th>Hit radius</th>
				<td><?php echo htmlspecialchars($_POST['hit_radius'],ENT_QUOTES);?></td>
			</tr>
			<tr>
				<th>sort</th>
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
