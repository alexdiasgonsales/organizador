<?php

class ControllerLogicAutor implements ControllerLogic {

    public function add() {
      return; //<<<<<<<<<<
        $autor = new Autor();
        $autor->setFkUsuario($_REQUEST['id']);
        $daoAutor = new AutorMySqlDAO();
        $daoAutor->insert($autor);
        $autorCurso = new AutorCurso();
        $autorCurso->setFkAutor($_REQUEST['id']);
        $autorCurso->setFkCurso($_REQUEST['f_curso']);
        $autorCurso->setSeq('1');
        $autorCurso->setStatus('1');
        $daoCurso = new AutorCursoMySqlDAO();
        $daoCurso->insert($autorCurso);
    }

    public function delete() {
        
    }

    public function edit() {

    }

    public function editsave() {
        
    }

    public function lista() {
        
    }

    public function show() {
        
    }

}
