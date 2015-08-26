<?php
session_start();

include("../../conexao.php");
include("../../funcoes.php");

$titulo = "Orientadores";
include("inc_cabecalho.php");

?>

<style type="text/css">
tr:hover {
	background: #CCDAB4;
}
</style>

 <div style="background-color:#CCDAB4;width:97%;height:18px;padding-top:5px;padding-left:10px;margin-top:25px;"> <label style="font-weight:bold;"> Orientadores Cadastrados: </label></div>
 <table id="listaOrientadores" name="listaOrientadores">
 <tr style="background-color:#CCDAB4;"> 
	<td>ID:</td>
	<td>Nome:</td>
	<td>Email:</td>
	<td>Campus:</td>
	<td>Instituição:</td>
 </tr>
 </table>

  <a href="home_restrito.php" class="link1" style="margin-left:10px;font-size:10px;text-decoration:underline;"> voltar </a>
 
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