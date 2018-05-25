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

include_once('Parsedown.php');
$Parsedown = new Parsedown();
// Make a MySQL Connection
$mysql_connection=mysqli_connect("spruce.plantphys.umu.se", "helpuser", "helppass","help_db") or die(mysqli_error());


$help_results_blast = mysqli_query($mysql_connection,"select post_content from wp_posts where post_status='publish' AND post_title='BLAST';")
or die(mysqli_error()); 
while ($help_rows_blast = mysqli_fetch_array($help_results_blast)) {
	$blast_string= $help_rows_blast['post_content'];
}

$help_results_gbrowse = mysqli_query($mysql_connection,"select post_content from wp_posts where post_status='publish' AND post_title='GBrowse';")
or die(mysqli_error()); 
while ($help_rows_gbrowse = mysqli_fetch_array($help_results_gbrowse)) {
	$GBrowse_string= $help_rows_gbrowse['post_content'];
}

$help_results_explot = mysqli_query($mysql_connection,"select post_content from wp_posts where post_status='publish' AND post_title='exPlot';")
or die(mysqli_error()); 
while ($help_rows_explot = mysqli_fetch_array($help_results_explot)) {
	$explot_string= $help_rows_explot['post_content'];
}

$help_results_eximage = mysqli_query($mysql_connection,"select post_content from wp_posts where post_status='publish' AND post_title='exImage';")
or die(mysqli_error()); 
while ($help_rows_eximage = mysqli_fetch_array($help_results_eximage)) {
	$exImage_string= $help_rows_eximage['post_content'];
}

$help_results_exnet = mysqli_query($mysql_connection,"select post_content from wp_posts where post_status='publish' AND post_title='exNet';")
or die(mysqli_error()); 
while ($help_rows_exnet = mysqli_fetch_array($help_results_exnet)) {
	$exNet_string= $help_rows_exnet['post_content'];
}

$help_results_enrichment = mysqli_query($mysql_connection,"select post_content from wp_posts where post_status='publish' AND post_title='Enrichment';")
or die(mysqli_error()); 
while ($help_rows_enrichment = mysqli_fetch_array($help_results_enrichment)) {
	$Enrichment_string= $help_rows_enrichment['post_content'];
}

$help_results_exnorthern = mysqli_query($mysql_connection,"select post_content from wp_posts where post_status='publish' AND post_title='exNorthern';")
or die(mysqli_error()); 
while ($help_rows_exnorthern = mysqli_fetch_array($help_results_exnorthern)) {
	$exNorthern_string= $help_rows_exnorthern['post_content'];
}

$help_results_genelist = mysqli_query($mysql_connection,"select post_content from wp_posts where post_status='publish' AND post_title='GeneList';")
or die(mysqli_error()); 
while ($help_rows_genelist = mysqli_fetch_array($help_results_genelist)) {
	$genelist_string= $help_rows_genelist['post_content'];
}


$help_results_chromosome_diagram = mysqli_query($mysql_connection,"select post_content from wp_posts where post_status='publish' AND post_title='Chromosome Diagram';")
or die(mysqli_error()); 
while ($help_rows_chromosome_diagram = mysqli_fetch_array($help_results_chromosome_diagram)) {
	$chromosome_diagram_string= $help_rows_chromosome_diagram['post_content'];
}

$help_results_faq = mysqli_query($mysql_connection,"select post_content from wp_posts where post_status='publish' AND post_title='FAQ AtGenIE';")
or die(mysqli_error()); 
while ($help_rows_faq = mysqli_fetch_array($help_results_faq)) {
	$faq_string= $help_rows_faq['post_content'];
}

$help_results_gene_info= mysqli_query($mysql_connection,"select post_content from wp_posts where post_status='publish' AND post_title='Gene information page';")
or die(mysqli_error()); 
while ($help_rows_gene_info = mysqli_fetch_array($help_results_gene_info)) {
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
            
            
            
            
           
