<?php
require_once(realpath(__DIR__.'/../../settings.php'));
mysql_connect($db_settings['host'], $db_settings['user'], $db_settings['pass']) or die(mysql_error());
mysql_select_db($selected_database) or die(mysql_error());
$token="testtoken"; 
?>
