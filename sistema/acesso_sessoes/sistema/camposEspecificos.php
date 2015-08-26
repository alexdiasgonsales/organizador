<?php
session_start();

$btVoltar = "home.php";
?>
<script type="text/javascript" src="scriptCadastro.js"></script>
<script type="text/javascript" src="scriptValidacao.js"></script>
<script type="text/javascript" src="scriptEstudos.js"></script>

<div id="divSombra" style="width:100%; height:160%; position:absolute; top:0px; left:0px; z-index: 49; background: black; opacity: 0.7; display:none;"></div>	

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
		<a href="#" class="cancelar" onclick="voltar2();">Voltar</a>
		<a href="#" class="inserir" onclick="inserirCa();" style="margin-left:20px;">Escolher</a>
		<a href="#" class="continuar" onclick="continuar2();" style="margin-left:20px;">Cadastrar novo campus...</a></div>
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
		<a href="#" class="cancelar" onclick="voltar3();">Voltar</a>
		<a href="#" class="inserir" onclick="inserirC();" style="margin-left:20px;">Escolher</a>
		<a href="#" class="continuar" onclick="continuar3();" style="margin-left:20px;">Cadastrar novo curso...</a></div>
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

<div id="formChangeData">
<form method="post" id="formCadastro" name="formCadastro" target="_self" >
	<input type="hidden" id="opcao" name="opcao" value="" />
	
	<div id="campoEstudos1" style="display:none; margin-left:15px;">
		<div style="width:80px;float:left;">Instituição: </div>
        <!-- Mudei para width:500px -->
		<select id="f_instituicao" name="f_instituicao" style="width:500px;float:left;" onchange="getCampus();"></select>
		<a href="#" class="links" style="margin-left:10px;" onclick="novaInstituicao(); return false;">Nova instituição...</a>
		<div style="clear:both; height:5px;"></div>

		<div style="width:80px;float:left;">Campus: </div>
		<select id="f_campus" name="f_campus" style="width:500px;float:left;" onchange="getCursos();"></select>
		<a href="#" class="links" style="margin-left:10px;" onclick="novoCampus(); return false;">Novo campus...</a>
		<div style="clear:both; height:5px;"></div>
	</div>
		
	<div id="campoEstudos2" style="display:none; margin-left:15px;">
		<div style="width:80px;float:left;">Curso: </div>
		<select id="f_curso" name="f_curso" style="width:500px;float:left;"></select>
		<a href="#" class="links" style="margin-left:10px;" onclick="novoCurso(); return false;">Novo curso...</a>
		<div style="clear:both; height:15px;"></div>
	</div>

	<input id ="botao" type="button" value="Continuar" style="width:140px;" onClick="alterarDados();" />&nbsp;
	<input id="botao2" type="button" value="Cancelar" onClick="self.open('<?php echo $btVoltar; ?>','_self')" style="width:140px" />
		
	<div id="msg1" style="color:#ff0000;height:20px;display:none;"> Curso cadastrado com sucesso. </div>
	<div id="msg2" style="color:#ff0000;height:20px;display:none;"> Este curso já está vinculado ao seu cadastro. </div>
	<div id="msg3" style="color:#ff0000;height:20px;display:none;"> Este campus já está vinculado ao seu cadastro. </div>	
</form>
</div>

	<!-- Inserir novos: Instituição/Campus/Curso -->


<script>
	$(document).ready(function(){
        
        <?php
			if(isset($_SESSION["id_usuario"]) && ($_GET["modificar"]=="Autor")){
				echo 'insereCursoAut();';
			} else if(isset($_SESSION["id_usuario"]) && ($_GET["modificar"]=="Orientador")){
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






