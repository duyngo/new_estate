<?php include "../../../controller/admin/sales_garellies/edit.php"; ?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Sales Gallery Add/Edit</title>
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
		<h2>Sales Gallery Add/Edit</h2>
		<form id="Login" name="Login" action="<?php echo $_SERVER['SCRIPT_NAME'];?>" method="post" ENCTYPE="multipart/form-data">
<?php
if( $_POST['act'] == "err" ){
?>
	<ul class="errorTxt"><?php echo sales_garellies_err_check(NULL); ?></ul>
<?php
}
?>
		<table>
			<tr id="companies_id">
				<th>Company</th>
				<td class="<?php if(sales_garellies_err_check("companies_id")){ echo "errorInput"; }?> must">
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
			<tr id="name">
				<th>Sales Gallery Name</th>
				<td class="<?php if(sales_garellies_err_check("name")){ echo "errorInput"; }?> must">
					<input name="name" size="64" id="name" class="TextInput" type="text" title="name" value="<?php echo $_POST['name'];?>">
				</td>
			</tr>
			<tr id="description">
				<th>Description</th>
				<td class="<?php if(sales_garellies_err_check("description")){ echo "errorInput"; }?>">
					<textarea name="description" title="" rows="5" cols="50" id="description" ><?php echo $_POST['description'];?></textarea>
				</td>
			</tr>
			<tr id="image_path_1">
				<th>Picture1</th>
				<td class="<?php if(sales_garellies_err_check("image_path_1")){ echo "errorInput"; }?>">
<?php if(!empty($_SESSION['sales_garellies']['image_path_1'])){ ?>
				<div>
					<div><img src="/admin/images/sales_garellies/<?php echo $_SESSION['sales_garellies']['image_path_1'];?>" width="100"></div>
					<div><input type="checkbox" name="image_path_1" value="delete">delete this image</div>
				</div>
<?php } ?>
				<input type="file" name="image_path_1" />
				</td>
			</tr>
			<tr id="image_path_2">
				<th>Picture2</th>
				<td class="<?php if(sales_garellies_err_check("image_path_2")){ echo "errorInput"; }?>">
<?php if(!empty($_SESSION['sales_garellies']['image_path_2'])){ ?>
				<div>
					<div><img src="/admin/images/sales_garellies/<?php echo $_SESSION['sales_garellies']['image_path_2'];?>" width="100"></div>
					<div><input type="checkbox" name="image_path_2" value="delete">delete this image</div>
				</div>
<?php } ?>
				<input type="file" name="image_path_2" />
				</td>
			</tr>
			<tr id="image_path_3">
				<th>Picture3</th>
				<td class="<?php if(sales_garellies_err_check("image_path_3")){ echo "errorInput"; }?>">
<?php if(!empty($_SESSION['sales_garellies']['image_path_3'])){ ?>
				<div>
					<div><img src="/admin/images/sales_garellies/<?php echo $_SESSION['sales_garellies']['image_path_3'];?>" width="100"></div>
					<div><input type="checkbox" name="image_path_3" value="delete">delete this image</div>
				</div>
<?php } ?>
				<input type="file" name="image_path_3" />
				</td>
			</tr>
			<tr id="image_path_4">
				<th>Picture4</th>
				<td class="<?php if(sales_garellies_err_check("image_path_4")){ echo "errorInput"; }?>">
<?php if(!empty($_SESSION['sales_garellies']['image_path_4'])){ ?>
				<div>
					<div><img src="/admin/images/sales_garellies/<?php echo $_SESSION['sales_garellies']['image_path_4'];?>" width="100"></div>
					<div><input type="checkbox" name="image_path_4" value="delete">delete this image</div>
				</div>
<?php } ?>
				<input type="file" name="image_path_4" />
				</td>
			</tr>
			<tr id="image_path_5">
				<th>Picture5</th>
				<td class="<?php if(sales_garellies_err_check("image_path_5")){ echo "errorInput"; }?>">
<?php if(!empty($_SESSION['sales_garellies']['image_path_5'])){ ?>
				<div>
					<div><img src="/admin/images/sales_garellies/<?php echo $_SESSION['sales_garellies']['image_path_5'];?>" width="100"></div>
					<div><input type="checkbox" name="image_path_5" value="delete">delete this image</div>
				</div>
<?php } ?>
				<input type="file" name="image_path_5" />
				</td>
			</tr>
			<tr id="image_path_6">
				<th>Picture6</th>
				<td class="<?php if(sales_garellies_err_check("image_path_6")){ echo "errorInput"; }?>">
<?php if(!empty($_SESSION['sales_garellies']['image_path_6'])){ ?>
				<div>
					<div><img src="/admin/images/sales_garellies/<?php echo $_SESSION['sales_garellies']['image_path_6'];?>" width="100"></div>
					<div><input type="checkbox" name="image_path_6" value="delete">delete this image</div>
				</div>
<?php } ?>
				<input type="file" name="image_path_6" />
				</td>
			</tr>
			<tr id="image_path_7">
				<th>Picture7</th>
				<td class="<?php if(sales_garellies_err_check("image_path_7")){ echo "errorInput"; }?>">
<?php if(!empty($_SESSION['sales_garellies']['image_path_7'])){ ?>
				<div>
					<div><img src="/admin/images/sales_garellies/<?php echo $_SESSION['sales_garellies']['image_path_7'];?>" width="100"></div>
					<div><input type="checkbox" name="image_path_7" value="delete">delete this image</div>
				</div>
<?php } ?>
				<input type="file" name="image_path_7" />
				</td>
			</tr>
			<tr id="image_path_8">
				<th>Picture8</th>
				<td class="<?php if(sales_garellies_err_check("image_path_8")){ echo "errorInput"; }?>">
<?php if(!empty($_SESSION['sales_garellies']['image_path_8'])){ ?>
				<div>
					<div><img src="/admin/images/sales_garellies/<?php echo $_SESSION['sales_garellies']['image_path_8'];?>" width="100"></div>
					<div><input type="checkbox" name="image_path_8" value="delete">delete this image</div>
				</div>
<?php } ?>
				<input type="file" name="image_path_8" />
				</td>
			</tr>
			<tr id="image_path_9">
				<th>Picture9</th>
				<td class="<?php if(sales_garellies_err_check("image_path_9")){ echo "errorInput"; }?>">
<?php if(!empty($_SESSION['sales_garellies']['image_path_9'])){ ?>
				<div>
					<div><img src="/admin/images/sales_garellies/<?php echo $_SESSION['sales_garellies']['image_path_9'];?>" width="100"></div>
					<div><input type="checkbox" name="image_path_9" value="delete">delete this image</div>
				</div>
<?php } ?>
				<input type="file" name="image_path_9" />
				</td>
			</tr>
			<tr id="image_path_10">
				<th>Picture10</th>
				<td class="<?php if(sales_garellies_err_check("image_path_10")){ echo "errorInput"; }?>">
<?php if(!empty($_SESSION['sales_garellies']['image_path_10'])){ ?>
				<div>
					<div><img src="/admin/images/sales_garellies/<?php echo $_SESSION['sales_garellies']['image_path_10'];?>" width="100"></div>
					<div><input type="checkbox" name="image_path_10" value="delete">delete this image</div>
				</div>
<?php } ?>
				<input type="file" name="image_path_10" />
				</td>
			</tr>
			<tr id="sort">
				<th>Sort</th>
				<td class="<?php if(sales_garellies_err_check("sort")){ echo "errorInput"; }?> must">
					<input name="sort" size="10" id="sort" class="TextInput" type="text" title="sort" value="<?php echo $_POST['sort'];?>">
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
		<h2>Sales GalleryAdd/Edit</h2>
		<table>
			<tr>
				<th>Company</th>
				<td><?php echo common_get_value("companies","name",$_POST['companies_id'],"");?></td>
			</tr>
			<tr>
				<th>Sales Gallery Name</th>
				<td><?php echo htmlspecialchars($_POST['name'],ENT_QUOTES);?></td>
			</tr>
			<tr>
				<th>Description</th>
				<td><?php echo str_replace("\n","<br />",htmlspecialchars($_POST['description'],ENT_QUOTES));?></td>
			</tr>
			<tr>
				<th>Picture1</th>
				<td><?php if(!empty($_SESSION['sales_garellies']['image_path_1'])){ ?> <img src="/admin/images/sales_garellies/<?php echo $_SESSION['sales_garellies']['image_path_1'];?>" width="100"> <?php } ?>
</td>
			</tr>
			<tr>
				<th>Picture2</th>
				<td><?php if(!empty($_SESSION['sales_garellies']['image_path_2'])){ ?> <img src="/admin/images/sales_garellies/<?php echo $_SESSION['sales_garellies']['image_path_2'];?>" width="100"> <?php } ?>
</td>
			</tr>
			<tr>
				<th>Picture3</th>
				<td><?php if(!empty($_SESSION['sales_garellies']['image_path_3'])){ ?> <img src="/admin/images/sales_garellies/<?php echo $_SESSION['sales_garellies']['image_path_3'];?>" width="100"> <?php } ?>
</td>
			</tr>
			<tr>
				<th>Picture4</th>
				<td><?php if(!empty($_SESSION['sales_garellies']['image_path_4'])){ ?> <img src="/admin/images/sales_garellies/<?php echo $_SESSION['sales_garellies']['image_path_4'];?>" width="100"> <?php } ?>
</td>
			</tr>
			<tr>
				<th>Picture5</th>
				<td><?php if(!empty($_SESSION['sales_garellies']['image_path_5'])){ ?> <img src="/admin/images/sales_garellies/<?php echo $_SESSION['sales_garellies']['image_path_5'];?>" width="100"> <?php } ?>
</td>
			</tr>
			<tr>
				<th>Picture6</th>
				<td><?php if(!empty($_SESSION['sales_garellies']['image_path_6'])){ ?> <img src="/admin/images/sales_garellies/<?php echo $_SESSION['sales_garellies']['image_path_6'];?>" width="100"> <?php } ?>
</td>
			</tr>
			<tr>
				<th>Picture7</th>
				<td><?php if(!empty($_SESSION['sales_garellies']['image_path_7'])){ ?> <img src="/admin/images/sales_garellies/<?php echo $_SESSION['sales_garellies']['image_path_7'];?>" width="100"> <?php } ?>
</td>
			</tr>
			<tr>
				<th>Picture8</th>
				<td><?php if(!empty($_SESSION['sales_garellies']['image_path_8'])){ ?> <img src="/admin/images/sales_garellies/<?php echo $_SESSION['sales_garellies']['image_path_8'];?>" width="100"> <?php } ?>
</td>
			</tr>
			<tr>
				<th>Picture9</th>
				<td><?php if(!empty($_SESSION['sales_garellies']['image_path_9'])){ ?> <img src="/admin/images/sales_garellies/<?php echo $_SESSION['sales_garellies']['image_path_9'];?>" width="100"> <?php } ?>
</td>
			</tr>
			<tr>
				<th>Picture10</th>
				<td><?php if(!empty($_SESSION['sales_garellies']['image_path_10'])){ ?> <img src="/admin/images/sales_garellies/<?php echo $_SESSION['sales_garellies']['image_path_10'];?>" width="100"> <?php } ?>
</td>
			</tr>
			<tr>
				<th>Sort</th>
				<td><?php echo htmlspecialchars($_POST['sort'],ENT_QUOTES);?></td>
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
