<?php
session_start();

include("../../conexao.php");
include("../../funcoes.php");

$titulo = "Ouvintes";
include("inc_cabecalho.php");

?>

<style type="text/css">
tr:hover {
	background: #CCDAB4;
}
</style>

 <div style="background-color:#CCDAB4;width:97%;height:18px;padding-top:5px;padding-left:10px;margin-top:25px;"> <label style="font-weight:bold;"> Ouvintes Cadastrados: </label></div>
 <table id="listaOuvintes" name="listaOuvintes">
 <tr style="background-color:#CCDAB4;"> 
	<td width="120px;">ID:</td>
	<td width="327px;">Nome:</td>
	<td width="277px;">Email:</td>
 </tr>
 </table>

 <a href="home_restrito.php" class="link1" style="margin-left:10px;font-size:10px;text-decoration:underline;"> voltar </a>
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