<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ControllerLogicAvaliador
 *
 * @author alexandre
 */
class ControllerLogicAvaliador implements ControllerLogic{
    public function add() {
//return; //<<<<<<<<<<
        $avaliador = new Avaliador();
        $avaliador->setFkUsuario($_REQUEST['id']);
        $avaliador->setStatus('0');
        $avaliador->setTipoServidor($_REQUEST['orServ']);
        $avaliador->setFkCampus($_REQUEST['f_campus']);
        $avaliador->setFormacao($_REQUEST['servForm']);
        $avaliadorArea = new AvaliadorArea();
        $avaliadorArea->setFkAvaliador($_REQUEST['id']);
        $avaliadorArea->setFkArea($_REQUEST['areaTematica']);
        $daoavaliador = new AvaliadorMySqlDAO();
        $daoavaliador->insert($avaliador);
        $daoAvaliadorArea = new AvaliadorAreaMySqlDAO();
        $daoAvaliadorArea->insert($avaliadorArea);
        
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
