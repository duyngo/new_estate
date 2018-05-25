<?php
function external_users_child_companies_index( $companies_id ){
        $sql = "select";
        $sql .= " *";
        $sql .= " from";
        $sql .= " companies";
        $sql .= " where";
        $sql .= " id <> " . $companies_id;
        $sql .= " and";
        $sql .= " parent_id = " . $companies_id;
        $sql .= " and";
        $sql .= " is_deleted = 0";
        $sql .= " order by id";
        return mysql_query($sql);
}
?>
