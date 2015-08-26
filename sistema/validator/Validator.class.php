<?php

class Validator {

    public static function validCPF($cpf) {
        $d1 = 0;
        $d2 = 0;
        //$alex_list = array('111111111', '222222222', '333333333', '444444444', '555555555', '666666666', '777777777', '888888888', '999999999');
        //if (in_array(substr($cpf, 0, 9), $alex_list) && strlen($cpf) == 11) {
        //    return true;
       // }
        $ignore_list = array('00000000000', '01234567890', '11111111111', '22222222222', '33333333333', '44444444444', '55555555555', '66666666666', '77777777777', '88888888888', '99999999999');
        if (strlen($cpf) != 11 || in_array($cpf, $ignore_list)) {
            return 0;
        }

        for ($i = 0; $i < 9; $i++) {
            $d1 += $cpf[$i] * (10 - $i);
        }
        $r1 = $d1 % 11;
        $d1 = ($r1 > 1) ? (11 - $r1) : 0;
        for ($i = 0; $i < 9; $i++) {
            $d2 += $cpf[$i] * (11 - $i);
        }
        $r2 = ($d2 + ($d1 * 2)) % 11;
        $d2 = ($r2 > 1) ? (11 - $r2) : 0;

        $checkCPF = (substr($cpf, -2) == $d1 . $d2) ? true : false;
        return $checkCPF;
    }

    public function validName() {
        $validName = (is_string($_REQUEST['valor'])) ? $_REQUEST['valor'] : '123';
        $name = preg_match("#^([ÁÉÍÓÚáãâéíóõôúça-zA-Z\\._\/ ]+)$#i", $validName) ? true : false;
        if (!$name && strlen($name) < 5) {
            echo "Corrija o campo nome !!!!";
            return;
        }
        echo $name;
    }

    public function validEmail() {
        $email = (is_string($_REQUEST['valor'])) ? $_REQUEST['valor'] : '123';
        $expressionEmail = "/^(([0-9a-zA-Z]+[-._+&])*[0-9a-zA-Z]+@([-0-9a-zA-Z]+[.])+[a-zA-Z]{2,6}){0,1}$/";
        if (preg_match($expressionEmail, $email) && strlen($email) > 5) {
            echo true;
            return;
        }
        echo "Corrija o campo email !!!!";
    }

    public function validLogin($cpf) {

        $valid = Validator::validCPF($cpf);
        if (!$valid) {
            echo 'false';
            return;
        } else {
            $pesquisa = new UsuarioMySqlDAO();
            $valid = $pesquisa->loadCPF($cpf);
            if ($valid == false) {
                $_REQUEST['operacao'] = 'add';
                $controller = new Controller();
                $controller->Executor('ViewUsuario', 'inscricao');
                return;
            } else {
                echo 'existe';
                return;
            }
        }
    }

    public function validSenha($cpf, $senha) {
        $pesquisa = new UsuarioMySqlDAO();
        $validpesq = $pesquisa->loadLoginPassword($cpf, $senha);
        if ($validpesq == false) {
            echo 'invalido';
        } else {
            $_REQUEST['operacao'] = 'edit';
            if (isset($validpesq->$_REQUEST['role']) && $validpesq->$_REQUEST['role'] != NULL) {
                echo 'cadastrado';
                return;
            }
            $_REQUEST['authUser'] = (array) $validpesq;
            $controller = new Controller();
            $controller->Executor('ViewUsuario', 'inscricao');
        }
    }

}
