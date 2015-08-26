<?php
include("../conexao.php");
include("../funcoes.php");

if ( isset($_GET["opcao"]) && $_GET["opcao"]=="getInstituicoes" ) {
    
    $sql = "SELECT id_instituicao, nome
            FROM instituicao";
    
    $result = runSQL($sql);
	
    $str = '<option value="0" selected="on">Selecione</option>';
    while($row = mysql_fetch_array($result)){
		$nomeInstituicao = stripslashes($row["nome"]);
        $str .= '<option value="'.$row["id_instituicao"].'">'.$nomeInstituicao.'</option>';
    }
    
    echo $str;
    exit;
    
} else if ( isset($_GET["opcao"]) && $_GET["opcao"]=="getCampus" ) {
    
	$id_instituicao = (int)$_GET["id_instituicao"];
	
    $sql = "SELECT id_campus, nome
            FROM campus
            WHERE fk_instituicao = ".$id_instituicao;
    
    $result = runSQL($sql);
	
    $str = '<option value="0" selected="on">Selecione</option>';
    while($row = mysql_fetch_array($result)){
		$nomeCampus = stripslashes($row["nome"]);
        $str .= '<option value="'.$row["id_campus"].'">'.$nomeCampus.'</option>';
    }
    
    echo $str;
    exit;
    
} else if (isset($_GET["opcao"]) && $_GET["opcao"]=="getCursos"){
  
    $id = (int)$_GET["id_campus"];
	
	$sql = "SELECT id_curso, nome, nivel,
            CASE nivel 
                WHEN 2 THEN '(Técnico) - '
                WHEN 3 THEN '(Superior) - '
                ELSE '' END as nivelDesc
            FROM curso
            WHERE fk_campus = ".$id."
            ORDER BY nivel DESC, nome DESC";
    
    $result = runSQL($sql);
    
    $str = '<option value="0" selected="on">Selecione</option>';
    while($row = mysql_fetch_array($result)){
		$nomeCurso = stripslashes($row["nome"]);
        $str .= '<option value="'.$row["id_curso"].'">'.$row["nivelDesc"].$nomeCurso.'</option>';
    }
    
    echo $str;
    exit;
    
    
}  else if (isset($_POST["opcao"]) && $_POST["opcao"]=="addInstituicao"){
    
	$nome = mysql_real_escape_string($_POST["nomeInstituicao"]);
	$sigla = mysql_real_escape_string($_POST["siglaInstituicao"]);
	$cidade = mysql_real_escape_string($_POST["cidadeInstituicao"]);
	$estado = mysql_real_escape_string($_POST["estadoInstituicao"]);
	$site = mysql_real_escape_string($_POST["siteInstituicao"]);
	$tipo = (int)$_POST["tipoInstituicao"];
	
	
    $sql = "INSERT INTO instituicao
            ( nome, sigla, cidade, estado, site, tipo )
            VALUES
            ( '".$nome."', '".$sigla."', '".$cidade."', '".$estado."', '".$site."', '".$tipo."' )";
    
    $result = runSQL($sql);
	
    $id = mysql_insert_id();
    echo $id;
    exit;
    
}  else if (isset($_POST["opcao"]) && $_POST["opcao"]=="addCampus"){
    
	$nome = mysql_real_escape_string($_POST["nomeCampus"]);
	$id = (int)$_POST["id_instituicao"];
	
    $sql = "INSERT INTO campus
            (nome, fk_instituicao)
            VALUES
            ('".$nome."', '".$id."')";
    
    $result = runSQL($sql);
    
	$id = mysql_insert_id();
    echo $id;
    exit;
    
} else if ( isset($_POST["opcao"]) && $_POST["opcao"]=="addCurso" ){
    
	$nome = mysql_real_escape_string($_POST["nomeCurso"]);
	$nivel = (int)$_POST["nivelCurso"];
	$id = (int)$_POST["id_campus"];
	
    $sql = "INSERT INTO curso
			(nome, nivel, fk_campus)
			VALUES
			('".$nome."', ".$nivel.", ".$id.")";
    
    $result = runSQL($sql);
    
	$id = mysql_insert_id();
    echo $id;
    exit;
    
} 

?>
