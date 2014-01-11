<?php
function can_current_user($action, $value = ''){
	$current_user = $_SESSION["user"]["role"];
	
	$permission = new mysql();
	$permissionresult = $permission->query("SELECT  value FROM `".$permission->dbprae."globals` WHERE `key` = 'user_roles' LIMIT 1;");
	$row = $permission->result($permissionresult, "assoc");
	$permission_array = json_decode($row["value"], true);
	return array_key_exists_r($action, $permission_array[$current_user]);

}

function add_permission($user, $action, $value = ''){

	// can_current_user check here

	$permission = new mysql();
	$permissionresult = $permission->query("SELECT  value FROM `".$permission->dbprae."globals` WHERE `key` = 'user_roles' LIMIT 1;");
	$row = $permission->result($permissionresult, "assoc");
	$permission_array = json_decode($row["value"], true);
	$permission_array[$user][$action] = $value;
	$permission->query("UPDATE  `".$permission->dbprae."globals` SET  `value` = '".json_encode($permission_array)."' WHERE  `globals`.`key` = 'user_roles';");
	
}


/** key_exist search in recrusive array - need for can_current_user() **/
function array_key_exists_r($needle, $haystack){
    $result = array_key_exists($needle, $haystack);
    if ($result)
        return $result;
    foreach ($haystack as $v)
    {
        if (is_array($v) || is_object($v))
            $result = array_key_exists_r($needle, $v);
        if ($result)
        return $result;
    }
    return $result;
}
?>