<div  type="button" class="close" data-dismiss="modal" aria-hidden="true"><a href="#"></a></div>
<style type="text/css">
	@import "plugins/genelist/genelist/css/demo_table.css";
	@import "plugins/genelist/genelist/css/TableTools.css"; 
</style>
<script type="text/javascript">
	
   var species_selection = "<?php echo $_COOKIE['select_species']; ?>";
</script>
 <script src="plugins/genelist/genelist/js/jquery/jquery-1.8.3.js"></script>
 <script src="plugins/genelist/genelist/js/jquery/jquery-ui.js"></script>
<script src="plugins/genelist/genelist/js/jquery.dataTables.js"></script>
<script src="plugins/genelist/genelist/js/FixedColumns.js"></script>
<script src='plugins/genelist/genelist/js/ColVis.js'></script>
<script src='plugins/genelist/genelist/js/ZeroClipboard.js'></script>
<script src="plugins/genelist/genelist/js/TableTools.min.js"></script>

<script type="text/javascript" src="plugins/genelist/genelist/js/css/wHumanMsg.js"></script>
<link href="plugins/genelist/genelist/js/css/wHumanMsg.css" media="screen" type="text/css" rel="stylesheet">
<script src='plugins/genelist/genelist/js/maininit.js'></script>
<link rel="stylesheet" href="plugins/genelist/genelist/css/style.css" type="text/css" media="all">
<div id="popmeup" style="width:100%;padding:5px;">
<?php if($table_exsist==false){?>
<?php echo $_GET['_term'];?>
<font color="#FF0000"><a id="loadexamplebtn"  title="Click here to load example gene list." style="cursor:pointer;text-decoration:none;z-index:10000">Load Example</a></font>
<textarea  multiple="multiple"  placeholder="Type in here to search all database fields " id="myInputTextField" value="" style="width:100%;;max-height:500px;min-height:40px;"  ></textarea>
<?php } ?>
</div>
<script>
$(window).load(function() {
  });
</script>
  <div   style="height:88%;" id="dt_example">
    <div style="height:88%;" id="container">
          <table  id='tblPrueba2' name='tblPrueba2' class='dataTable' >
		<thead >
          <tr style="text-align:left" class='headerFiltro'>
          <th class=''>
            </th>
             <th class=''>
         </th>

             <th  class=''>
              <input type='hidden' id='_search_gene_initVal' value='Filter Gene' />
              <input type='hidden' id='_search_gene_index' value='2' />
           <input type='text' id='search_gene' value='Filter Gene' class='search_init text_filter'  style="width: 100px;"/>
            </th>
                   <th width="50px;" class=''>
              <input type='hidden' id='_search_transcript_initVal' value='Filter Transcript' />
              <input type='hidden' id='_search_transcript_index' value='3' />
			 <input type='text' id='search_transcript' value='Filter Transcript' class='search_init text_filter'   style="width: 100px;" />
            </th>
             <th width="50px;" class=''>
              <input type='hidden' id='_search_chromosome_initVal' value='Filter Chromosome' />
              <input type='hidden' id='_search_chromosome_index' value='4' />
			 <input type='text' id='search_chromosome' value='Filter Chromosome' class='search_init text_filter' />
            </th>

         <th class=''>
              <input type='hidden' id='_search_description_initVal' value='Filter Description' />
              <input type='hidden' id='_search_description_index' value='5' />
              <input type='text' id='search_description' value='Filter Description' class='search_init text_filter' />
            </th>

              <th class=''>
              <input type='hidden' id='_search_ATGSynonyms_initVal' value='Filter ATG Synonyms' />
              <input type='hidden' id='_search_ATGSynonyms_index' value='7' />
              <input type='text' id='search_ATGSynonyms' value='Filter ATG Synonyms' class='search_init text_filter' />
            </th>
            <th class=''>
              <input type='hidden' id='_search_KEGG_initVal' value='Filter KEGG' />
              <input type='hidden' id='_search_KEGG_index' value='7' />
              <input type='text' id='search_KEGG' value='Filter KEGG' class='search_init text_filter' />
            </th>
                           <th class=''>
              <input type='hidden' id='_search_ATG_initVal' value='Filter ATG' />
              <input type='hidden' id='_search_ATG_index' value='7' />
              <input type='text' id='search_ATG' value='FilterATG' class='search_init text_filter' />
            </th>
                       
                        <th class=''>
              <input type='hidden' id='_search_GO_initVal' value='Filter GO' />
              <input type='hidden' id='_search_GO_index' value='7' />
              <input type='text' id='search_GO' value='Filter GO' class='search_init text_filter' />
            </th>
                    
                        <th class=''>
              <input type='hidden' id='_search_PFAM_initVal' value='Filter KEGG' />
              <input type='hidden' id='_search_PFAM_index' value='7' />
              <input type='text' id='search_PFAM' value='Filter PFAM' class='search_init text_filter' />
            </th>
          </tr>
          <tr style="text-align:left" >
          <th width="1px;"></th>
           <th width="1px"></th>
         <th width="50px;">Gene</th>
            <th width="50px;">Transcript</th>
            <th width="20px">Chromosome</th>
            <th width="10px">Description</th>
            <th width="80%">ATG Best BLAST</th>
            <th width="80%">KEGG</th>
            <th width="80%">ATG-Description</th>
            <th width="120px">GO</th>
            <th width="120px">PFAM</th>
          </tr>
        </thead>
        <tbody>
        </tbody>
        <tfoot>
        </tfoot>
      </table>
    </div>
    </div>
<div id="loader" class="loader_color small"></div>
