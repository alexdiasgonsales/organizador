
// Script: Instituição/Campus/Curso ------------------------------------------
		
$(document).ready(function(){
	getInstituicoes();
});
	
// Combobox
function getInstituicoes(){
	var str = "opcao=getInstituicoes";
   
	$.ajax({
		type: "GET",
		url: 'cadastro_opF.php',
		data: str,
		success: function(data) {
			$("#f_instituicao").html(data);
			$("#selectInst").html(data);
		}
	});
}

function getCampus(){
	var str = "opcao=getCampus";
	str += ("&id_instituicao="+$("#f_instituicao").val());
    
	$.ajax({
		type: "GET",
		url: 'cadastro_opF.php',
		data: str,
		success: function(data) {
			$("#f_campus").html(data);
			$("#selectCamp").html(data);
		}
	});
}

function getCursos(){
	var str = new Array();
	str.push("opcao=getCursos");
	str.push("id_campus="+$("#f_campus").val());
   
	$.ajax({
		type: "GET",
		url: 'cadastro_opF.php',
		data: str.join("&"),
		success: function(data) {
			$("#f_curso").html(data);
			$("#selectCurs").html(data);
		}
	});
}

// Instituição
function novaInstituicao(){
	$("#divSombra").show();
	$("#instAtuais").show();
	$("#formNewI").hide();
}

function cancNovaInstituicao(){
	$("#nomeInstituicao").val("");
	$("#siglaInstituicao").val("");
	$("#cidadeInstituicao").val("");
	$("#estadoInstituicao").val("");
	$("#siteInstituicao").val("");
	$("#tipoInstituicao").val("0");
	$("#divSombra").hide();
	$("#instAtuais").hide();
	$("#insereP1I").show();
}

function salvarInstituicao(){
	if(validaNovaInst()==false) 
		return;
	
	var str = new Array();
	str.push("opcao=addInstituicao");
	str.push("nomeInstituicao="+$("#nomeInstituicao").val());
	str.push("siglaInstituicao="+$("#siglaInstituicao").val());
	str.push("cidadeInstituicao="+$("#cidadeInstituicao").val());
	str.push("estadoInstituicao="+$("#estadoInstituicao").val());
	str.push("siteInstituicao="+$("#siteInstituicao").val());
	str.push("tipoInstituicao="+$("#tipoInstituicao").val());
    
	$.ajax({
		type: "POST",
		url: 'cadastro_opF.php',
		data: str.join("&"),
		success: function(data) {
			getInstituicoes();
			cancNovaInstituicao();
			$("#f_instituicao").val(data);
			alert("Instituição cadastrada com sucesso!");
		}
       });  
}
	
// Campus

function novoCampus(){
	if($("#f_instituicao").val()==0) {
		alert('Atenção: \n Selecione uma Instituição.');
	} else {
		$("#divSombra").show();
		$("#campAtuais").show();
		$("#formNew2").hide();
	}
}

function cancNovoCampus(){
	$("#nomeCampus").val("");
	$("#divSombra").hide();
	$("#campAtuais").hide();
	$("#insereP1Ca").show();
}

function salvarCampus(){
	if($("#f_instituicao").val()==0){
		alert("É necessário associar o campus a alguma Instituição.");
		return;
	}
	if(validaNovoCampus() == false) {
		return;
	}
	
	var str = new Array();
	str.push("opcao=addCampus");
	str.push("id_instituicao="+$("#f_instituicao").val());
	str.push("nomeCampus="+$("#nomeCampus").val());
    
	$.ajax({
		type: "POST",
		url: 'cadastro_opF.php',
		data: str.join("&"),
		success: function(data) {
			getCampus();
			cancNovoCampus();
			$("#f_campus").val(data);
			alert("Campus cadastrado com sucesso!");
		}
    });
        
}

// Curso

function novoCurso(){
	if($("#f_instituicao").val()==0) {
		alert('Atenção: \n Selecione uma Instituição.');
	} else if($("#f_campus").val()==0){
		alert('Atenção: \n Selecione um Campus.');
	} else {
		$("#divSombra").show();
		$("#cursAtuais").show();
		$("#formNew3").hide();
	}
}

function cancNovoCurso(){
	$("#nomeCurso").val("");
	$("#divSombra").hide();
	$("#cursAtuais").hide();
	$("#insereP1C").show();
}

function salvarCurso(){
	if($("#f_campus").val()==0){
		alert("É necessário associar o curso a algum Campus.");
		return;
	}
	if(validaNovoCurso() == false) {
		return;
	}
    
	var str = new Array();
	str.push("opcao=addCurso");
	str.push("id_campus="+$("#f_campus").val());
	str.push("nomeCurso="+$("#nomeCurso").val());
	str.push("nivelCurso="+$("#nivelCurso").val());
    
	$.ajax({
		type: "POST",
		url: 'cadastro_opF.php',
		data: str.join("&"),
		success: function(data) {
			getCursos();
			cancNovoCurso();
			$("#f_curso").val(data);
			alert("Curso cadastrado com sucesso!");
		}
    });  
}
	
	