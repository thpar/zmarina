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

include_once(realpath(__DIR__.'/help/Parsedown.php'));
$Parsedown = new Parsedown();

require_once(realpath(__DIR__.'/config.php'));
$db_settings = $help_plugin_config['database'];

mysql_connect($db_settings['host'], $db_settings['user'], $db_settings['pass']) or die(mysql_error());
mysql_select_db($db_settings['db']) or die(mysql_error());


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

$help_results_gene_info= mysql_query("select post_content from wp_posts where post_status='publish' AND post_title='Gene information page';")
or die(mysql_error()); 
while ($help_rows_gene_info = mysql_fetch_array($help_results_gene_info)) {
	$gene_info_string= $help_rows_gene_info['post_content'];
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
					<input id="ac-1" name="accordion-1" type="checkbox"  />
					<label for="ac-1">BLAST</label>
					<article class="ac-large">
                   
						 <?php echo $Parsedown->text($blast_string) ;?>
 
<br>


</p>
			</div>
                	</article>
				<div>
					<input id="ac-2" name="accordion-1" type="checkbox" />
					<label for="ac-2">JBrowse</label>
					<article class="ac-medium">
                    
                    <p>
					 <?php echo $Parsedown->text($GBrowse_string) ;?>
</p><br />
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
					<input id="ac-5" name="accordion-1" type="checkbox"  />
					<label for="ac-5">exPlot</label>
					<article class="ac-large">
                    
                       <p>  <?php print $Parsedown->text(utf8_encode($explot_string)) ;?>
                      
                      </p>
  				</article>
				</div>
            
            
            		
            
            
            
            
                        			<div>
					<input id="ac-8" name="accordion-1" type="checkbox"  />
					<label for="ac-8">Chromosome Diagram</label>
					<article class="ac-large">
                       <p> <?php print $Parsedown->text(utf8_encode($chromosome_diagram_string)) ;?></p>
  				</article>
				</div>
            
            
            
                        	
            
            
            
           <div>
					<input id="ac-10" name="accordion-1" type="checkbox"  />
					<label for="ac-10">exHeatmap</label>
					<article class="ac-large">
                       <p><strong>eXHeatmap</strong><br />This tool is generates a heatmap plot, useful for clustering and for analyzing the expression of genes relative to each other. The network analysis tool (Popnet) is a useful alternative to clustering, while the expression plotting tool (exPlot) can be a useful alternative for plotting expression profiles. This tool uses the current gene list and sample list available in the Master Menu, so if those lists are empty, users must first fill them up from a set of dedicated tools.<br /><br />
                       <strong>Clustering with the heatmap</strong><br />The genes are clustered based on the choice of a distance function and the result of the clustering is shown by means of a dendogram, that can be places on either of x and y axes. The color scale indicates how far the actual expression values are from the local consensus. Distance functions are quantifying how similar is the expression of two genes/samples. For more accurate estimators of gene expression similarity use the PopNet tool. Based on the all-pair distance estimations the genes are clustered together using a chosen variety of the hierarchical clustering algorithm. The sample information is selectable from the command panel. By clicking on the heatmap itself you will open a publishing-ready pdf, or you can export the heatmap data from the command panel and import it into your favorite plotting program.<br />
                       <img src="tools/help/exheatmap_detail.png"/>
                       </p>
  				</article>
				</div>
                
                  
            
            
              <div>
					<input id="ac-11" name="accordion-1" type="checkbox"  />
					<label for="ac-11">exNet</label>
					<article class="ac-large">
                       <p><?php print $Parsedown->text(utf8_encode($exNet_string)) ;?>
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
				
				
			  <div>
					<input id="ac-16" name="accordion-1" type="checkbox"  />
					<label for="ac-16">Gene information page</label>
					<article class="ac-large">
                       <p><?php print $Parsedown->text(utf8_encode($gene_info_string)) ;?>
                       </p>
  				</article>
				</div>
					
				
			</section>
            
            
            
            
           
