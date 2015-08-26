
<?php

class ControllerLogicRevisor implements ControllerLogic {

    public function add() {
	return; //<<<<<<<<<<<<<<
        $revisor = new Revisor();
        $revisor->setFkCampus($_POST['id_campus']);
        $revisor->setFkUsuario($_POST['id_usuario']);
        $revisorMySqlDAO = new RevisorMySqlDAO();
        $revisorMySqlDAO->insert($revisor);
    }

    public function delete() {
        // não implementada
        echo 'delete';
    }

    public function edit() {
        // não implementada
    }

    public function editsave() {
        // não implementada
        echo 'editsave';
    }

    public function lista() {
        // não implementada
        echo 'lista';
    }

    public function show() {
        // não implementada
        echo 'show';
    }

}
