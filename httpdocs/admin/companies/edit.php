<?php include "../../../controller/admin/companies/edit.php"; ?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Company Add/Edit</title>
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
	$(".parent_id").chosen();
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
		<h2>Company Add/Edit</h2>
		<form id="Login" name="Login" action="<?php echo $_SERVER['SCRIPT_NAME'];?>" method="post" ENCTYPE="multipart/form-data">
<?php
if( $_POST['act'] == "err" ){
?>
	<ul class="errorTxt"><?php echo companies_err_check(NULL); ?></ul>
<?php
}
?>
		<table>
			<tr id="parent_id">
				<th>Parent</th>
				<td class="<?php if(companies_err_check("parent_id")){ echo "errorInput"; }?> must">
				<select name="parent_id" data-placeholder="Please Choose Parent..." style="width:250px;" class="parent_id" />
				<option value="0">Not selected(NULL)</option>
<?php
if(empty($_POST['id'])){
        $own = common_get_max("companies")+1;
?>
                                <option value="<?php echo $own;?>" <?php if( $_POST['parent_id'] == $own ){ echo "selected"; } ?>>one's own self</option>
<?php
}
?>
<?php
$result = companies_index2();
while( $arr = mysql_fetch_array( $result )){
?>
				<option value="<?php echo $arr['id'];?>" <?php if( $arr['id'] == $_POST['parent_id'] ){ echo "selected"; } ?>><?php echo $arr['name'];?>(<?php echo $arr['id'];?>)</option>
<?php
}
?>
				</select>
				</td>
			</tr>
			<tr id="name">
				<th>Company name</th>
				<td class="<?php if(companies_err_check("name")){ echo "errorInput"; }?> must">
					<input name="name" size="256" id="name" class="TextInput" type="text" title="name" value="<?php echo $_POST['name'];?>">
				</td>
			</tr>
			<tr id="code">
				<th>Company ID(use as part of URL)</th>
				<td class="<?php if(companies_err_check("code")){ echo "errorInput"; }?> must">
					<input name="code" size="128" id="code" class="TextInput" type="text" title="code" value="<?php echo $_POST['code'];?>">
				</td>
			</tr>
			<tr id="rank">
				<th>Rank</th>
				<td>
<div><label><?php
foreach( $companies_rank_list as $key => $val ){
?>
				<input id="rank" name="rank" type="radio" value="<?php echo $key;?>" <?php if( $key == $_POST['rank'] ){ echo "checked"; } ?>><?php echo $val;?><?php
}
?>
</label></div>				</td>
			</tr>
			<tr id="class">
				<th>Classification</th>
				<td class="<?php if(companies_err_check("class")){ echo "errorInput"; }?> must">
<div><label><?php
if(is_array($_POST['class'])){
	$_POST['class'] = implode(",",$_POST['class']);
}
?>
<?php
foreach( $companies_class_list as $key => $val ){
?>
	<input type="checkbox" name="class[]" value="<?php echo $key;?>" <?php if(strpos($_POST['class'],$key)!==false){ echo "checked"; } ?>><?php echo $val;?>
<?php
}
?>
</label></div>				</td>
			</tr>
			<tr id="url">
				<th>Corporate site URL</th>
				<td class="<?php if(companies_err_check("url")){ echo "errorInput"; }?>">
					<input name="url" size="128" id="url" class="TextInput" type="text" title="url" value="<?php echo $_POST['url'];?>">
				</td>
			</tr>
			<tr id="address">
				<th>Address</th>
				<td class="<?php if(companies_err_check("address")){ echo "errorInput"; }?>">
					<input name="address" size="128" id="address" class="TextInput" type="text" title="address" value="<?php echo $_POST['address'];?>">
				</td>
			</tr>
			<tr id="tel">
				<th>TEL</th>
				<td class="<?php if(companies_err_check("tel")){ echo "errorInput"; }?>">
					<input name="tel" size="16" id="tel" class="TextInput" type="text" title="tel" value="<?php echo $_POST['tel'];?>">
				</td>
			</tr>
			<tr id="fax">
				<th>FAX</th>
				<td class="<?php if(companies_err_check("fax")){ echo "errorInput"; }?>">
					<input name="fax" size="16" id="fax" class="TextInput" type="text" title="fax" value="<?php echo $_POST['fax'];?>">
				</td>
			</tr>
			<tr id="pickup_flag">
				<th>Pick Up</th>
				<td class="<?php if(companies_err_check("pickup_flag")){ echo "errorInput"; }?> must">
<div><label><?php
foreach( $companies_pickup_flag_list as $key => $val ){
?>
				<input id="pickup_flag" name="pickup_flag" type="radio" value="<?php echo $key;?>" <?php if( $key == $_POST['pickup_flag'] ){ echo "checked"; } ?>><?php echo $val;?><?php
}
?>
</label></div>				</td>
			</tr>
			<tr id="developers_list_display_flag">
				<th>Developers list display flag</th>
				<td class="<?php if(companies_err_check("developers_list_display_flag")){ echo "errorInput"; }?> must">
<div><label><?php
foreach( $companies_developers_list_display_flag_list as $key => $val ){
?>
				<input id="developers_list_display_flag" name="developers_list_display_flag" type="radio" value="<?php echo $key;?>" <?php if( $key == $_POST['developers_list_display_flag'] ){ echo "checked"; } ?>><?php echo $val;?><?php
}
?>
</label></div>				</td>
			</tr>
			<tr id="logo_image_path">
				<th>Corporate logo</th>
				<td class="<?php if(companies_err_check("logo_image_path")){ echo "errorInput"; }?>">
<?php if(!empty($_SESSION['companies']['logo_image_path'])){ ?>
				<div>
					<div><img src="/admin/images/companies/<?php echo $_SESSION['companies']['logo_image_path'];?>" width="100"></div>
					<div><input type="checkbox" name="logo_image_path" value="delete">delete this image</div>
				</div>
<?php } ?>
				<input type="file" name="logo_image_path" />
				</td>
			</tr>
			<tr id="middle_head_1">
				<th>Middle heading 1</th>
				<td class="<?php if(companies_err_check("middle_head_1")){ echo "errorInput"; }?>">
					<input name="middle_head_1" size="128" id="middle_head_1" class="TextInput" type="text" title="middle_head_1" value="<?php echo $_POST['middle_head_1'];?>">
				</td>
			</tr>
			<tr id="desc_image_path_1">
				<th>Description picture 1</th>
				<td class="<?php if(companies_err_check("desc_image_path_1")){ echo "errorInput"; }?>">
<?php if(!empty($_SESSION['companies']['desc_image_path_1'])){ ?>
				<div>
					<div><img src="/admin/images/companies/<?php echo $_SESSION['companies']['desc_image_path_1'];?>" width="100"></div>
					<div><input type="checkbox" name="desc_image_path_1" value="delete">delete this image</div>
				</div>
<?php } ?>
				<input type="file" name="desc_image_path_1" />
				</td>
			</tr>
			<tr id="body_1">
				<th>Description Body 1</th>
				<td class="<?php if(companies_err_check("body_1")){ echo "errorInput"; }?>">
					<textarea name="body_1" title="" rows="5" cols="50" id="body_1" ><?php echo $_POST['body_1'];?></textarea>
				</td>
			</tr>
			<tr id="middle_head_2">
				<th>Middle heading 2</th>
				<td class="<?php if(companies_err_check("middle_head_2")){ echo "errorInput"; }?>">
					<input name="middle_head_2" size="128" id="middle_head_2" class="TextInput" type="text" title="middle_head_2" value="<?php echo $_POST['middle_head_2'];?>">
				</td>
			</tr>
			<tr id="desc_image_path_2">
				<th>Description picture 2</th>
				<td class="<?php if(companies_err_check("desc_image_path_2")){ echo "errorInput"; }?>">
<?php if(!empty($_SESSION['companies']['desc_image_path_2'])){ ?>
				<div>
					<div><img src="/admin/images/companies/<?php echo $_SESSION['companies']['desc_image_path_2'];?>" width="100"></div>
					<div><input type="checkbox" name="desc_image_path_2" value="delete">delete this image</div>
				</div>
<?php } ?>
				<input type="file" name="desc_image_path_2" />
				</td>
			</tr>
			<tr id="body_2">
				<th>Description Body 2</th>
				<td class="<?php if(companies_err_check("body_2")){ echo "errorInput"; }?>">
					<textarea name="body_2" title="" rows="5" cols="50" id="body_2" ><?php echo $_POST['body_2'];?></textarea>
				</td>
			</tr>
			<tr id="middle_head_3">
				<th>Middle heading 3</th>
				<td class="<?php if(companies_err_check("middle_head_3")){ echo "errorInput"; }?>">
					<input name="middle_head_3" size="128" id="middle_head_3" class="TextInput" type="text" title="middle_head_3" value="<?php echo $_POST['middle_head_3'];?>">
				</td>
			</tr>
			<tr id="desc_image_path_3">
				<th>Description picture 3</th>
				<td class="<?php if(companies_err_check("desc_image_path_3")){ echo "errorInput"; }?>">
<?php if(!empty($_SESSION['companies']['desc_image_path_3'])){ ?>
				<div>
					<div><img src="/admin/images/companies/<?php echo $_SESSION['companies']['desc_image_path_3'];?>" width="100"></div>
					<div><input type="checkbox" name="desc_image_path_3" value="delete">delete this image</div>
				</div>
<?php } ?>
				<input type="file" name="desc_image_path_3" />
				</td>
			</tr>
			<tr id="body_3">
				<th>Description Body 3</th>
				<td class="<?php if(companies_err_check("body_3")){ echo "errorInput"; }?>">
					<textarea name="body_3" title="" rows="5" cols="50" id="body_3" ><?php echo $_POST['body_3'];?></textarea>
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
		<h2>CompanyAdd/Edit</h2>
		<table>
			<tr>
				<th>Parent</th>
				<td><?php echo common_get_value("companies","name",$_POST['parent_id'],"");?></td>
			</tr>
			<tr>
				<th>Company name</th>
				<td><?php echo htmlspecialchars($_POST['name'],ENT_QUOTES);?></td>
			</tr>
			<tr>
				<th>Company ID(use as part of URL)</th>
				<td><?php echo htmlspecialchars($_POST['code'],ENT_QUOTES);?></td>
			</tr>
			<tr>
				<th>Rank</th>
				<td><?php echo $_POST['rank'];?></td>
			</tr>
			<tr>
				<th>Classification</th>
				<td><?php echo implode(",",$_POST['class']);?></td>
			</tr>
			<tr>
				<th>Corporate site URL</th>
				<td><?php echo htmlspecialchars($_POST['url'],ENT_QUOTES);?></td>
			</tr>
			<tr>
				<th>Address</th>
				<td><?php echo htmlspecialchars($_POST['address'],ENT_QUOTES);?></td>
			</tr>
			<tr>
				<th>TEL</th>
				<td><?php echo htmlspecialchars($_POST['tel'],ENT_QUOTES);?></td>
			</tr>
			<tr>
				<th>FAX</th>
				<td><?php echo htmlspecialchars($_POST['fax'],ENT_QUOTES);?></td>
			</tr>
			<tr>
				<th>Pick Up</th>
				<td><?php echo $companies_pickup_flag_list[$_POST['pickup_flag']];?></td>
			</tr>
			<tr>
				<th>Developers list display flag</th>
				<td><?php echo $companies_developers_list_display_flag_list[$_POST['developers_list_display_flag']];?></td>
			</tr>
			<tr>
				<th>Corporate logo</th>
				<td><?php if(!empty($_SESSION['companies']['logo_image_path'])){ ?> <img src="/admin/images/companies/<?php echo $_SESSION['companies']['logo_image_path'];?>" width="100"> <?php } ?>
</td>
			</tr>
			<tr>
				<th>Middle heading 1</th>
				<td><?php echo htmlspecialchars($_POST['middle_head_1'],ENT_QUOTES);?></td>
			</tr>
			<tr>
				<th>Description picture 1</th>
				<td><?php if(!empty($_SESSION['companies']['desc_image_path_1'])){ ?> <img src="/admin/images/companies/<?php echo $_SESSION['companies']['desc_image_path_1'];?>" width="100"> <?php } ?>
</td>
			</tr>
			<tr>
				<th>Description Body 1</th>
				<td><?php echo str_replace("\n","<br />",htmlspecialchars($_POST['body_1'],ENT_QUOTES));?></td>
			</tr>
			<tr>
				<th>Middle heading 2</th>
				<td><?php echo htmlspecialchars($_POST['middle_head_2'],ENT_QUOTES);?></td>
			</tr>
			<tr>
				<th>Description picture 2</th>
				<td><?php if(!empty($_SESSION['companies']['desc_image_path_2'])){ ?> <img src="/admin/images/companies/<?php echo $_SESSION['companies']['desc_image_path_2'];?>" width="100"> <?php } ?>
</td>
			</tr>
			<tr>
				<th>Description Body 2</th>
				<td><?php echo str_replace("\n","<br />",htmlspecialchars($_POST['body_2'],ENT_QUOTES));?></td>
			</tr>
			<tr>
				<th>Middle heading 3</th>
				<td><?php echo htmlspecialchars($_POST['middle_head_3'],ENT_QUOTES);?></td>
			</tr>
			<tr>
				<th>Description picture 3</th>
				<td><?php if(!empty($_SESSION['companies']['desc_image_path_3'])){ ?> <img src="/admin/images/companies/<?php echo $_SESSION['companies']['desc_image_path_3'];?>" width="100"> <?php } ?>
</td>
			</tr>
			<tr>
				<th>Description Body 3</th>
				<td><?php echo str_replace("\n","<br />",htmlspecialchars($_POST['body_3'],ENT_QUOTES));?></td>
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
