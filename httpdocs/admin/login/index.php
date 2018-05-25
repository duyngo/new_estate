<?php
include $_SERVER['BASE_DIR'] . "/controller/admin/login/index.php";
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>ログイン｜romancrew CMS</title>
<meta charset="utf-8">
<meta name="description" content="">
<meta name="author" content="">
<link rel="stylesheet" href="/admin/css/import.css">
<script src="/admin/js/common.js"></script>
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
<body id="login">
<div id="wrapper">
<div id="contents">
<header>
	<h1><img src="/assets/img/logo_kin.png" width="280"><!--img src="/admin/images/rcms.gif" width="188" height="12" alt="powered by romancrewCMS"--></h1>
</header>
<h2>Administrator Login</h2>
<section id="LoginForm">
	<form id="Login" name="Login" action="<?php echo $_SERVER['SCRIPT_NAME'];?>" method="post">
	<p class="errorTxt"><?php echo $err_msg;?></p>
	<table>
		<tr>
			<th><label for="userId">Email</label></th>
			<td class="<?php if($err_msg){ echo "errorInput"; }?>"><input name="email" size="30" tabindex="1" id="userId" class="TextInput" type="email" value="<?php echo $_POST['email'];?>" /></td>
		</tr>
		<tr>
			<th nowrap="nowrap"><label for="password">password</label></th>
			<td class="<?php if($err_msg){ echo "errorInput"; }?>"><input name="password" size="30" tabindex="2" id="password" class="TextInput" type="password" value="<?php echo $_POST['password'];?>"></td>
		</tr>
    	<tr>
			<td colspan="2" class="autoLogin"><input name="autoLogin" value="on" tabindex="3" id="autoLogin" type="checkbox" <?php if( $_POST['autoLogin'] == "on" ){ echo "checked"; }?>> <label for="autoLogin" style="cursor:pointer;">Auto Login</label></td>
		</tr>
		<tr>
			<td colspan="2" align="center" class="loginBtn"><input value="Login" id="submit" tabindex="4" type="submit"></td>
		</tr>
	</table>
	<!--p class="passForget"><a href="#" class="Remain"> パスワードを忘れた方はこちら</a></p-->
	<input type="hidden" name="act" value="conf">
	</form>
</section>

</div><!--contents-->
<?php
include "../common/footer.php";
?>
</div><!--wrapper-->

</body>
</html>
