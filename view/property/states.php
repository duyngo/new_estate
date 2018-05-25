<?php
if( $states_code != "all-state" || ( $row_num_pager > 1 && $states_code == "all-state" && count($states_id_arr) > 1) ){
?>
          <div class="MdSAC05SideList">
            <div class="mdSAC05Ttl01"><h2>State</h2></div>
            <ul class="mdSAC05List01">
<?php
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
        if( $arr['code'] != $states_code ){
                $url = "/" . $arr['code'] . "/";
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
                if(!empty($tenures_code)){
			if(!empty($property_type_groups_code)||!empty($prices_code)||!empty($sizes_code)||!empty($bedrooms_code)||!empty($completion_years_code)){
                                $url .= "_";
                        }
                        $url .= $tenures_code;
                }
        }else{
                $url = "/all-state/";
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
                if(!empty($tenures_code)){
			if(!empty($property_type_groups_code)||!empty($prices_code)||!empty($sizes_code)||!empty($bedrooms_code)||!empty($completion_years_code)){
                                $url .= "_";
                        }
                        $url .= $tenures_code;
                }
        }
?>
              <li class="mdSAC05Cell01"> <input class="cuctom-check" value="<?php echo $url;?>" id="checkbox-id<?php echo $i;?>" type="checkbox" onChange="location.href=value;" <?php if( $arr['code'] == $states_code ){ echo "checked"; } ?> /><label for="checkbox-id<?php echo $i;?>"><?php echo $arr['name'];?></label> </li>
<?php
        }
?>
            </ul>
          </div>
<?php
}
?>
