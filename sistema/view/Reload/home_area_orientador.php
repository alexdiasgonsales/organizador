<?php
require_once '../../controller/autoloadreload.php';
require_once '../../controller/constantes_inscricao_trabalho.php';
require_once '../../controller/funcoes_ver_trabalho.php';

Login::VerificaLogin();
$campus = new OrientadorMySqlDAO();
$retornaCampus = (array) $campus->findOrientadorCampus($_REQUEST['id']);
$retornaTipo = (array) $campus->findTipoServidor($_REQUEST['id']);
$orientador_dao = new OrientadorMySqlDAO();
$trabalhos_orientador_principal = $orientador_dao->queryTrabalhosOrientadorPrincipal($_SESSION['authUser']->id);
$trabalhos_coorientador = $orientador_dao->queryTrabalhosCoorientador($_SESSION['authUser']->id);

foreach ($retornaTipo as $valueTipo):endforeach; ?>

    <div id="infoOrientador">
      <div id="dadoTipoServ" style="margin-left:10px;margin-top:10px;height:30px;">
          Tipo de Servidor: <?php echo $valueTipo->tipo; ?>
      </div>
      <div style="background-color:#CCDAB4;width:97%;height:18px;padding-top:5px;padding-left:10px;">
          <!--
            <label id="title3" style="font-weight:bold;height:20px;">Campi que o orientador está vinculado:</label>
          -->
          Campi que o orientador está vinculado:
      </div> 
      <table id="infoOrientadorEst" style="margin-top:5px;">
            <tr style="background-color:#CCDAB4;height:18px;padding-left:10px;width:97%;">
              <td width="270px;" style="padding-left:10px;">Campus</td>
              <td width="330px;" style="padding-left:10px;">Instituição</td>
              <!-- 
              <td> Remover campus</td>
              -->
            </tr>
          <?php foreach ($retornaCampus as $value):  ?>
            <tr><td style="padding-left:10px;"><?php echo $value->nomeCampus; ?></td>
                <td style="padding-left:10px;"><?php echo $value->sigla; ?></td>
                <!--
                <td><a href="#" class="link1" onclick="removeCampus(<?php //echo $value->fk_campus; ?>);" style="font-size:10px;text-decoration:underline;margin-left:15px;"> remover </a></td>
                -->
            </tr>
          <?php endforeach; ?>
            <!--
          <tr><td style="padding-left:10px;padding-top:5px;"><a href="#" onclick="insereCampus();" class="link1" style="font-size:10px;text-decoration:underline;"> Vincular-se a nova Instituição... </a></td></tr>
            -->
      </table>

        <div style="clear:both;height:10px;"></div>
        <div id="msg_erroOrien1" style="color:#ff0000;height:20px;display:none;"><br> Você deve possuir, no mínimo, uma instituição cadastrada. </div>
        <div id="msg_erroOrien2" style="color:#ff0000;height:20px;display:none;"><br> Esta é uma instituição vinculada a um trabalho enviado. <br> Por favor, solicite a atualização do trabalho antes de remover a instituição.</div>
        <div style="clear:both;height:10px;"></div>
    </div>


    <div id="divSombraOrien" style="width:100%; height:200%; position:absolute; top:0px; left:0px; z-index: 50; background: black; opacity: 0.7; display:none;"></div>
    <div id="popUpTrabOrien" style="top:60px; left:22%; width:800px; height:500px; position:absolute; border:1px solid #CCCCCC; z-index: 60; background: white; border-radius: 10px;display:none;padding:5px;overflow:auto;"></div>

    <div id="inserirCampus" style="display:none;">
        <h4>Área orientadores</h4>
        <label id="title4" style="font-weight:bold;height:20px;">Inserir Nova Instituição:</label>
        <div style="clear:both;height:10px;"></div>
        <div id="appendCadOr"></div>
    </div>
    

    <!---------------------------------- TRABALHOS ----------------------->

    <div id="trabShowOrien" style="margin-top:15px;">
        <hr style="width:80%;"> <br>
        <div style="background-color:#CCDAB4;width:97%;height:18px;padding-top:5px;padding-left:10px;">
            <label id="title3" style="font-weight:bold;height:20px;">Trabalhos:</label>
        </div> <div style="clear:both;height:10px;"></div>
        <div id="appendTrabOrien">
          
    <table id="listaTrabalhos" style="margin-bottom: 30px;">
        <tr style="background-color:#CCDAB4;height:18px;padding-left:10px;width:97%;margin-bottom: 20px;">
            <td width="15px;" style="padding-left:10px;">ID</td>
            <td width="450px;" style="padding-left:10px;">Título</td>
            <td width="100px;" style="padding-left:10px;">Status</td>
            <td width="100px;" style="padding-left:10px;">Tipo</td>
            <td width="120px;" style="padding-left:10px;"> </td></tr>  

        <?php foreach ($trabalhos_orientador_principal as $value4): ?>
            <tr><td><span><?php echo $value4->id_trabalho; ?></span></td>
                <td><span><?php echo $value4->titulo; ?></span></td>
                <td><span><?php echo mostra_status_trabalho($value4->status, false); ?></span></td>
                <td><span>Orientador</span></td>
                <td><span><a href="ControllerTrabalho.php?acao=ver_trabalho&id_trabalho=<?php echo $value4->id_trabalho;?>">Ver/Validar...</a> <br><br></span></td>
                <!--
                <td><span><a href="#" class="link1" onclick="removerTrabalho(<?php echo $value4->id_trabalho; ?>);" style="font-size:10px;margin-left:15px;">Remover </a></td></span>
                -->
            </tr>
        <?php endforeach; ?>


        <?php foreach ($trabalhos_coorientador as $value4): ?>
            <tr><td><span><?php echo $value4->id_trabalho; ?></span></td>
                <td><span><?php echo $value4->titulo; ?></span></td>
                <td><span><?php echo mostra_status_trabalho($value4->status, false); ?></span></td>
                <td><span>Co-orientador</span></td>
                <td><span><a href="ControllerTrabalho.php?acao=ver_trabalho&id_trabalho=<?php echo $value4->id_trabalho;?>">Ver</a> <br><br></span></td>
                <!--
                <td><span><a href="#" class="link1" onclick="removerTrabalho(<?php //echo $value4->id_trabalho; ?>);" style="font-size:10px;margin-left:15px;">Remover </a></td></span>
                -->
            </tr>
        <?php endforeach; ?>

    </table>
          
        </div><!-- listaTrabalhos -->
    </div><!-- trabShowOrien -->