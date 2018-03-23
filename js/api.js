/**
Basic genie functions
**/

function update_genes(ids,name=false,operation="add"){
	var finalvar="operation="+operation+"&ids="+ids+"&name="+name;
	 $.ajax({
               type: "POST",
		 		url: "plugins/genelist/crud/api.php",
		  		data: (finalvar),
                success: function() {
					console.log(ids,name,operation)
					updategenebasket();
                }
            });
            return true;
        
}

