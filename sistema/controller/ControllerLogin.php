<?php
include_once 'autoload.php';
if (isset($_REQUEST['cpf']) && isset($_REQUEST['senha']) && !isset($_SESSION['authUser'])) {
    $cpf = (is_string($_REQUEST['cpf'])) ? preg_replace("/[^0-9]/", "", $_REQUEST['cpf']) : '';
    $pass = (is_string($_REQUEST['senha'])) ? md5($_REQUEST['senha']) : '';
    $login = new Login();
    $valid = $login->Login($cpf, $pass);
    if ($valid) {
        ViewUsuario::viewAreaUsuario();
        return;
    } else {
        ViewUsuario::viewLoginNoAuth();
        return;
    }
}
if (isset($_SESSION['authUser'])){
    $existe = $_SESSION['authUser'];
    $_SESSION['authUser'] = (object) $existe;
    ViewUsuario::viewAreaUsuario();
    return;
} else {
    $logout = new Logout();
    $logout->Logout();
}



