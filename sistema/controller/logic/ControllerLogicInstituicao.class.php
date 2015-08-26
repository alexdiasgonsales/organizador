
<?php

class ControllerLogicInstituicao implements ControllerLogic {

    public function add() {

        $instituicao = new Instituicao();
        $instituicao->setCidade($_POST['cidade_instituicao']);
        $instituicao->setEstado($_POST['estado_instituicao']);
        $instituicao->setNome($_POST['nome_instituicao']);
        $instituicao->setSigla($_POST['sigla_instituicao']);
        $instituicao->setTipo('3');
        $instituicao->setSite($_POST['site_instituicao']);
        $instituicaoMySqlDAO = new InstituicaoMySqlDAO();
        $instituicaoMySqlDAO->insert($instituicao);
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
