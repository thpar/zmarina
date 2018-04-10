<?php
$post_id=trim($_POST['id']);
$seq_type=trim($_POST['seq_type']);
require_once(realpath(__DIR__.'/../../settings.php'));
$table_name="transcript_info";
$id_type="";
 
//MySQL connection from main settings file. database is popgeniegenepages
$private_url = parse_url($db_url['genelist']);
mysql_connect($private_url['host'], $private_url['user'], $private_url['pass']) or die(mysql_error());
mysql_select_db(str_replace('/', '', $private_url['path'])) or die(mysql_error());
$cordinatestable="sequence_color"; 

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

if($id_type=="transcript" ||  $id_type=="gene"){
	$basic_results = mysql_query("SELECT * FROM ".$table_name." WHERE transcript_id='$post_id' or gene_id='$post_id' order by transcript_id asc limit 1");
	$g = 0;
	while ($basic_results_rows = mysql_fetch_array($basic_results)) {
		$gene_id=$basic_results_rows['gene_id'];
		$transcript_id=$basic_results_rows['transcript_id'];
		$chromosome_name=$basic_results_rows['chromosome_name'];
		$strand=$basic_results_rows['strand'];
		$gene_start=$basic_results_rows['gene_start'];
		$gene_end=$basic_results_rows['gene_end'];
		$transcript_start=$basic_results_rows['transcript_start'];
		$transcript_end=$basic_results_rows['transcript_end'];
		$g++;
	}
}

if($strand=="-1"){
  	$plus_minus="2";  
   }else{
	$plus_minus="1"; 
   }

$config_path = file_get_contents("../config.json");
$json_path = json_decode($config_path, true);
$replacements=$json_path['datasets'];

for($j=0;$j<count($replacements);$j++){
		if($replacements[$j]['genome_blast_dataset_path']!=null){
		$genomic_path_variable=$replacements[$j]['genome_blast_dataset_path'];
		}
		if($replacements[$j]['cds_blast_dataset_path']!=null){
		$cds_path_variable=$replacements[$j]['cds_blast_dataset_path'];
		}
		if($replacements[$j]['transcript_blast_dataset_path']!=null){
		$transcript_path_variable=$replacements[$j]['transcript_blast_dataset_path'];
		}
		if($replacements[$j]['protein_blast_dataset_path']!=null){
		$protein_path_variable=$replacements[$j]['protein_blast_dataset_path']; 
		}
	}

//extract genomic sequence
$picea_basic_end2="10000000000";
//echo "fastacmd -d  '$genomic_path_variable' -L'".$gene_start.','.$gene_end."' -S '".$plus_minus."'  -l 1000000000000000000 -s '".$chromosome_name."' -D 0;"; 
exec("fastacmd -d  '$genomic_path_variable' -L'".$gene_start.','.$gene_end."' -S '".$plus_minus."'  -l 1000000000000000000 -s '".$chromosome_name."' -D 0;",$outputr);

for ($xd = 1; $xd <= count($outputr); $xd++) {
	$genomic_sequence.=$outputr[$xd];
}

//extract cds sequence
exec("fastacmd -l 1000000000000000000 -t T  -d '$cds_path_variable' -s '".$transcript_id."'  -D 0;",$outputcds);

for ($xcds = 1; $xcds <= count($outputcds); $xcds++) {
	$cds_sequence.=$outputcds[$xcds];
}

 //extract transcript sequence
 exec("fastacmd -l 1000000000000000000 -t T  -d '$transcript_path_variable' -s '".$transcript_id."'  -D 0;",$outputtranscript);
for ($xtranscript = 1; $xtranscript <= count($outputtranscript); $xtranscript++) {
	$sequencetranscriptstr.=$outputtranscript[$xtranscript];
}

 //extract protein sequence
exec("fastacmd -l 1000000000000000000 -t T  -d '$protein_path_variable' -s '".$transcript_id."'  -D 0;",$outputprotein);
for ($xprotein = 1; $xprotein <= count($outputprotein); $xprotein++) {
	$sequenceproteinstr.=$outputprotein[$xprotein];
}


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$datasignaltranscriptstart=$gene_start;
$datasignaltranscriptend=$gene_end;

if($strand=="-1" || $strand=="-"){$tmpstrand="-";}else{$tmpstrand="+";}

				if($tmpstrand=="-"){ 
				     $genepagecordintionquery = mysql_query("select feature,start_point,end_point from ".$cordinatestable." where id='$transcript_id' AND feature !='exon' AND feature !='mRNA'  AND feature !='intraon' order by end_point DESC") or die(mysql_error()); //Chanaka removed by 6th of March  order by start_point DESC;
				}else{
				     $genepagecordintionquery = mysql_query("select feature,start_point,end_point from ".$cordinatestable." where id='$transcript_id' AND feature !='exon' AND feature !='mRNA' AND feature !='intron'  order by start_point ASC;") or die(mysql_error());					
				}
					 
	   $geneseqflagnumber=0;
                while ($genepageseqcordinaterows = mysql_fetch_array($genepagecordintionquery)) {
                    $geneseqchildren[$geneseqflagnumber]->genepagecordregion=$genepagecordregion=$genepageseqcordinaterows['feature'];
				if($tmpstrand=="+"){	
					 $geneseqchildren[$geneseqflagnumber]->genepagecordstart=$genepagecordstart=$genepageseqcordinaterows['start_point']-$datasignaltranscriptstart;
					 $geneseqchildren[$geneseqflagnumber]->genepagecordend=$genepagecordend=$genepageseqcordinaterows['end_point']-$datasignaltranscriptstart;
				}else{
					$geneseqchildren[$geneseqflagnumber]->genepagecordstart=$genepagecordstart=$datasignaltranscriptend-$genepageseqcordinaterows['end_point'];
					 $geneseqchildren[$geneseqflagnumber]->genepagecordend=$genepagecordend=$datasignaltranscriptend-$genepageseqcordinaterows['start_point'];
				}
					$genseqarray[] = $geneseqchildren[$geneseqflagnumber];
					$geneseqflagnumber++;
                }				
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


$all_seq_results = array ('genomic_data'=>$genomic_sequence,'genomic_data_length'=>strlen($genomic_sequence),'cds_sequence'=>$cds_sequence,'cds_sequence_length'=>strlen($cds_sequence),"transcript_sequence"=>$sequencetranscriptstr,"transcript_sequence_length"=>strlen($sequencetranscriptstr),"protein_sequence"=>$sequenceproteinstr,"protein_sequence_length"=>strlen($sequenceproteinstr),"genomic_header"=>($chromosome_name.':'.$gene_start.'..'.$gene_end),"transcript_id"=>$transcript_id,"genseqarray"=>$genseqarray); 
echo json_encode($all_seq_results);
?>