<?php
require_once '../controller/autoload_a.php';
include "cabecalho.php";
include "../controller/constantes_inscricao_trabalho.php";
require_once '../controller/constantes_URL.php';
require_once '../controller/constantes.php';
require_once '../controller/funcoes_ver_trabalho.php';
require_once '../model/dao/ParecerTrabalhoDAO.class.php';
require_once '../model/mysql/ParecerTrabalhoMySqlDAO.class.php';

session_start();

//Verifica se usuário está logado.
if (!isset($_SESSION['id_usuario'])) {
  header("Location: " . HOME . "index.php");
  exit;
}
//Pega ID do usuário logado.
$id_usuario = $_SESSION['id_usuario'];

//Verifica se trabalho existe.
if (!isset($_SESSION['trabalho'])) {
  header("Location: " . HOME . "index.php");
  exit;
}

if (!isset($_SESSION['pode_visualizar_trabalho'])) {
  exit;
}
        
$trabalho = $_SESSION['trabalho'];
$id_trabalho = $_SESSION['id_trabalho'];

$status = $trabalho->status;

if (isset($_SESSION['autores_cursos_do_trabalho']))
  $autores_cursos_do_trabalho = $_SESSION['autores_cursos_do_trabalho'];
else
  $autores_cursos_do_trabalho = null;

if (isset($_SESSION['orientadores_campus_do_trabalho']))
  $orientadores_campus_do_trabalho = $_SESSION['orientadores_campus_do_trabalho'];
else
  $orientadores_campus_do_trabalho = null;

$is_autor_principal_do_trabalho = $_SESSION['is_autor_principal_do_trabalho'];
$is_orientador_principal_do_trabalho = $_SESSION['is_orientador_principal_do_trabalho'];
$is_organizador = $_SESSION['authUser']->organizador;

//Pega dados do autor principal cadastrados no trabalho.
//$id_curso = $autores_cursos_do_trabalho[0]->fk_curso;
//$email_trabalho = $autores_cursos_do_trabalho[0]->email_trabalho;
//Pega os cursos do usuario (autor) logado.
//$cursos_autor_principal = $_SESSION['cursos_autor_principal'];


  //Habilita o botão Editar Trabalho:
  $habilita_botao_editar_trabalho = false;
  if ( ( $is_autor_principal_do_trabalho && (ETAPA_INSCRICAO_TRABALHO == 1) && ($status == STATUS_TRAB_PENDENTE) ) ||
       ( $is_autor_principal_do_trabalho && (ETAPA_CORRECAO_TRABALHO_1 == 1)  && ( ($status == STATUS_TRAB_CORRIGIR) || ($status == STATUS_TRAB_EM_CORRECAO) ) )
     )
  {
    $habilita_botao_editar_trabalho = true;
  }

  //Habilita o botão Enviar Trabalho:
  $habilita_botao_enviar_trabalho = false;
  if ( ( $is_autor_principal_do_trabalho && (ETAPA_INSCRICAO_TRABALHO == 1) && ($status == STATUS_TRAB_PENDENTE)    ) ||
       ( $is_autor_principal_do_trabalho && (ETAPA_CORRECAO_TRABALHO_1 == 1)  && ($status == STATUS_TRAB_CORRIGIR)    ) ||
       ( $is_autor_principal_do_trabalho && (ETAPA_CORRECAO_TRABALHO_1 == 1)  && ($status == STATUS_TRAB_EM_CORRECAO) )
     )
  {
    $habilita_botao_enviar_trabalho = true;
  }

  //Habilita botões VALIDAR, INVALIDAR ou REFAZER.
  $habilita_botao_validar_trabalho   = false;
  $habilita_botao_invalidar_trabalho = false;
  $habilita_botao_refazer_trabalho   = false;
  if ($is_orientador_principal_do_trabalho && (ETAPA_INSCRICAO_TRABALHO == 1) && ($status == STATUS_TRAB_ENVIADO) ) {
    $habilita_botao_validar_trabalho   = true;
    $habilita_botao_invalidar_trabalho = true;
    //$habilita_botao_refazer_trabalho   = true;
  }

  /*
  //Alguns status não podem ser mostrados pois os Revisores poderão emitir 
  //parecer nessas etapas, e o novo status devido ao parecer não podem ser mostrados
  //aos autores e orientadores.
  if ( (ETAPA_INSCRICAO_TRABALHO == 1) || (ETAPA_ANALISE_TRABALHO_1 == 1) ) {
    //PENDENTE, ENVIADO, VALIDADO, INVALIDADO
    if ( ($status == STATUS_TRAB_PENDENTE) || ($status == STATUS_TRAB_ENVIADO) || ($status == STATUS_TRAB_VALIDADO) || ($status == STATUS_TRAB_INVALIDADO) ) {
      $texto_status_trabalho = $arr_status_trab_completo[$trabalho->status];
    }
    else if ($is_organizador) {
      $texto_status_trabalho = $arr_status_trab_completo[$trabalho->status];
    }
    else {
      $texto_status_trabalho = "Trabalho em análise pela comissão organizadora.";
    }
  }

  //Pode mostrar o status pois os Revisores não podem emitir parecer nessa etapa.
  if (ETAPA_CORRECAO_TRABALHO_1 == 1) {
    $texto_status_trabalho = $arr_status_trab_completo[$trabalho->status];
  }
  
  if ( ETAPA_ANALISE_TRABALHO_2 == 1 ) {
    if ($is_organizador) {
      $texto_status_trabalho = $arr_status_trab_completo[$trabalho->status];
    }
    else {
      switch ($status){
        case STATUS_TRAB_PENDENTE:
        case STATUS_TRAB_ENVIADO:
        case STATUS_TRAB_VALIDADO:
        case STATUS_TRAB_INVALIDADO:
        case STATUS_TRAB_CORRIGIR:
        case STATUS_TRAB_EM_CORRECAO:
        case STATUS_TRAB_CORRIGIDO:
        case STATUS_TRAB_ACEITO:   //<<<<< Na verdade só poderia mostrar se tiver apenas um parecer.
        case STATUS_TRAB_RECUSADO: //<<<<< Na verdade só poderia mostrar se tiver apenas um parecer.
          $texto_status_trabalho = $arr_status_trab_completo[$trabalho->status];
          break;
        default:
          $texto_status_trabalho = "Trabalho em análise pela comissão organizadora.";
      }//switch
    }//else
  }

  if ( ETAPA_TRABALHOS_HOMOLOGADOS == 1 ) {
    $texto_status_trabalho = $arr_status_trab_completo[$trabalho->status];
  }
    */
  $texto_status_trabalho = mostra_status_trabalho_completo($status, false);
  
?>

<div id="cont">

  <div class = "tituloEditTrab">
    <h4>Número do Trabalho (ID): <?php echo $trabalho->id_trabalho; ?> </h4>
    <p>&nbsp; </p>
  </div>

  <div class = "tituloEditTrab">
    <h4>Título: </h4>
    <p><?php echo $trabalho->titulo; ?></p>
  </div>

  <div class = "tituloEditTrab">
    <h4>Resumo: </h4>
    <p><?php echo $trabalho->resumo; ?></p>
  </div>

  <div class = "tituloEditTrab">
    <h4>Palavras-Chave: </h4>
    <p><?php echo $trabalho->palavra1; ?></p>
    <p><?php echo $trabalho->palavra2; ?></p>
    <p><?php echo $trabalho->palavra3; ?></p>
  </div>

  <div class = "tituloEditTrab">
    <h4>Área Temática: </h4>
    <p><?php echo $trabalho->nome_area; ?></p>
  </div>

  <div class = "tituloEditTrab">
    <h4>Categoria: </h4>
    <p><?php echo $trabalho->nome_categoria; ?></p>
  </div>

  <div class = "tituloEditTrab">
    <h4>Modalidade de Apresentação: </h4>
    <p><?php echo $trabalho->nome_modalidade; ?></p>
  </div>

  <div class = "tituloEditTrab">
    <h4>Apoiadores: </h4>
    <p><?php echo $trabalho->apoiadores; ?></p>
  </div>

  <div class = "tituloEditTrab">
    <h4>Autor(es): </h4>
    <table class="tabAutor">
      <tr>
        <td class="subAutor">
          Id
        </td>
        <td class="subAutor">
          Nome
        </td>
        <td class="subAutor">
          E-mail
        </td>
        <td class="subAutor">
          Curso/Campus/Instituição
        </td>
      </tr>

<?php
foreach ($autores_cursos_do_trabalho as $autor_curso) {
  echo "<tr>";
  echo "<td>$autor_curso->fk_autor</td>";
  echo "<td>$autor_curso->nome_usuario</td>";
  echo "<td>$autor_curso->email_trabalho</td>";
  echo "<td>(".$autor_curso->nome_curso."/".$autor_curso->nome_campus."/".$autor_curso->sigla.")</td>";
  echo "</tr>";
}
?>
    </table>

  </div>
  <div class = "tituloEditTrab">
    <h4>Orientador(es): </h4>
    <table class="tabOrientador">
      <tr>
        <td  class="subOrientador">
          Id
        </td>
        <td  class="subOrientador">
          Nome
        </td>
        <td  class="subOrientador">
          E-mail
        </td>
        <td  class="subOrientador">
          Campus/Instituição
        </td>
      </tr>

<?php
$quant_orientadores = 0;
foreach ($orientadores_campus_do_trabalho as $orientador_campus) {
  $quant_orientadores++;
  echo "<tr>";
  echo "<td>$orientador_campus->fk_orientador</td>";
  echo "<td>$orientador_campus->nome_usuario</td>";
  echo "<td>$orientador_campus->email_trabalho</td>";
  echo "<td>($orientador_campus->nome_campus/$orientador_campus->sigla)</td>";
  echo "</tr>";
  }//for
?>

<?php if ($quant_orientadores == 0) : ?>
  <tr><td colspan=4><span style='color:red; font-size:14px;'>Deve ser incluído pelo menos um orientador.<br>
  <?php if ($habilita_botao_editar_trabalho) : ?>    
    Clique no botão Editar, logo abaixo, para incluir o(s) orientador(es).</span></td></tr>
  <?php endif; ?>
<?php endif; ?>
      
    </table>
  </div>

  <div class = "tituloEditTrab">
    <h4>Turnos preferenciais para apresentação do Trabalho:</h4>
    <p>Primeira preferência: <?php echo $arr_turnos[$trabalho->turno1]; ?></p>
    <p>Segunda preferência: <?php echo $arr_turnos[$trabalho->turno2]; ?></p>
    <p>Terceira preferência: <?php echo $arr_turnos[$trabalho->turno3]; ?></p>
  </div>

  <div class = "tituloEditTrab">
    <h4>Estado do Trabalho:</h4>
    <p><?php echo $texto_status_trabalho; ?></p>
  </div>

  <?php 
  
  //$id_trab = (int) $_POST["id_trabalho"];
  //$seq = (int) $_POST["seq"];

  $parecer_dao = new ParecerTrabalhoMySqlDAO();
  $parecer = $parecer_dao->loadParecer($id_trabalho, 1);
  
  $casoStatus = array();
  $casoStatus[0] = "Conforme";
  $casoStatus[1] = "Inconforme";

  if ($parecer != null ) {
    $status_trab = $parecer->status;
    $status_int = $parecer->status_introducao;
    $status_obj = $parecer->status_objetivos;
    $status_met = $parecer->status_metodologia;
    $status_res = $parecer->status_resultados;
  }
  
?>

  <?php if ($parecer != null) { ?>
  <b>Parecer da Comissão Organizadora:</b><br><br>
  
  <p>
    <u>Introdução:</u> <?php echo $casoStatus[$status_int]; ?> - <?php echo stripslashes($parecer->obs_introducao); ?><br>

  <p>
  <u>Objetivos:</u> <?php echo $casoStatus[$status_obj]; ?> - <?php echo stripslashes($parecer->obs_objetivos);?><br>

  <p>
  <u>Metodologia:</u> <?php echo $casoStatus[$status_met]; ?> - <?php echo stripslashes($parecer->obs_metodologia); ?><br>
  
  <p>
  <u>Resultados:</u> <?php echo $casoStatus[$status_res]; ?> - <?php echo stripslashes($parecer->obs_resultados); ?><br>
  
  <p>
  <u>Observações Gerais:</u> <?php echo stripslashes($parecer->observacoes); ?><br>
  
  <?php }?>
  
<br>
<br>
  <table border="1">
    
    <tr height="40"><td width="150">Possíveis Ações</td>
      <td>Significado</td>
    </tr>
    
  <!-- Botões para o Autor principal -->
  <?php if ($habilita_botao_editar_trabalho): ?>
    <tr height="40"><td width="150">
    <a href="../controller/ControllerTrabalho.php?acao=edicao_trabalho&id_trabalho=<?php echo $id_trabalho;?>" class="linkBotao">Editar Trabalho ...</a>
    </td>
    <td>
    Modificar dados do trabalho, autores, orientadores...
    </td></tr>
  <?php endif; ?>
  
  <?php if ($habilita_botao_enviar_trabalho): ?>
    <tr height="40"><td width="150">
    <a href="#" onclick="enviarTrabalho(<?php echo $id_trabalho;?>)" class="linkBotao" >Enviar Trabalho</a>
    </td>
    <td>
    Confirma o envio do trabalho para análise da comissão organizadora do evento.<br>
    ATENÇÃO: Após enviar o trabalho não haverá possibilidade de modificações.
    </td></tr>
  <?php endif; ?>
    
  <!--
  <p class="linkTrab"><a href="#">Visualizar PDF...</a><br />
  -->
  
  <!-- Botões para o Orientador principal -->
  <?php if ($habilita_botao_validar_trabalho): ?>
    <tr height="40"><td width="150">
    <a href="#" onclick="validarTrabalho(<?php echo $id_trabalho.", ".STATUS_TRAB_VALIDADO;?>)" class="linkBotao" >Validar Trabalho</a>
    </td>
    <td>
      Orientador autoriza e concorda com o envio do trabalho.<br>
      Atenção: Após validar o trabalho não haverá possibilidade de modificações.
    </td></tr>
  <?php endif; ?>

  <?php if ($habilita_botao_invalidar_trabalho): ?>
    <tr height="40"><td width="150">
    <a href="#" onclick="validarTrabalho(<?php echo $id_trabalho.", ".STATUS_TRAB_INVALIDADO;?>)" class="linkBotao" >Invalidar Trabalho</a>
    </td>
    <td>
      Orientador não autoriza nem concorda com o envio do trabalho.<br>
      Atenção: Após invalidar o trabalho não haverá possibilidade de modificações.
    </td></tr>
  <?php endif; ?>
  
  <?php if ($habilita_botao_refazer_trabalho): ?>
    <tr height="40"><td width="150">
    <a href="#" onclick="validarTrabalho(<?php echo $id_trabalho.", ".STATUS_TRAB_PENDENTE;?>)" class="linkBotao" >Refazer Trabalho</a>
    </td>
    <td>
    Orientador solicita ao autor principal que faça modificações no trabalho. O trabalho retornará ao estado PENDENTE.
    </td></tr>
  <?php endif; ?>

  <tr height="40"><td width="150">
    <a href="<?php echo HOME; ?>controller/ControllerLogin.php" class="linkBotao">Voltar</a>
  </td><td>Retorna à tela incial.
  </td></tr>  
  
</table>
  
<br>

</div>

<script>
  
  
  function enviarTrabalho(id_trabalho) {
    if (confirm('Tem certeza que deseja enviar o trabalho? Após enviar o trabalho não será possível efetuar quaisquer modificações no mesmo, inclusive adição, modificação ou remoção de autores ou orientadores.')) {
      var str = new Array();
      str.push("acao=enviar_trabalho");
      str.push("id_trabalho="+id_trabalho);
      url = "../controller/ControllerTrabalho.php";
      $.ajax({
        type: "GET",
        url: url,
        data: str.join("&"),
        success: function(data) {
          if (data == 0) {
            alert('Trabalho enviado com sucesso.');
            //window.location = "controller/ControllerTrabalho?acao=ver_trabalho&id_trabalho="+data;
            window.location = "<?php echo HOME; ?>controller/ControllerLogin.php";
          }
          else if (data == -1) {
            alert('Trabalho deve possuir pelo menos um orientador.');
          }
          else if (data == -2) {
            alert('Escolha três turnos diferentes para apresentação do trabalho.');
          }

        else {
          alert('Erro: código = ' + data);
        }
      }
    });
  }//if
  }//enviarTrabalho()
  
  function validarTrabalho(id_trabalho, status_validacao) {
    var STATUS_TRAB_PENDENTE   = 0;
    var STATUS_TRAB_VALIDADO   = 2;
    var STATUS_TRAB_INVALIDADO = 3;
    var texto = "";
    switch (status_validacao) {
    case STATUS_TRAB_PENDENTE:
      texto = 'O trabalho será marcado como PENDENTE, para permitir ao autor principal efetuar correções. Confirmar operação?';
      break;
    case STATUS_TRAB_VALIDADO:
      texto = 'Após VALIDAR o trabalho não será possível efetuar quaisquer modificações no mesmo, inclusive adição, modificação ou remoção de autores ou orientadores. Confirmar VALIDAÇÃO?';
      break;
    case STATUS_TRAB_INVALIDADO:
      texto = 'Após INVALIDAR o trabalho não será possível efetuar quaisquer modificações no mesmo, inclusive adição, modificação ou remoção de autores ou orientadores. Confirmar operação?';
      break;
    default:
      exit;
    }
    if (confirm(texto)) {
      var str = new Array();
      str.push("acao=validar_trabalho");
      str.push("id_trabalho="+id_trabalho);
      str.push("status_validacao="+status_validacao);
      url = "../controller/ControllerTrabalho.php";
      $.ajax({
        type: "GET",
        url: url,
        data: str.join("&"),
        success: function(data) {
          if (data == 0) {
            alert('Operação efetuada.');
            window.location = "<?php echo HOME; ?>controller/ControllerLogin.php";
          }
          else {
            alert('Erro: código = ' + data);
          }
        }
      });
    }//if
  }//validarTrabalho()

</script>
  
<?php
include "rodape.php";
?>