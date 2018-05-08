<?php 
$subdir_arr = explode("/", $_SERVER['REQUEST_URI']);
$mennu_arr= explode("<br />", $c['menu']);
$menu_exist=false;

foreach($mennu_arr as $searched){
	if(trim(strtolower($searched)) == strtolower(end($subdir_arr)) || 
       trim(strtolower($searched)) == "-".strtolower(end($subdir_arr))){
		$menu_exist=true;
	}
}

if(strtolower(basename(dirname(__FILE__))) == strtolower(end($subdir_arr)) && $menu_exist){
	$c['initialize_tool_plugin']=true;
	$c['tool_plugin']=strtolower(end($subdir_arr));

}
?>