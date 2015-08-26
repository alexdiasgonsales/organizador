<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ControllerLogicOrganizador
 *
 * @author alexandre
 */
class ControllerLogicOrganizador implements ControllerLogic {

    public function add() {
        
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

    public function changeStatusOrientador() {
        if ($_REQUEST['status'] < 0 && $_REQUEST['status'] > 2):
            return;
        endif;
        // não é mais necessario não está se passando o requeste do organizador
        //  conforme email enviado pelo professor, fica o alerta do sql injectiomo
        //   sistema altera exemplo ...id=45&status=1*/
        /*     if ($_REQUEST['id'] != $_SESSION['authUser']->id):
          return;
          endif; */
        OtherFuctions::verffyOrg(); // funcao que verifica a veracidade do organizador
        $orientador = new Orientador();
        $orientador->setStatus($_REQUEST['status']);
        $orientador->setFkUsuario($_REQUEST['idorientador']);
        $orientadorDAO = new OrientadorMySqlDAO();
        $orientadorDAO->updateStatus($orientador);
        
        //Registra Log.
        $descricao = "id_orientador=".$_REQUEST['idorientador'].", new_status=".$_REQUEST['status'];
        $log_dao = new LogMysqlDAO();
        $log = new Log($_SESSION['authUser']->id, "orientador", "change_status", $descricao);
        $log_dao->insert($log);
    }

    public function changeStatusAvaliador() {
        if ($_REQUEST['status'] < 0 && $_REQUEST['status'] > 2):
            return;
        endif;
        // não é mais necessario não está se passando o requeste do organizador
        //  conforme email enviado pelo professor, fica o alerta do sql injectiomo
        //   sistema altera exemplo ...id=45&status=1*/
        /*     if ($_REQUEST['id'] != $_SESSION['authUser']->id):
          return;
          endif; */
        OtherFuctions::verffyOrg(); // funcao que verifica a veracidade do organizador
        $avaliador = new Avaliador();
        $avaliador->setStatus($_REQUEST['status']);
        $avaliador->setFkUsuario($_REQUEST['idavaliador']);
        $avaliadorDAO = new AvaliadorMySqlDAO();
        $avaliadorDAO->updateStatus($avaliador);
        
        //Registra Log.
        $descricao = "id_avaliador=".$_REQUEST['idavaliador'].", new_status=".$_REQUEST['status'];
        $log_dao = new LogMysqlDAO();
        $log = new Log($_SESSION['authUser']->id, "avaliador", "change_status", $descricao);
        $log_dao->insert($log);
    }

}
