<?php
session_start();

include("../conexao.php");
include("../funcoes.php");

if (isset($_SESSION['adm']))
   {
      session_unset();
      session_destroy();
   }
$btVoltar = "index.php";  // MODIFICAR !!!
include("inc_cabecalho.php");

if(isset($_SESSION["id_usuario"])){
    header("Location: home.php");
}

?>
<script type="text/javascript" src="scriptCadastro.js"></script>

<div id="form" style="height:150px;" align="center">

<p>
<a href="form_login.php"><H3>Login</H3></a>

<p>
<a href="cadastroF.php?papel=autor"><h3>Inscrição de Autor</h3></a>

<p>
<a href="cadastroF.php?papel=orientador"><h3>Inscrição de Orientador</h3></a>


<?php
if (isset($_REQUEST['erro'])) {
?>	<font color="#ff0000">Senha inválida</font>
<?php } ?> 

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
