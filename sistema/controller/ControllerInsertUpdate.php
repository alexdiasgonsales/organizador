<?php

require_once 'autoload.php';
// sequence of insert or update controllers
// author
var_dump($_REQUEST);
$controller = new Controller();
$class = (is_string($_REQUEST['papel'])) ? $_REQUEST['papel'] : '';
$action = (is_string($_REQUEST['operacao'])) ? $_REQUEST['operacao'] : '';
$cpf = (is_string($_REQUEST['cpf'])) ? preg_replace("/[^0-9]/", "", $_REQUEST['cpf']) : '';
$pass = (is_string($_REQUEST['senha'])) ? md5($_REQUEST['senha']) : '';

if ($action == 'edit') {
    $existe = $_SESSION['authUser'];
    $_SESSION['authUser'] = (array) $existe;
    if (isset($_SESSION['authUser']) && $_SESSION['authUser'][$_REQUEST['papel']] == null){
         $controller->Executor('ControllerLogic' . ucfirst($class), 'add');
         $login = new Login($cpf, $pass);
    }
    header("Location:" .HOME. 'controller/ControllerLogin.php');
    return;
} else if ($action === 'add') {
    if (!isset($_SESSION['authUser'])) {
        $controller->Executor('ControllerLogicUsuario', 'add');
        $controller->Executor('ControllerLogic' . ucfirst($class), 'add');
    }

    $login = new Login($cpf, $pass);
    header("Location:" .HOME. 'controller/ControllerLogin.php');
    return;
} 



