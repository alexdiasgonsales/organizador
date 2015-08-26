<?php

require_once 'autoload.php';

$esqueceuSenha = new UsuarioMySqlDAO();
$cpf = (is_string($_REQUEST['cpf'])) ? preg_replace("/[^0-9]/", "", $_REQUEST['cpf']) : '';

if (isset($_SESSION['authUser'])) {
  $id = $_SESSION['authUser']->id;
}
else {
  $id = null;
}

//Registra Log 1.
$descricao = "cpf=".$_REQUEST['cpf'];
$log_dao = new LogMysqlDAO();
$log = new Log($id, "usuario", "esqueceu_senha_1", $descricao);
$log_dao->insert($log);

$esqueceuSenhaUsuario = $esqueceuSenha->loadCPFEsqueceu($cpf);
//var_dump($esqueceuSenhaUsuario);
if ($esqueceuSenhaUsuario == false):
    Login::VerificaLogin(); //se não encontrar manda para página inicial
    return;
endif;

//Registra Log 2.
$descricao = "cpf=".$esqueceuSenhaUsuario->cpf.", nome=".$esqueceuSenhaUsuario->nome.", email=".$esqueceuSenhaUsuario->email;
$log_dao = new LogMysqlDAO();
$log = new Log($id, "usuario", "esqueceu_senha_2", $descricao);
$log_dao->insert($log);

// 25d55ad283aa400af464c76d713c07ad
$email = $esqueceuSenhaUsuario->email;
$novaSenha = rand(100000, 10000000000);
$assunto = MOSTRA_TITULO_CURTO." (requisição de nova senha)";
$mensagem = "Prezado(a) " . $esqueceuSenhaUsuario->nome . ",\n";
$mensagem .= "Sua senha temporária de acesso à Mostra é: " . $novaSenha . "\n";
$mensagem .= "Por favor, acesse o sistema e altere esta senha por questões de segurança.\n";
$mensagem .= "http://mostra.poa.ifrs.edu.br\n";
$senha = MD5($novaSenha);
$esqueceuSenha->updateSenha($senha, $esqueceuSenhaUsuario->id_usuario);
$envia = mail("$email", "$assunto", "$mensagem", "from:mostra@poa.ifrs.edu.br");
return;




