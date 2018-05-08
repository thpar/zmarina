<?php
$q="comp1_c0_seq1";

require_once(realpath(__DIR__.'/../../settings.php'));
mysql_connect($db_settings['host'], $db_settings['user'], $db_settings['pass']) or die(mysql_error());
mysql_select_db($selected_database) or die(mysql_error());


$resultssequence = mysql_query("select nam,len,gc from trinity where nam='$q'")or die(mysql_error());
                                //$j = 0;
                                //$sequence="";
                                //while (
								while($sequencearr = mysql_fetch_array($resultssequence)){;//) {
                               		  $namesr=$sequencearr['nam'];
									  $lenr=$sequencearr['nam'];
		                            
									foreach ($sequencearr as $namesr) {
            							if (strpos(strtolower($namesr), $q) !== false) {
               								 $results[] = array($namesr, $lenr,$q);
           								 }
       								}
									  $j++;
									}
									print_r($results)
?>