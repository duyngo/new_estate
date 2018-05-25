<?php include "/home/newpropertylist.my/controller/admin/external_users/edit.php"; ?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>External users Add/Edit</title>
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
<?php
if(empty($_POST['act']) || $_POST['act'] == "err" || $_POST['act'] == "back" ){	
?>
	<section id="editForm">
		<h2>External users Add/Edit</h2>
		<form id="Login" name="Login" action="<?php echo $_SERVER['SCRIPT_NAME'];?>" method="post" ENCTYPE="multipart/form-data">
<?php
if( $_POST['act'] == "err" ){
?>
	<ul class="errorTxt"><?php echo external_users_err_check(NULL); ?></ul>
<?php
}
?>
		<table>
			<tr id="companies_id">
				<th>Company</th>
				<td class="<?php if(external_users_err_check("companies_id")){ echo "errorInput"; }?> must">
				<select name="companies_id" data-placeholder="Please Choose Company..." style="width:250px;" class="companies_id" />
				<option value="0">Not selected(NULL)</option>
<?php
$result = companies_index();
while( $arr = mysql_fetch_array( $result )){
?>
				<option value="<?php echo $arr['id'];?>" <?php if( $arr['id'] == $_POST['companies_id'] ){ echo "selected"; } ?>><?php echo $arr['name'];?>(<?php echo $arr['id'];?>)</option>
<?php
}
?>
				</select>
				</td>
			</tr>
			<tr id="email">
				<th>Email</th>
				<td class="<?php if(external_users_err_check("email")){ echo "errorInput"; }?> must">
					<input name="email" size="64" id="email" class="TextInput" type="email" title="email" value="<?php echo $_POST['email'];?>">
<p class="note">※This will serve as your login email and your itinerary will be sent here.</p>				</td>
			</tr>
			<tr id="password">
				<th>Password</th>
				<td class="<?php if(external_users_err_check("password")){ echo "errorInput"; }?> <?php if(empty($_POST['id'])){ echo " must";}?>">
					<input name="password" size="20" id="password" class="TextInput" type="password" title="password" value="<?php echo $_POST['password'];?>">
<p class="note">※Password must be 8-15 alphanumeric characters with these requirements <br />- number (0-9) <br />- lowercase letter (a-z) <br />- uppercase letter (A-Z)</p>				</td>
			</tr>
			<tr>
				<th>Re-enter password</th>
				<td class="<?php if(external_users_err_check("password")){ echo "errorInput"; }?> <?php if(empty($_POST['id'])){ echo " must";}?>">
					<input name="password2" size="20" id="name" class="TextInput" type="password" title="" value="<?php echo $_POST['password2'];?>">
				</td>
			</tr>
			<tr id="title">
				<th>Title</th>
				<td class="<?php if(external_users_err_check("title")){ echo "errorInput"; }?> must">
<div><label><?php
foreach( $external_users_title_list as $key => $val ){
?>
				<input id="title" name="title" type="radio" value="<?php echo $key;?>" <?php if( $key == $_POST['title'] ){ echo "checked"; } ?>><?php echo $val;?><?php
}
?>
</label></div>				</td>
			</tr>
			<tr id="first_name">
				<th>First name</th>
				<td class="<?php if(external_users_err_check("first_name")){ echo "errorInput"; }?> must">
					<input name="first_name" size="32" id="first_name" class="TextInput" type="text" title="first_name" value="<?php echo $_POST['first_name'];?>">
<p class="note">※Enter name as per passport/IC in roman alphabets (a-z,A-Z) only</p>				</td>
			</tr>
			<tr id="last_name">
				<th>Last name</th>
				<td class="<?php if(external_users_err_check("last_name")){ echo "errorInput"; }?> must">
					<input name="last_name" size="32" id="last_name" class="TextInput" type="text" title="last_name" value="<?php echo $_POST['last_name'];?>">
<p class="note">※Enter name as per passport/IC in roman alphabets (a-z,A-Z) only</p>				</td>
			</tr>
			<tr id="position">
				<th>Position</th>
				<td class="<?php if(external_users_err_check("position")){ echo "errorInput"; }?>">
					<input name="position" size="128" id="position" class="TextInput" type="text" title="position" value="<?php echo $_POST['position'];?>">
				</td>
			</tr>
			<tr id="tel">
				<th>TEL</th>
				<td class="<?php if(external_users_err_check("tel")){ echo "errorInput"; }?>">
					<input name="tel" size="32" id="tel" class="TextInput" type="text" title="tel" value="<?php echo $_POST['tel'];?>">
				</td>
			</tr>
			<tr id="mobile">
				<th>Mobile</th>
				<td class="<?php if(external_users_err_check("mobile")){ echo "errorInput"; }?>">
					<input name="mobile" size="32" id="mobile" class="TextInput" type="text" title="mobile" value="<?php echo $_POST['mobile'];?>">
				</td>
			</tr>
			<tr id="published_range_of_inquiry">
				<th>published_range_of_inquiry</th>
				<td class="<?php if(external_users_err_check("published_range_of_inquiry")){ echo "errorInput"; }?>">
<div><label><?php
if(is_array($_POST['published_range_of_inquiry'])){
	$_POST['published_range_of_inquiry'] = implode(",",$_POST['published_range_of_inquiry']);
}
?>
<?php
$result = external_users_child_companies_index( $_POST['companies_id'] );
while( $arr = mysql_fetch_array( $result )){
?>
	<input type="checkbox" name="published_range_of_inquiry[]" value="<?php echo $arr['id'];?>" <?php if(strpos($_POST['published_range_of_inquiry'],$arr['id'])!==false){ echo "checked"; } ?>><?php echo $arr['name'];?>
<?php
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
		<h2>External usersAdd/Edit</h2>
		<table>
			<tr>
				<th>Company</th>
				<td><?php echo common_get_value("companies","name",$_POST['companies_id'],"");?></td>
			</tr>
			<tr>
				<th>Email</th>
				<td><?php echo $_POST['email'];?></td>
			</tr>
			<tr>
				<th>Password</th>
				<td><?php echo str_pad("", strlen($_POST['password']), "*") ;?></td>
			</tr>
			<tr>
				<th>Title</th>
				<td><?php echo $external_users_title_list[$_POST['title']];?></td>
			</tr>
			<tr>
				<th>First name</th>
				<td><?php echo htmlspecialchars($_POST['first_name'],ENT_QUOTES);?></td>
			</tr>
			<tr>
				<th>Last name</th>
				<td><?php echo htmlspecialchars($_POST['last_name'],ENT_QUOTES);?></td>
			</tr>
			<tr>
				<th>Position</th>
				<td><?php echo htmlspecialchars($_POST['position'],ENT_QUOTES);?></td>
			</tr>
			<tr>
				<th>TEL</th>
				<td><?php echo htmlspecialchars($_POST['tel'],ENT_QUOTES);?></td>
			</tr>
			<tr>
				<th>Mobile</th>
				<td><?php echo htmlspecialchars($_POST['mobile'],ENT_QUOTES);?></td>
			</tr>
			<tr>
				<th>published_range_of_inquiry</th>
				<td><?php echo admin_common_get_name_from_csv($_POST['published_range_of_inquiry'],"companies");?></td>
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
