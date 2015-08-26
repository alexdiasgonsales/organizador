<?php
session_start();

include("../../../conexao.php");
include("funcoes_sessoes.php");

if (!isset($_SESSION['id_administracao']))
   {
      header("Location: index.php");
   }

$titulo = "Sessões";

?>


<script language="javascript">
function abrir_sessao(id_sessao)
{
    //if (confirm('Abrir sessão?'))
	//   {
          self.open('abrir_sessao.php?id_sessao='+id_sessao+'&id_area=0&id_area_ava=0','_self');
	//   }
}
</script>
<style type="text/css">

td{
  width: auto;
  text-decoration:none; 
  font-size: 13px; 
  font-family: arial, helvetica, sans-serif;
  color: #000;
  border: 1px solid #CCDAB4;
  border-radius: 7px;
  padding: 6px;
}
tr:hover {
  background: #CCDAB4;
}
</style>
<?php
include("../inc_cabecalho.php");
?>

<br /><input type="button" value="Retornar à Área do Organizador" onclick="self.open('../../../../controller/ControllerLogin.php','_self')" class="button red"><br /><br />

<?php 
    
  $array_modalidade[0]  = "--";
  $array_modalidade[1]  = "O";
  $array_modalidade[2]  = "P";
    
  $sql_sessao= "SELECT * FROM sessao ORDER BY id_sessao ASC, nome ASC;";
  $result_sessao= mysql_query($sql_sessao,$conexao);
  $num_reg_sessao= mysql_num_rows($result_sessao);
  //$linha_sessao= mysql_fetch_array($result_sessao);
  echo "<table width=100% align='center'>";
  echo "<tr><td align='center' colspan='15' style='background: #CCDAB4'><h2>Sessões</h2></td></tr>";
  echo "<tr><td style='background: #CCDAB4'>&nbsp;<strong>ID:</strong></td><td style='background: #CCDAB4'>&nbsp;<strong>Num:</strong></td><td style='background: #CCDAB4'>&nbsp;<strong>Sala:</strong></td><td style='background: #CCDAB4'><strong>Mod.</strong></td><td style='background: #CCDAB4'>&nbsp;<strong>Data:</strong></td><td align=center style='background: #CCDAB4'><strong>Hora<br>Início</strong></td><td align=center style='background: #CCDAB4'><strong>Hora<br>Fim</strong></td><td align=center style='background: #CCDAB4'><strong>Qt.<br>Trabs.</strong></td><td align=center style='background: #CCDAB4'><strong>Qt.<br>Aval.</strong></td></tr>";
  while ($linha_sessao= mysql_fetch_array($result_sessao))
     {
       $sql_qnt_trabalhos = "SELECT t.id_trabalho from trabalho t where t.fk_sessao=".$linha_sessao['id_sessao'];
       $result_qnt_trabalhos = mysql_query($sql_qnt_trabalhos, $conexao);
       $qnt_trabalhos = mysql_num_rows($result_qnt_trabalhos);

       $sql_qnt_avaliadores = "SELECT avs.fk_sessao FROM avaliador_sessao avs where avs.fk_sessao=".$linha_sessao['id_sessao'];
       $result_qnt_avaliadores = mysql_query($sql_qnt_avaliadores, $conexao);
       $qnt_avaliadores = mysql_num_rows($result_qnt_avaliadores);
       
       echo "<tr><td>&nbsp;<a href='abrir_sessao.php?id_sessao=".$linha_sessao['id_sessao']."&id_area=0&id_area_ava=0'><a href='abrir_sessao.php?id_sessao=".$linha_sessao['id_sessao']."&id_area=0&id_area_ava=0'>".$linha_sessao['id_sessao']."</a></td><td>&nbsp;<a href='criar_sessao.php?acao=editar&id_sessao=".$linha_sessao['id_sessao']."'>".$linha_sessao['nome']."</a></td><td>&nbsp;".$linha_sessao['nome_sala']."</td><td align=center>".$array_modalidade[$linha_sessao['fk_modalidade']]."</td><td>&nbsp;".formata_data3($linha_sessao['data'])."</td><td>&nbsp;".formata_hora($linha_sessao['hora_ini'])."</td><td>&nbsp;".formata_hora($linha_sessao['hora_fim'])."</td><td align='center'>".$qnt_trabalhos."</td><td>".$qnt_avaliadores."</td></tr>";
       
       
       
       //<input type='button' value='Abrir' onclick='abrir_sessao(".$linha_sessao['id_sessao'].")' class='button blue'>
	 }
  echo "</table><br />";

  echo "<a href='criar_sessao.php?acao=criar' class='button blue'> Criar Sessão </a> <br> <br>";
        
        
  $_SESSION['adm2'] = true;
?>
</div>       
<?php
include("../inc_rodape.php");
?>
