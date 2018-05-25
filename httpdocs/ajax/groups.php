<?php
//ini_set( 'display_errors', 1 );
//ファイルインクルード
include $_SERVER['BASE_DIR']."/model/common/common.php";
include $_SERVER['BASE_DIR']."/model/common/list.php";
include $_SERVER['BASE_DIR']."/model/mysql/common.php";
include $_SERVER['BASE_DIR']."/model/groups/common.php";

session_start();
common_cookie_check();
mysql_mysql_connect();

if( $_POST['mode'] == "init" ){
	$_SESSION['groups_id'] = $_POST['groups_id'];
}else{
	if(!empty($_POST['groups_id'])){
		if( $_POST['groups_id'] == $_SESSION['groups_id'] ){
			$_SESSION['groups_id'] = NULL;
			$_SESSION['locations_id'] = NULL;
		}else{
			$_SESSION['groups_id'] = $_POST['groups_id'];
			$_SESSION['locations_id'] = NULL;
		}
	}else{
		if(empty($_SESSION['states_id'])){
			$_SESSION['groups_id'] = NULL;
			$_SESSION['locations_id'] = NULL;
		}
	}
}
if(!empty($_SESSION['states_id'])){
        $sql = "select";
        $sql .= " *";
        $sql .= " from";
        $sql .= " groups";
        $sql .= " where";
        $sql .= " states_id = " . $_SESSION['states_id'];
        $sql .= " and";
        $sql .= " listings_num > 0";
        $sql .= " and";
        $sql .= " is_deleted = 0";
        $result = mysql_query( $sql );
	if(mysql_num_rows($result)){
		$i=0;
?>

            <h4>Area Group
              <ul class="ul chkbox">
<?php
		while( $arr = mysql_fetch_array( $result )){
			if(!empty($_SESSION['groups_id'])){
				if( $arr['id'] != $_SESSION['groups_id'] ){
					continue;
				}
			}
			$i++;
?>
                <li>
                  <input type="checkbox" name="groups_id" id="groups_<?php echo $i;?>" value="<?php echo $arr['id'];?>" onclick="ajax_groups('',<?php echo $arr['id'];?>);ajax_locations('','');" <?php if( $arr['id'] == $_SESSION['groups_id'] ){ echo "checked";} ?>>
                  <label for="groups_<?php echo $i;?>"><?php echo $arr['name'];?></label>
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
