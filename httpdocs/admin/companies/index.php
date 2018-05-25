<?php include "../../../controller/admin/companies/index.php"; ?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Company List</title>
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
	$(".parent_id").chosen();
});
</script>

</head>
<body>
<div id="wrapper">
<div id="contents">
<?php include "../common/header.php"; ?>
<article id="contBox">
	<h2>Company List</h2>
	<section id="searchBox">
		<form id="Login" name="Login" action="<?php echo $_SERVER['SCRIPT_NAME'];?>" method="post">
		<p class="arw-folding trigger_search">Search Condition：</p>
		<div class="toggle_search">
			<table>
			<tr>
				<th>Company name</th>
				<th>Classification</th>
				<th>Pick Up</th>
				<th>Developers list display flag</th>
			</tr>
			<tr>
				<td>
				<input name="name" value="<?php echo $_SESSION['companies']['name'];?>" size="20" id="name1" class="TextInput" type="text" title="">
				</td>
				<td>
				<select name="class" data-placeholder="Please Choose Classification..." class="class" />
				<option value=""></option>
<?php
foreach( $companies_class_list as $key => $val ){
?>
				<option value="<?php echo $key;?>" <?php if( $key == $_SESSION['companies']['class'] ){ echo "selected"; } ?>><?php echo $val;?></option>
<?php
}
?>
				</select>
				</td>
				<td>
				<select name="pickup_flag" data-placeholder="Please Choose Pick Up..." class="pickup_flag" />
				<option value=""></option>
<?php
foreach( $companies_pickup_flag_list as $key => $val ){
?>
				<option value="<?php echo $key;?>" <?php if( $key == $_SESSION['companies']['pickup_flag'] ){ echo "selected"; } ?>><?php echo $val;?></option>
<?php
}
?>
				</select>
				</td>
				<td>
				<select name="developers_list_display_flag" data-placeholder="Please Choose Developers list display flag..." class="developers_list_display_flag" />
				<option value=""></option>
<?php
foreach( $companies_developers_list_display_flag_list as $key => $val ){
?>
				<option value="<?php echo $key;?>" <?php if( $key == $_SESSION['companies']['developers_list_display_flag'] ){ echo "selected"; } ?>><?php echo $val;?></option>
<?php
}
?>
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
				<th class="detail unsortable">detail</th>
				<th class="unsortable">Company name</th>
				<th class="unsortable">Rank</th>
				<th class="unsortable">Classification</th>
				<th class="unsortable">Corporate site URL</th>
				<th class="unsortable">Pick Up</th>
				<th class="unsortable">Person in charge</th>
				<th class="delete unsortable">delete</th>
			</tr>
<?php
$result = $index( $lines );
if(mysql_num_rows($result)){
	while( $arr = mysql_fetch_array( $result )){
?>
			<tr>
				<td class="edit"><a href="./edit.php?id=<?php echo $arr['id'];?>">edit</a></td>
				<td class="detail"><a href="./detail.php?id=<?php echo $arr['id'];?>">detail</a></td>
				<td><?php echo $arr['name'];?></td>
				<td><?php echo $companies_rank_list[$arr['rank']];?></td>
				<td><?php echo $arr['class'];?></td>
				<td><?php echo $arr['url'];?></td>
				<td><?php echo $companies_pickup_flag_list[$arr['pickup_flag']];?></td>
				<td><?php echo companies_get_external_users($arr['id']);?></td>
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
