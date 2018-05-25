<?php
include "/home/" . $_SERVER['SERVER_NAME'] . "/controller/admin/users/edit.php";
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title><?php echo $tables_logical_name;?> Edit</title>
<meta charset="utf-8">
<meta name="description" content="">
<meta name="author" content="">
<link rel="stylesheet" href="/admin/css/import.css">
<script src="/admin/js/common.js"></script>
<script type="text/javascript" language="javascript" src="/admin/js/jquery.dropdownPlain.js"></script>
<script type="text/javascript" src="/admin/js/jquery.js"></script>
<script type="text/javascript" src="/admin/js/placeholder.js"></script>
<!--[if lt IE 9]>
<script src="//cdn.jsdelivr.net/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<!--[if IE 6]>
<script src="js/DD_belatedPNG_0.0.8a-min.js"></script>
<script>
DD_belatedPNG.fix('img, .png');
</script>
<![endif]-->
</head>
<body>
<div id="wrapper">
<div id="contents">
<?php
include "../common/header.php";
?>
<article id="contBox">

<?php
if(empty($_POST['act']) || $_POST['act'] == "err" || $_POST['act'] == "back" ){
?>
	<section id="editForm">
		<h2><?php echo $tables_logical_name;?> Edit</h2>
		<form id="Login" name="Login" action="<?php echo $_SERVER['SCRIPT_NAME'];?>" method="post">
<?php
if(!empty($err_msg)){
?>
		<ul class="errorTxt"><?php echo $err_msg;?></ul>
<?php
}
?>
		<table>
			<tr>
				<th>Email</th>
				<td class="errorInput must"><input name="email" size="50" id="name" class="TextInput" type="email" title="" value="<?php echo $_POST['email'];?>">
<p class="note">
This will serve as your login email and your itinerary will be sent here.
</p>
</td>
			</tr>
			<tr>
				<th>Password</th>
				<td class="<?php if(empty($_POST['id'])){ echo "errorInput must";} ?>"><input name="password" size="50" id="name" class="TextInput" type="password" title="" value="<?php echo $_POST['password'];?>">

<p class="note">
Password must be 8-15 alphanumeric characters with these requirements<br /> 
- number (0-9) <br />
- lowercase letter (a-z) <br />
- uppercase letter (A-Z)
</p>
</td>
			</tr>
			<tr>
				<th>Re-enter password</th>
				<td class="<?php if(empty($_POST['id'])){ echo "errorInput must";} ?>"><input name="password2" size="50" id="name" class="TextInput" type="password" title="" value="<?php echo $_POST['password2'];?>"></td>
			</tr>
			<tr>
				<th>Title</th>
				<td class="errorInput must">
<?php
foreach( $users_title_list as $key => $val ){
?>
<input name="title" id="name" class="TextInput" type="radio" title="" value="<?php echo $key;?>" <?php if( $_POST['title'] == $key ){ echo "checked"; } ?>><?php echo $val;?>　
<?php
}
?>
				</td>
			</tr>
			<tr>
				<th>First name</th>
				<td class="errorInput must"><input name="first_name" size="50" id="name" class="TextInput" type="text" title="" value="<?php echo $_POST['first_name'];?>">
<p class="note">Enter name as per passport/IC in roman alphabets (A-Z,a-z) only</p>
</td>
			</tr>
			<tr>
				<th>Last name</th>
				<td class="errorInput must"><input name="last_name" size="50" id="name" class="TextInput" type="text" title="" value="<?php echo $_POST['last_name'];?>">
<p class="note">Enter name as per passport/IC in roman alphabets (A-Z,a-z) only</p>
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
		<h2><?php echo $tables_logical_name;?> Edit</h2>
		<table>
			<tr>
				<th>Email</th>
				<td><?php echo $_POST['email'];?></td>
			</tr>
			<tr>
				<th>Password</th>
				<td><?php echo str_pad("", strlen($_POST['password']), "*");?></td>
			</tr>
			<tr>
				<th>Title</th>
				<td><?php echo $users_title_list[$_POST['title']];?></td>
			</tr>
			<tr>
				<th>First name</th>
				<td><?php echo $_POST['first_name'];?></td>
			</tr>
			<tr>
				<th>Last name</th>
				<td><?php echo $_POST['last_name'];?></td>
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

<script type="text/javascript" src="/admin/js/jquery-1.3.1.min.js"></script>	

</body>
</html>
