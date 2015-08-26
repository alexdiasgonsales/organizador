<?php
	session_start();
	
?>
<div id="cont">
<div id="infoAvaliador">
	<div style="background-color:#CCDAB4;width:97%;height:18px;padding-top:5px;padding-left:10px;">
		<label id="title3" style="font-weight:bold;height:20px;">Dados Específicos do Cadastro:</label>
	</div> <div style="clear:both;height:10px;"></div>
	<table id="infoAvaliadorEst"></table>
</div>

<div id="areasAvaliador" style="margin-top:15px;">
	<div style="background-color:#CCDAB4;width:97%;height:18px;padding-top:5px;padding-left:10px;">
	<label id="title3" style="font-weight:bold;height:20px;">Áreas Temáticas:</label>
</div>
<div style="clear:both;height:10px;"></div>
<div id="appendAreasAvaliador">
	<form id="areasCheck" name="areasCheck"> </form>
</div>
<div id="confirma_sessoes">
	
</div>
</div>

<script>
    $(document).ready(function() {
        getInfoAvaliador();
	getAreasAvaliador();
	get_sessoes_pendentes();
        
    
	});
	
	function getInfoAvaliador(){
        var str = "opcao=getInfoAvaliador";
        
        $.ajax({
          type: "GET",
          url: 'usuario_op.php',
          data: str,
          success: function(data) {
              $("#infoAvaliadorEst").append(data);
          }
        });
	}
		
	function getAreasAvaliador() {
		var str = "opcao=getAreasAvaliador";
		
		$.ajax({
			type:"GET",
			url:'usuario_op.php',
			data: str,
			success: function(data) {
                            
				$("#areasCheck").append(data);
			}
		});
	}
	
	function get_sessoes_pendentes() {
		var str = "opcao=get_sessoes_pendentes";
		
		$.ajax({
          type: "POST",
          url: 'usuario_op.php',
          data: str,
          success: function(data) {
              $("#confirma_sessoes").append(data);
          }
        });
	}
	
	/*$("#botao_nao").click(function() {
		alert('chega aqui');
		if(confirm('Você tem certeza de que deseja remover esta sessão?')) {
			id = $("#botao_nao").val();
			var str = "opcao=cancelar_participacao&id_sessao="+id;
			
			$.ajax({
			type: "GET",
			url: 'usuario_op.php',
			data: str,
			success: function(data) {
				location.reload();
          }
        });
		}
	});*/
	
	function recusa(id) {
		if(confirm('Você tem certeza de que deseja recusar esta sessão?')) {
			var str = "opcao=cancelar_participacao&id_sessao="+id;
			
			$.ajax({
                            type: "GET",
                            url: 'usuario_op.php',
                            data: str,
                            success: function(data) {
                                    location.reload();
                            }
                        });
		}
	}
	
	function confirma(id) {
      if(confirm('Você tem certeza de que deseja confirmar esta sessão?')) {
			var str = "opcao=confirmar_participacao&id_sessao="+id;
			
			$.ajax({
			type: "GET",
			url: 'usuario_op.php',
			data: str,
			success: function(data) {
				location.reload();
          }
        });
      }
	}
	
	function habilitar_campos() {
		$("input").each(function(i){
			$(this).removeAttr("disabled");
			$("#saveButton").show();
		});
	}
	
	function atualizaAreas() {
		var form = $("#areasCheck").serialize();
		var str = new Array();
		str.push("opcao=atualizaAreasAvaliador");
		str.push(form);
		
		$.ajax({
			type: "POST",
			url: 'usuario_op.php',
			data: str.join("&"),
			success: function(data) {
                            
                                if (data == "-2"){
                                    alert("Você pode se inscrever no máximo em 1 (uma) área");
                                }else{
                                    alert('Alterações realizadas com sucesso!');
                                }
				location.reload();
				
			}
		});
	}

</script>