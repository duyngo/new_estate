<?php include "/home/newpropertylist.my/controller/client/external_users/index.php"; ?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>users List</title>
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
	$(".companies_id").chosen();
});
</script>

</head>
<body>
<div id="wrapper">
<div id="contents">
<?php include "../common/header.php"; ?>
<article id="contBox">
	<h2>Users List</h2>
	<section id="searchBox">
		<form id="Login" name="Login" action="<?php echo $_SERVER['SCRIPT_NAME'];?>" method="post">
		<p class="arw-folding trigger_search">Search Condition：</p>
		<div class="toggle_search">
			<table>
			<tr>
				<th>Email</th>
				<th>First name</th>
				<th>Last name</th>
			</tr>
			<tr>
				<td>
				<input name="email" value="<?php echo $_SESSION['external_users']['email'];?>" size="20" id="name1" class="TextInput" type="text" title="">
				</td>
				<td>
				<input name="first_name" value="<?php echo $_SESSION['external_users']['first_name'];?>" size="20" id="name1" class="TextInput" type="text" title="">
				</td>
				<td>
				<input name="last_name" value="<?php echo $_SESSION['external_users']['last_name'];?>" size="20" id="name1" class="TextInput" type="text" title="">
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
		<!--form action="./edit.php" method="post">
		<p class="registBtn">
		<input value="Add" id="submit" type="submit">
		</p>
		</form-->
		<div class="pager">
		<?php include "../common/pager.php"; ?>
		</div>
		<table id="resultTbl" class="resultTbl sortable">
			<tr>
				<th class="edit unsortable">edit</th>
				<th class="unsortable">Email</th>
				<th class="unsortable">Title</th>
				<th class="unsortable">First name</th>
				<th class="unsortable">Last name</th>
				<th class="unsortable">TEL</th>
				<th class="unsortable">Mobile</th>
			</tr>
<?php
$result = $index( $lines );
if(mysql_num_rows($result)){
	while( $arr = mysql_fetch_array( $result )){
?>
			<tr>
				<td class="edit"> <?php if( $arr['id'] == $_SESSION['external_users_id'] ){ ?> <a href="./edit.php?id=<?php echo $arr['id'];?>">edit</a> <?php } ?> </td>
</td>
				<td><?php echo $arr['email'];?></td>
				<td><?php echo $external_users_title_list[$arr['title']];?></td>
				<td><?php echo $arr['first_name'];?></td>
				<td><?php echo $arr['last_name'];?></td>
				<td><?php echo $arr['tel'];?></td>
				<td><?php echo $arr['mobile'];?></td>
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
