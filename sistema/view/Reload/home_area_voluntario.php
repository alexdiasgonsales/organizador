<?php
require_once '../../controller/autoloadreload.php';
Login::VerificaLogin();
$voluntarioArea = new VoluntarioMySqlDAO();
$voluntario = $voluntarioArea->loadVoluntarioArea($_SESSION['authUser']->id);
?>

<div id="infoVoluntario">
    <div style="background-color:#CCDAB4;width:97%;height:18px;padding-top:5px;padding-left:10px;">
        <label id="title3" style="font-weight:bold;height:20px;">Dados_Específicos_do_Cadastro:</label>
    </div> <div style="clear:both;height:10px;"></div>
    <div style="text-align: left;">
        <table id="infoVoluntarioEst">
            <?php foreach ($voluntario as $vol): ?>
                <tr><td> Instituição: </td><td> <?php echo $vol->instituicao . ' - ' . $vol->sigla; ?> </td></tr>
                <tr><td> Campus: </td><td><?php echo $vol->campus; ?> </td></tr>
                <tr><td> Curso: </td><td> <?php echo $vol->nivel . $vol->curso; ?> </td></tr>
                <tr><td> Telefone1: </td><br /><td> <?php echo $vol->fone1; ?> </td></tr>
                <?php if ($vol->fone2 != ''): ?>
                    <tr><td> Telefone2: </td><br /><td> <?php echo $vol->fone2; ?> </td></tr>
                <?php endif; ?>
                <?php if ($vol->fone3 != ''): ?>
                    <tr><td> Telefone3: </td><br /><td> <?php echo $vol->fone3; ?> </td></tr>
                <?php endif; ?>   

                <tr><td><h2> - Turnos Disponíveis - </h2></td></tr> 
                <?php if ($vol->manha == null): ?>
                    <tr><td><input type="checkbox" value="M" name="chk[]" onchange="alteraTurno(<?php echo $_SESSION['authUser']->id; ?>);" id="cbManha" class="required inpCheck"><label for="cbManhaD" class = "turno">Manhã</label></td></tr>
                <?php else: ?>
                    <tr><td><input type="checkbox" value="M" name="chk[]"  onchange="alteraTurno(<?php echo $_SESSION['authUser']->id; ?>);"  checked="checked" id="cbManha" class="required inpCheck"><label for="cbManhaD" class = "turno">Manhã</label></td></tr>
                <?php endif; ?> 

                <?php if ($vol->tarde == null): ?>
                    <tr><td><input type="checkbox" value="T" name="chk[]"  onchange="alteraTurno(<?php echo $_SESSION['authUser']->id; ?>);" id="cbTarde" class="required inpCheck"><label for="cbTardeD" class = "turno">Tarde</label></td></tr>
                <?php else: ?>
                    <tr><td><input type="checkbox" value="T" name="chk[]"  onchange="alteraTurno(<?php echo $_SESSION['authUser']->id; ?>);" checked="checked" id="cbTarde" class="required inpCheck"><label for="cbTardeD" class = "turno">Tarde</label></td></tr>
                <?php endif; ?>

                <?php if ($vol->noite == null): ?>
                    <tr><td><input type="checkbox" value="N" name="chk[]"  onchange="alteraTurno(<?php echo $_SESSION['authUser']->id; ?>);" id="cbNoite" class="required inpCheck"><label for="cbNoiteD" class = "turno">Noite</label></td></tr>
                <?php else: ?>
                    <tr><td><input type="checkbox" value="N" name="chk[]"  onchange="alteraTurno(<?php echo $_SESSION['authUser']->id; ?>);" checked="checked" id="cbNoite" class="required inpCheck"><label for="cbNoiteD" class = "turno">Noite</label></td></tr>
                        <?php endif; ?>                       

            <?php endforeach; ?>
        </table>
    </div>
</div>


