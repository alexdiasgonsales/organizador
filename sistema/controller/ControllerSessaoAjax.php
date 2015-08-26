<?php

require_once './autoload.php';

$choice = trim($_POST['choice']);
$id_sessao = $_POST['sessao'];
$id_avaliador = $_SESSION['authUser']->id;
$status_int = null;
switch ($choice) {
    case 'Sim':
        $status_int = STATUS_AVALIADOR_SESSAO_ACEITA;
        break;
    
    case 'Não':
        $status_int = STATUS_AVALIADOR_SESSAO_REJEITADA;
        break;
    
    case 'Talvez':
        $status_int = STATUS_AVALIADOR_SESSAO_TALVEZ;
        break;
}

$sessao = new SessaoMySqlDAO();
$resp = $sessao->updateConfirmacaoSessao($id_avaliador, $id_sessao, $status_int);

if ($resp == "1")
    echo "Confirmação alterada com sucesso!";
else
    echo $resp;