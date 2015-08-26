<?php
session_start();

include("../../conexao.php");
include("../../funcoes.php");

include("inc_cabecalho.php");

?>

<style type="text/css">
tr:hover {
	background: #CCDAB4;
}
</style>

 <div style="background-color:#CCDAB4;width:97%;height:18px;padding-top:5px;padding-left:10px;margin-top:25px;"> <label style="font-weight:bold;"> Voluntários Cadastrados: </label></div>
 <table id="listaVoluntarios" name="listaVoluntarios">
 <tr style="background-color:#CCDAB4;"> 
    <td>ID:</td>
    <td>Nome:</td>
    <td>Email:</td>
    <td>Inst.</td>
    <td>Câmpus:</td>
    <td>Curso:</td>
    <td>Tel</td>
    <td>Tel</td>
    <td>Tel</td>
    <td>Manhã</td>
    <td>Tarde</td>
    <td>Noite</td>
    <td>Ac./Rec.</td>
    <td>Presença</td>
 </tr>
 </table>

  <a href="home_restrito.php" class="link1" style="margin-left:10px;font-size:10px;text-decoration:underline;"> voltar </a>
 
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