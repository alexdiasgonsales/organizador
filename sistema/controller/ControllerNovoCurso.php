<?php
require_once 'autoload.php';
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$id = (int)$_REQUEST['id'];
$curso=(int)$_REQUEST['curso'];
$find = new AutorCursoMySqlDAO();
$count = $find->loadAutorCurso($id, $curso);
if ($count->count > 0){
    echo 'false';
} else {
    $controller = new Controller();
    $controller->Executor('ControllerLogicAutorCurso', $_REQUEST['acao']);
    echo $_REQUEST['id'].$_REQUEST['curso'];
}



