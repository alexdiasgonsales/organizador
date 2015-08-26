<?php
session_start();

include("../conexao.php");
include("../funcoes.php");

if ((isset($_REQUEST['cpf']))&&(isset($_REQUEST['senha'])))
   {
      $cpf   = inclui_zeros(mysql_real_escape_string($_POST['cpf']),11);
      $senha = mysql_real_escape_string($_POST['senha']);
   }
else   
   {
      header("Location: index.php?diff=".elDiff());
   }

//echo $cpf."<br>".$senha;

$senha = MD5($senha);
$sql_login= "SELECT * FROM usuario WHERE (cpf='".$cpf."' AND senha='".$senha."') ";
$result_login = mysql_query($sql_login,$conexao);
$num_reg_login = mysql_num_rows($result_login);
$linha_login = mysql_fetch_array($result_login);

if ((int)$num_reg_login!=1)
   {
      header("Location: index.php?erro=sim&diff=".elDiff());
   }
else
   {
      $_SESSION['id_usuario'] = $linha_login['id_usuario'];
      $_SESSION['nome_usuario'] = $linha_login['nome'];
      header("Location: home.php");
      //header("Location: cadastro.php?diff=".elDiff());
      //header("Location: cadastro.php?id_autor=".$linha_login['id_autor']."&diff=".elDiff());
   }


?>
