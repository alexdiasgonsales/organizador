<?php
session_start();
	
?>
<div id="cont">

<div id="infoOrientador">
	<div style="background-color:#CCDAB4;width:97%;height:18px;padding-top:5px;padding-left:10px;">
	<label id="title3" style="font-weight:bold;height:20px;">Dados Específicos do Cadastro:</label>
	</div> 
	
	<div id="dadoTipoServ" style="margin-left:10px;margin-top:10px;height:30px;"></div>
	
	<table id="infoOrientadorEst" style="margin-top:5px;">
		<tr style="background-color:#CCDAB4;height:18px;padding-left:10px;width:97%;">
		<td width="270px;" style="padding-left:10px;">Campus</td>
		<td width="330px;" style="padding-left:10px;">Instituição</td></tr>
	</table>
	
	<div style="clear:both;height:10px;"></div>
	<div id="msg_erroOrien1" style="color:#ff0000;height:20px;display:none;"><br> Você deve possuir, no mínimo, uma instituição cadastrada. </div>
	<div id="msg_erroOrien2" style="color:#ff0000;height:20px;display:none;"><br> Esta é uma instituição vinculada a um trabalho enviado. <br> Por favor, solicite a atualização do trabalho antes de remover a instituição.</div>
	<div style="clear:both;height:10px;"></div>
</div>

<div id="trabShowOrien" style="margin-top:15px;">
	<hr style="width=80%;"> <br>
	<div style="background-color:#CCDAB4;width:97%;height:18px;padding-top:5px;padding-left:10px;">
	<label id="title3" style="font-weight:bold;height:20px;">Trabalhos:</label>
	</div> <div style="clear:both;height:10px;"></div>
	<div id="appendTrabOrien"></div>
</div>

<div id="divSombraOrien" style="width:100%; height:200%; position:absolute; top:0px; left:0px; z-index: 50; background: black; opacity: 0.7; display:none;"></div>
<div id="popUpTrabOrien" style="top:60px; left:22%; width:800px; height:500px; position:absolute; border:1px solid #CCCCCC; z-index: 60; background: white; border-radius: 10px;display:none;padding:5px;overflow:auto;"></div>

<div id="inserirCampus" style="display:none;">
	<h4>Área orientadores</h4>
	<label id="title4" style="font-weight:bold;height:20px;">Inserir Nova Instituição:</label>
	<div style="clear:both;height:10px;"></div>
	<div id="appendCadOr"></div>
</div>
</div>
<script>
   $(document).ready(function() {
		getTipoOrientador();
		getCampusOrientador();
		getListaTrabOrien();
    });
	
/*Funcoes relacionadas ao USUARIO*/	

	function getTipoOrientador(){
        var str = new Array();
        str.push("opcao=getInfoOrientador");
		str.push("dado=tipo");
		
        $.ajax({
          type: "GET",
          url: 'usuario_op.php', /*arquivo que recupera INFO do USUARIO*/
          data: str.join("&"),
          success: function(data) {
			 $("#dadoTipoServ").html(data); 
          }
        });
    }
	
	function getCampusOrientador(){
        var str = new Array();
        str.push("opcao=getInfoOrientador");
		str.push("dado=campus");
		
        $.ajax({
          type: "GET",
          url: 'usuario_op.php', /*arquivo que recupera INFO do USUARIO*/
          data: str.join("&"),
          success: function(data) {
			 $("#infoOrientadorEst").append(data); 
          }
        });
    }
	
	function insereCampus() {
		$("#title3").hide();
		$("#title4").show();
		$("#botOcult3").hide();
		$("#infoOrientador").hide();
		$("#trabShowOrien").hide();
		$("#inserirCampus").show();
		$("#appendCadOr").load("camposEspecificos.php?modificar=Orientador");
	}
	
	function removeCampus(id_campus) {
		var str = new Array();
		str.push("opcao=removeCampusOr");
		str.push("id_campus="+id_campus);
		
		$.ajax({
			type: "POST",
			url: 'usuario_alterarDados.php', 
			data: str.join("&"),
			success: function(data) {
				eval(data);
				retorno = dados.retorno;
				if(retorno == 18) {
					location.reload();
				} else if(retorno == -18) {
					$("#msg_erroOrien1").show();
				} else if(retorno == -19) {
					$("#msg_erroOrien2").show();
				}
			}
		});
	}
	
	/*function alteraTipo(tipo) {
		var str = new Array();
		str.push("opcao=alteraTipo");
		str.push("tipo="+tipo);	 // <--------- PAREI AQUIII!!!!!
	} */
	
/*Funcoes relacionadas ao TRABALHO*/	
	
	function getListaTrabOrien() {
		str = "opcao=getListaTrabOrientador";
	
		$.ajax({
			type: "GET",
			url: 'trabalho_opF.php', /*arquivo que manipula INFO do TRABALHO*/
			data: str,
			success: function(data) {
			$("#appendTrabOrien").html(data);
			}
		});
	}
	
	function visualizarTrabalho(id_trab) {
		var str = new Array();
		str.push("opcao=verTrabalho");
		str.push("id_trabalho="+id_trab);
		
		$.ajax({
          type: "GET",
          url: 'trabalho_opF.php', /*arquivo que manipula INFO do TRABALHO*/
          data: str.join("&"),
          success: function(data) {
			$("#divSombra").show(); 
			$("#popUpTrab").html(data);
			$("#popUpTrab").show();
		  }
		});
	} 

</script>