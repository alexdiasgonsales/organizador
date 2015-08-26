<?php
session_start();

include("../../conexao.php");
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
<div id="divSombraAdm" style="width:auto; height:auto; position:fixed; top:0px; left:0px; z-index: 49; background: black; opacity: 0.7; display:none;"></div>	

<div id="detalhar_avaliador" style="position:fixed; left:25%; top:150px; border:1px dotted black; background:white; z-index: 50; width:auto; height:auto; border-radius: 10px; padding-left:10px; display:none;scroll:auto;">
</div>

<h1 align="center">Lista de Avaliadores</h1>

<h2>Dicas</h2>
<p>
Clique no cabeçalho das colunas para ordenar pelo campo de interesse (sugestão: Inst./Camp.)<br>
A coluna "Sit" mostra a situação do avaliador (Pendente, Aceito, Recusado)<br>
Na coluna aceitar (à esquerda) marque/desmarque as caixas para aceitar/recusar o avaliador respectivamente.<br>
Cuidado para não marcar/desmarcar por engano.<br>
Para confirmar a operação, vá até o final da página e clique no botão <b>Ações em Massa.</b><br><br>

Para aceitar/recusar individualmente apenas um avaliador, clique nos links AC. REC. (colunas á direita).
</p>

 <div align="center" style="background-color:#CCDAB4; width:auto;padding: 6px; border-radius: 7px; text-align: center;"> 
 	<label width="auto" style="text-decoration:none; text-align: center; font-size: 14px; font-family: arial, helvetica, sans-serif; font-weight: bold; color: #000;"> Avaliadores Cadastrados: </label>
 </div>

 <form method="get" action="restritoAdm.php">
 <input type="hidden" name="option" id="option" value="aceitaAvaliadoresEmMassa">

 <table id="listaAvaliadores" name="listaAvaliadores" width="auto">
 <tr style="background-color:#CCDAB4;" width="auto"> 
	<td width="auto" style="font-weight: bold; ">Aceitar: </td>
	<td width="auto" style="font-weight: bold; "><a href="adm_avaliadores.php?ordem=1" style="text-decoration: none; color: #000;" >ID:</a></td>
	<td width="auto" style="font-weight: bold; "><a href="adm_avaliadores.php?ordem=2" style="text-decoration: none; color: #000;" >Nome:</a></td>
	<td width="auto" style="font-weight: bold; "><a href="adm_avaliadores.php?ordem=3" style="text-decoration: none; color: #000;" >Email:</a></td>
	<!--   <td width="auto"><a href="adm_avaliadores.php?ordem=4" style="text-decoration: none; color: #000;" >Campus:</a></td>  -->
	<td width="auto" style="font-weight: bold; "><a href="adm_avaliadores.php?ordem=5"  style="text-decoration: none; color: #000;" title="Instituição / Campus">Inst./Camp.</a></td>
	<td width="auto" style="font-weight: bold; "><a href="adm_avaliadores.php?ordem=6"  style="text-decoration: none; color: #000;" title="Situação">Sit.</a></td>
    <td width="auto" style="font-weight: bold; ">Aceitar </td>
    <td width="auto" style="font-weight: bold; ">Recusar </td>
    <td width="auto" style="font-weight: bold; ">Areas:</td>
    <td width="auto" style="font-weight: bold; ">Sessões</td>
 </tr>
 </table>
<input type="submit" value="Açoes em Massa" class="button blue"/>  
<br /><br /><button type="button" onclick="window.location='home_restrito.php'" class="button red" >Voltar</button> 
 <!-- <a href="restritoAdm.php?option=aceitaAvaliadoresEmMassa" class="button blue" style="margin-left:10px;font-size:10px;text-decoration:underline;"> ações em massa: aceitar </a>
 <a href="home_restrito.php" class="button gray" style="margin-left:10px;font-size:10px;text-decoration:underline;"> voltar </a>-->
 </form>

</div>
  
  
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