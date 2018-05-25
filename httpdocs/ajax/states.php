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
	$_SESSION['states_id'] = $_POST['states_id'];
}else{
	if(!empty($_POST['states_id'])){
		if( $_POST['states_id'] == $_SESSION['states_id'] ){
			$_SESSION['states_id'] = NULL;
			$_SESSION['groups_id'] = NULL;
			$_SESSION['locations_id'] = NULL;
		}else{
			$_SESSION['states_id'] = $_POST['states_id'];
			$_SESSION['groups_id'] = NULL;
			$_SESSION['locations_id'] = NULL;
		}
	}
}
?>

            <h4>State
              <ul class="ul chkbox">
<?php
$i=0;
$result = states_index();
while( $arr = mysql_fetch_array( $result )){
	if(!empty($_SESSION['states_id'])){
		if( $arr['id'] != $_SESSION['states_id'] ){
			continue;
		}
	}
        if($arr['listings_num']){
	        $i++;
?>
                <li>
                  <input type="checkbox" name="states_id" id="checkbox_<?php echo $i;?>" value="<?php echo $arr['id'];?>" onclick="ajax_states('',<?php echo $arr['id'];?>);ajax_groups('','');ajax_locations('','');" <?php if( $arr['id'] == $_SESSION['states_id'] ){ echo "checked";} ?>>
                  <label for="checkbox_<?php echo $i;?>"><?php echo $arr['name'];?></label>
                </li>
<?php
        }
}
?>
              </ul>
            </h4>
