<?php
session_start();

include("../../conexao.php");
include("../../funcoes.php");

if(!(isset($_SESSION['id_administracao']))) {
	header("Location: index.php?diff=".elDiff());
} else {
     include("inc_cabecalho.php");
}
$arr_perm = retornaPermissoesUsuario($_SESSION['id_administracao']);

?>

<div id="conteudo" style="margin-left:10px; margin-top:20px;">
	
    <div id="info_usuario" style="height:300px;">
        <div style="background-color:#CCDAB4;width:97%;height:18px;padding-top:5px;padding-left:10px;"> <label style="font-weight:bold;">Menu Administração: </label></div>
        
		<div style="clear:both;height:10px;"></div>
        <a href="cadastroAdministracao.php" class="link1" style="margin-left:10px;font-size:10px;text-decoration:underline;"> Alterar Dados </a> <br><br>

		
        <table width="600">
        
        <tr>
        
        <td>
        

		<a href="adm_voluntarios.php" class="link1" style="margin-left:10px;font-size:10px;text-decoration:underline;"> Voluntários </a> <br><br>

		<a href="adm_ouvintes.php" class="link1" style="margin-left:10px;font-size:10px;text-decoration:underline;"> Ouvintes </a> <br><br>

        <a href="adm_autores.php" class="link1" style="margin-left:10px;font-size:10px;text-decoration:underline;"> Autores </a> <br><br>

        <a href="adm_orientadores.php" class="link1" style="margin-left:10px;font-size:10px;text-decoration:underline;">Orientadores </a> <br><br>

		<?php if($_SESSION["nivel_adm"] <= 2) { ?>
		
		<a href="adm_avaliadores.php?ordem=5" class="link1" style="margin-left:10px;font-size:10px;text-decoration:underline;"> Avaliadores </a> <br><br>
        
		<?php } ?>
		
        </td>
        
        <td>
		
		<?php 
                //if($_SESSION["nivel_adm"] <= 2) { 
               
                //if($arr_perm[12]){
                ?>
		<a href="adm_trabalhos.php?ordem=5" class="link1" style="margin-left:10px;font-size:10px;text-decoration:underline;"> Trabalhos </a> <br> <br>

		<?php // } ?>
		
        <a href="sessoes/lista_trabalhos_imprimir.php" class="link1" style="margin-left:10px;font-size:10px;text-decoration:underline;"> Trabalhos para Imprimir </a> <br> <br>
        
        </td>
		
		<?php if($_SESSION["nivel_adm"] <= 2) { ?>
		
        <td align="left">
   		<a href="sessoes/sessoes.php" class="link1" style="margin-left:10px;font-size:10px;text-decoration:underline;">Sessões </a> <br> <br>

        <a href="sessoes/sessoes_avaliadores.php" class="link1" style="margin-left:10px;font-size:10px;text-decoration:underline;"> Sessões e Avaliadores</a> <br><br>
        
        <a href="sessoes/sessoes_trabalhos_avaliadores.php" class="link1" style="margin-left:10px;font-size:10px;text-decoration:underline;"> Sessões, Trabalhos, Avaliadores</a> <br><br>

    	<a href="sessoes/lista.php" class="link1" style="margin-left:10px;font-size:10px;text-decoration:underline;"> Lista, Trabalhos nas Sessões</a> <br> <br>
        
        <a href="sessoes/criar_sessao.php?acao=criar" class="link1" style="margin-left:10px;font-size:10px;text-decoration:underline;"> Criar Sessão </a> <br> <br>
		
		<?php } ?>
        
        </td>
        </tr>
        </table>
        
		<?php //if($_SESSION["nivel_adm"] <= 1) { ?>
		
			<div id="andamento"> </div>
            
			<a href="#" class="link1" style="margin-left:10px;font-size:10px;" onclick="enviar_email_avaliadores();"> enviar email - avaliadores sem área </a>  <br>
			
			<a href="#" class="link1" style="margin-left:10px;font-size:10px;" onclick="enviar_email_sessoes_avaliadores();"> enviar email - avaliadores: sessões </a>  <br>
			
			<a href="#" class="link1" style="margin-left:10px;font-size:10px;" onclick="enviar_email_trabalho_status(2);"> enviar email - trabalhos aceitos </a>  <br>
			
			<a href="#" class="link1" style="margin-left:10px;font-size:10px;" onclick="enviar_email_trabalho_status(3);"> enviar email - trabalhos a corrigir </a> <br>
			
			<a href="#" class="link1" style="margin-left:10px;font-size:10px;" onclick="enviar_email_trabalho_status(5);"> enviar email - trabalhos recusados </a> <br>
            
			<a href="#" class="link1" style="margin-left:10px;font-size:10px;" onclick="enviar_email_autores_orientadores_1();"> enviar email - trabalhos (autores, orientadores) - verificar autores</a> <br>
			
			<a href="#" class="link1" style="margin-left:10px;font-size:10px;" onclick="enviar_email_sessoes_avaliadores();"> enviar email para avaliador confirmar sessao</a> <br>

			<a href="#" class="link1" style="margin-left:10px;font-size:10px;" onclick="enviar_email_avaliadores_2();"> enviar email com instruções para avaliador avaliar</a> <br>

			<a href="#" class="link1" style="margin-left:10px;font-size:10px;" onclick="enviar_email_avaliadores_3();"> enviar email com instruções avaliador na chegada no evento</a> <br>

			<a href="#" class="link1" style="margin-left:10px;font-size:10px;" onclick="enviar_email_avaliadores_4();"> enviar email avaliadores não alocados</a> <br>

			<a href="#" class="link1" style="margin-left:10px;font-size:10px;" onclick="enviar_email_usuarios_pesquisa();"> enviar email usuarios pesquisa</a> <br>
            
            <!--
<input type=button value="Enviar email para avaliadores pendentes" onclick='enviar_email_avaliadores_pendentes()'>
-->

			<a href="#" class="link1" style="margin-left:10px;font-size:10px;" onclick="teste();"> teste </a> <br>

        
		<?php // } ?>
		
		
    </div>
	
</div>

<script>

function enviar_email_trabalho_status(status) {
	str = "option=enviar_email_trabalho_status&status="+status;
	
	$.ajax({
		  type: "POST",
          url: 'restritoAdm.php', 
          data: str,
          success: function(data) {
              $("#andamento").append(data);
          }
		});
}

function enviar_email_sessoes_avaliadores() {
	str = "option=enviar_email_sessoes_avaliadores";
	
	$.ajax({
		  type: "POST",
          url: 'restritoAdm.php', 
          data: str,
          success: function(data) {
              $("#andamento").append(data);
          }
	});

}

function enviar_email_avaliadores() {
	str = "option=enviar_email_avaliadores";
	
	$.ajax({
		  type: "POST",
          url: 'restritoAdm.php', 
          data: str,
          success: function(data) {
              $("#andamento").append(data);
          }
	});
}

function enviar_email_avaliadores_2() {
	str = "option=enviar_email_avaliadores_2";
	
	$.ajax({
		  type: "POST",
          url: 'restritoAdm.php', 
          data: str,
          success: function(data) {
              $("#andamento").append(data);
          }
	});
}

function enviar_email_avaliadores_3() {
	str = "option=enviar_email_avaliadores_3";
	
	$.ajax({
		  type: "POST",
          url: 'restritoAdm.php', 
          data: str,
          success: function(data) {
              $("#andamento").append(data);
          }
	});
}


function enviar_email_avaliadores_4() {
	str = "option=enviar_email_avaliadores_4";
	
	$.ajax({
		  type: "POST",
          url: 'restritoAdm.php', 
          data: str,
          success: function(data) {
              $("#andamento").append(data);
          }
	});
}

function enviar_email_autores_orientadores_1() {
	str = "option=enviar_email_autores_orientadores_1";
	
	$.ajax({
		  type: "POST",
          url: 'restritoAdm.php', 
          data: str,
          success: function(data) {
              $("#andamento").append(data);
          }
	});
}


function enviar_email_usuarios_pesquisa() {
	str = "option=enviar_email_usuarios_pesquisa";
	
	$.ajax({
		  type: "POST",
          url: 'restritoAdm.php', 
          data: str,
          success: function(data) {
              $("#andamento").append(data);
          }
	});
}

function teste() {
	str = "option=teste";
	
	$.ajax({
		  type: "POST",
          url: 'restritoAdm.php', 
          data: str,
          success: function(data) {
              $("#andamento").append(data);
          }
		});
}

</script>

<?php
include("inc_rodape.php");
?>
