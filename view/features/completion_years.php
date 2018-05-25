<?php
if( !empty($completion_years_id) || ( $row_num_pager > 1 && empty($completion_years_id) && count($completion_years_id_arr) > 1) ){
?>

          <div class="MdSAC05SideList">
            <div class="mdSAC05Ttl01"><h2>Completion Year</h2></div>
            <ul class="mdSAC05List01">
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
        $url = "/features/" . $features_code;
        if($states_code != "all-state" || ($arr['code']!=$completion_years_code||!empty($locations_code)||!empty($groups_code)||!empty($property_type_groups_code)||!empty($prices_code)||!empty($sizes_code)||!empty($bedrooms_code))){
                $url .= "/" . $states_code . "/";
        }
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
              <li class="mdSAC05Cell01"> <input class="cuctom-check" value="<?php echo $url;?>" id="checkbox-id<?php echo $i;?>" type="checkbox" onChange="location.href=value;" <?php if( $arr['code'] == $completion_years_code ){ echo "checked"; } ?> /><label for="checkbox-id<?php echo $i;?>"><?php echo $arr['name'];?></label> </li>
<?php
}
?>
            </ul>
          </div>
<?php
}
?>
