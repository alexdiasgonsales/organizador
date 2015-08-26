<?php
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

  if (isset($_REQUEST['ordenar']))
    $ordenar = $_REQUEST['ordenar'];
  else if (isset($_SESSION['ordenar']))
    $ordenar = $_SESSION['ordenar'];
  else
    $ordenar = "sessao_agrupada"; 

$_SESSION['ordenar'] = $ordenar;

  $colunas[0] = "col_id";
  $colunas[1] = "col_tematica";
  $colunas[2] = "col_modalidade";
  $colunas[3] = "col_status";
  $colunas[4] = "col_sessao";
  $colunas[5] = "col_autor_principal";
  $colunas[6] = "col_coautores";
  $colunas[7] = "col_orientadores";
  $colunas[8] = "col_avaliadores";
      
  for($i = 0; $i < count($colunas); $i++) {
    if (isset($_REQUEST[$colunas[$i]]))
      $$colunas[$i] = $_REQUEST[$colunas[$i]];
    else if (isset($_SESSION[$colunas[$i]]))
      $$colunas[$i] = $_SESSION[$colunas[$i]];
    //else
     // $$colunas[$i] = $colunas[0];
  }

  /*
  for($i = 0; $i < count($colunas); $i++) {
    if (isset($_REQUEST[$colunas[$i]]))
       $_SESSION[$colunas[$i]] = $$colunas[$i];
  }
*/

  $col_id              = "col_id";
  /*$col_tematica        = "col_tematica";
  $col_modalidade      = "col_modalidade";
  $col_status          = "col_status";
  $col_sessao          = "col_sessao";
  $col_autor_principal = "col_autor_principal";
  $col_coautores       = "col_coautores";
  $col_orientadores    = "col_orientadores";
*/
?>

<?php
$titulo = "Lista, trabalhos sessões";
include("../inc_cabecalho.php");
?>

<br>
<br>

<form name=trabalho method=post action="lista.php">

Dados:
<input type='checkbox' name='col_id' value='id'       <?php if (isset($col_id)) echo " checked"; ?> >ID
<input type='checkbox' name='col_tematica' value='tematica' <?php if (isset($col_tematica)) echo " checked"; ?> >Área 
<input type='checkbox' name='col_modalidade' value='modalidade'       <?php if (isset($col_modalidade)) echo " checked"; ?> >Modalidade
<input type='checkbox' name='col_status' value='status' <?php if (isset($col_status)) echo " checked"; ?> >Status
<input type='checkbox' name='col_sessao' value='sessao' <?php if (isset($col_sessao)) echo " checked"; ?> >Sessão

<input type='checkbox' name='col_autor_principal' value='col_autor_principal' <?php if (isset($col_autor_principal)) echo " checked"; ?> >Autor Principal

<input type='checkbox' name='col_coautores' value='col_coautores' <?php if (isset($col_coautores)) echo " checked"; ?> >Co-autores

<input type='checkbox' name='col_orientadores' value='col_orientadores' <?php if (isset($col_orientadores)) echo " checked"; ?> >Orientadores

<input type='checkbox' name='col_avaliadores' value='col_avaliadores' <?php if (isset($col_avaliadores)) echo " checked"; ?> >Avaliadores

<br><br>

Ordenar por:
<input type='radio' name='ordenar' value='id'       <?php if ($ordenar=='id') echo " checked"; ?> >ID
<input type='radio' name='ordenar' value='tematica' <?php if ($ordenar=='tematica') echo " checked"; ?> >Área 
<input type='radio' name='ordenar' value='modalidade' <?php if ($ordenar=='modalidade') echo " checked"; ?> >Modalidade
<input type='radio' name='ordenar' value='titulo' <?php if ($ordenar=='titulo') echo " checked"; ?> >Título
<input type='radio' name='ordenar' value='sessao' <?php if ($ordenar=='sessao') echo " checked"; ?> >Sessão
<input type='radio' name='ordenar' value='sessao_agrupada' <?php if ($ordenar=='sessao_agrupada') echo " checked"; ?> >Sessão Agrupada

<?php
/*
  echo "<input type='radio' name='ordenar' value='id' ";
    if ($ordenar=='id') echo " checked";
    echo ">ID";

  echo "<input type='radio' name='ordenar' value='tematica' ";
    if ($ordenar=='tematica') echo " checked";
  echo ">Temática";
*/
?>

<br>
<input type=submit value="Pesquisar"><br>

<!--
<input type="button" value="Validar CPF" onclick="self.open('val_cpf.php','_self')" style="width:120px;<?php if($_SESSION['id_administracao']<100) echo "display:inline"; else echo"display:none";?>">
-->

<!--
<input type="button" value="Ouvintes" onclick="self.open('ouvintes.php','_self')" style="width:80px">
-->

<!--
<input type="button" value="Sessões" onclick="self.open('sessoes.php','_self')">

<input type="button" value="Sessões e Avaliadores" onclick="self.open('sessoes_avaliadores.php','_self')">
-->

<!--input type="button" value="Lista 2" onclick="self.open('lista2.php?','_self')" style="width:120px"-->

<input type="button" value="Imprimir" onclick="self.open('imprimir_sessoes.php?acao=imprimir','_self')" style="width:120px">

<!--input type="button" value="Imprimir" onclick="window.open('imprimir_sessoes.php,'','')"  style="width:120px"-->

<!--input type="button" value="Gerar PDFs..." onclick="self.open('imprimir_trabalhos.php','_self')" style="width:120px"-->

<!--input type="button" value="Imprimir Ficha Avaliação..." onclick="self.open('imprimir_fichas_avaliacao.php','_self')" style="width:120px"-->

<input type="button" value="Início" onclick="self.open('../home_restrito.php','_self')" style="width:120px">

<!--
<input type="button" value="Teste email" onclick="self.open('execute_enviar_email_teste.php','_self')" style="width:120px">
-->

</form>

<?php 
  include("gera_tabela_trabalhos.php");
  echo $tabela;
  $_SESSION['adm2'] = true;
  $_SESSION['tabela'] = $tabela;
?>
       
<?php
include("../inc_rodape.php");
?>
