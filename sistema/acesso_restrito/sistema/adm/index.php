<?php
session_start();

include("../../conexao.php");
include("../../funcoes.php");

if (isset($_SESSION['id_administracao'])){
      session_unset();
      session_destroy();
 }
   
include("../inc_cabecalho.php");

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
<h3 align="center" style="height:60px;" >- Login Administração -</h3>
<div id="form"  align="center">
<form method="post" name="form_index" action="loginAdm.php?diff=<?php echo elDiff(); ?>" target="_self" onsubmit="return valida_loginAdm()" >
	
	<div id="cCpf" style="height:40px;">
		<label>CPF:</label> 
		<input type="text" id="usuario" name="usuario" maxlength="50" style="width:150px; margin-left:10px"/>   
	</div>
	
	<div id="cSenha" style="height:60px;">
		<label style="width:15px;">Senha:</label> 
		<input type="password" id="senha" name="senha" maxlength="50" style="width:150px;margin-left:10px;" />
		<div style="clear:both; height:5px;"></div>
	</div>
	<div id="botoes" style="height:50px;">
		<input type="submit" value="Entrar" style="width:100px">
        <input type="button" value="Cancelar" onclick="" style="width:100px">
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
