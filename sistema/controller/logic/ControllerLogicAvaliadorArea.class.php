<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ControllerLogicAvaliadorArea
 *
 * @author alexandre
 */
class ControllerLogicAvaliadorArea implements ControllerLogic {
    public function add() {
        
    }

    public function delete() {
        
    }

    public function edit() {
        
    }

    public function editsave() {
      return; //<<<<<<<<<<<<<<<
        $avaliadorArea = new AvaliadorArea();
        $avaliadorArea->setFkArea((int) $_REQUEST['area']);
        $avaliadorArea->setFkAvaliador((int) $_SESSION['authUser']->id);
        $areaAvaliadorDao = new AvaliadorAreaMySqlDAO();
        $areaAvaliadorDao->update($avaliadorArea);
    }

    public function lista() {
        
    }

    public function show() {
        
    }

//put your code here
}
