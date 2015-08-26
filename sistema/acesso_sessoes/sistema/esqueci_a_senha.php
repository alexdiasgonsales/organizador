<?php
session_start();

if (isset($_SESSION['adm']) || isset($_SESSION["id_usuario"])) {
      session_unset();
      session_destroy();
   }

include("inc_cabecalho.php");

?>
<script type="text/javascript" src="scriptCadastro.js"></script>


<h3 align="center" style="height:60px;" >Esqueci a Senha</h3>
<div id="form"  align="center">
<form method="post" name="form_forgot_pass" action="action_new_pass.php" target="_self" onsubmit="return valida_forgot_pass()" >

<!--
<h3>Atenção</h3>
<h3>Todos autores e orientadores devem efetuar a inscrição no sistema<br> para poder ter seu nome vinculado ao trabalho.</h3>

<h4>Se você já está cadastrado no sistema, digite seu CPF e senha e clique em Entrar, caso contrário, efetue sua inscrição.</h4>

-->
<!--
<h3>Inscrições de trabalhos encerrada em 14/10/2012.</h3>
-->

	<div id="cEmail" style="height:40px;">
		<label for="mail">E-mail:</label> 
		<input type="text" id="mail" name="mail" maxlength="100" size="100" style="width:150px; margin-left:10px"/>   
	</div>
	
	<div id="botoes" style="height:50px;">
		<input type="submit" value="Enviar" style="width:100px">
        <input type="button" value="Cancelar" onclick="self.open('index.php','_self')" style="width:100px">
	</div>	

</form>


<?php
if (isset($_REQUEST['erro'])) {
?>	<font color="#ff0000">Email Inválido</font>
<?php } ?> 

<br>Por favor, informe o e-mail vinculado ao seu cadastro na Mostra, para que uma senha temporária seja enviada para o mesmo.


</div>
<script language="javascript">
function valida_forgot_pass() {
	d = document.form_forgot_pass;
	if (d.mail.value=="") {
			alert('Favor digitar o e-mail.');
			d.mail.focus();
			return false;
		}
		if(!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(d.mail.value))) {
			alert("Favor digitar um endereço de e-mail válido.");
			d.mail.focus();
			return false;
		}
	return true;
}

</script>

<?php
include("inc_rodape.php");
?>
