<?php
function favorites_num(){
	$fav_num = 0;
	if(isset($_COOKIE['newpropertylist']['Favorites'])){
		$fav = explode(",",$_COOKIE['newpropertylist']['Favorites']);
		foreach( $fav as $key ){
			$listings_status = NULL;
			if( listings_display_check( $key )){
				$fav_num++;
			}
		}
	}
	return $fav_num;
}
function favorites_add( $listings_id ){
	if(empty($_COOKIE['newpropertylist']['Favorites']) || strpos($_COOKIE['newpropertylist']['Favorites'],$listings_id)===false ){
		if(empty($_COOKIE['newpropertylist']['Favorites'])){
			$fav = $listings_id;
		}else{
			$fav = $listings_id . "," . $_COOKIE['newpropertylist']['Favorites'];
		}
		setcookie("newpropertylist[Favorites]","$fav",time() + 1825 * 24 * 60 * 60,"/");

		if(!empty($_SESSION['members_id'])){
			$favorites = common_get_value("members","favorites",$_SESSION['members_id']);
			if(empty($favorites)){
				$favorites .= $listings_id;
			}else{
				if(strpos($favorites,$listings_id)===false){
					$favorites .= "," . $listings_id;
				}
			}
			$sql_upd = "update members set";
			$sql_upd .= " favorites = '" . $favorites . "'";
			$sql_upd .= ",modified = now()";
			$sql_upd .= " where";
			$sql_upd .= " id = " . $_SESSION['members_id'];
			common_exec_sql( $sql_upd );
		}
	}
	return;
}
function favorites_delete( $listings_id ){
	$favorites = NULL;
	$listings_id_arr = explode(",",$_COOKIE['newpropertylist']['Favorites']);
	foreach( $listings_id_arr as $key ){
		if( $listings_id != $key ){
			if(!empty($favorites)){
				$favorites .= ",";
			}
			$favorites .= $key;
		}
	}
	setcookie("newpropertylist[Favorites]","$favorites",time() + 1825 * 24 * 60 * 60,"/" );
	if(!empty($_SESSION['members_id'])){
		$sql = "update members set";
		$sql .= " favorites = '$favorites'";
		$sql .= ",modified = now()";
		$sql .= " where";
		$sql .= " id = " . $_SESSION['members_id'];
		common_exec_sql( $sql );
	}
	return;
}
?>
