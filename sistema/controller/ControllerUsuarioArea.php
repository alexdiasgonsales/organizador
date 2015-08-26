<?php
require_once 'autoload.php';
Login::VerificaLogin();
$controller = new Controller();
//$controller->Executor('ControllerLogicUsuario', 'edit');
$controller->Executor('ControllerLogicUsuario', $_REQUEST['acao']);
