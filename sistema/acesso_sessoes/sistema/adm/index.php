<?php
session_start();

include("../../conexao.php");
include("../../funcoes.php");

if (isset($_SESSION['id_administracao'])){
      session_unset();
      session_destroy();
 }
   
include("inc_cabecalho2.php");

if(isset($_SESSION["id_usuario"])){
    header("Location: ../home.php");
}


?>
<script src="./../../jscripts/jquery-1.7.2.min.js" type="text/javascript"></script>
<script src="./../../site/js/jquery.maskedinput-1.3.min.js" type="text/javascript"></script>
<script>
    $(document).ready(function() {
        $("#usuario").mask("999.999.999-99");
    });
</script>

<div id="form"  align="center">
<h3 class="titulo">- Login Administração -</h3>
<form method="post" name="form_index" action="loginAdm.php?diff=<?php echo elDiff(); ?>" target="_self" onsubmit="return valida_loginAdm()" >
	
	<div class="form">

		<label for="cpf" class="lblogin">CPF:</label> 
		<input type="text" id="usuario" name="usuario" class="caixatxt"/><br>

		<label for="senha" class="lblogin">Senha:</label> 
		<input type="password" id="senha" name="senha" class="caixatxt"/><br>

	</div>

	<div class="botoes">
        <input type="reset" value="Cancelar" id="reset" class="button gray">
		<input type="submit" value="Entrar" id="submit" class="button blue submit">
	</div>	

</form>


<?php
if (isset($_REQUEST['erro'])) {
?>	<font color="#ff0000">Senha inválida</font>
<?php } ?> 

</div>
<script language="javascript">
    
function valida_loginAdm() {
	d = document.form_index;
	if(d.usuario.value == "") {
		d.senha.focus();
		alert('Por favor preencha o campo CPF.');
		return false;
	}
	if(d.senha.value == "") {
		d.senha.focus();
		alert('Por favor preencha o campo SENHA.');
		return false;
	}
  return true;
}
</script>

<?php
include("../inc_rodape.php");
?>
