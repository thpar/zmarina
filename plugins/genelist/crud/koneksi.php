<?php
include("../../settings.php");
global $db_url; 
$private_url = parse_url($db_url['genelist']);
mysql_connect($private_url['host'], $private_url['user'], $private_url['pass']) or die(mysql_error());
mysql_select_db(str_replace('/', '', $private_url['path'])) or die(mysql_error());
?>
