<?php
?>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 
  <link rel="stylesheet" type="text/css" href="plugins/help/help/css/demo.css" />
        <link rel="stylesheet" type="text/css" href="plugins/help/help/css/style.css" />
		<script type="text/javascript" src="plugins/help/help/js/modernizr.custom.29473.js"></script>
 <link href="https://fonts.googleapis.com/css?family=Bevan" rel="stylesheet" type="text/css">  
<link href="https://fonts.googleapis.com/css?family=Pontano+Sans" rel="stylesheet" type="text/css">
<br />
<?php  

include_once('/mnt/spruce/www/zmarina_ship/plugins/help/help/Parsedown.php');
$Parsedown = new Parsedown();
// Make a MySQL Connection
// FIXME: Used originally to connect to `help_db` (db not currently available?)
require_once(realpath(__DIR__.'/../settings.php'));
mysql_connect($db_settings['host'], $db_settings['user'], $db_settings['pass']) or die(mysql_error());
mysql_select_db($selected_database) or die(mysql_error());

$help_results_blast = mysql_query("select post_content from wp_posts where post_status='publish' AND post_title='BLAST';")
or die(mysql_error()); 
while ($help_rows_blast = mysql_fetch_array($help_results_blast)) {
	$blast_string= $help_rows_blast['post_content'];
}

$help_results_gbrowse = mysql_query("select post_content from wp_posts where post_status='publish' AND post_title='GBrowse';")
or die(mysql_error()); 
while ($help_rows_gbrowse = mysql_fetch_array($help_results_gbrowse)) {
	$GBrowse_string= $help_rows_gbrowse['post_content'];
}

$help_results_explot = mysql_query("select post_content from wp_posts where post_status='publish' AND post_title='exPlot';")
or die(mysql_error()); 
while ($help_rows_explot = mysql_fetch_array($help_results_explot)) {
	$explot_string= $help_rows_explot['post_content'];
}

$help_results_eximage = mysql_query("select post_content from wp_posts where post_status='publish' AND post_title='exImage';")
or die(mysql_error()); 
while ($help_rows_eximage = mysql_fetch_array($help_results_eximage)) {
	$exImage_string= $help_rows_eximage['post_content'];
}

$help_results_exnet = mysql_query("select post_content from wp_posts where post_status='publish' AND post_title='exNet';")
or die(mysql_error()); 
while ($help_rows_exnet = mysql_fetch_array($help_results_exnet)) {
	$exNet_string= $help_rows_exnet['post_content'];
}

$help_results_enrichment = mysql_query("select post_content from wp_posts where post_status='publish' AND post_title='Enrichment';")
or die(mysql_error()); 
while ($help_rows_enrichment = mysql_fetch_array($help_results_enrichment)) {
	$Enrichment_string= $help_rows_enrichment['post_content'];
}

$help_results_exnorthern = mysql_query("select post_content from wp_posts where post_status='publish' AND post_title='exNorthern';")
or die(mysql_error()); 
while ($help_rows_exnorthern = mysql_fetch_array($help_results_exnorthern)) {
	$exNorthern_string= $help_rows_exnorthern['post_content'];
}

$help_results_genelist = mysql_query("select post_content from wp_posts where post_status='publish' AND post_title='GeneList';")
or die(mysql_error()); 
while ($help_rows_genelist = mysql_fetch_array($help_results_genelist)) {
	$genelist_string= $help_rows_genelist['post_content'];
}


$help_results_chromosome_diagram = mysql_query("select post_content from wp_posts where post_status='publish' AND post_title='Chromosome Diagram';")
or die(mysql_error()); 
while ($help_rows_chromosome_diagram = mysql_fetch_array($help_results_chromosome_diagram)) {
	$chromosome_diagram_string= $help_rows_chromosome_diagram['post_content'];
}

$help_results_faq = mysql_query("select post_content from wp_posts where post_status='publish' AND post_title='FAQ AtGenIE';")
or die(mysql_error()); 
while ($help_rows_faq = mysql_fetch_array($help_results_faq)) {
	$faq_string= $help_rows_faq['post_content'];
}

?>

<section class="ac-container">


                        			<div>
					<input id="ac-7" name="accordion-1" type="checkbox" />
					<label for="ac-7">Gene Search</label>
					<article class="ac-large">
                       <p>  <?php print $Parsedown->text(utf8_encode($genelist_string)) ;?></p>
  				</article>
				</div>
            


			
           
            
            <div>
					<input id="ac-4" name="accordion-1" type="checkbox"  />
					<label for="ac-4">exImage</label>
					<article class="ac-large">
                    
                       <p>  <?php print $Parsedown->text(utf8_encode($exImage_string)) ;?>
                   </p>
  				</article>
				</div>
             
            
          
            
            
            		
            
            
            
            
            
                        	
            
            
            
         
                  
            
            
  <div>
					<input id="ac-15" name="accordion-1" type="checkbox"  />
					<label for="ac-15">FAQ</label>
					<article class="ac-large">
                       <p><?php print $Parsedown->text(utf8_encode($faq_string)) ;?>
                       </p>
  				</article>
				</div>
			</section>
            
            
            
            
           