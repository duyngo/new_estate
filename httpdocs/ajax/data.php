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
include $_SERVER['BASE_DIR']."/model/tenures/common.php";

session_start();
common_cookie_check();
mysql_mysql_connect();

$limit = 10;
$offset = $_REQUEST['page'] * $limit;
$result_main = listings_index("",$_SESSION['states_id'],$_SESSION['groups_id'],$_SESSION['locations_id'],$_SESSION['property_type_groups_id'],$_SESSION['prices_id'],$_SESSION['features_id'],$_SESSION['completion_years_id'],$_SESSION['bedrooms_id'],$_SESSION['sizes_id'],$_SESSION['tenures_id'],$limit,$offset);


$i=0;
while( $arr = mysql_fetch_array( $result_main )){
	$i++;
?>


        <div class="mdSAC02ListItem"><a href="/<?php echo $arr['states_code'] . "/" . $arr['code'] . "-in-" . $arr['locations_code'];?>"><img src="/admin/images/listings/<?php echo $arr['main_picture'];?>" alt=""></a>
          <h2><?php echo $arr['name'];?></h2>
          <p class="Gold"><?php echo $arr['price_name'];?></p>
          <p class="Gold">Type is <?php echo $arr['property_name'];?></p>
          <p class="Gray"><?php echo $arr['address'];?></p>
          <div class="div_<?php echo $arr['id'];?>">
<?php
                if(strpos($_COOKIE['newpropertylist']['Favorites'],$arr['id'])===false){
                        echo "<button class=\"GoldBtn Search\" onclick=\"ajax_" . $arr['id'] . "(" . $arr['id'] . ")\">Add to cart</button>";
                }else{
                        echo "<button class=\"GoldBtn Search Finish\" onclick=\"ajax_" . $arr['id'] . "(" . $arr['id'] . ")\">Already in Cart</button>";
                }
?>
	  </div>
        </div>

<?php
}
?>
