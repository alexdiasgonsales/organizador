<?php
require_once '../../controller/autoloadreload.php';
Login::VerificaLogin();
$orientador = new OrientadorMySqlDAO();
$orgOrientador = $orientador->queryAllHomologacaoOrientador();

$_SESSION['usuario'] = $_SESSION['authUser']->id;
$_SESSION["id_administracao"] = $_SESSION['authUser']->id;

$avaliador = new AvaliadorMySqlDAO();
$orgAvaliador = $avaliador->queryAllAvaliadores();

$avaliador_area = $avaliador->countAvaliadoresByArea();
$avaliador_status = $avaliador->countAvaliadoresByStatus();

$voluntarioOrg = new VoluntarioMySqlDAO();
$orgVoluntario = $voluntarioOrg->queryAllVoluntario();


$autor = new AutorMySqlDAO();
$autor_list = $autor->queryAllAutor();

$trabalho = new TrabalhoMySqlDAO();
$nomesTrabsPendentes = $trabalho->queryAllTrabalhosDeAutoresEOrientadoresByStatus(0); // 0 = pendente
$nomesTrabsEnviados = $trabalho->queryAllTrabalhosDeAutoresEOrientadoresByStatus(1); // 1 = enviados

$arr_status_usuario = array('P', 'A', 'R');
?>

<div>
  <p>
    
<h2>Trabalhos</h2>
    <a href="<?php echo HOME."acesso_restrito/sistema/adm/adm_trabalhos.php";?>" target="_blank">Ver trabalhos</a><br>


	<a href="<?php echo HOME."acesso_sessoes/sistema/adm/sessoes/lista_trabalhos_imprimir.php";?>" target="_blank">Imprimir trabalhos</a><br><br>
    <a href="../../../2014/sistema/controller/ControllerDownloadCSV.php?user_type=trabalho">Download lista trabalhos para certificado </a>

<h2>Sessões</h2>

    <a href="../acesso_sessoes/sistema/adm/sessoes/lista.php?col_id=1&col_area=1&col_modalidade=1&col_sessao=1&col_autor_principal=1&col_coautores=1&col_orientadores=1&col_avaliadores=1" target="_blank">Todas Sessões e Trabalhos</a><br>

    <a href="../acesso_sessoes/sistema/adm/sessoes/sessoes.php" target="_blank">Sessões</a><br>
    <a href="../acesso_sessoes/sistema/adm/sessoes/sessoes_avaliadores.php" target="_blank">Sessões e Avaliadores</a><br>
    <a href="../acesso_sessoes/sistema/adm/sessoes/sessoes_trabalhos_avaliadores.php" target="_blank">Sessões, Trabalhos e Avaliadores</a><br>
    
  <h2>Listagens</h2>
    <a href="../acesso_sessoes/sistema/adm/sessoes/lista_fichas_avaliacao.php" target="_blank">Fichas de Avaliação</a><br>
	
    <a href="../acesso_sessoes/sistema/adm/sessoes/lista_sessoes_pasta.php" target="_blank">Sessões para Pasta Avaliador (clique e aguarde...)</a><br>
	
    <a href="../acesso_sessoes/sistema/adm/sessoes/lista_sessoes_identificacao.php" target="_blank">Sessões para Identificar Sala (clique e aguarde...)</a><br>
  

  </p>
</div>

  <h2>Usuários (participantes)</h2>
  
<dl class="accordion" >
    <dt><a href=""><label class="linkAcordeon">Homologação de Orientadores:</label></a></dt>
    <dd><table class="tablesorter-default" width="100%">
            <thead>
            <tr style="background-color:#CCDAB4;" width="100%"> 
                <td title="Identificação Única">ID:</td>
                <td title="Nome do Orientador">Nome:</td>
                <td title="Email do Orientador">Email:</td>
                <td title="Campus do Orientador">Campus:</td>
                <td title="Sigla da Instituicao">Inst.:</td>
                <td title="Tipo de Servidor (D=Docente, T=Técnico Administrativo, O=Outro)">T</td>
                <td title="Status do Orientador (P=Pendente, R=Recusado, A=Aceito)">S</td>
                <td title="Modificar Status do Orientador" style="width:100px;">Modificar Status</td>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($orgOrientador as $ori): ?>
                <tr width="100%">
                    <td title="<?php echo $ori->usuario_id; ?>"><?php echo $ori->usuario_id; ?>
                    </td><td title="<?php echo $ori->usuario_nome; ?>"><?php echo OtherFuctions::lmWord($ori->usuario_nome, 100); ?>
                    </td><td title="<?php echo $ori->usuario_email; ?>"><?php echo OtherFuctions::lmWord($ori->usuario_email, 100); ?>
                    </td><td title="<?php echo $ori->campus_nome; ?>"><?php echo OtherFuctions::lmWord($ori->campus_nome, 100); ?>
                    </td><td title="<?php echo $ori->sigla_instituicao; ?>"><?php echo OtherFuctions::lmWord($ori->sigla_instituicao, 20); ?>
                    </td><td title="<?php echo $ori->orientador_tipo_servidor_char; ?>=<?php echo $arr_tipo_orientador[$ori->orientador_tipo_servidor]; ?>"><?php echo OtherFuctions::lmWord($ori->orientador_tipo_servidor_char, 5); ?>
                    <td>
                        <span title="P=Pendente, R=Recusado, A=Aceito" id="status_orientador_<?php echo $ori->usuario_id; ?>"><?php echo $arr_status_usuario[$ori->orientador_status][0]; ?> </span>
                    </td>
                    <td>
                        <input  type="button" title="Aceitar"  name="status_orientador_<?php echo $ori->usuario_id;?>" value="A" 
                                onclick="mudarStatus('<?php echo $ori->usuario_id; ?>', 'orientador', 1, 'A');">
                        <input  type="button" title="Recusar"  name="status_orientador_<?php echo $ori->usuario_id; ?>" value="R" 
                                onclick="mudarStatus('<?php echo $ori->usuario_id; ?>', 'orientador', 2, 'R');">
                        <input  type="button" title="Pedente" name="status_orientador_<?php echo $ori->usuario_id; ?>" value="P"
                                onclick="mudarStatus('<?php echo $ori->usuario_id; ?>', 'orientador', 0, 'P');">
                    </td>
                </tr>
            <?php endforeach; ?>
            <tbody>
        </table>
        <p>
           <a href="../../../2014/sistema/controller/ControllerDownloadCSV.php?user_type=orientador" target="_blank" class="linkBotao">Download</a>
        </p>
    </dd>
    <dt><a href=""><label class="linkAcordeon">Homologação de Avaliadores:</label></a></dt>
    <dd><table class="tablesorter-default" width="100%">
            <thead>
            <tr style="background-color:#CCDAB4;" width="100%"> 
                <td title="Identificação Única">ID:</td>
                <td title="Nome do Avaliador">Nome:</td>
                <td title="Email do Avaliador">Email:</td>
                <td title="Campus do Avaliador">Campus:</td>
                <td title="Sigla da Instituicao">Inst.:</td>
                <td title="Formação do Avaliador">F</td>
                <td title="Tipo de Avaliador (D=Docente, T=Técnico Administrativo, E=Estudante de pós-graduação)">T</td>
                <td title="Área Temática">A</td>
                <td title="Status do Avaliador (P=Pendente, R=Recusado, A=Aceito)">S</td>
                <td title="Modificar Status do Avaliador" style="width:100px;">Modificar Status</td>
            </tr>
            </thead>
            <tbody>

            <?php foreach ($orgAvaliador as $ava): ?>
                <tr width="100%">
                    <td title="<?php echo $ava->usuario_id; ?>"><?php echo $ava->usuario_id; ?>
                    </td><td title="<?php echo $ava->usuario_nome; ?>"><?php echo OtherFuctions::lmWord($ava->usuario_nome, 100); ?>
                    </td><td title="<?php echo $ava->usuario_email; ?>" style="width:100px;"><?php echo OtherFuctions::lmWord($ava->usuario_email, 100); ?>
                    </td><td title="<?php echo $ava->avaliador_campus_nome; ?>"><?php echo OtherFuctions::lmWord($ava->avaliador_campus_nome, 100); ?>
                    </td><td title="<?php echo $ava->avaliador_instituicao_sigla; ?>"><?php echo OtherFuctions::lmWord($ava->avaliador_instituicao_sigla, 20); ?>
                    </td><td title="3=Superior, 4=Especialização, 5=Mestrado, 6=Doutorado"><?php echo $ava->avaliador_formacao; ?>
                    </td><td title="<?php echo $ava->avaliador_tipo_servidor_char; ?>=<?php echo $arr_tipo_avaliador[$ava->avaliador_tipo_servidor]; ?>"><?php echo $ava->avaliador_tipo_servidor_char; ?>
                    </td><td title="<?php echo $ava->area_id; ?>=<?php echo OtherFuctions::lmWord($ava->area_nome, 50); ?>"><?php echo OtherFuctions::lmWord($ava->area_id, 5); ?>
                    </td>
                    <td>
                        <span title="P=Pendente, R=Recusado, A=Aceito" id="status_avaliador_<?php echo $ava->usuario_id; ?>"><?php echo $arr_status_usuario[$ava->avaliador_status][0]; ?> </span>
                    </td>
                    <td>
                        <input  type="button" title="Aceito"  name="status_<?php echo $ori->usuario_id; ?>_orientador" value="A" 
                                onclick="mudarStatus('<?php echo $ava->usuario_id; ?>', 'avaliador', 1, 'A');">
                        <input  type="button" title="Recusado"  name="status_<?php echo $ori->usuario_id; ?>_orientador" value="R" 
                                onclick="mudarStatus('<?php echo $ava->usuario_id; ?>', 'avaliador', 2, 'R');">
                        <input  type="button" title="Pedente" name="status_<?php echo $ori->usuario_id; ?>_orientador" value="P"
                                onclick="mudarStatus('<?php echo $ava->usuario_id; ?>', 'avaliador', 0, 'P');">
                    </td>
                </tr>
            <?php endforeach; ?>
                </tbody>
        </table>
        <p>
            <a href="../../../2014/sistema/controller/ControllerDownloadCSV.php?user_type=avaliador" target="_blank" class="linkBotao">Download</a>
        </p>
        <p>
         <br />    
        <h3>Estatísticas</h3>
        <table class="tablesorter-default">
            <thead>
            <tr>
                <td>Número de avaliadores</td>
                <td>área</td>
            </tr>
            </thead>
            <tbody>
                <?php foreach ($avaliador_area as $ava) : ?>
                <tr> 
                    <td><?=$ava->avaliadores?></td>
                    <td><?=$ava->area?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        
        </p>
        <p>
        <table class="tablesorter-default">
                <thead>
                <tr>
                    <td>Número de avaliadores</td>
                    <td>status</td>
                </tr>
                </thead>
                <tbody>
                    <?php foreach ($avaliador_status as $ava) : ?>
                    <tr> 
                        <td><?=$ava->avaliadores?></td>
                        <td><?=$ava->status?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </p>
    </dd>
    
    
    <dt><a href=""><label class="linkAcordeon">Visualização de Voluntários:</label></a></dt>
    <dd><table class="tablesorter-default" width="100%">
            <thead>
            <tr style="background-color:#CCDAB4;" width="100%"> 
                <td title="Identificação Única">ID:</td>
                <td title="Nome do Voluntário">Nome:</td>
                <td title="Email do Voluntário">Email:</td>
                <td title="Curso do Voluntário">Curso:</td>
                <td title="Campus do Voluntário">Campus:</td>
                <td title="Sigla da Instituicao">Sigla Inst.:</td>
                <td title="Primeiro Telefone do Voluntário">Fone:</td>
                <td title="Segundo Telefone do Voluntário">Fone:</td>
                <td title="Terceiro Telefone do Voluntário">Fone:</td>
                <td title="Turno Manhã">M</td>
                <td title="Turno Tarde">T</td>
                <td title="Turno Noite">N</td>
                <td title="Status do Voluntário (P=Pendente, R=Recusado, A=Aceito)">S</td>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($orgVoluntario as $volu): ?>
                <tr width="100%">
                    <td title="<?php echo $volu->usuario_id; ?>"><?php echo $volu->usuario_id; ?>
                    </td><td title="<?php echo $volu->usuario_nome; ?>"><?php echo OtherFuctions::lmWord($volu->usuario_nome, 100); ?>
                    </td><td title="<?php echo $volu->usuario_email; ?>"><?php echo OtherFuctions::lmWord($volu->usuario_email, 100); ?>
                    </td><td title="<?php echo $volu->voluntario_curso_nome; ?>"><?php echo OtherFuctions::lmWord($volu->voluntario_curso_nome, 100); ?>
                    </td><td title="<?php echo $volu->voluntario_campus_nome; ?>"><?php echo OtherFuctions::lmWord($volu->voluntario_campus_nome, 100); ?>
                    </td><td title="<?php echo $volu->voluntario_instituicao_sigla; ?>"><?php echo OtherFuctions::lmWord($volu->voluntario_instituicao_sigla, 20); ?>
                    </td><td title="<?php echo $volu->voluntario_fone1; ?>"><?php echo OtherFuctions::lmWord($volu->voluntario_fone1, 10); ?>
                    </td><td title="<?php echo $volu->voluntario_fone2; ?>"><?php echo OtherFuctions::lmWord($volu->voluntario_fone2, 10); ?>
                    </td><td title="<?php echo $volu->voluntario_fone3; ?>"><?php echo OtherFuctions::lmWord($volu->voluntario_fone3, 10); ?>
                    </td><td title="<?php echo $volu->voluntario_manha; ?>"><?php echo OtherFuctions::lmWord($volu->voluntario_manha, 1); ?>
                    </td><td title="<?php echo $volu->voluntario_tarde; ?>"><?php echo OtherFuctions::lmWord($volu->voluntario_tarde, 1); ?>
                    </td><td title="<?php echo $volu->voluntario_noite; ?>"><?php echo OtherFuctions::lmWord($volu->voluntario_noite, 1); ?>                      
                    </td><td title="P=Pendente, R=Recusado, A=Aceito"><?php echo $arr_status_usuario[$volu->voluntario_status][0]; ?>  
                    </td>
                </tr>
            <?php endforeach; ?>
                </tbody>
        </table>
        <p>
        <a href="../../../2014/sistema/controller/ControllerDownloadCSV.php?user_type=voluntario" target="_blank" class="linkBotao">Download</a>
        </p>
    </dd>
    <dt><a href=""><label class="linkAcordeon">Visualização de Autores:</label></a></dt>
    <dd><table class="tablesorter-default" width="100%">
            <thead>
            <tr style="background-color:#CCDAB4;" width="100%"> 
                <td title="Identificação Única">ID:</td>
                <td title="Nome do Autor">Nome:</td>
                <td title="Email do Autor">Email:</td>
                <td title="Curso do Autor">Curso:</td>
                <td title="Campus do Autor">Campus:</td>
                <td title="Sigla da Instituicao">Sigla Inst.:</td>
                <td title="Status do Autor (P=Pendente, R=Recusado, A=Aceito)">S</td>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($autor_list as $aut): ?>
                <tr width="100%">
                    <td title="<?php echo $aut->usuario_id; ?>"><?php echo $aut->usuario_id; ?>
                    </td><td title="<?php echo $aut->usuario_nome; ?>"><?php echo OtherFuctions::lmWord($aut->usuario_nome, 100); ?>
                    </td><td title="<?php echo $aut->usuario_email; ?>"><?php echo OtherFuctions::lmWord($aut->usuario_email, 100); ?>
                    </td><td title="<?php echo $aut->autor_curso_nome; ?>"><?php echo OtherFuctions::lmWord($aut->autor_curso_nome, 100); ?>
                    </td><td title="<?php echo $aut->autor_campus_nome; ?>"><?php echo OtherFuctions::lmWord($aut->autor_campus_nome, 100); ?>
                    </td><td title="<?php echo $aut->autor_instituicao_sigla; ?>"><?php echo OtherFuctions::lmWord($aut->autor_instituicao_sigla, 20); ?>
                    </td><td title="P=Pendente, R=Recusado, A=Aceito"><?php echo $arr_status_usuario[$aut->autor_status][0]; ?>  
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <a href="../../../2014/sistema/controller/ControllerDownloadCSV.php?user_type=autor" target="_blank" class="linkBotao">Download</a>
    </dd>
    
    
    <?php if ($_SESSION['authUser']->cpf == '75516110025' ): // 'ID_DO_PROFESSOR' ?> 
  
    <dt><a href=""><label class="linkAcordeon">Envio de e-mails:</label></a></dt>
    <dd>

        <h3 class="pendentes">Autores/orientadores com trabalhos pendentes</h3>
        <ul style="list-style: none">
            <?php foreach ($nomesTrabsPendentes as $nomes):?>
            <li><?php echo $nomes->user_autor_nome == null ? $nomes->user_orientador_nome : $nomes->user_autor_nome; ?></li>
            <?php endforeach; ?>
        </ul>
        
        <?php if (sizeof($nomesTrabsPendentes)> 0):?>
        <p>
            <a href="#pendentes" class="enviar_email_pendentes linkBotao">Enviar e-mail</a>
        </p>
        <?php endif; ?>
        
        <h3 class="enviados">Autores/orientadores com trabalhos enviados</h3>
        <ul style="list-style: none">
            <?php foreach ($nomesTrabsEnviados as $nomes):?>
            <li><?php echo $nomes->user_autor_nome == null ? $nomes->user_orientador_nome : $nomes->user_autor_nome; ?></li>
            <?php endforeach; ?>
        </ul>
        <?php if (sizeof($nomesTrabsEnviados)> 0):?>
        <p>
            <a href="#enviados" class="enviar_email_enviados linkBotao">Enviar e-mail</a>
        </p>
        <?php endif; ?>
    </dd>
    <?php endif; ?>
    
    
</dl>

<script>
    (function($) {
        
        // aciona o efeito accordion nos painéis
        var allPanels = $('.accordion > dd').hide();

        $('.accordion > dt > a').click(function() {
            allPanels.slideUp();
            $(this).parent().next().slideDown();
            return false;
        });
        
        // faz o ajax para enviar e-mails para quem tem trabalhos pendentes e enviados
        $('.enviar_email_pendentes, .enviar_email_enviados').click(function () {
            var status_int = this.className === 'enviar_email_pendentes' ? 0 : 1;
            
            $.post('../../../2014/sistema/controller/ControllerEmailAjax.php', { status_int: status_int }, function (result) {
                //console.log(result);
                alert(result);
            });
        });
        
        // aciona o efeito sortable nas tablas
        $('.tablesorter-default').tablesorter({
            sortList: [[0,0],[2,0]]
        });
        

    })(jQuery);

</script>