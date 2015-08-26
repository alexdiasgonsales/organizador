<?php
session_start();

include("../conexao.php");
include("../funcoes.php");

if(!isset($_SESSION["id_usuario"])){
    header("Location: index.php");
    exit;
}
include("inc_cabecalho.php");
?>
    <div id="cont">
    <div id="info_usuario" style="height:120px;">
        <div style="background-color:#CCDAB4;width:97%;height:18px;padding-top:5px;padding-left:10px;"> <label style="font-weight:bold;">Dados de identificação do usuário: </label></div>
        <div style="clear:both;height:10px;"></div>
    </div>
	
	 <div style="background-color:#CCDAB4;width:97%;height:18px;padding-top:5px;padding-left:10px;"><label style="font-weight:bold;">Clique nos botões abaixo para acessar suas áreas: </label> </div>
	 <a href="#" class="link1" onclick="mostrarAut();"><fieldset id="botaoAut" style="display:none;background-color: #CCDAB4;float:left;margin-top:15px;padding:5px;"> Área do Autor</fieldset> </a> &nbsp;
	 <a href="#" class="link1" onclick="mostrarOrien();"><fieldset id="botaoOrien" style="display:none;background-color: #CCDAB4;float:left;margin-top:15px;padding:5px;"> Área do Orientador </fieldset> </a> &nbsp;
	 <a href="#" class="link1" onclick="mostrarAval();"><fieldset id="botaoAval" style="display:none;background-color: #CCDAB4;float:left;margin-top:15px;padding:5px;"> Área do Avaliador </fieldset> </a> &nbsp;
	 <a href="#" class="link1" onclick="mostrarOuv();"><fieldset id="botaoOuv" style="display:none;background-color: #CCDAB4;float:left;margin-top:15px;padding:5px;"> Área do Ouvinte </fieldset> </a> &nbsp;
	 <a href="#" class="link1" onclick="mostrarVol();"><fieldset id="botaoVol" style="display:none;background-color: #CCDAB4;float:left;margin-top:15px;padding:5px;"> Área do Voluntário </fieldset> </a>
	<div style="clear:both;height:20px;"></div>
	
	
	
    <fieldset id="pgAutor" style="display:none;margin-top:15px;background-color: #FFFFFF;"> </fieldset>
	<fieldset id="pgOrientador" style="display:none;margin-top:15px;background-color: #FFFFFF;"> </fieldset>
	<fieldset id="pgAvaliador" style="display:none;margin-top:15px;background-color: #FFFFFF;"> </fieldset>
	<fieldset id="pgVoluntario" style="display:none;margin-top:15px;background-color: #FFFFFF;"> </fieldset>
	<fieldset id="pgOuvinte" style="display:none;margin-top:15px;background-color: #FFFFFF;"> </fieldset>
	
    <div id="msg"> </div>
    

</div>

<script>
    $(document).ready(function() {
        getInfoUsuario();
		getPapel();
    });
    
    function getInfoUsuario(){
        var str = "opcao=getInfoUsuario";
        
        $.ajax({
          type: "GET",
          url: 'usuario_op.php', /*arquivo que recupera INFO do USUARIO*/
          data: str,
          success: function(data) {
              $("#info_usuario").append(data);
          }
        });
    }
	
</script>	

<script> /*    FUNCOES QUE MANIPULAM ESTADO DAS DIVS (OCULTAR/MOSTRAR)    */	
		
		
	<?php if(isset($_GET["area"]) && $_GET["area"]=="Autor") {
		echo 'mostrarAut();';
		} else if(isset($_GET["area"]) && $_GET["area"]=="Orientador") {
			echo 'mostrarOrien();';
		}?>	
		
		
		
// --------------------------------------------------------------//
// Funcao que recupera em quais papéis o usuário está cadastrado //
//---------------------------------------------------------------//

    function getPapel(){
        var str = "opcao=getPapel";
        
        $.ajax({
          type: "GET",
          url: 'usuario_op.php',
          data: str,
          success: function(data) {
              eval(data);
			  autor = dados.autor;
			  orientador = dados.orientador;
			  avaliador = dados.avaliador;
			  voluntario = dados.voluntario;
			  ouvinte = dados.ouvinte;
			  if(autor != 0) {
				 $("#pgAutor").load("home_areaAutor.php");
				 $("#botaoAut").show();
                                 $("#pgAutor").show();
			  }
			  if(orientador != 0) {
				 $("#pgOrientador").load("home_areaOrientador.php");
				 $("#botaoOrien").show();
			  }
			  if(avaliador != 0) {
				 $("#pgAvaliador").load("home_areaAvaliador.php");
				 $("#botaoAval").show();
			  }
			  if(voluntario != 0) {
				 $("#pgVoluntario").load("home_areaVoluntario.php");
				 $("#botaoVol").show();
			  }
			  if(ouvinte != 0) {
				 $("#pgOuvinte").load("home_areaOuvinte.php");
				 $("#botaoOuv").show();
			  }
          }
        });
    }
	
//------------------------------------------------------------//
// Funções relacionadas a mostrar/ocultar as áreas dos papéis //
//------------------------------------------------------------//
	
	function mostrarAut() {
		$("#pgAutor").show();
		$("#pgOrientador").hide();
		$("#pgAvaliador").hide();
		$("#pgVoluntario").hide();
		$("#pgOuvinte").hide();
	}
	
	function mostrarOrien() {
		$("#pgAutor").hide();
		$("#pgOrientador").show();
		$("#pgAvaliador").hide();
		$("#pgVoluntario").hide();
		$("#pgOuvinte").hide();
	}
	
	function mostrarAval() {
		$("#pgAutor").hide();
		$("#pgOrientador").hide();
		$("#pgAvaliador").show();
		$("#pgVoluntario").hide();
		$("#pgOuvinte").hide();
	}
	
	function mostrarVol() {
		$("#pgAutor").hide();
		$("#pgOrientador").hide();
		$("#pgAvaliador").hide();
		$("#pgVoluntario").show();
		$("#pgOuvinte").hide();
	}
	
	function mostrarOuv() {
		$("#pgAutor").hide();
		$("#pgOrientador").hide();
		$("#pgAvaliador").hide();
		$("#pgVoluntario").hide();
		$("#pgOuvinte").show();
	}
	
	function ocultarAut() {
		$("#pgAutor").hide();
	}
	
	function ocultarOrien() {
		$("#pgOrientador").hide();
	}
	
	function ocultarAval() {
		$("#pgAvaliador").hide();
	}
	
	function ocultarVol() {
		$("#pgVoluntario").hide();
	}
	
	function ocultarOuv() {
		$("#pgOuvinte").hide();
	}
</script>


<?php
include("inc_rodape.php");
?>

