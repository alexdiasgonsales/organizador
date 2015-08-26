<?php
session_start();

include("../../conexao.php");
include("../../funcoes.php");

if (!(isset($_SESSION['id_administracao']))) {
  header("Location: index.php?diff=" . elDiff());
} else {?>
<style type="text/css">
  .link1{
    color: #000;
    font-family: arial, helvetica, sans-serif;
    font-weight: bold;
    padding: 6px;
  }
  .link1:hover{
    background-color: #CCDAB4;
    color: #040;
    border-radius: 7px;
    padding: 6px;
  }
</style>
<?php
  include("inc_cabecalho.php");
}
$arr_perm = retornaPermissoesUsuario($_SESSION['id_administracao']);
?>
<br /><br />
      <p style="background-color:#CCDAB4;height:18px; padding: 6px; border-radius: 7px; text-align: center">
        <b width="auto" style="text-decoration:none; text-align: center; font-size: 14px; font-family: arial, helvetica, sans-serif; font-weight: bold; color: #000;">Menu Administração:</b>
      </p><br /><br />

    <a href="cadastroAdministracao.php" class="button gray" style="margin-left:10px;font-size:14px; font-weight: bold;"> Alterar Dados </a> <br><br>

    <table width="auto">
      <tr>
        <td>
          <a href="adm_voluntarios.php" class="link1" style="margin-left:10px;font-size:14px;text-decoration:none;"> Voluntários </a> <br><br>
          <a href="adm_ouvintes.php" class="link1" style="margin-left:10px;font-size:14px;text-decoration:none;"> Ouvintes </a> <br><br>
          <a href="adm_autores.php" class="link1" style="margin-left:10px;font-size:14px;text-decoration:none;"> Autores </a> <br><br>
          <a href="adm_orientadores.php" class="link1" style="margin-left:10px;font-size:14px;text-decoration:none;">Orientadores </a> <br><br>

          <?php //if ($_SESSION["nivel_adm"] <= 2) { ?>
            <a href="adm_avaliadores.php?ordem=5" class="link1" style="margin-left:10px;font-size:14px;text-decoration:none;"> Avaliadores </a> <br><br>
          <?php //} ?>
        </td>

        <td>
          <?php
          //if($_SESSION["nivel_adm"] <= 2) { 
          //if($arr_perm[12]){
          ?>
          <a href="adm_trabalhos.php?ordem=5" class="link1" style="margin-left:10px;font-size:14px;text-decoration:none;"> Trabalhos </a> <br> <br>

          <?php // }  ?>

          <a href="sessoes/lista_trabalhos_imprimir.php" class="link1" style="margin-left:10px;font-size:14px;text-decoration:none;"> Trabalhos para Imprimir </a> <br> <br>

        </td>

        <?php //if ($_SESSION["nivel_adm"] <= 2) { ?>

          <td align="left">
            
            <a href="sessoes/sessoes.php" class="link1" style="margin-left:10px;font-size:14px;text-decoration:none;">Sessões </a> <br> <br>
            <a href="sessoes/sessoes_avaliadores.php" class="link1" style="margin-left:10px;font-size:14px;text-decoration:none;"> Sessões e Avaliadores</a> <br><br>
            <a href="sessoes/sessoes_trabalhos_avaliadores.php" class="link1" style="margin-left:10px;font-size:14px;text-decoration:none;"> Sessões, Trabalhos, Avaliadores</a> <br><br>
            <a href="sessoes/lista.php" class="link1" style="margin-left:10px;font-size:14px;text-decoration:none;"> Lista, Trabalhos nas Sessões</a> <br> <br>
            <a href="sessoes/criar_sessao.php?acao=criar" class="link1" style="margin-left:10px;font-size:14px;text-decoration:none;"> Criar Sessão </a> <br> <br>
            <a href="sessoes/lista_fichas_avaliacao.php" class="link1" style="margin-left:10px;font-size:14px;text-decoration:none;"> Fichas de Avaliação </a> <br> <br>
            <a href="sessoes/lista_entrega_certificados.php" class="link1" style="margin-left:10px;font-size:14px;text-decoration:none;"> Lista Entrega Certificados </a> <br> <br>
            <a href="sessoes/lista_sessoes_pasta.php" class="link1" style="margin-left:10px;font-size:14px;text-decoration:none;"> Sessoes p/ Pasta Avaliador </a> <br> <br>
            <a href="sessoes/lista_sessoes_identificacao.php" class="link1" style="margin-left:10px;font-size:14px;text-decoration:none;"> Sessoes p/ Identificar Sala </a> <br> <br>
            <a href="sessoes/certificadoAvaliador.php" class="link1" style="margin-left:10px;font-size:14px;text-decoration:none;"> Certificado Avaliador </a> <br> <br>

          <?php //} ?>

        </td>
      </tr>
    </table>

    <?php //if ($_SESSION["nivel_adm"] <= 1) { ?>
      <div id="andamento"> </div>

      <!--
  <input type=button value="Enviar email para avaliadores pendentes" onclick='enviar_email_avaliadores_pendentes()'>
      -->



    <?php //} ?>

</div>

<script>

  function enviar_email_trabalho_status(status) {
    str = "option=enviar_email_trabalho_status&status=" + status;

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
