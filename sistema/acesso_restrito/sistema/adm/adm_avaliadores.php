<?php
session_start();

include("../../conexao.php");

$titulo = "Avaliadores";
include("inc_cabecalho.php");

?>

<style type="text/css">
tr:hover {
	background: #CCDAB4;
}
</style>

<div id="divSombraAdm" style="width:100%; height:160%; position:fixed; top:0px; left:0px; z-index: 49; background: black; opacity: 0.7; display:none;"></div>	

<div id="detalhar_avaliador" style="position:fixed; left:25%; top:150px; border:1px dotted black; background:white; z-index: 50; width:550px; height:400px; border-radius: 10px; padding-left:10px; display:none;scroll:auto;">
</div>

<h1>Lista de Avaliadores</h1>

<h2>Dicas</h2>
<p>
Clique no cabeçalho das colunas para ordenar pelo campo de interesse (sugestão: Inst./Camp.)<br>
A coluna "Sit" mostra a situação do avaliador (Pendente, Aceito, Recusado)<br>
Na coluna aceitar (à esquerda) marque/desmarque as caixas para aceitar/recusar o avaliador respectivamente.<br>
Cuidado para não marcar/desmarcar por engano.<br>
Para confirmar a operação, vá até o final da página e clique no botão Ações em Massa.<br><br>

Para aceitar/recusar individualmente apenas um avaliador, clique nos links AC. REC. (colunas á direita).
</p>

 <div style="background-color:#CCDAB4;width:97%;height:18px;padding-top:5px;padding-left:10px;margin-top:25px;"> <label style="font-weight:bold;"> Avaliadores Cadastrados: </label></div>
 <form method="get" action="restritoAdm.php">
 <input type="hidden" name="option" id="option" value="aceitaAvaliadoresEmMassa">
 <table id="listaAvaliadores" name="listaAvaliadores">
 <tr style="background-color:#CCDAB4;"> 
	<td>Aceitar: </td>
	<td><a href="adm_avaliadores.php?ordem=1">ID:</a></td>
	<td width="200"><a href="adm_avaliadores.php?ordem=2">Nome:</a></td>
	<td><a href="adm_avaliadores.php?ordem=3">Email:</a></td>
	<!--   <td><a href="adm_avaliadores.php?ordem=4">Campus:</a></td>  -->
	<td><a href="adm_avaliadores.php?ordem=5">Inst./Camp.</a></td>
	<td>Tip.</td>
        <td><a href="adm_avaliadores.php?ordem=6">Sit.</a></td>
    <td> </td>
    <td> </td>
    <td width="100">Areas:</td>
    <td>Sessões</td>
 </tr>
 </table>
<input type="submit" value="açoes em massa" style="margin-top:20px;" />  
<button type="button" onclick="window.location='home_restrito.php'" style="margin-top:20px;">voltar</button> 
 <!-- <a href="restritoAdm.php?option=aceitaAvaliadoresEmMassa" class="link1" style="margin-left:10px;font-size:10px;text-decoration:underline;"> ações em massa: aceitar </a>
 <a href="home_restrito.php" class="link1" style="margin-left:10px;font-size:10px;text-decoration:underline;"> voltar </a>-->
 </form>


  
  
  <script>
	$(document).ready(function() {
        getListaAvaliadores(<?php if (isset($_GET["ordem"])) echo $_GET["ordem"]; else echo 1; ?>);
    });
	
	function getListaAvaliadores(ordem) {
        var str = new Array();
		str.push("option=getListaAvaliadores");
        str.push("ordem="+ordem);
	
		$.ajax({
		  type: "GET",
          url: 'restritoAdm.php',
          data: str.join("&"),          
          success: function(data) {
              $("#listaAvaliadores").append(data);
          }
		});
	}
	
	function detalha_avaliador(id) {
		var str = new Array();
		str.push("option=detalhar_avaliador");
		str.push("id_avaliador="+id);
		
		$.ajax({
		  type: "GET",
          url: 'restritoAdm.php', 
          data: str.join("&"),
          success: function(data) {
			$("#detalhar_avaliador").append(data);
			$("#divSombraAdm").show();
			$("#detalhar_avaliador").show();
		  }
		 });
	}
	
	function voltar() {
		$("#divSombraAdm").hide();
		$("#detalhar_avaliador").hide();
		location.reload();
	}
	
	/*function aceitarEmMassa() {
		var form = $("form").serialize();
		var str = new Array();
		str.push("option=aceitaAvaliadoresEmMassa");
		str.push(form);
		alert(form);
		alert(str);
		
		$.ajax({
		  type: "POST",
          url: 'restritoAdm.php', 
          data: str.join("&"),
          success: function(data) {
			alert('chega aquiiiiii');
			alert(data);
			 location.reload();
          }
		});
	}*/
	
	function aceitaAvaliador(id) {
        if (confirm('Tem certeza que deseja aceitar o avaliador?')) {
            var str = new Array();
            str.push("option=aceitaAvaliador");
            str.push("id_avaliador="+id);

            $.ajax({
                type: "POST",
                url: 'restritoAdm.php', 
                data: str.join("&"),
                success: function(data) {
                //alert(data);
                location.reload();
                }
            });
        }
	}
	
		function recusaAvaliador(id) {
        if (confirm('Tem certeza que deseja recusar o avaliador?')) {
            var str = new Array();
            str.push("option=recusaAvaliador");
            str.push("id_avaliador="+id);

            $.ajax({
                type: "POST",
                url: 'restritoAdm.php', 
                data: str.join("&"),
                success: function(data) {
                //alert(data);
                location.reload();
                }
            });
        }
	}
 </script>
 
<?php
include("inc_rodape.php");
?>