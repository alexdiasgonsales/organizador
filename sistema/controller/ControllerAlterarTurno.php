<?php
require_once 'autoload.php';
Login::VerificaLogin();
$controller = new Controller();
$controller->Executor("ControllerLogicVoluntario", 'turno');

