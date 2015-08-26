<?php
require_once 'autoload.php';

if (isset($_REQUEST['opcao']) && $_REQUEST['opcao'] = 'verificaCpfSenha'){
    $validator = new Validator();
    $senha = (!isset($_REQUEST['senha']) || $_REQUEST['senha'] == 'undefined') ? null  : md5($_REQUEST['senha']);
    $cpf = (is_string($_REQUEST['cpf'])) ? preg_replace("/[^0-9]/", "", $_REQUEST['cpf']) : '';
    $valid = $validator->validSenha($cpf,$senha); 
}
