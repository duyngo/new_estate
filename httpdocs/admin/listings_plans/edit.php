<?php include "../../../controller/admin/listings_plans/edit.php"; ?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Plans Add/Edit</title>
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
		<h2>Plans Add/Edit</h2>
		<form id="Login" name="Login" action="<?php echo $_SERVER['SCRIPT_NAME'];?>" method="post" ENCTYPE="multipart/form-data">
<?php
if( $_POST['act'] == "err" ){
?>
	<ul class="errorTxt"><?php echo listings_plans_err_check(NULL); ?></ul>
<?php
}
?>
		<table>
			<tr id="listings_id">
				<th>Listing</th>
				<td class="<?php if(listings_plans_err_check("listings_id")){ echo "errorInput"; }?> must">
				<select name="listings_id" data-placeholder="Please Choose Listing..." style="width:250px;" class="listings_id" />
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
			<tr id="name">
				<th>Name</th>
				<td class="<?php if(listings_plans_err_check("name")){ echo "errorInput"; }?> must">
					<input name="name" size="64" id="name" class="TextInput" type="text" title="name" value="<?php echo $_POST['name'];?>">
				</td>
			</tr>
			<tr id="image_path">
				<th>Image</th>
				<td class="<?php if(listings_plans_err_check("image_path")){ echo "errorInput"; }?>">
<?php if(!empty($_SESSION['listings_plans']['image_path'])){ ?>
				<div>
					<div><img src="/admin/images/listings_plans/<?php echo $_SESSION['listings_plans']['image_path'];?>" width="100"></div>
					<div><input type="checkbox" name="image_path" value="delete">delete this image</div>
				</div>
<?php } ?>
				<input type="file" name="image_path" />
<p class="note">※※width:428 * height:328 size required</p>				</td>
			</tr>
			<tr id="size">
				<th>Size</th>
				<td class="<?php if(listings_plans_err_check("size")){ echo "errorInput"; }?>">
					<input name="size" size="128" id="size" class="TextInput" type="text" title="size" value="<?php echo $_POST['size'];?>">
				</td>
			</tr>
			<tr id="bedrooms">
				<th>Bedrooms</th>
				<td class="<?php if(listings_plans_err_check("bedrooms")){ echo "errorInput"; }?>">
					<input name="bedrooms" size="128" id="bedrooms" class="TextInput" type="text" title="bedrooms" value="<?php echo $_POST['bedrooms'];?>">
				</td>
			</tr>
			<tr id="bathrooms">
				<th>Bathrooms</th>
				<td class="<?php if(listings_plans_err_check("bathrooms")){ echo "errorInput"; }?>">
					<input name="bathrooms" size="128" id="bathrooms" class="TextInput" type="text" title="bathrooms" value="<?php echo $_POST['bathrooms'];?>">
				</td>
			</tr>
			<tr id="price">
				<th>Price</th>
				<td class="<?php if(listings_plans_err_check("price")){ echo "errorInput"; }?>">
					<input name="price" size="128" id="price" class="TextInput" type="text" title="price" value="<?php echo $_POST['price'];?>">
				</td>
			</tr>
			<tr id="sort">
				<th>Sort</th>
				<td class="<?php if(listings_plans_err_check("sort")){ echo "errorInput"; }?> must">
					<input name="sort" size="2" id="sort" class="TextInput" type="text" title="sort" value="<?php echo $_POST['sort'];?>">
				</td>
			</tr>
			<tr id="display_flag">
				<th>Display Flag</th>
				<td class="<?php if(listings_plans_err_check("display_flag")){ echo "errorInput"; }?> must">
<div><label><?php
foreach( $listings_plans_display_flag_list as $key => $val ){
?>
				<input id="display_flag" name="display_flag" type="radio" value="<?php echo $key;?>" <?php if( $key == $_POST['display_flag'] ){ echo "checked"; } ?>><?php echo $val;?><?php
}
?>
</label></div>				</td>
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
		<h2>PlansAdd/Edit</h2>
		<table>
			<tr>
				<th>Listing</th>
				<td><?php echo common_get_value("listings","name",$_POST['listings_id'],"");?></td>
			</tr>
			<tr>
				<th>Name</th>
				<td><?php echo htmlspecialchars($_POST['name'],ENT_QUOTES);?></td>
			</tr>
			<tr>
				<th>Image</th>
				<td><?php if(!empty($_SESSION['listings_plans']['image_path'])){ ?> <img src="/admin/images/listings_plans/<?php echo $_SESSION['listings_plans']['image_path'];?>" width="100"> <?php } ?>
</td>
			</tr>
			<tr>
				<th>Size</th>
				<td><?php echo htmlspecialchars($_POST['size'],ENT_QUOTES);?></td>
			</tr>
			<tr>
				<th>Bedrooms</th>
				<td><?php echo htmlspecialchars($_POST['bedrooms'],ENT_QUOTES);?></td>
			</tr>
			<tr>
				<th>Bathrooms</th>
				<td><?php echo htmlspecialchars($_POST['bathrooms'],ENT_QUOTES);?></td>
			</tr>
			<tr>
				<th>Price</th>
				<td><?php echo htmlspecialchars($_POST['price'],ENT_QUOTES);?></td>
			</tr>
			<tr>
				<th>Sort</th>
				<td><?php echo htmlspecialchars($_POST['sort'],ENT_QUOTES);?></td>
			</tr>
			<tr>
				<th>Display Flag</th>
				<td><?php echo $listings_plans_display_flag_list[$_POST['display_flag']];?></td>
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
