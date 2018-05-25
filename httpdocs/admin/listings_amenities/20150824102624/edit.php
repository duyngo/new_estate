<?php include "/home/newpropertylist.my/controller/admin/listings_amenities/edit.php"; ?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Amenities Add/Edit</title>
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
	$(".amenities_id").chosen();
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
		<h2>Amenities Add/Edit</h2>
		<form id="Login" name="Login" action="<?php echo $_SERVER['SCRIPT_NAME'];?>" method="post" ENCTYPE="multipart/form-data">
<?php
if( $_POST['act'] == "err" ){
?>
	<ul class="errorTxt"><?php echo listings_amenities_err_check(NULL); ?></ul>
<?php
}
?>
		<table>
			<tr id="listings_id">
				<th>Listing</th>
				<td class="<?php if(listings_amenities_err_check("listings_id")){ echo "errorInput"; }?> must">
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
			<tr id="amenities_id">
				<th>Amenities</th>
				<td class="<?php if(listings_amenities_err_check("amenities_id")){ echo "errorInput"; }?> must">
				<select name="amenities_id" data-placeholder="Please Choose Amenities..." style="width:250px;" class="amenities_id" />
				<option value="0">Not selected(NULL)</option>
<?php
$result = amenities_index();
while( $arr = mysql_fetch_array( $result )){
?>
				<option value="<?php echo $arr['id'];?>" <?php if( $arr['id'] == $_POST['amenities_id'] ){ echo "selected"; } ?>><?php echo $arr['name'];?>(<?php echo $arr['id'];?>)</option>
<?php
}
?>
				</select>
				</td>
			</tr>
			<tr id="sort">
				<th>Sort</th>
				<td class="<?php if(listings_amenities_err_check("sort")){ echo "errorInput"; }?> must">
					<input name="sort" size="2" id="sort" class="TextInput" type="text" title="sort" value="<?php echo $_POST['sort'];?>">
				</td>
			</tr>
			<tr id="display_flag">
				<th>Display Flag</th>
				<td class="<?php if(listings_amenities_err_check("display_flag")){ echo "errorInput"; }?> must">
<div><label><?php
foreach( $listings_amenities_display_flag_list as $key => $val ){
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
		<h2>AmenitiesAdd/Edit</h2>
		<table>
			<tr>
				<th>Listing</th>
				<td><?php echo common_get_value("listings","name",$_POST['listings_id'],"");?></td>
			</tr>
			<tr>
				<th>Amenities</th>
				<td><?php echo common_get_value("amenities","name",$_POST['amenities_id'],"");?></td>
			</tr>
			<tr>
				<th>Sort</th>
				<td><?php echo htmlspecialchars($_POST['sort'],ENT_QUOTES);?></td>
			</tr>
			<tr>
				<th>Display Flag</th>
				<td><?php echo $listings_amenities_display_flag_list[$_POST['display_flag']];?></td>
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
