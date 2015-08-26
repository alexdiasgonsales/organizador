<?php
require_once 'autoload.php';
OtherFuctions::verffyOrg(); /* conforme acordado em reuniao */
/* a funcao está invalidada, fica alerta sobre sql injection,
 * conforme email do professor não é necessario não preciso verificar se ele é um organizador,
 *  pois não tenho a id do organizador se eu passar uma url, o sistema altera exemplo ...id=45&status=1*/
var_dump($_REQUEST);
$controller = new Controller();
$controller->Executor("ControllerLogicOrganizador", 'changeStatus'.ucfirst($_REQUEST['role']));
return;
