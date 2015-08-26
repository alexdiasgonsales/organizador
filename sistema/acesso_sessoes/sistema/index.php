<?php
session_start();

include("../conexao.php");
include("../funcoes.php");
include("./constantes.php");

if (isset($_SESSION['adm']))
   {
      session_unset();
      session_destroy();
   }
$btVoltar = "index.php";  // MODIFICAR !!!


if(isset($_SESSION["id_usuario"])){
    header("Location: home.php");
}

?>
<script type="text/javascript" src="scriptCadastro.js"></script>
	<?php
		include("inc_cabecalho.php");
	?>
<div id="cont">
<h3 align="center" style="height:60px;" >Login de Usuário</h3>
<div id="form"  align="center">
<form method="post" name="form_index" action="login.php?diff=<?php echo elDiff(); ?>" target="_self" onsubmit="return valida_login()" >


<h3>Atenção</h3>
<h3>Todos autores e orientadores devem efetuar a inscrição no sistema<br> para poder ter seu nome vinculado ao trabalho.</h3>

<h4>Se você já está cadastrado no sistema, digite seu CPF e senha e clique em Entrar, caso contrário, efetue sua inscrição.</h4>

<!--
<h3>Inscrições de trabalhos encerrada em 14/10/2012.</h3>
-->

	<div id="cCpf" style="height:40px;">
		<label class="lblogin">CPF:</label> 
		<input type="text" id="cpf" name="cpf" maxlength="11" size="11"class="caixatxt" /><br><br>
	</div>
	
	<div id="cSenha" style="height:60px;">
		<label class="lblogin">Senha:</label> 
		<input type="password" id="senha" name="senha" maxlength="40" size="40"class="caixatxt" /><br><br>
		<div style="clear:both; height:5px;"></div>
	</div>
	<div id="botoes">
        <input type="button" value="Cancelar"  class="button gray"onclick="self.open('<?php echo $btVoltar; ?>','_self')" >
		<input type="button" value="Entrar" class="button blue submit">
	</div>	

</form>


<?php
if (isset($_REQUEST['erro'])) {
?>	<font color="#ff0000">Senha inválida</font>
<?php } ?> 


<?php
if (ETAPA_INSCRICAO_AUTOR == "1"){
?>
    <p>
    <a href="cadastroF.php?papel=autor"><h3>Inscrição de Autor</h3></a>
<?php
}
if (ETAPA_INSCRICAO_ORIENTADOR == "1"){
?> 
    <p>
    <a href="cadastroF.php?papel=orientador"><h3>Inscrição de Orientador</h3></a>
<?php
}
if(ETAPA_INSCRICAO_AVALIADOR == "1"){
?>
    <p>
    <a href="cadastroF.php?papel=avaliador"><h3>Inscrição de Avaliador</h3></a>
<?php
}
if(ETAPA_INSCRICAO_VOLUNTARIO == "1"){
?>
    <p>
    <a href="cadastroF.php?papel=voluntario"><h3>Inscrição de Voluntário</h3></a>
<?php
}
if(ETAPA_INSCRICAO_OUVINTE == "1"){
?>

<!--
<h3>Inscrição de ouvinte encerrada.</h3>
-->

<p>
<a href="cadastroF.php?papel=ouvinte"><h3>Inscrição de Ouvinte</h3></a>
<?php
}
?>

<!--
Atenção: Os autores e co-autores de trabalhos já estão automaticamente cadastrados como ouvinte.<br>
Orientadores e demais participantes que desejam receber certificado
como ouvinte devem efetuar a inscrição.
-->

<!--
<br>
<br>
<h3>Inscrição de voluntários encerrada.</h3>
-->

<p>
<a href="esqueci_a_senha.php" class="button red"><h4>Esqueci a Senha</h4></a>
Clique aqui se você esqueceu sua  senha.

<!--
<p>
<a href="cadastroF.php?papel=voluntario"><h3>Inscrição de Voluntário</h3></a>
Clique aqui para se inscrever como colaborador na organização do evento.


<p><h3>Inscrição de avaliadores temporariamente desativada.</h3>
-->

</div>
<script language="javascript">
function valida_login() {
	d = document.form_index;
	if(validaCpf() == false) {
		return validaCpf();
	}
	if(validaSenha() == false) {
		return validaCpf();
	}
  return true;
}
</script>
<?php
include("inc_rodape.php");
?>
