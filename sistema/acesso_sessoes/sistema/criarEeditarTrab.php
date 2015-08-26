<?php
session_start();

if(!isset($_SESSION["autor"]) || $_SESSION["autor"] != "allowed"){
    header("Location: index.php");
    exit;
}

$id = "";
if(isset($_GET["id_trabalho"])){
	$id =  $_GET["id_trabalho"];
}

?>
<script type="text/javascript" src="scriptValidacao.js" charset="utf-8"></script>
<script type="text/javascript" src="../ckeditor/ckeditor.js" charset="utf-8"></script>
<script type="text/javascript" src="../ckeditor/jquery.js" charset="utf-8"></script>
<script src="../ckeditor/sample.js" type="text/javascript" charset="utf-8"></script>

<link href="../ckeditor/sample.css" rel="stylesheet" type="text/css" />

<script type="text/javascript">
//<![CDATA[

$(function()
{
	/*
    var config = {
		toolbar:
		[
			['Bold', 'Italic','Subscript','Superscript', 'RemoveFormat'],
			['UIColor']
		]
	};
*/
	// Initialize the editor.
	// Callback function can be passed and executed after full instance creation.
	//$('.jquery_ckeditor').ckeditor(config);
        CKEDITOR.replace( 'titulo',
    {
        toolbar:
		[
			['Bold', 'Italic','Subscript','Superscript', 'RemoveFormat'], 
            ['UIColor']
		],
        
        height: 70,
        toolbarCanCollapse: false,
        removePlugins : 'elementspath',
        resize_enabled: false,
        
        on :
        {
            instanceReady : function( ev )
            {
                // Output paragraphs as <p>Text</p>.
                this.dataProcessor.writer.setRules( 'p',
                    {
                        indent : false,
                        breakBeforeOpen : true,
                        breakAfterOpen : false,
                        breakBeforeClose : false,
                        breakAfterClose : true
                    });
            }
        }
    });
    
    CKEDITOR.replace( 'f_resumo',
    {
        toolbar:
		[
			['Bold', 'Italic','Subscript','Superscript', 'RemoveFormat'],
			['UIColor']
		],
        
        height: 400,
        toolbarCanCollapse: false,
        removePlugins : 'elementspath',
        resize_enabled: false,

        on :
        {
            instanceReady : function( ev )
            {
                // Output paragraphs as <p>Text</p>.
                this.dataProcessor.writer.setRules( 'p',
                    {
                        indent : false,
                        breakBeforeOpen : true,
                        breakAfterOpen : false,
                        breakBeforeClose : false,
                        breakAfterClose : true
                    });
            }
        }
    });

/*    
    CKEDITOR.replace( 'teste_editor',
    {
    });
*/    
        
        
});

//]]>
</script>

<form id="formTrabalho" name="formTrabalho" method="post" target="aux">
<input type="hidden" id="id_trabalho" name="id_trabalho" value="<?php echo $id;?>"/>
<input type="hidden" id="id_autor" name="id_autor" value="<?php echo $_SESSION["id_usuario"];?>"/>
<input type="hidden" id="opcao" name="opcao" value="cad_trabalho"/>
    
<h3 id="tituloNovo" align="center" style="display:none;margin-top:10px;"> Inscrever Trabalho </h3>
<h3 id="tituloEdita" align="center" style="display:none;margin-top:10px;"> Editar Trabalho </h3>

<div id="parte02" style="margin-top:15px;">
	<div style="height:18px;padding-top:5px;padding-left:10px;"><label style="font-weight:bold;">Título </label></div>
	<div style="clear:both; height:5px;"></div>
	<textarea name="titulo" id="titulo" rows="2" cols="50" style="width:740px;"></textarea>

	<div style="height:18px;padding-top:5px;padding-left:10px;margin-top:15px;"><label style="font-weight:bold;">Resumo </label></div>
	<div style="clear:both; height:5px;"></div>
	<textarea name="f_resumo" id="f_resumo" rows="15" cols="50"  style="width:740px;" ></textarea>
    
    <!--
    <textarea name="teste_editor" id="teste_editor" rows="15" cols="50"  style="width:740px;" ></textarea>
    -->
    
</div>

<div id="parte03" style="margin-top:15px;">
	<div style="height:18px;padding-top:5px;padding-left:10px;"><label style="font-weight:bold;">Palavras-chave </label></div>
	<div style="clear:both; height:5px;"></div>
	
	<table>
		<tr><td style="padding-left:7px;"><label>Palavra 1: </label></td> 
		<td><input type="text" id="palavra1" name="palavra1"/></td></tr>

		<tr><td style="padding-left:7px;"><label>Palavra 2: </label></td> 
		<td> <input type="text" id="palavra2" name="palavra2"/></td></tr>

		<tr><td style="padding-left:7px;"><label>Palavra 3: </label></td> 
		<td> <input type="text" id="palavra3" name="palavra3"/></td></tr>
	</table>
</div>

<div id="parte01" style="margin-top:15px;">	
	<div style="height:18px;padding-top:5px;padding-left:10px;"><label style="font-weight:bold;"> Dados do Trabalho </label></div>
	<div style="clear:both; height:15px;"></div>

	<table><tr><td style="padding-left:7px;"><label>Curso:</label></td>
	<td style="padding-left:7px;"><select id="f_curso" name="f_curso"></select></td></tr></table>
	
	<table><tr><td style="padding-left:7px;"><label>E-mail a ser publicado no trabalho: </label></td>
	<td style="padding-left:7px;"><input type="text" id="email" name="email" size="50"/></td></tr>	
	</table>
	
	<table>
		<tr><td style="padding-left:7px;"><label>Área temática </label></td>
		<td style="padding-left:7px;"><select id="tematica" name="tematica"> </select></td></tr>
	</table>
	
	<table>
	<tr><td style="padding-left:7px;"><label>Categoria </label></td>
	<td style="padding-left:7px;"><select id="categoria" name="categoria">
		<option value="0">Selecione</option>
		<option value="1">Relato de experiência</option>
		<option value="2">Relato de pesquisa</option>
		<option value="3">Revisão de literatura/ensaio</option>
	</select> </td></tr>
	</table>
	
	<table>
	<tr><td style="padding-left:7px;"><label>Modalidade de apresentação </label></td>
	<td style="padding-left:7px;"><select id="modalidade" name="modalidade">
		<option value="0">Selecione</option>
		<option value="1">Apresentação oral</option>
		<option value="2">Apresentação de poster</option>
	</select></td></tr>
	</table>
</div>

<div id="parte04" style="margin-top:15px;padding-left:10px;">
	<label style="font-weight:bold;">Apoiadores </label> 
	<input type="text" id="apoiadores" name="apoiadores" size="50" />
	
	<div id="Coautores_Orientadores"></div>
	
</div>

<p>
Dicas:

<p>Ao clicar no botão Salvar você estará salvando os dados do seu trabalho no sistema. A qualquer momento, enquanto estiver aberto o prazo de inscrição de trabalhos, o autor principal do poderá efetuar modificações em qualquer parte do trabalho (título, resumo, palavras-chave, coautores, orientadores, categoria, temática, modalidade, etc.).

<p>Após salvar o trabalho, não esqueça de adicionar o(s) orientador(es) e demais coautores ao seu trabalho (caso existam). Para isso, os orientadores e coautores devem efetuar inscrição no sistema. Somente após a inscrição será possível adicioná-los ao trabalho.


</form>

<div style="clear:both; height:15px;"></div>
<div align="center">
<a href="#" id="botao1" class="link1" style="text-decoration:underline;" onclick="salvarTrabalho(); return false;">Salvar</a>

<a href="./home.php" class="link1" style="margin-left:10px;text-decoration:underline;">Voltar</a>
</div>

<div style="clear:both; height:5px;"></div>
<iframe id="aux" name="aux" style="display:none;"></iframe>

<script>

//<![CDATA[
$(document).ready(function(){
   CKEDITOR.config.forcePasteAsPlainText = true; 
   CKEDITOR.config.pasteFromWordCleanupFile = 'custom';
   CKEDITOR.config.entities_latin = false; //default true
   
   CKEDITOR.config.entities = false; //default true
   
   //Ver esta >>>>>>>>>>>>>>>>>
   CKEDITOR.config.basicEntities = true; //default true
   
   id = $("#id_trabalho").val();   
      
   getCursosAutor(id);
   getAreaTematica(id);

   if(id != "") {
		getDadosTrabalho(id);
		$("#Coautores_Orientadores").load("trabEdit.php?id_trabalho="+id);
   } else {
		$("#tituloNovo").show();
		$("#tituloEdita").hide();
		verificaModalidadesTrabalhosAutor();
	}
});

//function verificaAutor(){
function verificaModalidadesTrabalhosAutor(){
	//str = "opcao=verificaAutor";
    str = "opcao=verificaModalidadesTrabalhosAutor";
	
	$.ajax({
		type: "POST",
		url: 'trabalho_opF.php',
		data: str,
		success: function(data) {
			//eval(data);
			//retorno = dados.retorno;
            retorno = data;
            //alert(retorno);
			if(retorno == 1) {
				//$("#modalidade").val(2);
				//$("#modalidade").attr("disabled","disabled");
			} 
			if(retorno == 2) {
				//$("#modalidade").val(1);
				//$("#modalidade").attr("disabled","disabled");
			}
            else if(retorn==-2) {
				alert('Você já atingiu o limite de trabalhos cadastrados!');
				window.location = "home.php?area=Autor";
			}
		}
	});
}

function getCursosAutor(id_trab){
	//var str = "opcao=getCursosAutor";
    
    //alexdg 2012-09-20
    var str = "opcao=getCursosAutor2&id_trabalho="+id_trab;
   
	$.ajax({
		type: "POST",
		url: 'trabalho_opF.php',
		data: str,
		success: function(data) {
			$("#f_curso").html(data);
		}
	});
}

function getAreaTematica(id_trab){
	//var str = "opcao=getAreaTematica";
    
    //alexdg 2012-09-20
    var str = "opcao=getAreaTematica2&id_trabalho="+id_trab;
    
	$.ajax({
		type: "GET",
		url: 'trabalho_opF.php',
		data: str,
		success: function(data) {
			$("#tematica").html(data);
		}
	});
}

function getDadosTrabalho(id){
	var str = new Array();
	str.push("opcao=getDadosTrabalho");
	str.push("id_trabalho="+id);
		
	$("#tituloNovo").hide();
	$("#tituloEdita").show();
	$("#botao1").attr("onclick","atualizarTrabalho("+id+");");
	$.ajax({
		type: "POST",
		url: 'trabalho_opF.php',
		data: str.join("&"),
		success: function(data) {
			if(data!=0){
				//eval(data);
				var dados = JSON.parse(data);
				
				$("#email").val(dados.email);
				$("#palavra1").val(dados.palavra1);
				$("#palavra2").val(dados.palavra2);
				$("#palavra3").val(dados.palavra3);
				$("#apoiadores").val(dados.apoiadores);
				$("#tematica").val(dados.tematica);
				$("#categoria").val(dados.categoria);
				$("#modalidade").val(dados.modalidade);
				$("#f_curso").val(dados.fk_curso);
                  
                //$("#titulo").val(dados.titulo);
                //$("#f_resumo").val(dados.resumo);
				CKEDITOR.instances.titulo.setData(dados.titulo);
				CKEDITOR.instances.f_resumo.setData(dados.resumo);    
                //CKEDITOR.instances.teste_editor.setData(dados.resumo);
			}  
		}
	});
}

function salvarTrabalho(){
	if(validaTrabalho()==false)
		return;

    $("#opcao").val("inserirTrabalho");
	
    var form = $("#formTrabalho").serialize();
    var cTitulo = CKEDITOR.instances.titulo.getData();
    var cResumo = CKEDITOR.instances.f_resumo.getData();
    //var cResumo = CKEDITOR.instances.teste_editor.getData();
    
    var str = new Array();
    str.push(form);
    //str.push("cTitulo="+cTitulo);
    //str.push("cResumo="+cResumo);
    str.push("cTitulo="+encodeURIComponent(cTitulo));
    str.push("cResumo="+encodeURIComponent(cResumo));
    
    $.ajax({
          type: "POST",
          url: 'trabalho_opF.php',
          data: str.join("&"),
          success: function(data) {
              if(data==1){
                  alert('Trabalho salvo com sucesso!');                  
                  window.location = "home.php?area=Autor";
              } 
			  else if(data == -1){
                  alert('Erro ao salvar trabalho. Código = '+data);
              }
			  else if(data == -2){
                  alert('Erro ao salvar trabalho. Código = '+data);
              }
			  else if (data == -3){
                  alert('ATENÇÃO: Você já é autor de um trabalho com esta modalidade. Escolha outra modalidade.');
              } 
			  else {
                              alert(data);
                  alert("Resumo contém "+(-data)+" caracteres. O máximo permitido é 3000 caracteres.");
              }
          }
    }); 
}

function atualizarTrabalho(id_trab){
	$("#opcao").val("atualizarTrabalho");
	var form = $("#formTrabalho").serialize();
    var cTitulo = CKEDITOR.instances.titulo.getData();
    var cResumo = CKEDITOR.instances.f_resumo.getData();
    //var cResumo = CKEDITOR.instances.teste_editor.getData();
	
    //alert(cResumo);
    
	var str = new Array();
	str.push(form);
    //str.push("cTitulo="+cTitulo);
    //str.push("cResumo="+cResumo);
    str.push("cTitulo="+encodeURIComponent(cTitulo));
    str.push("cResumo="+encodeURIComponent(cResumo));
	
    var str2 = str.join("&");
    //alert(str2);
    
	$.ajax({
		type: "POST",
		url: 'trabalho_opF.php',
		//data: str.join("&"),
        data: str2,
		success: function(data) {
        
              if(data==1){
                  alert('Trabalho atualizado com sucesso!');
                  window.location = "trabalho.php?action=view&id_trab="+id_trab;
                  //window.location = "home.php?area=Autor";
              } 
			  else if(data == -1){
                  alert('Erro ao salvar trabalho. Código = '+data);
              }
			  else if(data == -2){
                  alert('Erro ao salvar trabalho. Código = '+data);
              }
			  else if (data == -3){
                  alert("ATENÇÃO: Você já é autor de um trabalho com esta modalidade. Escolha outra modalidade.");
              } 
			  else {
                  alert("Resumo contém "+(-data)+" caracteres. O máximo permitido é 3000 caracteres.");
              }
		}
	});		
}

//]]>
</script>