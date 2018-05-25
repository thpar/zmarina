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

include_once(realpath(__DIR__.'/Parsedown.php'));
$Parsedown = new Parsedown();

require_once(realpath(__DIR__.'/config.php'));
$db_settings = $help_plugin_config['database'];

mysql_connect($db_settings['host'], $db_settings['user'], $db_settings['pass']) or die(mysql_error());
mysql_select_db($db_settings['db']) or die(mysql_error());


$help_results_eximage = mysql_query("select post_content from wp_posts where post_status='publish' AND post_title='exImage';")
or die(mysql_error()); 
while ($help_rows_eximage = mysql_fetch_array($help_results_eximage)) {
	$exImage_string= $help_rows_eximage['post_content'];
}


$help_results_genelist = mysql_query("select post_content from wp_posts where post_status='publish' AND post_title='GeneList';")
or die(mysql_error()); 
while ($help_rows_genelist = mysql_fetch_array($help_results_genelist)) {
	$genelist_string= $help_rows_genelist['post_content'];
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
    <input id="ac-4" name="accordion-1" type="checkbox"  />
    <label for="ac-4">exImage</label>
    <article class="ac-large">    
      <p><?php print $Parsedown->text(utf8_encode($exImage_string)) ;?></p>
    </article>
  </div>
          
  <div>
    <input id="ac-15" name="accordion-1" type="checkbox"  />
    <label for="ac-15">FAQ</label>
    <article class="ac-large">
      <p><?php print $Parsedown->text(utf8_encode($faq_string)) ;?></p>
    </article>
  </div>
  
  <div>
    <input id="ac-16" name="accordion-1" type="checkbox"  />
    <label for="ac-16">Gene information page</label>
    <article class="ac-large">
      <p><?php print $Parsedown->text(utf8_encode($gene_info_string)) ;?></p>
    </article>
  </div>
  			
</section>
            
            
            
            
           
