<?php
session_start();

include("../../conexao.php");

$titulo = "Autores";

?>
<style type="text/css">

td{
  width: auto;
  text-decoration:none; 
  font-size: 13px; 
  font-family: arial, helvetica, sans-serif;
  color: #000;
  border-radius: 7px;
  padding: 6px;
}
tr:hover {
	background: #CCDAB4;
}
</style>
<?php 
include("inc_cabecalho.php");
?>
 <br /> <br /><div align="center" style="background-color:#CCDAB4;width:99%;height:18px;padding: 6px; border-radius: 7px; text-align: center;"> <label width="auto" style="text-decoration:none; text-align: center; font-size: 14px; font-family: arial, helvetica, sans-serif; font-weight: bold; color: #000;"> Autores Cadastrados: </label></div>

 <!--
  <div id="tabela" style="height:300px; overflow:auto;">
  -->
  <div id="tabela">
 <table id="listaAutores" name="listaAutores"> 
 <tr style="background-color: #CCDAB4">
    <td style="font-weight: bold; font-size: 14px;">ID:</td>
    <td style="font-weight: bold; font-size: 14px;">Nome:</td>
    <td style="font-weight: bold; font-size: 14px;">Email:</td>
    <td style="font-weight: bold; font-size: 14px;">Curso:</td>
    <td style="font-weight: bold; font-size: 14px;">Campus:</td>
    <td style="font-weight: bold; font-size: 14px;">Instituição:</td>
 </tr>

 </table>
 </div>

 <br /><br /><a href="home_restrito.php" class="button red" > Voltar </a>
 </div>
 <script>
	$(document).ready(function() {
		getListaAutores();
    });
	
	function getListaAutores() {
		str = "option=getListaAutores";
	
		$.ajax({
		  type: "GET",
          url: 'restritoAdm.php', 
          data: str,
          success: function(data) {
              $("#listaAutores").append(data);
          }
		});
	}

	function detalhesUser(id) {
		str = window.location = "detalharUsuario.php";
	}
 </script>
 
<?php
include("inc_rodape.php");
?>