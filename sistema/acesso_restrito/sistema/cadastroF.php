<?php
session_start();

   if (isset($_SESSION['id_administracao'])) {
      session_unset();
      session_destroy();
    }
 
if(isset($_SESSION["id_usuario"])){
    $btVoltar = "home.php";
} else {
    $btVoltar = "index.php";
}
	include("inc_cabecalho.php");
	
	$papel = "";
	$modificar = "";
	if(!(isset($_SESSION["id_usuario"]))) {
		$papel = $_GET["papel"];
	} else if(isset($_SESSION["id_usuario"])) {
		$modificar = $_GET["modificar"];
	}
?>
	
	<script type="text/javascript" src="scriptCadastro.js"></script>
	<script type="text/javascript" src="scriptEstudos.js"></script>
	<script type="text/javascript" src="scriptValidacao.js"></script>
	
	<h3 id="titulo1" align="center">Inscrição de <?php echo $papel;?></h3>
	<h4 id="titulo2" align="center" style="display:none;">Alterar Dados</h4>

	<!-- Form 01: Solicitação de CPF -->
	<div id="form">
		<form method="post" id="formCadastro" name="formCadastro" target="_self" >
		<div id="label1" style="margin-left:20px;"> <h4> - Dados Pessoais - </h4> </div>
		
		<input type="hidden" id="papel" name="papel" value="<?php echo $papel;?>"/>
		<input type="hidden" id="opcao" name="opcao" value="verExistenciaCpf" />
		<input type="hidden" id="id_usuario" name="id_usuario" value=""/>
			
		<div id="campoCpf" style="height:30px; margin-left:15px;">
			<label>CPF:</label> 
			<input type="text" id="cpf" name="cpf" maxlength="11" size="11" style="width:150px; margin-left:10px"/>    
		</div>
			
		<div id="campoDados" style="display:none; margin-left:15px;height:60px;">
			<label>Nome:</label>
			<input type="text" id="nome" name="nome" maxlength="100" size="100" style="width:300px; margin-left:10px;" />
			<div style="clear:both; height:5px;"></div>
		
			<label>Email:</label>
			<input type="text" id="email" name="email" maxlength="100" size="100" style="width:300px; margin-left:10px;" />    
			<div style="clear:both; height:5px;"></div>
		</div>
			
		<div id="campoSenha" style="display:none; margin-left:15px;height:30px;">
			<label style="width:15px;">Senha:</label> 
			<input type="password" id="senha" name="senha" maxlength="40" size="40" style="width:150px;margin-left:10px;" />
			<div style="clear:both; height:5px;"></div>
		</div>
			
		<div id="campoRsenha" style="display:none; margin-left:15px;height:30px;">
			<label>Repetir a Senha:</label>
			<input type="password" id="rsenha" name="rsenha" maxlength="40" size="40" style="width:150px;margin-left:10px;" />
			<div style="clear:both; height:5px;"></div>
		</div>
		      
       <!-------------------------------------------------------------------------------------------->
                <!--------------------------- Turnos Disponíveis ---------------------------------------------->
                <!-------------------------------------------------------------------------------------------->
                
                <div id="label3" style="display:none;margin-left:20px;"> <h4> - Turnos Disponíveis - </h4> </div>
                
                <div id="campoTurnoDisponivel" style="display:none; width: 450px;margin-bottom: 10px">                                                       
                    <input type="checkbox" value="Manhã" name="cbManha" id="cbManhaD"> <label for="cbManhaD">Manhã</label>
                    &nbsp;&nbsp;
                    <input type="checkbox" value="Tarde" name="cbTarde" id="cbTardeD"><label for="cbTardeD">Tarde</label>
                    &nbsp;&nbsp;
                    <input type="checkbox" value="Noite" name="cbNoite" id="cbNoiteD"><label for="cbNoiteD">Noite</label>
                </div>
                
                <!-------------------------------------------------------------------------------------------->
                <!------------------------------------ Telefones --------------------------------------------->
                <!-------------------------------------------------------------------------------------------->
                
                <div id="label4" style="display:none;margin-left:20px;"> <h4> - Contato - </h4> </div>
		
                <div id="camposTelefones" style="display:none; width: 450px;margin-bottom: 10px">                                                       
                    <label for="telefone1">Telefone (obrigatório): </label><input id="telefone1" type="text" name="telefone1" size="12" /><br/>
                    <label for="telefone2">Telefone:</label><input id="telefone2" type="text" name="telefone2" size="12" /><br/>
                    <label for="telefone3">Telefone:</label><input id="telefone3" type="text" name="telefone3" size="12" />
                </div>
 
        <!-------------------------------------------------------------------------------------------->
        <!--------------------------- Dados Específicos ---------------------------------------------->
        <!-------------------------------------------------------------------------------------------->
		<div id="label2" style="display:none;margin-left:20px;"> <h4> - Dados Específicos - </h4> </div>
		
		<div id="campoEstudos1" style="display:none; margin-left:15px;">
			<div style="width:60px;float:left;">Instituição: </div>
			<select id="f_instituicao" name="f_instituicao" style="width:500px;float:left;" onchange="getCampus(); return false;"></select>
            
			<a href="#" class="links" style="margin-left:10px;" onclick="novaInstituicao(); return false;">Nova</a>
            			<div style="clear:both; height:5px;"></div>

			<div style="width:60px;float:left;">Campus: </div>
			<select id="f_campus" name="f_campus" style="width:500px;float:left;" onchange="getCursos(); return false;"></select>
			
            <a href="#" class="links" style="margin-left:10px;" onclick="novoCampus(); return false;">Novo</a>
            
			<div style="clear:both; height:5px;"></div>
		</div>
		
		<div id="campoEstudos2" style="display:none; margin-left:15px;">
			<div style="width:60px;float:left;">Curso: </div>
			<select id="f_curso" name="f_curso" style="width:500px;float:left;"></select>
			
            <a href="#" class="links" style="margin-left:10px;" onclick="novoCurso(); return false;">Novo</a>
			
            <div style="clear:both; height:15px;"></div>
		</div>
		
		<div id="campoTipoOuvinte" style="display:none; margin-left:15px;height:110px;">
			<label>Tipo:</label>
			<select id="tipoOuvinte" name="tipoOuvinte" style="margin-left:10px;">
				<option value="0">Selecione</option>
				<option value="1">Docente</option>
				<option value="2">Técnico Administrativo</option>
				<option value="3">Aluno</option>
				<option value="4">Outro</option>
			</select>
			<div style="clear:both; height:20px;"></div>
		
			<label>Outro:</label>
			<input type="text" id="descTipoOuvinte" name="descTipoOuvinte" maxlength="200" size="200" style="width:300px; margin-left:10px;" />    
			<div style="clear:both; height:5px;"></div>
		
			<label>Empresa:</label>
			<input type="text" id="empresaOuvinte" name="empresaOuvinte" maxlength="100" size="100" style="width:300px; margin-left:10px;" />    
			<div style="clear:both; height:5px;"></div>
		</div>
		
		<div id="campoTipoServidor" style="display:none; margin-left:15px;height:30px;">
			<label>Tipo de Servidor:</label>
			<select id="tipoServidorOrientador" name="tipoServidorOrientador" style="margin-left:10px;">
				<option value="0">Selecione</option>
				<option value="1">Docente</option>
				<option value="2">Técnico Administrativo</option>
			</select>
			<div style="clear:both; height:20px;"></div>
		</div>
		
		<div id="campoTipoServ_avaliador" style="display:none; margin-left:15px;height:30px;">
			<label>Tipo de Servidor:</label>
			<select id="tipoServidorAvaliador" name="tipoServidorAvaliador" style="margin-left:10px;">
				<option value="0">Selecione</option>
				<option value="1">Docente</option>
				<option value="2">Técnico Administrativo</option>
				<option value="3">Estudande de Pós-graduação Stricto Sensu</option>
			</select>
			<div style="clear:both; height:20px;"></div>
		</div>
		
		<div id="campoNivelFormacao" style="display:none; margin-left:15px;height:30px;">
			<label>Nível de formação:</label>
			<select id="nivelFormacao" name="nivelFormacao" style="margin-left:10px;">
				<option value="0">Selecione</option>
				<option value="3">Superior</option>
				<option value="4">Especialização</option>
				<option value="5">Mestrado</option>
				<option value="6">Doutorado</option>
			</select>
			<div style="clear:both; height:20px;"></div>
		</div>
		
		<input id ="botao" type="button" value="Continuar" style="width:140px;" onClick="verificaCPF();" />&nbsp;
		<input id="botao2" type="button" value="Cancelar" onClick="self.open('<?php echo $btVoltar; ?>','_self')" style="width:140px" />
		<div id="msg1" style="color:#ff0000;height:20px;display:none;"> Seu CPF já está vinculado a outro cadastro neste sistema. <br> Por favor digite a senha para continuar a inscrição.</div>
		<div id="msg2" style="color:#ff0000;height:20px;display:none;"> Senha Incorreta. </div>
		<div id="msg3" style="color:#ff0000;height:20px;display:none;"> Cadastro atualizado com sucesso. Seus novos dados foram reenviados para o seu email.</div>
		</form>
	</div>

	<!-- Inserir novos: Instituição/Campus/Curso -->
	
<div id="divSombra" style="width:100%; height:160%; position:absolute; top:0px; left:0px; z-index: 50; background: black; opacity: 0.7; display:none;"></div>	

<!-------------------------------------------------------------------------------------------->
<!------------------------------ Instituição ------------------------------------------------->
<!-------------------------------------------------------------------------------------------->
<div id="instAtuais" style="position:absolute; left:25%; top:150px; border:1px dotted black; background:white; z-index: 50; width:550px; height:500px; border-radius: 10px; padding-left:10px; display:none;">
	<div id="insereP1I">
		<h4 align="center"> Escolher Instituição: </h4>
		<h5 align="center"> Certifique-se de que sua Instituição não consta na lista abaixo antes de cadastrar uma nova. </h5>
		<h5 align="center"> Se sua instituição encontra-se na lista abaixo, selecione a mesma e clique em 'escolher'. <br> Caso contrário, clique em 'cadastrar nova instituição...' </h5>
		<div align="center"><select id="selectInst" name="selectInst" size="15"> </select> 
		<div style="clear:both; height:15px;"></div>			
		<a href="#" class="inserir" onclick="inserirI();" style="margin-left:20px;">Escolher</a>&nbsp &nbsp &nbsp
        <a href="#" class="cancelar" onclick="voltar1();">Cancelar</a>
        <br>
        <br>
		<a href="#" class="continuar" onclick="continuar1();" style="margin-left:20px;">Cadastrar nova instituição...</a></div>
		<div id="msgI" style="color:#ff0000;height:20px;display:none;" align="center"> Atenção: Nenhuma Instituição foi selecionada. </div>
	</div>
	<div id="formNewI" style="display:none;" align="center">
	<form id="newInst" name="newInst" method="post">	
		<div style="clear:both; height:40px;"></div>
		<h3>Cadastrar nova Instituição: </h3>
		<div style="clear:both; height:15px;"></div>
		<label style="font-size:10px;text-align:center;">ATENÇÃO: Somente cadastre uma nova Instituição se ela ainda não estiver cadastrada.</label>
		<div style="clear:both; height:30px;"></div>
    
		<label>Nome:</label>
		<input id="nomeInstituicao" name="nomeInstituicao" type="text" value="" style="margin-left:10px;" />
		<div style="clear:both; height:10px;"></div>
		
		<label>Sigla:</label>
		<input id="siglaInstituicao" name="siglaInstituicao" type="text" value="" style="margin-left:10px;" />
		<div style="clear:both; height:10px;"></div>
	
		<label>Cidade:</label>
		<input id="cidadeInstituicao" name="cidadeInstituicao" type="text" value="" style="margin-left:10px;" />
		<div style="clear:both; height:10px;"></div>
		
		<label>Estado:</label>
		<input id="estadoInstituicao" name="estadoInstituicao" type="text" value="" maxlength="2" size="2" style="margin-left:10px;" />
		<div style="clear:both; height:10px;"></div>
	
		<label>Site:</label>
		<input id="siteInstituicao" name="siteInstituicao" type="text" value="" style="margin-left:10px;" />
		<div style="clear:both; height:10px;"></div>
	
		<label>Tipo:</label>
	    <select id="tipoInstituicao" name="tipoInstituicao" style="margin-left:10px;" >
			<option value="0">Selecione</option>
			<option value="1">Instituto Federal</option>
			<option value="2">Escola Técnica</option>
			<option value="3">Instituição de Ensino Superior</option>
		</select>
		<div style="clear:both; height:20px;"></div>
    
	<a href="#" class="links" onclick="salvarInstituicao();">Salvar</a>
    <a href="#" class="links" style="margin-left:10px;" onclick="cancNovaInstituicao();">Cancelar</a>
	</form>
	</div>
</div>

<!-------------------------------------------------------------------------------------------->
<!------------------------------ Campus ------------------------------------------------->
<!-------------------------------------------------------------------------------------------->
<div id="campAtuais" style="position:absolute; left:25%; top:150px; border:1px dotted black; background:white; z-index: 50; width:500px; height:500px; border-radius: 10px; padding-left:10px; display:none;">
	<div id="insereP1Ca">
		<h4 align="center"> Novo Campus: </h4>
		<h5 align="center"> Certifique-se de que seu Campus não consta na lista abaixo antes de inserir um novo. </h5>
		<h5 align="center"> Em caso positivo, selecione o mesmo e clique em 'inserir'. <br> Caso contrário, clique em 'continuar' </h5>
		<div align="center"><select id="selectCamp" name="selectCamp" size="5"> </select> 
		<div style="clear:both; height:15px;"></div>
		<a href="#" class="cancelar" onclick="voltar2();">voltar</a>
		<a href="#" class="inserir" onclick="inserirCa();" style="margin-left:20px;">inserir</a>
		<a href="#" class="continuar" onclick="continuar2();" style="margin-left:20px;">continuar</a></div>
		<div id="msgCa" style="color:#ff0000;height:20px;display:none;" align="center"> Atenção: Nenhum Campus foi selecionado. </div>
	</div>
	<div id="formNew2" style="display:none;margin-top:50px;">
		<form id="newCampus" name="newCampus" method="post">	
		<h4 align="center">Cadastrar novo Campus: </h4>
		<div align="center"><label style="font-size:10px;">obs: Tenha certeza de ter escolhido a Instituição correta</label>
		<div style="clear:both; height:10px;"></div>
		<label>Nome:</label>
		<input id="nomeCampus" name="nomeCampus" type="text" value="" style="margin-left:10px;" /> 
		<div style="clear:both; height:20px;"></div>
		<a href="#" class="links" onclick="salvarCampus();">Salvar</a>
		<a href="#" class="links" style="margin-left:10px;" onclick="cancNovoCampus();">Cancelar</a> </div>
		</form>
	</div>
	</div>
	
<!-------------------------------------------------------------------------------------------->
<!------------------------------ Curso ------------------------------------------------->
<!-------------------------------------------------------------------------------------------->
<div id="cursAtuais" style="position:absolute; left:25%; top:150px; border:1px dotted black; background:white; z-index: 50; width:500px; height:530px; border-radius: 10px; padding-left:10px; display:none;">
	<div id="insereP1C">
		<h4 align="center"> Novo Curso: </h4>
		<h5 align="center"> Certifique-se de que seu Curso não consta na lista abaixo antes de inserir um novo. </h5>
		<h5 align="center"> Em caso positivo, selecione o mesmo e clique em 'inserir'. <br> Caso contrário, clique em 'continuar' </h5>
		<div align="center"> <select id="selectCurs" name="selectCurs" size="7"> </select> 
		<div style="clear:both; height:15px;"></div>
		<a href="#" class="cancelar" onclick="voltar3();">voltar</a>
		<a href="#" class="inserir" onclick="inserirC();" style="margin-left:20px;">inserir</a>
		<a href="#" class="continuar" onclick="continuar3();" style="margin-left:20px;">continuar</a></div>
		<div id="msgC" style="color:#ff0000;height:20px;display:none;" align="center"> Atenção: Nenhum Curso foi selecionado. </div>
	</div>
	<div id="formNew3" style="display:none;margin-top:25px;">
		<form id="newCurso" name="newCurso" method="post">	
		<h4 align="center">Cadastrar novo Curso: </h4>
		<div align="center"><label style="font-size:10px;text-align:center;">obs: Tenha certeza de ter escolhido o Campus correto</label>
		<div style="clear:both; height:5px;"></div>
    
		<label>Nível:</label>
		<select id="nivelCurso" name="nivelCurso" style="margin-left:10px;" >
			<option value="0">Selecione</option>
			<option value="2">Técnico</option>
			<option value="3">Superior</option>
		</select>
		<div style="clear:both; height:5px;"></div>
    
		<label>Nome:</label>
		<input id="nomeCurso" name="nomeCurso" type="text" value="" style="margin-left:10px;" />
		<div style="clear:both; height:20px;"></div>
		
		<a href="#" class="links" onclick="salvarCurso();">Salvar</a>
		<a href="#" class="links" style="margin-left:10px;" onclick="cancNovoCurso();">Cancelar</a></div>
		</form>
	</div>
</div>

<script>
	$(document).ready(function(){
        $("#telefone1").mask("(99)9999-9999");        
        <?php
			if(isset($_SESSION["id_usuario"]) && ($modificar=="Geral")){
				echo 'getCadUsuario('.$_SESSION["id_usuario"].');';
			} else if(isset($_SESSION["id_usuario"]) && ($modificar=="Autor")){
				echo 'insereCursoAut();';
			} else if(isset($_SESSION["id_usuario"]) && ($modificar=="Orientador")){
				echo 'insereCampusOr();';
			}
		?>
    });
	
	function insereCursoAut(id) {
	$("#msgI").hide();
	$("#campoEstudos1").show();
	$("#campoEstudos2").show();
	$("#opcao").val("inserirCursoAut");
	$("#botao").val("inserir");
	$("#botao2").val("voltar");
}	

function insereCampusOr(id) {
	$("#msgI").hide();
	$("#campoEstudos1").show();
	$("#opcao").val("inserirCampusOr");
	$("#botao").val("inserir");
	$("#botao2").val("voltar");
}


function continuar1() {
	$("#insereP1I").hide();
	$("#formNewI").show();
}

function continuar2() {
	$("#formNew2").show();
}

function continuar3() {
	$("#formNew3").show();
}

// desiste de inserir nova: encontra sua unidade na lista
function inserirI() {
	var str = $("#selectInst").val();
	if(str == 0) {
		$("#msgI").show();
	} else {
		$("#f_instituicao").val(str);
		getCampus();
		voltar1();
	}
}
function inserirCa() {
	var str = $("#selectCamp").val();
	if(str == 0) {
		$("#msgCa").show();
	} else {
		$("#f_campus").val(str);
		getCursos();
		voltar2();
	}
}
function inserirC() {
	var str = $("#selectCurs").val();
	if(str == 0) {
		$("#msgC").show();
	} else {
		$("#f_curso").val(str);
		voltar3();
	}
}

// voltar
function voltar1() {
	$("#divSombra").hide();
	$("#instAtuais").hide();
}
function voltar2() {
	$("#divSombra").hide();
	$("#campAtuais").hide();
}
function voltar3() {
	$("#divSombra").hide();
	$("#cursAtuais").hide();
}

</script>
<?php
include("inc_rodape.php");
?>
