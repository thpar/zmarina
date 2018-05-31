<?php
/**
 * @author     Chanaka Mannapperuma <irusri@gmail.com>
 * @date	   2013-08-20
 * @version    Beta 1.0
 * @usage      Expression viewer
 * @licence    GNU GENERAL PUBLIC LICENSE
 * @link       http://irusri.com
 */
header('Cache-Control: no-cache');
header('Pragma: no-cache');
/**unit test following ids**/
$id = trim($_GET['id']);
$view=trim($_GET['view']);
$mode=trim($_GET['mode']);

$get_exptable=trim($_GET['exptable']);
$get_modecontrols=trim($_GET['modecontrols']);
$get_viewcontrols=trim($_GET['viewcontrols']);
$get_genelist=trim($_GET['genelist']);
$get_allcontrols=trim($_GET['allcontrols']);
$get_download=trim($_GET['download']);
$get_zoom=trim($_GET['zoom']);
$get_exlink=trim($_GET['exlink']);
$get_from=trim($_GET['from']);

?>
<link href="plugins/tour/css/poptour.css" rel="stylesheet"></link>

<link href="plugins/eximage/css/pop.css" rel="stylesheet">
<script src="plugins/eximage/js/popapi.js"></script>
<script src="plugins/eximage/js/utilities.js"></script>
<script src="plugins/eximage/js/elements.js"></script>
<script src="plugins/eximage/js/calculations.js"></script>
<script src="plugins/eximage/js/init.js"></script>
<script>
//Variables from remote $_GET
	var get_id = <?php echo json_encode($id);?>;
	var get_mode = <?php echo json_encode($mode); ?>;
	var get_view = <?php echo json_encode($view); ?>;

	var get_exptable = <?php echo json_encode($get_exptable); ?>;
	var get_modecontrols = <?php echo json_encode($get_modecontrols); ?>;
	var get_viewcontrols = <?php echo json_encode($get_viewcontrols); ?>;
	var get_genelist = <?php echo json_encode($get_genelist); ?>;
	var get_allcontrols = <?php echo json_encode($get_allcontrols); ?>;
	var get_download= <?php echo json_encode($get_download); ?>;
	var get_zoom= <?php echo json_encode($get_zoom); ?>;
	var get_exlink= <?php echo json_encode($get_exlink); ?>;
	var get_from = <?php echo json_encode($get_from); ?>;


	//window.onload=init;

// $(window).load(function(){$.drawchart();});


</script>

<!--</head>
<body    onload="init()"> -->
<div id="outterbox" style="position:relative">

    <div id="download" style="visibility:hidden;right:0px;position:absolute">
    <button class="btn btn-success"  value="" onClick="submit_download_form('svg');">SVG</button>
    <button class="btn btn-success"  value="" onClick="submit_download_form('pdf');">PDF</button>
    <button class="btn btn-success"  value="" onClick="submit_download_form('png');">PNG</button>
    </div>

    <br><br><br>
    <p></p>
 
<div id="header_exptable" >
<input type="checkbox"  class="checkbox_exptable" name="menu_exptable" value="mobiledropmenu_exptable" id="mobiledropmenu_exptable">
<label for="mobiledropmenu_exptable" class="headerlabel_exptable">Expression Values</label>
	<div class="title_exptable">
	<div id="table_container"></div>
    <button class="btn btn-success" style="width:100%" id="save_as_png"  onClick="readTable('hor-minimalist-a');">CSV</button>
	</div>
</div>

<button class="menu-button" id="open-button">Open Menu</button>

<div   style="background:#FFF"  align="center"  id="viz"></div>

<div id="sample_holder" style="width:200px;height:100%;left:0px;border:rgb(199, 198, 198) 1px solid;top:0px;position:absolute;z-index:9999;background:#f8f8f8;display:none" class="connectedSortable">
<button class="close-button" id="close-button">Close Menu</button>
<ul class="sample_holder_list" id="sample_holder_list" style="padding-top:40px;list-style-type: none;">

</ul>
</div>




<form id="svgform" method="post" action="plugins/eximage/download.php">
<input type="hidden" id="output_format" name="output_format" value="">
<input type="hidden" id="data" name="data" value="">
</form>

<div id="externallink2" style="float:left;bottom:46px;left:0px;font-size:16px;position:relative;">

</div>

 <style type="text/css" media="screen">

    .slide-out-div {
        border-left: #9ac352 2px solid;
		width: 240px;
		padding-left: 20px;
		padding-right: 20px;
		background: url(plugins/eximage/images/sidebar_background.png) no-repeat scroll 100% 100%;
		line-height: 1; position: absolute; height: 100%;  right: -3px;
    }

	.handle{
	background-image: url(plugins/eximage/images/right_sidebar3.png);
	width: 28px;
	height: 134px;
	display: block;
	text-indent: -99999px;
	outline: none;
	position: absolute;
	top: 30px;
	left: -32px;
	background-position: initial initial;
	background-repeat: no-repeat no-repeat;
	}

	</style>

    <script src="plugins/eximage/js/jquery.tabSlideOut.v1.3.js"></script>
         <script>
         $(function () {
             $('.slide-out-div').tabSlideOut({
                 tabHandle: '.handle', //class of the element that will be your tab
                 //   pathToTabImage: 'images/contact_tab.gif',          //path to the image for the tab (optionaly can be set using css)
                 imageHeight: '186px', //height of tab image
                 imageWidth: '40px', //width of tab image
                 tabLocation: 'right', //side of screen where tab lives, top, right, bottom, or left
                 speed: 300, //speed of animation
                 action: 'click', //options: 'click' or 'hover', action to trigger animation
                 topPos: '0px', //position from the top
                 fixedPosition: true //options: true makes it stick(fixed position) on scroll
             });
         });
         if (getCookie("select_species") != undefined) {
             var current_species_cook = getCookie("select_species");
         }

         $('#poplar_species_select').on('change', function () {
             if (this.value != current_species_cook) {
                 // location.reload();
             }
         });

         $('.ui.buttons .button').on('click', function (e) {
             if (e.target.id == "no_replicates") {
                 $('#no_replicates').addClass('positive');
                 $('#replicates').removeClass('positive');
                 replicate_flag = "false";
             }
             if (e.target.id == "replicates") {
                 $('#replicates').addClass('positive')
                 $('#no_replicates').removeClass('positive')
                 replicate_flag = "true";
             }
             setCookie("replicate_flag", replicate_flag, 10);
             init();
         });

         $(document).ready(function () {
             var cookie_replicate_flag = getCookie("replicate_flag");
             if (cookie_replicate_flag == "true") {
                 $('#replicates').addClass('positive')
                 $('#no_replicates').removeClass('positive')
             } else {
                 $('#no_replicates').addClass('positive');
                 $('#replicates').removeClass('positive');

             }
             replicate_flag = cookie_replicate_flag;
             init();
         }); 
         </script>
          <div id="sideb" class="slide-out-div">
        <a class="handle" href="#" >Content</a><br />
   <button id="startTourBtn" style=" width:100%;background-color:#F90;border-color:#F90;color:#000"  class="btn btn-large btn-primary">Take a Tour</button><br><br>


   <div id="datasourcediv">
     <div>
       <input onChange="changeview('experiment_1');" type="radio"  id="experiment_1" name="datasource" class="radio" checked="checked" />
       <label style="font-style:italic;" for="experiment_1">Transcriptome tissues</label>
     </div>
     <div>
       <input onChange="changeview('experiment_2');" type="radio"  id="experiment_2" name="datasource" class="radio" />
       <label style="font-style:italic;" for="experiment_2">Transcriptome locations/stress</label>
     </div>
   </div>

</br></br>

  <input style="width:160px;font-size:16px;" type="text" id="input_id" onChange="setCookietxtChange()"  >
    <input type="submit" name="searchbtn"  id="searchbtn" onClick="retrievedata()" ></input><br><br>

    <div id="modechk">  <input type="radio" name="modergb" id="relativemode" class="radio" value="Relative" onChange="rgbchecked()" checked/>
    <label for="relativemode">Relative</label></div><div>
    <input type="radio" name="modergb" id="absolutemode"  onChange="rgbchecked()" value="Absolute"  class="radio" />
    <label for="absolutemode">Absolute</label></div><br><br></br>
    <button class="btn btn-success" id="save_as_svg" value="" onClick="submit_download_form('svg');">SVG</button>
    <button class="btn btn-success" id="save_as_pdf" value="" onClick="submit_download_form('pdf');">PDF</button>
    <button class="btn btn-success" id="save_as_png" value="" onClick="submit_download_form('png');">PNG</button>
 <div id="newtable_2" style="position: absolute;top:280px;bottom: 0px;right:26px;width:220px;" >
	<div onClick="return toggleMe()"  id="newtable_2title">
	- Selected Genes
	</div>
    <div style="overflow-y: scroll;position: absolute;top:40px;bottom: 4px;width:220px;"><!--max-height:420px;min-height:200px;bottom:10px;-->

	<?php
    include("plugins/genelist/crud/getgenelist.php");
    if(getdefaultgenelist()!=null){
        $efpstring =  implode(',',getdefaultgenelist());

    }else{
        $efpstring ="";
        }


    if($efpstring!=""){
    $efppattern = '/\s+/';
    $efpreplacement = ',';
    $efpstring= preg_replace($efppattern, $efpreplacement, $efpstring);
    $efppieces = explode(",",$efpstring);



    sort($efppieces);
    echo '<table style="bottom:20px;" id="hor-minimalist-c">';
    for( $i=0;$i<count($efppieces);$i++){
        $newefppieces='"test"';
    echo ('<tr><td><a  id="'.$efppieces[$i].'" onClick="selectidfromlist(this.id);">   ('.($i+1).') '.$efppieces[$i].'</a></td></tr>');
        }
    }else{
    echo '<br>Selection gene list is empty.<br>You can select few genes<br> from <a target="_parent"  onclick="open_samplelist();" href="plugins/genelist/tool.php" data-toggle="modal" data-target="#myModal" data-refresh="true" >here</a>.';
    }
				
    echo '</table>';

    ?>
    <script>
    var first_gene = <?php echo json_encode($efppieces[0]); ?>;
	</script><br />
    </div>
</div>

<div id="newtable_3"     style="position: absolute;top:280px; height:60px;display:none;width:220px;">

    <div onClick="return toggleMe()" id="newtable_2title">
    + Selected Genes <strong><?php echo ' '.count($efppieces);?></strong>
    </div>
</div>
    </div>
<script src="<?php print $GLOBALS['base_url']?>/plugins/tour/poptour.js"></script>
<script src="<?php print $GLOBALS['base_url']?>/plugins/tour/eplant.js"></script>
<script src="<?php print $GLOBALS['base_url']?>/plugins/tour/workflow.js"></script>
 </div>

<!-- Loaded in init.js to display paper reference and image credits -->
<script id="zostera-credits" type="text/template">
  <style>
    #externallink2{
       border: 1px solid gray;
       padding: 0.5em;
    }
    #externallink2 div{
        margin-top: 1em;
    }
    #externallink2 .authors{
        font-size: small;
    }
  </style>
  <div>
        exImage for high throughput sequencing <a href="https://www.ncbi.nlm.nih.gov/geo/query/acc.cgi?acc=GSE67579" target="_blank" ><i>Zostera marina</i></a>
  </div>
  <div>
    <a target='_blank' href='https://doi.org/10.1038/nature16548'>
      The genome of the seagrass Zostera marina reveals angiosperm adaptation to the sea.
    </a>
    <br>
    <span class='authors'>
      Olsen JL, Rouz&eacute; P, Verhelst B, Lin YC et al. The genome of the seagrass Zostera marina reveals angiosperm adaptation to the sea. Nature 2016 Feb 18;530(7590):331-5
    </span>
  </div>
  <div>
    Flower and spath drawings adapted from:<br>
    <a href='https://doi.org/10.1016/0304-3770(80)90023-6' target='_blank'>
      Flowering, pollination and fruiting in Zostera marina L.
    </a>
  </div>
  <div>
    Zostera plant figure on the left adapted from original artwork by <em>Ivan D. Gromicho</em>
  </div>
</script>
