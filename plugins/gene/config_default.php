<?php
/**
   Gene plugin specific configuration.
   Make a copy of this file to `config.php` before filling out the values.
*/

$gene_plugin_config = array(

    /**
       Absolute paths to BLAST DB files.
     */
    'datasets' => array(
        'genome_blast_dataset_path' => '',
        'cds_blast_dataset_path' => '',
        'transcript_blast_dataset_path' => '',
        'protein_blast_dataset_path' => ''
    ),

    /**
       Location of the blastdbcmd executable
     */
    'blastdbcmd' => ''
);

?>
