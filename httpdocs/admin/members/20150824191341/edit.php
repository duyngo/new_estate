<?php include "/home/newpropertylist.my/controller/admin/members/edit.php"; ?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Members Add/Edit</title>
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
		<h2>Members Add/Edit</h2>
		<form id="Login" name="Login" action="<?php echo $_SERVER['SCRIPT_NAME'];?>" method="post" ENCTYPE="multipart/form-data">
<?php
if( $_POST['act'] == "err" ){
?>
	<ul class="errorTxt"><?php echo members_err_check(NULL); ?></ul>
<?php
}
?>
		<table>
			<tr id="name">
				<th>name</th>
				<td class="<?php if(members_err_check("name")){ echo "errorInput"; }?> must">
					<input name="name" size="64" id="name" class="TextInput" type="text" title="name" value="<?php echo $_POST['name'];?>">
				</td>
			</tr>
			<tr id="email">
				<th>email</th>
				<td class="<?php if(members_err_check("email")){ echo "errorInput"; }?> must">
					<input name="email" size="128" id="email" class="TextInput" type="email" title="email" value="<?php echo $_POST['email'];?>">
				</td>
			</tr>
			<tr id="password">
				<th>password</th>
				<td class="<?php if(members_err_check("password")){ echo "errorInput"; }?>">
					<input name="password" size="20" id="password" class="TextInput" type="password" title="password" value="<?php echo $_POST['password'];?>">
				</td>
			</tr>
			<tr>
				<th>Re-enter password</th>
				<td class="<?php if(members_err_check("password")){ echo "errorInput"; }?>">
					<input name="password2" size="20" id="name" class="TextInput" type="password" title="" value="<?php echo $_POST['password2'];?>">
				</td>
			</tr>
			<tr id="phone">
				<th>phone</th>
				<td class="<?php if(members_err_check("phone")){ echo "errorInput"; }?> must">
					<input name="phone" size="64" id="phone" class="TextInput" type="text" title="phone" value="<?php echo $_POST['phone'];?>">
				</td>
			</tr>
			<tr id="nationality">
				<th>Nationality</th>
				<td class="<?php if(members_err_check("nationality")){ echo "errorInput"; }?> must">
<div><label><?php
foreach( $members_nationality_list as $key => $val ){
?>
				<input id="nationality" name="nationality" type="radio" value="<?php echo $key;?>" <?php if( $key == $_POST['nationality'] ){ echo "checked"; } ?>><?php echo $val;?><?php
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
		<h2>MembersAdd/Edit</h2>
		<table>
			<tr>
				<th>name</th>
				<td><?php echo htmlspecialchars($_POST['name'],ENT_QUOTES);?></td>
			</tr>
			<tr>
				<th>email</th>
				<td><?php echo $_POST['email'];?></td>
			</tr>
			<tr>
				<th>password</th>
				<td><?php echo str_pad("", strlen($_POST['password']), "*") ;?></td>
			</tr>
			<tr>
				<th>phone</th>
				<td><?php echo htmlspecialchars($_POST['phone'],ENT_QUOTES);?></td>
			</tr>
			<tr>
				<th>Nationality</th>
				<td><?php echo $members_nationality_list[$_POST['nationality']];?></td>
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
