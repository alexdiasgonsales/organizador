<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ControllerLogicVoluntario
 *
 * @author alexandre
 */
class ControllerLogicVoluntario implements ControllerLogic {

    public function add() {

return;//<<<<<<<<<<<<<<	
        $voluntario = new Voluntario();
        $voluntario->setFkUsuario($_REQUEST['id']);
        $voluntario->setStatus(0);
        $voluntario->setFkCurso($_REQUEST['f_curso'] == '' ? null : $_REQUEST['f_curso']);
        $dadosCheck = $_REQUEST['chk'];
        $voluntario->setManha(isset($dadosCheck[0]) && !empty($dadosCheck[0]) ? 'M' : null);
        $voluntario->setNoite(isset($dadosCheck[2]) && !empty($dadosCheck[2]) ? 'N' : null);
        $voluntario->setTarde(isset($dadosCheck[1]) && !empty($dadosCheck[1]) ? 'T' : null);
        $voluntario->setTelefone1($_REQUEST['telefone1']);
        $voluntario->setTelefone2($_REQUEST['telefone2']);
        $voluntario->setTelefone3($_REQUEST['telefone3']);
        $voluntario->setPresenca(0);
        $daoVoluntario = new VoluntarioMySqlDAO();
        $daoVoluntario->insert($voluntario);
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

    
    public function turno() {
        if ($_REQUEST['manha'] == 'null' && 
        $_REQUEST['noite'] == 'null' &&
        $_REQUEST['tarde'] == 'null'):
            return;
        endif;
        $voluntario = new Voluntario();
        $voluntario->setFkUsuario($_REQUEST['id']);
        $voluntario->setManha($_REQUEST['manha'] != 'null' ? 'M' : null);
        $voluntario->setNoite($_REQUEST['noite'] != 'null' ? 'N' : null);
        $voluntario->setTarde($_REQUEST['tarde'] != 'null' ? 'T' : null);
        if ($_REQUEST['manha'] == 'null' && 
        $_REQUEST['noite'] == 'null' &&
        $_REQUEST['tarde'] == 'null'):
            
        endif;
        $daoVoluntario = new VoluntarioMySqlDAO();
        $daoVoluntario->updateTurno($voluntario);
    }
//put your code here
}
