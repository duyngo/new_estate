<?php include "/home/newpropertylist.my/controller/admin/external_users/index.php"; ?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>External users List</title>
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
	<h2>External users List</h2>
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
				<input name="email" value="<?php echo $_SESSION['external_users']['email'];?>" size="50" id="name1" class="TextInput" type="text">
				</td>
				<td>
				<input name="first_name" value="<?php echo $_SESSION['external_users']['first_name'];?>" size="50" id="name1" class="TextInput" type="text">
				</td>
				<td>
				<input name="last_name" value="<?php echo $_SESSION['external_users']['last_name'];?>" size="50" id="name1" class="TextInput" type="text">
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
				<th class="companies_id unsortable">Company</th>
				<th class="email unsortable">Email</th>
				<th class="title unsortable">Title</th>
				<th class="first_name unsortable">First name</th>
				<th class="last_name unsortable">Last name</th>
				<th class="tel unsortable">TEL</th>
				<th class="mobile unsortable">Mobile</th>
				<th class="delete unsortable">delete</th>
			</tr>
<?php
$result = $index( $lines );
if(mysql_num_rows($result)){
	while( $arr = mysql_fetch_array( $result )){
?>
			<tr>
				<td class="edit"><a href="./edit.php?id=<?php echo $arr['id'];?>">edit</a></td>
				<td class="companies_id"><?php echo common_get_value("companies","name",$arr['companies_id'],"");?>
</td>
				<td class="email"><?php echo $arr['email'];?></td>
				<td class="title"><?php echo $external_users_title_list[$arr['title']];?></td>
				<td class="first_name"><?php echo $arr['first_name'];?></td>
				<td class="last_name"><?php echo $arr['last_name'];?></td>
				<td class="tel"><?php echo $arr['tel'];?></td>
				<td class="mobile"><?php echo $arr['mobile'];?></td>
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
