<?php
session_start();

include("../conexao.php");
include("../funcoes.php");
include("./constantes.php");

/*-------------------------------------------------------------*/
/*         Funcao que RECUPERA dados GERAIS do USUARIO         */
/*-------------------------------------------------------------*/
# Retorno: dados gerais -> home.php #

if(isset($_GET["opcao"]) && $_GET["opcao"]=="getInfoUsuario"){
    $id_user = (int)$_SESSION["id_usuario"];
    $arr = recLinha ($id_user, "id_usuario", "usuario", $conexao);
    $cpf = stripslashes($arr["cpf"]);
	$nome = stripslashes($arr["nome"]);
	$email = stripslashes($arr["email"]);
    $ret = '<label style="margin-left:10px;">CPF: '.$cpf.'</label>';
    $ret .= '<br><label style="margin-left:10px;">Nome: '.$nome.'</label>';
    $ret .= '<br><label style="margin-left:10px;">E-mail: '.$email.'</label>';
    $ret .= '<div style="clear:both;height:5px;"></div>';
    $ret .= '<a href="cadastroF.php?modificar=Geral" class="link1" style="font-size:10px;text-decoration:underline;margin-left:10px;">Alterar dados de usuário</a>';
    
    echo $ret;
    exit;

/*-------------------------------------------------------------*/
/*    Funcao que RECUPERA dados GERAIS para "Alterar Dados"    */
/*-------------------------------------------------------------*/	
# Retorno: dados gerais -> CadastroF.php #

} else if (isset($_GET["opcao"]) && $_GET["opcao"]=="getCadUsuario" ){
    $id_user = (int)$_SESSION["id_usuario"];
    $arr = recLinha ($id_user, "id_usuario", "usuario", $conexao);
	$cpf = stripslashes($arr["cpf"]);
	$nome = stripslashes($arr["nome"]);
	$email = stripslashes($arr["email"]);
    
    $str = "dados={id_usuario:'".$_SESSION["id_usuario"]."', cpf:'".$cpf."', nome:'".$nome."', email:'".$email."'}";
    
    echo $str;
	exit;

/*-------------------------------------------------------------*/
/*           Funcao que RECUPERA papeis do USUARIO             */
/*-------------------------------------------------------------*/		
# Retorno: id = cadastrado OU 0 = nao cadastrado #    

} else if (isset($_GET["opcao"]) && $_GET["opcao"]=="getPapel") {
	$id_user = (int)$_SESSION["id_usuario"];
	$autor = conferePapelId ($id_user, "autor", $conexao);
	$orientador = conferePapelId ($id_user, "orientador", $conexao);
	$avaliador = conferePapelId ($id_user, "avaliador", $conexao);
	$voluntario = conferePapelId ($id_user, "voluntario", $conexao);
	$ouvinte = conferePapelId ($id_user, "ouvinte", $conexao);
	
	if($autor != 0) {
		$_SESSION["autor"] = "allowed";
	} else if($orientador != 0) {
		$_SESSION["orientador"] = "allowed";
	} else if($avaliador != 0) {
		$_SESSION["avaliador"] = "allowed";
	} else if($voluntario != 0) {
		$_SESSION["voluntario"] = "allowed";
	}else if($ouvinte != 0) {
		$_SESSION["ouvinte"] = "allowed";
	}

	$str = "dados={autor:'".$autor."', orientador: '".$orientador."', avaliador: '".$avaliador."', voluntario: '".$voluntario."', ouvinte: '".$ouvinte."'}";
	
	echo $str;
	exit;

/*-------------------------------------------------------------*/
/*            Funcao que RECUPERA dados do AUTOR               */
/*-------------------------------------------------------------*/			
# Retorno: dados do AUTOR -> home_areaAutor.php #

} else if(isset($_GET["opcao"]) && $_GET["opcao"]=="getInfoAutor") {
	$id_user = (int)$_SESSION["id_usuario"];
	$sql = "SELECT ac.fk_curso, c.nome as nomeCurso, c.nivel, c.fk_campus, ca.nome as nomeCampus, ca.fk_instituicao, i.sigla,
				CASE c.nivel
					WHEN 2 THEN '(Técnico) - '
					WHEN 3 THEN '(Superior) - '
					ELSE '' 
					END as nivelCurso
			FROM autor_curso ac
			INNER JOIN curso c on (c.id_curso = ac.fk_curso)
			INNER JOIN campus ca on (ca.id_campus = c.fk_campus)
			INNER JOIN instituicao i on (i.id_instituicao = ca.fk_instituicao)
			WHERE ac.fk_autor='".$id_user."'"; 

	$result = runSQL($sql);
	if($result == false)
		echo mysql_error();
	
	while($row = mysql_fetch_array($result)) { 
		$nomeCurso = stripslashes($row["nomeCurso"]);
		$nomeCampus = stripslashes($row["nomeCampus"]);
		$sigla = stripslashes($row["sigla"]);
		$str = '<tr><td style="padding-left:10px;">'.$row["nivelCurso"].$nomeCurso.'</td>';
		$str .=    '<td style="padding-left:10px;">'.$nomeCampus.'</td>';
		$str .=    '<td style="padding-left:10px;">'.$sigla.'</td>';
		$str .=    '<td><a href="#" class="link1" onclick="removeCurso('.$row["fk_curso"].');" style="font-size:10px;text-decoration:underline;margin-left:15px;">Remover </a></td></tr>';
		echo $str;
	}
	//$str = '<tr><td style="padding-left:10px;padding-top:5px;"><a href="#" onclick="insereCurso();" class="link1" //style="font-size:10px;text-decoration:underline;"> inserir novo curso</a></td></tr><br><br>';
	//echo $str;
	exit;
	
/*-------------------------------------------------------------*/
/*          Funcao que RECUPERA dados do ORIENTADOR            */
/*-------------------------------------------------------------*/			
# Retorno: dados do ORIENTADOR -> home_areaOrientador.php #

} else if(isset($_GET["opcao"]) && $_GET["opcao"]=="getInfoOrientador") {
	$id_user = (int)$_SESSION["id_usuario"];
	if(isset($_GET["dado"]) && $_GET["dado"]=="tipo") {
		$sql = "SELECT tipo_servidor,
				CASE tipo_servidor
					WHEN 1 THEN ' Docente'
					WHEN 2 THEN ' Técnico Administrativo'
					ELSE '' 
					END as tipo
				FROM orientador
				WHERE fk_usuario='".$id_user."'";
		$result = runSQL($sql);
		$arr = mysql_fetch_array($result);
		
		$strTipo = '<label> Tipo de Servidor: '.$arr["tipo"].'</label>';
		echo $strTipo;
		exit;
		
	} else if(isset($_GET["dado"]) && $_GET["dado"]=="campus") {
		$sql = "SELECT oc.fk_campus, ca.nome as nomeCampus, ca.fk_instituicao, i.nome as nomeInst, i.sigla
			FROM orientador_campus oc
			INNER JOIN campus ca on (ca.id_campus = oc.fk_campus)
			INNER JOIN instituicao i on (i.id_instituicao = ca.fk_instituicao)
			WHERE oc.fk_orientador = '".$id_user."'";
		$result = runSQL($sql);
		if($result==false)
			echo mysql_error();
		
		$str = '';
		while($row = mysql_fetch_array($result)) { 
			$nomeCampus = stripslashes($row["nomeCampus"]);
			$nomeInst = stripslashes($row["nomeInst"]);
			$sigla = stripslashes($row["sigla"]);
			$str .='<tr><td style="padding-left:10px;">'.$nomeCampus.'</td>';
			$str .='<td style="padding-left:10px;">'.$sigla.' </td>';
			$str .='<td><a href="#" class="link1" onclick="removeCampus('.$row["fk_campus"].');" style="font-size:10px;text-decoration:underline;margin-left:15px;"> remover </a></td></tr>';
		}
		$str .= '<tr><td style="padding-left:10px;padding-top:5px;"><a href="#" onclick="insereCampus();" class="link1" style="font-size:10px;text-decoration:underline;"> Vincular-se a nova Instituição... </a></td></tr>';
	
		echo $str;
		exit;
	}
	
/*-------------------------------------------------------------*/
/*           Funcao que RECUPERA dados do AVALIADOR            */
/*-------------------------------------------------------------*/	
# Retorno: dados do AVALIADOR -> home_areaAvaliador.php #	

} else if (isset($_GET["opcao"]) && $_GET["opcao"]=="getInfoAvaliador" ){
	$id_user = (int)$_SESSION["id_usuario"];
	$sql = "SELECT a.tipo_servidor, a.formacao, a.fk_campus, ca.nome as nomeCampus, ca.fk_instituicao, i.nome as nomeInst, i.sigla,
			CASE tipo_servidor
				WHEN 1 THEN ' Docente'
				WHEN 2 THEN ' Técnico Administrativo'
				WHEN 3 THEN ' Estudande de Pós-graduação Stricto Sensu'
				ELSE '' END as tipo,
			CASE formacao
				WHEN 3 THEN ' Superior' 
				WHEN 4 THEN ' Especialização'
				WHEN 5 THEN ' Mestrado'
				WHEN 6 THEN ' Doutorado'
				ELSE '' END as form
			FROM avaliador a
			INNER JOIN campus ca on (ca.id_campus = a.fk_campus)
			INNER JOIN instituicao i on (i.id_instituicao = ca.fk_instituicao)
			WHERE a.fk_usuario='".$id_user."'"; 

	$result = runSQL($sql);
	if($result == false)
		echo mysql_error();
		
	$arr = mysql_fetch_array($result);
	$nomeCampus = stripslashes($arr["nomeCampus"]);
	$nomeInst = stripslashes($arr["nomeInst"]);
	$sigla = stripslashes($arr["sigla"]);
	
	$str = '<tr><td style="padding-left:10px;height:15px;"> Tipo de Servidor: </td><td style="padding-left:10px;"> '.$arr["tipo"].'</td></tr>';
	$str .= '<tr><td style="padding-left:10px;height:15px;""> Formação: </td><td style="padding-left:10px;"> '.$arr["form"].'</td></tr>';
	$str .= '<td style="padding-left:10px;height:15px;""> Campus: </td><td style="padding-left:10px;"> '.$nomeCampus.'</td></tr>';
	$str .= '<td style="padding-left:10px;height:15px;""> Instituição: </td><td style="padding-left:10px;"> '.$nomeInst.' ('.$sigla.') </td></tr>';
	
	echo $str;
	exit;

/*-------------------------------------------------------------*/
/*           Funcao que RECUPERA areas do AVALIADOR            */
/*-------------------------------------------------------------*/	
# Retorno: areas do AVALIADOR -> home_areaAvaliador.php #	

} else if(isset($_GET["opcao"]) && $_GET["opcao"]=="getAreasAvaliador") {	
	$id_user = (int)$_SESSION["id_usuario"];
	
	$sql = "SELECT * FROM tematica a LEFT JOIN avaliador_area aa ON a.id_area = aa.fk_area AND fk_avaliador =".$id_user;
	$query = runSQL($sql);
	
	$str = '';
	$conta = 0;
	while($linha = mysql_fetch_array($query)) {
		$conta++;
		if($conta == 1) {
			$str .= '<div style="float:left;width:50%;">';
		} else if($conta==7) {
                    if(ETAPA_INSCRICAO_AVALIADOR == "1"){
			$str .= '<br><a href="#" class="link1" style="text-decoration:underline;" onclick="habilitar_campos();"> Editar Áreas </a>';
			$str .= '<a href="#" id="saveButton" class="link1" style="text-decoration:underline;margin-left:20px;display:none;" onclick="atualizaAreas();"> Salvar </a>';
                    }
		    $str .= '</div><div>';
		} 	
		if($linha["fk_area"] != NULL) {
			$str .= '<input type="checkbox" checked="true" name="area[]" disabled="disabled" value="'.$linha["id_area"].'" >'.$linha["nome"].'<br>';
		} else {
			$str .= '<input type="checkbox" name="area[]" disabled="disabled" value="'.$linha["id_area"].'" >'.$linha["nome"].'<br>';
		}
		if($conta==12) {
			$str .= '</div>';
		}	
	}
	
	echo $str;
	exit; 

} else if(isset($_POST["opcao"]) && $_POST["opcao"]=="get_sessoes_pendentes") { 
	$id_user = (int)$_SESSION["id_usuario"];
	$sessoes_pendentes = "SELECT s.*, avs.status as status_aval,
	CASE s.fk_modalidade
		WHEN 1 THEN 'Apresentação Oral'
		WHEN 2 THEN 'Apresentação de Pôster'
		ELSE ''
		END as modalidade
	FROM sessao s, avaliador_sessao avs WHERE avs.fk_avaliador =".$id_user." AND s.id_sessao = avs.fk_sessao ORDER BY s.data ASC, s.hora_ini ASC";
	$result = runSQL($sessoes_pendentes);
	if($result == false)
		 echo mysql_error();
	$number = mysql_num_rows($result);
	$str = '<br><br><br><br><br><br> ';
	if($number != 0) {
	while($linha = mysql_fetch_array($result)) {
		$data = $linha["data"];
		$normal = explode("-", $data);
		$data = $normal[2]."/".$normal[1]."/".$normal[0];
		if($linha["status_aval"] == 0) 
			$str .= '<br><fieldset style="background-color:#FFE4E1;"> Atividade Pendente: ';
		else if($linha["status_aval"] == 1) 
			$str .= '<br><fieldset style="background-color:#CCDAB4;"> <b>Atividade Confirmada: </b>';
		else if($linha["status_aval"] == 2) 
			$str .= '<br><fieldset style="background-color:#FFE4B5;"> <b>Atividade Recusada: </b>';
		$str .= 'Sessão: '.$linha["nome"].' <br>';
		//$str .= 'Sala: '.$linha["nome_sala"].' <br>';
		//$str .= 'Andar: '.$linha["nome_andar"].' <br>';
		$str .= 'Data: '.$data.' <br>';
		$str .= 'Início: '.$linha["hora_ini"].' <br>';
		$str .= 'Fim: '.$linha["hora_fim"].' <br>';
		$str .= 'Modalidade: '.$linha["modalidade"].'<br>';
		if($linha["status_aval"] == 0) {
		$str .= 'Você confirma sua presença nesta sessão?';
		$str .= '<button id="botao_sim" style="margin-left:20px;" type="submit" value="'.$linha["id_sessao"].'" onclick="confirma('.$linha["id_sessao"].');">Sim</button>';
		$str .= '<button id="botao_nao" style="margin-left:20px;" type="submit" value="'.$linha["id_sessao"].'" onclick="recusa('.$linha["id_sessao"].');">Não</button>';
		} else if($linha["status_aval"] == 1){
		$str .= 'Clique no botão ao lado se deseja recusar sua participação na sessão: ';
		$str .= '<button id="botao_nao" style="margin-left:20px;" type="submit" value="'.$linha["id_sessao"].'" onclick="recusa('.$linha["id_sessao"].');">recusar</button>';
		} else if($linha["status_aval"] == 2) {
		$str .= 'Clique no botão ao lado se deseja confirmar sua participação na sessão: ';
		$str .= '<button id="botao_sim" style="margin-left:20px;" type="submit" value="'.$linha["id_sessao"].'" onclick="confirma('.$linha["id_sessao"].');">participar</button>';
		}
		$str .= '</fieldset>';

	}
	}
	echo $str;
	exit;
	
} else if(isset($_GET["opcao"]) && $_GET["opcao"]=="cancelar_participacao") {
	$id_user = (int)$_SESSION["id_usuario"];
	$id_sessao = $_GET["id_sessao"];
	
	$sql_cancela = "UPDATE avaliador_sessao SET status = 2 WHERE fk_sessao =".$id_sessao." AND fk_avaliador =".$id_user;
	$result = runSQL($sql_cancela);
	
	exit;	
	
} else if(isset($_GET["opcao"]) && $_GET["opcao"]=="confirmar_participacao") {
	$id_user = (int)$_SESSION["id_usuario"];
	$id_sessao = $_GET["id_sessao"];
	
	$sql_confirma = "UPDATE avaliador_sessao SET status = 1 WHERE fk_sessao =".$id_sessao." AND fk_avaliador =".$id_user;
	$result = runSQL($sql_confirma);
	
	exit;
	
/*-------------------------------------------------------------*/
/*           Funcao que ATUALIZA areas do AVALIADOR           */
/*-------------------------------------------------------------*/	
# Retorno: áreas do AVALIADOR -> home_areaAvaliador.php #	
	
} else if(isset($_POST["opcao"]) && $_POST["opcao"]=="atualizaAreasAvaliador") { 
	$id_user = (int)$_SESSION["id_usuario"];
	$confere = "SELECT * FROM avaliador WHERE fk_usuario=".$id_user;
	$queryConfere = runSQL($confere);
	$qnt = mysql_num_rows($queryConfere);
	if($qnt == 1) {
            $id_area = $_POST['area'];
            if (sizeof($id_area) > 1){
                    $ans = -2;
            } else{
		$sqlRemove = "DELETE FROM avaliador_area WHERE fk_avaliador=".$id_user;
		$queryRemove = runSQL($sqlRemove);               
                
                    foreach($id_area as $key => $value) {
                            $sqlInsere = "INSERT INTO avaliador_area (fk_area, fk_avaliador) VALUES (".$value.",".$id_user.")";
                            $queryInsere = runSQL($sqlInsere);
                    }
                    $ans = 1;
            }
	} else {
		$ans = -1;
	} 
	echo $ans;
	
/*-------------------------------------------------------------*/
/*           Funcao que RECUPERA dados do VOLUNTARIO           */
/*-------------------------------------------------------------*/	
# Retorno: dados do VOLUNTARIO -> home_areaVoluntario.php #	

} else if (isset($_GET["opcao"]) && $_GET["opcao"]=="getInfoVoluntario"){ 
	$id_user = (int)$_SESSION["id_usuario"];
	$sql = "SELECT v.fk_curso, c.nome as nomeCurso, c.nivel, c.fk_campus, ca.nome as nomeCampus, 
            v.Manha, v.Tarde, v.Noite, ca.fk_instituicao, i.nome as nomeInst, i.sigla,
			CASE c.nivel
				WHEN 2 THEN '(Técnico) - '
				WHEN 3 THEN '(Superior) - '
				ELSE '' 
				END as nivelCurso
			FROM voluntario v
			INNER JOIN curso c on (c.id_curso = v.fk_curso)
			INNER JOIN campus ca on (ca.id_campus = c.fk_campus)
			INNER JOIN instituicao i on (i.id_instituicao = ca.fk_instituicao)
			WHERE fk_usuario='".$id_user."'"; 

	$result = runSQL($sql);
	$arr = mysql_fetch_array($result);
	$nomeCurso = stripslashes($arr["nomeCurso"]);
	$nomeCampus = stripslashes($arr["nomeCampus"]);
	$nomeInst = stripslashes($arr["nomeInst"]);
	$sigla = stripslashes($arr["sigla"]);
        $disp = "";
        if($arr["Manha"] == 'S')
            $disp .= "Manhã;";
        if($arr["Tarde"] == 'S')
            $disp .= "Tarde;";
        if($arr["Noite"] == 'S')
            $disp .= "Noite;";
	$str = '<tr><td style="padding-left:10px;height:15px;"> Curso: </td><td style="padding-left:10px;"> '.$arr["nivelCurso"].$nomeCurso.'</td></tr>';
	$str .='<tr><td style="padding-left:10px;height:15px;"> Campus: </td><td style="padding-left:10px;"> '.$nomeCampus.'</td></tr>';
	$str .='<tr><td style="padding-left:10px;height:15px;"> Instituição: </td><td style="padding-left:10px;"> '.$nomeInst.' ('.$sigla.') </td></tr>';
	$str .='<tr><td style="padding-left:10px;height:15px;"> Disponibilidade: </td><td style="padding-left:10px;"> '.$disp.' </td></tr>';
	echo $str;
	exit;

/*-------------------------------------------------------------*/
/*            Funcao que RECUPERA dados do OUVINTE             */
/*-------------------------------------------------------------*/	
# Retorno: dados do OUVINTE -> home_areaOuvinte.php #		

} else if (isset($_GET["opcao"]) && $_GET["opcao"]=="getInfoOuvinte"){ 
	$id_user = (int)$_SESSION["id_usuario"];
	$sql = "SELECT fk_instituicao, fk_campus, fk_curso, tipo_ouvinte, outro, empresa,
		    CASE tipo_ouvinte
				WHEN 1 THEN ' Docente'
				WHEN 2 THEN ' Técnico Administrativo'
				WHEN 3 THEN ' Aluno'
				WHEN 4 THEN ' Outro'
				ELSE '' 
				END as tipo
			FROM ouvinte
			WHERE fk_usuario=".$id_user;
	$result = runSQL($sql);
	$arr = mysql_fetch_array($result);
	$str = '<tr><td style="padding-left:10px;height:15px;"> Tipo: </td><td style="padding-left:10px;"> '.$arr["tipo"].'</td></tr>';
	if($arr["tipo"] == " Outro" && $arr["outro"] != NULL) {
		$outro = stripslashes($arr["outro"]);
		$str .= '<tr><td style="padding-left:10px;height:15px;"> Outro: </td><td style="padding-left:10px;"> '.$outro.'</td></tr>';
	}
	if($arr["empresa"] != NULL) {
		$empresa = stripslashes($arr["empresa"]);
		$str .= '<tr><td style="padding-left:10px;height:15px;"> Empresa: </td><td style="padding-left:10px;"> '.$empresa.'</td></tr>';
	}
	
	if($arr["fk_instituicao"] != NULL) {
		if($arr["fk_campus"] != NULL) {
			if($arr["fk_curso"] != NULL) {
				// Caso 1: possui inst/campus/curso
				$sql2 = "SELECT c.nome as nomeCurso, c.nivel, ca.nome as nomeCampus, i.nome as nomeInst, i.sigla,
						 CASE nivel
							WHEN 2 THEN '(Técnico) - '
							WHEN 3 THEN '(Superior) - '
							ELSE '' 
							END as nivelCurso
						FROM curso c
						INNER JOIN campus ca on (ca.id_campus = '".$arr["fk_campus"]."')
						INNER JOIN instituicao i on (i.id_instituicao = '".$arr["fk_instituicao"]."')
						WHERE c.id_curso = ".$arr["fk_curso"];
				$result2 = runSQL($sql2);
				$arr2 = mysql_fetch_array($result2);
				$nomeCurso = stripslashes($arr2["nomeCurso"]);
				$nomeCampus = stripslashes($arr2["nomeCampus"]);
				$nomeInst = stripslashes($arr2["nomeInst"]);
				$sigla = stripslashes($arr2["sigla"]);
				$str .= '<tr><td style="padding-left:10px;height:15px;"> Curso: </td><td style="padding-left:10px;"> '.$arr2["nivelCurso"].$nomeCurso.'</td></tr>';
				$str .= '<tr><td style="padding-left:10px;height:15px;"> Campus: </td><td style="padding-left:10px;"> '.$nomeCampus.'</td></tr>';
				$str .= '<tr><td style="padding-left:10px;height:15px;">Instituição: </td><td style="padding-left:10px;"> '.$nomeInst.' ('.$sigla.') </td></tr>';
			// Caso 2: possui inst/campus
			} else {
				$sql2 = "SELECT ca.nome as nomeCampus, i.nome as nomeInst, i.sigla
						FROM campus ca
						INNER JOIN instituicao i on (i.id_instituicao = '".$arr["fk_instituicao"]."')
						WHERE ca.id_campus = ".$arr["fk_campus"];
				$result2 = runSQL($sql2);
				$arr2 = mysql_fetch_array($result2);
				$nomeCampus = stripslashes($arr2["nomeCampus"]);
				$nomeInst = stripslashes($arr2["nomeInst"]);
				$sigla = stripslashes($arr2["sigla"]);
				$str .= '<tr><td style="padding-left:10px;height:15px;"> Campus: </td><td style="padding-left:10px;"> '.$nomeCampus.'</td></tr>';
				$str .= '<tr><td style="padding-left:10px;height:15px;"> Instituição: </td><td style="padding-left:10px;"> '.$nomeInst.' ('.$sigla.') </td></tr>';
			}
		// Caso 3: possui inst
		} else {
			$sql2 = "SELECT nome as nomeInst, sigla
					FROM instituicao
					WHERE id_instituicao = ".$arr["fk_instituicao"];
				$result2 = runSQL($sql2);
				$arr2 = mysql_fetch_array($result2);
				$nomeInst = stripslashes($arr2["nomeInst"]);
				$sigla = stripslashes($arr2["sigla"]);
				$str .= '<tr><td style="padding-left:10px;height:15px;"> Instituição: </td><td style="padding-left:10px;"> '.$nomeInst.' ('.$sigla.') </td></tr>';
		}
	}
	echo $str;
	exit; 
	
} else if(isset($_POST["opcao"]) && $_POST["opcao"]=="logout") {
	session_destroy();
    echo 1;
}

?>
