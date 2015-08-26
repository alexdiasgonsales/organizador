
// ------------------------------------------------------------------------------------------------ //
// ------------------------- PARTE DE VALIDACAO DE CAMPOS DOS FORMULARIOS ------------------------- //
// ------------------------------------------------------------------------------------------------ //

// Efetua validação de acordo com o formulário atual
function valida() {
	d = document.formCadastro;
	opcao = $("#opcao").val();
	
	if(opcao == "verExistenciaCpf") {
		return validaCpf();
	} else if(opcao == "cadastrarUsuario") {
		return validaCadUsuario();
	} else if(opcao == "alterarDadosGerais") {
		return changeCadGeral();
	}else if(opcao == "confereSenha") {
		return validaSenha();
	} else if((opcao == "cadastrarAutor") || (opcao == "cadastrarVoluntario") || (opcao == "inserirCursoAut")) {
		return validaAutVol();
	} else if(opcao == "cadastrarOuvinte") {
		return validaOuvinte();
	} else if(opcao == "cadastrarOrientador") {
		return validaOrientador();
	} else if(opcao == "cadastrarAvaliador") {
		return validaAvaliador();
	} else if(opcao == "inserirCampusOr") {
		return validaEstudo1();
	}
}

// Validações -----------------------------------------------------------------

// Validação do CPF
function validaCpf() {
	if (d.cpf.value=="") {
		alert('Favor digitar o CPF.');
		d.cpf.focus();
		return false;
	}
	return true;
}

// Validação do Cadastro Geral
function validaCadUsuario() {
		// Validação do nome
		if (d.nome.value=="") {
			alert('Favor digitar o nome.');
			d.nome.focus();
			return false;
		}
		// Validação do email
		if (d.email.value=="") {
			alert('Favor digitar o e-mail.');
			d.email.focus();
			return false;
		}
		if(!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(d.email.value))) {
			alert("Favor digitar um endereço de e-mail válido.");
			d.email.focus();
			return false;
		}
		// Validação da senha
		if (d.senha.value=="") {
			alert('Favor digitar a senha.');
			d.senha.focus();
			return false;
		}
		// Validação do Confirmação de senha
		if (d.rsenha.value=="") {
			alert('Favor digitar a confirmação da senha.');
			d.rsenha.focus();
			return false;
		}
		// Confirmação das senhas
		if (d.senha.value != d.rsenha.value) {
			alert('A senha não confere.');
			return false;
		}
		return true;
}

function changeCadGeral() {
	// Validação do nome
		if (d.nome.value=="") {
			alert('Favor digitar o nome.');
			d.nome.focus();
			return false;
		}
		// Validação do email
		if (d.email.value=="") {
			alert('Favor digitar o e-mail.');
			d.email.focus();
			return false;
		}
		if(!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(d.email.value))) {
			alert("Favor digitar um endereço de e-mail válido.");
			d.email.focus();
			return false;
		}
		return true;
}

// Validação de senha
function validaSenha() {
	if (d.senha.value=="") {
		alert('Favor digitar a senha.');
		d.senha.focus();
		return false;
	}
	return true;
}

// Valida cadastro de Autor e Voluntario
function validaAutVol() {
	if(validaEstudo1() == false){
		return false;
	}
	if(validaEstudo2()==false){
		return false;
	}
	return true;
}

// Valida cadastro de Ouvinte
function validaOuvinte() {
	if(d.tipoOuvinte.value == 0) {
		alert('Por favor, selecione um Tipo.');
		d.tipoOuvinte.focus();
		return false;
	}
	return true;
}

// Valida cadastro de Orientador
function validaOrientador() {
	if (validaEstudo1() == false) {
		return false;
	}
	if(d.tipoServidorOrientador.value == 0) {
		alert('Por favor, selecione o Tipo de Servidor.');
		d.tipoServidorOrientador.focus();
		return false;
	}
	return true;
}

// Valida cadastro de Avaliador
function validaAvaliador() {
	if(validaEstudo1() == false) {
		return false;
	}
	if(d.tipoServidorAvaliador.value == 0) {
		alert('Por favor, selecione o Tipo de Servidor.');
		d.tipoServidorAvaliador.focus();
		return false;
	}
	if(d.nivelFormacao.value == 0) {
		alert('Por favor, selecione o Nível de Formação.');
		d.nivelFormacao.focus();
		return false;
	}
	return true;
}

// Validação de Instituição + Campus
function validaEstudo1() {
	if(d.f_instituicao.value == 0) {
		alert('Por favor, selecione uma instituição.');
		d.f_instituicao.focus();
		return false;
	}
	if(d.f_campus.value == 0) {
		alert('Por favor, selecione um campus.');
		d.f_campus.focus();
		return false;
	}
	return true;
}

// Validação do Curso
function validaEstudo2() {
	if(d.f_curso.value == 0) {
		alert('Por favor, selecione um curso.');
		d.f_curso.focus();
		return false;
	}
	return true;
}

// Valida campos do Inserir uma nova Instituição
function validaNovaInst() {
	e = document.newInst;
	if(e.nomeInstituicao.value == "") {
		alert('Por favor, preencha o nome da Instituição.');
		e.nomeInstituicao.focus();
		return false;
	}
	if(e.siglaInstituicao.value == "") {
		alert('Por favor, preencha a sigla da Instituição.');
		e.siglaInstituicao.focus();
		return false;
	}
	if(e.cidadeInstituicao.value == "") {
		alert('Por favor, preencha a cidade da Instituição.');
		e.cidadeInstituicao.focus();
		return false;
	}
	if(e.estadoInstituicao.value == "") {
		alert('Por favor, preencha o estado da Instituição.');
		e.estadoInstituicao.focus();
		return false;
	}
	if(e.tipoInstituicao.value == "0") {
		alert('Por favor, selecione o tipo de Instituição.');
		e.tipoInstituicao.focus();
		return false;
	}
	return true;
}

// Valida campos do Inserir um novo Campus
function validaNovoCampus() {
	f = document.newCampus;
	if(f.nomeCampus.value == "") {
		alert('Por favor, preencha o nome do Campus.');
		f.nomeCampus.focus();
		return false;
	}
	return true;
}

// Valida campos do Inserir um novo Curso
function validaNovoCurso() {
	g = document.newCurso;
	if(g.nivelCurso.value == "0") {
		alert('Por favor, selecione o nível do Curso.');
		g.nivelCurso.focus();
		return false;
	}
	if(g.nomeCurso.value == "") {
		alert('Por favor, preencha o nome do Curso.');
		g.nomeCurso.focus();
		return false;
	}
	return true;
}

function validaTrabalho() {
	h = document.formTrabalho;
	if(h.f_curso.value == "0") {
		alert('Por favor, selecione um Curso.');
		h.f_curso.focus();
		return false;
	}
	if(h.email.value == "") {
		alert('Por favor, preencha o email do trabalho.');
		h.email.focus();
		return false;
	}
	if(!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(h.email.value))) {
		alert("Favor digitar um endereço de e-mail válido.");
		h.email.focus();
		return false;
	}
	if(h.tematica.value == "0") {
		alert('Por favor, selecione a área temática do trabalho.');
		h.tematica.focus();
		return false;
	}
	if(h.categoria.value == "0") {
		alert('Por favor, selecione a categoria do trabalho.');
		h.categoria.focus();
		return false;
	}
	if(h.modalidade.value == "0") {
		alert('Por favor, selecione a modalidade do trabalho.');
		h.modalidade.focus();
		return false;
	}
	/*if(h.palavra1.value == "") {
		alert('Por favor, preencha a primeira palavra-chave do trabalho.');
		h.palavra1.focus();
		return false;
	}
	if(h.palavra2.value == "") {
		alert('Por favor, preencha a segunda palavra-chave do trabalho.');
		h.palavra2.focus();
		return false;
	}
	if(h.palavra3.value == "") {
		alert('Por favor, preencha a terceira palavra-chave do trabalho.');
		h.palavra3.focus();
		return false;
	}*/
	/*
    if(h.apoiadores.value == "") {
		alert('Por favor, preencha o campo "apoiadores" do trabalho.');
		h.apoiadores.focus();
		return false;
	}
    */
	return true;
}