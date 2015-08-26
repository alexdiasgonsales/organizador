<?php
require_once 'autoload.php';

if (isset($_REQUEST['opcao'])) {
  
  if ($_REQUEST['opcao'] == 'inserir_curso') {
  //------------ inserir_curso ----------------------
    $nome_curso = $_REQUEST['nome_curso'];
    $nivel_curso = $_REQUEST['nivel_curso'];
    $id_campus = $_REQUEST['id_campus'];
    $curso = new Curso();
    $curso->setFkCampus($id_campus);
    $curso->setNivel($nivel_curso);
    $curso->setNome($nome_curso);
    $dao_curso = new CursoMySqlDAO();
    $id_curso = $dao_curso->insert($curso);
    echo $id_curso;
    exit;
  }//inserir_curso

else if ($_REQUEST['opcao'] == 'getCursos') {
    ViewUsuario::viewCursosAjax();
  }
  
}
