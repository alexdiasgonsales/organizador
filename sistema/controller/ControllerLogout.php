<?php
require_once 'autoload.php';
if (isset($_REQUEST['acao']) && $_REQUEST['acao'] == 'logout'){
   $controller = new Controller(); 
   $controller->Executor('Logout', $_REQUEST['acao']);
}

