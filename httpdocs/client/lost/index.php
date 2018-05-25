<?php
include "/home/" . $_SERVER['SERVER_NAME'] . "/controller/client/lost/index.php";
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Password Lost ｜ romancrew CMS</title>
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
	<h1><img src="/client/images/Logo.png" width="300"><!--img src="/admin/images/rcms.gif" width="188" height="12" alt="powered by romancrewCMS"--></h1>
</header>
<h2><?php echo $_SERVER['SERVER_NAME'];?> Password Lost</h2>
<section id="LoginForm">
	<form id="Login" name="Login" action="<?php echo $_SERVER['SCRIPT_NAME'];?>" method="post">
	<p class="errorTxt"><?php echo $err_msg;?></p>
	<table>
		<tr>
			<th><label for="userId">Email</label></th>
			<td class="<?php if($err_msg){ echo "errorInput"; }?>"><input name="email" size="30" tabindex="1" id="userId" class="TextInput" type="email" value="<?php echo $_POST['email'];?>" /></td>
		</tr>
		<tr>
			<td colspan="2" align="center" class="loginBtn"><input value="Sent Email" id="submit" tabindex="4" type="submit"></td>
		</tr>
	</table>
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
