<?php
require_once '../../controller/autoloadreload.php';
Login::VerificaLogin();
$trab = new TrabalhoMySqlDAO();
$id = $_REQUEST['idTrabalho'];
$trabalho = $trab->load($id);
$areaDao = new AreaMySqlDAO();
$area = $areaDao->load($trabalho->fk_area);
$categoriaDao = new CategoriaMySqlDAO();
$categoria = $categoriaDao->load($trabalho->fk_categoria);
$modalidadeDao = new ModalidadeMySqlDAO();
$modalidade = $modalidadeDao->load($trabalho->fk_modalidade);
?>
<tr style="background-color:#CCDAB4;"> 
    <td>ID</td>
    <td>Área Tematica</td>
    <td>Categoria</td>
    <td>Modalidade</td>
</tr>
<tr> 
    <td><?php echo $trabalho->id_trabalho; ?></td>
    <td><?php echo OtherFuctions::lmWord($area->nome, 40); ?></td>
    <td><?php echo OtherFuctions::lmWord($categoria->nome, 30); ?></td> 
    <td><?php echo OtherFuctions::lmWord($modalidade->nome, 10); ?></td> 
</tr>
<tr style="background-color:#CCDAB4;">  
    <td></td>
    <td><bold>Titulo</bold></td>
    <td><bold>Titulo Ordenado</bold></td>  
</tr>
<tr>
    <td></td>
    <td><textarea rows="9" cols="38" disabled="disabled" style="text-align: left;"><?php echo $trabalho->titulo; ?></textarea></td>   
    <td><textarea rows="9" cols="38" disabled="disabled"><?php echo $trabalho->titulo_ordenar; ?></textarea></td>
</tr>
<tr style="background-color:#CCDAB4;">
    <td></td>
    <td><bold>Palavra Chave 1</bold></td>
    <td><bold>Palavra Chave 2</bold></td> 
</tr>
<tr> 
    <td></td>
    <td><?php echo OtherFuctions::lmWord($trabalho->palavra1, 40); ?></td>
    <td><?php echo OtherFuctions::lmWord($trabalho->palavra2, 40); ?></td>
</tr>
<tr style="background-color:#CCDAB4;">
    <td></td>
    <td><bold>Palavra Chave 3</bold></td>
    <td><bold>Apoiadores</bold></td> 
</tr>
<tr> 
    <td></td>
    <td><?php echo OtherFuctions::lmWord($trabalho->palavra1, 40); ?></td>
    <td><?php echo OtherFuctions::lmWord($trabalho->apoiadores, 40); ?></td>
</tr>
<tr style="background-color:#CCDAB4;">  
    <td></td>
    <td><bold>Primeiro Resumo</bold></td>
    <td><bold>Segundo Resumo</bold></td>  
</tr>
<tr>
    <td></td>
    <td><textarea rows="9" cols="38" disabled="disabled" style="text-align: left;"><?php echo $trabalho->resumo; ?></textarea></td>   
    <td><textarea rows="9" cols="38" disabled="disabled"><?php echo $trabalho->resumo2;?></textarea></td>
</tr>