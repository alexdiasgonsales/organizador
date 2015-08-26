<?php
session_start();

include("../conexao.php");
include("../funcoes.php");
include("constantes.php");
include("adm/constantes_adm.php");


/*-------------------------------------------------------------*/
/*       Funcao que RECUPERA lista de TRABALHOS do AUTOR       */
/*-------------------------------------------------------------*/	
# Retorno: dados do TRABALHO -> home_areaAutor.php #	

if (isset($_GET["opcao"]) && $_GET["opcao"]=="getListaTrabalhos"){
	$id_user = (int)$_SESSION["id_usuario"];
	if(isset($id_user)) {

			$sqlTrab = "SELECT t.id_trabalho, t.titulo, t.status, tac.seq
						FROM trabalho_autor_curso tac
						INNER JOIN trabalho t ON (t.id_trabalho = tac.fk_trabalho)
						WHERE tac.fk_autor=".$id_user;
			$resultTrab = runSQL($sqlTrab);
	
			$sqlQntTrabalhos = "SELECT * FROM trabalho_autor_curso WHERE fk_autor=".$id_user." AND seq = 1";
			$resultQnt = runSQL($sqlQntTrabalhos);
			$qntTrabalhos = mysql_num_rows($resultQnt);
	
			$str = '';
	
			while($arr = mysql_fetch_array($resultTrab)){
                $id_trabalho = $arr["id_trabalho"];
				$titulo = $arr["titulo"];
				$titulo = str_replace("<p>", "", $titulo);
				$titulo = str_replace("</p>", "", $titulo);
				$titulo = stripslashes($titulo);
				$status = $arr["status"];
				$status_mostrar = $arr_status_trab[$status];
				
					if (ETAPA_INSCRICAO_TRABALHO == 1){ 
					    if ( ($status == STATUS_TRAB_PENDENTE) || ($status == STATUS_TRAB_ENVIADO) )
					        $status_mostrar = $arr_status_trab[$status];
					    else
						    $status_mostrar = "Em análise";
					}
					else if (ETAPA_CORRECAO_TRABALHO == 1)
					        $status_mostrar = $arr_status_trab[$status];
				    else
						    $status_mostrar = "Em análise";
							
				if($arr["seq"]=="1"){
					//autor
					//$str .= '<div style="width:370px;float:left;overflow:hidden;margin-left:10px;">';
                    $str .= '<tr><td style="padding-left:10px;height:15px;">'.$id_trabalho.'</td>';
					$str .= '<td>'.$titulo.'</td>';
					//$str .= '</div> ';
					//$str .= '<div style="float:left;width:270px;height:30px;">';
					
                    //$str .= '<td>'.$arr_status_trab[$status].'</td>';
					$str .= '<td>'.$status_mostrar.'</td>';
                    
					//$str .= '<td><a href="trabalho.php?action=view&id_trab='.$arr["id_trabalho"].'" class="link1" style="margin-left:20px;font-size:10px;text-decoration:underline;">Visualizar/Editar</a>';
					$str .= '<td><a href="trabalho.php?action=view&id_trab='.$arr["id_trabalho"].'" class="link1" style="margin-left:20px;font-size:10px;text-decoration:underline;">Visualizar</a>';
                    
					if (($arr["status"]==STATUS_TRAB_PENDENTE && ETAPA_INSCRICAO_TRABALHO == 1) || ($arr["status"]==STATUS_TRAB_CORRIGIR && ETAPA_CORRECAO_TRABALHO == 1)) {
                        //$str .= '<a href="trabalho.php?action=edit&id_trab='.$arr["id_trabalho"].'" class="link1" style="margin-left:20px;font-size:10px;text-decoration:underline;">Editar</a>';
                        //$str .= '<a href="#" class="link1" //style="margin-left:20px;font-size:10px;text-decoration:underline;" //onclick="removerTrabalho('.$arr["id_trabalho"].');">Excluir</a>';
                    }
				        
                    $str .= '</td></tr>';
					//$str .= '</div>';
				} else {
					//coautor
					//$str .= '<div style="width:370px;float:left;overflow:hidden;height:30px;margin-left:10px;">';
					$str .= '<tr><td style="padding-left:10px;height:15px;">'.$id_trabalho.'</td>';
					$str .= '<td>'.$titulo.'</td>';
					//$str .= '<td>'.$arr_status_trab[$status].'</td>';
					$str .= '<td>'.$status_mostrar.'</td>';
					///$str .= '</div> ';
					//$str .= '<div style="float:left;width:270px;height:30px;">';
					$str .= '<td><a href="trabalho.php?action=view&id_trab='.$arr["id_trabalho"].'" class="link1" style="margin-left:20px;font-size:10px;text-decoration:underline;">Visualizar</a></td> <td>.</td></tr>';
					//$str .= '</div>';
				}
			}
			if($qntTrabalhos<2) {
                if(ETAPA_INSCRICAO_TRABALHO == 1) {
				  //$str .= '<div style="clear:both;height:20px;"></div>';
				  $str .= '<tr><td colspan="4"><a href="trabalho.php?action=new" class="link1" style="margin-left:20px;margin-bottom:10px;font-size:10px;text-decoration:underline; width:100%;">Cadastrar novo trabalho...</a></td></tr>';
                }
			}
    } else {
		$str = "Error.";
	}
    echo $str;
    exit;
}//getListaTrabalhos

/*-------------------------------------------------------------*/
/*    Funcao que RECUPERA lista de TRABALHOS do ORIENTADOR     */
/*-------------------------------------------------------------*/	
# Retorno: dados do TRABALHO -> home_areaOrientador.php #		
else if(isset($_GET["opcao"]) && $_GET["opcao"]=="getListaTrabOrientador") { 
	$id_user = (int)$_SESSION["id_usuario"];
	
	if(isset($id_user)) {
		$sqlTrab = "SELECT toc.fk_trabalho, t.id_trabalho, t.titulo, toc.seq
					FROM trabalho_orientador_campus toc
					INNER JOIN trabalho t ON (t.id_trabalho = toc.fk_trabalho)
					WHERE toc.fk_orientador=".$_SESSION["id_usuario"];
		$resultTrab = runSQL($sqlTrab);
	
		$str = '';
		while($arr = mysql_fetch_array($resultTrab)){
			$titulo = $arr["titulo"];
			$titulo = str_replace("<p>", "", $titulo);
			$titulo = str_replace("</p>", "", $titulo);
			$titulo = stripslashes($titulo);
        
			$str .= '<div style="width:370px;float:left;overflow:hidden;height:30px;margin-left:10px;">';
			$str .= '<label>- '.$titulo.'</label>';
			$str .= '</div> ';
			$str .= '<div style="float:left;width:270px;height:30px;">';
			$str .= '<a href="trabalho.php?action=view&id_trab='.$arr["id_trabalho"].'" class="link1" style="margin-left:20px;font-size:10px;text-decoration:underline;">Visualizar</a>';
			$str .= '</div>';
		}
    } else {
		$str = "Error.";
	}
    echo $str;
    exit;
}//getListaTrabOrientador

/*-------------------------------------------------------------------*/
/* Funcao que verifica se algum trabalho ja foi enviado e modalidade */
/*-------------------------------------------------------------------*/	
# Retorno: modalidade, caso tenha trabalho -> criarEeditarTrab.php #			
//modificado nome de verificaAutor para verificaModalidadesTrabalhosAutor
//Retorno:
// -1 = Algum erro.
// -2 = Já é autor de dois trabalhos.
// -3 = Sessao nao criada.
// 0 = Não é autor de nenhum trabalho.
// 1 = Já é autor principal de um trabalho na modalidade 1.
// 2 = Já é autor principal de um trabalho na modalidade 2.
else if(isset($_POST["opcao"]) && $_POST["opcao"]=="verificaModalidadesTrabalhosAutor") {	
	$retorno = -1;
	$id_autor = (int)$_SESSION["id_usuario"];
	if(isset($id_autor)) {
        //Consulta os trabalhos onde ele é autor principal.
		$sqlQntTrab = "SELECT fk_trabalho FROM trabalho_autor_curso WHERE fk_autor=".$id_autor." AND seq = 1";
		$result = runSQL($sqlQntTrab);
		$qnt = mysql_num_rows($result);
		if($qnt>2) {
            //Já é autor principal de dois trabalhos.
			//$ans = -2;
            $retorno = -2;
		} else if($qnt==1) {
            //Já é autor de um trabalho. Forçar a modalidade para a outra possível.
			$linha = mysql_fetch_array($result);
			$sqlModo = "SELECT modalidade FROM trabalho WHERE id_trabalho=".$linha["fk_trabalho"];
			$result2 = runSQL($sqlModo);
			$linha2 = mysql_fetch_array($result2);
			$ans = 5;
			$modo = $linha2["modalidade"];
            $retorno = $modo;
            /*
			if($modo==1){
				$modoAns = 2;
			} else if($modo==2){
				$modoAns = 1;
			}
            */
		} else {
			//$ans = 1;
            $retorno = 0;
		}
	} else {
		//$ans = -1;
        $retorno = -3;
	}
	//$str = "dados={retorno:'".$ans."', modalidade:'".$modoAns."'}";
    $str = $retorno;
	echo $str;
	exit;
}//verificaModalidadesTrabalhosAutor

/*---------------------------------------------------------------*/
/* Funcao que RECUPERA CURSOS do AUTOR para Cadastro de Trabalho */
/*---------------------------------------------------------------*/	
# Retorno: SELECT com cursos -> criarEeditarTrab.php #		
else if(isset($_POST["opcao"]) && $_POST["opcao"]=="getCursosAutor") {
	$id_autor = (int)$_SESSION["id_usuario"];
	
	if(isset($id_autor)) {
		$sqlConfere = "SELECT * FROM autor WHERE fk_usuario =".$id_autor;
		$result = runSQL($sqlConfere);
		$existe = mysql_num_rows($result);
		if($existe==1) {
			$id_trab = (int)$_POST["id_trabalho"];
			$sqlCursosAut = "SELECT ac.fk_curso, c.nome as nomeCurso, ca.nome as nomeCampus, i.sigla
							FROM autor_curso ac
							INNER JOIN curso c ON (c.id_curso = ac.fk_curso)
							INNER JOIN campus ca ON (ca.id_campus = c.fk_campus)
							INNER JOIN instituicao i ON (i.id_instituicao = ca.fk_instituicao)
							WHERE ac.fk_autor =".$id_autor;
			$result1 = runSQL($sqlCursosAut);
			$str = '<option value="0">Selecione</option>';
			while($row = mysql_fetch_array($result1)){
				$nomeCurso = stripslashes($row["nomeCurso"]);
				$nomeCampus = stripslashes($row["nomeCampus"]);
				$sigla = stripslashes($row["sigla"]);
				$str .= '<option value="'.$row["fk_curso"].'">'.$nomeCurso.' - '.$nomeCampus.' - '.$sigla.' </option>';
			}
		} else {
			$str = "Error.";
		}
	} else {
		$str = "Error.";
	}
	echo $str;
	exit;
}//getCursosAutor

/*---------------------------------------------------------------*/
/* Funcao que RECUPERA CURSOS do AUTOR e seleciona o curso atualmente cadastrado no Trabalho */
/*---------------------------------------------------------------*/	
# Retorno: SELECT com cursos -> criarEeditarTrab.php #		
else if(isset($_POST["opcao"]) && $_POST["opcao"]=="getCursosAutor2") {
	$id_autor = (int)$_SESSION["id_usuario"];
	
	if(isset($id_autor)) {
		$sqlConfere = "SELECT * FROM autor WHERE fk_usuario =".$id_autor;
		$result = runSQL($sqlConfere);
		$existe = mysql_num_rows($result);
		if($existe==1) {        
			$id_trab = (int)$_POST["id_trabalho"];
            $sql = "SELECT tac.fk_curso FROM trabalho_autor_curso tac WHERE fk_trabalho=".$id_trab." AND fk_autor=".$id_autor;
			$result = runSQL($sql);
            $row = mysql_fetch_array($result);
            $fk_curso = $row["fk_curso"];
            
			$sqlCursosAut = "SELECT ac.fk_curso, c.nome as nomeCurso, ca.nome as nomeCampus, i.sigla
							FROM autor_curso ac
							INNER JOIN curso c ON (c.id_curso = ac.fk_curso)
							INNER JOIN campus ca ON (ca.id_campus = c.fk_campus)
							INNER JOIN instituicao i ON (i.id_instituicao = ca.fk_instituicao)
							WHERE ac.fk_autor =".$id_autor;
			$result1 = runSQL($sqlCursosAut);
			$str = '<option value="0">Selecione</option>';
			while($row = mysql_fetch_array($result1)){
				$nomeCurso = stripslashes($row["nomeCurso"]);
				$nomeCampus = stripslashes($row["nomeCampus"]);
				$sigla = stripslashes($row["sigla"]);
				$str .= '<option value="'.$row["fk_curso"].'">'.$nomeCurso.' - '.$nomeCampus.' - '.$sigla.' </option>';
                $str .= '" ';
                if ($row["fk_curso"] == $fk_curso)
                  $str .= ' select ';
                $str .= '">'.$nomeCurso.' - '.$nomeCampus.' - '.$sigla.' </option>';
			}
		} else {
			$str = "Error.";
		}
	} else {
		$str = "Error.";
	}
	echo $str;
	exit;
}//getCursosAutor2

/*---------------------------------------------------------------*/
/*         Funcao que RECUPERA ÁREAS do TRABALHO             */
/*---------------------------------------------------------------*/		
else if(isset($_GET["opcao"]) && $_GET["opcao"]=="getAreaTematica") { 

	$sql = "SELECT id_area, nome from tematica ORDER BY nome";
	
    $result = runSQL($sql);
            
	$str ='<option value="0">Selecione</option>';
	while($arr = mysql_fetch_array($result)){
        $str .= '<option value="'.$arr["id_area"].'">'.$arr["nome"].'</option>';
    }

	echo $str;
	exit;
	
}//getAreaTematica

/*---------------------------------------------------------------*/
/*         Funcao que RECUPERA ÁREAS do TRABALHO             */
/*---------------------------------------------------------------*/		
else if(isset($_GET["opcao"]) && $_GET["opcao"]=="getAreaTematica2") { 

    if (isset($_GET["id_trabalho"])) {
        $id_trab = $_GET["id_trabalho"];
        
        $sql = "SELECT fk_tematica from trabalho where id_trabalho = ".$id_trab;
        $result = runSQL($sql);        
        $arr = mysql_fetch_array($result);
        $tematica = $arr["fk_tematica"];
        
        $sql = "SELECT id_area, nome from tematica ORDER BY nome";
        $result = runSQL($sql);
        $str ='<option value="0">Selecione</option>';
        while($arr = mysql_fetch_array($result)){
            $str .= '<option value="'.$arr["id_area"];
            $str .= '" ';
            if ($arr["id_area"] == $tematica)
              $str .= ' selected ';
            $str .= '>'.$arr["nome"].'</option>';
        }
        echo $str;
        exit;
    }
}//getAreaTematica2

/*---------------------------------------------------------------*/
/*         Funcao que RECUPERA AUTORES do TRABALHO               */
/*---------------------------------------------------------------*/	
# Retorno: LISTA com COAUTORES -> trabEdit.php #		

else if(isset($_GET["opcao"]) && $_GET["opcao"]=="getListaAutoresTrabalho") {	
	$id_autor = (int)$_SESSION["id_usuario"];
	
	if(isset($id_autor)) {
		$id_trab = (int)$_GET["id_trabalho"];
		$valida = validaAutor($id_autor, $id_trab, $conexao);
		if($valida==1) {
			$sql = "SELECT tac.fk_autor, tac.seq, u.nome as nomeUsuario, c.nome as nomeCurso, ca.nome as nomeCampus, i.sigla
					FROM trabalho_autor_curso tac
						INNER JOIN usuario u ON (u.id_usuario = tac.fk_autor) 
						INNER JOIN curso c ON (c.id_curso = tac.fk_curso)
						INNER JOIN campus ca ON (ca.id_campus = c.fk_campus)
						INNER JOIN instituicao i ON (i.id_instituicao = ca.fk_instituicao)
					WHERE tac.fk_trabalho = ".$id_trab." 
					ORDER BY tac.seq ASC";
			$result = runSQL($sql);
		
			$sql2 = "SELECT * FROM trabalho_autor_curso WHERE fk_trabalho=".$id_trab;
			$result2 = runSQL($sql2);
			$contaAutores = mysql_num_rows($result2);
    
			$str = '';
			while($arr = mysql_fetch_array($result)){
				$nomeUsuario = stripslashes($arr["nomeUsuario"]);
				$nomeCurso = stripslashes($arr["nomeCurso"]);
                $nomeCampus = stripslashes($arr["nomeCampus"]);
				$sigla = stripslashes($arr["sigla"]);
				$str .= '<tr style="border-bottom:1px dotted #CCCCCC;padding-bottom:5px; height:15px;" >';
				$str .= '<td>'.$nomeUsuario.' - '.$nomeCurso.' ('.$sigla.' - '.$nomeCampus.')';
				if (($arr["seq"]) == 1)
					$str .= '</td> <td> Autor Principal </td></tr>';
				else
					$str .= '</td> <td> Co-autor </td><td><a href="#" class="link1" style="margin-left:30px;text-decoration:underline;" onclick="removeCoautor('.$arr["fk_autor"].','.$id_trab.'); return false;">Remover</a></td></tr>';
			}
			//if($contaAutores<5) {
			//  $str .= '<tr><td><a href="#" class="link1" onclick="showBusca();"> Novo Co-autor </a></td></tr>';
			//}
		} else {
			$str = "Error.";
		}
	} else {
		$str = "Error.";
	}
	
    echo $str;
    exit;
}//getListaAutoresTrabalho

/*---------------------------------------------------------------*/
/*        Funcao que RECUPERA ORIENTADORES do TRABALHO           */
/*---------------------------------------------------------------*/	
# Retorno: LISTA com ORIENTADORES -> trabEdit.php #		
else if(isset($_GET["opcao"]) && $_GET["opcao"]=="getListaOrientadoresTrabalho") {	
	$id_autor = (int)$_SESSION["id_usuario"];
	
	if(isset($id_autor)) {
		$id_trab = (int)$_GET["id_trabalho"];
		$valida = validaAutor($id_autor, $id_trab, $conexao);
		if($valida==1) {
			$sql = "SELECT toc.fk_orientador, u.nome, ca.nome as nomeCampus, i.sigla
					FROM trabalho_orientador_campus toc
						INNER JOIN usuario u ON (u.id_usuario = toc.fk_orientador) 
						INNER JOIN campus ca ON (ca.id_campus = toc.fk_campus)
						INNER JOIN instituicao i ON (i.id_instituicao = ca.fk_instituicao)
					WHERE toc.fk_trabalho = ".$id_trab;
			$result = runSQL($sql);
		
			$sql2 = "SELECT * FROM trabalho_orientador_campus WHERE fk_trabalho=".$id_trab;
			$result2 = runSQL($sql2);
			$contaOrientadores = mysql_num_rows($result2);
    
			$str = '';
            while($arr = mysql_fetch_array($result)){
				$nome = stripslashes($arr["nome"]);
				$nomeCampus = stripslashes($arr["nomeCampus"]);
				$sigla = stripslashes($arr["sigla"]);
				$str .= '<tr style="border-bottom:1px dotted #CCCCCC;padding-bottom:5px; height:15px;" >';
				$str .= '<td>'.$nome.' - ('.$sigla.' - '.$nomeCampus.')</td>';
				$str .= '<td><a href="#" class="link1" style="margin-left:30px;text-decoration:underline;" onclick="removeOrientador('.$arr["fk_orientador"].','.$id_trab.'); return false;">Remover</a></td></tr>';
			}
			//if($contaOrientadores<2) {
			//	$str .= '<tr><td><a href="#" class="link1" onclick="showBuscaOr();"> Novo Orientador </a></td></tr>';
			//}
		} else {
			$str = "Error.";
		}
	} else {
		$str = "Error.";
	}
	
    echo $str;
    exit;
}//getListaOrientadoresTrabalho


/*---------------------------------------------------------------*/
/*   Funcao que recupera a quantidade de autores de um trabalho  */
/*---------------------------------------------------------------*/	
else if(isset($_GET["opcao"]) && $_GET["opcao"]=="getQuantidadeAutoresTrabalho") {	
	$id_autor = (int)$_SESSION["id_usuario"];
	
	if(isset($id_autor)) {
		$id_trab = (int)$_GET["id_trabalho"];
		$valida = validaAutor($id_autor, $id_trab, $conexao);
		if($valida==1) {
            $num_linhas = recNumLinhas("SELECT * FROM trabalho t 
                            INNER JOIN trabalho_autor_curso tac ON tac.fk_trabalho = t.id_trabalho
                            WHERE t.id_trabalho = ".$id_trab, $conexao);
        }
        else {
            $num_linhas = -1;
        }
    }
    else {
        $num_linhas = -2;
    }
    echo $num_linhas;
    exit;
}//getQuantidadeAutoresTrabalho

/*---------------------------------------------------------------*/
/*   Funcao que recupera a quantidade de orientadores de um trabalho  */
/*---------------------------------------------------------------*/	
else if(isset($_GET["opcao"]) && $_GET["opcao"]=="getQuantidadeOrientadoresTrabalho") {	
	$id_autor = (int)$_SESSION["id_usuario"];
	
	if(isset($id_autor)) {
		$id_trab = (int)$_GET["id_trabalho"];
		$valida = validaAutor($id_autor, $id_trab, $conexao);
		if($valida==1) {
            $num_linhas = recNumLinhas("SELECT * FROM trabalho t 
                            INNER JOIN trabalho_orientador_campus toc ON toc.fk_trabalho = t.id_trabalho
                            WHERE t.id_trabalho = ".$id_trab, $conexao);
        }
        else {
            $num_linhas = -1;
        }
    }
    else {
        $num_linhas = -2;
    }
    echo $num_linhas;
    exit;
}//getQuantidadeOrientadoresTrabalho

/*---------------------------------------------------------------*/
/*           Funcao que REMOVE COAUTORES do TRABALHO             */
/*---------------------------------------------------------------*/	
# Retorno: atualiza -> trabEdit.php #	
else if(isset($_POST["opcao"]) && $_POST["opcao"]=="removerCoautor") {
	$id_user = (int)$_SESSION["id_usuario"];
	
	if(isset($id_user)) {
		if(ETAPA_INSCRICAO_TRABALHO == 1 || ETAPA_CORRECAO_TRABALHO == 1) {
			$id_trab = (int)$_POST["id_trabalho"];
			$valida = validaAutor($id_user, $id_trab, $conexao);
		
			if($valida==1) {
				$id_coautor = (int)$_POST["id_coautor"];
				$sql = "DELETE FROM trabalho_autor_curso
						WHERE fk_autor = ".$id_coautor."
						AND fk_trabalho = ".$id_trab;
		
				$result2 = runSQL($sql);
				$resp = 1;
			} else {
				$resp = -1; // erro: não é autor principal o trabalho
			}
		} else {
			$resp = -1; // erro: esta etapa não permite remover coautores
		}
	} else {
		$resp = -1; // erro: sessão expirou ou não existe !
	}
	
	echo $resp;
	exit;
}//removerCoautor

/*---------------------------------------------------------------*/
/*           Funcao que REMOVE ORIENTADORES do TRABALHO             */
/*---------------------------------------------------------------*/	
# Retorno: atualiza -> trabEdit.php #	
else if(isset($_POST["opcao"]) && $_POST["opcao"]=="removeOrientador") {
	$id_user = (int)$_SESSION["id_usuario"];

	if(isset($id_user)) {
		if(ETAPA_INSCRICAO_TRABALHO == 1 || ETAPA_CORRECAO_TRABALHO == 1) {
			$id_trab = (int)$_POST["id_trabalho"];
			$valida = validaAutor($id_user, $id_trab, $conexao);
			if($valida==1) {
				$id_orientador = (int)$_POST["id_orientador"];
				$sql = "DELETE FROM trabalho_orientador_campus
						WHERE fk_orientador = ".$id_orientador."
						AND fk_trabalho = ".$id_trab;
    
				$result = runSQL($sql);
				$resp = 1;
			} else {
				$resp = -1; // erro: não é autor principal o trabalho
			}
		} else {
			$resp = -1; // erro: esta etapa não permite remover orientadores
		}
	} else {
		$resp = -1; // erro: sessão expirou ou não existe !
	}
    echo $resp;
    exit;
}//removeOrientador

/*---------------------------------------------------------------*/
/*           Funcao que INSERE COAUTORES no TRABALHO             */
/*---------------------------------------------------------------*/	
# Retorno: atualiza -> trabEdit.php #	
else if(isset($_POST["opcao"]) && $_POST["opcao"]=="inserirCoautor") {
	$id_user = (int)$_SESSION["id_usuario"];
	// id do usuario existe:
	if(isset($id_user)) {
		if(ETAPA_INSCRICAO_TRABALHO == 1 || ETAPA_CORRECAO_TRABALHO == 1) {
			$id_trab = (int)$_POST["id_trabalho"];
			$valida = validaAutor($id_user, $id_trab, $conexao);
			// usuario e o autor principal do trabalho:
			if($valida==1) {
				$id_autor = (int)$_POST["id_coautor"];
				$id_curso = (int)$_POST["id_curso"];
			
				$sql = "SELECT *
						FROM autor
						WHERE fk_usuario = ".$id_autor;
				$result = runSQL($sql);
				$qnt = mysql_num_rows($result);
				// co-autor existe
				if($qnt == 1) {
					$sql1 = "SELECT * FROM trabalho_autor_curso WHERE fk_trabalho = ".$id_trab." AND fk_autor = ".$id_autor;
					$result1 = runSQL($sql1);
					//co-autor nao cadastrado neste trabalho
					if(mysql_num_rows($result1)==0){
						$sql2 = "SELECT * FROM trabalho_autor_curso WHERE fk_trabalho = ".$id_trab;
						$result2 = runSQL($sql2);
						$seqAutores = mysql_num_rows($result2);
						$seqAutores++;
	
						$sql3 = "SELECT email FROM usuario WHERE id_usuario=".$id_autor;
						$result3 = runSQL($sql3);
						$arr = mysql_fetch_array($result3);
						$email = $arr["email"];
	
						$sql4 = "INSERT INTO trabalho_autor_curso
								(fk_trabalho, fk_autor, fk_curso, seq, email_trabalho)
								VALUES
								(".$id_trab.", ".$id_autor.", ".$id_curso.", ".$seqAutores.", '".$email."')";
    
						$result4 = runSQL($sql4);
						$resp = 8;
					} else {
						$resp = -8; // erro: co-autor já está vinculado ao trabalho !
					}
				} else {
					$resp = -1; // erro: co-autor não existe !
				}
			} else {
				$resp = -1; // erro: não é autor principal do trabalho
			}
		} else {
			$resp = -1;  // erro: esta etapa não permite inserir co-autores
		}
	} else {
		$resp = -1; // erro: sessão expirou ou não existe !
	}
	echo $resp;
    exit;
}//inserirCoautor

/*---------------------------------------------------------------*/
/*           Funcao que INSERE ORIENTADORES no TRABALHO             */
/*---------------------------------------------------------------*/	
# Retorno: atualiza -> trabEdit.php #	
else if(isset($_POST["opcao"]) && $_POST["opcao"]=="inserirOrientador") {
	$id_user = (int)$_SESSION["id_usuario"];
    $resp = 0;
	// existe um usuario logado:
	if(isset($id_user)) {
		if(ETAPA_INSCRICAO_TRABALHO == 1 || ETAPA_CORRECAO_TRABALHO == 1) {
			$id_trab = (int)$_POST["id_trabalho"];
			$valida = validaAutor($id_user, $id_trab, $conexao);
			//user e autor principal:
			if($valida == 1) {
				$id_orientador = (int)$_POST["id_orientador"];
				$sql1 = "SELECT * FROM orientador WHERE fk_usuario=".$id_orientador;
				$result1 = runSQL($sql1);
				$qnt = mysql_num_rows($result1);
				//orientador existe:
				if($qnt==1) {
					$sql2 = "SELECT *
							FROM trabalho_orientador_campus
							WHERE fk_trabalho = ".$id_trab."
							AND fk_orientador = ".$id_orientador;
					$result2 = runSQL($sql2);
					//orientador ainda nao foi inserido no trabalho:
					if(mysql_num_rows($result2)==0){
						$id_campus = (int)$_POST["id_campus"];
						$sql3 = "SELECT * FROM trabalho_orientador_campus WHERE fk_trabalho = ".$id_trab;
						$result3 = runSQL($sql3);
						$seqOrients = mysql_num_rows($result3);
						$seqOrients++;
				
						$sql4 = "SELECT email FROM usuario WHERE id_usuario=".$id_orientador;
						$result4 = runSQL($sql4);
						$arr = mysql_fetch_array($result4);
						$email = $arr["email"];
					
						$sql5 = "INSERT INTO trabalho_orientador_campus
									(fk_trabalho, fk_orientador, fk_campus, seq, email_trabalho)
								VALUES
								(".$id_trab.", ".$id_orientador.", ".$id_campus.", ".$seqOrients.", '".$email."')";
						$result5 = runSQL($sql5);
					
						$resp = 8;
					} else {
						$resp = -8; // erro: orientador já está vinculado ao trabalho !
					}
				} else {
					$resp = -1; // erro: orientador não existe !
				}
			} else {
				$resp = -1; // erro: não é autor principal do trabalho
			}
		} else {
			$resp = -1; // erro: esta etapa não permite inserir orientadores
		}
	} else {
		$resp = -1; // erro: sessão expirou ou não existe !
	}
    echo $resp;
    exit;
}//inserirOrientador

/*---------------------------------------------------------------*/
/*                 Funcao que BUSCA COAUTORES                    */
/*---------------------------------------------------------------*/	
# Retorno: mostra -> trabEdit.php #	
else if(isset($_GET["opcao"]) && $_GET["opcao"]=="buscaCoautor") {
	
	$id_trab = (int)$_GET["id_trabalho"];
    $nome = strip_tags($_GET["nomeCoautor"]);
	$validaNome = count(str_split($nome));
	if($validaNome >= 4) {
		$nome = mysql_real_escape_string($nome); 
	
		$sql = "SELECT u.id_usuario, u.nome as nomeUsuario, ac.fk_curso, c.nome as nomeCurso, ca.nome as nomeCampus, ca.fk_instituicao, i.sigla
				FROM usuario u
				INNER JOIN autor_curso ac ON (ac.fk_autor = u.id_usuario) 
				INNER JOIN curso c ON (c.id_curso = ac.fk_curso) 
				INNER JOIN campus ca ON (ca.id_campus = c.fk_campus)
				INNER JOIN instituicao i ON (i.id_instituicao = ca.fk_instituicao)
				WHERE u.nome like '%".$nome."%'";
    
		$result = runSQL($sql);
	
		$conta = mysql_num_rows($result);
		if($conta != 0) {
			$str = '';
			while($arr = mysql_fetch_array($result)){
				$nomeUsuario = stripslashes($arr["nomeUsuario"]);
				$nomeCurso = stripslashes($arr["nomeCurso"]);
                $nomeCampus = stripslashes($arr["nomeCampus"]);
				$sigla = stripslashes($arr["sigla"]);
				$str .= '<tr>';
				$str .= '<td style="padding-right:10px;">'.$nomeUsuario.'</td><td style="padding-right:10px;">'.$nomeCurso.' ('.$sigla.' - '.$nomeCampus.')</td>';
				$str .= '<td style="padding-right:10px;"><a href="#" class="link1" style="margin-right:20px;text-decoration:underline;" onclick="inserirCoautor('.$arr["id_usuario"].', '.$id_trab.', '.$arr["fk_curso"].'); return false;">Adicionar co-autor</a></td>';
				$str .= '</tr>';
			}
		} else {
			$str = -11;
		}
    } else {
		$str = -9;
	}
	echo $str;
    exit;
}//buscaCoautor
	
/*---------------------------------------------------------------*/
/*                Funcao que BUSCA ORIENTADORES                  */
/*---------------------------------------------------------------*/	
# Retorno: mostra -> trabEdit.php #	
else if(isset($_GET["opcao"]) && $_GET["opcao"]=="buscaOrientador") {
	
	$id_trab = (int)$_GET["id_trabalho"];
    $nome = strip_tags($_GET["nomeOrientador"]);
	$validaNome = count(str_split($nome));
	if($validaNome >= 4) {
		$nome = mysql_real_escape_string($nome); 
	
		$sql = "SELECT u.id_usuario, u.nome, oc.fk_campus, ca.nome as nomeCampus, ca.fk_instituicao, i.sigla
				FROM usuario u
				INNER JOIN orientador_campus oc ON (oc.fk_orientador = u.id_usuario) 
				INNER JOIN campus ca ON (ca.id_campus = oc.fk_campus) 
				INNER JOIN instituicao i ON (i.id_instituicao = ca.fk_instituicao)
				WHERE u.nome like '%".$nome."%'";
    
		$result = runSQL($sql);
		$conta = mysql_num_rows($result);
		if($conta != 0) {
			$str = '';
			while($arr = mysql_fetch_array($result)){
				$nome = stripslashes($arr["nome"]);
				$nomeCampus = stripslashes($arr["nomeCampus"]);
				$sigla = stripslashes($arr["sigla"]);
				$str .= '<tr>';
				$str .= '<td style="padding-right:10px;"><label>- '.$nome.'</td><td style="padding-right:10px;">('.$sigla.' - '.$nomeCampus.')</td>';
				$str .= '<td style="padding-right:10px;"><a href="#" class="link1" style="margin-right:20px;text-decoration:underline;" onclick="inserirOrientador('.$arr["id_usuario"].', '.$id_trab.', '.$arr["fk_campus"].'); return false;">Adicionar Orientador</a></td>';
				$str .= '</tr>';
			}
		} else {
			$str = -11;
		}
	} else {
		$str = -9;
	}
    
	echo $str;
	exit;
}//buscaOrientador

/*-------------------------------------------------------------*/
/*             Funcao que SALVA TRABALHO do AUTOR              */
/*-------------------------------------------------------------*/	
# Retorno: salva dados do TRABALHO -> criarEeditarTrab.php #		
//Mudado nome de salvaTrabalho para inserirTrabalho
else if(isset($_POST["opcao"]) && $_POST["opcao"]=="inserirTrabalho") { 
	$id_user = (int)$_SESSION["id_usuario"];
	$resp = 0;
	if(isset($id_user)) {
        if(ETAPA_INSCRICAO_TRABALHO == 1) {
			//Verifica se o usuário é um autor.
			$valida = recNumRows ($id_user, "fk_usuario", "autor", $conexao);
			if($valida == 1) {
				$resumo = $_POST["cResumo"];
				$tam = valida_tamanho_resumo($resumo);
				if($tam == 1) {
					$resumo = mysql_real_escape_string($resumo);
					//$resumo = ($resumo);
					$tematica = (int)$_POST["tematica"];
					$categoria = (int)$_POST["categoria"];
					$modalidade = (int)$_POST["modalidade"];
					$titulo = mysql_real_escape_string($_POST["cTitulo"]);
                    //$titulo = ($_POST["cTitulo"]);
					$titulo_ordenar = strip_tags(html_entity_decode($titulo));
					$palavra1 = mysql_real_escape_string($_POST["palavra1"]);
					$palavra2 = mysql_real_escape_string($_POST["palavra2"]);
					$palavra3 = mysql_real_escape_string($_POST["palavra3"]);
					$apoiadores = mysql_real_escape_string($_POST["apoiadores"]);
					$status = STATUS_TRAB_PENDENTE;
					$sqlNivel = "SELECT nivel FROM curso WHERE id_curso=".$_POST["f_curso"];
					$resultNivel = runSQL($sqlNivel);
					$arrNivel = mysql_fetch_array($resultNivel);
					$nivel = $arrNivel["nivel"];
					if (valida_modalidade_trabalho_autor($id_user, "", $modalidade, $conexao) == 0) {
						$sqlTrab = "INSERT INTO trabalho 
								(fk_tematica, fk_categoria, fk_modalidade, nivel, titulo, titulo_ordenar, palavra1, palavra2, palavra3,
								apoiadores, data_cadastro, ip_cadastro, resumo, status)
								VALUES
								(".$tematica.", ".$categoria.", ".$modalidade.", ".$nivel.", '".$titulo."', '".$titulo_ordenar."', 
								'".$palavra1."', '".$palavra2."', '".$palavra3."', '".$apoiadores."', sysdate(),
								'".$_SERVER['REMOTE_ADDR']."', '".$resumo."', ".$status.")";
				 
                                                //echo ($sqlTrab);
                                                //die();
                                                $result = runSQL($sqlTrab);
			
						$id = mysql_insert_id();
						$id_curso = (int)$_POST["f_curso"];
						$email = mysql_real_escape_string($_POST["email"]);
	
						$sqlAutor = "INSERT INTO trabalho_autor_curso
								(fk_trabalho, fk_autor, fk_curso, seq, email_trabalho)
								VALUES
								(".$id.", ".$id_user.", ".$id_curso.", 1, '".$email."')";
        
						$resultAutor = runSQL($sqlAutor);

						// envio do email
						$sHeader = "From: mostra@poa.ifrs.edu.br\n";
	 					$sHeader .= "Bcc: mostratec@poa.ifrs.edu.br\n";
    					$sTo = $email;
    					$sSubject = "Mostra de Pesquisa, Ensino e Extensão - IFRS - Porto Alegre";
	  
    					$sBody = "";
    					$sBody .= "Você cadastrou um trabalho no sistema de inscrição da 13ª Mostra de Pesquisa, Ensino e Extensão do IFRS Câmpus Porto Alegre.\n\n";
	  
    					$sBody .= "Código do Trabalho: ".$id."\n";
    					$sBody .= "Título do trabalho: ".$titulo."\n\n";
	  
    					$sBody .= "O seu trabalho encontra-se com estado PENDENTE. Nessa situação você ainda pode efetuar modificações no trabalho. Para completar o processo de inscrição você deverá entrar no sistema e efetuar o envio do trabalho (observar data limite para inscrição de trabalhos, conforme cronograma). Após o envio, não haverá possibilidades de modificações no trabalho.\n\n";
	  
    					$sBody .= "Sistema de Inscrição da 13ª Mostra de Pesquisa, Ensino e Extensão\n";
    					$sBody .= "IFRS - Câmpus Porto Alegre\n";
    					$sBody .= "http://mostra.poa.ifrs.edu.br/2012/sistema/index.php\n";

    					if (CONST_TIPO_VERSAO == "PRODUCAO")
    					$Envio = mail ($sTo, $sSubject, $sBody, $sHeader) ;

    					$resp = 1;
    				} else {
						$resp = -3; //Erro na validacao da modalidade.
					}
				} else {
					//$resp = -9; //Mais de 3000 caracteres no resumo.
					$resp = $tam;
				}
			} else {
				$resp = -1; // erro: não é autor
			} 
		} else {
			$resp = -1; // erro: etapa não permite inserir trabalho.
		}
	} else {
		$resp = -2; // erro: sessão expirou ou não existe
	}
	echo $resp;
	exit;
}//inserirTrabalho

/*-------------------------------------------------------------*/
/*             Funcao que ATUALIZA dados do TRABALHO           */
/*-------------------------------------------------------------*/	
# Retorno: atualiza dados do trabalho -> criarEeditarTrab.php #
else if(isset($_POST["opcao"]) && $_POST["opcao"]=="atualizarTrabalho") { 
	$id_user = (int)$_SESSION["id_usuario"];
	$resp = 0;
	if(isset($id_user)) {
		if(ETAPA_INSCRICAO_TRABALHO == 1 || ETAPA_CORRECAO_TRABALHO == 1) {
			$id_trab = (int)$_POST["id_trabalho"];
			$valida = validaAutor($id_user, $id_trab, $conexao);
			if($valida==1) {
                $resumo = $_POST["cResumo"];
				$tam = valida_tamanho_resumo($resumo);
				if($tam == 1) {
                    $resumo = mysql_real_escape_string($resumo);
					$tematica = (int)$_POST["tematica"];
					$categoria = (int)$_POST["categoria"];
					$modalidade = (int)$_POST["modalidade"];
                    $titulo = mysql_real_escape_string($_POST["cTitulo"]);
					//$titulo = ($_POST["cTitulo"]);
					$titulo_ordenar = strip_tags(html_entity_decode($titulo));
					$palavra1 = mysql_real_escape_string($_POST["palavra1"]);
					$palavra2 = mysql_real_escape_string($_POST["palavra2"]);
					$palavra3 = mysql_real_escape_string($_POST["palavra3"]);
					$apoiadores = mysql_real_escape_string($_POST["apoiadores"]);
	
					if (valida_modalidade_trabalho_autor($id_user, $id_trab, $modalidade, $conexao) == 0) {
						$sqlUpdate = "UPDATE trabalho
										SET 
											fk_tematica = ".$tematica.",
											fk_categoria = ".$categoria.",
											fk_modalidade = ".$modalidade.",
											titulo = '".$titulo."',
											titulo_ordenar = '".$titulo_ordenar."',
											palavra1 = '".$palavra1."',
											palavra2 = '".$palavra2."',
											palavra3 = '".$palavra3."',
											apoiadores = '".$apoiadores."',
											data_atualizacao = sysdate(),
											ip_atualizacao = '".$_SERVER['REMOTE_ADDR']."',
											resumo = '".$resumo."'
										WHERE id_trabalho=".$id_trab;

						$result = runSQL($sqlUpdate);
						$email = mysql_real_escape_string($_POST["email"]);
						$sqlEmail = "UPDATE trabalho_autor_curso
										SET email_trabalho = '".$email."'
									WHERE fk_autor = ".$id_user."
										AND fk_trabalho = ".$id_trab;
						$result2 = runSQL($sqlEmail);
						$resp = 1;
							/* if(mysql_affected_rows()>0){
									$str = 1;
							} else {
								$str = -1;
							} */
					} else {
						$resp = -3; //Erro na validacao da modalidade.
					}                        
				} else {
					//$resp = -9; //Mais de 3000 caracteres no resumo.
					$resp = $tam;
				}
			} else {
				$resp = -1; // erro: não é autor principal do trabalho
			}
		} else {
			$resp = -1; // erro: etapa não permite atualização do trabalho !
		}
	} else {
		$resp = -2; // erro: sessão expirou ou não existe !
	}
	echo $resp;
	exit;		
}//atualizarTrabalho

/*-------------------------------------------------------------*/
/*             Funcao que RECUPERA dados do TRABALHO           */
/*-------------------------------------------------------------*/	
# Retorno: recupera dados do trabalho -> criarEeditarTrab.php #		
else if(isset($_POST["opcao"]) && $_POST["opcao"]=="getDadosTrabalho") {
	$id_user = (int)$_SESSION["id_usuario"];
	
	if(isset($id_user)) {
		$id_trab = (int)$_POST["id_trabalho"];
		$valida = validaAutor($id_user, $id_trab, $conexao);
		if($valida==1) {
			$sql = "SELECT t.titulo, t.resumo, t.palavra1, t.palavra2, t.palavra3, t.fk_tematica, t.fk_categoria, t.fk_modalidade, t.apoiadores, tac.email_trabalho, tac.fk_curso
					FROM trabalho t
					INNER JOIN trabalho_autor_curso tac ON (tac.fk_trabalho = t.id_trabalho AND tac.seq = 1)
					 WHERE t.id_trabalho = ".$id_trab;
			$result = runSQL($sql);

			$str = array();
			while($arr = mysql_fetch_array($result)){
				$str["titulo"] = ($arr["titulo"]);
				$str["resumo"] = ($arr["resumo"]);
				$str["palavra1"] = stripslashes($arr["palavra1"]);
				$str["palavra2"] = stripslashes($arr["palavra2"]);
				$str["palavra3"] = stripslashes($arr["palavra3"]);
				$str["tematica"] = $arr["fk_tematica"];
				$str["categoria"] = $arr["fk_categoria"];
				$str["modalidade"] = $arr["fk_modalidade"];
				$str["apoiadores"] = stripslashes($arr["apoiadores"]);
				$str["email"] = stripslashes($arr["email_trabalho"]);
				$str["fk_curso"] = $arr["fk_curso"];
			}
		} else 
			$str = -1;
	} else { 
		$str = -1;
	}
	echo json_encode($str);	
    exit;
}//getDadosTrabalho

/*-------------------------------------------------------------*/
/*                 Funcao que MOSTRA TRABALHO                 */
/*-------------------------------------------------------------*/	
# Retorno: mostra trabalho -> trabalho.php #
else if(isset($_GET["opcao"]) && $_GET["opcao"]=="verTrabalho") {
   $id_trab = (int)$_GET["id_trabalho"];
   $valida = 0;
   $validaAdmin = 0;
	if(isset($_SESSION["id_usuario"])) {
		$id_user = (int)$_SESSION["id_usuario"];
		$valida = validaUserTrab($id_user, $id_trab, $conexao);
	}
	else if(isset($_SESSION["id_administracao"])) {
		$adm = (int)$_SESSION["id_administracao"];
		$validaAdmin = testa_adm($adm,$conexao);
		}
	if(isset($id_user) || isset($adm)) {
		if($valida == 1 || $validaAdmin == 1) {
                        /* verificar o motivo deste SQL com case ja que a informacao pode ser guardada diretamente no banco*/
			$sqlTrabalho = "SELECT t.*, a.nome as nome_area,  
						CASE fk_categoria
							WHEN 1 THEN 'Relato de Experiência'
							WHEN 2 THEN 'Relato de Pesquisa'
							WHEN 3 THEN 'Revisão de Literatura/Ensaio'
							ELSE ''
							END as nome_categoria,
						CASE fk_modalidade
							WHEN 1 THEN 'Apresentação Oral'
							WHEN 2 THEN 'Apresentação de Pôster'
							ELSE ''
							END as nome_modalidade
					FROM trabalho t
					INNER JOIN tematica a ON (a.id_area = t.fk_tematica)
					WHERE id_trabalho=".$id_trab;
			$sqlAutores = "SELECT tac.fk_autor, tac.seq, tac.email_trabalho, u.id_usuario, u.nome, u.email, c.nome as nome_curso, ca.nome as nome_campus, i.sigla,
							CASE tac.seq 
									WHEN 1 THEN 'Autor(a)'
									ELSE 'Co-autor(a)' 
							END as tipoAutor
							FROM trabalho_autor_curso tac
                            INNER JOIN autor_curso ac ON (ac.fk_curso = tac.fk_curso AND ac.fk_autor = tac.fk_autor)
							INNER JOIN usuario u ON (u.id_usuario = tac.fk_autor)
                            INNER JOIN curso c ON c.id_curso = ac.fk_curso
                            INNER JOIN campus ca ON ca.id_campus = c.fk_campus
                            INNER JOIN instituicao i ON i.id_instituicao = ca.fk_instituicao
							WHERE tac.fk_trabalho = '".$id_trab."' 
							ORDER BY tac.seq ASC";
			$sqlOrientadores = "SELECT toc.fk_orientador, toc.seq, u.id_usuario, u.nome, u.email, ca.nome as nome_campus, i.sigla
								FROM trabalho_orientador_campus toc
                                INNER JOIN orientador_campus oc ON (oc.fk_orientador=toc.fk_orientador AND oc.fk_campus=toc.fk_campus)
								INNER JOIN usuario u ON (u.id_usuario = toc.fk_orientador) 
                                INNER JOIN campus ca ON ca.id_campus = toc.fk_campus
                                INNER JOIN instituicao i ON i.id_instituicao = ca.fk_instituicao
								WHERE toc.fk_trabalho = '".$id_trab."' 
								ORDER BY toc.seq ASC";
	
			$resultTrab = runSQL($sqlTrabalho);
			$resultAut = runSQL($sqlAutores);	
			$resultOrien = runSQL($sqlOrientadores);
				
			$linha_trab = mysql_fetch_array($resultTrab);
			$titulo = ($linha_trab["titulo"]);
			$resumo = ($linha_trab["resumo"]);
			$palavra1 = stripslashes($linha_trab["palavra1"]);
			$palavra2 = stripslashes($linha_trab["palavra2"]);
			$palavra3 = stripslashes($linha_trab["palavra3"]);
			$apoiadores = stripslashes($linha_trab["apoiadores"]);
	
			$str = '<h3 align="center" style="height:30px;margin-top:15px;">Trabalho: </h3>';
			
            // mostra ID:
			$str .= '<div style="background-color:#CCDAB4;width:97%;height:18px;padding-top:5px;padding-left:10px;"><label style="font-weight:bold;"> ID: </label>'.$id_trab.'</div>';
			$str .= '<div style="padding-left:10px;padding-top:5px;"> </div>';
            
            // mostra titulo:
			$str .= '<div style="background-color:#CCDAB4;width:97%;height:18px;padding-top:5px;padding-left:10px;"><label style="font-weight:bold;"> Título: </label></div>';
			
            //$str .= '<div style="padding-left:10px;height:30px;padding-top:5px;"> '.$titulo.' </div>';
            
            $str .= '<div style="padding-left:10px;padding-top:5px;"> '.$titulo.' </div>';
            
			// mostra resumo:
			$str .= '<div style="background-color:#CCDAB4;width:97%;height:18px;padding-top:5px;padding-left:10px;"><label style="font-weight:bold;"> Resumo: </label></div>';
			
            //$str .= '<div style="padding-left:10px;height:60px;padding-top:5px;width:95%;overflow:auto;"> '.$resumo.' </div>';
            
            $str .= '<div style="padding-left:10px;padding-top:5px;width:95%;overflow:auto;"> '.$resumo.' </div>';
            
			// mostra palavras-chave:
			$str .= '<div style="background-color:#CCDAB4;width:97%;height:18px;padding-top:5px;padding-left:10px;"><label style="font-weight:bold;"> Palavras-chave: </label></div>';
			$str .= '<div style="padding-left:10px;height:20px;padding-top:5px;"> Palavra 1: '.$palavra1.' </div>';
			$str .= '<div style="padding-left:10px;height:20px;padding-top:5px;"> Palavra 2: '.$palavra2.' </div>';
			$str .= '<div style="padding-left:10px;height:20px;padding-top:5px;"> Palavra 3: '.$palavra3.' </div>';
			// mostra area:
			$str .= '<div style="background-color:#CCDAB4;width:97%;height:18px;padding-top:5px;padding-left:10px;"><label style="font-weight:bold;"> Temática: </label></div>';
			$str .= '<div style="padding-left:10px;height:20px;padding-top:5px;"> '.$linha_trab["nome_area"].' </div>';
			// mostra categoria:
			$str .= '<div style="background-color:#CCDAB4;width:97%;height:18px;padding-top:5px;padding-left:10px;"><label style="font-weight:bold;"> Categoria: </label></div>';
			$str .= '<div style="padding-left:10px;height:20px;padding-top:5px;"> '.$linha_trab["nome_categoria"].' </div>';
			// mostra modalidade:
			$str .= '<div style="background-color:#CCDAB4;width:97%;height:18px;padding-top:5px;padding-left:10px;"><label style="font-weight:bold;"> Modalidade de Apresentação: </label></div>';
			$str .= '<div style="padding-left:10px;height:20px;padding-top:5px;"> '.$linha_trab["nome_modalidade"].' </div>';
			// mostra apoiadores:
			$str .= '<div style="background-color:#CCDAB4;width:97%;height:18px;padding-top:5px;padding-left:10px;"><label style="font-weight:bold;"> Apoiadores: </label></div>';
			$str .= '<div style="padding-left:10px;height:30px;padding-top:5px;"> '.$apoiadores.' </div>';
			//mostra autores:
			$str .= '<div style="background-color:#CCDAB4;width:97%;height:18px;padding-top:5px;padding-left:10px;"><label style="font-weight:bold;"> Autor(es): </label></div>';
			$str .= '<table style="border:none;"><tr style="height:20px;background-color:#CCDAB4;padding-top:5px;"><td >ID</td><td>Nome</td><td>E-mail</td><td>Curso/Campus/Instituição</td><td></td> </tr>';
			while($rowAut = mysql_fetch_array($resultAut)) {
				$idAut = stripslashes($rowAut["id_usuario"]);
                $nomeAut = stripslashes($rowAut["nome"]);
				$emailAut = stripslashes($rowAut["email_trabalho"]);
                $cur_camp_inst = $rowAut["nome_curso"]." / ".$rowAut["nome_campus"]." / ".$rowAut["sigla"];
				$str .= '<tr width="900" style="padding-top:5px;height:20px;"><td>'.$idAut.'</td><td>'.$nomeAut.'</td><td>'.$emailAut.'</td><td>'.$cur_camp_inst.'</td><td>'.$rowAut["tipoAutor"].'</td></tr>';
			}
			$str .= '</table>';
			// mostra orientadores:
			$str .= '<div style="background-color:#CCDAB4;width:97%;height:18px;padding-top:5px;padding-left:10px;"><label style="font-weight:bold;"> Orientador(es): </label></div>';
			$str .= '<table style="border:none;"><tr style="height:20px;background-color:#CCDAB4;"><td>ID</td><td>Nome</td><td>E-mail</td><td>Campus/Instituição</td></tr>';
			while($rowOr = mysql_fetch_array($resultOrien)) {
				$idOrient = stripslashes($rowOr["id_usuario"]);
                $nomeOrient = stripslashes($rowOr["nome"]);
				$emailOrient = stripslashes($rowOr["email"]);
                $camp_inst = $rowOr["nome_campus"]." / ".$rowOr["sigla"];
				$str .= '<tr><td>'.$idOrient.'</td><td>'.$nomeOrient.'</td><td>'.$emailOrient.'</td><td>'.$camp_inst.'</td></tr>';
			}
			$str .= '</table>';
			// mostra status
			/*
			if (ETAPA_ANALISE_TRABALHO == 1){
			  $status = STATUS_TRAB_ENVIADO;
			}
			else {
			  $status = $linha_trab["status"];
			}
			*/
			        $status = $linha_trab["status"];
	                if (ETAPA_INSCRICAO_TRABALHO == 1){ 
					    if ( ($status == STATUS_TRAB_PENDENTE) || ($status == STATUS_TRAB_ENVIADO) )
					        $status_mostrar = $arr_status_trab_completo[$status];
					    else
						    $status_mostrar = "Em análise";
					}
					else if (ETAPA_CORRECAO_TRABALHO == 1)
					        $status_mostrar = $arr_status_trab_completo[$status];
				    else
						    $status_mostrar = "Em análise";
			
			$str .= '<div style="background-color:#CCDAB4;width:97%;height:18px;padding-top:5px;padding-left:10px;"><label style="font-weight:bold;"> Status do Trabalho: </label></div>';    
			
			//$str .= '<div style="padding-left:10px;height:30px;padding-top:5px;"> '.$arr_status_trab_completo[$status].' </div>'; 

			$str .= '<div style="padding-left:10px;height:30px;padding-top:5px;"> '.$status_mostrar.' </div>'; 

			//Se for um autor/co-autor.
			if ($valida == 1)
			   $validaAutor = validaAutor($id_user, $id_trab, $conexao);
			else
               $validaAutor = 0;			
			   
            // LINK: Mostrar PDF
			$str .= '<p><a href="imprimir_trabalho.php?id_trabalho='.$id_trab.'" class="link1" style="margin-left:20px;font-size:10px;text-decoration:underline;height:30px;padding-bottom:15px;">Visualizar PDF ...</a></p>';
        
			//Se for o dono do trabalho habilita EDITAR e ENVIAR
			if ($validaAutor == 1)  {
				if (($linha_trab["status"]==STATUS_TRAB_PENDENTE && ETAPA_INSCRICAO_TRABALHO == 1) || ($linha_trab["status"]==STATUS_TRAB_CORRIGIR && ETAPA_CORRECAO_TRABALHO == 1)) {
					$str .= '<p><a href="trabalho.php?action=edit&id_trab='.$id_trab.'" class="link1" style="margin-left:20px;font-size:10px;text-decoration:underline;height:30px;padding-bottom:15px;">Editar Trabalho ... </a> (modificar dados do trabalho, autores, orientadores...)</p>';
					$str .= '<p><a href="#" onclick=enviarTrabalho('.$id_trab.') class="link1" style="margin-left:20px;font-size:10px;text-decoration:underline;height:30px;padding-bottom:15px;">Enviar Trabalho</a> - ATENÇÃO: Após enviar o trabalho não haverá possibilidade de modificações.</p>';
				}
			}
			
			//LINK: VOLTAR
			if(isset($_SESSION["id_usuario"])) {
				$str .= '<p><a href="home.php?area=Autor" class="link1" style="margin-left:20px;font-size:10px;text-decoration:underline;height:30px;padding-bottom:15px;">Voltar</a></p>';
			} else if(isset($_SESSION["id_administracao"])){
				$str .= '<a href="adm/adm_trabalhos.php" class="link1" style="margin-left:20px;font-size:10px;text-decoration:underline;height:30px;padding-bottom:15px;">Voltar</a>';
			}
			$fim_mostratec = 0;
			if(ETAPA_INSCRICAO_TRABALHO == 0 && ETAPA_ANALISE_TRABALHO == 0 && ETAPA_CORRECAO_TRABALHO == 0 && ETAPA_ANALISE_FINAL_TRABALHO == 0)
				$fim_mostratec = 1;
			if((ETAPA_CORRECAO_TRABALHO == 1 && $status != 0 && $status != 1 && $status != 4) || $fim_mostratec == 1) {
				$str .= '<fieldset id="mostraCorrecao" style="background-color:#CCDAB4;margin-top:30px;"><h3>Resultado da Avaliação do Trabalho</h3><br></fieldset>';
			}
		} else {
			$str = "Error:";
		 }
	} else {
		$str = "Error.";
	}
	echo $str;
	exit;	
}

/*-------------------------------------------------------------*/
/*                  Funcao que DELETA TRABALHO                 */
/*-------------------------------------------------------------*/	
# Retorno: deleta trabalho -> home_areaAutor.php #
else if(isset($_POST["opcao"]) && $_POST["opcao"]=="removerTrabalho") {
	$id_user = (int)$_SESSION["id_usuario"];
	
	if(isset($id_user)) {
		if(ETAPA_INSCRICAO_TRABALHO == 1 || ETAPA_CORRECAO_TRABALHO == 1) {
			$id_trab = (int)$_POST["id_trabalho"];
			$valida = validaAutor($id_user, $id_trab, $conexao);
			if($valida==1){
				$sqlRemove1 = "DELETE FROM trabalho_orientador_campus WHERE fk_trabalho = ".$id_trab;
				$sqlRemove2 = "DELETE FROM trabalho_autor_curso WHERE fk_trabalho = ".$id_trab;
				$sqlRemove3 = "DELETE FROM trabalho WHERE id_trabalho = ".$id_trab;

				$result1 = runSQL($sqlRemove1);
				$result2 = runSQL($sqlRemove2);
				$result3 = runSQL($sqlRemove3);
			
				$str = 1;
			} else { 
				$str = -1; // erro: não é autor principal
			}
		} else {
			$str = -1; // erro: etapa não permite remover trabalho
		}
	} else {
		$str = -1; // erro: sessão expirou ou não existe !
	}
	echo $str;
	exit;
}//removerTrabalho

/*-------------------------------------------------------------*/
/*              Funcao que MUDA status do TRABALHO             */
/*-------------------------------------------------------------*/	
# Retorno: PENDENTE para ENVIADO ou CORRIGIR para CORRIGIDO (enviarTrabalho) #		
else if(isset($_GET["opcao"]) && $_GET["opcao"]=="enviarTrabalho") {
	$id_usuario = (int)$_SESSION["id_usuario"];
	$id_trab = (int)$_GET["id_trabalho"];

    // se é autor principal do trabalho:    
    //$valida = validaAutor($id_usuario, $id_trab, $conexao);
    $valida = valida_trabalho($id_usuario, $id_trab, $conexao);
	if ($valida == 1) {
        $status = get_status_trabalho($id_trab, $conexao);
        if ($status == STATUS_TRAB_PENDENTE) {
            $altera = muda_status_trabalho($id_trab, STATUS_TRAB_ENVIADO, $conexao);
            if ($altera == 1) {
                //header("Location: trabalho.php?action=view&id_trab=".$id_trab);
                echo "1"; //Ok 
            }
        }
        else if ($status == STATUS_TRAB_CORRIGIR) {
            $altera = muda_status_trabalho($id_trab, STATUS_TRAB_CORRIGIDO, $conexao);
            if ($altera == 1) {
                //header("Location: trabalho.php?action=view&id_trab=".$id_trab);
                echo "1"; //Ok 
            }
        }
    }
    else {
        echo $valida;
    }
    
}

/*-------------------------------------------------------------*/
/* Funcao que MARCA trabalho como ACEITO, RECUSADO ou CORRIGIR */
/*                - Comissão Organizadora -                    */
/*-------------------------------------------------------------*/
else if(isset($_GET["opcao"]) && ($_GET["opcao"]=="corrigirTrabalho" || $_GET["opcao"]=="aceitarTrabalho" || $_GET["opcao"]=="recusarTrabalho")) {	
	$opcao = $_GET["opcao"];
    if ($opcao=="corrigirTrabalho")
        $status = STATUS_TRAB_CORRIGIR;
    else if ($opcao=="aceitarTrabalho")
        $status = STATUS_TRAB_ACEITO;
    else if ($opcao=="recusarTrabalho")
        $status = STATUS_TRAB_RECUSADO;
    else
        exit; // Erro:: nenhuma opcao válida    
    $id_trab = $_GET["id_trabalho"];
    $id_usuario = $_SESSION["id_usuario"];
    $result = testa_usuario_adm($id_usuario, $conexao);
    if ($result == 1) {
        $result = muda_status_trabalho($id_trab, $status, $conexao);
        if ($result == 1)
          header("Location: trabalho.php?action=view&id_trab=".$id_trab);
		  exit; //ok
    }
}

?>