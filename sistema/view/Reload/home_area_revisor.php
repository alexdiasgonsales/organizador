<?php
require_once '../../controller/autoloadreload.php';
Login::VerificaLogin();
$trab = new TrabalhoMySqlDAO();
$trabv = $trab->queryAll();

$_SESSION['usuario'] = $_SESSION['authUser']->id;
$_SESSION["id_administracao"] = $_SESSION['authUser']->id;
?>

<h2> Revisor - Lista de Trabalhos </h2>
<div id="mostraSlogan">

    <a href="<?php echo HOME."acesso_restrito/sistema/adm/adm_trabalhos.php";?>">Ver trabalhos</a>
    
    <!--
    <p>Clique no cabeçalho das colunas para ordenar pelo campo de interesse.</p>
    <p>Clique em cima do trabalho escolhido para visualizá-lo.</p>
    -->
    
</div>


