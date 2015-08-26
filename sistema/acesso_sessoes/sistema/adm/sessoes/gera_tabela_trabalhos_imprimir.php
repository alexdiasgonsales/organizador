
<?php 
    
    $sql_colunas = "SELECT t.id_trabalho, t.titulo_ordenar FROM trabalho t 
    where t.status=2 ";
    $sql_trabalho=  $sql_colunas." order by id_trabalho;";

  $result_trabalho= mysql_query($sql_trabalho,$conexao);
  $num_reg_trabalho= mysql_num_rows($result_trabalho);

  $tematica = "";
  $modalidade = "";
  $status = "";
  $sessao = "";
  $i = $num_reg_trabalho;

  echo "<table><tr><td>ID</td><td>Título</td></tr>";
  
  while ($linha_trabalho= mysql_fetch_array($result_trabalho)) {
    echo "<tr><td></td></tr>";
  }
  echo "</table>";
  
?>
