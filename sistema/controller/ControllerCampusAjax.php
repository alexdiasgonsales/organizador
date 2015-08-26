<?php
require_once 'autoload.php';

if (isset($_REQUEST['opcao'])) {
  
  //------------ inserir_campus ----------------------
  if ($_REQUEST['opcao'] == 'inserir_campus') {
    $nome_campus = $_REQUEST['nome_campus'];
    $cidade_campus = $_REQUEST['cidade_campus'];
    $id_instituicao = $_REQUEST['id_instituicao'];
    $campus = new Campus();
    $campus->setFkInstituicao($id_instituicao);
    $campus->setNome($nome_campus);
    $campus->setCidade($cidade_campus);
    $dao_campus = new CampusMySqlDAO();
    $id_campus = $dao_campus->insert($campus);
    echo $id_campus;
    exit;
  }//inserir_campus

else if ($_REQUEST['opcao'] == 'getCampi') {
    ViewUsuario::viewCampusAjax();
  }
  
}

