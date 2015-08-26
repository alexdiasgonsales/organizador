<?php

class ControllerLogicOrientador implements ControllerLogic {

    public function add() {
return; //<<<<<<<<<<
        $orientador = new Orientador();
        $orientador->setFkUsuario($_REQUEST['id']);
        $orientador->setStatus('0');
        $orientador->setTipoServidor($_REQUEST['orServ']);
        $daoorientador = new OrientadorMySqlDAO();
        $daoorientador->insert($orientador);
        $orientadorCurso = new OrientadorCampus();
        $orientadorCurso->setFkOrientador($_REQUEST['id']);
        $orientadorCurso->setFkCampus($_REQUEST['f_campus']);
        $orientadorCurso->setSeq('1');
        $orientadorCurso->setStatus('1');
        $daoOrientadorCurso = new OrientadorCampusMySqlDAO();
        $daoOrientadorCurso->insert($orientadorCurso);
    }

    public function delete() {
        
    }



    public function editsave() {
        
    }

    public function lista() {
        
    }

    public function show() {
        
    }



    public function edit() {
        
    }

   


}
