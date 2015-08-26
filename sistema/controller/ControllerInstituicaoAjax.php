<?php
require_once 'autoload.php';

if (isset($_REQUEST['opcao'])) {
  
  //------------ inserir_instituicao ----------------------
  if ($_REQUEST['opcao'] == 'inserir_instituicao') {
    $nome_inst = $_REQUEST['nome_inst'];
    $sigla_inst = $_REQUEST['sigla_inst'];
    $cidade_inst = $_REQUEST['cidade_inst'];
    $estado_inst = $_REQUEST['estado_inst'];
    $site_inst = $_REQUEST['site_inst'];
    $tipo_inst = $_REQUEST['tipo_inst'];
    $inst = new Instituicao();
    $inst->setNome($nome_inst);
    $inst->setSigla($sigla_inst);
    $inst->setCidade($cidade_inst);
    $inst->setEstado($estado_inst);
    $inst->setSite($site_inst);
    $inst->setTipo($tipo_inst);
    $dao_inst = new InstituicaoMySqlDAO();
    $id_inst = $dao_inst->insert($inst);
    echo $id_inst;
    exit;
  }//inserir_instituicao

else if ($_REQUEST['opcao'] == 'getInstituicoes') {
    ViewUsuario::viewInstituicoesAjax();
  }
  
}

