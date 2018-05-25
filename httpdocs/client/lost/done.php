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
<p>We transmitted an email for password resets.</p>
<p>Please confirm it.</p>
<p>&nbsp;</p>
<p><a href="/client/login/">Back to Login Page</a></p>
</section>

</div><!--contents-->
<?php
include "../common/footer.php";
?>
</div><!--wrapper-->

</body>
</html>
