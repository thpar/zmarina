<?php
#####################################
//Header variables and GET parameters
//2017/11/23- Chanaka Mannapperuma
#####################################
header('Cache-Control: no-cache');
header('Pragma: no-cache');
$primaryGene = trim($_GET['primaryGene']);
$sample = trim($_GET['sample']);
$view = trim($_GET['view']);
$expression_table="expression_exatlas_".$view;//."_no_replicates";
if($view=="phytophthora_cinnamomi"){
	$expression_table="eximage_biotic_stress";
}


#####################################
//MySQL connection
#####################################
include(realpath(__DIR__.'/../../settings.php'));
mysql_connect($db_settings['host'],$db_settings['user'],$db_settings['pass']) or die(mysql_error());
mysql_select_db($selected_database) or die(mysql_error());

#####################################
//Extract expression values related to given gene id
#####################################
if($view=="phytophthora_cinnamomi" || $view=="experiment_1"){
$resultprobeset = mysql_query("SELECT sample,avg(cast(log2 as decimal(5,4))) as log2 FROM $expression_table WHERE id='$primaryGene' group by sample union select CONCAT('exatlas_',sample),avg(cast(log2 as decimal(5,4))) as log2 from exatlas_summary where id='$primaryGene' group by sample;")	or die(mysql_error());
}else{
	$resultprobeset = mysql_query("SELECT sample,avg(cast(log2 as decimal(5,4))) as log2 FROM $expression_table WHERE id='$primaryGene' group by sample") or die(mysql_error());
}
//SELECT sample,avg(cast(log2 as decimal(5,4))) ,rmd,log2fc FROM expression_experiment_2_copy where id ="Eucgr.A00003" group by sample
$g = 0;
while ($rowPROBE_ID = mysql_fetch_array($resultprobeset)) {
	$children[$g]->sample=$rowPROBE_ID['sample'];
	$children[$g]->log2=$rowPROBE_ID['log2'];
	$children[$g]->rmd=$rowPROBE_ID['log2'];
	$children[$g]->log2fc=$rowPROBE_ID['log2'];
	$ret[] = $children[$g];
	$g++;
}

#####################################
//Pass the results as JSON array
#####################################
if($ret!=null){
		$arrsg = array ('popdata'=>$ret);
}else{
		$arrsg = array ('popdata'=>$ret,'errorID'=>$popmeGene);
}
echo json_encode($arrsg);

#####################################
//Check prefix
#####################################
function checkprefix($source, $prefix) {
    if (str_startswith($source, $prefix)) {
       return true;
    } else {
       return false;
    }
}
function str_startswith($source, $prefix){
   return strncmp($source, $prefix, strlen($prefix)) == 0;
}

 ?>
