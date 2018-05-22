<?php 
$requested_path = explode('?', $_SERVER['REQUEST_URI'])[0];
$requested_page = strtolower(end(explode('/', $requested_path)));
$mennu_arr= explode("<br />", $c['menu']);
$menu_exist=false;

foreach($mennu_arr as $searched){
	if(trim(strtolower($searched)) == $requested_page || 
       trim(strtolower($searched)) == "-".$requested_page){
		$menu_exist=true;
	}
}

if(strtolower(basename(dirname(__FILE__))) == $requested_page && $menu_exist){
	$c['initialize_tool_plugin']=true;
	$c['tool_plugin']=$requested_page;

}
?>
