
// ------------------------------------------------------------------------------------------------ //
// ------------------------ PARTE DE CADASTRO DE DADOS GERAIS E ESPECIFICOS ----------------------- //
// ------------------------------------------------------------------------------------------------ //

function verificaCPF(){
	if (valida()==false)
		return;

	freeFields();
    var form = $("#formCadastro").serialize();
	//$("#label1").text(form);
	var papel = $("#papel").val();
	
	//alert(form);
    $.ajax({
	  type: "POST",
	  url: 'cadastro_execF.php',
	  data: form,
	  success: function(data) {
		  //alert(data);	
		  eval(data);
		  retorno = dados.retorno;
		  if(retorno == 10){ // ------------------------------------------ data = 10: usuario NOVO - parte 1 (Dados Gerais)
			    readOnlyFields();
				cadUser();	
          } else if (retorno == 11){ // ---------------------------------- data = 11: usuario NOVO - parte 2 (Dados Específicos)
				$("#id_usuario").val(dados.id_usuario);
				$("#campoRsenha").hide();
				readOnlyFields();
				cadPapel(papel);
          } else if (retorno == 40){ // ---------------------------------- data = 40: usuario - login
				alert("Seu cadastro foi efetuado com sucesso.\n Seus dados de acesso foram enviados para o seu e-mail.");
				readOnlyFields();
				window.location = "home.php";
          } else if(retorno == 20){ // ----------------------------------- data = 20: USUARIO - pede senha
				$("#id_usuario").val(dados.id_usuario);
				readOnlyFields();
				askPass();
          } else if(retorno == 21){ // ----------------------------------- data = 21: USUARIO - senha incorreta
				$("#msg1").hide();
				$("#msg2").show();
          }else if(retorno == 22){ // ------------------------------------ data = 22: USUARIO - senha correta
				$("#msg1").hide();
				$("#msg2").hide();
				$("#id_usuario").val(dados.id_usuario);
				$("#nome").val(dados.nome);
				$("#email").val(dados.email);
				readOnlyFields();
				$("#campoDados").show();
				cadPapel(papel);
          } else if(retorno == 30){ // ----------------------------------- data = 30: USUARIO + PAPEL - /Erro
                cadExiste(papel);
          }else if(retorno == -11){
                alert("Você deve selecionar pelo menos um turno de disponibilidade.");
          }else if(retorno == -12){
                alert("Você deve informar o telefone obrigatório.");
          } else if(retorno == -1){ // ----------------------------------- data = -1: DB /Erro
				alert("Desculpe, ocorreu um erro durante a execução. \n Por favor, tente novamente.");
          }else{
              alert(data);
          }
       }
    });
}
	
// Mostra cadastro usuario                opcao = cadastrarUsuario
function cadUser() {
	$("#campoDados").show();
    $("#campoSenha").show();
	$("#campoRsenha").show();
    $("#opcao").val("cadastrarUsuario");
    $("#botao").val("Continuar");
}

// Mostra complemento de cadastro         opcao = VARIA DE ACORDO COM O PAPEL	
function cadPapel(papel) {                  
	if(papel == "autor") {                   // opcao = cadastrarAutor
		$("#label2").show();
		$("#campoEstudos1").show();
		$("#campoEstudos2").show();
		$("#opcao").val("cadastrarAutor");
		$("#botao").val("Finalizar");
	} else if(papel == "ouvinte") {          // opcao = cadastrarOuvinte
		$("#label2").show();
		$("#campoEstudos1").show();
		$("#campoEstudos2").show();
		$("#campoTipoOuvinte").show();
		$("#opcao").val("cadastrarOuvinte");
		$("#botao").val("Finalizar");		
	} else if(papel == "voluntario") {       // opcao = cadastrarVoluntario
		$("#label2").show();
                $("#label3").show();
                $("#label4").show();
		$("#campoEstudos1").show();
		$("#campoEstudos2").show();
                $("#campoTurnoDisponivel").show();
                $("#camposTelefones").show();
		$("#opcao").val("cadastrarVoluntario");
		$("#botao").val("Finalizar");
	} else if(papel == "orientador") {       // opcao = cadastrarOrientador
		$("#label2").show();
		$("#campoEstudos1").show();
		$("#campoTipoServidor").show();
		$("#opcao").val("cadastrarOrientador");
		$("#botao").val("Finalizar");
	} else if(papel == "avaliador") {        // opcao = cadastrarAvaliador
		$("#label2").show();
		$("#campoEstudos1").show();
		$("#campoTipoServ_avaliador").show(); 
		$("#campoNivelFormacao").show();
		$("#opcao").val("cadastrarAvaliador");
		$("#botao").val("Finalizar");
	}
}

// Mostra senha                           opcao = conferirSenha
function askPass() {
	$("#campoSenha").show();
	$("#msg1").show();
	$("#opcao").val("conferirSenha");
	$("#botao").val("enviar");
}

// Erro: Cadastro ja existe
function cadExiste(papel) {
	alert("ATENÇÃO! \n Você já está cadastrado como "+papel+".");
	window.location = "index.php";
}
	
// Desativa edição nos campos do Cadastro Geral
function readOnlyFields() {
	if($("#cpf").val() != "") {
		$("#cpf").attr("disabled", "disabled");
	}
	if($("#nome").val() != "") {
		$("#nome").attr("disabled", "disabled");
	} 
	if($("#email").val() != "") {
		$("#email").attr("disabled", "disabled");
	}
	if($("#senha").val() != "") {
		$("#senha").attr("disabled", "disabled");
	}
	return true;
}	
	
// Ativa edição nos campos do Cadastro Geral
function freeFields() {
	$("#cpf").removeAttr("disabled");
	$("#nome").removeAttr("disabled");
	$("#email").removeAttr("disabled");
	$("#senha").removeAttr("disabled");
}	
	
// ------------------------------------------------------------------------------------------------ //
// ------------------------------ PARTE DE ALTERACAO DE DADOS GERAIS ------------------------------ //
// ------------------------------------------------------------------------------------------------ //
	
function getCadUsuario(id) {
	var str = new Array();
    str.push("opcao=getCadUsuario");
    str.push("id_usuario="+id);
        
	$("#titulo1").hide();
	$("#titulo2").show();
	$("#campoCpf").show();
	$("#campoDados").show();
	$("#campoSenha").show();
	$("#campoRsenha").show();
	$("#opcao").val("alterarDadosGerais");
	$("#botao").val("Alterar cadastro");
	$("#botao").attr("onclick", "alterarDados();");
	$("#botao2").val("Cancelar");
		
    $.ajax({
        type: "GET",
        url: 'usuario_op.php', 
        data: str.join("&"),
        success: function(data) {
            eval(data);
			$("#id_usuario").val(dados.id_usuario);
            $("#cpf").val(dados.cpf);
			$("#cpf").attr("disabled", "disabled");
            $("#nome").val(dados.nome);
            $("#email").val(dados.email);
        }
    });
}

// onclick do form do arquivo: camposEspecificos.php
function alterarDados() {
	if (valida()==false)
		return;

	freeFields();
    var form = $("#formCadastro").serialize();
	
    $.ajax({
	  type: "POST",
	  url: 'usuario_alterarDados.php',
	  data: form,
	  success: function(data) {
		  //alert(data);
		  eval(data);
		  retorno = dados.retorno;
		  if(retorno == 12) {
			window.location = "home.php?area=Autor";
		  } else if(retorno == 14) {
			 window.location = "home.php?area=Orientador";
		  } else if(retorno == 23) { // ----------------------------------- data = 23: USUARIO - atualizacao de dados
		  	 $("#nome").val(dados.nome);
			 $("#email").val(dados.email);
			 $("#senha").val(dados.senha);
			 $("#rsenha").val(dados.rsenha);
			 $("#cpf").attr("disabled", "disabled");
			 $("#msg3").show();
		  } else if(retorno == -1) { // ----------------------------------- data = -1: DB /Erro
			 alert("Desculpe, ocorreu um erro durante a execução. \n Por favor, tente novamente.");
                  } else if(retorno == -12) {
			 $("#msg2").show();
		  } else if(retorno == -14) {
			 $("#msg3").show();
		  }
	  }
	});
}




