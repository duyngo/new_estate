<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title><?php echo $title;?></title>
    <meta name="keywords" content="<?php echo $keywords;?>"/>
    <meta name="description" content="<?php echo $description;?>"/>
    <meta name="robots" content="<?php echo $robots;?>" />
    <link rel="canonical" href="http://<?php echo $_SERVER['SERVER_NAME'];?><?php echo str_replace("/sp","",$_SERVER['REQUEST_URI']);?>">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/flickity/1.1.2/flickity.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/drawer/3.1.0/css/drawer.min.css">
    <link rel="stylesheet" href="/assets/css/sp.css" media="screen" title="no title" charset="utf-8">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="//npmcdn.com/flickity@1.1/dist/flickity.pkgd.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/iScroll/5.1.3/iscroll.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/drawer/3.1.0/js/drawer.min.js"></script>
    <script src="/assets/js/sp.js"></script>
<!-- Facebook Pixel Code -->
<script>
!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
document,'script','//connect.facebook.net/en_US/fbevents.js');

fbq('init', '895744797210221');
fbq('track', "PageView");

</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=895744797210221&ev=PageView&noscript=1"
/></noscript>
<!-- End Facebook Pixel Code -->
  </head>
  <body>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-64858864-1', 'auto');
  ga('require', 'displayfeatures');
  ga('send', 'pageview');

</script>
<?php
include $_SERVER['BASE_DIR'] . "/view/sp/common/header.php";
?>
    <article>
      <div id="acMenu" class="mdSAC03IconBox">
	<div id="icn" class="mdSAC03Icon"><img src="/assets/img/md_howto_search.png" alt="" class="center"><span>Filters</span></div>
	<div id="acMenu" class="Wrap95">
	  <form>

<?php
if( $states_code != "all-state" || ( $row_num_pager > 1 && $states_code == "all-state" && count($states_id_arr) > 1) ){
?>
	    <h4>State
	      <ul class="ul chkbox">
<?php
$i=0;
$result = states_index();
while( $arr = mysql_fetch_array( $result )){
	$display_flag = "off";
	foreach( $states_id_arr as $key ){
		if( $arr['id'] == $key ){
			$display_flag = "on";
		}
	}
	if( $display_flag == "off" ){
		continue;
	}
	$i++;
	$url = "/real-estate-developers/" . $developer_code;
	if( $arr['code'] != $states_code ){
		$url .= "/" . $arr['code'] . "/";
		if(!empty($property_type_groups_code)){
			$url .= "new-" . $property_type_groups_code . "-for-sale";
		}
		if(!empty($property_type_groups_code)){
			$url .= "new-" . $property_type_groups_code . "-for-sale";
		}
		if(!empty($prices_code)){
			if(!empty($property_type_groups_code)){
				$url .= "_";
			}
			$url .= $prices_code;
		}
		if(!empty($sizes_code)){
			if(!empty($property_type_groups_code)||!empty($prices_code)){
				$url .= "_";
			}
			$url .= $sizes_code;
		}
		if(!empty($bedrooms_code)){
			if(!empty($property_type_groups_code)||!empty($prices_code)||!empty($sizes_code)){
				$url .= "_";
			}
			$url .= $bedrooms_code;
		}
		if(!empty($completion_years_code)){
			if(!empty($property_type_groups_code)||!empty($prices_code)||!empty($sizes_code)||!empty($bedrooms_code)){
				$url .= "_";
			}
			$url .= $completion_years_code;
		}
	}else{
		if(!empty($property_type_groups_code)||!empty($prices_code)||!empty($sizes_code)||!empty($bedrooms_code)||!empty($completion_years_code)){
			$url .= "/all-state/";
		}
		if(!empty($property_type_groups_code)){
			$url .= "new-" . $property_type_groups_code . "-for-sale";
		}
		if(!empty($prices_code)){
			if(!empty($property_type_groups_code)){
				$url .= "_";
			}
			$url .= $prices_code;
		}
		if(!empty($sizes_code)){
			if(!empty($property_type_groups_code)||!empty($prices_code)){
				$url .= "_";
			}
			$url .= $sizes_code;
		}
		if(!empty($bedrooms_code)){
			if(!empty($property_type_groups_code)||!empty($prices_code)||!empty($sizes_code)){
				$url .= "_";
			}
			$url .= $bedrooms_code;
		}
		if(!empty($completion_years_code)){
			if(!empty($property_type_groups_code)||!empty($prices_code)||!empty($sizes_code)||!empty($bedrooms_code)){
				$url .= "_";
			}
			$url .= $completion_years_code;
		}
	}
?>
		<li>
		  <input type="checkbox" name="name1" id="Area<?php echo $i;?>" value="<?php echo $url;?>" onChange="location.href=value;" <?php if( $arr['code'] == $states_code ){ echo "checked"; } ?>>
		  <label for="Area<?php echo $i;?>"><?php echo $arr['name'];?></label>
		</li>
<?php
}
?>

	      </ul>
	    </h4>
<?php
}
?>

<?php if( !empty($groups_id) || (!empty($states_id) && count($groups_id_arr) > 1)){ ?>

	    <h4>Area
	      <ul class="ul chkbox">
<?php
$result = groups_index( $states_id );
while( $arr = mysql_fetch_array( $result )){
	$display_flag = "off";
	foreach( $groups_id_arr as $key ){
		if( $arr['id'] == $key ){
			$display_flag = "on";
		}
	}
	if( $display_flag == "off" ){
		continue;
	}
	$i++;
	$url = "/real-estate-developers/" . $developer_code;
	if( $arr['code'] != $groups_code ){
		$url = "/" . $states_code . "/" . $arr['code'];
		if(!empty($property_type_groups_code)){
			$url .= "_new-" . $property_type_groups_code . "-for-sale";
		}
		if(!empty($prices_code)){
			$url .= "_" . $prices_code;
		}
		if(!empty($sizes_code)){
			$url .= "_" . $sizes_code;
		}
		if(!empty($bedrooms_code)){
			$url .= "_" . $bedrooms_code;
		}
		if(!empty($completion_years_code)){
			$url .= "_" . $completion_years_code;
		}
	}else{
		$url .= "/" . $states_code . "/";
		if(!empty($property_type_groups_code)){
			$url .= "new-" . $property_type_groups_code . "-for-sale";
		}
		if(!empty($prices_code)){
			if(!empty($property_type_groups_code)){
				$url .= "_";
			}
			$url .= $prices_code;
		}
		if(!empty($sizes_code)){
			if(!empty($property_type_groups_code)||!empty($prices_code)){
				$url .= "_";
			}
			$url .= $sizes_code;
		}
		if(!empty($bedrooms_code)){
			if(!empty($property_type_groups_code)||!empty($prices_code)||!empty($sizes_code)){
				$url .= "_";
			}
			$url .= $bedrooms_code;
		}
		if(!empty($completion_years_code)){
			if(!empty($property_type_groups_code)||!empty($prices_code)||!empty($sizes_code)||!empty($bedrooms_code)){
				$url .= "_";
			}
			$url .= $completion_years_code;
		}
	}
?>
		<li>
		  <input type="checkbox" name="name1" id="Area<?php echo $i;?>" value="<?php echo $url;?>" onChange="location.href=value;" <?php if( $arr['code'] == $groups_code ){ echo "checked"; } ?>>
		  <label for="Area<?php echo $i;?>"><?php echo $arr['name'];?></label>
		</li>
<?php
}
?>
	      </ul>
	    </h4>
<?php
}
?>




<?php
/*
if( !empty($locations_id) || (!empty($groups_id) && count($locations_id_arr) > 1)){ ?>

	    <h4>Location
	      <ul class="ul chkbox">
<?php
$result = locations_index( $states_id,$groups_id );
while( $arr = mysql_fetch_array( $result )){
	$display_flag = "off";
	foreach( $locations_id_arr as $key ){
		if( $arr['id'] == $key ){
			$display_flag = "on";
		}
	}
	if( $display_flag == "off" ){
		continue;
	}
	$i++;
	$url = "/real-estate-developers/" . $developer_code;
	if( $arr['code'] != $locations_code ){
		$url = "/" . $states_code . "/";
		$url .= "in-" . $arr['code'];
		if(!empty($groups_code)){
			$url .= "_" . $groups_code;
		}
		if(!empty($property_type_groups_code)){
			$url .= "_new-" . $property_type_groups_code . "-for-sale";
		}
		if(!empty($prices_code)){
			$url .= "_" . $prices_code;
		}
		if(!empty($sizes_code)){
			$url .= "_" . $sizes_code;
		}
		if(!empty($bedrooms_code)){
			$url .= "_" . $bedrooms_code;
		}
		if(!empty($completion_years_code)){
			$url .= "_" . $completion_years_code;
		}
	}else{
		$url .= "/" . $states_code . "/";
		if(!empty($groups_code)){
			$url .= $groups_code;
		}
		if(!empty($property_type_groups_code)){
			if(!empty($groups_code)){
				$url .= "_";
			}
			$url .= "new-" . $property_type_groups_code . "-for-sale";
		}
		if(!empty($prices_code)){
			if(!empty($groups_code)||!empty($property_type_groups_code)){
				$url .= "_";
			}
			$url .= $prices_code;
		}
		if(!empty($sizes_code)){
			if(!empty($groups_code)||!empty($property_type_groups_code)||!empty($prices_code)){
				$url .= "_";
			}
			$url .= $sizes_code;
		}
		if(!empty($bedrooms_code)){
			if(!empty($groups_code)||!empty($property_type_groups_code)||!empty($prices_code)||!empty($sizes_code)){
				$url .= "_";
			}
			$url .= $bedrooms_code;
		}
		if(!empty($completion_years_code)){
			if(!empty($groups_code)||!empty($property_type_groups_code)||!empty($prices_code)||!empty($sizes_code)||!empty($bedrooms_code)){
				$url .= "_";
			}
			$url .= $completion_years_code;
		}
	}
?>
		<li>
		  <input type="checkbox" name="name1" id="Area<?php echo $i;?>" value="<?php echo $url;?>" onChange="location.href=value;" <?php if( $arr['code'] == $locations_code ){ echo "checked"; } ?>>
		  <label for="Area<?php echo $i;?>"><?php echo $arr['name'];?></label>
		</li>
<?php
}
?>
	      </ul>
	    </h4>
<?php
}
*/
?>


<?php
$property_type_groups_id_arr = property_types_get_property_type_groups_id( $property_types_id_arr );
if( !empty($property_type_groups_code) || ( $row_num_pager > 1 && empty($property_type_groups_code) && count($property_type_groups_id_arr) > 1) ){
?>
	    <h4>Property Type
	      <ul class="ul chkbox">
<?php
$result = property_type_groups_index();
while( $arr = mysql_fetch_array( $result )){
	$display_flag = "off";
	foreach( $property_type_groups_id_arr as $key ){
		if( $arr['id'] == $key ){
			$display_flag = "on";
		}
	}
	if( $display_flag == "off" ){
		continue;
	}
	$i++;
	$url = "/real-estate-developers/" . $developer_code;
	$url .= "/" . $states_code . "/";
	if(!empty($locations_code)){
		$url .= "in-" . $locations_code;
	}
	if(!empty($groups_code)){
		if(!empty($locations_code)){
			$url .= "_";
		}
		$url .= $groups_code;
	}
	if( $arr['code'] != $property_type_groups_code ){       //change property_type_groups_code.
		if(!empty($locations_code)||!empty($groups_code)){
			$url .= "_";
		}
		$url .= "new-" . $arr['code'] . "-for-sale";
		//property_type_groups_code is surely checked.so, in below here , [_] only.
		if(!empty($prices_code)){
			$url .= "_" . $prices_code;
		}
		if(!empty($sizes_code)){
			$url .= "_" . $sizes_code;
		}
		if(!empty($bedrooms_code)){
			$url .= "_" . $bedrooms_code;
		}
		if(!empty($completion_years_code)){
			$url .= "_" . $completion_years_code;
		}
	}else{  //remove property_type_groups_code.
		if(!empty($prices_code)){
			if(!empty($locations_code)||!empty($groups_code)){
				$url .= "_";
			}
			$url .= $prices_code;
		}
		if(!empty($sizes_code)){
			if(!empty($locations_code)||!empty($groups_code)||!empty($prices_code)){
				$url .= "_";
			}
			$url .= $sizes_code;
		}
		if(!empty($bedrooms_code)){
			if(!empty($locations_code)||!empty($groups_code)||!empty($prices_code)||!empty($sizes_code)){
				$url .= "_";
			}
			$url .= $bedrooms_code;
		}
		if(!empty($completion_years_code)){
			if(!empty($locations_code)||!empty($groups_code)||!empty($prices_code)||!empty($sizes_code)||!empty($bedrooms_code)){
				$url .= "_";
			}
			$url .= $completion_years_code;
		}
	}
?>
		<li>
		  <input type="checkbox" name="name1" id="Area<?php echo $i;?>" value="<?php echo $url;?>" onChange="location.href=value;" <?php if( $arr['code'] == $property_type_groups_code ){ echo "checked"; } ?>>
		  <label for="Area<?php echo $i;?>"><?php echo $arr['name'];?></label>
		</li>
<?php
}
?>
	      </ul>
	    </h4>
<?php
}
?>


<?php
if( !empty($prices_id) || ( $row_num_pager > 1 && empty($prices_id) && count($prices_id_arr) > 1) ){
?>
	    <h4>Price
	      <ul class="ul chkbox">
<?php
$result = prices_index();
while( $arr = mysql_fetch_array( $result )){
	$display_flag = "off";
	foreach( $prices_id_arr as $key ){
		if( $arr['id'] == $key ){
			$display_flag = "on";
		}
	}
	if( $display_flag == "off" ){
		continue;
	}
	$i++;
	$url = "/real-estate-developers/" . $developer_code;
	$url .= "/" . $states_code . "/";
	if(!empty($locations_code)){
		$url .= "in-" . $locations_code;
	}
	if(!empty($groups_code)){
		if(!empty($locations_code)){
			$url .= "_";
		}
		$url .= $groups_code;
	}
	if(!empty($property_type_groups_code)){
		if(!empty($locations_code)||!empty($groups_code)){
			$url .= "_";
		}
		$url .= "new-" . $property_type_groups_code . "-for-sale";
	}
	if( $arr['code'] != $prices_code ){     //change prices_code
		if(!empty($locations_code) || !empty($groups_code) || !empty($property_type_groups_code)){
			$url .= "_";
		}
		$url .= $arr['code'];
		if(!empty($sizes_code)){
			$url .= "_" . $sizes_code;
		}
		if(!empty($bedrooms_code)){
			$url .= "_" . $bedrooms_code;
		}
		if(!empty($completion_years_code)){
			$url .= "_" . $completion_years_code;
		}
	}else{  //remove prices_code
		if(!empty($sizes_code)){
			if(!empty($locations_code)||!empty($groups_code)||!empty($property_type_groups_code)){
				$url .= "_";
			}
			$url .= $sizes_code;
		}
		if(!empty($bedrooms_code)){
			if(!empty($locations_code)||!empty($groups_code)||!empty($property_type_groups_code)||!empty($sizes_code)){
				$url .= "_";
			}
			$url .= $bedrooms_code;
		}
		if(!empty($completion_years_code)){
			if(!empty($locations_code)||!empty($groups_code)||!empty($property_type_groups_code)||!empty($sizes_code)||!empty($bedrooms_code)){
				$url .= "_";
			}
			$url .= $completion_years_code;
		}
	}
?>
		<li>
		  <input type="checkbox" name="name1" id="Area<?php echo $i;?>" value="<?php echo $url;?>" onChange="location.href=value;" <?php if( $arr['code'] == $prices_code ){ echo "checked"; } ?>>
		  <label for="Area<?php echo $i;?>"><?php echo $arr['name'];?></label>
		</li>
<?php
}
?>
	      </ul>
	    </h4>
<?php
}
?>




<?php
if( !empty($completion_years_id) || ( $row_num_pager > 1 && empty($completion_years_id) && count($completion_years_id_arr) > 1) ){
?>
	    <h4>Completion Year
	      <ul class="ul chkbox">
<?php
$result = completion_years_index();
while( $arr = mysql_fetch_array( $result )){
	$display_flag = "off";
	foreach( $completion_years_id_arr as $key ){
		if( $arr['id'] == $key ){
			$display_flag = "on";
		}
	}
	if( $display_flag == "off" ){
		continue;
	}
	$i++;
	$url = "/real-estate-developers/" . $developer_code;
	$url .= "/" . $states_code . "/";
	if(!empty($locations_code)){
		$url .= "in-" . $locations_code;
	}
	if(!empty($groups_code)){
		if(!empty($locations_code)){
			$url .= "_";
		}
		$url .= $groups_code;
	}
	if(!empty($property_type_groups_code)){
		if(!empty($locations_code)||!empty($groups_code)){
			$url .= "_";
		}
		$url .= "new-" . $property_type_groups_code . "-for-sale";
	}
	if(!empty($prices_code)){
		if(!empty($locations_code)||!empty($groups_code)||!empty($property_type_groups_code)){
			$url .= "_";
		}
		$url .= $prices_code;
	}
	if(!empty($sizes_code)){
		if(!empty($locations_code)||!empty($groups_code)||!empty($property_type_groups_code)||!empty($prices_code)){
			$url .= "_";
		}
		$url .= $sizes_code;
	}
	if(!empty($bedrooms_code)){
		if(!empty($locations_code)||!empty($groups_code)||!empty($property_type_groups_code)||!empty($prices_code)||!empty($sizes_code)){
			$url .= "_";
		}
		$url .= $bedrooms_code;
	}
	if( $arr['code'] != $completion_years_code ){   //change completion_years_code
		if(!empty($locations_code)||!empty($groups_code)||!empty($property_type_groups_code)||!empty($prices_code)||!empty($sizes_code)||!empty($bedrooms_code) ){
			$url .= "_";
		}
		$url .= $arr['code'];
	}
?>
		<li>
		  <input type="checkbox" name="name1" id="Area<?php echo $i;?>" value="<?php echo $url;?>" onChange="location.href=value;" <?php if( $arr['code'] == $completion_years_code ){ echo "checked"; } ?>>
		  <label for="Area<?php echo $i;?>"><?php echo $arr['name'];?></label>
		</li>
<?php
}
?>
	      </ul>
	    </h4>
<?php
}
?>


	    <!--h4>Tenure
	      <ul class="ul chkbox">
		<li>
		  <input type="checkbox" name="name1" id="Area<?php echo $i;?>" value="<?php echo $url;?>" onChange="location.href=value;" <?php if( $arr['code'] == $property_type_groups_code ){ echo "checked"; } ?>>
		  <label for="Area<?php echo $i;?>"><?php echo $arr['name'];?></label>
		</li>
	      </ul>
	    </h4-->






<?php
if( !empty($bedrooms_id) || ( $row_num_pager > 1 && empty($bedrooms_id) && count($bedrooms_id_arr) > 1) ){
?>
	    <h4>Bedrooms
	      <ul class="ul chkbox">
<?php
$result = bedrooms_index();
while( $arr = mysql_fetch_array( $result )){
	$display_flag = "off";
	foreach( $bedrooms_id_arr as $key ){
		if( $arr['id'] == $key ){
			$display_flag = "on";
		}
	}
	if( $display_flag == "off" ){
		continue;
	}
	$i++;
	$url = "/real-estate-developers/" . $developer_code;
	$url .= "/" . $states_code . "/";
	if(!empty($locations_code)){
		$url .= "in-" . $locations_code;
	}
	if(!empty($groups_code)){
		if(!empty($locations_code)){
			$url .= "_" ;
		}
		$url .= $groups_code;
	}
	if(!empty($property_type_groups_code)){
		if(!empty($locations_code)||!empty($groups_code)){
			$url .= "_";
		}
		$url .= "new-" . $property_type_groups_code . "-for-sale";
	}
	if(!empty($prices_code)){
		if(!empty($locations_code)||!empty($groups_code)||!empty($property_type_groups_code)){
			$url .= "_";
		}
		$url .= $prices_code;
	}
	if(!empty($sizes_code)){
		if(!empty($locations_code)||!empty($groups_code)||!empty($property_type_groups_code)||!empty($prices_code)){
			$url .= "_";
		}
		$url .= $sizes_code;
	}
	if( $arr['code'] != $bedrooms_code ){   //change bedrooms_code
		if(!empty($locations_code)||!empty($groups_code)||!empty($property_type_groups_code)||!empty($prices_code)||!empty($prices_code)||!empty($sizes_code)){
			$url .= "_";
		}
		$url .= $arr['code'];
		if(!empty($completion_years_code)){
			$url .= "_" . $completion_years_code;
		}
	}else{	  //remove bedrooms_code
		if(!empty($completion_years_code)){
			if(!empty($locations_code)||!empty($groups_code)||!empty($property_type_groups_code)||!empty($prices_code)||!empty($prices_code)||!empty($sizes_code)){
				$url .= "_";
			}
			$url .= $completion_years_code;
		}
	}
?>
		<li>
		  <input type="checkbox" name="name1" id="Area<?php echo $i;?>" value="<?php echo $url;?>" onChange="location.href=value;" <?php if( $arr['code'] == $bedrooms_code ){ echo "checked"; } ?>>
		  <label for="Area<?php echo $i;?>"><?php echo $arr['name'];?></label>
		</li>
<?php
}
?>
	      </ul>
	    </h4>
<?php
}
?>


<?php
if( !empty($sizes_id) || ( $row_num_pager > 1 && empty($sizes_id) && count($sizes_id_arr) > 1) ){
?>
            <h4>Size
              <ul class="ul chkbox">
<?php
$result = sizes_index();
while( $arr = mysql_fetch_array( $result )){
        $display_flag = "off";
        foreach( $sizes_id_arr as $key ){
                if( $arr['id'] == $key ){
                        $display_flag = "on";
                }
        }
        if( $display_flag == "off" ){
                continue;
        }
        $i++;
	$url = "/real-estate-developers/" . $developer_code;
        $url .= "/" . $states_code . "/";
        if(!empty($locations_code)){
                $url .= "in-" . $locations_code;
        }
        if(!empty($groups_code)){
                if(!empty($locations_code)){
                        $url .= "_" ;
                }
                $url .= $groups_code;
        }
        if(!empty($property_type_groups_code)){
                if(!empty($locations_code)||!empty($groups_code)){
                        $url .= "_";
                }
                $url .= "new-" . $property_type_groups_code . "-for-sale";
        }
        if(!empty($prices_code)){
                if(!empty($locations_code)||!empty($groups_code)||!empty($property_type_groups_code)){
                        $url .= "_";
                }
                $url .= $prices_code;
        }
        if( $arr['code'] != $sizes_code ){   //change sizes_code
                if(!empty($locations_code)||!empty($groups_code)||!empty($property_type_groups_code)||!empty($prices_code)||!empty($bedrooms_code)){
                        $url .= "_";
                }
                $url .= $arr['code'];
                if(!empty($bedrooms_code)){
                        if(!empty($locations_code)||!empty($groups_code)||!empty($property_type_groups_code)||!empty($prices_code)){
                                $url .= "_";
                        }
                        $url .= $bedrooms_code;
                }
                if(!empty($completion_years_code)){
                        $url .= "_" . $completion_years_code;
                }
        }else{          //remove bedrooms_code
                if(!empty($bedrooms_code)){
                        if(!empty($locations_code)||!empty($groups_code)||!empty($property_type_groups_code)||!empty($prices_code)){
                                $url .= "_";
                        }
                        $url .= $bedrooms_code;
                }
                if(!empty($completion_years_code)){
                        if(!empty($locations_code)||!empty($groups_code)||!empty($property_type_groups_code)||!empty($prices_code)){
                                $url .= "_";
                        }
                        $url .= $completion_years_code;
                }
        }
?>
                <li>
                  <input type="checkbox" name="name1" id="Area<?php echo $i;?>" value="<?php echo $url;?>" onChange="location.href=value;" <?php if( $arr['code'] == $sizes_code ){ echo "checked"; } ?>>
                  <label for="Area<?php echo $i;?>"><?php echo $arr['name'];?></label>
                </li>
<?php
}
?>
              </ul>
            </h4>
<?php
}
?>



	    <!--button class="GoldBtn center">submit</button-->
	  </form>
	</div>
      </div>
      <div class="mdSAC01Ttl Wrap95">
	<div class="mdSAC01Items">
	  <div class="mdSAC01Img"><img src="/admin/images/companies/<?php echo $developer_logo_image_path;?>" alt=""></div>
	  <div class="mdSAC01Txt">
	    <h2 class="Gold h2"><?php echo $developer_name;?></h2>
	    <p class="p"><?php echo str_replace("\n","<br />",$developer_body);?></p>
	  </div>
	</div>

	<h1 class="TtlCenter"><?php echo $h1;?></h1>
<?php
if(!($states_code == "all-state" && empty($str))){
?>
	<!--form action="/enquiry/once_for_all" method="post">
	<button class="GoldBtn SearchEnqiry">Enquiry once for all</button>
	</form-->
<?php
}
?>
      </div>
      <div class="mdSAC02Wrap Wrap95">

<?php
$i=0;
while( $arr = mysql_fetch_array( $result_main )){
	if(strlen($arr['name'])>18){
		$name = substr($arr['name'],0,18) . "...";
	}else{
		$name = $arr['name'];
	}
	if(empty($arr['price_name'])){
		$price_name = "Please Ask";
	}else{
		if(strlen($arr['price_name'])>20){
			$price_name = substr($arr['price_name'],0,20) . "...";
		}else{
			$price_name = $arr['price_name'];
		}
	}
	$i++;
	if( $i%2 != 0 ){
?>
	<div class="mdSAC02ListGroups">
<?php
	}
?>

	  <div class="mdSAC02ListItem"><a href="/<?php echo $arr['states_code'] . "/" . $arr['code'] . "-in-" . $arr['locations_code'];?>" target="_blank"><img src="/admin/images/listings/<?php echo $arr['main_picture'];?>" alt=""></a>
	    <h2><?php echo $name;?></h2>
	    <p class="Gold"><?php echo $price_name;?></p>
	    <p class="Gold"><?php echo $arr['property_name'];?></p>
	    <!--div class="div_<?php echo $arr['id'];?>"></div-->
	  </div>

<?php
	if($i%2==0 || $i == $row_num ){
?>
	</div>
<?php
	}
}
?>

<?php
if(!($states_code == "all-state" && empty($str))){
?>
	<!--form action="/enquiry/once_for_all" method="post">
	<button class="GoldBtn SearchEnqiry">Enquiry once for all</button>
	</form-->
<?php
}
?>

<?php
include $_SERVER['BASE_DIR'] . "/view/sp/common/pager.php";
?>
      </div>
    </article>
<?php
include $_SERVER['BASE_DIR'] . "/view/sp/common/footer.php";
?>

<?php
while( $arr = mysql_fetch_array( $result_ajax )){
?>

<script language="Javascript">
<!--
function ajax_<?php echo $arr['id'];?>(listings_id,mode){
	ajax_cart_num(listings_id,mode);
	$.ajax({
		type: "POST",
		url: "/ajax/cart.php",
		data:{
			listings_id:listings_id,
			mode:mode,
		},
		cache: false,
		success: function(html){
			$(".div_<?php echo $arr['id'];?>").html(html);
		}
	});
}
//-->
</script>



<script type="text/javascript">
$(document).ready(function(){
	ajax_<?php echo $arr['id'];?>(<?php echo $arr['id'];?>,"init");
});
</script>

<?php
}
?>

<?php
include $_SERVER['BASE_DIR'] . "/view/sp/common/footer_js.php";
?>

  </body>
</html>
