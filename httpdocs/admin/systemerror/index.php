<?php
include "/home/uluru/controller/systemerror/index.php";
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>システムエラー｜romancrew CMS</title>
<meta charset="utf-8">
<meta name="description" content="">
<meta name="author" content="">
<link rel="stylesheet" href="/css/import.css">
<script src="js/common.js"></script>
<script type="text/javascript" language="javascript" src="/js/jquery.dropdownPlain.js"></script>
<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="/js/placeholder.js"></script>
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
		<h2>システムエラー</h2>
		<p><?php echo $systemerror_error_code_list[$_REQUEST['error_code']];?></p>
	</section>


<?php
}
?>


<div id="pagetop"><a href="#wrapper"><img src="/images/pagetop.gif" alt="ページトップへ" width="50" height="50"></a></div>
</article>

</div><!--contents-->
<footer>Copyright © 2015 romancrew Co.Ltd., All Rights Reserved.</footer>
</div><!--wrapper-->

<!-- SCRIPTS -->

<script type="text/javascript" src="/js/jquery-1.3.1.min.js"></script>	

</body>
</html>
