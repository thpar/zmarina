<?php
require_once('Datatables2.php');
require_once(realpath(__DIR__.'/../../../settings.php'));
include('../../crud/getgenelist.php');
$default_gene_basket_array=getdefaultgenelist();



$datatables = new Datatables();

if(checkprefix(trim(htmlentities($_POST['id'])),"Shared")==true ){
$keywords =  preg_split("/[\:]+/",trim(htmlentities($_POST['id'])));
		$geneids_array=getdefaultsaredgenelist($keywords[1]);
		$sharred_list=implode('","',$geneids_array);
}

$tintinvariable="zosma";
$table_name="transcript_info";


//MySQL connection from main settings file. database is popgeniegenepages
$private_url = parse_url($db_url['genelist']);
$popgenie_genepages_config = array(
'username' => $private_url['user'],
'password' => $private_url['pass'],
'database' => str_replace('/', '', $private_url['path']),
'hostname' => $private_url['host']);

// MYSQL configuration
$datatables->connect($popgenie_genepages_config);

$datatables->select(''.$table_name.'.gene_id as ID,"check_box_value",'.$table_name.'.gene_id as ids,'.$table_name.'.transcript_id,'.$table_name.'.chromosome_name,'.$table_name.'.description,transcript_atg.atg_id,gene_kegg.kegg_description,gene_atg.atg_description,gene_go.go_description,gene_pfam.pfam_description')
->from($table_name)
->join('transcript_atg', 'transcript_atg.transcript_i=transcript_info.transcript_i', 'left')
->join('gene_kegg', 'gene_kegg.gene_i=transcript_info.gene_i', 'left')
	->join('gene_atg', 'gene_atg.gene_i=transcript_info.gene_i', 'left')
	->join('gene_go', 'gene_go.gene_i=transcript_info.gene_i', 'left')
	->join('gene_pfam', 'gene_pfam.gene_i=transcript_info.gene_i', 'left')
->edit_column('ids', '<a target="_parent" href="gene?id=$1" target="_parent">$1</a>', 'ID')
->unset_column(''.$table_name.'.Gene_End');


if(isset($sharred_list)){
    $datatables->where('gene_id in ',$sharred_list);
}

if(isset($_POST['id']) && $_POST['id'] != ''){
	$vowels = array(",", ";", "\t", "\n", "\r", "s+", " ",",,");
	$post_input=preg_replace("/\s+/", ",", trim(htmlentities($_POST['id'])));
	$onlyconsonants = strtolower(str_replace($vowels, ",", $post_input));
	$pattern = '/^[a-zA-Z0-9]+[.]+[a-zA-Z0-9]+[.]+[0-9]?[0-9]$/';
	$flag=true;

	if(checkprefix($onlyconsonants,$tintinvariable)==true && checkprefix($onlyconsonants,"zosma")==true){
		$flag=false;
	$geneids_array = explode(",", $onlyconsonants);
	$geneids_array_str=implode('","',$geneids_array);
	
		if(preg_match($pattern,$geneids_array[0])== true){
			$datatables->where($table_name.'.transcript_id in ',$geneids_array_str);
			
		}else{
			$datatables->where($table_name.'.gene_id in ',$geneids_array_str);
		}
	}


	if(checkprefix($onlyconsonants,"chr")==true   || checkprefix($onlyconsonants,"scaffold_")==true  ){
		$flag=false;
	$geneids_array = explode(",", $onlyconsonants);
	$geneids_array_str=implode('","',$geneids_array);
	$datatables->where('Chromosome_Name in ',$geneids_array_str);
	}



	if(checkprefix($onlyconsonants,"description:")==true   || checkprefix($onlyconsonants,"define:")==true|| checkprefix($onlyconsonants,"desc:")==true   ){
		$flag=false;
	$vowels_tmp = array("Description:", "Define:","description:","define:","desc:","Desc:");
	$onlyconsonants_tmp = strtolower(str_replace($vowels_tmp, "", $post_input));
	$datatables->where('Description like ','%'.$onlyconsonants_tmp."%");
	}




	if($flag==true &&  checkprefix($post_input,"Shared")==false  ){
		$post_input2=trim(htmlentities($_POST['id'])); 
		$datatables->where("($table_name.description LIKE '%".$post_input2."%' ) OR (transcript_atg.atg_id LIKE '%".$post_input2."%' ) OR (gene_go.go_description LIKE '%".$post_input2."%' ) OR (gene_pfam.pfam_description LIKE '%".$post_input2."%' ) OR (gene_kegg.kegg_description LIKE '%".$post_input2."%' )"); 
		}
	

}



ini_set('memory_limit', '-1');
ini_set('max_execution_time', 300000);
if($_POST['add_genes']==true){
//echo ($datatables->generate);
global $user;
	if($user->uid!=0 ){
	//updategenebasket_testing($datatables->generate_genelist(),$_COOKIE['select_species']);
	}else{
		 if($allow_beta==true){
				updategenebasket_2x($datatables->generate_genelist(),$tintinvariable,$uuid);
		 }else{
			 //	updategenebasket_2x($datatables->generate_genelist(),$tintinvariable,$uuid);
			 	updategenebasket($datatables->generate_genelist());
			 }
	}
}

if($_POST['replace_genes']==true){
//$temparr=array($datatables->generate_genelist());
updategenebasket_2x($datatables->generate_genelist(),$tintinvariable,$uuid);
//print_r($datatables->generate_genelist());
}

if($_POST['remove_genes']==true){
//$temparr=array($datatables->generate_genelist());
removegenebasket($datatables->generate_genelist());
//print_r($datatables->generate_genelist());
}

if($_POST['add_new_genes']==true){
//echo ($datatables->generate);
updategenebasketall($datatables->generate_genelist(),$_POST['add_new_genes_name']);

}




if($_POST['share_table']==true){
//print_r($datatables->generate_genelist());
//$randid=rand(100, 100000000000);
$randid = substr(number_format(time() * rand(), 0, '', ''), 0, 10000000);
sharetable($datatables->generate_genelist(),"shared table",$randid);
echo  $randid;
}


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
/////////////////////////////////////


#####################################
//Check suffix
#####################################
function checksuffix($source, $suffix) {
    if (str_endswith($source, $suffix)) {
       return true;
    } else {
       return false;
    }
}
function str_endswith($source, $suffix) {
   return (strpos(strrev($source), strrev($suffix)) === 0);
}
/////////////////////////////////////



?>
