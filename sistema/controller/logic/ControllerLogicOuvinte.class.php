<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ControllerLogicOuvinte
 *
 * @author alexandre
 */
class ControllerLogicOuvinte implements ControllerLogic {

    public function add() {
    return; //<<<<<<<<<<<<<<<<<<<<<<<<<
        $ouvinte = new Ouvinte();
        $ouvinte->setFkUsuario($_REQUEST['id']);
        $ouvinte->setFkInstituicao($_REQUEST['f_instituicao']);
        $ouvinte->setFkCampus($_REQUEST['f_campus']);
        $ouvinte->setFkCurso($_REQUEST['f_curso']);
        $ouvinte->setTipoOuvinte($_REQUEST['tipoOuvinte']);
        $ouvinte->setOutro($_REQUEST['outro']);
        $ouvinte->setEmpresa($_REQUEST['empresa']);
        $daoOuvinte = new OuvinteMySqlDAO();
        $daoOuvinte->insert($ouvinte);
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

//put your code here
}
