<?php
session_start();
if(!isset($_SESSION["autor"]) || $_SESSION["autor"] != "allowed"){
    header("Location: index.php");
    exit;
}
?>	

<!------------------------------ Autores ------------------------------->
	<div style="width:600px;overflow:auto;">
	<label style="font-weight:bold;height:18px;margin-top:10px;">Autores </label>
	<table id="showCoautores"></table>
    
    <a id="btAdicionarCoautor" href="#" class="link1" style="text-decoration:underline;" onclick="showBuscaCoautor();"> Adicionar co-autor no trabalho... </a>
	</div>
	
<div id="divSombra" style="width:100%; height:160%; position:absolute; top:0px; left:0px; z-index: 50; background: black; opacity: 0.7; display:none;"></div>	
	
<!------------------------------ BuscarCoautor ------------------------------->
<div id="BuscarCoautor" style="top:200px; left:10%; width:800px; height:300px; position:absolute; border:1px solid #CCCCCC; z-index: 60; background: white; border-radius: 10px;display:none;padding:5px;">
		<div id="pesquisa">
		<table style="margin-left:20px;">
			<tr><td>
			<label style="font-weight:bold;">Pesquisa autor por nome:</label>
			<input type="text" id="nomeCoautor" name="nomeCoautor" style="margin-left:5px;" />
			</td></tr><tr><td>
			<a href="#" class="link1" style="margin-left:5px;text-decoration:underline;" onclick="buscaCoautor(); return false;">Buscar</a>
			<a href="#" class="link1" style="margin-left:10px;text-decoration:underline;" onclick="hideBuscaCoautor(); return false;">Cancelar</a>
			</td></tr>
			<tr><td>
            <div id="msg_erroBusca1" style="color:#ff0000;height:20px;display:none;"><br>
            Não foram encontrados registros relacionados à busca.
            </div></td></tr>
		</table>
		</div>
	<div id="resultBuscaCoautor" style="display:none;width:800px;height:170px;overflow:auto;margin-top:15px;">
		<h4>Resultado:</h4>
		<table id="listBuscaCoautor"></table>
	</div>
</div>

<!------------------------------ Orientadores ------------------------------->
	<label style="font-weight:bold;height:18px;margin-top:10px;">Orientadores </label>
	<table id="listaOrientadores"></table>
    
    <a id="btAdicionarOrientador" href="#" class="link1" style="text-decoration:underline;" onclick="showBuscaOrientador();"> Adicionar orientador no trabalho... </a>
    
<!------------------------------ BuscarOrientador ------------------------------->
<div id="BuscarOrientador" style="top:200px; left:35%; width:600px; height:300px; position:absolute; border:1px solid #CCCCCC; z-index: 60; background: white; border-radius: 10px;display:none;padding:5px;">
		<table style="margin-left:20px;">
			<tr><td>
			<label style="font-weight:bold;">Pesquisa orientador por nome:</label>
			<input type="text" id="nomeOrientador" name="nomeOrientador" style="margin-left:5px;" />
			</td></tr><tr><td>
			<a href="#" class="link1" style="margin-left:5px;text-decoration:underline;" onclick="buscaOrientador(); return false;">Buscar</a>
			<a href="#" class="link1" style="margin-left:10px;text-decoration:underline;" onclick="hideBuscaOrientador(); return false;">Cancelar</a>
			</td></tr>
			<tr><td><div id="msg_erroBusca2" style="color:#ff0000;height:20px;display:none;"><br> Não foram encontrados registros relacionados à busca. </div></td></tr>
		</table>
	<div id="resultBuscaOrientador"  style="display:none;width:600px;height:170px;overflow:auto;margin-top:15px;">
		<h4>Resultado:</h4>
		<table id="listBuscaOrientador"></table>
	</div>
</div>
	
	
<script>

$(document).ready(function(){
	<?php if(isset($_GET["id_trabalho"])) {
		echo 'getListaAutoresTrabalho('.$_GET["id_trabalho"].');';
		echo 'getListaOrientadoresTrabalho('.$_GET["id_trabalho"].');';
        echo 'getQuantidadeAutoresTrabalho('.$_GET["id_trabalho"].');';
        echo 'getQuantidadeOrientadoresTrabalho('.$_GET["id_trabalho"].');';
	} ?>

});

function getQuantidadeAutoresTrabalho(id){
    var str = new Array();
    str.push("opcao=getQuantidadeAutoresTrabalho");
    str.push("id_trabalho="+id);
		
    $.ajax({
        type: "GET",
        url: 'trabalho_opF.php',
        data: str.join("&"),
        success: function(data) {
        if (data < 5)
            $("#btAdicionarCoautor").show();
        else
            $("#btAdicionarCoautor").hide();
        }
    });
}

function getQuantidadeOrientadoresTrabalho(id){
    var str = new Array();
    str.push("opcao=getQuantidadeOrientadoresTrabalho");
    str.push("id_trabalho="+id);
		
    $.ajax({
        type: "GET",
        url: 'trabalho_opF.php',
        data: str.join("&"),
        success: function(data) {
        if (data < 2)
            $("#btAdicionarOrientador").show();
        else
            $("#btAdicionarOrientador").hide();
        }
    });
}


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

function getListaOrientadoresTrabalho(id){
		var str = new Array();
		str.push("opcao=getListaOrientadoresTrabalho");
		str.push("id_trabalho="+id);
		
		$.ajax({
			type: "GET",
			url: 'trabalho_opF.php',
			data: str.join("&"),
			success: function(data) {
				//alert(data);
				//$("#listaOrientadores").append(data);
                $("#listaOrientadores").html(data); //alexdg 2012-09-22
			}
        });
}

function showBuscaCoautor() {
	$("#divSombra").show();
	$("#BuscarCoautor").show();
	$("#msg_erroBusca").hide();
}

function showBuscaOrientador() {
	$("#divSombra").show();
	$("#BuscarOrientador").show();
	$("#msg_erroBusca").hide();
}

function hideBuscaCoautor() { 
	$("#divSombra").hide();
	$("#BuscarCoautor").hide();
}

function hideBuscaOrientador() {
	$("#divSombra").hide();
	$("#BuscarOrientador").hide();
}

function buscaCoautor(){
	var str = new Array();
    str.push("opcao=buscaCoautor");
    str.push("nomeCoautor="+$("#nomeCoautor").val());
    str.push("id_trabalho="+$("#id_trabalho").val());
    
    $.ajax({
      type: "GET",
      url: 'trabalho_opF.php',
      data: str.join("&"),
      success: function(data) {
		//alert(data);
			if(data == -9) {
				alert('ATENÇÃO: preencha o campo \'nome\' corretamente.');
			} else if(data == -11){
				$("#msg_erroBusca1").show();
			} else {
				$("#listBuscaCoautor").html(data);
				$("#resultBuscaCoautor").show();
			}
		}
    });
}

function buscaOrientador(){
	var str = new Array();
    str.push("opcao=buscaOrientador");
    str.push("nomeOrientador="+$("#nomeOrientador").val());
    str.push("id_trabalho="+$("#id_trabalho").val());
    
    $.ajax({
      type: "GET",
      url: 'trabalho_opF.php',
      data: str.join("&"),
      success: function(data) {
		//alert(data);
			if(data == -9) {
				alert('ATENÇÃO: preencha o campo \'nome\' corretamente.');
			} else if(data == -11){
				$("#msg_erroBusca2").show();
			} else {
				$("#listBuscaOrientador").html(data);
				$("#resultBuscaOrientador").show();
			}
		}
    });
}

function inserirCoautor(id_usuario, id_trabalho, id_curso) {
	var str = new Array();
    str.push("opcao=inserirCoautor");
    str.push("id_trabalho="+id_trabalho);
    str.push("id_coautor="+id_usuario);
	str.push("id_curso="+id_curso);
    
    $.ajax({
      type: "POST",
      url: 'trabalho_opF.php',
      data: str.join("&"),
      success: function(data) {
          if(data==-8){
              alert("Erro: Co-autor já cadastrado neste trabaho.");
          } else if (data==8){
              alert("Co-autor inserido com sucesso!");
			  location.reload();
          } else { 
              alert("Erro desconhecido.");
          }
      }
    });
}

function inserirOrientador(id_usuario, id_trabalho, id_campus) {
	var str = new Array();
    str.push("opcao=inserirOrientador");
    str.push("id_trabalho="+id_trabalho);
    str.push("id_orientador="+id_usuario);
	str.push("id_campus="+id_campus);
    
    $.ajax({
      type: "POST",
      url: 'trabalho_opF.php',
      data: str.join("&"),
      success: function(data) {
          if(data==-8){
              alert("Erro: Orientador já cadastrado neste trabaho.");
          } else if (data==8){
              alert("Orientador inserido com sucesso!");
			  location.reload();
          } else { 
              alert("Erro desconhecido.");
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

function removeOrientador(id_orientador, id_trab){
	var str = new Array;
	str.push("opcao=removeOrientador");
	str.push("id_orientador="+id_orientador);
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

</script>