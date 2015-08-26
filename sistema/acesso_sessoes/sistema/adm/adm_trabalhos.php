<?php
session_start();

include("../../conexao.php");
include("../../funcoes.php");

$titulo = "Trabalhos";

?>

<style type="text/css">

td{
  min-width: 30px;
  text-decoration:none;  
  font-size: 12px;
  font-family: arial, helvetica, sans-serif;
  color: #000;
  border: 1px solid #CCDAB4;
  padding: 4px;
  border-radius: 7px;
}
tr:hover {
	background: #CCDAB4;
}
</style>
<?php 
include("inc_cabecalho.php");
?>
<h1 align="center">Lista de Trabalhos</h1>

<h2>Dicas</h2>

<p>
Clique no cabeçalho das colunas para ordenar pelo campo de interesse.<br>
</p>

<p>
 Mod. = Modalidade (O=Oral, P=Pôster)<br>
 Cat. = Categoria (P=Pesquisa, E=Experiência, R=Revisão de Literatura/Ensaio)<br>
</p>

 
 <br /><br /><div style="background-color:#CCDAB4;width:auto;height:18px; font-size: 14px; padding: 4px; border-radius: 7px; text-align: center;"> <label style="font-weight:bold;"> Trabalhos Cadastrados: </label></div>
 <table id="listaTrabalhos" name="listaTrabalhos" width="auto">
    <tr style="background-color:#CCDAB4;" align="center"> 
        <td width="auto" style="text-decoration:none; font-size: 14px; font-family: arial, helvetica, sans-serif; font-weight: bold; color: #000;"><a href="adm_trabalhos.php?ordem=1" style="text-decoration: none; color: #000;" >ID:</a></td>
		<td width="auto" style="text-decoration:none; font-size: 14px; font-family: arial, helvetica, sans-serif; font-weight: bold; color: #000;"><a href="adm_trabalhos.php?ordem=2" style="text-decoration: none; color: #000;" >Título:</a></td>
		<td width="auto" style="text-decoration:none; font-size: 14px; font-family: arial, helvetica, sans-serif; font-weight: bold; color: #000;"><a href="adm_trabalhos.php?ordem=3" style="text-decoration: none; color: #000;" >Status:</a></td>
		<td width="auto" style="text-decoration:none; font-size: 14px; font-family: arial, helvetica, sans-serif; font-weight: bold; color: #000;"><a href="adm_trabalhos.php?ordem=4" style="text-decoration: none; color: #000;" >Responsável<br>(Comissão):</a></td>
		<td width="auto" style="text-decoration:none; font-size: 14px; font-family: arial, helvetica, sans-serif; font-weight: bold; color: #000;"><a href="adm_trabalhos.php?ordem=5" style="text-decoration: none; color: #000;" >Área:</a></td>
		<td width="auto" style="text-decoration:none; font-size: 14px; font-family: arial, helvetica, sans-serif; font-weight: bold; color: #000;"><a href="adm_trabalhos.php?ordem=6" style="text-decoration: none; color: #000;" title="Modalidade">Mod.:</a></td>
		<td width="auto" style="text-decoration:none; font-size: 14px; font-family: arial, helvetica, sans-serif; font-weight: bold; color: #000;"><a href="adm_trabalhos.php?ordem=7" style="text-decoration: none; color: #000;" title="Categoria">Cat.:</a></td>
		<td width="auto" style="text-decoration:none; font-size: 14px; font-family: arial, helvetica, sans-serif; font-weight: bold; color: #000;"><a href="adm_trabalhos.php?ordem=8" style="text-decoration: none; color: #000;" >Autor:</a></td>
		<td width="auto" style="text-decoration:none; font-size: 14px; font-family: arial, helvetica, sans-serif; font-weight: bold; color: #000;"><a href="adm_trabalhos.php?ordem=9" style="text-decoration: none; color: #000;" title="Orientador">Orient.:</a></td>
		<td width="auto" style="text-decoration:none; font-size: 14px; font-family: arial, helvetica, sans-serif; font-weight: bold; color: #000;"><a href="adm_trabalhos.php?ordem=10" style="text-decoration: none; color: #000;" >Curso</a></td>
		<td width="auto" style="text-decoration:none; font-size: 14px; font-family: arial, helvetica, sans-serif; font-weight: bold; color: #000;"><a href="adm_trabalhos.php?ordem=11" style="text-decoration: none; color: #000;" >Campus</a></td>
		<td width="auto" style="text-decoration:none; font-size: 14px; font-family: arial, helvetica, sans-serif; font-weight: bold; color: #000;"><a href="adm_trabalhos.php?ordem=12" style="text-decoration: none; color: #000;" >Instituição</a></td>
		<td width="auto" style="text-decoration:none; font-size: 14px; font-family: arial, helvetica, sans-serif; font-weight: bold; color: #000;"> Ação </td>
    </tr>
 </table>

 <br /><br /> <a href="home_restrito.php" class="button red" >Voltar </a>

 </div>
   <script>
	$(document).ready(function() {
		getListaTrabalhos(<?php if (isset($_GET["ordem"])) echo $_GET["ordem"]; else echo 5; ?>);
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