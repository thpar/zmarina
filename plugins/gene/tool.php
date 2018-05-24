<div style="margin-top:-60px;"><link rel="stylesheet" type="text/css" href="plugins/gene/css/style2.css" />
<script type="text/javascript" src="plugins/gene/js/jquery.hashchange.min.js"></script>
<script type="text/javascript" src="plugins/gene/js/jquery.easytabs.min.js"></script>
<br>
<h3><span id="title"></span></h3>
<div id="tab-container" class='tab-container'>
     <ul class='etabs'>
       <li class='tab'><a href="#basic">Basic Information</a></li>
       <li class='tab'><a href="#sequence">Sequence</a></li>
     </ul>
	<div class='panel-container'>
      <div id="basic">
      <br />
        <table width="100%" border="0">
      <tr>
        <td width="260px">Locus:</td>
        <td id="gene_id">&nbsp;</td>
      </tr>
      <tr>
        <td>Transcript name:</td>
        <td id="transcript_id">&nbsp;</td>
      </tr>
      <tr>
        <td>Protein name:</td>
        <td id="peptide_name">&nbsp;</td>
      </tr>
      <tr>
        <td>PAC Transcript ID:</td>
        <td id="pac_id">&nbsp;</td>
      </tr>
      <tr>
        <td>Start position:</td>
        <td id="start">&nbsp;</td>
      </tr>
      <tr>
        <td>Stop position:</td>
        <td id="end">&nbsp;</td>
      </tr>
      <tr>
        <td>Description:</td>
        <td id="description">&nbsp;</td>
      </tr>    
        <tr style="display: none"  id="other_tids_tr">
        <td>Other transcripts at this locus:</td>
        <td id="other_tids">&nbsp;</td>
      </tr> 
      </tr>    
        <tr style="display: none" id="atg_ids_tr">
        <td>Arabidopsis Id:</td>
        <td id="atg_id">&nbsp;</td>
      </tr> 
      </tr>    
        <tr style="display: none" id="potri_id_tr">
        <td>Poplar Id:</td>
        <td id="potri_id">&nbsp;</td>
      </tr>             
    </table>
        </div>  
        <div id="sequence">
           
<br />
<div style="float:right"><span class="key"><strong>Legend: &nbsp;&nbsp;&nbsp;&nbsp;
			 5'UTR <span class="utr5Odd">&nbsp;&nbsp;&nbsp;&nbsp;</span>&nbsp;&nbsp;&nbsp;&nbsp;
			CDS <span class="cdsOdd">&nbsp;&nbsp;&nbsp;&nbsp;</span>&nbsp;&nbsp;&nbsp;&nbsp;
			3'UTR <span class="utr3Odd">&nbsp;&nbsp;&nbsp;&nbsp;
		</span></strong></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp</div>

<br /><br />
          <br />
          <strong>Genomic Sequence </strong> (<span id="genom_strand"></span> strand)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;upstream: <input name="ustream" id="ustream" size="4"  type="text"/>&nbsp;&nbsp;&nbsp;downstream: <input  size="4" id="dstream" name="dstrem" type="text"/>&nbsp;&nbsp;<input type="button" onclick="givemethesequence();"  value="Update Sequence"/>
          
         
     <form action="blast" method="post">
   <pre id="genomicsequencediv_pre"><span id="genomic_number"></span><br></n></r><span  id="genomicsequencediv" style="white-space: pre-wrap; white-space: -moz-pre-wrap;white-space: -pre-wrap;word-wrap: break-word;word-break: break-all;white-space: pre-wrap;width: 900px; height: auto; word-wrap: break-word;"><?php echo trim($outputrs);?></span></pre>
   <input style="cursor:pointer;float: right; " type="button"  value="FASTA" onclick="downloadInnerHtml('genomic_sequence.txt', 'genomicsequencediv','text/html');" class="form-submit"><span style="width:16px;float: right; ">&nbsp;&nbsp;&nbsp;</span>
<br></br>
</form>


<strong>CDS sequence:</strong><br />
<form action="blast" method="post">
   <pre id="cdssequencediv_pre"><span id="cds_number"></span><br/><span  id="cdssequencediv" style="white-space: pre-wrap; white-space: -moz-pre-wrap;white-space: -pre-wrap;word-wrap: break-word;word-break: break-all;white-space: pre-wrap;width: 900px; height: auto; word-wrap: break-word;background-color: 
#AABADD;"></span></pre>
 <input style="cursor:pointer;float: right; " type="button"  value="FASTA" onclick="downloadInnerHtml('cds_sequence.txt', 'cdssequencediv','text/html');" class="form-submit"><span style="width:16px;float: right; ">&nbsp;&nbsp;&nbsp;</span>
 
<br></br>
</form>


<strong>Transcript sequence:</strong><br />
<form action="blast" method="post">
   <pre id="transcriptequencediv_pre"><span id="transcript_number"></span><br /><span  id="transcriptequencediv" style="white-space: pre-wrap; white-space: -moz-pre-wrap;white-space: -pre-wrap;word-wrap: break-word;word-break: break-all;white-space: pre-wrap;width: 900px; height: auto; word-wrap: break-word;""></span></pre>
    <input style="cursor:pointer;float: right; " type="button"  value="FASTA" onclick="downloadInnerHtml('transcript_sequence.txt', 'transcriptequencediv','text/html');" class="form-submit"><span style="width:16px;float: right; ">&nbsp;&nbsp;&nbsp;</span>
    
<br></br>
</form> 

  
  <strong>Protein sequence:</strong><br />
<form action="blast" method="post">
   <pre id="proteinsequencediv_pre"><span id="protein_number"></span><br /><span  id="proteinsequencediv" style="white-space: pre-wrap; white-space: -moz-pre-wrap;white-space: -pre-wrap;word-wrap: break-word;word-break: break-all;white-space: pre-wrap;width: 900px; height: auto; word-wrap: break-word;"></span></pre>
      <input style="cursor:pointer;float: right; " type="button"  value="FASTA" onclick="downloadInnerHtml('protein_sequence.txt', 'proteinsequencediv','text/html');" class="form-submit"><span style="width:16px;float: right; ">&nbsp;&nbsp;&nbsp;</span>
     
<br></br>

</form>
        </div>
        
	</div>
</div>
  <script src="plugins/gene/js/init.js" type="text/javascript"></script></div>

