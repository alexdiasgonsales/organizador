<?php
session_start();
	
?>
<div id="cont">

<div id="infoOuvinte">
	<div style="background-color:#CCDAB4;width:97%;height:18px;padding-top:5px;padding-left:10px;">
		<label id="title3" style="font-weight:bold;height:20px;">Dados Específicos do Cadastro:</label>
	</div> <div style="clear:both;height:10px;"></div>
	<table id="infoOuvinteEst"></table>
</div>
</div>


<script>
    $(document).ready(function() {
        getInfoOuvinte();
    });
	
	function getInfoOuvinte(){
        var str = "opcao=getInfoOuvinte";
        
        $.ajax({
          type: "GET",
          url: 'usuario_op.php',
          data: str,
          success: function(data) {
              $("#infoOuvinteEst").append(data);
          }
        });
    }
	
</script>