<?php
session_start();

include("../conexao.php");
include("../funcoes.php");

if (isset($_REQUEST['mail']))
   {
      $email   = mysql_real_escape_string($_POST['mail']);
   }
else   
   {
      header("Location: index.php?diff=".elDiff());
   }

//echo $cpf."<br>".$senha;
$sql_busca_email= "SELECT * FROM usuario WHERE email='".$email."'";
$result_busca = mysql_query($sql_busca_email,$conexao);
$num_reg_busca = mysql_num_rows($result_busca);
if ((int)$num_reg_busca!=1) {
      header("Location: esqueci_a_senha.php?erro=sim&diff=".elDiff());
   } else {
	$senha = rand(100000,10000000000);
	$linha_user = mysql_fetch_array($result_busca);
	$assunto = 'Alteração de Senha: Mostra/IFRS';
	$mensagem = 'Prezado(a) '.$linha_user["nome"].'<br>';
	$mensagem .= 'Sua senha temporária de acesso à Mostra é: '.$senha.'\n';
	$mensagem .= 'Por favor, acesse o sistema e altere esta senha por questões de segurança.\n';
    $mensagem .= 'http://mostra.poa.ifrs.edu.br\n';
	$senha = MD5($senha);
	$sql_update = "UPDATE usuario SET senha='".$senha."' WHERE email='".$email."'";
	$result_update = runSQL($sql_update);
	
	if($result_update != false) {
		$envia = mail("$email", "$assunto", "$mensagem", "from:mostra@poa.ifrs.edu.br");
		//if($envia == true) {
			echo "<pre>Para: $email ";
			echo "Assunto: $assunto ";
			echo "Mensagem: $mensagem </pre> <br><br>";
		//} else {
			// echo 'error.';
		// }
		echo "<script>alert('A senha temporária foi enviada ao seu e-mail.');</script>";
		header("Location: index.php");
	} else {
		echo mysql_error();
	}
	}
?>
