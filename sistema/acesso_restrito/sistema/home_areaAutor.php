<?php
session_start();

?>

<div id="infoAutor">
	<div style="background-color:#CCDAB4;width:97%;height:18px;padding-top:5px;padding-left:10px;">
	<label id="title1" style="font-weight:bold;height:20px;">Dados Específicos do Cadastro:</label>
	</div>
	
	<table id="infoAutorEst" style="margin-top:5px;">
		<tr style="background-color:#CCDAB4;height:18px;padding-left:10px;width:97%;">
		<td width="320px;" style="padding-left:10px;">Curso</td>
		<td width="160px;" style="padding-left:10px;">Campus</td>
		<td width="120px;" style="padding-left:10px;">Instituição</td></tr>
	</table>
	
<a href="#" onclick="insereCurso();" class="link1" style="margin-left:10px;font-size:10px;text-decoration:underline;"> Vincular-se a outro curso...</a>

	<div style="clear:both;height:10px;"></div>

	<div id="msg_erroAut1" style="color:#ff0000;height:20px;display:none;"><br> Você deve possuir, no mínimo, um curso cadastrado. </div>

	<div id="msg_erroAut2" style="color:#ff0000;height:20px;display:none;"><br> Este é o curso vinculado ao seu trabalho. <br> Por favor, atualize seu trabalho antes de efetuar a remoção do curso.</div>

	<div style="clear:both;height:10px;"></div>

</div>

<div id="trabShow" style="margin-top:15px;">
	<hr style="width:80%;"> <br>
	<div style="background-color:#CCDAB4;width:97%;height:18px;padding-top:5px;padding-left:10px;">
	<label id="title3" style="font-weight:bold;height:20px;">Trabalhos:</label>
	</div>
    
    <div style="clear:both;height:10px;"></div>
	
    <div id="appendTrabAut"></div>

	<table id="listaTrabalhos" style="margin-top:5px;">
		<tr style="background-color:#CCDAB4;height:18px;padding-left:10px;width:97%;">
        <td width="15px;" style="padding-left:10px;">ID</td>
		<td width="450px;" style="padding-left:10px;">Título</td>
		<td width="100px;" style="padding-left:10px;">Status</td>
		<td width="120px;" style="padding-left:10px;"> </td></tr>
	</table>

    <!--
    <a href="trabalho.php?action=new" class="link1" style="margin-left:10px;margin-bottom:10px;font-size:10px;text-decoration:underline;">Enviar novo trabalho...</a>
    -->
    
</div>



	
<div id="inserirCurso" style="display:none;">
	<h4>Área autores</h4>
	<label id="title2" style="font-weight:bold;height:20px;">Inserir Novo Curso:</label>
	<div style="clear:both;height:10px;"></div>
	<div id="appendCadAut"></div>
</div>

<script>
    $(document).ready(function() {
		getInfoAutor();
		getListaTrabalhos();
    });
	
/*Funcoes relacionadas ao USUARIO*/	

	function getInfoAutor(){
        var str = "opcao=getInfoAutor";

        $.ajax({
          type: "GET",
          url: 'usuario_op.php', /*arquivo que recupera INFO do USUARIO*/
          data: str,
          success: function(data) {
              $("#infoAutorEst").append(data);
          }
        });
    }
	
	function insereCurso() {
		$("#title1").hide();
		$("#title2").show();
		$("#botOcult1").hide();
		$("#infoAutor").hide();
		$("#trabShow").hide();
		$("#inserirCurso").show();
		$("#appendCadAut").load("camposEspecificos.php?modificar=Autor"); /*Arquivo que contém CAMPOS de FORMS de USUARIO*/
	}
	
	function removeCurso(id_curso) {
		var str = new Array();
		str.push("opcao=removeCursoAut");
		str.push("id_curso="+id_curso);
		
		$.ajax({
			type: "POST",
			url: 'usuario_alterarDados.php', /*Arquivo que ALTERA dados do USUARIO*/
			data: str.join("&"),
			success: function(data) {
				eval(data);
				retorno = dados.retorno;
				if(retorno == 16) {
					window.location = "home.php?area=Autor";
				} else if(retorno == -16) {
					$("#msg_erroAut1").show();
				} else if(retorno == -17) {
					$("#msg_erroAut2").show();
				}
			}
		});
	}
	
/*Funcoes relacionadas ao TRABALHO*/		
	
	function getListaTrabalhos(){
		str = "opcao=getListaTrabalhos";
        
		$.ajax({
			type: "GET",
			url: 'trabalho_opF.php', /*arquivo que manipula INFO do TRABALHO*/
			data: str,
			success: function(data) {
				//$("#appendTrabAut").html(data);
                $("#listaTrabalhos").append(data);
			}
		});
	}	
	
	function removerTrabalho(id) {
		if(!confirm("Tem certeza que deseja excluir o trabalho? Não haverá possibilidades de recuperá-lo.")){
			return;
		}
		var str = new Array();
		str.push("opcao=removerTrabalho");
		str.push("id_trabalho="+id);
		
		$.ajax({
			type: "POST",
			url: 'trabalho_opF.php', /*arquivo que manipula INFO do TRABALHO*/
			data: str.join("&"),
			success: function(data) {
				window.location = "home.php?area=Autor";
			}
		});	
	}
	
</script>
