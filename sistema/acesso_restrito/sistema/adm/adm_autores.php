<?php
session_start();

include("../../conexao.php");

$titulo = "Autores";
include("inc_cabecalho.php");

?>
<style type="text/css">
tr:hover {
	background: #CCDAB4;
}
</style>

 <div style="background-color:#CCDAB4;width:97%;height:18px;padding-top:5px;padding-left:10px;margin-top:25px;"> <label style="font-weight:bold;"> Autores Cadastrados: </label></div>

 <!--
  <div id="tabela" style="height:300px; overflow:auto;">
  -->
  <div id="tabela">
 <table id="listaAutores" name="listaAutores"> 
 <tr style="background-color: #CCDAB4"> 
	<td>ID:</td>
	<td>Nome:</td>
    <td>Email:</td>
    <td>Curso:</td>
    <td>Campus:</td>
    <td>Instituição:</td>
 </tr>

 </table>
 </div>

 <a href="home_restrito.php" class="link1" style="margin-left:10px;font-size:10px;text-decoration:underline;"> Voltar </a>
 
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