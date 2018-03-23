<!doctype html>
<html lang="en"> 
   <head>
      <?php
         echo "<meta charset='utf-8'>
         <title>".$c['title']." : ".($c['page'])."</title>
         <base href='$hostname'>
         <link rel='stylesheet' href='themes/".$c['themeSelect']."/css/style.css'>
         <link rel='stylesheet' href='themes/".$c['themeSelect']."/css/toastr.min.css' type='text/css' media='all'>
         
		  <link rel='stylesheet' href='themes/".$c['themeSelect']."/css/hint.min.css'>
         <script src='js/jquery.min.js'></script>
         <script type='text/javascript' src='js/jquery-ui.js'></script>
         <script src='js/print.js'></script>
     <link rel='shortcut icon' type='image/x-icon' href='/favicon.ico'/>
     
     <script src='js/toastr.min.js'></script>
         <meta name='description' content='".$c['description']."'>
         <meta name='keywords' content='".$c['keywords']."'>";
         editTags();
         ?>
      <script type="application/javascript">
         var fp4 = new Fingerprint({screen_resolution: true,ie_activex: true,canvas: true});
         setCookie('fingerprint',"JA"+fp4.get().toString(),7);
      </script>
      <script src="js/bootstrap.min.js"></script>
   </head>
   <body>

      <div id="body_main_div" style="width:100%;">
         <div class="loader-wrap">
            <div class="spinner">
               <div class="bounce1"></div>
               <div class="bounce2"></div>
               <div class="bounce3"></div>
            </div>
         </div>
         <header>
            <img id="logo_img" style="margin-left:8%;padding-top:4px;cursor:pointer;;padding-left:4px;;padding-right:4px;opacity:0.9"
            onClick="location.href='<?php echo $c['hostname']?>';" src="themes/<?php echo $c['themeSelect']?>/images/logo2.png"/>
<?php    include_once("plugins/autocomplete/autocompletesearch2.php");?> 
         </header>

         <div id="bg_content" style="width:86%;margin-left: 8%;margin-right: 6%;background-color:#FFF;background:#FFF;">

                     <nav id="mainNav">
               <select class="select-style" style="opacity: 0;" id="genie_species_select" disabled="true">
                  <?php global $db_species_color_array;global $db_species_array;foreach($db_species_array as $k => $v) { ?>
                  <option value="<?php print $k ?>"><?php print ucfirst($v) ?></option>
                  <?php } ?>
               </select>
               <?php echo '<ul class="egmenu">';genie_menu();echo '</ul>';?>
            </nav>

         <?php if(is_loggedin()) {settings();}?>
         <div class="clear"></div>
         <?php
            if( $c['initialize_tool_plugin']==1){
            echo " <div id='plugin_wrapper'  class='plborder'>";
            include_once("plugins/".$c['tool_plugin']."/tool.php");
            echo "</div>";
            }else{?>
         <div id="wrapper" class="border">
         
           <?php if($_SERVER[REQUEST_URI] =="/"){?>
<div id="alert-error" class="alert alert-info">
  <a onclick="closeme2()" class="closex" data-dismiss="alert">×</a>
  <strong>Click here to <button id="startTourBtn" class="tourbtn tourbtn-primary">Start a tour</button> of  Zostera marina basic features.</strong>
</div>       
            <link href="plugins/tour/css/poptour.css" rel="stylesheet"></link>
             <script src="plugins/tour/poptour.js"></script>
              <script src="plugins/tour/popgenie.js"></script>
              <script type="text/javascript">
				  if(getCookie("open_side_menu")==undefined ){
				   mannapperuma.startTour(tour);}
			 </script>
               <?php } ?>   

         

         <?php if($_SERVER[REQUEST_URI] =="/"){?>
         
         <!--Adobe Edge Runtime-->

<!--Adobe Edge Runtime End-->
          
             <div  class="stagewrap">
            	 <div id="Stage" class="EDGE-4069874">
				</div>
			 </div>
         <h3>Welcome to The&nbsp;<em>Zostera marina</em> v2.2 Genome<em>&nbsp;</em>Integrative Explorer</h3>  
           
        <?php } ?>   
           
                  
            
            <?php if(is_loggedin()) { ?>
            <textarea class="ckeditor" name="editor"><?php content($c['page'],$c['content']);?></textarea>
            <script type="text/javascript">
               var key = <?php echo json_encode($c['page']); ?>
            </script>
            <button id="btn_submit" onclick="save(key);">save</button>
            <?php include('msg_box.php'); ?>
            <?php }else{ ?>
            <?php content($c['page'],$c['content']);?>
            <?php } ?>
         </div>
        <!-- <div id="side" class="border">
            <?php content('subside',$c['subside']);?>
         </div>-->
         <?php }?>
         <div style="height:100%" class="clear"></div>
         <div class="push"></div>
         <!--<div class="clear"></div>
            <?php if(is_loggedin()) settings();?>-->
       <!--  <a id="myAnchor" href="plugins/genelist/tool.php" data-toggle="modal" data-target="#myModal" onclick="hidemef(this)" data-refresh="true">TEST</a>-->
         <span id="deletebasket"  style="float:right;right:0px;bottom:0px;width:0px;height:0px;position:relative"></span>
         <div id="myModal" class="modal fade">
            <div class="modal-dialog">
               <div class="modal-content">
               </div>
            </div>
         </div>
         <script type="text/javascript">
            var color_array=<?php print json_encode($db_species_color_array)?>;
         </script>
         <script type="text/javascript" src="js/onload_script.js"></script>
         <footer id="site_footer" style="width:100%" ><?php echo $c['copyright'] ." | $sig | $lstatus";?></footer>
	   </div></div></br></br>
      <?php if(is_dir('plugins/sidebar')==true){ include_once("plugins/sidebar/sidebar.php");} ?>
<a id="genelistlink" href="plugins/genelist/tool.php" data-toggle="modal" data-target="#myModal" onclick="hidemef(this)" data-refresh="true"><font  style="color:#00F;display:none" >here</font></a>
  <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-90392160-2', 'auto');
  ga('send', 'pageview');

</script>
           <?php if($_SERVER[REQUEST_URI] =="/"){?>

  
   <!-- Start of Async Drift Code -->

<?php } ?>
<!-- End of Async Drift Code -->

   </body>
</html>
