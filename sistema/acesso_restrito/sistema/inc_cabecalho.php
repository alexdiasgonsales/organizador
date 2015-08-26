<?php

?>

<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=8" />
<link rel="shortcut icon" href="favicon.ico" >
<meta http-equiv="Content-Type" content="text/html"; charset="utf-8">
<title>14ª Mostra de Pesquisa, Ensino e Extensão - Práticas e Interações - IFRS - Porto Alegre</title>
<LINK rel=stylesheet type=text/css href="mostratec2.css" charset="utf-8">

<script language="javascript"> 
function FormataCpf(campo, teclapres)
{
	var tecla = teclapres.keyCode;
	var vr = new String(campo.value);
	vr = vr.replace(".", "");
	vr = vr.replace("/", "");
	vr = vr.replace("-", "");
	tam = vr.length + 1;
	if (tecla != 14)
	{
		if (tam == 4)
			campo.value = vr.substr(0, 3) + '.';
		if (tam == 7)
			campo.value = vr.substr(0, 3) + '.' + vr.substr(3, 6) + '.';
		if (tam == 11)
			campo.value = vr.substr(0, 3) + '.' + vr.substr(3, 3) + '.' + vr.substr(7, 3) + '-' + vr.substr(11, 2);
	}
}
</script>
<script src="../jscripts/jquery-1.7.2.min.js" type="text/javascript"></script>
<script src="maskedinput.js" type="text/javascript"></script>

<style>
    #controle ul {list-style: none;}
    #controle ul li a {font-size:10px;}
    .links {font-size:10px;}
    
</style>

</head>

<body bgcolor="#A2AD69" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table border="0" cellpadding="0" cellspacing="0" width="790" align="center">
  <tr>
   <td><img name="formularios_r1_c1" src="images/formularios_r1_c1.png" width="790" height="152" border="0" usemap="#m_formularios_r1_c1"></td>
  </tr>
  <tr>
   <td><table border="0" cellpadding="0" cellspacing="0" width="790">
	  <tr>
	   <td background="images/formularios_r2_c1.png" style="background-repeat:repeat-y"><img name="formularios_r2_c1" src="images/formularios_r2_c1.png" width="19" height="70" border="0"></td>
	   <td background="images/formularios_r2_c2.png" width="752" height="1" bgcolor="#ffffff" style="background-repeat:repeat-y">
	   <!--<img name="formularios_r2_c2" src="images/formularios_r2_c2.png" width="752" height="70" border="0">-->
<?php 
if (isset($_SESSION['nome_usuario']))
   {
     echo "&nbsp;&nbsp;<b>Você está logado como:</b>&nbsp;".$_SESSION['nome_usuario'].'<label style="margin-left:20px;font-size:10px;"><a href="#" onclick="logout(); return false;" class="link1" style="font-size:10px;text-decoration:underline;">Sair</a></label>';   
   } else if(isset($_SESSION['id_administracao'])) {
		echo "&nbsp;&nbsp;<b>Você está logado como:</b>&nbsp;".$_SESSION['usuario'].'<label style="margin-left:20px;font-size:10px;"><a href="#" onclick="logout(); return false;" class="link1" style="font-size:10px;text-decoration:underline;">Sair</a></label>';   
   }	
?>
