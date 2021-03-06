﻿<?php
session_start();

include("../../../conexao.php");
include("funcoes_sessoes.php");

if(!(isset($_SESSION['id_administracao']))) {
    header("Location: index.php?diff=".elDiff());
}

$titulo = "SA (Sessões e Avaliadores)";
include("../inc_cabecalho.php");
?>


<script language="javascript">
function confirmar_avaliador(id_sessao, id_avaliador)
{
    if (confirm('Confirmar avaliador na sessão?'))
	   {
          self.open('execute_confirmar_avaliador_sessao.php?acao=confirmar_avaliador&fk_id_sessao='+id_sessao+'&fk_id_avaliador='+id_avaliador+'&diff=<?php echo elDiff(); ?>','_self');
	   }
}

function desconfirmar_avaliador(id_sessao, id_avaliador)
{
    if (confirm('Desconfirmar avaliador na sessão?'))
	   {
          self.open('execute_confirmar_avaliador_sessao.php?acao=desconfirmar_avaliador&fk_id_sessao='+id_sessao+'&fk_id_avaliador='+id_avaliador+'&diff=<?php echo elDiff(); ?>','_self');
	   }
}


function enviar_email_avaliadores_pendentes() {
    if (confirm('Enviar email?'))
	   {
          self.open('execute_enviar_email_avaliadores_pendentes.php?acao=enviar_email&diff=<?php echo elDiff(); ?>','_self');
	   }

}

</script>

<input type="button" value="Início" onclick="self.open('../home_restrito.php','_self')" style="width:160px">

<?php 
    
  $array_modalidade[0]  = "---";
  $array_modalidade[1]  = "O";
  $array_modalidade[2]  = "P";
  
  $array_confirmado[0] = "x";
  $array_confirmado[1] = "SIM";
  $array_confirmado[2] = "NÃO";
  
  $sql_sessao= "SELECT s.id_sessao, s.nome AS nome_sessao, s.nome_sala, s.data, s.hora_ini, s.hora_fim, 
      s.sala, s.fk_modalidade, avs.status, avs.fk_avaliador, avs.seq, u.nome AS nome_avaliador 
	  FROM sessao s LEFT JOIN avaliador_sessao avs ON avs.fk_sessao=s.id_sessao 
      LEFT JOIN avaliador a ON a.fk_usuario=avs.fk_avaliador
      LEFT JOIN usuario u ON u.id_usuario = a.fk_usuario ORDER BY s.id_sessao, avs.seq";
  $result_sessao= mysql_query($sql_sessao,$conexao);
  $num_reg_sessao= mysql_num_rows($result_sessao);
  echo mysql_error();
  
  //$linha_sessao= mysql_fetch_array($result_sessao);
  echo "<table border=1 width=100% align='center'>";
  echo "<tr><td align='center' colspan='10'><h2>Sessões e Avaliadores</h2></td></tr>";
  echo "<tr><td>&nbsp;<strong>ID</strong></td><td>&nbsp;<strong>Num</strong></td><td><strong>Sala</strong></td><td><strong>Mod.</strong></td><td>&nbsp;<strong>Data:</strong></td><td>&nbsp;<strong>Hora<br>Início</strong></td><td><strong>Hora<br>Fim</strong></td><td align=center>&nbsp;<strong>Avaliador<br>ID - Nome</strong></td><td colspan=3 align=center>Confirmação</td></tr>";
  while ($linha_sessao= mysql_fetch_array($result_sessao))
     {
       echo "<tr><td><a href='abrir_sessao.php?id_sessao=".$linha_sessao['id_sessao']."&id_area=0&id_area_ava=0'>".$linha_sessao['id_sessao']."</a></td><td>&nbsp;<strong>".$linha_sessao['nome_sessao']."</strong></td><td>".$linha_sessao['nome_sala']."</td><td align=center>".$array_modalidade[$linha_sessao['fk_modalidade']]."</td><td>&nbsp;".formata_data3($linha_sessao['data'])."</td><td>&nbsp;".formata_hora($linha_sessao['hora_ini'])."</td><td>&nbsp;".formata_hora($linha_sessao['hora_fim'])."</td>";
       
       if ($linha_sessao['fk_avaliador'] > 0 ) {
        echo "<td>(".$linha_sessao['seq'].") ".$linha_sessao['fk_avaliador']." - ".$linha_sessao['nome_avaliador']."</td><td>".$array_confirmado[$linha_sessao['status']]."</td><td align='center'>&nbsp;<input type='button' value='Sim' onclick='confirmar_avaliador(".$linha_sessao['id_sessao'].",".$linha_sessao['fk_avaliador'].")'></td><td align='center'>&nbsp;<input type='button' value='Não' onclick='desconfirmar_avaliador(".$linha_sessao['id_sessao'].",".$linha_sessao['fk_avaliador'].")'></td></tr>";
       }
       else {
        echo "<td></td><td></td><td></td></tr>";
       }
      
	 }
  echo "</table><br />";
  
  $_SESSION['adm2'] = true;
?>


<?php
include("../inc_rodape.php");
?>
