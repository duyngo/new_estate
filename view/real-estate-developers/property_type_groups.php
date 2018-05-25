<?php
$property_type_groups_id_arr = property_types_get_property_type_groups_id( $property_types_id_arr );
if( !empty($property_type_groups_code) || ( $row_num_pager > 1 && empty($property_type_groups_code) && count($property_type_groups_id_arr) > 1) ){
?>

          <div class="MdSAC05SideList">
            <div class="mdSAC05Ttl01"><h2>Property types</h2></div>
            <ul class="mdSAC05List01">
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
        if($states_code != "all-state" || ($arr['code'] != $property_type_groups_code||!empty($locations_code)||!empty($groups_code)||!empty($prices_code)||!empty($sizes_code)||!empty($bedrooms_code)||!empty($completion_years_code))){
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
              <li class="mdSAC05Cell01"> <input class="cuctom-check" value="<?php echo $url;?>" id="checkbox-id<?php echo $i;?>" type="checkbox" onChange="location.href=value;" <?php if( $arr['code'] == $property_type_groups_code ){ echo "checked"; } ?> /><label for="checkbox-id<?php echo $i;?>"><?php echo $arr['name'];?></label> </li>
<?php
}
?>
            </ul>
          </div>
<?php
}
?>
