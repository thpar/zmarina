<?php if($_SERVER['REMOTE_ADDR']=="85.226.s186.116"){ ?>
	<script type="text/javascript" src="plugins/sidebar/js/jquery.cycle.all.2.72.js"></script>
<script type="text/javascript" src="plugins/sidebar/js/jquery-sticklr-1.0.pack.js"></script>
<link rel="stylesheet" href="plugins/sidebar/css/font-awesome.min.css">

<link href="plugins/sidebar/css/style.css" rel="stylesheet"/>
<div  id="sticky" > <span id="nogenesspan" style="top:240px !important;align:left;position:fixed;background:#F00;color:#FFF;display:none">Click here to some genes!</span>
	<ul id="example-2" class="sticklr"
	style="top:260px !important;text-align:left;" >
		<li id="genelistli"> <a href="<?php print $GLOBALS['base_url']?>/genelist" id="genebagclick" onclick="clickgenelink();" class="icon-emails" title="Gene Selection"> GeneList <span id="numberofgenesSpan" class="notification-count" style="opacity: 1;">00</span></a>
			<ul id="numberofgenesSpanDetail" class="notifi"><!--<a href="plugins/genelist/tool.php" data-toggle="modal" data-target="#myModal" onclick="hidemef(this)" data-refresh="true"><font  style="color:#00F" >here</font></a>
			--><div id="content"><?php include( "plugins/genelist/crud/listbarang.php");?> </div>
				<div id="Formcontent"></div> <a href="<?php print $GLOBALS['base_url']?>/plugins/genelist/crud/formbarang.php?action=add" class="add">add empty genelist</a> / <a href="<?php print $GLOBALS['base_url']?>/plugins/genelist/crud/formbarang.php?action=savecurent"
				class="savecurrent">save current list</a> / <a href="<?php print $GLOBALS['base_url']?>/plugins/genelist/crud/formbarang.php?action=add" class="cancel">cancel</a>				</ul>
		</li>
		<!--<li id="samplelistli">
         <a style="cursor:pointer" onclick="open_samplelist();" class="icon-experiments" title="Sample Selection">SampleList<span id="numberofexpSpan" class="notification-count">00</span></a>
         </li>--></li>
		<li id="analysisli"> <a href="#" class="icon-tags" title="Popgenie Analysis Tools">Analysis</a>
			<ul style="left:85px;" class="toolul1">
				<li class="sticklr-title"> <a href="#">Tools with GeneList</a> </li>
				<li> <a href="<?php print $GLOBALS['base_url']?>/eximage" class="icon-eplant">&nbsp;exImage</a> </li>
				<li> <a href="<?php print $GLOBALS['base_url']?>/#" class="icon-cluster">&nbsp;exNet</a> </li>
			</ul>
			<ul class="toolul2">
				<li> <a href="<?php print $GLOBALS['base_url']?>/explot" class="icon-explot">&nbsp;exPlot</a> </li>
				<li> <a href="<?php print $GLOBALS['base_url']?>/chromosome_diagram" class="icon-barx">Chromoplot</a> </li>
				<li> <a href="<?php print $GLOBALS['base_url']?>/#" class="icon_heat">&nbsp;exHeatmap</a> </li>
			</ul>
		</li> <span onclick="closeslider();" id="showhidespans" style="top:32px !important;text-align:left;cursor:pointer;color:#000000;font-size: 14px;font-weight: bold;text-shadow: 0 2px 0 #ffffff;left:77px;position: absolute;opacity:0.6;z-index:99000000"><</span>		</ul>

</div></div>
	<script src="plugins/sidebar/js/init.js" type="text/javascript"></script>
<?php }else{ ?>
<!--#####################################################################################################################################################################################-->
	<script type="text/javascript" src="plugins/sidebar/js/jquery.cycle.all.2.72.js"></script>
	<script type="text/javascript" src="plugins/sidebar/js/jquery-sticklr-1.0.pack.js"></script>
		<link rel="stylesheet" href="plugins/sidebar/css/font-awesome.min.css">
	<link href="plugins/sidebar/css/style_2.css" rel="stylesheet"/>
	<!-- <div  id="sticky" style="display:none">
	<ul id="example-2" class="sticklr"
	style="top:260px !important;text-align:left;" style="display:none">

		<li id="analysisli" > <a href="#" class="icon-tags" title="Popgenie Analysis Tools">Analysis</a>
			<ul style="left:85px;" class="toolul1">
				<li class="sticklr-title"> <a href="#">Tools with GeneList</a> </li>
				<li> <a href="<?php print $GLOBALS['base_url']?>/eximage" class="icon-eplant">&nbsp;exImage</a> </li>
				<li> <a href="<?php print $GLOBALS['base_url']?>/#" class="icon-cluster">&nbsp;exNet</a> </li>
			</ul>
			<ul class="toolul2">
				<li> <a href="<?php print $GLOBALS['base_url']?>/explot" class="icon-explot">&nbsp;exPlot</a> </li>
				<li> <a href="<?php print $GLOBALS['base_url']?>/#" class="icon-barx">Chromosome Diagram</a> </li>
				<li> <a href="<?php print $GLOBALS['base_url']?>/#" class="icon_heat">&nbsp;exHeatmap</a> </li>
			</ul>
		</li>
	</div></div> -->
	<script src="plugins/sidebar/js/init.js" type="text/javascript"></script>
	<div id="editpanel" style="background:#fff; ;font-size:14px;overflow:hidden;z-index:9;position:fixed;display:none;width:260px;overflow:visible;color:#000;border: 2px solid #e15b63;min-height:200px; ">
		<li id="genelistli" style="list-style-type: none;">
			<ul id="numberofgenesSpanDetail" class="notifi">
				<div id="content" style="font-weight:bold">
					<?php include( "plugins/genelist/baskets/listbarang.php");?> </div>
				<div id="Formcontent"></div><span class="hint--bottom" aria-label="Add new GeneList"> <a href="<?php print $GLOBALS['base_url']?>/plugins/genelist/baskets/formbarang.php?action=add" class="add"><i class="savemenu fa-plus"></i></a></span> &nbsp;<span class="hint--bottom" aria-label="Duplicate selected GeneList"><a href="<?php print $GLOBALS['base_url']?>/plugins/genelist/baskets/formbarang.php?action=savecurent"
				class="savecurrent"><i class="savemenu fa-copy"></i></a></span>  &nbsp; <span id="cancelbtn" class="hint--right" aria-label="Cancel" style="display:none"><a href="<?php print $GLOBALS['base_url']?>/plugins/genelist/baskets/formbarang.php?action=add" class="cancel"><i class="savemenu fa-ban"></i></a></span>				</ul>
		</li>

		<div id="editpanel2" style="background:#fff ;font-size:14px;;z-index:9;position:relative;display:none;min-height:120px;overflow:hidden;min-height:200px;margin-left:-40px;">
			<ul style=" display: block;list-style-type: none;">

				<!--<li style=" width:100%">
						<a class="toollinks" style="cursor:pointer" onClick="open_genelist()" >&nbsp;GeneList</a>
				</li>-->
									<!--<li style=" width:100%">
											<a class="toollinks" href="/blast" >&nbsp;BLAST</a>
									</li>
									<li  style=" width:100%">
											<a class="toollinks" href="/jbrowse" >&nbsp;JBrowse</a>
									</li>
									<li  style=" width:100%">
											<a class="toollinks" href="/chrdiagram" >&nbsp;ChrDiagram</a>
									</li>
									<li  style=" width:100%">-->
<!--											<a class="toollinks" href="/seq_search" >&nbsp;ChrDiagram</a>
									</li>
								
-->
							</ul>
	</div>
	<div id="editpanel3" style="background:#fff ;font-size:12px;n;z-index:9;position:relative;display:none;min-height:120px;overflow:hidden;min-height:200px;margin-left:-40px;">
		<ul style=" display: block;list-style-type: none;" >
<!--
			<li>
					<a class="toollinks" href="/explot" >&nbsp;exPlot</a>
			</li>
-->
								<li>
										<a class="toollinks" href="eximage" >&nbsp;exImage</a>
								</li>
<!--
								<li>
										<a class="toollinks" href="/exheatmap" >&nbsp;exHeatmap</a>
								</li>
-->
						</ul>



	</div>
	</div>





<link href="plugins/sidebar/drag/geniemenu.css" rel="stylesheet"/>

<?php if($_SERVER['REMOTE_ADDR']=="85.226.1s86.116"){ ?>
<script src="plugins/sidebar/drag/geniemenu_copy.js" type="text/javascript"></script>
<?php }else{ ?>
<script src="plugins/sidebar/drag/geniemenu.js" type="text/javascript"></script>
<?php } ?>

<ul id="nav" style="list-style-type: none;background: #DA0D10;background-color: aqua">
										
				<li id="analysis_tools" style="background:#e15b63;;width:40px;height:40px;border-radius:40px;text-align:center;vertical-align: top;color:#FFF;cursor:pointer"><span  class="hint--right hint--success" aria-label="Expression Tools" >	<a  style="color:#000" href="javascript:void(0);"></a>
					<div class="display-box">
							<div class="hero-icon  science-shake medium"><i class="fa fa-calculator"></i>						
							</div>
					</div>	</span></li>

	<li id="genenumber" style="background:#e15b63;;width:40px;height:40px;border-radius:40px;text-align:center;vertical-align: top;color:#FFF;cursor:pointer" class="hint--right hint--success" aria-label="Click here to open GeneList"><span  class="notificationcount2"  ><a   onclick="open_samplelist();" href="plugins/genelist/tool.php" data-toggle="modal" data-target="#myModal" onclick="hidemef(this)"  data-refresh="true"><FONT color="#FFFFFF"><span  id="notificationcount_2"   style="opacity: 1;">00</span></FONT></a>
		</span></li>

</ul>

<script type="text/javascript">
	
$(document).ready(function() {
	
	var init_position="left-center";


		if (getCookie("sidebarclass") != null) {
			init_position=getCookie("sidebarclass");
			//console.log(init_position)
		}

	$("#nav").genieMenu({
			delay: 20,
			position: init_position
	});
	var notificationBubble = document.getElementById("geniemenu-controller-0");
var node = document.createElement("span");
	node.innerHTML='<a   onclick="open_samplelist();" href="plugins/genelist/tool.php" data-toggle="modal" data-target="#myModal" onclick="hidemef(this)"  data-refresh="true"><FONT color="#FFFFFF" class="hint--right hint--success" aria-label="Click here to open GeneList"><span style="position:relative"  id="numberofgenesSpan"  style="opacity: 1;">00</span></FONT></a>';
///node = document.getElementById("bbb");
	//var node = document.createElement("span");
	node.setAttribute("class", "notificationcount");
	node.setAttribute("id", "mainspan");
	notificationBubble.appendChild(node);



	//	var notificationBubble = document.getElementById("geniemenu-controller-0");
		//	var node = document.getElementById("bubble");
//	notificationBubble.appendChild(node);
/*	var notificationBubble = document.getElementById("geniemenu-controller-0");
	var node = document.createElement("span");
	node.setAttribute("class", "notificationcount");
	node.setAttribute("id", "numberofgenesSpan");
	notificationBubble.appendChild(node); //.append("<span id='numberofgenesSpan' class='notification-count' style='position:relative;'></span>")*/

	$("#geniemenu-controller-0").click(function() {
		//$.noConflict(removeAll)

		if($.fn.genieMenu.toggleMenu("#nav")!=undefined){return false}
		
			if ($(".geniemenu-controller").hasClass("open") == true) {
	adjustPadding();
					$("#editpanel").show()
					updategenebasket3();
					$("#content").load("plugins/genelist/baskets/listbarang.php");
				//	console.log($("#genenumber")[0].)
				//	console.log($("#mainspan")[0])
$("#mainspan").hide();
$("#notificationcount_2")[0].innerHTML=$("#numberofgenesSpan")[0].innerHTML;


/*$('.notificationcount').animate({position:"relative",
					 top: $('.notificationcount2:eq(0)').css('top'),
					 left: $('.notificationcount2:eq(0)').css('left')
			 }, 500);
			 $('.notificationcount2').animate({position:"relative",
			 					 top: $('.notificationcount:eq(0)').css('top'),
			 					 left: $('.notificationcount:eq(0)').css('left')
			 			 }, 500);
*///console.log($('#genenumber').css('top'),$('#genenumber').css('left'));

//$("#genenumber")[0].innerHTML=	"<span class='notificationcount2'>"+$("#mainspan")[0].innerHTML+"</span>";

					///mainspan 	$("#editpanel").show()



				//	console.log(tmp_new_x,tmp_new_y)
					setCookie("open_side_menu","open",10)
			} else {
					$("#editpanel").hide()
					$("#mainspan").delay( 200 ).show(200);
				setCookie("open_side_menu","close",10)
			}
	});
	

	//var testme=document.getElementById("geniemenu-controller-0");
	if(getCookie("open_side_menu")==undefined || getCookie("open_side_menu")=="open"){updategenebasket3();
        $.fn.genieMenu.toggleMenu("#nav");$("#editpanel").delay( 6 ).show(6);$("#mainspan").delay( 0 ).hide(0);
	}

});


	
	
$("#analysis_tools").mouseover(function(e) {
		$("#genelistli").hide()
		$("#editpanel2").hide()
		$("#editpanel3").show()

});
$("#genenumber").mouseover(function(e) {
		$("#genelistli").show()
		$("#editpanel2").hide()
		$("#editpanel3").hide()

});

$("#expression_tools").mouseover(function(e) {
		$("#genelistli").hide()
		$("#editpanel2").show()
		$("#editpanel3").hide()

});

function adjustPadding(){
	var u=document.getElementById("geniemenu-controller-0").className.split(" ")[2].split("-")[0]
	if(u=="right"){
		$("#editpanel").css({Right:"120px",Left:"10px"});
		$("#editpanel2").css({Right:"120px",Left:"10px"})
		$("#editpanel3").css({Right:"120px",Left:"10px"})
	}else{
		$("#editpanel").css({Right:"10px",Left:"120px"});
		$("#editpanel2").css({Right:"10px",Left:"120px"});
		$("#editpanel3").css({Right:"10px",Left:"120px"});
	}
}
	
	
	
	
	
	</script>
</head>
<!--<script src="https://rawgit.com/briangonzalez/jquery.pep.js/master/src/jquery.pep.js"></script>
<script>
var docHeight = $(document).height();
var windowHeight = $(window).height();
var buffer = 100;

function handleNear() {
  var near = windowHeight - this.ev.y <= buffer;

  if (near && this.velocity().y > 0 )
    window.scrollTo(0, this.ev.y + buffer);
}

$('#sticky1').pep({

  debug: false,
  drag: function(e) {
    handleNear.apply(this);
  }
});
</script>-->



<?php } ?>
