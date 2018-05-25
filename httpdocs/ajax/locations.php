<?php
//ini_set( 'display_errors', 1 );
//ファイルインクルード
include $_SERVER['BASE_DIR']."/model/common/common.php";
include $_SERVER['BASE_DIR']."/model/common/list.php";
include $_SERVER['BASE_DIR']."/model/mysql/common.php";
include $_SERVER['BASE_DIR']."/model/locations/common.php";

session_start();
common_cookie_check();
mysql_mysql_connect();

if( $_POST['mode'] == "init" ){
	$_SESSION['locations_id'] = $_POST['locations_id'];
}else{
	if(!empty($_POST['locations_id'])){
		if( $_POST['locations_id'] == $_SESSION['locations_id'] ){
			$_SESSION['locations_id'] = NULL;
		}else{
			$_SESSION['locations_id'] = $_POST['locations_id'];
		}
	}
}
if(!empty($_SESSION['groups_id'])){
	$i=0;
	$sql = "select";
	$sql .= " *";
	$sql .= " from";
	$sql .= " locations";
	$sql .= " where";
	$sql .= " groups_id = " . $_SESSION['groups_id'];
	$sql .= " and";
	$sql .= " listings_num > 0";
	$sql .= " and";
	$sql .= " is_deleted = 0";
	$result = mysql_query( $sql );
	if( mysql_num_rows( $result )){
?>

            <h4>Location
              <ul class="ul chkbox">
<?php
			while( $arr = mysql_fetch_array( $result )){
				if(!empty($_SESSION['locations_id'])){
					if( $arr['id'] != $_SESSION['locations_id'] ){
						continue;
					}
				}
			        $i++;
?>
                <li>
                  <input type="checkbox" name="locations_id" id="locations_<?php echo $i;?>" value="<?php echo $arr['id'];?>" onclick="ajax_locations('',<?php echo $arr['id'];?>)" <?php if( $arr['id'] == $_SESSION['locations_id'] ){ echo "checked";} ?>>
                  <label for="locations_<?php echo $i;?>"><?php echo $arr['name'];?></label>
                </li>
<?php
			}
?>
              </ul>
            </h4>
<?php
	}
}
?>
