<?php
session_start();

include("../../conexao.php");
include("../../funcoes.php");

$titulo = "Ouvintes";

?>

<style type="text/css">

td{
  text-decoration:none; 
  font-size: 14px; 
  font-family: arial, helvetica, sans-serif;
  color: #000;
  border-radius: 7px;
  padding: 6px;
  text-align: left;
}
tr:hover {
	background: #CCDAB4;
}
</style>
<?php 
include("inc_cabecalho.php");
?>
 <br /><br />
 <div align="center" style="background-color:#CCDAB4;width:auto;height:18px;padding: 6px; border-radius: 7px; text-align: center"> <label width="auto" style="text-decoration:none; text-align: center; font-size: 14px; font-family: arial, helvetica, sans-serif; font-weight: bold; color: #000;"> Ouvintes Cadastrados: </label></div>
 <table id="listaOuvintes" name="listaOuvintes">
 <tr style="background-color:#CCDAB4;"> 
	<td width="50px" style="font-weight: bold; ">ID:</td>
	<td width="400px" style="font-weight: bold; ">Nome:</td>
	<td width="350px" style="font-weight: bold; ">Email:</td>
 </tr>
 </table>

 <br /><br /><a href="home_restrito.php" class="button red" >Voltar </a>
 </div>
   <script>
	$(document).ready(function() {
		getListaOuvintes();
    });
	
	function getListaOuvintes() {
		str = "option=getListaOuvintes";
	
		$.ajax({
		  type: "GET",
          url: 'restritoAdm.php', 
          data: str,
          success: function(data) {
              $("#listaOuvintes").append(data);
          }
		});
	}
 </script>
 
<?php
include("inc_rodape.php");
?>