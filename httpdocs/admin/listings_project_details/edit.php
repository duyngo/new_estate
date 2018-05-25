<?php include "../../../controller/admin/listings_project_details/edit.php"; ?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>project details Add/Edit</title>
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
		<h2>project details Add/Edit</h2>
		<form id="Login" name="Login" action="<?php echo $_SERVER['SCRIPT_NAME'];?>" method="post" ENCTYPE="multipart/form-data">
<?php
if( $_POST['act'] == "err" ){
?>
	<ul class="errorTxt"><?php echo listings_project_details_err_check(NULL); ?></ul>
<?php
}
?>
		<table>
			<tr id="listings_id">
				<th>Listings</th>
				<td class="<?php if(listings_project_details_err_check("listings_id")){ echo "errorInput"; }?> must">
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
			<tr id="head">
				<th>Head</th>
				<td class="<?php if(listings_project_details_err_check("head")){ echo "errorInput"; }?>">
					<input name="head" size="128" id="head" class="TextInput" type="text" title="head" value="<?php echo $_POST['head'];?>">
				</td>
			</tr>
			<tr id="sub_head">
				<th>Sub_Head</th>
				<td class="<?php if(listings_project_details_err_check("sub_head")){ echo "errorInput"; }?>">
					<input name="sub_head" size="128" id="sub_head" class="TextInput" type="text" title="sub_head" value="<?php echo $_POST['sub_head'];?>">
				</td>
			</tr>
			<tr id="body">
				<th>Body</th>
				<td class="<?php if(listings_project_details_err_check("body")){ echo "errorInput"; }?>">
					<textarea name="body" title="" rows="5" cols="50" id="body" ><?php echo $_POST['body'];?></textarea>
				</td>
			</tr>
			<tr id="image_path">
				<th>Photo</th>
				<td class="<?php if(listings_project_details_err_check("image_path")){ echo "errorInput"; }?>">
<?php if(!empty($_SESSION['listings_project_details']['image_path'])){ ?>
				<div>
					<div><img src="/admin/images/listings_project_details/<?php echo $_SESSION['listings_project_details']['image_path'];?>" width="100"></div>
					<div><input type="checkbox" name="image_path" value="delete">delete this image</div>
				</div>
<?php } ?>
				<input type="file" name="image_path" />
				</td>
			</tr>
			<tr id="image_path_caption">
				<th>Photo Caption</th>
				<td class="<?php if(listings_project_details_err_check("image_path_caption")){ echo "errorInput"; }?>">
					<input name="image_path_caption" size="128" id="image_path_caption" class="TextInput" type="text" title="image_path_caption" value="<?php echo $_POST['image_path_caption'];?>">
				</td>
			</tr>
			<tr id="sort">
				<th>Sort</th>
				<td class="<?php if(listings_project_details_err_check("sort")){ echo "errorInput"; }?> must">
					<input name="sort" size="2" id="sort" class="TextInput" type="text" title="sort" value="<?php echo $_POST['sort'];?>">
				</td>
			</tr>
			<tr id="display_flag">
				<th>Display Flag</th>
				<td class="<?php if(listings_project_details_err_check("display_flag")){ echo "errorInput"; }?> must">
<div><label><?php
foreach( $listings_project_details_display_flag_list as $key => $val ){
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
		<h2>project detailsAdd/Edit</h2>
		<table>
			<tr>
				<th>Listings</th>
				<td><?php echo common_get_value("listings","name",$_POST['listings_id'],"");?></td>
			</tr>
			<tr>
				<th>Head</th>
				<td><?php echo htmlspecialchars($_POST['head'],ENT_QUOTES);?></td>
			</tr>
			<tr>
				<th>Sub_Head</th>
				<td><?php echo htmlspecialchars($_POST['sub_head'],ENT_QUOTES);?></td>
			</tr>
			<tr>
				<th>Body</th>
				<td><?php echo str_replace("\n","<br />",htmlspecialchars($_POST['body'],ENT_QUOTES));?></td>
			</tr>
			<tr>
				<th>Photo</th>
				<td><?php if(!empty($_SESSION['listings_project_details']['image_path'])){ ?> <img src="/admin/images/listings_project_details/<?php echo $_SESSION['listings_project_details']['image_path'];?>" width="100"> <?php } ?>
</td>
			</tr>
			<tr>
				<th>Photo Caption</th>
				<td><?php echo htmlspecialchars($_POST['image_path_caption'],ENT_QUOTES);?></td>
			</tr>
			<tr>
				<th>Sort</th>
				<td><?php echo htmlspecialchars($_POST['sort'],ENT_QUOTES);?></td>
			</tr>
			<tr>
				<th>Display Flag</th>
				<td><?php echo $listings_project_details_display_flag_list[$_POST['display_flag']];?></td>
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
