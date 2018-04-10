<?php
 //require_once("json.php");
  //header('Content-Type: text/javascript');
  header('Cache-Control: no-cache');
  header('Pragma: no-cache');

require_once(realpath(__DIR__.'/../../settings.php'));


$primaryGene = trim($_GET['primaryGene']);
$sample = trim($_GET['sample']);
$view = trim($_GET['view']);


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
function str_startswith($source, $prefix)
{
   return strncmp($source, $prefix, strlen($prefix)) == 0;
}

if(checkprefix($primaryGene,"Potra")==true){
		$sextable="eplant_sex_new_potra";
		$catologtable="eplant_asp201_2014_april_potra";
		}else{
			//$sextable="eplant_sex_new";
		$catologtable="expression_tissues";
		}


/////////////////////////////////////

// Make a MySQL Connection
mysql_connect($db_settings['host'], $db_settings['user'], $db_settings['pass']) or die(mysql_error());
mysql_select_db($selected_database) or die(mysql_error());

if($view=="plant" || $view=="experiment_2"){
if(checkprefix($primaryGene,"Eu")==true){
// Retrieve all the data from the "poptr_to_probeset_lookup" table
$resultprobeset = mysql_query("SELECT * FROM expression_tissues WHERE id='$primaryGene' ;")
or die(mysql_error());
}else{
	$pattern = '/^[a-zA-Z0-9]+[.]+[a-zA-Z0-9]+[.]+[0-9]?[0-9]$/';
		if(preg_match($pattern,$primaryGene)== true){
			$newpattern = '/^[a-zA-Z0-9]+[.]+[a-zA-Z0-9]+[.]+[0-9]$/';
			if(preg_match($newpattern,$primaryGene)== true){
				$newid= substr_replace($primaryGene, "", -2);
				$resultprobeset = mysql_query("SELECT DISTINCT sample,log2,rmd,log2fc,log2dif FROM expression_".$view." WHERE id='$newid'  order by sample;")	or die(mysql_error());
			}else{
				$newid2= substr_replace($primaryGene, "", -3);
				$resultprobeset = mysql_query("SELECT DISTINCT sample,log2,rmd,log2fc,log2dif FROM expression_".$view." WHERE id='$newid2'  order by sample;")	or die(mysql_error());
			}
		}else{
			$resultprobeset = mysql_query("SELECT DISTINCT sample,log2,rmd,log2fc,log2dif FROM expression_".$view." WHERE id='$primaryGene'  order by sample;")	or die(mysql_error());
		}
}

$g = 0;
while ($rowPROBE_ID = mysql_fetch_array($resultprobeset)) {
	$children[$g]->sample=$rowPROBE_ID['sample'];
	$children[$g]->log2=$rowPROBE_ID['log2'];
	$children[$g]->rmd=$rowPROBE_ID['log2dif'];
	$children[$g]->log2fc=$rowPROBE_ID['log2'];
	$ret[] = $children[$g];
	$g++;
}



}else if($view=="20leaves"){
if(checkprefix($primaryGene,"POPTR")==true){

// Retrieve all the data from the "poptr_to_probeset_lookup" table
$resultprobeset = mysql_query("SELECT * FROM eplant_sex WHERE id='$primaryGene' ;")
or die(mysql_error());
}else{
	$pattern = '/^[a-zA-Z0-9]+[.]+[a-zA-Z0-9]+[.]+[0-9]?[0-9]$/';
		if(preg_match($pattern,$primaryGene)== true){
			$newpattern = '/^[a-zA-Z0-9]+[.]+[a-zA-Z0-9]+[.]+[0-9]$/';
			if(preg_match($newpattern,$primaryGene)== true){
				$newid= substr_replace($primaryGene, "", -2);
				$resultprobeset = mysql_query("SELECT  sample,log2,rmd,log2fc FROM $sextable WHERE id='$newid'  order by sample;")	or die(mysql_error());
			}else{
				$newid2= substr_replace($primaryGene, "", -3);
				$resultprobeset = mysql_query("SELECT  sample,log2,rmd,log2fc FROM $sextable WHERE id='$newid2'  order by sample;") or die(mysql_error());
			}
		}else{
			$resultprobeset = mysql_query("SELECT  sample,log2,rmd,log2fc FROM $sextable WHERE id='$primaryGene'  order by sample; ;")	or die(mysql_error());
		}//Earlier it was eplant_sex_rnaseq_data_2013_09_27
}

$g = 0;
while ($rowPROBE_ID = mysql_fetch_array($resultprobeset)) {
	$children[$g]->sample=$rowPROBE_ID['sample'];
	$children[$g]->log2=$rowPROBE_ID['log2'];
	$children[$g]->rmd=$rowPROBE_ID['rmd'];
	$children[$g]->log2fc=$rowPROBE_ID['log2'];
	$ret[] = $children[$g];
	$g++;
}






}else if($view=="asp201"){
if(checkprefix($primaryGene,"POPTR")==true){

// Retrieve all the data from the "poptr_to_probeset_lookup" table
$resultprobeset = mysql_query("SELECT * FROM eplant_asp201 WHERE id='$primaryGene' AND  sample in ('Buds-Dormant','Buds-Pre-chilling','Cambium-Phloem-Dormant','Flowers-Dormant','Flowers-Expanded','Flowers-Expanding','Leaves-Beetle-Damaged','Leaves-Control','Leaves-Drought','Leaves-Freshly-Expanded','Leaves-Mature','Leaves-Mechanical-Damage','Leaves-Young-Expanding','Roots-Control','Seeds-Mature','Suckers-Whole-Sucker');")
or die(mysql_error());
}else{
	$pattern = '/^[a-zA-Z0-9]+[.]+[a-zA-Z0-9]+[.]+[0-9]?[0-9]$/';
		if(preg_match($pattern,$primaryGene)== true){
			$newpattern = '/^[a-zA-Z0-9]+[.]+[a-zA-Z0-9]+[.]+[0-9]$/';
			if(preg_match($newpattern,$primaryGene)== true){
				$newid= substr_replace($primaryGene, "", -2);
				//$resultprobeset = mysql_query("SELECT * from eplant_asp201_2014_april where id='$newid'");
				$resultprobeset = mysql_query("SELECT  DISTINCT sample,log2,rmd,log2fc,log2dif FROM $catologtable WHERE id='$newid' AND sample in ('Buds-Dormant','Buds-Pre-chilling','Cambium-Phloem-Dormant','Flowers-Dormant','Flowers-Expanded','Flowers-Expanding','Leaves-Beetle-Damaged','Leaves-Control','Leaves-Drought','Leaves-Freshly-Expanded','Leaves-Mature','Leaves-Mechanical-Damage','Leaves-Young-Expanding','Roots-Control','Seeds-Mature','Suckers-Whole-Sucker');")	or die(mysql_error());
			}else{
				$newid2= substr_replace($primaryGene, "", -3);
				//$resultprobeset = mysql_query("SELECT * from eplant_asp201_2014_april where id='$newid2'");
				$resultprobeset = mysql_query("SELECT DISTINCT sample,log2,rmd,log2fc,log2dif FROM $catologtable WHERE id='$newid2'  AND sample in ('Buds-Dormant','Buds-Pre-chilling','Cambium-Phloem-Dormant','Flowers-Dormant','Flowers-Expanded','Flowers-Expanding','Leaves-Beetle-Damaged','Leaves-Control','Leaves-Drought','Leaves-Freshly-Expanded','Leaves-Mature','Leaves-Mechanical-Damage','Leaves-Young-Expanding','Roots-Control','Seeds-Mature','Suckers-Whole-Sucker');")	or die(mysql_error());
			}
		}else{
			//$resultprobeset = mysql_query("SELECT * from eplant_asp201_2014_april where id='$primaryGene'");
			$resultprobeset = mysql_query("SELECT DISTINCT  sample,log2,rmd,log2fc,log2dif FROM $catologtable WHERE id='$primaryGene' AND sample in ('Buds-Dormant','Buds-Pre-chilling','Cambium-Phloem-Dormant','Flowers-Dormant','Flowers-Expanded','Flowers-Expanding','Leaves-Beetle-Damaged','Leaves-Control','Leaves-Drought','Leaves-Freshly-Expanded','Leaves-Mature','Leaves-Mechanical-Damage','Leaves-Young-Expanding','Roots-Control','Seeds-Mature','Suckers-Whole-Sucker');")	or die(mysql_error());
		}
}


$g = 0;
while ($rowPROBE_ID = mysql_fetch_array($resultprobeset)) {
	$children[$g]->sample=$rowPROBE_ID['sample'];
	$children[$g]->log2=$rowPROBE_ID['log2'];
	$children[$g]->rmd=$rowPROBE_ID['rmd'];
	$children[$g]->log2fc=$rowPROBE_ID['log2dif'];
	$ret[] = $children[$g];
	$g++;
}






}




if($ret!=null){
		$arrsg = array ('popdata'=>$ret);
	}else{
		$arrsg = array ('popdata'=>$ret,'errorID'=>$popmeGene);
	}
	echo json_encode($arrsg);


/*if($dataparts==""){
$dataparts=$sample;
}
  if ($primaryGene) {
     // echo '{';
			$arr = array ($dataparts=>$datadatasignal,$dataparts.'rmd'=>$datadatasignal2,$dataparts.'log2fc'=>$datadatasignal3);
     // echo "\"$sample\":\"$datasignaldata_probeset_id\"";,'annotation'=>$datasignaldata_poptr_annotation,
		//	'gene'=>$datasignalGENE,'besthit'=>$datasignalBEST_HIT
		// $testone=."","".;
			echo json_encode($arr);
			//echo ";\"$sample\":\"$datasignalPROBE_ID\"";
		//	echo json_encode();
     // echo '}';

			//echo '}';
  }*/
//mysql_close(mysql_connect());
//echo ']';
?>
