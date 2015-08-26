<?php
session_start();

include("../../../conexao.php");
include("funcoes_sessoes.php");

if(!(isset($_SESSION['id_administracao']))) {
    header("Location: index.php?");
}
 
if (!isset($_SESSION['adm2']))
   {
    //  header("Location: index.php?diff=".elDiff());
   }

       $sql_colunas = "SELECT t.id_trabalho, upper(t.titulo_ordenar) as titulo_ordenar FROM trabalho t 
    where t.status=4 ";
    $sql_trabalho=  $sql_colunas." order by id_trabalho;";

  $result_trabalho= mysql_query($sql_trabalho,$conexao);
  $num_reg_trabalho= mysql_num_rows($result_trabalho);

  $tematica = "";
  $modalidade = "";
  $status = "";
  $sessao = "";
  $i = $num_reg_trabalho;
  include 'inc_cabecalho.php';
  ?>
  <!-- input type="button" value="Retornar à Área do Organizador" onclick="self.open('../../../../controller/ControllerLogin.php','_self')" class="button red" --><br /><br />
<?php
  
  
  /*
  echo "<br /><a href = 'listar_trabalhos.php' class='button blue' target='_blank'> Listar Todos os Trabalhos em PDF </a><br />";
  
  echo "<br /><a href = 'imprimir_todos_trabalhos.php' class='button blue' target='_blank'> Salvar um Arquivo PDF com Todos os Trabalhos </a><br />";
  */
  echo "<br /><a href = 'imprimir_todos_trabalhos_individuais.php' class='button blue' target='_blank'> Salvar Todos os Trabalhos em Arquivos PDFs Individuais (NÃO USAR!!!)</a>";
  
	
  echo "<h2>Clique no Título do Trabalho para baixar o arquivo PDF</h2>";
  echo "<table border=1 border-color='#000' width='100%'><tr><td>ID</td><td>Título</td></tr>";
  
  while ($linha_trabalho= mysql_fetch_array($result_trabalho)) {
    echo "<tr><td>".$linha_trabalho["id_trabalho"]."</td><td><a href='imprimir_trabalho.php?id_trabalho=".$linha_trabalho["id_trabalho"]."' target='_blank'>".$linha_trabalho["titulo_ordenar"]."</td></tr>";
  }
  echo "</table></div>";
  include 'inc_rodape.php';

?>
