<?php
session_start();

include("../conexao.php");
include("../funcoes.php");

/*-------------------------------------------------------------*/
/* Funcao que efetua a ATUALIZACAO dos dados GERAIS de usuario */
/*-------------------------------------------------------------*/
if(isset($_POST['opcao']) && $_POST['opcao']=="alterarDadosGerais") {
	 if (isset($_POST['cpf']) && isset($_POST['nome']) && isset($_POST['email'])){
		$cpf   = inclui_zeros(mysql_real_escape_string($_POST['cpf']),11);
		$nome  = mysql_real_escape_string($_POST['nome']);
		$email = mysql_real_escape_string($_POST['email']);
		if (isset($_REQUEST['senha'])){
			$senha = mysql_real_escape_string($_POST['senha']);
		} else {
			$senha = "";
		}
		$resp = editar_cad_usuario($_POST["id_usuario"], $nome, $email, $senha, $cpf);	
		if($resp==1) {
			$ans = 23;
		} else {
			$ans = -1;
		}
		$resp = "dados={retorno:'".$ans."', nome:'".$nome."', email:'".$email."', senha:'".$senha."', rsenha:'".$senha."'}";
	}
	echo $resp;
	exit;

/*-------------------------------------------------------------*/
/*      Funcao que INSERE um CURSO no cadastro do AUTOR        */
/*-------------------------------------------------------------*/
#  Retorno: 12 = sucesso, -12 = curso ja cadastrado, -1 = erro  #

} else if(isset($_POST['opcao']) && $_POST['opcao']=="inserirCursoAut") {
	if(isset($_POST["f_curso"])) {
		$id_user = $_SESSION["id_usuario"];
		$id_curso = (int)$_POST["f_curso"];
		
		// Verifica o numero de cursos ja cadastrados pelo usuario
		$nroCursosCad = recNumRows ($id_user, "fk_autor", "autor_curso", $conexao);
		
		// Verifica se o curso em questao ja esta cadastrado
		$queryConfere = "SELECT *
			FROM autor_curso
			WHERE fk_autor = '".$id_user."'
			AND fk_curso = '".$id_curso."'";
			
		$sqlConfere = runSQL($queryConfere);
		$Confere = mysql_num_Rows($sqlConfere);
		// Se este curso ainda nao foi inserido: INSERIR
		if($Confere == 0){
			$nroCursosCad++;
			
			$query = "INSERT into autor_curso
						(fk_autor, fk_curso, seq)
					  VALUES
						('$id_user', '$id_curso', '$nroCursosCad')";
			
			$sql = runSQL($query);
			
			$ans = 12;
		// Se o curso ja esta cadastrado para este usuario: ERRO
		} else { 
			$ans = -12;
		}
	// Se nao foi possivel recuperar dados do form: ERRO
	} else {
		$ans = -1;
	}
	
	$resp = "dados={retorno:'".$ans."'}";
	echo $resp;
	exit;
	
/*-------------------------------------------------------------*/
/*      Funcao que REMOVE um CURSO no cadastro do AUTOR        */
/*-------------------------------------------------------------*/	
#  Retorno: 16 = sucesso, -16 = sу tem 1 curso, -17 = curso vinculado ao trabalho  #	
	
} else if(isset($_POST['opcao']) && $_POST['opcao']=="removeCursoAut") {
	// parte 1: verificar se possui mais de um curso
	$id_user = $_SESSION["id_usuario"];
	$qntCurso = recNumRows ($id_user, "fk_autor", "autor_curso", $conexao);
	if($qntCurso == 1) {
		$ans = -16;
	// parte 2: existe mais de um curso... localizб-lo 
	} else {
		$idCurso = (int)$_POST["id_curso"];
		$arrCurso = recLinha ($idCurso, "fk_curso", "autor_curso", $conexao);
		$seqCurso = $arrCurso["seq"];
		
		// parte 3: verificar se o curso estб vinculado ao trabalho:
		$sqlTrabCurso = "SELECT * 
						FROM trabalho_autor_curso
						WHERE fk_autor = '".$id_user."'
						AND fk_curso = '".$idCurso."'";
		$resultTrabCurso = runSQL($sqlTrabCurso);
		$qntTC = mysql_num_rows($resultTrabCurso);
		if($qntTC != 0) {
			$ans = -17;
		} else {
			$sql = "SELECT * 
					FROM autor_curso
					WHERE fk_autor='".$id_user."'
					AND fk_curso != ".$idCurso;
			$result = runSQL($sql);
			while($row=mysql_fetch_array($result)) {
				if($row["seq"] > $seqCurso) {
					$seq = $row["seq"];
					$seq--;
					$sqlUpdate = "UPDATE autor_curso
							SET
							seq = '".$seq."'
							WHERE fk_autor='".$id_user."'
							AND fk_curso='".$row["fk_curso"]."'";
					$resultUpdate = runSQL($sqlUpdate);
				}
			}
			$sqlRemove = "DELETE 
							FROM autor_curso
							WHERE fk_autor = '".$id_user."'
							AND fk_curso = '".$idCurso."'";
			$resultRemove = runSQL($sqlRemove);
			$ans = 16;
		}
		
		
	}
	$str = "dados={retorno:'".$ans."'}";
	echo $str;
	exit;
	
/*-------------------------------------------------------------*/
/*    Funcao que INSERE um CAMPUS no cadastro do ORIENTADOR    */
/*-------------------------------------------------------------*/
# Retorno: 18 = sucesso, -18 = curso ja cadastrado, -1 = erro #

} else if(isset($_POST['opcao']) && $_POST['opcao']=="inserirCampusOr") {
	if(isset($_POST["f_campus"])) {
		$id_user = $_SESSION["id_usuario"];
		$id_campus = (int)$_POST["f_campus"];
			
		// Verifica o numero de campus ja cadastrados pelo usuario
		$nroCampusCad = recNumRows ($id_user, "fk_orientador", "orientador_campus", $conexao);
		
		// Verifica se o campus em questao ja esta cadastrado
		$queryConfere = "SELECT *
			FROM orientador_campus
			WHERE fk_orientador = '".$id_user."'
			AND fk_campus = '".$id_campus."'";
				
		$sqlConfere = runSQL($queryConfere);
		$Confere = mysql_num_Rows($sqlConfere);
		
		// Se este campus ainda nao foi inserido: INSERIR
		if($Confere == 0){
			$nroCampusCad++;
			
			$query = "INSERT into orientador_campus
						(fk_orientador, fk_campus, seq)
					  VALUES
						('$id_user', '$id_campus', '$nroCampusCad')";
				
			$sql = runSQL($query);
			$ans = 14;
		// Se o campus ja esta cadastrado para este usuario: ERRO
		} else { 
			$ans = -14;
		}
	// Se nao foi possivel recuperar dados do form: ERRO
	} else {
		$ans = -1;
	}
		
	$resp = "dados={retorno:'".$ans."'}";
	echo $resp;
	exit;
	
/*-------------------------------------------------------------*/
/*    Funcao que REMOVE um CAMPUS no cadastro do ORIENTADOR    */
/*-------------------------------------------------------------*/
#  Retorno: 18 = sucesso, -18 = sу tem 1 campus, -19 = curso vinculado ao trabalho  #

} else if(isset($_POST['opcao']) && $_POST['opcao']=="removeCampusOr") {
	// parte 1: verificar se possui mais de um campus
	$id_user = $_SESSION["id_usuario"];
	$qntCampus = recNumRows ($id_user, "fk_orientador", "orientador_campus", $conexao);
	// possui somente 1 campus: ERRO
	if($qntCampus == 1) {
		$ans = -18;
	// parte 2: verificar se estб vinculado a algum trabalho
	} else {
		$idCampus = (int)$_POST["id_campus"];
		
		$sqlTrab = "SELECT * FROM trabalho_orientador_campus WHERE fk_orientador=".$id_user." AND fk_campus=".$idCampus;
		$resultTrab = runSQL($sqlTrab);
		$qnt = mysql_num_rows($resultTrab);
		// se nгo esta vinculado: EXCLUIR 
		if($qnt==0) {
			$arrCampus = recLinha ($idCampus, "fk_campus", "orientador_campus", $conexao);
			$seqCampus = $arrCampus["seq"];
		
			$sql = "SELECT * 
					FROM orientador_campus
					WHERE fk_orientador='".$id_user."'
					AND fk_campus != ".$idCampus;
			$result = runSQL($sql);
			while($row=mysql_fetch_array($result)) {
				if($row["seq"] > $seqCampus) {
					$seq = $row["seq"];
					$seq--;
					$sql2 = "UPDATE orientador_campus
							SET
							seq = '".$seq."'
							WHERE fk_orientador='".$id_user."'
							AND fk_campus='".$row["fk_campus"]."'";
					$result2 = runSQL($sql2);
			    }
			}
			$sqlRemove = "DELETE FROM orientador_campus
							WHERE fk_orientador = '".$id_user."'
							AND fk_campus = '".$idCampus."'";
			$result3 = runSQL($sqlRemove);
			$ans = 18;
        // esta vinculado a um trabalho: ERRO	
		} else {
			$ans = -19;
		}
	}
	$str = "dados={retorno:'".$ans."'}";
	echo $str;
	exit;

}
 
 
# #########################################################################################
#                                 FUNCOES AUXILIARES 
# #########################################################################################

// Funcao atualiza dados do usuario: UPDATE
// Retorno: 1 = sucesso, 0 = erro

function editar_cad_usuario($id, $nome, $email, $senha, $cpf){
    if($senha != "") {
		$senha2 = MD5($senha);
	} else {
		$mantemSenha = "SELECT senha
						FROM usuario
						WHERE id_usuario=".$id;
		$resultSenha = runSQL($mantemSenha);
		$linha_senha = mysql_fetch_array($resultSenha);
		$senha2 = $linha_senha["senha"];
	}

	$sql = "UPDATE usuario
            SET
            nome = '".$nome."',
            email = '".$email."',
            senha = '".$senha2."'
            WHERE id_usuario = ".$id;
    
    $result = runSQL($sql);
	
	if($result != false) {
	$nome = stripslashes($nome);
	$email = stripslashes($email);
	$senha = stripslashes($senha);
	// envio do email
	/*  $sHeader = "From: mostratec@poa.ifrs.edu.br\n";
	  $sBody = $nome."\n";
      $sBody = "Registro de Alteraзгo de Dados:\n\n";
	  $sBody .= "Nome: ".$nome."\n";
	  $sBody .= "Email: ".$email."\n";
	  $sBody .= "Para entrar no sistema:\n";
      $sBody .= "CPF: ".$cpf."\n";
      $sBody .= "Senha: ".$senha."\n";
      $sBody .= "Link: http://mostratec.poa.ifrs.edu.br/2012  \n";
      $sTo = $email;
      $sSubject = " Alteraзгo de Dados - Mostratec (".$nome.") ";
      $Envio = mail ($sTo, $sSubject, $sBody, $sHeader) ; */
	  
		$_SESSION['nome_usuario'] = $nome;
		$ans = 1;
	} else {
		$ans = 0;
	}
    return $ans;
}
 
 ?>