<?php
/*
This function(s) can add actions into a queue, orded by there priority.
queue runs throw when run_action gets called with the contained actionname
*/

//action_sort - php algorithm to order the array by the priority
function action_sort($a, $b) {
    return $a['priority'] > $b['priority'] ? 1 : -1;
}

$actions = array();

// adds an action into the specific actionname array
// if the same function gets called to the same actionname, the last call overwrites the params and priority
function add_action($actionname, $function, $params = array(), $priority = 10){
	global $actions;
	$actions[$actionname][$function] = array(
	"name" => $function,
	"parameter" => $params,
	"priority" => $priority
	);
	$actions[$actionname] = array_reverse($actions[$actionname]);
	uasort($actions[$actionname], 'action_sort');
}

// runs all actions belonging to the action_name
function run_action($actionname, $transfered_params = array()){
	global $actionnamelog;
	$actionnamelog[] = $actionname;
	global $actions;
	$return_arr = array();
	//loop to every action with should get processed
	if(isset($actions[$actionname])){
		foreach($actions[$actionname] as $action){
			$params = array();
			//Binding the parameters to the function
			foreach($action["parameter"] as $key => $parameter){
			//function that allows run_action to return values to the function
				if('transferred-keys' == $key && is_array($parameter)){
					$transferred_keys = array_flip($parameter);
					$return_array = array_merge($transferred_keys, $transfered_params);
					foreach($return_array as $return_key => $return_parameter){
						//sorts out every variables wich don't need to get returned
						if(in_array($return_key, $parameter)){
							$params[] = $return_parameter;
						}
					}
				}else{
					$params[] = $parameter;
				}
			}
			$return_arr[$actionname] = call_user_func_array($action["name"], $params);
		}
	}
	return $return_arr;
}
?>