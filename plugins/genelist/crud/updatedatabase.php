<?php
include("koneksi.php");
$ip = $uuid;
if (isset($_POST['genes_send']) || isset($_POST['genes_send_add'])) {
    $genessendaddString      = trim($_POST['genes_send_add']);
    $genessendaddStringArray = explode(",", $genessendaddString);
    $genessendaddStringArray = array_unique($genessendaddStringArray);
    $genessendaddString      = implode(",", $genessendaddStringArray);
    $check                   = mysql_query("select * from defaultgenebaskets where ip='$ip'");
	
	if(isset($_POST['bname'])){
	$bname=trim($_POST['bname']);
	$initcounts22 = count($genessendaddStringArray);
	$check_name = mysql_query("select * from genebaskets where ip='$ip' AND gene_basket_name='$bname'");
	if (mysql_num_rows($check_name) == 0) {
	mysql_query("insert into genebaskets(gene_basket_id,gene_basket_name,harga,genelist,ip) values('$kode','$bname','$initcounts22','$genessendaddString','$ip')") or die("data gagal di insert");
	if(mysql_num_rows($check)==0) 
		{
		mysql_query("insert into defaultgenebaskets(defaultgenebaskets.gene_basket_id,defaultgenebaskets.ip) SELECT LAST_INSERT_ID(gene_basket_id),'$ip' from genebaskets WHERE ip='$ip' ORDER BY gene_basket_id DESC Limit 1;");
		}else {
		mysql_query("update defaultgenebaskets set gene_basket_id=(SELECT LAST_INSERT_ID(gene_basket_id) from genebaskets WHERE ip='$ip' ORDER BY gene_basket_id DESC Limit 1) where ip='$ip'");
		}
	 }else{
		echo "error";
	 }
	exit();
	}
	
	
    if (mysql_num_rows($check) == 0) {
        // NO DEFAULT GENEBASKETS,INSTERED
        $initcounts = count($genessendaddStringArray);
        mysql_query("insert into genebaskets(gene_basket_id,gene_basket_name,harga,genelist,ip) values('$kode','default','$initcounts','$genessendaddString','$ip')") or die("data gagal di insert");
        mysql_query("insert into defaultgenebaskets(defaultgenebaskets.gene_basket_id,defaultgenebaskets.ip) SELECT LAST_INSERT_ID(gene_basket_id),'$ip' from genebaskets WHERE ip='$ip' ORDER BY gene_basket_id DESC Limit 1;");
        echo $genessendaddString;
    } else {
        //FOUND DEFAULT genes
        $defaultstr = "SELECT genebaskets.genelist,genebaskets.gene_basket_id FROM defaultgenebaskets LEFT JOIN genebaskets ON defaultgenebaskets.gene_basket_id=genebaskets.gene_basket_id where defaultgenebaskets.ip='$ip'";
        $defaultresults = mysql_query($defaultstr) or die("query gagal dijalankan");
        if (mysql_num_rows($defaultresults) != 0) {
            $defaultgeenedata = mysql_fetch_assoc($defaultresults);
            $dbgenesStr       = $defaultgeenedata['genelist'];
            $basketid         = $defaultgeenedata['gene_basket_id'];
            $dbgenesStrArray  = explode(",", $dbgenesStr);
            if ($dbgenesStr == "") {
                //EMPTY gene basket
                $initcount = count($genessendaddStringArray);
                mysql_query("update genebaskets set genelist='$genessendaddString',harga='$initcount' where gene_basket_id='$basketid'") or die("data gagal di update");
                echo '1' . $initcount . 't' . $genessendaddString;
            } else {
                //Gene basket with genes
                $tmpresultArr      = array_merge($dbgenesStrArray, $genessendaddStringArray);
                $updategenelistArr = array_unique($tmpresultArr);
                $updatecount       = count($updategenelistArr);
                $updategenelist    = implode(',', $updategenelistArr);
                mysql_query("update genebaskets set genelist='$updategenelist',harga='$updatecount' where gene_basket_id='$basketid'") or die("data gagal di update");
                echo '2' . $updatecount . 't' . $updategenelist;
            }
        } else {
        }
        //mysql_query("update defaultgenebaskets set gene_basket_id='$kode' where ip='$ip'") or die ("data gagal di update");
    }
} else if (isset($_POST['genes_send_remove'])) {
    $genessendremovetring    = trim($_POST['genes_send_remove']);
    $genessendremovetringArr = explode(",", $genessendremovetring);
	$updategenelistRemoveArr = array_unique($genessendremovetringArr);
	
    $defaultstrRemove        = "SELECT genebaskets.genelist,genebaskets.gene_basket_id FROM defaultgenebaskets LEFT JOIN genebaskets ON defaultgenebaskets.gene_basket_id=genebaskets.gene_basket_id where defaultgenebaskets.ip='$ip'";
    $defaultresultsRemove = mysql_query($defaultstrRemove) or die("query gagal dijalankan");
    if (mysql_num_rows($defaultresultsRemove) != 0) {
        $defaultgeeneremovedata = mysql_fetch_assoc($defaultresultsRemove);
        $dbgenesremoveStr       = $defaultgeeneremovedata['genelist'];
        $basketremoveid         = $defaultgeeneremovedata['gene_basket_id'];
        $dbgenesStrRemoveArray  = explode(",", $dbgenesremoveStr);
        if ($dbgenesremoveStr != "") {
            $tmpresultRemoveArr      = array_diff($dbgenesStrRemoveArray, $genessendremovetringArr);
            $updategenelistRemoveArr = array_unique($tmpresultRemoveArr);
            $updatecountremove       = count($updategenelistRemoveArr);
            $updategenelistremove    = implode(',', $updategenelistRemoveArr);
            mysql_query("update genebaskets set genelist='$updategenelistremove',harga='$updatecountremove' where gene_basket_id='$basketremoveid'") or die("data gagal di update");
            //echo $updategenelistremove;
        } else {
            echo "no gene ids to remove";
        }
    } else {
        echo 'no default gene basket';
    }
} else if (isset($_POST['empty_default_basket'])) {
    $cleaarthebasketStr = "SELECT genebaskets.genelist,genebaskets.gene_basket_id FROM defaultgenebaskets LEFT JOIN genebaskets ON defaultgenebaskets.gene_basket_id=genebaskets.gene_basket_id where defaultgenebaskets.ip='$ip'";
    $clearthebasketmysql = mysql_query($cleaarthebasketStr) or die("query gagal dijalankan");
    if (mysql_num_rows($clearthebasketmysql) != 0) {
        $cleardefaultbasketdata = mysql_fetch_assoc($clearthebasketmysql);
        $clearbasketid          = $cleardefaultbasketdata['gene_basket_id'];
    }
    mysql_query("update genebaskets set genelist='',harga='0' where gene_basket_id='$clearbasketid'") or die("data gagal di update");
    echo 'please clear me!';
} else if (isset($_POST['get_default_genes'])) {
    $defaultstr = "SELECT genebaskets.genelist FROM defaultgenebaskets LEFT JOIN genebaskets ON defaultgenebaskets.gene_basket_id=genebaskets.gene_basket_id where defaultgenebaskets.ip='$ip'";
    $defaultresults = mysql_query($defaultstr) or die("query gagal dijalankan");
    if (mysql_num_rows($defaultresults) != 0) {
        $defaultgeenedata = mysql_fetch_assoc($defaultresults);
        $genessendStringt = $defaultgeenedata['genelist'];
        echo $genessendStringt;
    }
} else if (isset($_POST['genes_send_add_new'])) {
    $genessendaddStringnew      = trim($_POST['genes_send_add_new']);
    $genessendaddStringArraynew = explode(",", $genessendaddStringnew);
    $genessendaddStringArraynew = array_unique($genessendaddStringArraynew);
    $genessendaddStringnew      = implode(",", $genessendaddStringArraynew);
    $initcountsnew              = count($genessendaddStringArraynew);
    $check                      = mysql_query("select * from defaultgenebaskets where ip='$ip'");
    if (mysql_num_rows($check) != 0) {
        $defaultbasketname = "SELECT genebaskets.gene_basket_name FROM defaultgenebaskets LEFT JOIN genebaskets ON defaultgenebaskets.gene_basket_id=genebaskets.gene_basket_id where defaultgenebaskets.ip='$ip'";
        $defaultbasketnamemysql = mysql_query($defaultbasketname) or die("query gagal dijalankan");
        $defaultgeeneremovedata = mysql_fetch_assoc($defaultbasketnamemysql);
        $defaultn               = $defaultgeeneremovedata['gene_basket_name'];
        $defaultn .= '1';
        mysql_query("insert into genebaskets(gene_basket_id,gene_basket_name,harga,genelist,ip) values('$kode','" . $defaultn . "','$initcountsnew','$genessendaddStringnew','$ip')") or die("data gagal di insert");
        mysql_query("update defaultgenebaskets set gene_basket_id=(SELECT LAST_INSERT_ID(gene_basket_id) from genebaskets WHERE ip='$ip' ORDER BY gene_basket_id DESC Limit 1) where ip='$ip';") or die("data gagal di update");
    } else {
        mysql_query("insert into genebaskets(gene_basket_id,gene_basket_name,harga,genelist,ip) values('$kode','new list','$initcountsnew','$genessendaddStringnew','$ip')") or die("data gagal di insert");
        mysql_query("insert into defaultgenebaskets(defaultgenebaskets.gene_basket_id,defaultgenebaskets.ip) SELECT LAST_INSERT_ID(gene_basket_id),'$ip' from genebaskets WHERE ip='$ip' ORDER BY gene_basket_id DESC Limit 1;");
    }
    //echo json_encode($initcountsnew);
} else if (isset($_POST['genes_send_add_new_cdn'])) {
    $genessendaddStringnew      = trim($_POST['genes_send_add_new_cdn']);
    $basketnamecdn              = trim($_POST['basketname']);
    $genessendaddStringArraynew = explode(",", $genessendaddStringnew);
    $genessendaddStringArraynew = array_unique($genessendaddStringArraynew);
    $genessendaddStringnew      = implode(",", $genessendaddStringArraynew);
    $initcountsnew              = count($genessendaddStringArraynew);
    $check                      = mysql_query("select * from defaultgenebaskets where ip='$ip'");
    if (mysql_num_rows($check) != 0) {
        $defaultbasketname = "SELECT genebaskets.gene_basket_name FROM defaultgenebaskets LEFT JOIN genebaskets ON defaultgenebaskets.gene_basket_id=genebaskets.gene_basket_id where defaultgenebaskets.ip='$ip'";
        $defaultbasketnamemysql = mysql_query($defaultbasketname) or die("query gagal dijalankan");
        $defaultgeeneremovedata = mysql_fetch_assoc($defaultbasketnamemysql);
        $defaultn               = $defaultgeeneremovedata['gene_basket_name'];
        $defaultn .= '1';
        mysql_query("insert into genebaskets(gene_basket_id,gene_basket_name,harga,genelist,ip) values('$kode',' $basketnamecdn','$initcountsnew','$genessendaddStringnew','$ip')") or die("data gagal di insert");
        mysql_query("update defaultgenebaskets set gene_basket_id=(SELECT LAST_INSERT_ID(gene_basket_id) from genebaskets WHERE ip='$ip' ORDER BY gene_basket_id DESC Limit 1) where ip='$ip';") or die("data gagal di update");
    } else {
        mysql_query("insert into genebaskets(gene_basket_id,gene_basket_name,harga,genelist,ip) values('$kode',' $basketnamecdn','$initcountsnew','$genessendaddStringnew','$ip')") or die("data gagal di insert");
        mysql_query("insert into defaultgenebaskets(defaultgenebaskets.gene_basket_id,defaultgenebaskets.ip) SELECT LAST_INSERT_ID(gene_basket_id),'$ip' from genebaskets WHERE ip='$ip' ORDER BY gene_basket_id DESC Limit 1;");
    }
    $variablea = array(
        'number' => $initcountsnew,
        'name' => $basketnamecdn
    );
    echo json_encode($variablea);
}
?>