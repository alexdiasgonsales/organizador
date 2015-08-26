<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ControllerLogicAutorCurso
 *
 * @author alexandre
 */
class ControllerLogicAutorCurso implements ControllerLogic {
    public function add() {
        $autorCurso = new AutorCurso();
        $autorCurso->setFkAutor($_REQUEST['id']);
        $autorCurso->setFkCurso($_REQUEST['curso']);
        $autorCurso->setSeq('1');
        $autorCurso->setStatus('1');
        $autorDao = new AutorCursoMySqlDAO();
        $autorDao->insert($autorCurso);
    }

    public function delete() {
        $autorCurso = new AutorCursoMySqlDAO();
        $autorCurso->deleteVinculo($_REQUEST['fk_usuario'], $_REQUEST['fk_curso']);
    }

    public function edit() {
        
    }

    public function editsave() {
        
    }

    public function lista() {
        
    }

    public function show() {
        
    }

//put your code here
}
