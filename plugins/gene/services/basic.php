<?php
$post_id=trim($_POST['id']);
require_once(realpath(__DIR__.'/../../settings.php'));

$table_name="transcript_info";
$id_type="";
 
//MySQL connection from main settings file. database is popgeniegenepages
mysql_connect($db_settings['host'], $db_settings['user'], $db_settings['pass']) or die(mysql_error());
mysql_select_db($selected_database) or die(mysql_error());

//Initial check whether given ID exsist on our Database
if(isset($post_id) && $post_id != ''){
	$initcheck=mysql_query("SELECT * FROM ".$table_name." WHERE transcript_id='$post_id' or gene_id='$post_id'");
	if(mysql_num_rows($initcheck)!=0){
		$init_id = strtolower($post_id);
		$pattern = '/^[a-zA-Z0-9]+[.]+[a-zA-Z0-9]+[.]+[0-9]?[0-9]$/';
		if(preg_match($pattern,$init_id)== true){
			$id_type="transcript";
		}else{
			$id_type="gene";  
		}
	}else{
			$id_type="invalid id";
		}
}
//When id is transcript or gene
if($id_type=="transcript" ||  $id_type=="gene"){
	$basic_results = mysql_query("SELECT $table_name.*, atg_id FROM $table_name "
                                 ."LEFT JOIN transcript_atg ON $table_name.transcript_i = transcript_atg.transcript_i "
                                 ."WHERE $table_name.transcript_id = '$post_id' "
                                 ."   OR $table_name.gene_id = '$post_id' "
                                 ."LIMIT 1");
	
	while ($basic_results_rows = mysql_fetch_array($basic_results)) {
		$tmp_geneid=$basic_results_rows['gene_id'];

        $children = new stdClass();
		$children->gene_id=$tmp_geneid;		
		$basic_results_tids = mysql_query("SELECT transcript_id FROM ".$table_name." WHERE gene_id='$tmp_geneid'");
		while ($basic_results_rows_tids = mysql_fetch_array($basic_results_tids)) {
			if($basic_results_rows_tids['transcript_id']!=$post_id){
			$tmp_tids.=$basic_results_rows_tids['transcript_id'].' ';
			}
		}
		$children->transcript_id=$basic_results_rows['transcript_id'];
		
		$children->other_transcripts=$tmp_tids;
		$children->description=$basic_results_rows['description'];
		$children->chromosome_name=$basic_results_rows['chromosome_name'];
		$children->strand=$basic_results_rows['strand'];
		
		$children->gene_start=$basic_results_rows['gene_start'];
		$children->gene_end=$basic_results_rows['gene_end'];
		
		$children->pac_id=$basic_results_rows['pac_id'];
		$children->peptide_name=$basic_results_rows['peptide_name'];
		$children->transcript_start=$basic_results_rows['transcript_start'];
		$children->transcript_end=$basic_results_rows['transcript_end'];
		
		$children->atg_id=$basic_results_rows['atg_id'];
		
		$children->input_type=$id_type;
		$children->input_id=$post_id;
		$ret[] = $children;
	}
}
	

	
//When id is an invalid 	
if($id_type=="invalid id"){
	}	

if($ret!=null){
	$arrsg = array ('basic_data'=>$ret); 
}else{
	$arrsg = array ('error'=>$post_id);
}
echo json_encode($arrsg);
	
	
  
######################################################################
//Check prefix
######################################################################
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



?>