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
       The BLAST DB's are expected to contain transcript id's.
       When using gene id's, set this option to false.
     */
    'transcript_id' => true,

    /**
       Location of the blastdbcmd executable
     */
    'blastdbcmd' => 'blastdbcmd'
);

?>
