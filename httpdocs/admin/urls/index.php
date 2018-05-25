<?php include "../../../controller/admin/urls/index.php"; ?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Urls List</title>
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
	$(".type").chosen();
});
</script>
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
	$(".property_type_groups_id").chosen();
});
</script>
<script type="text/javascript">
$(function(){
	$(".ad_flag").chosen();
});
</script>

</head>
<body>
<div id="wrapper">
<div id="contents">
<?php include "../common/header.php"; ?>
<article id="contBox">
	<h2>Urls List</h2>
	<section id="searchBox">
		<form id="Login" name="Login" action="<?php echo $_SERVER['SCRIPT_NAME'];?>" method="post">
		<p class="arw-folding trigger_search">Search Condition：</p>
		<div class="toggle_search">
			<table>
			<tr>
				<th>Url</th>
				<th>Type</th>
				<th>State</th>
				<th>Ares Group</th>
				<th>Property Type Groups</th>
				<th>Conditions Num</th>
				<th>Listings Num</th>
			</tr>
			<tr>
				<td>
				<input name="url" value="<?php echo $_SESSION['urls']['url'];?>" size="20" id="name1" class="TextInput" type="text" title="">
				</td>
				<td>
				<select name="type" data-placeholder="Please Choose Type..." class="type" />
				<option value=""></option>
<?php
foreach( $urls_type_list as $key => $val ){
?>
				<option value="<?php echo $key;?>" <?php if( $key == $_SESSION['urls']['type'] ){ echo "selected"; } ?>><?php echo $val;?></option>
<?php
}
?>
				</select>
				</td>
				<td>
				<select name="states_id" data-placeholder="Please Choose State..." class="states_id" />
				<option value="">Not selected(NULL)</option>
				<option value="notnull" <?php if( $_SESSION['urls']['states_id'] == "notnull" ){ echo "selected"; } ?>>Not NULL</option>
<?php
$result = states_index();
while( $arr = mysql_fetch_array( $result )){
?>
				<option value="<?php echo $arr['id'];?>" <?php if( $arr['id'] == $_SESSION['urls']['states_id'] ){ echo "selected"; } ?>><?php echo $arr['name'];?></option>
<?php
}
?>
				</select>
				</td>
				<td>
				<select name="groups_id" data-placeholder="Please Choose Ares Group..." class="groups_id" />
				<option value="">Not selected(NULL)</option>
				<option value="notnull" <?php if( $_SESSION['urls']['groups_id'] == "notnull" ){ echo "selected"; } ?>>Not NULL</option>
<?php
$result = groups_index();
while( $arr = mysql_fetch_array( $result )){
?>
				<option value="<?php echo $arr['id'];?>" <?php if( $arr['id'] == $_SESSION['urls']['groups_id'] ){ echo "selected"; } ?>><?php echo $arr['name'];?></option>
<?php
}
?>
				</select>
				</td>
				<td>
				<select name="property_type_groups_id" data-placeholder="Please Choose Property Type Groups..." class="property_type_groups_id" />
				<option value="">Not selected(NULL)</option>
				<option value="notnull" <?php if( $_SESSION['urls']['property_type_groups_id'] == "notnull" ){ echo "selected"; } ?>>Not NULL</option>
<?php
$result = property_type_groups_index();
while( $arr = mysql_fetch_array( $result )){
?>
				<option value="<?php echo $arr['id'];?>" <?php if( $arr['id'] == $_SESSION['urls']['property_type_groups_id'] ){ echo "selected"; } ?>><?php echo $arr['name'];?></option>
<?php
}
?>
				</select>
				</td>
				<td>
				<input name="conditions_num" value="<?php echo $_SESSION['urls']['conditions_num'];?>" size="20" id="name1" class="TextInput" type="text" title="">
				</td>
				<td>
				<input name="listings_num" value="<?php echo $_SESSION['urls']['listings_num'];?>" size="20" id="name1" class="TextInput" type="text" title="">
				</td>
			</tr>
			<tr>
				<th>Ad Flag</th>
				<th>Completion Year</th>
				<th>Display Status</th>
			</tr>
			<tr>
				<td>
				<select name="ad_flag" data-placeholder="Please Choose Ad Flag..." class="ad_flag" />
				<option value="">Not selected(NULL)</option>
<?php
foreach( $urls_ad_flag_list as $key => $val ){
?>
				<option value="<?php echo $key;?>" <?php if( $key == $_SESSION['urls']['ad_flag'] ){ echo "selected"; } ?>><?php echo $val;?></option>
<?php
}
?>
				</select>
				</td>
				<td>
				<select name="completion_year" />
				<option value="" <?php if(empty($_SESSION['urls']['completion_year'])){ echo "selected"; } ?>>Not selected (Null)</option>
				<option value="complete" <?php if($_SESSION['urls']['completion_year']=="complete"){ echo "selected"; } ?>>Not Null</option>
				<option value="completed" <?php if($_SESSION['urls']['completion_year']=="completed"){ echo "selected"; } ?>>Already completed</option>
				<option value="complete-2016" <?php if($_SESSION['urls']['completion_year']=="complete-2016"){ echo "selected"; } ?>>2016</option>
				<option value="complete-2017" <?php if($_SESSION['urls']['completion_year']=="complete-2017"){ echo "selected"; } ?>>2017</option>
				<option value="complete-2018" <?php if($_SESSION['urls']['completion_year']=="complete-2018"){ echo "selected"; } ?>>2018</option>
				<option value="complete-2019" <?php if($_SESSION['urls']['completion_year']=="complete-2019"){ echo "selected"; } ?>>After 2019</option>
				</select>
				</td>
				<td>
				<select name="is_deleted" />
				<option value="0" <?php if(empty($_SESSION['urls']['is_deleted'])){ echo "selected"; } ?>>Showing</option>
				<option value="1" <?php if($_SESSION['urls']['is_deleted']){ echo "selected"; } ?>>Hide</option>
				</select>
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
				<th class="unsortable">Url</th>
				<th class="unsortable">Type</th>
				<th class="unsortable">State</th>
				<th class="unsortable">Ares Group</th>
				<th class="unsortable">Property Type Groups</th>
				<th class="unsortable">Conditions Num</th>
				<th class="unsortable">Listings Num</th>
				<th class="unsortable">Ad Flag</th>
				<th class="unsortable">Created</th>
			</tr>
<?php
$result = $index( $lines );
if(mysql_num_rows($result)){
	while( $arr = mysql_fetch_array( $result )){
?>
			<tr>
				<td class="edit"><a href="./edit.php?id=<?php echo $arr['id'];?>">edit</a></td>
				<td><a href="<?php echo $arr['url'];?>" target="_blank"><?php echo $arr['url'];?></a></td>
				<td><?php echo $urls_type_list[$arr['type']];?></td>
				<td><?php echo common_get_value("states","name",$arr['states_id'],"");?>
</td>
				<td><?php echo common_get_value("groups","name",$arr['groups_id'],"");?>
</td>
				<td><?php echo common_get_value("property_type_groups","name",$arr['property_type_groups_id'],"");?>
</td>
				<td><?php echo $arr['conditions_num'];?></td>
				<td><?php echo $arr['listings_num'];?></td>
				<td><?php echo $urls_ad_flag_list[$arr['ad_flag']];?></td>
				<td><?php echo $arr['created'];?></td>
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
<!--script type="text/javascript" src="/admin/js/jquery-1.3.1.min.js"></script-->
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
