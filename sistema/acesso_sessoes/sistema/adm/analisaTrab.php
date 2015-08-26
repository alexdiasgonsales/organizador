<?php
header('Content-type: text/html; charset=utf-8');
session_start();

include("../../conexao.php");
include("../../funcoes.php");
include("inc_cabecalho.php");

if(!(isset($_SESSION["id_administracao"])))
	header("Location: index.php");

$arr_perm = retornaPermissoesUsuario($_SESSION['id_administracao']);
?>
<div id="mostra_trabalho" style="display:none;"> </div>
<?php
if($arr_perm[12]){
?>
<fieldset id="analisaTrabalho" style="background-color:#CCDAB4;margin-top:30px;">
	<div style="clear:both; height:30px;"></div>
	<h3 align="center">Analisar Trabalho:</h3>

	<div id="msg1" style="color:#ff0000;height:20px;display:none;"> Desculpe, ocorreu um erro interno.</div>
	<div id="msg2" align="center" style="color:#ff0000;height:20px;display:none;"> Trabalho pendente de confirmação de envio.</div>
	<div id="msg3" style="color:#ff0000;height:20px;display:none;"> - Aguardando correção do trabalho pelo autor - </div>
	<div id="msg4" style="color:#ff0000;height:20px;display:none;" align="center"> - Somente o Administrador vinculado à primeira análise do trabalho pode efetuar a segunda análise do mesmo - </div>

  <div id="mostrar_analises"> </div>

<div id="formulario_analise">
<form id="formAnalise_trabalho" name="formAnalise_trabalho">
	<input type="hidden" id="option" name="option" value="analisaTrab" />
	<input type="hidden" id="id_trabalho" name="id_trabalho" value="<?php echo $_GET["id_trab"]; ?>" />
	
	<div style="clear:both; height:30px;"></div>
	<label style="font-weight: bold;"> Status Geral do Trabalho: </label>
	<div style="clear:both; height:5px;"></div>
	<input type="radio" id="status" name="status" value="2">Aceito
	<input type="radio" id="status" name="status" value="3" style="margin-left:15px;">Corrigir
	<input type="radio" id="status" name="status" value="5" style="margin-left:15px;">Recusado
	
	
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
	
	Observações:
	
	<div style="clear:both; height:15px;"></div>
	<label style="font-weight: bold;"> Introdução: </label>
	
	<input type="radio" id="introducao" name="introducao" value="0">Conforme
	<input type="radio" id="introducao" name="introducao" value="1" style="margin-left:15px;">Inconforme
	
	<!--
	<label style="margin-left:10px;">- Observações: </label>
	-->
	<textarea id="obs_introducao" name="obs_introducao" type="textarea" style="margin-left:10px;resize: none;width:400px;height:50px;" maxlength="200"> </textarea>

	<div style="clear:both; height:30px;"></div>
	<label style="font-weight: bold;"> Objetivos: </label>
	
	<input type="radio" id="objetivos" name="objetivos" value="0">Conforme
	<input type="radio" id="objetivos" name="objetivos" value="1" style="margin-left:15px;">Inconforme
	
	<textarea id="obs_objetivos" name="obs_objetivos" type="textarea" style="margin-left:10px;resize: none;width:400px;height:50px;" maxlength="200"> </textarea>
	
	<div style="clear:both; height:30px;"></div>
	<label style="font-weight: bold;"> Metodologia: </label>
	
	<input type="radio" id="metodologia" name="metodologia" value="0">Conforme
	<input type="radio" id="metodologia" name="metodologia" value="1" style="margin-left:15px;">Inconforme
	
	<textarea id="obs_metodologia" name="obs_metodologia" type="textarea" style="margin-left:10px;resize: none;width:400px;height:50px;" maxlength="200"> </textarea>
	
	<div style="clear:both; height:30px;"></div>
	<label style="font-weight: bold;"> Resultados: </label>
	
	<input type="radio" id="resultados" name="resultados" value="0">Conforme
	<input type="radio" id="resultados" name="resultados" value="1" style="margin-left:15px;">Inconforme
	
	<textarea id="obs_resultados" name="obs_resultados" type="textarea" style="margin-left:10px;resize: none;width:400px;height:50px;" maxlength="200"> </textarea><br>
	
	<div style="clear:both; height:30px;"></div>
	<label style="font-weight: bold;"> Observações gerais sobre o trabalho: </label>
	<div style="clear:both; height:5px;"></div>
	<textarea id="obs_gerais" name="obs_gerais" type="textarea" style="resize: none;width:600px;height:50px;" maxlength="1000"> </textarea><br>
	
	<div style="clear:both; height:30px;"></div>
	<label style="font-weight: bold;"> Anotações Internas (somente comissão organizadora poderá visualizar este campo): </label>
	<div style="clear:both; height:5px;"></div>
	<textarea id="observacoes" name="observacoes" type="textarea" style="resize: none;width:600px;height:50px;" maxlength="1000"> </textarea>

	<div style="clear:both; height:30px;"></div>
	<a id="botao" href="#" class="button blue" style="text-decoration:underline;" onClick="analisaTrabalho();"> Atualizar </a>
</form>
</div>
</fieldset>

<?php
}
?>
</div>
<script>
	$(document).ready(function(){
		<?php	if(isset($_GET["id_trab"]) && isset($_SESSION["id_administracao"])) {
					echo 'visualizar_trabalho('.$_GET["id_trab"].');';
					echo 'verificaAnaliseAnterior('.$_GET["id_trab"].');';
				} 
		?>
	});
	
	function visualizar_trabalho(id_trab) {
		var str = new Array();
		str.push("option=verTrabalho");
		str.push("id_trabalho="+id_trab);
		
		$.ajax({
                    type: "GET",
                    url: 'restritoAdm.php', /*arquivo que manipula INFO do TRABALHO*/
                    data: str.join("&"),
                    success: function(data) {
			$("#mostra_trabalho").html(data);
			$("#mostra_trabalho").show();
		  }
		});
	}
	
	function verificaAnaliseAnterior(id) {
		var str = new Array();
		str.push("option=verificaAnaliseAnterior");
		str.push("id_trabalho="+id);
        
		$.ajax({
          type: "POST",
          url: 'restritoAdm.php', 
          data: str.join("&"),
          success: function(data) {
              
			eval(data);
			ret = dados.retorno;
			if(ret == -1) {
				$("#msg1").show();
			} else if(ret == 0) {
                //STATUS_TRAB_PENDENTE
				$("#msg2").show();
				$("#formulario_analise").hide();
			} else if(ret == 10) {
                //STATUS_TRAB_ENVIADO
                //Permite inserir análise 1.
            }
            else if(ret == 21) {
                //Edita análise 1.
				recuperar_analise(id, 1);
			} else if(ret == 22) {
                //Mostra análise 1.
				mostrar_analise(id, 1);
				$("#formulario_analise").hide();
			} else if(ret == 23) {
                //Mostra análise 1 e Edita análise 2.
				mostrar_analise(id, 1);
				recuperar_analise(id, 2);
			} else if(ret == 24) {
                //Mostra análises 1 e 2 e não permite edição.
				mostrar_analise(id, 1);
				mostrar_analise(id, 2);
				$("#formulario_analise").hide();
			} else if(ret == 40) {
                //Mostra análise 1 e permite inserir análise 2.
				mostrar_analise(id, 1);
			} else if(ret == 45) {
                //Mostra análise 1.
				mostrar_analise(id, 1);
				$("#formulario_analise").hide();
				$("#msg4").show();
			}
		  }
		});
	}
	
	function validar() {
		d = document.formAnalise_trabalho;
		if(d.status[0].checked == false && d.status[1].checked == false && d.status[2].checked == false) {
			alert('Por favor, preencha o status do trabalho.');
			return false;
		} else if(d.introducao[0].checked == false && d.introducao[1].checked == false) {
			alert('Por favor, avalie a introdução do trabalho.');
			return false;
		} else if(d.objetivos[0].checked == false && d.objetivos[1].checked == false) {
			alert('Por favor, avalie os objetivos do trabalho.');
			return false;
		} else if(d.metodologia[0].checked == false && d.metodologia[1].checked == false) {
			alert('Por favor, avalie a metodologia do trabalho.');
			return false;
		} else if(d.resultados[0].checked == false && d.resultados[1].checked == false) {
			alert('Por favor, avalie os resultados do trabalho.');
			return false;
		}
		return true;
	}
	
	function analisaTrabalho() {
		if(validar() == false)
			return false;
		
		var form = $("#formAnalise_trabalho").serialize();
		
		$.ajax({
          type: "POST",
          url: 'restritoAdm.php', 
          data: form,
          success: function(data) {
            alert(data);
			location.reload();
		  }
		});
	}
	
	function mostrar_analise(id, seq) {
		var str = new Array();
		str.push("option=mostrar_analise");
		str.push("id_trabalho="+id);
		str.push("seq="+seq);
		
		$.ajax({
          type: "POST",
          url: 'restritoAdm.php', 
          data: str.join("&"),
          success: function(data) {
			 $("#mostrar_analises").append(data);
		  }
		});
	}
	
	function recuperar_analise(id, seq) {
		var str = new Array();
		str.push("option=recuperar_analise");
		str.push("id_trabalho="+id);
		str.push("seq="+seq);
         
		$.ajax({
          type: "POST",
          url: 'restritoAdm.php', 
          data: str.join("&"),
          success: function(data) {
			eval(data);
			ret = dados.retorno;
			if(ret==1) {
				$('input:radio[name=status]')[dados.status].checked = true;
				$('input:radio[name=introducao]')[dados.status_intro].checked = true;
				$("#obs_introducao").val(dados.obs_intro);
				$('input:radio[name=objetivos]')[dados.status_obj].checked = true;
				$("#obs_objetivos").val(dados.obs_obj);
				$('input:radio[name=metodologia]')[dados.status_metod].checked = true;
				$("#obs_metodologia").val(dados.obs_metod);
				$('input:radio[name=resultados]')[dados.status_result].checked = true;
				$("#obs_resultados").val(dados.obs_result);
				$("#obs_gerais").val(dados.obs);
				//$("#").val(dados.autor_ciente);
				$("#observacoes").val(dados.obs_internas);
			} else {
				$("#msg1").show();
			}
		  }
	    });
	}
	
</script>

<?php
include("inc_rodape.php");
?>
