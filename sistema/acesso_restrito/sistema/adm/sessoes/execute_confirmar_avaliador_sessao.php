<?php
session_start();

include("../../../conexao.php");
//include("../../../funcoes.php");

if(!(isset($_SESSION['id_administracao']))) {
    header("Location: index.php?diff=".elDiff());
}

if (!isset($_SESSION['adm2']))
   {
      header("Location: index.php?diff=".elDiff());
   }

$n_mens=0;
   
if (isset($_REQUEST['acao'])) 
   {
      $acao=$_REQUEST['acao'];

    if ($acao =="confirmar_avaliador") {
		  $fk_id_sessao=(int)$_REQUEST['fk_id_sessao'];
      $fk_id_avaliador=(int)$_REQUEST['fk_id_avaliador'];      
      $sql_avaliador = "update avaliador_sessao set status=1 where (fk_avaliador=".
                        $fk_id_avaliador.") and (fk_sessao = ".$fk_id_sessao.") ";
      $result_avaliador = mysql_query($sql_avaliador,$conexao);
		  $n_mens=8; // "Avaliador confirmado com sucesso" 
      
    }

    if ($acao =="desconfirmar_avaliador") {
		  $fk_id_sessao=(int)$_REQUEST['fk_id_sessao'];
      $fk_id_avaliador=(int)$_REQUEST['fk_id_avaliador'];
      $sql_avaliador = "update avaliador_sessao set status=2 where (fk_avaliador=".
                        $fk_id_avaliador.") and (fk_sessao = ".$fk_id_sessao.") ";
      $result_avaliador = mysql_query($sql_avaliador,$conexao);
		  $n_mens=8; // "Avaliador confirmado com sucesso" 
    }

   }//isset()
 
header("Location: sessoes_avaliadores.php?n_mens=".$n_mens);

?>
