
<?php

class ControllerLogicCampus implements ControllerLogic {

    public function add() {

        $campus = new Campus();
        $campus->setCidade($_POST['cidade_campus']);
        $campus->setNome($_POST['nome_campus']);
        $campus->setFkInstituicao($_POST['id_instituicao']);
        $campusMySqlDAO = new CampusMySqlDAO();
        $campusMySqlDAO->insert($campus);
    }

    public function delete() {
        // não implementada
        echo 'delete';
    }

    public function edit() {
        // não implementada
        echo 'delete';
    }

    public function editsave() {
        // não implementada
        echo 'delete';
    }

    public function lista() {
        // não implementada
        echo 'lista';
    }

    public function show() {
        // não implementada
        echo 'delete';
    }

}
