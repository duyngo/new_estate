<?php
//ini_set( 'display_errors', 1 );
//ファイルインクルード
include $_SERVER['BASE_DIR']."/model/common/common.php";
include $_SERVER['BASE_DIR']."/model/common/list.php";
include $_SERVER['BASE_DIR']."/model/mysql/common.php";
include $_SERVER['BASE_DIR']."/model/bedrooms/common.php";
include $_SERVER['BASE_DIR']."/model/companies/common.php";
include $_SERVER['BASE_DIR']."/model/completion_years/common.php";
include $_SERVER['BASE_DIR']."/model/favorites/common.php";
include $_SERVER['BASE_DIR']."/model/groups/common.php";
include $_SERVER['BASE_DIR']."/model/listings/common.php";
include $_SERVER['BASE_DIR']."/model/listings_call_clicks/common.php";
include $_SERVER['BASE_DIR']."/model/listings_project_details/common.php";
include $_SERVER['BASE_DIR']."/model/locations/common.php";
include $_SERVER['BASE_DIR']."/model/prices/common.php";
include $_SERVER['BASE_DIR']."/model/property_type_groups/common.php";
include $_SERVER['BASE_DIR']."/model/property_types/common.php";
include $_SERVER['BASE_DIR']."/model/sizes/common.php";
include $_SERVER['BASE_DIR']."/model/states/common.php";

session_start();
common_cookie_check();
mysql_mysql_connect();

if( $_POST['mode'] == "init" ){
	$_SESSION['property_type_groups_id'] = $_POST['property_type_groups_id'];
}else{
	if(!empty($_POST['property_type_groups_id'])){
		if( $_POST['property_type_groups_id'] == $_SESSION['property_type_groups_id'] ){
			$_SESSION['property_type_groups_id'] = NULL;
		}else{
			$_SESSION['property_type_groups_id'] = $_POST['property_type_groups_id'];
		}
	}
}
?>

            <h4>Property Type
              <ul class="ul chkbox">
<?php
$i=0;
$result = property_type_groups_index();
while( $arr = mysql_fetch_array( $result )){
	if(!empty($_SESSION['property_type_groups_id'])){
		if( $arr['id'] != $_SESSION['property_type_groups_id'] ){
			continue;
		}
	}
        $i++;
?>
                <li>
                  <input type="checkbox" name="property_type_groups_id" id="property_type_groups_<?php echo $i;?>" value="<?php echo $arr['id'];?>" onclick="ajax_property_type_groups('',<?php echo $arr['id'];?>)" <?php if( $arr['id'] == $_SESSION['property_type_groups_id'] ){ echo "checked";} ?>>
                  <label for="property_type_groups_<?php echo $i;?>"><?php echo $arr['name'];?></label>
                </li>
<?php
}
?>
              </ul>
            </h4>
