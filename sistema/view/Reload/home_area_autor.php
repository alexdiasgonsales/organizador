<?php
require_once '../../controller/autoloadreload.php';
require_once '../../controller/constantes_inscricao_trabalho.php';
require_once '../../controller/funcoes_ver_trabalho.php';

Login::VerificaLogin();
$curso = new AutorMySqlDAO();
$Instituicao = new InstituicaoMySqlDAO();
$retornoInstituicao = (array) $Instituicao->queryAllSelect();
$retornaCurso = (array) $curso->findAutorCurso($_REQUEST['id']);
$autor_dao = new AutorMySqlDAO();
$trabalhos_autor_principal = $autor_dao->queryTrabalhosAutorPrincipal($_SESSION['authUser']->id);
$trabalhos_autor = $autor_dao->queryTrabalhosCoautor($_SESSION['authUser']->id);
?>
<div id="infoAutor">
    <div style="background-color:#CCDAB4;width:97%;height:18px;padding-top:5px;padding-left:10px;">
      <!--
        <label id="title1" style="font-weight:bold;height:20px;">Cursos em que o autor está matriculado:</label>
      -->
        Cursos em que o autor está matriculado:
    </div>
    <input id="fk_autor" type="hidden"/>
    <table style="margin-top:5px;margin-bottom: 10px;" id="tabelaCurso" >
        <tr style="background-color:#CCDAB4;height:18px;padding-left:10px;width:97%;">
            <td width="320px;" style="padding-left:10px;">Curso</td>
            <td width="160px;" style="padding-left:10px;">Campus</td>
            <td width="120px;" style="padding-left:10px;">Instituição</td></tr>
        <?php foreach ($retornaCurso as $value): ?>
            <tr><td><span><?php echo $value->nivelCurso . $value->nomeCurso; ?></span></td>
                <td><span><?php echo $value->nomeCampus; ?></span></td>
                <td><span><?php echo $value->sigla; ?></span></td>
                <!--
                <td><span><a href="#" class="link1" onclick="apagar(<?php //echo $value->fk_autor . ',' . $value->fk_curso; ?>, this.parentNode.parentNode.rowIndex);" style="font-size:10px;margin-left:15px;">Remover </a></td></span>
                -->
            </tr>
        <?php endforeach; ?>
    </table>

    <!----------- Cadastro de Instituicao / Campus / Curso ------------>
    
    <a href="#" id="mostrar" onclick="mostraDadosInstituicao();" class="linkBotao" style="margin-left:10px;"> Vincular-se a outro curso ...</a>
    <a href="#" id="ocultar" onclick="ocultaDadosInstituicao();" class="linkBotao" style="margin-left:10px; display:none;"> Ocultar os campos abaixo...</a>
    
    <div id="cursos" style="display:none;">
      
        <!----------- Instituicao ------------>
        <p class="form">
            <label>Instituição: </label>
            <select id="f_instituicao" name="f_instituicao"  onchange="getCampus();"required="required">
                <option value="">Selecione um item da lista</option>
                <?php foreach ($retornoInstituicao as $value3): ?>
                    <option value="<?php echo $value3->id_instituicao; ?>"><?php echo $value3->nome; ?></option>
                <?php endforeach; ?>

                <span>Selecione um item</span>
            </select>

            <!--
            <a href="#" class="links linkBotao" style="float: left;" onclick="nova();">Nova Instituição</a> 
            -->
        </p>
        
        <!----------- Campus ------------>
        <p class="form">
            <label>Campus: </label>
            <select id="f_campus" name="f_campus"  onchange="getCursos();" required="required">
                <option value="">Selecione um item da lista</option>
                <span>Selecione um item</span>
            </select>
            <!--
            <a href="#" class="links linkBotao" style="float: left;" onclick="novo_campus();">Novo Campus</a>
            -->
        </p>
        
        <!----------- Curso ------------>
        <p class="form">
            <label>Curso: </label>
            <select id="f_curso" name="f_curso" required="required">
                <option value="">Selecione um item da lista</option>
                <span>Selecione um item</span>
            </select>
            <!--
            <a href="#" class="links linkBotao" style="float: left;" onclick="novo_curso();">Novo Curso</a> 
            -->
        </p>
        
        <a href="#" id="ignorar" onclick="ocultaDadosInstituicao();" class="linkBotao" style="margin-left:10px; display:none;"> Cancelar vínculo a curso.</a>
        <a href="#" id="enviar" onclick="add();" class="linkBotao" style="margin-left:10px; display:none;" > Confirmar vínculo a curso.</a>
        
    <!-- Div Cursos -->
    </div>

    <div style="clear:both;height:10px;"></div>

    <div id="msg_erroAut1" style="color:#ff0000;height:20px;display:none;"><br> Você deve possuir, no mínimo, um curso cadastrado. </div>

    <div id="msg_erroAut2" style="color:#ff0000;height:20px;display:none;"><br> Este é o curso vinculado ao seu trabalho. <br> Por favor, atualize seu trabalho antes de efetuar a remoção do curso.</div>

    <div style="clear:both;height:10px;"></div>

</div>

<!---------------------------------- TRABALHOS ----------------------->

<div id="trabShow" style="margin-top:15px;">
    <hr style="width:80%;"> <br>
    <div style="background-color:#CCDAB4;width:97%;height:18px;padding-top:5px;padding-left:10px;">
      <!--
        <label id="title3" style="font-weight:bold;height:20px;">Trabalhos aos quais está vinculado como autor principal ou coautor:</label>
      -->
    Trabalhos aos quais está vinculado como autor principal ou coautor:
    </div>

    <div style="clear:both;height:10px;"></div>

    <div id="appendTrabAut"></div>

    <table id="listaTrabalhos" style="margin-bottom: 30px;">
        <tr style="background-color:#CCDAB4;height:18px;padding-left:10px;width:97%;margin-bottom: 20px;">
            <td width="15px;" style="padding-left:10px;">ID</td>
            <td width="450px;" style="padding-left:10px;">Título</td>
            <td width="100px;" style="padding-left:10px;">Status</td>
            <td width="100px;" style="padding-left:10px;">Tipo</td>
            <td width="120px;" style="padding-left:10px;"> </td></tr>  



        <?php foreach ($trabalhos_autor_principal as $value4): ?>
            <tr><td><span><?php echo $value4->id_trabalho; ?></span></td>
                <td><span><?php echo $value4->titulo; ?></span></td>
                <td><span><?php echo mostra_status_trabalho($value4->status, false); ?></span></td>
                <td><span>Autor</span></td>
                <td><span><a href="ControllerTrabalho.php?acao=ver_trabalho&id_trabalho=<?php echo $value4->id_trabalho;?>">Ver/Modificar...</a> <br><br></span></td>
                <!--
                <td><span><a href="#" class="link1" onclick="removerTrabalho(<?php echo $value4->id_trabalho; ?>);" style="font-size:10px;margin-left:15px;">Remover </a></td></span>
                -->
            </tr>
        <?php endforeach; ?>


        <?php foreach ($trabalhos_autor as $value4): ?>
            <tr><td><span><?php echo $value4->id_trabalho; ?></span></td>
                <td><span><?php echo $value4->titulo; ?></span></td>
                <td><span><?php echo mostra_status_trabalho($value4->status, false); ?></span></td>
                <td><span>Coautor</span></td>
                <td><span><a href="ControllerTrabalho.php?acao=ver_trabalho&id_trabalho=<?php echo $value4->id_trabalho;?>">Ver</a> <br><br></span></td>
                <!--
                <td><span><a href="#" class="link1" onclick="removerTrabalho(<?php echo $value4->id_trabalho; ?>);" style="font-size:10px;margin-left:15px;">Remover </a></td></span>
                -->
            </tr>
        <?php endforeach; ?>

    </table>


    <a href="ControllerTrabalho.php?acao=inscricao_trabalho">Inscrever Trabalho</a> <br><br>
    
      <a href="ControllerTrabalho.php?acao=edicao_trabalho&id_trabalho=203">Editar Trabalho ...</a><br>

    <a href="ControllerTrabalho.php?acao=ver_trabalho&id_trabalho=203">Ver Trabalho</a> <br><br>

<!-- Retirado em 09/08/2014
    <a href="ControllerTrabalho.php?acao=inscricao_trabalho" class="linkBotao" >Cadastrar novo trabalho...</a>
-->

    <!--
    <button class="button red home" id="red" >Voltar</button>
    -->
    
</div>



