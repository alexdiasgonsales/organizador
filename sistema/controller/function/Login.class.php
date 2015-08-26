<?php

class Login {

    public static function VerificaLogin() {
        if (isset($_SESSION['authUser'])) {  
           if($_SESSION['authUser']->id == $_REQUEST['id']){
               return true;
           } else {
              header("Location:" . HOME . 'index.php');
           }
        } else {
          header("Location:" . HOME . 'index.php');
        }
    }

    public function Login($cpf = null, $pass = null) {

        $pesquisa = new UsuarioMySqlDAO();
        $retorno = $pesquisa->loadLoginPassword($cpf, $pass);
        if ($retorno == false) {
            $valid = false;
        } else {
            $valid = true;
            $_SESSION['authUser'] = $retorno;
            $_SESSION['id_usuario'] = $retorno->id;
        }
        return $valid;
    }

}
