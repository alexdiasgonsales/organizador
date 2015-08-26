  function validaTrabalho() {

    h = document.form_trabalho;
    if (h.curso.value == "0") {
      alert('Por favor, selecione um Curso.');
      //h.curso.focus();
      return false;
    }

    if (h.email_trabalho.value == "") {
      alert('Por favor, preencha o email do trabalho.');
      h.email_trabalho.focus();
      return false;
    }
    if (!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(h.email_trabalho.value))) {
      alert("Favor digitar um endereço de e-mail válido.");
      h.email_trabalho.focus();
      return false;
    }
    if (h.area.value == "0") {
      alert('Por favor, selecione a área temática do trabalho.');
      h.area.focus();
      return false;
    }
    if (h.categoria.value == "0") {
      alert('Por favor, selecione a categoria do trabalho.');
      h.categoria.focus();
      return false;
    }
    if (h.modalidade.value == "0") {
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
  }//validaTrabalho()

  function salvarTrabalho(acao) {

    if (!validaTrabalho())
      return;

    var form = $("#form_trabalho").serialize();
    var cTitulo = CKEDITOR.instances.titulo.getData();
    var cResumo = CKEDITOR.instances.resumo.getData();
    var str = new Array();
    str.push(form);
    str.push("cTitulo=" + encodeURIComponent(cTitulo));
    str.push("cResumo=" + encodeURIComponent(cResumo));

    //titulo = document.form_trabalho.titulo;
    //resumo = document.form_trabalho.resumo;

    //str.push("titulo=" + titulo);
    //str.push("resumo=" + resumo);
    $.ajax({
      type: "POST",
      url: acao,
      data: str.join("&"),
      success: function(data) {
        if (data == 0) {
          alert('Trabalho salvo com sucesso!');
          window.location = "../index.php";
        }
        else if (data == 1) {
          alert('Erro ao salvar trabalho. Você deve efetuar o login no sistema.');
        }
        else if (data == 2) {
          alert('Período de inscrição de trabalho encerrado');
        }
        else if (data == 3) {
          alert('Erro: somente autores podem efetuar a inscrição de trabalho.');
        }
        else if (data == 4) {
          alert('ATENÇÃO: Você já é autor de um trabalho com esta modalidade. Escolha outra modalidade.');
        }
        else if (data == 5) {
          alert('Erro: curso inválido.');
        }
        else if (data < 0) {
          alert("Resumo contém " + (-data) + " caracteres. O máximo permitido é 3000 caracteres.");
        }
        else {
          alert('Erro: código = ' + data);
        }
      }
    });
  }//salvarTrabalho()

function getListaAutoresTrabalho(id){
		var str = new Array();
		str.push("opcao=getListaAutoresTrabalho");
		str.push("id_trabalho="+id);
		
		$.ajax({
			type: "GET",
			url: 'trabalho_opF.php',
			data: str.join("&"),
			success: function(data) {
				//$("#showCoautores").append(data); //alexdg 2012-09-22
                $("#showCoautores").html(data);
			}
        });
}

function showBuscaCoautor() {
	$("#divSombra").show();
	$("#BuscarCoautor").show();
	$("#msg_erroBusca").hide();
}

function hideBuscaCoautor() { 
	$("#divSombra").hide();
	$("#BuscarCoautor").hide();
}


function buscaCoautor(){
    var str = new Array();
    str.push("acao=busca_coautor");
    str.push("nome_autor="+$("#nomeCoautor").val());
    
    $.ajax({
      type: "GET",
      url: '../controller/ControllerTrabalho.php',
      data: str.join("&"),
      success: function(data) {
        if (data == -1) {
          alert('ATENÇÃO: preencha o campo \'nome\' com pelo menos 4 caracteres.');
        } 
        else if(data == -2){
          $("#msg_erroBusca1").show();
        }
        else {
          $("#listBuscaCoautor").html(data);
          $("#resultBuscaCoautor").show();                  
        }
      }
    });
}

function inserirCoautor(id_usuario, id_curso) {
  var str = new Array();
  str.push("acao=inserir_autor");
  str.push("id_autor="+id_usuario);
  str.push("id_curso="+id_curso);
    
    $.ajax({
      type: "GET",
      url: '../controller/ControllerTrabalho.php',
      data: str.join("&"),
      success: function(data) {
        if (data == 0) {
          alert("Co-autor inserido com sucesso!");
          location.reload();
        }
        else if(data==-1){
            alert("Erro: -1.");
        } 
        else if(data==-2){
            alert("Erro: Co-autor já cadastrado neste trabaho.");
        } 
        else if(data==-4){
            alert("Erro: -3.");
        } 

        else { 
          alert('Erro: ' + data);
        }
      }
    });
}

function removeCoautor(id_coautor, id_trab){
	var str = new Array;
	str.push("opcao=removerCoautor");
	str.push("id_coautor="+id_coautor);
	str.push("id_trabalho="+id_trab);
	
	$.ajax({
		type: "POST",
		url: 'trabalho_opF.php',
		data: str.join("&"),
		success: function(data) {
			if(data==1) {
				location.reload();
			}
		}
	});
}