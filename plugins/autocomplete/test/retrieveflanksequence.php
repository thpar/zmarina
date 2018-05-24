<?php
$ustream=trim($_GET['ustream']);
$dstream=trim($_GET['dstream']);
$picea_basic_start=trim($_GET['picea_basic_start']);
$picea_basic_end=trim($_GET['picea_basic_end']);
$picea_basic_chromosome=trim($_GET['picea_basic_chromosome']);
$plus_minus=trim($_GET['plus_minus']);

//Get the BLAST config from the gene plugin config
require_once(realpath(__DIR__.'/../../gene/config.php'));

$plus_minus = ($strand=="-1")? 'minus':'plus';
$blastdb_genome_path = $gene_plugin_config['datasets']['genome_blast_dataset_path'];
$blastdbcmd = $gene_plugin_config['blastdbcmd'];

if($plus_minus=='minus'){
	$ustream_start=$picea_basic_end+1;
	$ustream_end=$picea_basic_end+$ustream;
	
	exec("$blastdbcmd -db $blastdb_genome_path -range $ustream_start-$ustream_end -strand $plus_minus -entry $picea_basic_chromosome", $output_ustream);
	
	
	$dstream_start=$picea_basic_start-$dstream;
	$dstream_end=$picea_basic_start-1;
	
	exec("$blastdbcmd -db  $blastdb_genome_path -range $dstream_start-$dstream_end -strand $plus_minus -entry $picea_basic_chromosome", $output_dstream);	
	
	} else{
		
	if($picea_basic_start-$ustream>1){
        $ustream_start=$picea_basic_start-$ustream;
        $ustream_end=$picea_basic_start-1;	
	
        exec("$blastdbcmd -db  $blastdb_genome_path -range $ustream_start-$ustream_end -strand $plus_minus -entry $picea_basic_chromosome", $output_ustream);
	} else{
		$output_ustream[1]="";	
    }
		
	$dstream_start=$picea_basic_end+1;
	$dstream_end=$picea_basic_end+$dstream;	
		
	exec("$blastdbcmd -db  $blastdb_genome_path -range $dstream_start-$dstream_end -strand $plus_minus -entry $picea_basic_chromosome", $output_dstream);	
	
	if(strlen($output_ustream[1])>$ustream+1){
        $output_ustream[1]="";
    }
    if(strlen($output_dstream[1])>$dstream+1){
        $output_dstream[1]="";
    }	
	
}
		

		
		
if($output_ustream[1]==null){
	$output_ustream[1]="";
}
if($output_dstream[1]==null){
	$output_dstream[1]="";
}


$results = array('ustreamstr'=>$output_ustream[1],'dstreamstr'=>$output_dstream[1]);
echo json_encode($results);
?>