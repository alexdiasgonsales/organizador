<?php
require_once '../../controller/autoloadreload.php';
Login::VerificaLogin();
$avaliadorDAO = new AvaliadorMySqlDAO();
$avaliadorVAR = $avaliadorDAO->loadDataAvaliador($_SESSION['authUser']->id);
$avaliadorAreaDAO = new AvaliadorAreaMySqlDAO();
$avaliadorAreaVAR = $avaliadorAreaDAO->queryAllAreaAvaliador($_SESSION['authUser']->id);
$areaDAO = new AreaMySqlDAO();
$areaVAR = $areaDAO->queryAllSelect();

$sessaoDAO = new SessaoMySqlDAO();
$sessaoList = $sessaoDAO->querySessaoByAvaliador($_SESSION['authUser']->id);

?>
<?php if (true) : // aqui vai a data strtotime("2014-08-26") > strtotime("2014-08-25") ?> 
<p>
<fieldset>
    <legend>Sessões Alocadas</legend>
    <table class="tablesorter-default">
        <thead>
            <tr>
                <td style="visibility: hidden">Id</td>
                <td>Número</td>
                <td>Sala</td>
                <td>Data</td>
                <td>início</td>
                <td>término</td>
                <td>Confirmar presença</td>
            </tr>
        </thead>
        <tbody>
        
            <?php foreach ($sessaoList as $sessao) : ?>
            <tr>
                <td style="visibility: hidden"><?=$sessao->id_sessao?></td>
                <td><?=$sessao->nome?></td>
                <td><?=$sessao->nome_sala?></td>
                <td><?=OtherFuctions::dateOutputFormat($sessao->data)?></td>
                <td><?=OtherFuctions::timeOutputFormat($sessao->hora_ini)?></td>
                <td><?=OtherFuctions::timeOutputFormat($sessao->hora_fim)?></td>
                <td >
                    <div class="toggle-btn-grp">
                        <label class="toggle-btn linkBotao <?=intval($sessao->status) == STATUS_AVALIADOR_SESSAO_ACEITA ? "success" : "" ?>">
                            <input type="radio" name="confirmacao"/>Sim
                        </label>
                        <label class="toggle-btn linkBotao <?=intval($sessao->status) == STATUS_AVALIADOR_SESSAO_REJEITADA ? "success" : "" ?>">
                            <input type="radio" name="confirmacao"/>Não
                        </label>
                        <label class="toggle-btn linkBotao <?=intval($sessao->status) == STATUS_AVALIADOR_SESSAO_TALVEZ ? "success" : "" ?>">
                            <input type="radio" name="confirmacao"/>Não Sei
                        </label>
                    </div>
                </div>
                </td>
            </tr>
            <?php endforeach;?>
        </tbody>
    </table>
</fieldset>
</p>
<?php endif; ?>
<div id="infoAvaliador">
    <div style="background-color:#CCDAB4;width:97%;height:18px;padding-top:5px;padding-left:10px;">
        <label id="title3" style="font-weight:bold;height:20px;">Dados_Específicos_do_Cadastro:</label>
    </div> <div style="clear:both;height:10px;"></div>
    <div style="text-align: left;">
        <table id="infoAvaliadorEst" >
            <?php foreach ($avaliadorVAR as $Avaliador): ?>
                <tr><td> Tipo de Servidor: </td><td><?php echo $Avaliador->tipo; ?> </td></tr>
                <tr><td> Formação: </td><td><?php echo $Avaliador->form; ?> </td></tr>
                <tr><td> Campus: </td><td><?php echo $Avaliador->campus; ?> </td></tr>
                <tr><td> Instituição: </td><td> <?php echo $Avaliador->instituicao . ' - ' . $Avaliador->sigla; ?> </td></tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>

<div id="areasAvaliador" style="margin-top:15px;">
    <div style="background-color:#CCDAB4;width:97%;height:18px;padding-top:5px;padding-left:10px;">
        <label id="title3" style="font-weight:bold;height:20px;">Áreas_Temáticas:</label>
    </div>
    <div style="clear:both;height:10px;"></div>
    <div id="appendAreasAvaliador">
        <label style="float: left;">Área Temática: </label>
        <select id="areaTematic" name="areaTematica" class="required" required="required" onchange="alteraArea();" disabled>
            <?php foreach ($areaVAR as $Area): ?>
                <?php if ($Area->id_area == $avaliadorAreaVAR->area): ?>  
                    <option value="<?php echo $Area->id_area; ?>" selected="selected"><?php echo $Area->nome; ?></option>
                <?php else: ?>
                    <option value="<?php echo $Area->id_area; ?>"><?php echo $Area->nome; ?></option>
                <?php endif; ?>
            <?php endforeach; ?>
            <span>Selecione um item</span>
        </select>
    </div>
    <script>
        $(".toggle-btn input[type=radio]").addClass("visuallyhidden");
        $(".toggle-btn input[type=radio]").change(function() {
            
            if( $(this).attr("name") ) {
                $(this).parent().addClass("success").siblings().removeClass("success");
            } else {
                $(this).parent().toggleClass("success");
            }
            var choice = $(this).parent().text();
            var sessao = $(this).parents('td').siblings().first().text();
            
            $.post('../../../2014/sistema/controller/ControllerSessaoAjax.php', { choice: choice, sessao: sessao }, function (result) {
                alert(result);
            });
        });
    </script>