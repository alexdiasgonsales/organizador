﻿<?php
session_start();

include("../../../conexao.php");
include("funcoes_sessoes.php");

if(!(isset($_SESSION['id_administracao']))) {
    header("Location: index.php?diff=".elDiff());
}
 
if (!isset($_SESSION['adm2']))
   {
    //  header("Location: index.php?diff=".elDiff());
   }

   $sql = "SELECT s.id_sessao, s.nome, t.id_trabalho, t.titulo_ordenar, 
av.fk_usuario as id_avaliador, u.nome as nome_avaliador
    FROM trabalho t 
    INNER JOIN sessao s ON s.id_sessao = t.fk_sessao 
    INNER jOIN avaliador_sessao avs ON avs.fk_sessao = s.id_sessao 
    INNER JOIN avaliador av ON av.fk_usuario = avs.fk_avaliador
    INNER JOIN usuario u ON av.fk_usuario = u.id_usuario
    order by s.id_sessao, avs.seq, t.id_trabalho";

  $result_sql= mysql_query($sql,$conexao);
  $num_reg= mysql_num_rows($result_sql);

  $tematica = "";
  $modalidade = "";
  $status = "";
  $sessao = "";
  $i = $num_reg;

  //while ($linha= mysql_fetch_array($result_sql)) {
  //echo "<br>".$linha["id_sessao"];
 // }
  include 'inc_cabecalho.php';
  echo "<h2>Clique no link para imprimir a ficha de avaliação</h2><br />";
  
  //echo "<a href = 'imprimir_todas_fichas_avaliacao.php' class='button blue' target='_blank'> Imprimir todas as Fichas </a>";
?>
<br /><input type="button" value="Retornar à Área do Organizador" onclick="self.open('../../../../controller/ControllerLogin.php','_self')" class="button red"><br /><br />
<?php
  echo "<table border=1 width=100%>";
  
  $num_sessao = "0";
  while ($linha= mysql_fetch_array($result_sql)) {
    if ($num_sessao <> $linha["id_sessao"]) {
    $num_sessao = $linha["id_sessao"];
    echo "<tr><td colspan=5 align=center><b>Sessão ".$linha["nome"]."</b></td></tr>";
    echo "<tr><td>Sessao</td><td>ID trabalho</td><td width='200'>Título trabalho</td><td>ID Avaliador</td><td width=300>Nome Avaliador</td></tr>";
    }
    echo "<tr><td>".$linha["nome"]."</td><td>".$linha["id_trabalho"]."</td><td>".$linha["titulo_ordenar"]."</td><td>".$linha["id_avaliador"]."</td><td><a href='imprimir_ficha_avaliacao.php?id_sessao=".$linha["id_sessao"]."&id_trabalho=".$linha["id_trabalho"]."&id_avaliador=".$linha["id_avaliador"]."' target='_blank'>".$linha["nome_avaliador"]."</a></td></tr>";
  }
  echo "</table></div>";
  include 'inc_rodape.php';

?>
