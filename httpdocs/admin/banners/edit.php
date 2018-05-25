<?php include "../../../controller/admin/banners/edit.php"; ?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Banners Add/Edit</title>
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
		<h2>Banners Add/Edit</h2>
		<form id="Login" name="Login" action="<?php echo $_SERVER['SCRIPT_NAME'];?>" method="post" ENCTYPE="multipart/form-data">
<?php
if( $_POST['act'] == "err" ){
?>
	<ul class="errorTxt"><?php echo banners_err_check(NULL); ?></ul>
<?php
}
?>
		<table>
			<tr id="image_path">
				<th>Image</th>
				<td class="<?php if(banners_err_check("image_path")){ echo "errorInput"; }?> must">
<?php if(!empty($_SESSION['banners']['image_path'])){ ?>
				<div>
					<div><img src="/admin/images/banners/<?php echo $_SESSION['banners']['image_path'];?>" width="100"></div>
					<div><input type="checkbox" name="image_path" value="delete">delete this image</div>
				</div>
<?php } ?>
				<input type="file" name="image_path" />
<p class="note">※※width:2000 * height:580 size required</p>				</td>
			</tr>
			<tr id="url">
				<th>Url</th>
				<td class="<?php if(banners_err_check("url")){ echo "errorInput"; }?> must">
					<input name="url" size="128" id="url" class="TextInput" type="text" title="url" value="<?php echo $_POST['url'];?>">
				</td>
			</tr>
			<tr id="alt">
				<th>Alt</th>
				<td class="<?php if(banners_err_check("alt")){ echo "errorInput"; }?>">
					<input name="alt" size="32" id="alt" class="TextInput" type="text" title="alt" value="<?php echo $_POST['alt'];?>">
				</td>
			</tr>
			<tr id="title">
				<th>Title</th>
				<td class="<?php if(banners_err_check("title")){ echo "errorInput"; }?>">
					<input name="title" size="128" id="title" class="TextInput" type="text" title="title" value="<?php echo $_POST['title'];?>">
				</td>
			</tr>
			<tr id="description">
				<th>Description</th>
				<td class="<?php if(banners_err_check("description")){ echo "errorInput"; }?>">
					<textarea name="description" title="" rows="5" cols="50" id="description" ><?php echo $_POST['description'];?></textarea>
				</td>
			</tr>
			<tr id="button_name">
				<th>Button Name</th>
				<td class="<?php if(banners_err_check("button_name")){ echo "errorInput"; }?>">
					<input name="button_name" size="64" id="button_name" class="TextInput" type="text" title="button_name" value="<?php echo $_POST['button_name'];?>">
				</td>
			</tr>
			<tr id="sort">
				<th>Sort</th>
				<td class="<?php if(banners_err_check("sort")){ echo "errorInput"; }?> must">
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
		<h2>BannersAdd/Edit</h2>
		<table>
			<tr>
				<th>Image</th>
				<td><?php if(!empty($_SESSION['banners']['image_path'])){ ?> <img src="/admin/images/banners/<?php echo $_SESSION['banners']['image_path'];?>" width="100"> <?php } ?>
</td>
			</tr>
			<tr>
				<th>Url</th>
				<td><?php echo htmlspecialchars($_POST['url'],ENT_QUOTES);?></td>
			</tr>
			<tr>
				<th>Alt</th>
				<td><?php echo htmlspecialchars($_POST['alt'],ENT_QUOTES);?></td>
			</tr>
			<tr>
				<th>Title</th>
				<td><?php echo htmlspecialchars($_POST['title'],ENT_QUOTES);?></td>
			</tr>
			<tr>
				<th>Description</th>
				<td><?php echo str_replace("\n","<br />",htmlspecialchars($_POST['description'],ENT_QUOTES));?></td>
			</tr>
			<tr>
				<th>Button Name</th>
				<td><?php echo htmlspecialchars($_POST['button_name'],ENT_QUOTES);?></td>
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
