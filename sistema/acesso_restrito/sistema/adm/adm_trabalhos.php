<?php
session_start();

include("../../conexao.php");
include("../../funcoes.php");

$titulo = "Trabalhos";
include("inc_cabecalho.php");


if(!(isset($_SESSION["id_administracao"])))
	header("Location: index.php");

?>

<style type="text/css">
tr:hover {
	background: #CCDAB4;
}
</style>

<h1>Lista de Trabalhos</h1>

<h2>Dicas</h2>

<p>
Clique no cabeçalho das colunas para ordenar pelo campo de interesse.<br>
</p>

<p>
 M = Modalidade (O=Oral, P=Pôster)<br>
 C = Categoria (P=Pesquisa, E=Experiência, R=Revisão de Literatura/Ensaio)<br>
</p>

 <div style="background-color:#CCDAB4;width:97%;height:18px;padding-top:5px;padding-left:10px;margin-top:25px;"> <label style="font-weight:bold;"> Trabalhos Cadastrados: </label></div>
 <table id="listaTrabalhos" name="listaTrabalhos" width="900">
    <tr style="background-color:#CCDAB4;"> 
        <td><a href="adm_trabalhos.php?ordem=1">ID:</a></td>
	<td width="300"><a href="adm_trabalhos.php?ordem=2">Título:</a></td>
	<td width="50"><a href="adm_trabalhos.php?ordem=3">Status:</a></td>
	<td><a href="adm_trabalhos.php?ordem=4">Responsável<br>(Comissão):</a></td>
	<td><a href="adm_trabalhos.php?ordem=5">Área:</a></td>
	<td><a href="adm_trabalhos.php?ordem=6">M:</a></td>
	<td><a href="adm_trabalhos.php?ordem=7">C:</a></td>
	<td><a href="adm_trabalhos.php?ordem=8">Aut.:</a></td>
	<td><a href="adm_trabalhos.php?ordem=9">Ori.:</a></td>
        <td><a href="adm_trabalhos.php?ordem=10">Curso</a></td>
        <td><a href="adm_trabalhos.php?ordem=11">Campus</a></td>
        <td><a href="adm_trabalhos.php?ordem=12">Instituicao</a></td>
	<td> --- </td>
    </tr>
 </table>
 
  <a href="../../../controller/ControllerLogin.php" class="link1"> Voltar </a>
 
   <script>
	$(document).ready(function() {
		getListaTrabalhos(<?php if (isset($_GET["ordem"])) echo $_GET["ordem"]; else echo 1; ?>);
		//ordena(1);
    });
	
	function getListaTrabalhos(ordem) {
		//str = "option=getListaTrabalhos";
		
		var str = new Array();
		str.push("option=getListaTrabalhos");
        str.push("ordem="+ordem);
		
		$.ajax({
		  type: "GET",
          url: 'restritoAdm.php', 
          data: str.join("&"),
          success: function(data) {        
              //alert(data);
              $("#listaTrabalhos").append(data);
             
          }
		});
	}

	function ordena(ordem) {
	    $("#listaTrabalhos").append("restritoAdm.php?option=getListaTrabalhos&ordem=1");
		exit;
		
		var str = new Array();
		str.push("option=getListaTrabalhos");
        str.push("ordem="+ordem);
	
		$.ajax({
		  type: "GET",
          url: 'restritoAdm.php', 
          data: str.join("&"),
          success: function(data) {
              $("#listaTrabalhos").innerHTML(data);
          }
		});
	}
	
 </script>
 
<?php
include("inc_rodape.php");
?>