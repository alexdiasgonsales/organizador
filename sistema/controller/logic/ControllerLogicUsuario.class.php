
<?php

class ControllerLogicUsuario implements ControllerLogic {

    public function add() {

        $usuario = new Usuario();
        $usuario->setNome($_REQUEST['nome']);
        $usuario->setCpf(preg_replace("/[^0-9]/", "", $_REQUEST['cpf']));
        $usuario->setEmail($_REQUEST['email']);
        $usuario->setSenha(md5($_REQUEST['senha']));
        $usuarioMySqlDAO = new UsuarioMySqlDAO();
        $usuarioMySqlDAO->insert($usuario);
    }

    public function delete() {
        // não implementada
        echo 'delete';
    }

    public function edit() {
        $usuario = new Usuario();
        $usuario->setNome($_REQUEST['nome']);
        $usuario->setEmail($_REQUEST['email']);
        $usuario->setIdUsuario($_REQUEST['id']);
        $usuarioMySqlDAO = new UsuarioMySqlDAO();
        $usuarioMySqlDAO->update($usuario);
    }
    
    public function trocar_senha() {
        $usuarioMySqlDAO = new UsuarioMySqlDAO();
        $usuarioMySqlDAO->updateSenha(MD5($_REQUEST['senha']), $_REQUEST['id']);
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
