<?php
session_start();

include("../../conexao.php");
include("../../funcoes.php");


?>

<style type="text/css">

td{
  text-decoration:none;  
  font-size: 12px;
  font-family: arial, helvetica, sans-serif; 
  color: #000;
  padding: 3px;
  border-radius: 7px;
  border: 1px solid #CCDAB4;
  text-align: center;
}
tr{
  background-color: #FFF;
}
tr:hover {
	background: #CCDAB4;
}
</style>
<?php 
include("inc_cabecalho.php");
?>
 <br /><br /><div align="center" style="background-color:#CCDAB4;width:auto;height:18px;padding: 3px; border-radius: 7px; text-align: center"> <label width="auto" style="text-decoration:none; text-align: center; font-size: 14px; font-family: arial, helvetica, sans-serif; font-weight: bold; color: #000;"> Voluntários Cadastrados: </label></div>
 <table id="listaVoluntarios" name="listaVoluntarios" width="auto">
 <tr style="background-color:#CCDAB4;" align="center"> 
    <td align="center" width="15px" style="font-size: 12px; font-weight: bold">ID:</td>
    <td align="center" width="auto" style="font-size: 12px; font-weight: bold">Nome:</td>
    <td align="center" width="auto" style="font-size: 12px; font-weight: bold">Email:</td>
    <td align="center" width="auto" style="font-size: 12px; font-weight: bold">Inst.</td>
    <td align="center" width="auto" style="font-size: 12px; font-weight: bold">Câmpus:</td>
    <td align="center" width="auto" style="font-size: 12px; font-weight: bold">Curso:</td>
    <td align="center" width="auto" style="font-size: 12px; font-weight: bold">Fone </td>
    <td align="center" width="auto" style="font-size: 12px; font-weight: bold">Manhã</td>
    <td align="center" width="auto" style="font-size: 12px; font-weight: bold">Tarde</td>
    <td align="center" width="auto" style="font-size: 12px; font-weight: bold">Noite</td>
    <td align="center" width="auto" style="font-size: 12px; font-weight: bold" title="Aceitar/Recusar">Ac./Rec.</td>
    <td align="center" width="auto" style="font-size: 12px; font-weight: bold" title="Presença">Pres.</td>
 </tr>
 </table>

  <br /><br /><a href="home_restrito.php" class="button red" > Voltar </a>
  </div>
 
   <script>
	$(document).ready(function() {
		getListaVoluntarios();
                
    });
	
	function getListaVoluntarios() {
		str = "option=getListaVoluntarios";
	
		$.ajax({
		  type: "GET",
          url: 'restritoAdm.php', 
          data: str,
          success: function(data) {
              $("#listaVoluntarios").append(data);
          }
		});
	}
        
        function alteraStatusVoluntario(id,opcao) {
                    
            if (confirm("Tem certeza que deseja "+opcao+" o voluntário?")) {
              var str = new Array(); 
              
              str.push("option=alteraStatusVoluntario");
              str.push("id_voluntario="+id);
              str.push("optionVoluntario="+opcao);

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
        
          function alteraPresencaVoluntario(id,opcao) {
                    
            if (confirm("Tem certeza que deseja "+opcao+" presença para o voluntário?")) {
              var str = new Array(); 
              
              str.push("option=alteraPresencaVoluntario");
              str.push("id_voluntario="+id);
              str.push("optionVoluntario="+opcao);

              $.ajax({
                    type: "POST",
                    url: 'restritoAdm.php', 
                    data: str.join("&"),
                    success: function(data) {
                    location.reload();
                    }
              });
            }
          }
 </script>
 
<?php
include("inc_rodape.php");
?>