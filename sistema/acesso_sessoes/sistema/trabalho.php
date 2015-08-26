<?php
header('Content-type: text/html; charset=utf-8');

session_start();

include("../conexao.php");
include("../funcoes.php");
include("adm/constantes_adm.php");

?>

<script type="text/javascript" src="scriptCadastro.js"></script>
<script type="text/javascript" src="scriptEstudos.js"></script>
<script type="text/javascript" src="scriptValidacao.js"></script>
<?php

include("inc_cabecalho.php");

?>
<div id="ver_trabalho" style="display:none;"> </div>

<div id="editar_trabalho" style="display:none;"> </div>

<div id="novo_trabalho" style="display:none;"> </div>

</div>

<script>
	$(document).ready(function(){
        
        <?php
			if(isset($_GET["id_trab"]) && ($_GET["action"]=="view")){
				if(isset($_SESSION["autor"]) &&  $_SESSION["autor"] == "allowed") {
					echo 'visualizar_trabalho('.$_GET["id_trab"].');';
				} else if(isset($_SESSION["orientador"]) &&  $_SESSION["orientador"] == "allowed") {
					echo 'visualizar_trabalho('.$_GET["id_trab"].');';
				} else if(isset($_SESSION["id_administracao"])) {
					echo 'visualizar_trabalho('.$_GET["id_trab"].');';
				}else {
					header("Location: index.php");
				}
			} else if(isset($_GET["id_trab"]) && ($_GET["action"]=="edit")){
				if(isset($_SESSION["autor"]) &&  $_SESSION["autor"] == "allowed") {
					echo 'editar_trabalho('.$_GET["id_trab"].');';
				} else {
					header("Location: index.php");
				}
			} else if(isset($_GET["action"]) && ($_GET["action"]=="new")){
				if(isset($_SESSION["autor"]) &&  $_SESSION["autor"] == "allowed") {
					echo 'novoTrabalho();';
				} else {
					header("Location: index.php");
				}
			}
		?>
    });
	
	function visualizar_trabalho(id_trab) {
		var str = new Array();
		str.push("opcao=verTrabalho");
		str.push("id_trabalho="+id_trab);
		
		$.ajax({
          type: "GET",
          url: 'trabalho_opF.php', /*arquivo que manipula INFO do TRABALHO*/
          data: str.join("&"),
          success: function(data) {
			$("#ver_trabalho").html(data);
			$("#ver_trabalho").show();
			visualizar_avaliacao(id_trab, 1);
	<?php	if(ETAPA_INSCRICAO_TRABALHO == 0 && ETAPA_ANALISE_TRABALHO == 0 && ETAPA_CORRECAO_TRABALHO == 0 && ETAPA_ANALISE_FINAL_TRABALHO == 0)
				$fim_mostratec = 1;
			else 
				$fim_mostratec = 0;
			if($fim_mostratec == 1)
				echo 'visualizar_avaliacao(id_trab, 2);'; ?>
		  }
		});
	}
	
	function visualizar_avaliacao(id, seq) {
		var str = new Array();
		str.push("option=mostrar_analise");
		str.push("id_trabalho="+id);
		str.push("seq="+seq);
		
		$.ajax({
          type: "POST",
          url: 'adm/restritoAdm.php', 
          data: str.join("&"),
          success: function(data) {
			$("#mostraCorrecao").append(data);
		  }
		});
	}
	
	function editar_trabalho(id_trab) {
		$("#editar_trabalho").load("criarEeditarTrab.php?id_trabalho="+id_trab);
		$("#editar_trabalho").show();
	}
	
	function novoTrabalho() {
		$("#novo_trabalho").load("criarEeditarTrab.php"); /*Arquivo que contém CAMPOS de FORMS de TRABALHO*/
		$("#novo_trabalho").show();
	}
    
    function enviarTrabalho(id_trab) {
        if (confirm("Tem certeza que deseja efetuar o envio do trabalho?")) {
            var str = new Array();
            str.push("opcao=enviarTrabalho");
            str.push("id_trabalho="+id_trab);
		
            $.ajax({
                type: "GET",
                url: 'trabalho_opF.php',
                data: str.join("&"),
                success: function(data) {
                    if (data==1) {
                        alert("Trabalho enviado com sucesso.");
                        location.reload();
                    }
                    else if(data == -3)
                        alert("Já possui outro trabalho com a mesma modalidade. Modifique a modalidade do trabalho.");
                    else if(data == -4)
                        alert("Trabalho não possui orientador. Adicione orientador no trabalho.");
                    else
                        alert("Erro ao enviar trabalho. Erro = "+data);
                }
            });
            
        }
    }
	
</script>

<?php
include("inc_rodape.php");
?>

