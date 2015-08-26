<?php
session_start();

include("../../conexao.php");
include("../../funcoes.php");

if ((isset($_REQUEST['usuario']))&&(isset($_REQUEST['senha'])))
   {
      $usuario   = mysql_real_escape_string($_POST['usuario']);
      $senha = mysql_real_escape_string($_POST['senha']);
   }
else   
   {
      header("Location: ../index.php?diff=".elDiff());
   }

//echo $cpf."<br>".$senha;

$senha = MD5($senha);
$usuario = inclui_zeros(mysql_real_escape_string($_POST['usuario']),11);
//$sql_login= "SELECT * FROM adm2 WHERE (usuario='".$usuario."' AND senha='".$senha."') ";
$sql_login = "select u.cpf as usuario, u.cpf, u.id_usuario, r.fk_usuario revisor, o.fk_usuario organizador 
                from usuario u 
                left join revisor r on (r.fk_usuario = u.id_usuario) 
                left join organizador o on (o.fk_usuario = u.id_usuario)
                where u.cpf = '".$usuario."' and senha= '".$senha."'";

$result_login = runSQL($sql_login);
$num_reg_login = mysql_num_rows($result_login);
$linha_login = mysql_fetch_array($result_login);

if ($linha_login['revisor'] == NULL && $linha_login['organizador'] == NULL)
//if ((int)$num_reg_login!=1)
   {
      header("Location: index.php?erro=sim&diff=".elDiff());
   }
else
   {
      $_SESSION['usuario'] = $linha_login['usuario'];
      $_SESSION['id_administracao'] = $linha_login['id_usuario'];
      if ($linha_login['cpf']=="75516110025")
        $_SESSION['nivel_adm'] = 0;
      else
        $_SESSION['nivel_adm'] = 2;
      header("Location: home_restrito.php");
   }


?>
