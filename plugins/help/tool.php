<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 
<link rel="stylesheet" type="text/css" href="plugins/help/help/css/demo.css" />
<link rel="stylesheet" type="text/css" href="plugins/help/help/css/style.css" />
<script type="text/javascript" src="plugins/help/help/js/modernizr.custom.29473.js"></script>
<link href="https://fonts.googleapis.com/css?family=Bevan" rel="stylesheet" type="text/css">  
<link href="https://fonts.googleapis.com/css?family=Pontano+Sans" rel="stylesheet" type="text/css">


<div class="ac-container">
<?php  
   $help_pages_location = realpath(__DIR__.'/../../genie_files/help/');
   foreach(glob($help_pages_location.'/[0-9]_*[!~]') as $section):
       $section_parts = explode('_', basename($section));
       $section_id = 'section_'.array_shift($section_parts);
       $section_title = implode(' ',$section_parts);
?>
<div>
  <input id="ac-<?php echo($section_id);?>" name="accordion-1" type="checkbox" />
  <label for="ac-<?php echo($section_id);?>"><?php echo($section_title); ?></label>
  <article class="ac-large">
      <?php include($section); ?>
  </article>
</div>
<?php
   endforeach;
?>
</div>
