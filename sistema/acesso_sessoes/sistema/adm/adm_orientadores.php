<?php
session_start();

include("../../conexao.php");
include("../../funcoes.php");

$titulo = "Orientadores";

?>

<style type="text/css">

td{
  text-decoration:none; 
  font-size: 14px; 
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
 <br /><br />
 <div align="center" style="background-color:#CCDAB4;width:auto;height:18px;padding: 6px; border-radius: 7px; text-align: center"> <label width="auto" style="text-decoration:none; text-align: center; font-size: 14px; font-family: arial, helvetica, sans-serif; font-weight: bold; color: #000;"> Orientadores Cadastrados: </label></div>
 <table id="listaOrientadores" name="listaOrientadores">
 <tr style="background-color:#CCDAB4;"> 
	<td width="auto" style="font-weight: bold; font-sie: 14px;">ID:</td>
	<td width="220px" style="font-weight: bold; font-sie: 14px;">Nome:</td>
	<td width="220px" style="font-weight: bold; font-sie: 14px;">Email:</td>
	<td width="220px" style="font-weight: bold; font-sie: 14px;">Campus:</td>
	<td width="220px" style="font-weight: bold; font-sie: 14px;">Instituição:</td>
 </tr>
 </table>

  <br /><br /><a href="home_restrito.php" class="button red" >Voltar </a>
  </div>
 
   <script>
	$(document).ready(function() {
		getListaOrientadores();
    });
	
	function getListaOrientadores() {
		str = "option=getListaOrientadores";
	
		$.ajax({
		  type: "GET",
          url: 'restritoAdm.php', 
          data: str,
          success: function(data) {
              $("#listaOrientadores").append(data);
          }
		});
	}
 </script>
 
<?php
include("inc_rodape.php");
?>