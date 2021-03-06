<?php include "/home/newpropertylist.my/controller/admin/amenities/index.php"; ?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Amenity List</title>
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
</head>
<body>
<div id="wrapper">
<div id="contents">
<?php include "../common/header.php"; ?>
<article id="contBox">
	<h2>Amenity List</h2>
	<section id="searchBox">
		<form id="Login" name="Login" action="<?php echo $_SERVER['SCRIPT_NAME'];?>" method="post">
		<p class="arw-folding trigger_search">Search Condition：</p>
		<div class="toggle_search">
			<table>
			<tr>
				<th>Amenity name</th>
				<th>Map coordinates</th>
			</tr>
			<tr>
				<td>
				<input name="name" value="<?php echo $_SESSION['amenities']['name'];?>" size="50" id="name1" class="TextInput" type="text">
				</td>
				<td>
				<input name="map_coordinates" value="<?php echo $_SESSION['amenities']['map_coordinates'];?>" size="50" id="name1" class="TextInput" type="text">
				</td>
			</tr>
			</table>
			<div class="searchBtnBox">
				<p class="searchBtn"><input value="Search" id="submit" type="submit"></p>
			<input type="hidden" name="act" value="search">
			</form>
			<form id="Login2" name="Login2" action="<?php echo $_SERVER['SCRIPT_NAME'];?>" method="post">
			<p class="resetBtn"><input value="Clear" id="reset" type="submit"></p>
			<input type="hidden" name="act" value="clear">
			</form>
			</div>
		</div>
	</section>
	<section id="resultBox">
		<p class="resultNum">Search Result：<span><?php echo $row_num;?></span>Hit</p>
		<form action="./edit.php" method="post">
		<p class="registBtn">
		<input value="Add" id="submit" type="submit">
		</p>
		</form>
		<div class="pager">
		<?php include "../common/pager.php"; ?>
		</div>
		<table id="resultTbl" class="resultTbl sortable">
			<tr>
				<th class="edit unsortable">edit</th>
				<th class="states_id unsortable">State</th>
				<th class="groups_id unsortable">Area Group</th>
				<th class="amenity_categories_id unsortable">Category</th>
				<th class="name unsortable">Amenity name</th>
				<th class="image_path unsortable">Picture</th>
				<th class="map_coordinates unsortable">Map coordinates</th>
				<th class="delete unsortable">delete</th>
			</tr>
<?php
$result = $index( $lines );
if(mysql_num_rows($result)){
	while( $arr = mysql_fetch_array( $result )){
?>
			<tr>
				<td class="edit"><a href="./edit.php?id=<?php echo $arr['id'];?>">edit</a></td>
				<td class="states_id"><?php echo common_get_value("states","name",$arr['states_id'],"");?>
</td>
				<td class="groups_id"><?php echo common_get_value("groups","name",$arr['groups_id'],"");?>
</td>
				<td class="amenity_categories_id"><?php echo common_get_value("amenity_categories","name",$arr['amenity_categories_id'],"");?>
</td>
				<td class="name"><?php echo $arr['name'];?></td>
				<td class="image_path"><?php if(!empty($arr['image_path'])){ ?><img src="/admin/images/amenities/<?php echo $arr['image_path'];?>" width="100" height="auto"><?php } ?></td>
				<td class="map_coordinates"><?php echo $arr['map_coordinates'];?></td>
				<td class="delete"><a href="./index.php?act=delete&id=<?php echo $arr['id'];?>" onclick="return delete_check();">delete</a></td>
			</tr>
<?php
	}
}
?>
		</table>
		<div class="pager" style="margin-top:15px;">
		<?php include "../common/pager.php"; ?>
		</div>
	</section>
<div id="pagetop"><a href="#wrapper"><img src="/admin/images/pagetop.gif" alt="ページトップへ" width="50" height="50"></a></div>
</article>
</div><!--contents-->
<?php include "../common/footer.php"; ?>
</div><!--wrapper-->
<!-- SCRIPTS -->
<script type="text/javascript" src="/admin/js/jquery-1.3.1.min.js"></script>
<script language="Javascript">
<!--
function delete_check(){
	res=confirm("Do you want to delete?")
	if(res == false){ return false; }
}
//-->
</script>
</body>
</html>
