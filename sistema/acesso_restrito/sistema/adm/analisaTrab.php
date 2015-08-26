<?php
header('Content-type: text/html; charset=utf-8');
session_start();

include("../../conexao.php");
include("../../funcoes.php");
include("../../../controller/constantes.php");
include("../../../controller/constantes_inscricao_trabalho.php");
include("inc_cabecalho.php");

if(!(isset($_SESSION["id_administracao"])))
	header("Location: index.php");

//$arr_perm = retornaPermissoesUsuario($_SESSION['id_administracao']);

  $id_trab = $_GET["id_trab"];
  $id_adm = $_SESSION["id_administracao"];

  $statusTrabalho = get_status_trabalho($id_trab, $conexao);

  $mensagem = $arr_status_trab_completo[$statusTrabalho];
    
  //Não funcionou usar false no javascript.
  $mostra_analise_1 = 0;
  $mostra_analise_2 = 0;
  $insere_analise_1 = 0;
  $insere_analise_2 = 0;
  $edita_analise_1 = 0;
  $edita_analise_2 = 0;
  
$sql = "SELECT * FROM parecer_trabalho WHERE fk_trabalho = " . $id_trab. " order by seq";
$resultado = runSQL($sql);
$quant_pareceres = mysql_num_rows($resultado);
if ($quant_pareceres > 0) {
  $linha = mysql_fetch_array($resultado);
  $id_revisor = $linha["fk_revisor"];
}

/*
  if ($quant_pareceres == 0) {
    $mostra_analise_1 = 0;
    $mostra_analise_2 = 0;
  }
  else if ($quant_pareceres == 1) {
    $mostra_analise_1 = 1;
    $mostra_analise_2 = 0;
  }
  else if ($quant_pareceres == 2) {
    $mostra_analise_1 = 1;
    $mostra_analise_2 = 1;
  }
*/

  //=========================================================================
  if ( (ETAPA_INSCRICAO_TRABALHO == 1) || (ETAPA_ANALISE_TRABALHO_1 == 1) ) {
    
    if ($statusTrabalho == STATUS_TRAB_VALIDADO) {
      if ($quant_pareceres == 0) {
        $insere_analise_1 = 1;
      }
      else if ($quant_pareceres == 1) {
        if ($id_adm == $id_revisor) {
          $edita_analise_1  = 1;
        }
        else {
          $mostra_analise_1 = 1;
        }
      }
    }//STATUS_TRAB_VALIDADO
    
    else if ( ($statusTrabalho == STATUS_TRAB_ACEITO) || 
              ($statusTrabalho == STATUS_TRAB_CORRIGIR) || 
              ($statusTrabalho == STATUS_TRAB_RECUSADO)) {
      if ($quant_pareceres == 1) {
        if ($id_adm == $id_revisor) {
          $edita_analise_1  = 1;
        }
        else {
          $mostra_analise_1 = 1;
        }
      }
      
    }//
    
  }//ETAPA_INSCRICAO_TRABALHO || ETAPA_ANALISE_TRABALHO_1

  //=========================================================================
  else if (ETAPA_CORRECAO_TRABALHO_1 == 1) {
    
    if ($statusTrabalho == STATUS_TRAB_CORRIGIDO)  {
     if ( ($quant_pareceres == 1) && ($id_adm == $id_revisor) ) {
       $insere_analise_2 = 1;
     }
     else if ( ($quant_pareceres == 2) && ($id_adm == $id_revisor) ) {
        $edita_analise_2  = 1;
      }
    }//STATUS_TRAB_CORRIGIDO
    
  }//ETAPA_CORRECAO_TRABALHO_1
  
  //=========================================================================
  else if (ETAPA_ANALISE_TRABALHO_2 == 1) {
    
    if ( ($statusTrabalho == STATUS_TRAB_CORRIGIR) ||
         ($statusTrabalho == STATUS_TRAB_EM_CORRECAO) ||
         ($statusTrabalho == STATUS_TRAB_CORRIGIDO) ) {
     if ( ($quant_pareceres == 1) && ($id_adm == $id_revisor) ) {
       $insere_analise_2 = 1;
     }
     else if ( ($quant_pareceres == 2) && ($id_adm == $id_revisor) ) {
        $edita_analise_2  = 1;
      }
    }
    
  }//ETAPA_ANALISE_TRABALHO_2  
    
?>

<div id="mostra_trabalho" style="display:none;"> </div>

<?php
//if($_SESSION['authUser']->revisor){ //<<<<<<<<<<<<<<<<<<<<
if(true){
?>

<div style="background-color:#CCDAB4;margin-top:30px;">
  
	<div style="clear:both; height:30px;"></div>
  
	<h3 align="center">Parecer do Trabalho:</h3>

	<div id="msg1" align="center" style="color:#ff0000;height:20px;font-size:14;display:none;">Ocorreu um erro interno.</div>
  <div id="msg2" align="center" style="color:#ff0000;height:20px;font-size:14;display:none;">Não é possível emitir o parecer: Trabalho PENDENTE. Autor deve confirmar o envio do trabalho.</div>
	<div id="msg3" align="center" style="color:#ff0000;height:20px;font-size:14;display:none;">Não é possível emitir o parecer: Aguardando correção do trabalho pelo autor.</div>
	<div id="msg4" align="center" style="color:#ff0000;height:20px;font-size:14;display:none;">Não é possível emitir o parecer: Somente o Revisor vinculado à primeira análise do trabalho pode efetuar a segunda análise do mesmo.</div>
	<div id="msg5" align="center" style="color:#ff0000;height:20px;font-size:14;display:none;">Não é possível emitir o parecer: Trabalho ENVIADO mas aguardando validação pelo orientador.</div>
  <div id="msg6" align="center" style="color:#ff0000;height:20px;font-size:14;display:none;">Não é possível emitir o parecer: Trabalho foi INVALIDADO pelo orientador.</div>

  <div id="mostrar_analises"> </div>

</div>

<div style="clear:both; height:30px;"></div>

<div id="formulario_analise" style="background-color:#CCDAB4;margin-top:30px;display:none;">
  
<form id="formAnalise_trabalho" name="formAnalise_trabalho">
	<input type="hidden" id="option" name="option" value="analisaTrab" />
	<input type="hidden" id="id_trabalho" name="id_trabalho" value="<?php echo $_GET["id_trab"]; ?>" />
	
	<div style="clear:both; height:30px;">Marque cada um dos itens como CONFORME ou INCONFORME e caso queira, descreva na caixa ao lado o parecer do item para que o autor tenha conhecimento dos motivos do parecer.</div>
	
        
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
	<label style="font-weight: bold;"> Anotações Internas (somente comissão organizadora poderá visualizar este campo). Pode ser utilizado para copiar o conteúdo do resumo para posteriormente comparar com as modificações efetuadas pelo autor: </label>
	<div style="clear:both; height:5px;"></div>
	<textarea id="observacoes" name="observacoes" type="textarea" style="resize: none;width:600px;height:200px;" maxlength="5000"> </textarea>

	<div style="clear:both; height:30px;"></div>
        
        <label style="font-weight: bold;"> Status Geral do Trabalho: </label>
	<div style="clear:both; height:5px;"></div>
        <input type="radio" id="status" name="status" value="<?php echo STATUS_TRAB_ACEITO;?>">Aceito
	<input type="radio" id="status" name="status" value="<?php echo STATUS_TRAB_CORRIGIR;?>" style="margin-left:15px;">Corrigir
	<input type="radio" id="status" name="status" value="<?php echo STATUS_TRAB_RECUSADO;?>" style="margin-left:15px;">Recusado
	
        <br>
        <br>
        Marque o parecer geral do trabalho e clique no link abaixo (SALVAR PARECER).<BR>
        ACEITO: Trabalho foi aceito para apresentação.<BR>
        CORRIGIR: Trabalho necessita correções. Citar as correções necessárias.<BR>
        RECUSADO: Trabalho recusado.<BR>

</form>
  
</div>

<?php if ( ($insere_analise_1==1) || 
           ($insere_analise_2==1) ||
           ($edita_analise_1==1)  ||
           ($edita_analise_2==1)  ):?>
  <a id="botao" href="#" onClick="analisaTrabalho();" class="buttonNtrab" style="font-size:16pt;">Salvar Parecer</a><br>  

  <?php endif;?>
<!--
  <a href="../imprimir_trabalho.php?id_trabalho=<?php echo $_GET['id_trab']; ?>">Visualizar PDF</a><br>
-->
  <a href="adm_trabalhos.php" class="button" style="font-size:16pt;">Voltar</a><br>
  
<?php
}
?>

<script>
	$(document).ready(function(){
		<?php	if(isset($_GET["id_trab"]) && isset($_SESSION["id_administracao"])) {
					echo 'visualizar_trabalho('.$_GET["id_trab"].');';
					echo "verificaAnaliseAnterior(".$_GET['id_trab'].",".
                  $mostra_analise_1.','.
                  $mostra_analise_2.','.
                  $insere_analise_1.','.
                  $insere_analise_2.','.
                  $edita_analise_1.','.
                  $edita_analise_2.');';
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
	
  function verificaAnaliseAnterior(id, mostra_1, mostra_2, insere_1, insere_2, edita_1, edita_2) {
      //alert(ret);
      
      //if (ret == 4) {
      //  $("#msg4").show();
     // }
      
      if (mostra_1==1) {
        mostrar_analise(id, 1);
      }
      if (mostra_2==1) {
        mostrar_analise(id, 2);
      }
      if (insere_1==1) {
        $("#formulario_analise").show();
      }
      if (insere_2==1) {
        $("#formulario_analise").show();
      }
      if (edita_1==1) {
        recuperar_analise(id, 1);
        $("#formulario_analise").show();
      }
      if (edita_2==1) {
        recuperar_analise(id, 2);
        $("#formulario_analise").show();
      }
      
  }//verificaAnaliseAnterior()
	
  function validar() {
		d = document.formAnalise_trabalho;
		if(d.status[0].checked == false && d.status[1].checked == false && d.status[2].checked == false) {
			alert('Por favor, preencha o status geral do trabalho.');
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
                        alert(data); //Mostra mensagem de sucesso ou erro.
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
