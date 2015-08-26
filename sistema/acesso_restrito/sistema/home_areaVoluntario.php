<?php
session_start();
	
?>

<div id="infoVoluntario">
	<div style="background-color:#CCDAB4;width:97%;height:18px;padding-top:5px;padding-left:10px;">
		<label id="title3" style="font-weight:bold;height:20px;">Dados Específicos do Cadastro:</label>
	</div> <div style="clear:both;height:10px;"></div>
	<table id="infoVoluntarioEst"></table>
</div>


<script>
    $(document).ready(function() {
        getInfoVoluntario();
    });
	
	function getInfoVoluntario(){
        var str = "opcao=getInfoVoluntario";
        
        $.ajax({
          type: "GET",
          url: 'usuario_op.php',
          data: str,
          success: function(data) {
              $("#infoVoluntarioEst").append(data);
          }
        });
    }

</script>
