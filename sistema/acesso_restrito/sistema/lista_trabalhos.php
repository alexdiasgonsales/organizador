<?php
session_start();

include("../conexao.php");
//include("funcoes_sessoes.php");
  
       $sql_colunas = "SELECT t.id_trabalho, upper(t.titulo_ordenar) as titulo_ordenar FROM trabalho t 
    where t.status=2 ";
    $sql_trabalho=  $sql_colunas." order by id_trabalho;";

  $result_trabalho= mysql_query($sql_trabalho,$conexao);
  $num_reg_trabalho= mysql_num_rows($result_trabalho);

  $tematica = "";
  $modalidade = "";
  $status = "";
  $sessao = "";
  $i = $num_reg_trabalho;

  echo "<h2>Clique no Título do Trabalho para baixar    o arquivo PDF</h2>";
  echo "<table border=1><tr><td>ID</td><td>Título</td></tr>";
  
  while ($linha_trabalho= mysql_fetch_array($result_trabalho)) {
    echo "<tr><td>".$linha_trabalho["id_trabalho"]."</td><td><a href='imprimir_trabalho.php?id_trabalho=".$linha_trabalho["id_trabalho"]."'>".$linha_trabalho["titulo_ordenar"]."</td></tr>";
  }
  echo "</table>";

?>
