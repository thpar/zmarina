<?php
include_once("getgenelist.php");
$geneString=trim($_POST['ids']);
$listname=trim($_POST['name']);
$operation=trim($_POST['operation']);
$genearray = explode(",", $geneString);

//Add
if($operation=="add"){
	updategenebasket_new($genearray,$listname);
}

//Replace
if( $operation=="replace"){
	if($listname!="false"){
		updategenebasketall($genearray,$listname);

	}else{
		updategenebasketall($genearray);
	}
}

//Remove
if($operation=="remove"){
	removegenebasket($genearray);
}


?>