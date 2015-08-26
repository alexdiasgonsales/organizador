<?php
require_once '../../controller/autoloadreload.php';
Login::VerificaLogin();
$ouvinteArea = new OuvinteMySqlDAO();
$ouvinte = $ouvinteArea->loadOuvinteArea($_SESSION['authUser']->id);
?>
<div id="infoOuvinte">
    <div style="background-color:#CCDAB4;width:97%;height:18px;padding-top:5px;padding-left:10px;">
        <label id="title3" style="font-weight:bold;height:20px;">Dados_Específicos_do_Cadastro:</label>
    </div> <div style="clear:both;height:10px;"></div>
    <div style="text-align: left;">
        <table id="infoOuvinteEst">
            <?php foreach ($ouvinte as $ouv): ?>
                <tr><td> Tipo de Servidor: </td><td><?php echo $ouv->tipo; ?> </td></tr>
                <?php if ($ouv->campus != null): ?>
                    <tr><td> Campus: </td><td><?php echo $ouv->campus; ?> </td></tr>
                <?php endif; ?>
                <?php if ($ouv->instituicao != null): ?>
                    <tr><td> Instituição: </td><td> <?php echo $ouv->instituicao . ' - ' . $ouv->sigla; ?> </td></tr>
                <?php endif; ?>
                <?php if ($ouv->curso != null): ?>
                    <tr><td> Curso: </td><td> <?php echo $ouv->nivel . $ouv->curso; ?> </td></tr>
                <?php endif; ?>
                <?php if ($ouv->outro != ''): ?>
                    <tr><td> Outro: </td><td><?php echo $ouv->outro; ?> </td></tr>
                <?php endif; ?>
                <?php if ($ouv->empresa != ''): ?>
                    <tr><td> Empresa: </td><td><?php echo $ouv->empresa; ?> </td></tr>
                <?php endif; ?>
            <?php endforeach; ?>
        </table>
    </div>
</div>

