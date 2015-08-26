<?php
session_start();

include("../../conexao.php");
include("../../funcoes.php");
include("../constantes.php");
include("constantes_adm.php");

##############################################################################################################################
if (isset($_POST["option"]) && ($_POST["option"] == "cadastraAdministrador")) {
  $usuario = mysql_real_escape_string($_POST["usuario"]);
  $senha = mysql_real_escape_string($_POST["senha"]);
  $Rsenha = mysql_real_escape_string($_POST["rsenha"]);
  $senha = md5($senha);
  $nivel = (int) $_POST["nivel"];
  $ans = 0;

  if ($ans == 0) {
    $sql = "INSERT INTO adm2 (nivel, usuario, senha) VALUES (" . $nivel . ", '" . $usuario . "', '" . $senha . "')";
    $query = runSQL($sql);

    if ($query == false)
      $ans = -1;
    else
      $ans = 1;
  }

  echo $ans;
  exit;
}

##############################################################################################################################
else if (isset($_POST["option"]) && ($_POST["option"] == "editarCadastro")) {
  $id_adm = (int) $_POST["id_admin"];

  $sql = "SELECT usuario, nivel FROM adm2 WHERE id_administrador =" . $id_adm;
  $query = runSQL($sql);
  $linha = mysql_fetch_array($query);
  $dados = "dados={usuario:'" . $linha["usuario"] . "', nivel:" . $linha["nivel"] . "}";

  echo $dados;
  exit;
}

##############################################################################################################################
else if (isset($_POST["option"]) && ($_POST["option"] == "atualizarCadastro")) {
  $id_adm = (int) $_SESSION["id_administracao"];
  $usuario = $_POST["usuario"];
  $senha = $_POST["senha"];
  $nivel = $_POST["nivel"];
  $_SESSION["usuario"] = $usuario;
  if ($senha == "") {
    $sql = "UPDATE adm2 
				SET usuario = '" . $usuario . "', nivel = " . $nivel . "
				WHERE id_administrador =" . $id_adm;
  } else {
    $senha = md5($senha);
    $sql = "UPDATE adm2 
				SET usuario = '" . $usuario . "', senha = '" . $senha . "', nivel = " . $nivel . "
				WHERE id_administrador =" . $id_adm;
  }

  $query = runSQL($sql);

  echo 1;
  exit;
}

##############################################################################################################################
else if (isset($_GET["option"]) && ($_GET["option"] == "getListaAutores")) {
  $sqlAutores = "SELECT u.id_usuario, u.nome as nome_usuario, u.email, c.nome as nome_curso, ca.nome as nome_campus, i.sigla FROM usuario u " .
          "INNER JOIN autor a ON a.fk_usuario = u.id_usuario " .
          "INNER JOIN autor_curso ac ON ac.fk_autor = a.fk_usuario " .
          "INNER JOIN curso c ON c.id_curso = ac.fk_curso " .
          "INNER JOIN campus ca ON ca.id_campus = c.fk_campus " .
          "INNER JOIN instituicao i ON i.id_instituicao = ca.fk_instituicao " .
          "WHERE ac.seq=1 " .
          "ORDER BY u.id_usuario ";
  $queryAutores = runSQL($sqlAutores);
  $str = '';
  while ($row = mysql_fetch_array($queryAutores)) {
    $str .= '<tr valign="top"><td>' . $row["id_usuario"] . "</td>" .
            "<td>" . $row["nome_usuario"] . "</td>" .
            "<td>" . $row["email"] . "</td>" .
            "<td>" . $row["nome_curso"] . "</td>" .
            "<td>" . $row["nome_campus"] . "</td>" .
            "<td>" . $row["sigla"] . "</td></tr>"; // onmouseover="mudaCorFundo(this)" onmouseout="voltaCorFundo(this)"
  } // onclick="detalhesUser('.$row["id_usuario"].')"

  echo $str;
  exit;
}

##############################################################################################################################
else if (isset($_GET["option"]) && ($_GET["option"] == "getListaOrientadores")) {
  $sqlOrientadores = "SELECT u.id_usuario, u.nome, u.email, cam.nome as nome_campus, i.sigla FROM usuario u " .
          "INNER JOIN orientador o ON (u.id_usuario = o.fk_usuario) " .
          "INNER JOIN orientador_campus oc ON oc.fk_orientador = o.fk_usuario " .
          "INNER JOIN campus cam ON cam.id_campus = oc.fk_campus " .
          "INNER JOIN instituicao i ON i.id_instituicao=cam.fk_instituicao";
  $queryOrientadores = runSQL($sqlOrientadores);
  $str = '';
  while ($row = mysql_fetch_array($queryOrientadores)) {
    $str .= "<tr><td>" . $row["id_usuario"] .
            "</td><td>" . $row["nome"] .
            "</td><td>" . $row["email"] .
            "</td><td>" . $row["nome_campus"] .
            "</td><td>" . $row["sigla"] .
            "</td></tr>";
  }

  echo $str;
  exit;
}

##############################################################################################################################
else if (isset($_GET["option"]) && ($_GET["option"] == "getListaAvaliadores")) {
  if (isset($_GET["ordem"]))
    $ordem = $_GET["ordem"];
  else
    $ordem = 5;
  $str = '';

  $sqlAvaliadores = "SELECT u.*, a.*, c.nome as nomeCampus, i.sigla, 
						CASE a.status
							WHEN 0 THEN 'P'
							WHEN 1 THEN 'A'
							WHEN 2 THEN 'R'
							ELSE '' 
							END as statusAvaliador
						FROM avaliador a 
						INNER JOIN usuario u ON (u.id_usuario = a.fk_usuario)
						INNER JOIN campus c ON (c.id_campus = a.fk_campus)
						INNER JOIN instituicao i ON (i.id_instituicao = c.fk_instituicao) ";

  if ($ordem == 1)
    $sqlAvaliadores .= "ORDER BY u.id_usuario ASC ";
  else if ($ordem == 2)
    $sqlAvaliadores .= "ORDER BY upper(u.nome) ASC, u.id_usuario ASC ";
  else if ($ordem == 3)
    $sqlAvaliadores .= "ORDER BY upper(u.email) ASC, u.id_usuario ASC ";
  else if ($ordem == 4)
    $sqlAvaliadores .= "ORDER BY c.nome ASC, u.id_usuario ASC ";
  else if ($ordem == 5)
    $sqlAvaliadores .= "ORDER BY i.sigla ASC, c.nome ASC";
  else if ($ordem == 6)
    $sqlAvaliadores .= "ORDER BY a.status ASC ";
  else
    $sqlAvaliadores .= "ORDER BY u.id_usuario ASC ";


  $queryAvaliadores = runSQL($sqlAvaliadores);

  while ($row = mysql_fetch_array($queryAvaliadores)) {
    if ($row["statusAvaliador"] == "A")
      $str .= '<tr><td><input type="checkbox" class="check" name="aceita[]" value="' . $row["fk_usuario"] . '" checked="true"></td>';
    else
      $str .= '<tr><td><input type="checkbox"  class="check" name="aceita[]" value="' . $row["fk_usuario"] . '"></td>';
    $str .= "<td>" . $row["fk_usuario"] . "</td><td onclick='detalha_avaliador(" . $row['fk_usuario'] . ");'>" . $row["nome"] . "</td><td>" . $row["email"] . "</td>";
    //$str .= "<td>".$row["nomeCampus"]."</td>";
    $str .= "<td>" . $row["sigla"] . "/" . $row["nomeCampus"] . "</td>";
    $str .= "<td>" . $row["statusAvaliador"] . "</td>";
    $str .= '<td><a href="#" class="button blue" onclick="aceitaAvaliador(' . $row["fk_usuario"] . ');" style="margin-left:20px;font-size:10px;">Ac.</a></td>';
    $str .= "<td><a href=\"#\" class=\"button red\" onclick=\"recusaAvaliador(" . $row["fk_usuario"] . ");\" style=\"margin-left:20px;font-size:10px;\">Rec.</a></td>";

    $str .= "<td>";
    $sqlAreas = "SELECT aa.fk_area FROM avaliador_area aa WHERE fk_avaliador=" . $row["fk_usuario"] . " ORDER BY aa.fk_area";
    $queryAreas = runSQL($sqlAreas);
    while ($rowArea = mysql_fetch_array($queryAreas)) {
      $str .= $rowArea["fk_area"] . ", ";
    }
    $str .= "</td>";

    $str .= "<td>";
    $sqlSessoes = "SELECT avs.fk_sessao FROM avaliador_sessao avs WHERE avs.fk_avaliador=" . $row["fk_usuario"] . " ORDER BY avs.fk_sessao";
    $querySessoes = runSQL($sqlSessoes);
    while ($rowSessao = mysql_fetch_array($querySessoes)) {
      $str .= $rowSessao["fk_sessao"] . ", ";
    }

    $str .= "</td>/tr>";
  }

  //Total de avaliadores.
  $sql = "SELECT CASE a.status
							WHEN 0 THEN 'Pendente'
							WHEN 1 THEN 'Aceito'
							WHEN 2 THEN 'Recusado'
							ELSE 'x' 
							END as statusAvaliador, COUNT(*) as quant FROM avaliador a GROUP BY a.status";
  $query = runSQL($sql);
  $str .= "<tr><td colspan=9 style='background-color:#CCDAB4;'> TOTAL DE AVALIADORES</td></tr>";
  $str .= "<tr style='background:#FFFFFF;'><td colspan=9>";
  while ($row = mysql_fetch_array($query)) {
    $str .= $row["statusAvaliador"] . " = " . $row["quant"] . "<br>";
  }
  $str .= "</td></tr>";

  //Contabiliza total por área (somente avaliadores aceitos):
  $str .= "<tr><td colspan=9 style='background-color:#CCDAB4;'> TOTALIZAÇÃO ÁREAS (somente avaliadores Aceitos)</td></tr>";
  $sqlAreas = "SELECT a.id_area, a.nome, count(*) AS quant FROM area a 
    INNER JOIN avaliador_area aa ON a.id_area = aa.fk_area 
    INNER JOIN avaliador av ON av.fk_usuario = aa.fk_avaliador
    WHERE av.status = 1 GROUP BY a.id_area ORDER BY a.id_area";
  $queryAreas = runSQL($sqlAreas);
  $str .= "<tr style='background:#FFFFFF;'><td colspan=9>";
  while ($rowArea = mysql_fetch_array($queryAreas)) {
    $str .= "(" . $rowArea["id_area"] . ") " . $rowArea["nome"] . " = " . $rowArea["quant"] . "<br>";
  }
  $str .= "</td></tr>";

  //Contabiliza total por área:
  $str .= "<tr><td colspan=9 style='background-color:#CCDAB4;'> TOTALIZAÇÃO ÁREAS (todos avaliadores)</td></tr>";
  $sqlAreas = "SELECT a.id_area, a.nome, count(*) AS quant FROM area a INNER JOIN avaliador_area aa ON a.id_area = aa.fk_area GROUP BY a.id_area ORDER BY a.id_area";
  $queryAreas = runSQL($sqlAreas);
  $str .= "<tr style='background:#FFFFFF;'><td colspan=9>";
  while ($rowArea = mysql_fetch_array($queryAreas)) {
    $str .= "(" . $rowArea["id_area"] . ") " . $rowArea["nome"] . " = " . $rowArea["quant"] . "<br>";
  }
  $str .= "</td></tr>";

  $str .= "<tr><td colspan=9 style='background-color:#CCDAB4;'>&nbsp; </td></tr>";

  echo $str;
  exit;
}

##############################################################################################################################
else if (isset($_GET["option"]) && ($_GET["option"] == "detalhar_avaliador")) {
  $id_av = (int) $_GET["id_avaliador"];

  $sql_recupera_dados_usuario = "SELECT u.nome as nomeAv, u.email, a.tipo_servidor, a.formacao, ca.nome as nomeCampus, i.sigla,
	CASE tipo_servidor
		WHEN 1 THEN 'Docente' 
		WHEN 2 THEN 'Técnico Administrativo'
		WHEN 3 THEN 'Estudante de Pós-Graduação Stricto Sensu'
		ELSE 'Desconhecido'
		END as tipo_servidor,
	CASE formacao
		WHEN 3 THEN 'Superior' 
		WHEN 4 THEN 'Especialização' 
		WHEN 5 THEN 'Mestrado' 
		WHEN 6 THEN 'Doutorado' 
		ELSE 'Desconhecido'
		END as formacao
	FROM usuario u, avaliador a, campus ca, instituicao i 
	WHERE u.id_usuario =" . $id_av . " AND a.fk_usuario = u.id_usuario AND ca.id_campus = a.fk_campus AND i.id_instituicao = ca.fk_instituicao";
  $executa = runSQL($sql_recupera_dados_usuario);
  $linha = mysql_fetch_array($executa);

  $str = '<h3 style="margin-top:20px;">Detalhes do Avaliador:</h3> </br>';
  $str .= 'Nome: ' . $linha["nomeAv"] . '<div style="clear:both; height:5px;"></div>';
  $str .= 'Email: ' . $linha["email"] . '<div style="clear:both; height:5px;"></div>';
  $str .= 'Instituição/Campus: ' . $linha["sigla"] . '/' . $linha["nomeCampus"] . '<div style="clear:both; height:5px;"></div>';
  $str .= 'Tipo de Servidor: ' . $linha["tipo_servidor"] . '<div style="clear:both; height:5px;"></div>';
  $str .= 'Formação: ' . $linha["formacao"] . '<div style="clear:both; height:5px;"></div>';
  $str .= 'Áreas:<br>';

  $sql_recupera_areas_av = "SELECT a.id_area, a.nome, aa.fk_area FROM avaliador_area aa, area a WHERE aa.fk_avaliador =" . $id_av . " AND a.id_area = aa.fk_area";
  $execute = runSQL($sql_recupera_areas_av);
  while ($line = mysql_fetch_array($execute)) {
    $str .= $line["id_area"] . ' = ' . $line["nome"] . '<br>';
  }
  $str .= '<div style="clear:both; height:5px;"></div>';
  $str .= '<a href="#" style="button red" onclick="voltar();">Voltar</a>';

  echo $str;
  exit;
}

##############################################################################################################################
else if (isset($_POST["option"]) && ($_POST["option"] == "aceitaAvaliador")) {
  $id = (int) $_POST["id_avaliador"];

  $sql = "UPDATE avaliador 
			SET status = 1 
			WHERE fk_usuario =" . $id;
  $exec_sql = runSQL($sql);

  if ($exec_sql == false)
    echo mysql_error();

  echo 1;
  exit;
}

##############################################################################################################################
else if (isset($_POST["option"]) && ($_POST["option"] == "recusaAvaliador")) {
  $id = (int) $_POST["id_avaliador"];

  $sql = "UPDATE avaliador 
			SET status = 2 
			WHERE fk_usuario =" . $id;
  $exec_sql = runSQL($sql);

  if ($exec_sql == false)
    echo mysql_error();

  echo 1;
  exit;
}

##############################################################################################################################
else if (isset($_GET["option"]) && ($_GET["option"] == "aceitaAvaliadoresEmMassa")) {
  $sql_geral = "SELECT * FROM avaliador ORDER BY fk_usuario ASC";
  $exec_sql_geral = runSQL($sql_geral);
  $aceita = $_GET["aceita"];
  $conta = 0;

  while ($linha = mysql_fetch_array($exec_sql_geral)) {
    foreach ($aceita as $key => $value) {

      $id_aceito = $value;
      if ($linha["fk_usuario"] == $id_aceito) {
        $sql_aceita_avaliador = "UPDATE avaliador a SET a.status = 1 WHERE fk_usuario =" . $id_aceito;
        $exec_aceita = runSQL($sql_aceita_avaliador);
        $conta = 1;
      }
    }
    if ($conta == 0) {
      $sql_recusa_avaliador = "UPDATE avaliador a SET a.status = 2 WHERE fk_usuario =" . $id_aceito;
      $exec_recusa = runSQL($sql_recusa_avaliador);
    }
    $conta = 0;
  }

  header("Location: adm_avaliadores.php");
  exit;
}

##############################################################################################################################
else if (isset($_GET["option"]) && ($_GET["option"] == "getListaVoluntarios")) {
  $sqlVoluntarios = "SELECT u.id_usuario, v.status, u.nome as nome_usuario, u.email, c.nome AS nome_curso, ca.nome AS nome_campus, i.sigla,
            v.Telefone1, v.Telefone2, v.Telefone3, Manha, Tarde, Noite, v.presenca
    FROM voluntario v INNER JOIN usuario u ON (u.id_usuario = v.fk_usuario) 
    INNER JOIN curso c ON c.id_curso = v.fk_curso 
    INNER JOIN campus ca ON ca.id_campus = c.fk_campus
    INNER JOIN instituicao i ON i.id_instituicao = ca.fk_instituicao
    ORDER BY u.id_usuario";
  $queryVoluntarios = runSQL($sqlVoluntarios);
  $str = '';
  while ($row = mysql_fetch_array($queryVoluntarios)) {
    $optionV = ($row["status"] == 1) ? "recusar" : "aceitar";
    $textoV = ($row["status"] == 1) ? "Rec." : "Ac.";
    $preseV = ($row["presenca"] == 1) ? "desmarcar" : "marcar";
    $textoPreseV = ($row["presenca"] == 1) ? "Desmarcar" : "Marcar";
    $str .= "<tr><td style=\"border-bottom:1px solid #CCDAB4;\">" . $row["id_usuario"] .
            "</td><td style=\"border-bottom:1px solid #CCDAB4;\">" . $row["nome_usuario"] .
            "</td><td style=\"border-bottom:1px solid #CCDAB4;\">" . $row["email"] .
            "</td><td style=\"border-bottom:1px solid #CCDAB4;\">" . $row["sigla"] .
            "</td><td style=\"border-bottom:1px solid #CCDAB4;\">" . $row["nome_campus"] .
            "</td><td style=\"border-bottom:1px solid #CCDAB4;\">" . $row["nome_curso"] .
            "</td><td style=\"border-bottom:1px solid #CCDAB4;\">" . $row["Telefone1"] .
            "</td><td style=\"border-bottom:1px solid #CCDAB4;\">" . $row["Manha"] .
            "</td><td style=\"border-bottom:1px solid #CCDAB4;\">" . $row["Tarde"] .
            "</td><td style=\"border-bottom:1px solid #CCDAB4;\">" . $row["Noite"] .
            "</td><td><a href=\"#\" class=\"button gray\" title=\"Clique para " . $optionV . " voluntário\" onclick=\"alteraStatusVoluntario(" . $row["id_usuario"] . ",'$optionV');\" style=\"margin-left:8px;font-size:10px;\">$textoV</a>" .
            "</td><td><a href=\"#\" class=\"button gray\" title=\"Clique para " . $preseV . " presença\" onclick=\"alteraPresencaVoluntario(" . $row["id_usuario"] . ",'$preseV');\" style=\"margin-left:8px;font-size:10px;\">$textoPreseV</a>" .
            "</td></tr>";
  }

  echo $str;
  exit;
} else if (isset($_POST["option"]) && ($_POST["option"] == "alteraStatusVoluntario")) {
  $opcaoVoluntario = $_POST["optionVoluntario"];
  $id_voluntario = $_POST["id_voluntario"];
  if ($opcaoVoluntario == "aceitar") {
    $status = 1;
  } elseif ($opcaoVoluntario == "recusar") {
    $status = 2;
  }
  $sql = "update voluntario set status = $status where fk_usuario = $id_voluntario";
  $rsVoluntario = runSQL($sql);
  if ($rsVoluntario)
    return $opcaoVoluntario;
  return -1;
}

else if (isset($_POST["option"]) && ($_POST["option"] == "alteraPresencaVoluntario")) {
  $opcaoVoluntario = $_POST["optionVoluntario"];
  $id_voluntario = $_POST["id_voluntario"];
  if ($opcaoVoluntario == "marcar") {
    $indPresenca = 1;
  } elseif ($opcaoVoluntario == "desmarcar") {
    $indPresenca = 2;
  }
  $sql = "update voluntario set presenca = $indPresenca where fk_usuario = $id_voluntario";
  $rsVoluntario = runSQL($sql);
  if ($rsVoluntario)
    return $opcaoVoluntario;
  return -1;
}

##############################################################################################################################
else if (isset($_GET["option"]) && ($_GET["option"] == "getListaOuvintes")) {
  $sqlOuvinte = "SELECT u.* FROM ouvinte o INNER JOIN usuario u ON (u.id_usuario = o.fk_usuario) 
    ORDER BY id_usuario";
  $queryOuvinte = runSQL($sqlOuvinte);
  $str = '';
  while ($row = mysql_fetch_array($queryOuvinte)) {
    $str .= "<tr><td>" . $row["id_usuario"] . "</td><td>" . $row["nome"] . "</td><td>" . $row["email"] . "</td></tr>";
  }

  echo $str;
  exit;
}

##############################################################################################################################
else if (isset($_GET["option"]) && ($_GET["option"] == "getListaTrabalhos")) {
  if (isset($_GET["ordem"]))
    $ordem = $_GET["ordem"];
  else
    $ordem = 5;
  //$sqlTrabalhos = "SELECT t.id_trabalho, t.titulo, t.status, a.nome FROM trabalho t inner join area a on a.id_area = t.fk_area ORDER BY a.nome ASC";
  $sqlTrabalhos = "SELECT DISTINCT t.id_trabalho, t.titulo, t.fk_categoria, t.fk_modalidade, t.status, ur.nome as usuario, a.id_area, a.nome as nome_area, tac.fk_autor, toc.fk_orientador, c.nome as nome_curso, ca.nome as nome_campus, i.sigla,
					CASE t.fk_categoria
						WHEN 1 THEN 'E'
						WHEN 2 THEN 'P'
						WHEN 3 THEN 'R'
					END as categoria,
					CASE t.fk_modalidade
						WHEN 1 THEN 'O'
						WHEN 2 THEN 'P'
					END as modalidade
					FROM trabalho t 
					LEFT join area a on a.id_area = t.fk_area 
					LEFT join trabalho_autor_curso tac on (tac.fk_trabalho = t.id_trabalho AND tac.seq = 1)
					LEFT join trabalho_orientador_campus toc on (toc.fk_trabalho = t.id_trabalho AND toc.seq = 1)
					LEFT JOIN parecer_trabalho ct ON ct.fk_trabalho = t.id_trabalho 
                                        LEFT JOIN revisor r on (ct.fk_revisor = r.fk_usuario)
                                        LEFT JOIN usuario ur on (ur.id_usuario = r.fk_usuario)
                    LEFT JOIN curso c ON c.id_curso = tac.fk_curso 
                    LEFT JOIN campus ca ON ca.id_campus = c.fk_campus 
                    LEFT JOIN instituicao i ON i.id_instituicao = ca.fk_instituicao ";
  if ($ordem == 1)
    $sqlTrabalhos .= "ORDER BY t.id_trabalho ASC ";
  else if ($ordem == 2)
    $sqlTrabalhos .= "ORDER BY upper(t.titulo_ordenar) ASC ";
  else if ($ordem == 3)
    $sqlTrabalhos .= "ORDER BY t.status ASC, t.id_trabalho ASC ";
  else if ($ordem == 4)
    $sqlTrabalhos .= "ORDER BY usuario ASC, t.id_trabalho ASC ";
  else if ($ordem == 5)
    $sqlTrabalhos .= "ORDER BY a.id_area, t.id_trabalho ";
  else if ($ordem == 6)
    $sqlTrabalhos .= "ORDER BY t.fk_modalidade, t.fk_area, t.id_trabalho ";
  else if ($ordem == 7)
    $sqlTrabalhos .= "ORDER BY t.fk_categoria, t.fk_modalidade, t.fk_area, t.id_trabalho ";
  else if ($ordem == 8)
    $sqlTrabalhos .= "ORDER BY tac.fk_autor, t.id_trabalho ";
  else if ($ordem == 9)
    $sqlTrabalhos .= "ORDER BY toc.fk_orientador, t.id_trabalho ";
  else if ($ordem == 10)
    $sqlTrabalhos .= "ORDER BY c.nome, t.id_trabalho ";
  else if ($ordem == 11)
    $sqlTrabalhos .= "ORDER BY ca.nome, t.id_trabalho ";
  else if ($ordem == 12)
    $sqlTrabalhos .= "ORDER BY i.sigla, t.id_trabalho ";
  else
    $sqlTrabalhos .= "ORDER BY a.nome ASC ";

  //echo ($sqlTrabalhos);

  $queryTrabalhos = runSQL($sqlTrabalhos);

  if ($queryTrabalhos == false)
    echo mysql_error();
  $str = '';
  while ($row = mysql_fetch_array($queryTrabalhos)) {
    $str .= "<tr valign=top><td>" . $row["id_trabalho"] .
            "</td><td>" . $row["titulo"] .
            "</td><td>" . $arr_status_trab[$row["status"]] .
            "</td><td>" . $row["usuario"] .
            "</td><td>(" . $row["id_area"] . ")" .
            "</td><td>" . $row["modalidade"] .
            "</td><td>" . $row["categoria"] .
            "</td><td>" . $row["fk_autor"] .
            "</td><td>" . $row["fk_orientador"] .
            "</td><td>" . $row["nome_curso"] .
            "</td><td>" . $row["nome_campus"] .
            "</td><td>" . $row["sigla"] .
            "</td><td><a href=\"analisaTrab.php?id_trab=" . $row["id_trabalho"] . "\" class=\"button gray\">Ver</a></td></tr>";
  }


  //Contabiliza total trabalhos por STATUS:
  $sql = "SELECT status, count(*) as quant FROM trabalho GROUP BY status ORDER BY status";
  $query = runSQL($sql);
  $str .= "<tr><td colspan=10 style='background-color:#CCDAB4;'> SITUAÇÃO DOS TRABALHOS </td></tr>";
  $str .= "<tr style='background:#FFFFFF;'><td colspan=10>";
  while ($row = mysql_fetch_array($query)) {
    $status = $row["status"];
    $quant = $row["quant"];
    $texto = $arr_status_trab[$status];
    $str .= $texto . " = " . $quant . "<br>";
  }
  $str .= "</td></tr>";

  //Contabiliza total trabalhos por área:
  $str .= "<tr><td colspan=10 style='background-color:#CCDAB4;'> TOTALIZAÇÃO TRABALHOS POR ÁREA </td></tr>";
  $sqlAreas = "SELECT t.fk_area, a.nome, count(*) AS quant FROM trabalho t
    INNER JOIN area a ON a.id_area = t.fk_area
    GROUP BY t.fk_area ORDER BY t.fk_area, a.nome";
  $queryAreas = runSQL($sqlAreas);
  $str .= "<tr  style='background:#FFFFFF;'><td colspan=10>";
  while ($rowArea = mysql_fetch_array($queryAreas)) {
    $str .= "(" . $rowArea["fk_area"] . ") " . $rowArea["nome"] . " = " . $rowArea["quant"] . "<br>";
  }
  $str .= "</td></tr>";

  //Contabiliza total trabalhos por modalidade:
  $str .= "<tr><td colspan=10 style='background-color:#CCDAB4;'> TOTALIZAÇÃO TRABALHOS POR MODALIDADE </td></tr>";
  $sql = "SELECT t.fk_modalidade, m.nome, count(*) AS quant FROM trabalho t
    INNER JOIN modalidade m ON m.id_modalidade = t.fk_modalidade
    GROUP BY t.fk_modalidade ORDER BY t.fk_modalidade";
  $query = runSQL($sql);
  $str .= "<tr style='background:#FFFFFF;'><td colspan=10>";
  while ($row = mysql_fetch_array($query)) {
    $str .= $row["nome"] . " = " . $row["quant"] . "<br>";
  }
  $str .= "</td></tr>";
  $str .= "<tr><td colspan=10 style='background-color:#CCDAB4;'> &nbsp; </td></tr>";

  echo $str;
  exit;
}

##############################################################################################################################
else if (isset($_GET["option"]) && ($_GET["option"] == "verTotaisTrabalho")) {

  $str = "";

  //Contabiliza total trabalhos por área:
  $str .= "<tr><td colspan=10 style='background-color:#CCDAB4;'> TOTALIZAÇÃO TRABALHOS POR ÁREA </td></tr>";
  $sqlAreas = "SELECT t.fk_area, a.nome, count(*) AS quant FROM trabalho t
    INNER JOIN area a ON a.id_area = t.fk_area
    GROUP BY t.fk_area ORDER BY t.fk_area, a.nome";
  $queryAreas = runSQL($sqlAreas);
  $str .= "<tr><td colspan=10>";
  while ($rowArea = mysql_fetch_array($queryAreas)) {
    $str .= "(" . $rowArea["fk_area"] . ") " . $rowArea["nome"] . " = " . $rowArea["quant"] . "<br>";
  }
  $str .= "</td></tr>";

  //Contabiliza total trabalhos por modalidade:
  $str .= "<tr><td colspan=10 style='background-color:#CCDAB4;'> TOTALIZAÇÃO TRABALHOS POR MODALIDADE </td></tr>";
  $sql = "SELECT t.fk_modalidade, m.nome, count(*) AS quant FROM trabalho t
    INNER JOIN modalidade m ON m.id_modalidade = t.fk_modalidade
    GROUP BY t.fk_modalidade ORDER BY t.fk_modalidade";
  $query = runSQL($sql);
  $str .= "<tr><td colspan=10>";
  while ($row = mysql_fetch_array($query)) {
    $str .= $row["nome"] . " = " . $row["quant"] . "<br>";
  }
  $str .= "</td></tr>";
  $str .= "<tr><td colspan=10 style='background-color:#CCDAB4;'> &nbsp; </td></tr>";
}

##############################################################################################################################
else if (isset($_GET["option"]) && ($_GET["option"] == "verTrabalho")) {
  $id_trab = (int) $_GET["id_trabalho"];
  $validaAdmin = 0;

  if (isset($_SESSION["id_administracao"])) {
    $adm = (int) $_SESSION["id_administracao"];
    //$validaAdmin = testa_adm($adm,$conexao);
    if (verificaPermissaoUsuario($adm, 12)) {

      //if($validaAdmin == 1) {
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
							INNER JOIN area a ON (a.id_area = t.fk_area)
							WHERE id_trabalho=" . $id_trab;
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
							WHERE tac.fk_trabalho = '" . $id_trab . "' 
							ORDER BY tac.seq ASC";
      $sqlOrientadores = "SELECT toc.fk_orientador, toc.seq, u.id_usuario, u.nome, u.email, ca.nome as nome_campus, i.sigla
								FROM trabalho_orientador_campus toc
								INNER JOIN orientador_campus oc ON (oc.fk_orientador=toc.fk_orientador AND oc.fk_campus=toc.fk_campus)
								INNER JOIN usuario u ON (u.id_usuario = toc.fk_orientador) 
								INNER JOIN campus ca ON ca.id_campus = toc.fk_campus
								INNER JOIN instituicao i ON i.id_instituicao = ca.fk_instituicao
								WHERE toc.fk_trabalho = '" . $id_trab . "' 
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
      $str .= '<div style="background-color:#CCDAB4;width:97%;height:18px;padding-top:5px;padding-left:10px;"><label style="font-weight:bold;"> ID: </label>' . $id_trab . '</div>';
      $str .= '<div style="padding-left:10px;padding-top:5px;"> </div>';

      // mostra titulo:
      $str .= '<div style="background-color:#CCDAB4;width:97%;height:18px;padding-top:5px;padding-left:10px;"><label style="font-weight:bold;"> Título: </label></div>';
      $str .= '<div style="padding-left:10px;padding-top:5px;"> ' . $titulo . ' </div>';

      // mostra resumo:
      $str .= '<div style="background-color:#CCDAB4;width:97%;height:18px;padding-top:5px;padding-left:10px;"><label style="font-weight:bold;"> Resumo: </label></div>';
      $str .= '<div style="padding-left:10px;padding-top:5px;width:95%;overflow:auto;"> ' . $resumo . ' </div>';

      // mostra palavras-chave:
      $str .= '<div style="background-color:#CCDAB4;width:97%;height:18px;padding-top:5px;padding-left:10px;"><label style="font-weight:bold;"> Palavras-chave: </label></div>';
      $str .= '<div style="padding-left:10px;height:20px;padding-top:5px;"> Palavra 1: ' . $palavra1 . ' </div>';
      $str .= '<div style="padding-left:10px;height:20px;padding-top:5px;"> Palavra 2: ' . $palavra2 . ' </div>';
      $str .= '<div style="padding-left:10px;height:20px;padding-top:5px;"> Palavra 3: ' . $palavra3 . ' </div>';

      // mostra area:
      $str .= '<div style="background-color:#CCDAB4;width:97%;height:18px;padding-top:5px;padding-left:10px;"><label style="font-weight:bold;"> Temática: </label></div>';
      $str .= '<div style="padding-left:10px;height:20px;padding-top:5px;"> ' . $linha_trab["nome_area"] . ' </div>';

      // mostra categoria:
      $str .= '<div style="background-color:#CCDAB4;width:97%;height:18px;padding-top:5px;padding-left:10px;"><label style="font-weight:bold;"> Categoria: </label></div>';
      $str .= '<div style="padding-left:10px;height:20px;padding-top:5px;"> ' . $linha_trab["nome_categoria"] . ' </div>';

      // mostra modalidade:
      $str .= '<div style="background-color:#CCDAB4;width:97%;height:18px;padding-top:5px;padding-left:10px;"><label style="font-weight:bold;"> Modalidade de Apresentação: </label></div>';
      $str .= '<div style="padding-left:10px;height:20px;padding-top:5px;"> ' . $linha_trab["nome_modalidade"] . ' </div>';

      // mostra apoiadores:
      $str .= '<div style="background-color:#CCDAB4;width:97%;height:18px;padding-top:5px;padding-left:10px;"><label style="font-weight:bold;"> Apoiadores: </label></div>';
      $str .= '<div style="padding-left:10px;height:30px;padding-top:5px;"> ' . $apoiadores . ' </div>';

      //mostra autores:
      $str .= '<div style="background-color:#CCDAB4;width:97%;height:18px;padding-top:5px;padding-left:10px;"><label style="font-weight:bold;"> Autor(es): </label></div>';
      $str .= '<table style="border:none;"><tr style="height:20px;background-color:#CCDAB4;padding-top:5px;"><td >ID</td><td>Nome</td><td>E-mail</td><td>Curso/Campus/Instituição</td><td></td> </tr>';
      while ($rowAut = mysql_fetch_array($resultAut)) {
        $idAut = stripslashes($rowAut["id_usuario"]);
        $nomeAut = stripslashes($rowAut["nome"]);
        $emailAut = stripslashes($rowAut["email_trabalho"]);
        $cur_camp_inst = $rowAut["nome_curso"] . " / " . $rowAut["nome_campus"] . " / " . $rowAut["sigla"];
        $str .= '<tr width="900" style="padding-top:5px;height:20px;"><td>' . $idAut . '</td><td>' . $nomeAut . '</td><td>' . $emailAut . '</td><td>' . $cur_camp_inst . '</td><td>' . $rowAut["tipoAutor"] . '</td></tr>';
      }
      $str .= '</table>';

      // mostra orientadores:
      $str .= '<div style="background-color:#CCDAB4;width:97%;height:18px;padding-top:5px;padding-left:10px;"><label style="font-weight:bold;"> Orientador(es): </label></div>';
      $str .= '<table style="border:none;"><tr style="height:20px;background-color:#CCDAB4;"><td>ID</td><td>Nome</td><td>E-mail</td><td>Campus/Instituição</td></tr>';
      while ($rowOr = mysql_fetch_array($resultOrien)) {
        $idOrient = stripslashes($rowOr["id_usuario"]);
        $nomeOrient = stripslashes($rowOr["nome"]);
        $emailOrient = stripslashes($rowOr["email"]);
        $camp_inst = $rowOr["nome_campus"] . " / " . $rowOr["sigla"];
        $str .= '<tr><td>' . $idOrient . '</td><td>' . $nomeOrient . '</td><td>' . $emailOrient . '</td><td>' . $camp_inst . '</td></tr>';
      }
      $str .= '</table>';

      // mostra status
      $status = $linha_trab["status"];
      $str .= '<div style="background-color:#CCDAB4;width:97%;height:18px;padding-top:5px;padding-left:10px;"><label style="font-weight:bold;"> Status do Trabalho: </label></div>';
      $str .= '<div style="padding-left:10px;height:30px;padding-top:5px;"> ' . $arr_status_trab_completo[$status] . ' </div>';

      $str .= '<br><a href="../imprimir_trabalho.php?id_trabalho=' . $id_trab . '" class="button blue">Visualizar PDF</a>';
      $str .= '<a href="adm_trabalhos.php" class="button red">Voltar</a>';
    } else {
      $str = "Error:";
    }
  } else {
    $str = "Error.";
  }
  echo $str;
  exit;
}

##############################################################################################################################
else if (isset($_POST["option"]) && ($_POST["option"] == "verificaAnaliseAnterior")) {
  $id_trab = $_POST["id_trabalho"];
  $id_adm = $_SESSION["id_administracao"];

  $statusTrabalho = get_status_trabalho($id_trab, $conexao);


  // caso 1: trabalho PENDENTE
  if ($statusTrabalho == STATUS_TRAB_PENDENTE) {
    $dados = "dados={retorno:0}";
  }
  /*
    // caso 2: trabalho ENVIADO: ANALISE INICIAL
    else if($statusTrabalho == STATUS_TRAB_ENVIADO) {
    $dados = "dados={retorno:10}";
    }
   */

  // caso 3: ja foi avaliado: EDITAR/VISUALIZAR
  //else if (....)
  if ($statusTrabalho == STATUS_TRAB_PENDENTE ||
          $statusTrabalho == STATUS_TRAB_ENVIADO ||
          $statusTrabalho == STATUS_TRAB_ACEITO ||
          $statusTrabalho == STATUS_TRAB_CORRIGIR ||
          $statusTrabalho == STATUS_TRAB_CORRIGIDO ||
          $statusTrabalho == STATUS_TRAB_RECUSADO) {
    $confirma_se_adm_analisou = "SELECT * FROM parecer_trabalho WHERE fk_trabalho = " . $id_trab;
    $executa_confirmacao = runSQL($confirma_se_adm_analisou);
    $qnt_linhas = mysql_num_rows($executa_confirmacao);
    // caso 3.1: Só teve 1 avaliação do trabalhcorrecoeso
    if ($qnt_linhas == 1) {
      $linha = mysql_fetch_array($executa_confirmacao);
      //caso 3.1.1: admin responsavel pela avaliacao                        
      if ($id_adm == $linha["fk_revisor"]) {
        // caso 3.1.1.1: etapa permite edição
        //if(ETAPA_INSCRICAO_TRABALHO == 1 || ETAPA_ANALISE_TRABALHO == 1 || ETAPA_ANALISE_FINAL_TRABALHO == 1) {
        if (ETAPA_INSCRICAO_TRABALHO == 1 || ETAPA_ANALISE_TRABALHO == 1) {
          $dados = "dados={retorno:21}";
        } elseif (ETAPA_ANALISE_FINAL_TRABALHO == 1) {
          $dados = "dados={retorno:40}";
        } else {
          // caso 3.1.1.2: etapa NÃO permite edição
          $dados = "dados={retorno:22}";
        }
      } else {
        //caso 3.1.2: admin NÃO responsavel pela avaliacao
        $dados = "dados={retorno:22}";
      }
      // caso 3.2: Teve 2 avaliações do trabalho
    } else if ($qnt_linhas == 2) {
      $verifica_avaliou_2 = "SELECT * FROM parecer_trabalho 
								WHERE fk_trabalho = " . $id_trab . " AND fk_revisor = " . $id_adm . " AND seq = 2";
      $executa_verificacao = runSQL($verifica_avaliou_2);
      $num_linhas = mysql_num_rows($executa_verificacao);
      // caso 3.2.1: admin responsavel pela avaliacao 2
      if ($num_linhas == 1) {
        // caso 3.2.1.1: etapa permite edição
        if (ETAPA_INSCRICAO_TRABALHO == 1 || ETAPA_ANALISE_TRABALHO == 1 || ETAPA_ANALISE_FINAL_TRABALHO == 1) {
          $dados = "dados={retorno:23}";
          // caso 3.2.1.2: etapa NÃO permite edição
        } else
          $dados = "dados={retorno:24}";
        //caso 3.2.2: admin NÃO responsavel pela avaliacao 2
      } else
        $dados = "dados={retorno:24}";
    }
  }

  /*
    // caso 4: status trabalho CORRIGIDO E REENVIADO
    else if($statusTrabalho == STATUS_TRAB_CORRIGIDO) {
    $verifica_avaliou_2 = "SELECT * FROM correcoes_trabalho
    WHERE fk_trabalho = ".$id_trab." AND fk_adm = ".$id_adm." AND seq = 1";
    $executa_verificacao = runSQL($verifica_avaliou_2);
    $num_linhas = mysql_num_rows($executa_verificacao);
    // caso 4.1: admin é responsavel pela avaliacao 2
    if($num_linhas == 1) {
    $dados = "dados={retorno:40}";
    } else {
    $dados = "dados={retorno:45}";
    }
    }
   */

  echo $dados;
  exit;
}

##############################################################################################################################
else if (isset($_POST["option"]) && ($_POST["option"] == "analisaTrab")) {

  $id_trab = (int) $_POST["id_trabalho"];
  $id_adm = (int) $_SESSION["id_administracao"];

  if (isset($id_trab)) {
    $status = (int) $_POST["status"];
    $introducao = (int) $_POST["introducao"];
    $objetivos = (int) $_POST["objetivos"];
    $metodologia = (int) $_POST["metodologia"];
    $resultados = (int) $_POST["resultados"];
    if (isset($_POST["obs_introducao"])) {
      $obs_introducao = mysql_real_escape_string($_POST["obs_introducao"]);
    } else {
      $obs_introducao = '';
    }
    if (isset($_POST["obs_objetivos"])) {
      $obs_objetivos = mysql_real_escape_string($_POST["obs_objetivos"]);
    } else {
      $obs_objetivos = '';
    }
    if (isset($_POST["obs_metodologia"])) {
      $obs_metodologia = mysql_real_escape_string($_POST["obs_metodologia"]);
    } else {
      $obs_metodologia = '';
    }
    if (isset($_POST["obs_resultados"])) {
      $obs_resultados = mysql_real_escape_string($_POST["obs_resultados"]);
    } else {
      $obs_resultados = '';
    }
    if (isset($_POST["obs_gerais"])) {
      $obs_gerais = mysql_real_escape_string($_POST["obs_gerais"]);
    } else {
      $obs_gerais = '';
    }
    if (isset($_POST["observacoes"])) {
      $obs_internas = mysql_real_escape_string($_POST["observacoes"]);
    } else {
      $obs_internas = '';
    }

    $statusTrabalho = get_status_trabalho($id_trab, $conexao);
    $verifica_existencia_analise = "SELECT * FROM parecer_trabalho WHERE fk_trabalho=" . $id_trab;
    $executaSql = runSQL($verifica_existencia_analise);
    $contaLinhas = mysql_num_rows($executaSql);

    // caso 1: inserir parecer
    if ($statusTrabalho != STATUS_TRAB_PENDENTE && ($contaLinhas == 0 || ($contaLinhas == 1 && ETAPA_ANALISE_FINAL_TRABALHO == 1))) {
      $contaLinhas++;
      $insere_nova_analise = "INSERT INTO parecer_trabalho 
										(fk_trabalho, seq, fk_revisor, datahora, status, 
										status_introducao, status_objetivos, status_metodologia, status_resultados, 
										observacoes, observacoes_internas, autor_ciente, 
										obs_introducao, obs_objetivos, obs_metodologia, obs_resultados)
									VALUES 
										(" . $id_trab . ", " . $contaLinhas . ", " . $id_adm . ", sysdate(), " . $status . ",
										" . $introducao . ", " . $objetivos . ", " . $metodologia . ", " . $resultados . ", 
										'" . $obs_gerais . "', '" . $obs_internas . "', 0, 
										'" . $obs_introducao . "', '" . $obs_objetivos . "', '" . $obs_metodologia . "', '" . $obs_resultados . "')";
      $executaComando = runSQL($insere_nova_analise);

      $altera_status_trab = "UPDATE trabalho SET status =" . $status . " WHERE id_trabalho =" . $id_trab;
      $executa_alteraStatus = runSQL($altera_status_trab);

      $retorno = 'Parecer criado com sucesso.';

      // caso 2: atualizar parecer!!
    } else if ($contaLinhas == 2 || ($contaLinhas == 1 && (ETAPA_INSCRICAO_TRABALHO == 1 || ETAPA_ANALISE_TRABALHO == 1))) {
      // verificar se parecer foi realizado pelo id-adm:
      //$verifica_responsavel_parecer = "SELECT * FROM correcoes_trabalho WHERE fk_trabalho=".$id_trab." AND fk_adm =".$id_adm;
      $verifica_responsavel_parecer = "SELECT * FROM parecer_trabalho WHERE fk_trabalho=" . $id_trab . " AND fk_revisor =" . $id_adm . " AND seq = " . $contaLinhas;
      $executa_verificacao = runSQL($verifica_responsavel_parecer);
      $conta_linhas = mysql_num_rows($executa_verificacao);
      // id-adm é responsavel pelo parecer do trabalho:
      if ($conta_linhas == 1) {
        $atualiza_analise = "UPDATE parecer_trabalho
									SET datahora = sysdate(), status = " . $status . ", 
										status_introducao = " . $introducao . ", status_objetivos = " . $objetivos . ", status_metodologia = " . $metodologia . ", status_resultados = " . $resultados . ",
										observacoes = '" . $obs_gerais . "', observacoes_internas = '" . $obs_internas . "', autor_ciente = 0, 
										obs_introducao = '" . $obs_introducao . "', obs_objetivos = '" . $obs_objetivos . "', obs_metodologia = '" . $obs_metodologia . "', obs_resultados = '" . $obs_resultados . "' 
										WHERE fk_trabalho = " . $id_trab . " AND seq =" . $contaLinhas;
        $executaComando = runSQL($atualiza_analise);
        if ($executaComando == false)
          echo mysql_error();
        $altera_status_trab = "UPDATE trabalho SET status =" . $status . " WHERE id_trabalho =" . $id_trab;
        $executa_alteraStatus = runSQL($altera_status_trab);
        if ($executa_alteraStatus == false)
          echo mysql_error();
        $retorno = 'Parecer atualizado com sucesso.';
      } else {
        $retorno = "Você não é responsável por este parecer.";
      }
    } else {
      $retorno = 'Essa etapa não permite efetuar parecer.';
    }
  } else {
    $retorno = 'Nenhum trabalho selecionado.';
  }

  echo $retorno;
  exit;
}

##############################################################################################################################
else if (isset($_POST["option"]) && ($_POST["option"] == "recuperar_analise")) {
  $id_trab = (int) $_POST["id_trabalho"];
  $seq = (int) $_POST["seq"];

  $recuperaInformacoes = "SELECT * FROM parecer_trabalho WHERE fk_trabalho =" . $id_trab . " AND seq =" . $seq;
  $executaQuery = runSQL($recuperaInformacoes);
  $linha_info = mysql_fetch_array($executaQuery);

  $status = $linha_info["status"];
  $status_introducao = $linha_info["status_introducao"];
  $obs_introducao = stripslashes($linha_info["obs_introducao"]);
  $status_objetivos = $linha_info["status_objetivos"];
  $obs_objetivos = stripslashes($linha_info["obs_objetivos"]);
  $status_metodologia = $linha_info["status_metodologia"];
  $obs_metodologia = stripslashes($linha_info["obs_metodologia"]);
  $status_resultado = $linha_info["status_resultados"];
  $obs_resultado = stripslashes($linha_info["obs_resultados"]);
  $observacoes = stripslashes($linha_info["observacoes"]);
  $observacoes_internas = stripslashes($linha_info["observacoes_internas"]);
  $autor_ciente = $linha_info["autor_ciente"];
  if ($status == 2)
    $status = 0;
  else if ($status == 3)
    $status = 1;
  else if ($status == 5)
    $status = 2;
  $dados = "dados={retorno: 1, seq: " . $seq . ", status: " . $status . ",
				status_intro: " . $status_introducao . ", obs_intro: '" . $obs_introducao . "', status_obj: " . $status_objetivos . ", obs_obj: '" . $obs_objetivos . "', 
				status_metod: " . $status_metodologia . ", obs_metod: '" . $obs_metodologia . "', status_result: " . $status_resultado . ", obs_result: '" . $obs_resultado . "', 
				obs: '" . $observacoes . "', obs_internas: '" . $observacoes_internas . "', autor_ciente: " . $autor_ciente . "}";
  //Retira os ENTER \n e \r pois dá erro na função eval() do Javascript.
  $dados = str_replace("\n", "", $dados);
  $dados = str_replace("\r", "", $dados);

  echo $dados;
  exit;
}

##############################################################################################################################
else if (isset($_POST["option"]) && ($_POST["option"] == "mostrar_analise")) {
  $id_trab = (int) $_POST["id_trabalho"];
  $seq = (int) $_POST["seq"];

  //recuperar as informações no bd
  $recuperar_analise = "SELECT * FROM parecer_trabalho WHERE fk_trabalho = " . $id_trab . " AND seq =" . $seq;
  $executa_query = runSQL($recuperar_analise);
  $linha_analise = mysql_fetch_array($executa_query);

  $casoStatus = array();
  $casoStatus[0] = "Conforme";
  $casoStatus[1] = "Inconforme";

  $status_trab = $linha_analise["status"];
  $status_int = $linha_analise["status_introducao"];
  $status_obj = $linha_analise["status_objetivos"];
  $status_met = $linha_analise["status_metodologia"];
  $status_res = $linha_analise["status_resultados"];

  $string = '<label style="font-weight: bold;">Status: </label> ' . $arr_status_trab[$status_trab] . '<br>';
  $string .= '<div style="clear:both; height:10px;"></div>';
  $string .= '<label style="font-weight: bold;">Introdução:</label> ' . $casoStatus[$status_int] . '<br>';
  $string .= '<label style="font-weight: bold;margin-left:10px;margin-top:5px;">Observações:</label> ' . stripslashes($linha_analise["obs_introducao"]) . '<br>';
  $string .= '<div style="clear:both; height:10px;"></div>';
  $string .= '<label style="font-weight: bold;">Objetivos:</label> ' . $casoStatus[$status_obj] . '<br>';
  $string .= '<label style="font-weight: bold;margin-left:10px;margin-top:5px;">Observações:</label> ' . stripslashes($linha_analise["obs_objetivos"]) . '<br>';
  $string .= '<div style="clear:both; height:10px;"></div>';
  $string .= '<label style="font-weight: bold;">Metodologia:</label> ' . $casoStatus[$status_met] . '<br>';
  $string .= '<label style="font-weight: bold;margin-left:10px;margin-top:5px;">Observações:</label> ' . stripslashes($linha_analise["obs_metodologia"]) . '<br>';
  $string .= '<div style="clear:both; height:10px;"></div>';
  $string .= '<label style="font-weight: bold;">Resultados:</label> ' . $casoStatus[$status_res] . '<br>';
  $string .= '<label style="font-weight: bold;margin-left:10px;margin-top:5px;">Observações:</label> ' . stripslashes($linha_analise["obs_resultados"]) . '<br><br>';
  $string .= '<div style="clear:both; height:10px;"></div>';
  $string .= '<label style="font-weight: bold;">Observações Gerais:</label> ' . stripslashes($linha_analise["observacoes"]) . '<br>';
  if (isset($_SESSION["id_administracao"])) {
    $string .= '<label style="font-weight: bold;">Observações Internas:</label> ' . stripslashes($linha_analise["observacoes_internas"]) . '<br>';
  }

  $string .= '------------------------------------------------------------------------------------------- <br><br>';
  $string .= 'Clique em Editar Trabalho para efetuar as modificações no trabalho.<br>';
  $string .= 'Para finalizar o processo, clique em Enviar Trabalho.<br>';


  echo $string;
  exit;
}

##############################################################################################################################
else if (isset($_POST["option"]) && ($_POST["option"] == "enviar_email_trabalho_status")) {

  $status = $_POST["status"];

  if ($status == STATUS_TRAB_ACEITO) {
    $msg = "foi aceito para apresentação no evento. O parecer pode ser visualizado pelo(s) autor(es) / orientador(es) no endereço (http://mostra.poa.ifrs.edu.br/2013/sistema).\n\n";
    $assunto = "Mostra IFRS POA 2013 - trabalho aceito";
  } else if ($status == STATUS_TRAB_CORRIGIR) {
    $msg = "encontra-se em estado \"PENDENTE DE CORREÇÕES\".\n
      O autor principal deve acessar o sistema (http://mostra.poa.ifrs.edu.br/2013/sistema) e efetuar as devidas correções.\n\n

      Ao finalizar o processo, deverá re-enviar o trabalho, clicando no link Enviar Trabalho.\n
      A data limite é dia 11/10/2013.\n\n";

    $assunto = "Mostra IFRS POA 2013 - trabalho pendente de correções";
  } else if ($status == STATUS_TRAB_RECUSADO) {
    $msg = "não foi aceito para apresentação no evento. O parecer pode ser visualizado pelo(s) autor(es) / orientador(es) no endereço (http://mostra.poa.ifrs.edu.br/2013/sistema).\n\n";
    $assunto = "Mostra IFRS POA 2013 - trabalho recusado";
  } else {
    exit;
  }

  $sql_seleciona_trabalhos = "SELECT * FROM trabalho t WHERE t.status = " . $status . " ORDER BY t.id_trabalho";

  $executa_selecao_trab = runSQL($sql_seleciona_trabalhos);

  while ($row = mysql_fetch_array($executa_selecao_trab)) {
    $mensagem = "Informamos que o trabalho: ";
    $mensagem .= $row["titulo_ordenar"] . ", submetido à 14ª Mostra de Pesquisa, Ensino e Extensão do IFRS - Câmpus Porto Alegre, ";
    $mensagem .= $msg;
    $mensagem .= "Esta mensagem foi gerada automaticamente pelo sistema de Inscrição.\n";
    $mensagem .= "http://mostra.poa.ifrs.edu.br/2013/sistema";

    $busca_email_autores = "SELECT u.email FROM usuario u, trabalho_autor_curso tac WHERE tac.fk_trabalho = " . $row["id_trabalho"] . " AND u.id_usuario = tac.fk_autor ORDER BY tac.seq";
    $executa_busca_autores = runSQL($busca_email_autores);

    $to = "";
    while ($row_autores = mysql_fetch_array($executa_busca_autores)) {
      $to .= $row_autores["email"];
      $to .= ", ";
    }

    $busca_email_orientadores = "SELECT u.email FROM usuario u, trabalho_orientador_campus toc WHERE toc.fk_trabalho = " . $row["id_trabalho"] . " AND u.id_usuario = toc.fk_orientador ORDER BY toc.seq";
    $executa_busca_orientadores = runSQL($busca_email_orientadores);

    while ($row_orientadores = mysql_fetch_array($executa_busca_orientadores)) {
      $to .= $row_orientadores["email"];
      $to .= ", ";
    }

    $to = substr($to, 0, -2);
    $envia = mail("$to", "$assunto", "$mensagem", "from:mostra@poa.ifrs.edu.br");
    if ($envia == true) {
      echo "<pre>Email enviado:\n";
      echo "Para: $to \n";
      echo "Assunto: $assunto \n";
      echo "Mensagem: $mensagem \n\n</pre> <br><br>";
    } else {
      echo "<pre>Erro ao enviar email:\n";
      echo "Para: $to \n";
      echo "Assunto: $assunto \n";
      echo "Mensagem: $mensagem \n\n</pre> <br><br>";
    }
  }

  exit;
}

##############################################################################################################################
else if (isset($_POST["option"]) && ($_POST["option"] == "enviar_email_sessoes_avaliadores")) {

  $assunto = "Mostra IFRS - Poa: Confirmação de Sessão";

  $sql_selecionar_avaliadores = "SELECT DISTINCT u.id_usuario, u.nome as nome_avaliador, u.email
	FROM usuario u
    INNER JOIN avaliador a ON u.id_usuario = a.fk_usuario 
    INNER JOIN avaliador_sessao avs ON avs.fk_avaliador = a.fk_usuario 
    ORDER BY u.id_usuario  ";
  $result_select = runSQL($sql_selecionar_avaliadores);

  //Para cada Avaliador.
  while ($row = mysql_fetch_array($result_select)) {

    $id_avaliador = $row["id_usuario"];
    $nome = $row["nome_avaliador"];

    $mensagem = "Prezado(a) " . $nome . ",\n\n";
    $mensagem .= "A Comissão Organizadora da 14ª Mostra de Pesquisa, Ensino e Extensão do IFRS - Câmpus Porto Alegre tem a ";
    $mensagem .= "satisfação de confirmar sua participação como avaliador(a) neste evento, nos dias e horários informados neste ";
    $mensagem .= "email.\n\n";

    $mensagem .= "É imprescindível que confirme sua participação até o dia 28/10/13 ";
    $mensagem .= "seguindo as instruções abaixo:\n\n";

    $mensagem .= "IMPORTANTE!\n";
    $mensagem .= "Acesse o sistema http://mostra.poa.ifrs.edu.br/2013/sistema\n";
    $mensagem .= "Digite seu login (CPF) e senha.\n";
    $mensagem .= "Clique em Área do Avaliador\n";
    $mensagem .= "Confirme suas sessões.\n\n";
    $mensagem .= "Os resumos estão disponíveis em http://mostra.poa.ifrs.edu.br/2013/site/html/trabalhos_aceitos.php\n\n";

    //Procura as sessoes ainda nao confirmadas ou recusadas desse avaliador.
    $sql_sessao = "SELECT s.id_sessao, s.nome as nome_sessao, s.nome_sala, s.nome_andar, 
            s.data, s.hora_ini, s.hora_fim,
            s.fk_modalidade,
            CASE s.fk_modalidade
                WHEN 1 THEN 'Apresentação Oral'
                WHEN 2 THEN 'Apresentação Pôster'
                ELSE ''
            END as modalidade
            FROM avaliador a 
            INNER JOIN avaliador_sessao avs ON avs.fk_avaliador = a.fk_usuario 
            INNER JOIN sessao s ON s.id_sessao = avs.fk_sessao
            WHERE a.fk_usuario = " . $id_avaliador . " AND avs.status=0 ORDER BY s.id_sessao  ";
    $result_sessao = runSQL($sql_sessao);

    //Para cada sessao.
    $quant_sessoes = 0;
    while ($row_sessao = mysql_fetch_array($result_sessao)) {
      $quant_sessoes++;
      $id_sessao = $row_sessao["id_sessao"];
      $nome_sessao = $row_sessao["nome_sessao"];
      $nome_sala = $row_sessao["nome_sala"];
      $nome_andar = $row_sessao["nome_andar"];
      $data = $row_sessao["data"];
      $hora_ini = $row_sessao["hora_ini"];
      $hora_fim = $row_sessao["hora_fim"];
      $modalidade = $row_sessao["modalidade"];

      $normal = explode("-", $data);
      $data = $normal[2] . "/" . $normal[1] . "/" . $normal[0];

      $normal = explode(":", $hora_ini);
      $hora_ini = $normal[0] . ":" . $normal[1];

      $normal = explode(":", $hora_fim);
      $hora_fim = $normal[0] . ":" . $normal[1];

      $mensagem .= "Sessão " . $id_sessao . ": \n";
      $mensagem .= "Data/Horário: " . $data . " das " . $hora_ini . " às " . $hora_fim . " \n";
      $mensagem .= "Modalidade: " . $modalidade . " \n";
      $mensagem .= "Trabalhos:\n";

      $sql_trabalho = "SELECT t.id_trabalho, upper(t.titulo_ordenar) as titulo_ordenar, t.fk_modalidade, t.fk_area
          FROM trabalho t WHERE t.fk_sessao = " . $id_sessao . " ORDER BY t.seq_sessao";
      $result_trabalho = runSQL($sql_trabalho);

      //Para cada trabalho
      while ($row_trabalho = mysql_fetch_array($result_trabalho)) {
        $mensagem .= "(" . $row_trabalho["id_trabalho"] . ") " . $row_trabalho["titulo_ordenar"] . "\n";
      }//trabalhos

      $mensagem .= "\n";
    }//sessoes        


    $mensagem .= "Contamos com sua presença!\n\n";

    $mensagem .= "Atenciosamente,\n\n";
    $mensagem .= "Comissão Organizadora\n";
    $mensagem .= "14ª Mostra de Pesquisa, Ensino e Extensão\n";
    $mensagem .= "IFRS - Câmpus Porto Alegre\n";
    $mensagem .= "http://mostra.poa.ifrs.edu.br\n";

    $to = $row["email"];

    if ($quant_sessoes > 0) {
      $envia = mail("$to", "$assunto", "$mensagem", "from:mostra@poa.ifrs.edu.br");
      if ($envia == true) {
        echo "Para: $to \n";
        echo "Assunto: $assunto \n";
        echo "<PRE>Mensagem: $mensagem \n </PRE><br><br>";
      } else {
        echo "Erro:" . $to . " - " . $mensagem;
      }
    }
  }//avaliadores
}

##############################################################################################################################
else if (isset($_POST["option"]) && ($_POST["option"] == "enviar_email_avaliadores")) {
  $sql_selecionar_avaliadores = "SELECT DISTINCT u.nome, u.email FROM usuario u, avaliador a, avaliador_area aa
	WHERE u.id_usuario = a.fk_usuario AND a.fk_usuario NOT IN (SELECT fk_avaliador FROM avaliador_area)";
  $executa_selecao = runSQL($sql_selecionar_avaliadores);

  $assunto = "Mostra IFRS - Poa: Cadastro de Avaliador";
  while ($row = mysql_fetch_array($executa_selecao)) {
    $to = $row["email"];
    $nome = $row["nome"];
    $mensagem = "Prezado(a) " . $nome . "! \nAgradecemos por você ter se cadastrado como avaliador(a) de trabalhos da 14ª Mostra de Pesquisa, Ensino e Extensão do IFRS - Câmpus Porto Alegre. Solicitamos que nos envie por email, o mais breve possível, as áreas que se dispõe a avaliar, conforme listagem abaixo:\n\n";
    $mensagem .= "1) Ambiente, Saúde e Segurança\n
2) Ciências Humanas e Educação\n
3) Controle e Processos Industriais\n
4) Gestão e Negócios\n
5) Hospitalidade e Lazer\n
6) Informação e Comunicação\n
7) Infraestrutura\n
8) Militar\n
9) Produção Alimentícia\n
10) Produção Cultural e Design\n
11) Produção Industrial\n
12) Recursos Naturais\n\n
Atenciosamente,\n
Comissão Organizadora\n
13ª Mostra de Pesquisa, Ensino e Extensão - IFRS - Câmpus Porto Alegre\n
email: mostra@poa.ifrs.edu.br";

    $envia = mail("$to", "$assunto", "$mensagem", "from:mostra@poa.ifrs.edu.br");
    //if($envia == true) {
    echo "Para: $to \n";
    echo "Assunto: $assunto \n";
    echo "Mensagem: $mensagem \n\n <br><br>";
    //} else {
    // echo 'error.';
    // }
  }

  exit;
}

##############################################################################################################################
else if (isset($_POST["option"]) && ($_POST["option"] == "enviar_email_avaliadores_2")) {

  $assunto = "Mostra IFRS - Poa: Instruções para Avaliação";

  $sql_selecionar_avaliadores = "SELECT DISTINCT u.id_usuario, u.nome as nome_avaliador, u.email
	FROM usuario u
    INNER JOIN avaliador a ON u.id_usuario = a.fk_usuario 
    INNER JOIN avaliador_sessao avs ON avs.fk_avaliador = a.fk_usuario 
    WHERE avs.status = 1
    ORDER BY u.id_usuario  ";
  $result_select = runSQL($sql_selecionar_avaliadores);

  //Para cada Avaliador.
  while ($row = mysql_fetch_array($result_select)) {

    $id_avaliador = $row["id_usuario"];
    $nome = $row["nome_avaliador"];
    $to = $row["email"];

    $mensagem = "14ª MOSTRA DE PESQUISA, ENSINO E EXTENSÃO DO IFRS – 
CÂMPUS PORTO ALEGRE: PRÁTICAS E INTERAÇÕES

AVALIAÇÃO DE TRABALHOS:

http://mostra.poa.ifrs.edu.br/2013/site/arquivos/instrucoes_aos_avaliadores_mostra_2013.pdf

Prezado avaliador(a).

	Ao avaliar, lembre que nesta Mostra são apresentados trabalhos de diferentes níveis de ensino: técnico ou superior, que concorrem em categorias distintas e, portanto, não devem ser avaliados comparativamente.

	Fique atento ainda, para a categoria de trabalho que está sendo avaliada:
 
- Relato de Experiência: apresentação de experiência de ensino, de extensão, profissional e/ou tecnológica, desenvolvida ou em andamento. 

- Relato de Pesquisa: apresentação de projeto de pesquisa desenvolvido ou em andamento, com resultados parciais. 

- Revisão de Literatura/Ensaio: apresentação de revisão de literatura ou ensaio sobre um assunto específico.  

AVALIAÇÃO DO RESUMO

	Os resumos devem observar as normas da Língua Portuguesa e orientações do regulamento, que seguem abaixo:
 
	O resumo do trabalho deve explicitar introdução, definição do problema, objetivo(s), metodologia, resultados parciais ou finais. 

	A introdução deve apresentar o tema do trabalho, suas motivações e origem. A definição do problema é a razão de ser do estudo, o que motivou sua realização e normalmente é algo a ser resolvido, verificado. Em alguns casos é possível que já se tenha uma hipótese e neste caso, a hipótese deve ser mencionada. Os objetivos devem contemplar o que se espera com o trabalho, onde se quer chegar, o que se quer atingir. A metodologia visa explicar como foi feito, qual o método utilizado para obter resultados. Deve-se apresentar, por fim, os Resultados parciais ou finais, o que já é possível afirmar acerca dos estudos feitos e o que já foi comprovado ou reconhecido. 

Importante: as pesquisas que ainda não têm resultados são apresentadas na categoria de Relato de Experiência. Neste caso, no resumo e apresentação (oral ou pôster) não constará o item “resultados”. 

AVALIAÇÃO DA APRESENTAÇÃO

	Qualquer que seja a modalidade de apresentação (oral ou pôster), o trabalho deverá ser apresentado pelo primeiro autor (aluno).

	A apresentação deve explicitar a instituição e curso de origem, título, autores e temática. Além disso, deve apresentar, de forma clara e observando as normas da Língua Portuguesa, os seguintes elementos: introdução, objetivo(s), metodologia, resultados (opcional para relato de experiência) e referências.  
	A apresentação deverão ter duração mínima de sete (7) minutos e máxima de dez (10) minutos.

	Após a apresentação, será aberto um espaço para questionamentos e considerações da banca, com duração máxima de dez (10) minutos. 

	Sua contribuição na arguição é muito importante. Questione sobre aspectos que julgar pertinentes ao entendimento do trabalho apresentado, que não tenham ficado claros na apresentação ou no resumo e que expressem a real participação do aluno no desenvolvimento do estudo.

	Este é um momento de compartilhamento de experiências e suas considerações são fundamentais para aperfeiçoar os estudos e estimular os alunos na continuidade de sua formação.

	Importante: Apenas o estudante inscrito como apresentador poderá fazer a apresentação oral e responder aos questionamentos da banca.  

	Agradecemos antecipadamente sua participação!

Comissão Organizadora
14ª Mostra de Pesquisa, Ensino e Extensão
IFRS - Câmpus Porto Alegre
";

    $envia = mail("$to", "$assunto", "$mensagem", "from:mostra@poa.ifrs.edu.br");
    //$envia = true;
    if ($envia == true) {
      echo "Para: $to \n";
      echo "Assunto: $assunto \n";
      echo "Mensagem: $mensagem \n <br><br>";
    } else {
      echo "Erro:" . $to . " - " . $mensagem;
    }
  }//avaliadores
}


##############################################################################################################################
else if (isset($_POST["option"]) && ($_POST["option"] == "enviar_email_avaliadores_3")) {

  $assunto = "Mostra IFRS - Poa: Informação";

  $sql_selecionar_avaliadores = "SELECT DISTINCT u.id_usuario, u.nome as nome_avaliador, u.email
	FROM usuario u
    INNER JOIN avaliador a ON u.id_usuario = a.fk_usuario 
    INNER JOIN avaliador_sessao avs ON avs.fk_avaliador = a.fk_usuario 
    WHERE avs.status = 1
    ORDER BY u.id_usuario  ";
  $result_select = runSQL($sql_selecionar_avaliadores);

  //Para cada Avaliador.
  while ($row = mysql_fetch_array($result_select)) {

    $id_avaliador = $row["id_usuario"];
    $nome = $row["nome_avaliador"];
    $to = $row["email"];

    $mensagem = "Prezado(a) avaliador(a),

Favor desconsiderar o email anterior, relativo à 13ª Mostra. Considere este email.

INSTRUÇÕES DE CHEGADA NO EVENTO:

http://mostra.poa.ifrs.edu.br/2013/site/arquivos/instrucoes_de_chegada_dos_avaliadores_mostra_2013.pdf

Quando chegar ao IFRS Câmpus Porto Alegre para realizar a avaliação dos trabalhos da 14ª Mostra, deve retirar seu material (com bloco e caneta) e seu crachá ns sala dos Avaliadores (201). Neste momento também será disponibilizado seu certificado como avaliador. 

De posse do material, pode dirigir-se diretamente ao local em que ocorrerão as apresentações.

A listagem de avaliadores estará com o segurança do estacionamento, dessa forma quem for utilizar o mesmo deverá se identificar na chegada.

Apresentações orais:

Caso seja avaliador(a) das apresentações orais procure pela sala de aula correspondente à sua sessão. Lá, você encontrará um membro da comissão organizadora do evento (coordenador de sessão), o qual lhe entregará os resumos dos trabalhos, bem como, com as fichas de avaliação. 


Ao término da sessão, as fichas devidamente preenchidas e assinadas, deverão ser entregues para o coordenador de sessão.

Apresentações de pôster:

Caso seja avaliador(a) das apresentações de pôster dirija-se à sala 201(sala dos avaliadores) e identifique-se. Você receberá os resumos dos trabalhos, bem como, as fichas de avaliação e poderá, então, dirigir-se ao espaço cultural onde os pôsteres estarão expostos.

Ao término da avaliação, as fichas devidamente preenchidas e assinadas, deverão ser entregues na sala 205 (sala da Comissão Organizadora).

Qualquer dúvida poderá ser esclarecida na sala da comissão organizadora (205) ou com os voluntários identificados com a camiseta do evento.

A sala 201 está destinada aos avaliadores, para que possam realizar a leitura dos resumos e finalizar suas avaliações com a devida privacidade e comodidade. 

Atenciosamente,
Comissão Organizadora
14ª Mostra de Pesquisa, Ensino e Extensão
IFRS - Câmpus Porto Alegre";

    $envia = mail("$to", "$assunto", "$mensagem", "from:mostra@poa.ifrs.edu.br");
    //$envia = true;
    if ($envia == true) {
      echo "Para: $to \n";
      echo "Assunto: $assunto \n";
      echo "Mensagem: $mensagem \n <br><br>";
    } else {
      echo "Erro:" . $to . " - " . $mensagem;
    }
  }//avaliadores
}

##############################################################################################################################
else if (isset($_POST["option"]) && ($_POST["option"] == "enviar_email_avaliadores_4")) {

  $assunto = "Mostra IFRS - Poa: Agradecimento Avaliador";

  $sql_selecionar_avaliadores = "SELECT DISTINCT u.id_usuario, u.nome as nome_avaliador, u.email
	FROM usuario u
    INNER JOIN avaliador a ON u.id_usuario = a.fk_usuario 
	WHERE u.id_usuario NOT IN 
    (select u2.id_usuario from usuario u2 
    INNER JOIN avaliador_sessao avs ON avs.fk_avaliador = u2.id_usuario
    )
    ORDER BY u.id_usuario;";

  $result_select = runSQL($sql_selecionar_avaliadores);

  //Para cada Avaliador.
  while ($row = mysql_fetch_array($result_select)) {

    $id_avaliador = $row["id_usuario"];
    $nome = $row["nome_avaliador"];
    $to = $row["email"];

    $mensagem = "Prezado(a) avaliador(a),
 
A Comissão Organizadora agradece sua disponibilidade e interesse em colaborar como avaliador(a) em nossa 14ª  Mostra de Pesquisa, Ensino e Extensão do IFRS, Porto Alegre.
 
Comunicamos que, nesta edição, o número de avaliadores inscritos excedeu as sessões de apresentação de trabalhos e por isso, não tivemos a oportunidade de alocá-lo como avaliador(a).
 
Esperamos contar com sua participação em outra oportunidade.
 
Atenciosamente,

Comissão Organizadora
14ª Mostra de Pesquisa, Ensino e Extensão
IFRS - Câmpus Porto Alegre";


    //$to = "alex.gonsales@poa.ifrs.edu.br";
    //$envia = mail("$to", "$assunto", "$mensagem", "from:mostra@poa.ifrs.edu.br");
    $envia = true;
    if ($envia == true) {
      echo "Para: $to \n";
      echo "Assunto: $assunto \n";
      echo "Mensagem: $mensagem \n <br><br>";
    } else {
      echo "Erro:" . $to . " - " . $mensagem;
    }
  }//avaliadores
}

##############################################################################################################################
else if (isset($_POST["option"]) && ($_POST["option"] == "enviar_email_autores_orientadores_1")) {

  $status = STATUS_TRAB_ACEITO;

  $assunto = "Mostra IFRS POA 2013 - Verificação de autores e orientadores.";

  $sql_seleciona_trabalhos = "SELECT * FROM trabalho t WHERE t.status = " . $status . " ORDER BY t.id_trabalho";

  $executa_selecao_trab = runSQL($sql_seleciona_trabalhos);

  while ($row = mysql_fetch_array($executa_selecao_trab)) {
    $mensagem = "Prezado(s) autor(es) e orientador(es) do trabalho \n";
    $mensagem .= "ID: " . $row["id_trabalho"] . ",\n";
    $mensagem .= "Título: " . $row["titulo_ordenar"] . "\n";
    $mensagem .= "Lembramos que: segundo o regulamento, apenas estudantes podem ser autores ou co-autores de trabalhos e que, professores ou técnicos administrativos podem participar apenas como orientador ou co-orientador.\n";
    $mensagem .= "Solicitamos que verifique se seu trabalho está dentro dessas especificações sob pena de ser excluído do evento.\n";
    $mensagem .= "Esta mensagem está sendo enviada a todos os autores e orientadores de trabalhos inscritos no evento.\n";
    $mensagem .="Atenciosamente,\n";
    $mensagem .="Comissão Organizadora da 14ª Mostra de Pesquisa, Ensino e Extensão do IFRS Câmpus Porto Alegre.\n";
    $mensagem .= "http://mostra.poa.ifrs.edu.br/2013/sistema";

    $busca_email_autores = "SELECT u.email FROM usuario u, trabalho_autor_curso tac WHERE tac.fk_trabalho = " . $row["id_trabalho"] . " AND u.id_usuario = tac.fk_autor ORDER BY tac.seq";
    $executa_busca_autores = runSQL($busca_email_autores);

    $to = "";
    while ($row_autores = mysql_fetch_array($executa_busca_autores)) {
      $to .= $row_autores["email"];
      $to .= ", ";
    }

    $busca_email_orientadores = "SELECT u.email FROM usuario u, trabalho_orientador_campus toc WHERE toc.fk_trabalho = " . $row["id_trabalho"] . " AND u.id_usuario = toc.fk_orientador ORDER BY toc.seq";
    $executa_busca_orientadores = runSQL($busca_email_orientadores);

    while ($row_orientadores = mysql_fetch_array($executa_busca_orientadores)) {
      $to .= $row_orientadores["email"];
      $to .= ", ";
    }

    $to = substr($to, 0, -2);
    $envia = mail("$to", "$assunto", "$mensagem", "from:mostra@poa.ifrs.edu.br");
    if ($envia == true) {
      echo "<pre>Email enviado:\n";
      echo "Para: $to \n";
      echo "Assunto: $assunto \n";
      echo "Mensagem: $mensagem \n\n</pre> <br><br>";
    } else {
      echo "<pre>Erro ao enviar email:\n";
      echo "Para: $to \n";
      echo "Assunto: $assunto \n";
      echo "Mensagem: $mensagem \n\n</pre> <br><br>";
    }
  }

  exit;
}


##############################################################################################################################
else if (isset($_POST["option"]) && ($_POST["option"] == "enviar_email_usuarios_pesquisa")) {

  $assunto = "Mostra IFRS POA 2013 - Pesquisa de Satisfação";

  $sql_seleciona_trabalhos = "SELECT id_usuario, email FROM usuario ";

  $executa_selecao_trab = runSQL($sql_seleciona_trabalhos);

  while ($row = mysql_fetch_array($executa_selecao_trab)) {
    $mensagem = "Prezado(a) participante da 14ª Mostra de Pesquisa, Ensino e Extensão do IFRS Câmpus Porto Alegre,\n";
    $mensagem .= "A Comissão Organizadora da 14ª Mostra de Pesquisa, Ensino e Extensão do IFRS Câmpus Porto Alegre está realizando uma pesquisa de satisfação referente ao evento. Por meio da sua opinião, poderemos aperfeiçoar o processo de realização do evento, na sua próxima edição. Acesse o link abaixo para responder à pesquisa. \n\n
	 https://docs.google.com/forms/d/1NyARE9OEWfXtPToEwX19LyMKS4UGVmjOopx_-IuQmIY/viewform \n
	 
	 ou \n
	 
	 http://mostra.poa.ifrs.edu.br/2013/site/html/pesquisa.php \n
	            
	 Contamos com sua colaboração.\n\n";
    $mensagem .="Atenciosamente,\n";
    $mensagem .="Comissão Organizadora da 14ª Mostra de Pesquisa, Ensino e Extensão do IFRS Câmpus Porto Alegre.\n";

    $to = $row["email"];
    $envia = mail("$to", "$assunto", "$mensagem", "from:mostra@poa.ifrs.edu.br");

    if ($envia == true) {
      echo "<pre>Email enviado:\n";
      echo "Para: $to \n";
      echo "Assunto: $assunto \n";
      echo "Mensagem: $mensagem \n\n</pre> <br><br>";
    } else {
      echo "<pre>Erro ao enviar email:\n";
      echo "Para: $to \n";
      echo "Assunto: $assunto \n";
      echo "Mensagem: $mensagem \n\n</pre> <br><br>";
    }
  }//while

  exit;
}

##############################################################################################################################
else if (isset($_POST["option"]) && ($_POST["option"] == "logout")) {
  session_destroy();
  echo 1;
}

##############################################################################################################################
else if (isset($_POST["option"]) && ($_POST["option"] == "teste")) {

  echo 1;
  //mail("alexdg2@yahoo.com.br, alex.gonsales@poa.ifrs.edu.br", "assunto11", "mensagem", "from:mostra@poa.ifrs.edu.br");

  echo 2;
  //mail("alexkwmtdg12yz3456@yhesc345e.com.br, alex.gonsales@poa.ifrs.edu.br", "assunto22", "mensagem2", "from:mostra@poa.ifrs.edu.br");

  echo 3;
  //mail("alexdg2@yahoo.com.br, alex.gonsales@poa.ifrs.edu.br", "assunto3", "mensagem33", "from:mostra@poa.ifrs.edu.br");

  echo 4;
  echo 1;
}
?>