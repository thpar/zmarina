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
<link href="tools/eplant/css/pop.css" rel="stylesheet">
<script src="tools/eplant/js/popapi.js"></script>
<script src="tools/eplant/js/utilities.js"></script>
<script src="tools/eplant/js/elements.js"></script>
<script src="tools/eplant/js/calculations.js"></script>
<script src="tools/eplant/js/init.js"></script>
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
	
$(document).ready( function () {
	init();
});
	window.onload=init;
</script>
<!--</head>
<body    onload="init()"> -->
<div id="outterbox" style="height:1000px;position:relative">

<div id="download" style="visibility:hidden;right:0px;position:absolute">
<button class="btn btn-success"  value="" onClick="submit_download_form('svg');">SVG</button>
<button class="btn btn-success"  value="" onClick="submit_download_form('pdf');">PDF</button>
<button class="btn btn-success"  value="" onClick="submit_download_form('png');">PNG</button>
</div>


<div id="headerx">
<input type="checkbox" checked class="checkbox" name="menu" value="mobiledropmenu" id="mobiledropmenu">
<label for="mobiledropmenu" class="headerlabel"><img src="tools/eplant/img/dropmenu.png"></label>
	<div class="titlex">
		<div id="b1" onClick="changeview('plant');" class="buttonx_selected">P. trichocarpa Tissues(Microarray)</div>
		<div id="b2" onClick="changeview('20leaves');"  class="buttonx">Expression diversity(RNASeq)</div>
		<div id="b3" onClick="changeview('asp201');" class="buttonx">P. tremula Expression Atlas</div>
	</div>
</div>
<div id="inputtoolbox" class="inputbox" >
<input class="toolbox-input" type="text" id="input_id" onChange="setCookietxtChange()" />
<input type="button" class="btn btn-success" onClick="retrievedata()" value="GO"/><br><br>
<div>
<input type="radio" name="modergb" id="relativemode" class="radio" value="Relative" onChange="rgbchecked()" checked/>
<label for="relativemode">Relative</label></div><div>
<input type="radio" name="modergb" id="absolutemode"  onChange="rgbchecked()" value="Absolute"  class="radio" />
<label for="absolutemode">Absolute</label></div>
<br><br><br>
<p></p>
<button class="btn btn-success" id="save_as_svg" value="" onClick="submit_download_form('svg');">SVG</button>
<button class="btn btn-success" id="save_as_pdf" value="" onClick="submit_download_form('pdf');">PDF</button>
<button class="btn btn-success" id="save_as_png" value="" onClick="submit_download_form('png');">PNG</button>
</div>


<div id="header_exptable" >
<input type="checkbox"  class="checkbox_exptable" name="menu_exptable" value="mobiledropmenu_exptable" id="mobiledropmenu_exptable">
<label for="mobiledropmenu_exptable" class="headerlabel_exptable">Expression Values</label>
	<div class="title_exptable">
	<div id="table_container"></div>
    <button class="btn btn-success" style="width:100%" id="save_as_png"  onClick="readTable('hor-minimalist-a');">CSV</button>	
	</div>
</div>



<div    align="center"  id="viz"></div>




<div id="newtable_2" style="position:absolute;top:220px;right:6px; height:680px;;"> 
<div onClick="return toggleMe()"  id="newtable_2title">
- Selected Genes
</div><div style="overflow: auto;height:640px;width:180px;">
<?php
include("crud/getgenelist.php");
//<thead><tr><th scope="col">Gene List</th></tr></thead>
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
echo '<table id="hor-minimalist-c">';
for( $i=0;$i<count($efppieces);$i++){
	$newefppieces='"test"';
echo ('<tr><td><a  id="'.$efppieces[$i].'" onClick="selectidfromlist(this.id);">'.$efppieces[$i].'</a></td></tr>');
	}
}else{
echo '<br>Selection gene list is empty.<br>You can select few genes<br> from <a target="_parent" href="http://popgenie.org/flashbulktools">here</a>.';	
}
echo '</table>';

?>
</div></div>

<div id="newtable_3"    style="position:absolute;top:220px;right:6px; height:680px;height:34px;display:none"> 

<div onClick="return toggleMe()" id="newtable_2title">
+ Selected Genes <font color="#CCFF66"> <?php echo ' '.count($efppieces);?></font> 
</div></div>

<div id="externallink" style="position:absolute;bottom:4px;right:4px;font-size:24px;">

</div>


<form id="svgform" method="post" action="http://spruce.plantphys.umu.se/cDNAeFP/download.pl">
<input type="hidden" id="output_format" name="output_format" value="">
<input type="hidden" id="data" name="data" value="">
</form>

<div id="externallink2" style="float:left;padding-bottom:16px;left:0px;font-size:18px;position:relative;">

</div>


<div  style="top:16px;left:200px;position:absolute;font-family:Myriad-Roman;font-size:20px;color:#666" id="sourcetxt"></div>
</div>
<!-- <div id="svgContainer"></div>
 </body>-->
