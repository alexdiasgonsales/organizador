<?php
session_start();

include("../../conexao.php");

include("inc_cabecalho.php");

?>

<h3 id="titleCadastro" name="titleCadastro" style="margin-top:50px;color:#4F6228;" align="center"> Cadastro Administração </h3>
<h3 id="titleEditar" name="titleEditar" style="margin-top:50px;color:#4F6228;display:none;" align="center"> - Administração: Alterar Dados - </h3>
<div style="clear:both; height:30px;"></div>

<div id="formulario" align="center"> 
<form id="formAdmin" name="formAdmin" method="POST">
	<label> Nome de usuário: </label>
	<input type="text" id="usuario" name="usuario" maxlength="50" style="margin-left:10px;" />
	<div style="clear:both; height:30px;"></div>
	
	<label> Senha: </label>
	<input type="password" id="senha" name="senha" value="" maxlength="50" style="margin-left:10px;" />
	<div style="clear:both; height:30px;"></div>
	
	<label> Repetir a Senha: </label>
	<input type="password" id="rsenha" name="rsenha" value="" maxlength="50" style="margin-left:10px;" />
	<div style="clear:both; height:30px;"></div>
	
	<input type="hidden" id="nivel" name="nivel" style="margin-left:10px;"> 
	
	<!--
	<label> Nível de Acesso: </label>
	<select id="nivel" name="nivel" style="margin-left:10px;"> 
		<option value="1"> 1 </option>
		<option value="2"> 2 </option>
		<option value="3"> 3 </option>
		<option value="4"> 4 </option>
		<option value="5"> 5 </option>
	</select>
	-->
	
	<div style="clear:both; height:30px;"></div>
	<a href="#" id="botao" name="botao" class="link1" onclick="enviarCadastro();">Salvar</a>
	<a href="home_restrito.php" id="botaoCancela" name="botaoCancela" class="link1" style="display:none;margin-left:20px;">Cancelar</a>
	<div style="clear:both; height:20px;"></div>
	
	<div id="msg1" style="color:#ff0000;display:none;">Por favor, preencha o campo USUÁRIO.</div>
	<div id="msg2" style="color:#ff0000;display:none;">Por favor, preencha o campo SENHA.</div>
	<div id="msg3" style="color:#ff0000;display:none;">Por favor, preencha o campo de confirmação de senha.</div>
	<div id="msg4" style="color:#ff0000;display:none;">As senhas não conferem.</div>
	<div id="msg5" style="color:#ff0000;display:none;">Desculpe, ocorreu um erro interno. Tente novamente. </div>
</form>
</div> 
 
 <script>
	$(document).ready(function(){
		<?php
			if(isset($_SESSION["id_administracao"]))
				echo "editarCadastro(".$_SESSION["id_administracao"].");";
		?>
	});
	
	
	function enviarCadastro() {
		if(validaCadAdm() == false)
			return false;
			
		var form = $("#formAdmin").serialize();
		var str = new Array();
		str.push("option=cadastraAdministrador");
		str.push(form);
		
		$.ajax({
			type: "POST",
			url: 'restritoAdm.php', 
			data: str.join("&"),
			success: function(data) {
				if(data == -9) {
					$("#msg1").show();
				} else if(data == -8) {
					$("#msg2").show();
				} else if(data == -7) {
					$("#msg3").show();
				} else if(data == -6) {
					$("#msg4").show();
				} else if(data == -1) {
					$("#msg5").show();
				} else if(data==1) {
					alert('Cadastro realizado com sucesso!');
					window.location = "home_restrito.php";
				}
			}
		});
	}
			
	function validaCadAdm() {
		d = document.formAdmin;
		if(d.usuario.value == "") {
			alert('Por favor, preencha o USUARIO.');
			d.usuario.focus();
			return false;
		}
		if(d.senha.value == "") {
			alert('Por favor, preencha a SENHA.');
			d.senha.focus();
			return false;
		}
		if(d.rsenha.value == "") {
			alert('Por favor, preencha a confirmação da senha.');
			d.rsenha.focus();
			return false;
		}
		if(d.senha.value != d.rsenha.value) {
			alert('As senhas não conferem.');
			d.rsenha.focus();
			return false;
		}
		return true;
	}
 
	function editarCadastro(id) {
		var str = new Array;
		str.push("option=editarCadastro");
		str.push("id_admin="+id);
		
		$("#titleCadastro").hide();
		$("#titleEditar").show();
		$("#botaoCancela").show();
		$("#botao").val("editar");
		$("#botao").attr("onclick", "atualizarCadastro();");
		$.ajax({
			type: "POST",
			url: 'restritoAdm.php', 
			data: str.join("&"),
			success: function(data) {
				eval(data);
				$("#usuario").val(dados.usuario);
				$("#nivel").val(dados.nivel);
			}
		});
	}	
 
	function atualizarCadastro() {
		var form = $("#formAdmin").serialize();
		var str = new Array();
		str.push("option=atualizarCadastro");
		str.push(form);
		$.ajax({
			type: "POST",
			url: 'restritoAdm.php', 
			data: str.join("&"),
			success: function(data) {
				if(data == 1) {
					alert('Dados alterados com sucesso!');
					window.location = "home_restrito.php";
				} else if(data == -1) {
					alert('Erro.');
				}
			}
		});
	}
 
 </script>
 
<?php
include("inc_rodape.php");
?>