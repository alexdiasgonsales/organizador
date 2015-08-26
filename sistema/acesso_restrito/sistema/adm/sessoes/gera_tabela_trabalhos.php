
<?php 
    $sql_colunas = "SELECT t.id_trabalho, t.fk_tematica, t.fk_modalidade, upper(t.titulo_ordenar) as titulo, t.status, s.id_sessao, s.numero, s.nome AS nome_sessao, s.data, s.hora_ini, s.hora_fim, a.nome AS nome_area 
    FROM trabalho t 
    LEFT JOIN sessao s ON s.id_sessao = t.fk_sessao 
    LEFT JOIN tematica a ON t.fk_tematica = a.id_area 
    where t.status=2 ";
    
    if ($ordenar == 'id')
      $sql_trabalho=  $sql_colunas." order by id_trabalho;";
    if ($ordenar == 'titulo')
      $sql_trabalho=  $sql_colunas." order by titulo_ordenar;";
    else if ($ordenar == 'tematica')
      $sql_trabalho= $sql_colunas." order by a.id_area, t.fk_modalidade, s.numero;";
    else if ($ordenar == 'modalidade')
      $sql_trabalho= $sql_colunas." order by t.fk_modalidade, t.fk_tematica, s.numero;";
    else if ($ordenar == 'sessao') 
      $sql_trabalho= $sql_colunas." order by s.nome, t.fk_modalidade, t.fk_tematica, t.titulo_ordenar;";
    else if ($ordenar == 'sessao_agrupada')
      $sql_trabalho= $sql_colunas." order by s.id_sessao, t.seq_sessao, t.id_trabalho;";

  $result_trabalho= mysql_query($sql_trabalho,$conexao);
  $num_reg_trabalho= mysql_num_rows($result_trabalho);
  $linha_trabalho= mysql_fetch_array($result_trabalho);

  $tematica = "";
  $modalidade = "";
  $status = "";
  $sessao = "";
  $i = $num_reg_trabalho;

  //Tabela com os resultados a ser impresso.
  $tabela = "";
  
  $cabecalho_tabela ="<tr>";
  $num_cols = 1;
  if (isset($col_id)) {
    $cabecalho_tabela.= "<td align=center width=30>ID</td>";
    $num_cols++;
    }
  if (isset($col_tematica)) {
    $cabecalho_tabela.= "<td align=center width=30>Área</td>";
    $num_cols++;
    }
  if (isset($col_modalidade)){
    $cabecalho_tabela.= "<td align=center width=30>Mod</td>";
    $num_cols++;
    }
  $cabecalho_tabela.= "<td>Título</td>";
  if (isset($col_status)){
    $cabecalho_tabela.= "<td align=center width=30>Status</td>";
    $num_cols++;
    }
  if (isset($col_sessao)){
    $cabecalho_tabela.= "<td align=center width=30>Sessão</td></tr>";
    $num_cols++;
    }
  
  $tabela.= "<table border=1 cellpadding=3 cellspacing=0 width=100%>";
  if ($ordenar == 'id') {
      $tabela.= $cabecalho_tabela;
  }
  if ($ordenar == 'titulo') {
      $tabela.= $cabecalho_tabela;
  }
  if ($ordenar == 'sessao') {
      $tabela.= $cabecalho_tabela;
  }
  
  while ($i > 0) {
    if ($ordenar =='tematica') {
      if ($tematica != $linha_trabalho['fk_tematica']) {
        $tematica = $linha_trabalho['fk_tematica'];
        $tabela.= "<tr><td colspan=".$num_cols."><h2>".$linha_trabalho['nome_area']."</h2></td></tr>";
        $tabela.= $cabecalho_tabela;
      } 
    }
    else if ($ordenar =='modalidade') {
      if ($modalidade != $linha_trabalho['fk_modalidade']) {
        $modalidade = $linha_trabalho['fk_modalidade'];
        if ($modalidade == "1" )
          $tabela.= "<tr><td colspan=".$num_cols."><h2>Apresentação Oral</h2></td></tr>";
        else if ($modalidade == "2" )
          $tabela.= "<tr><td colspan=".$num_cols."><h2>Apresentação Pôster</h2></td></tr>";
        else $tabela.= "<tr><td colspan=6><h2>----------</h2></td></tr>";
        $tabela.= $cabecalho_tabela;
      }    
    }
    else if ($ordenar =='sessao_agrupada') {
      if ($modalidade != $linha_trabalho['fk_modalidade']) {
        $modalidade = $linha_trabalho['fk_modalidade'];
        if ($modalidade == "1" )
          $tabela.= "<tr><td align=center bgcolor=#CCCCCC colspan=".$num_cols."><h2 style='border-bottom:none;'>Modalidade de Apresentação Oral</h2></td></tr>";
        else if ($modalidade == "2" )
          $tabela.= "<tr><td align=center bgcolor=#CCCCCC colspan=".$num_cols."><h2 style='border-bottom:none;'>Modalidade de Apresentação Pôster</h2></td></tr>";
        else $tabela.= "<tr><td colspan=6><h2>----------</h2></td></tr>";
      }    
      if ($sessao != $linha_trabalho['nome_sessao']) {
        $sessao = $linha_trabalho['nome_sessao'];
        $tabela.= "<tr><td colspan=".$num_cols."><h2 style='border-bottom:none;'>Sessão ".$linha_trabalho['nome_sessao'].
        ": dia ".formata_data3($linha_trabalho['data']).
        " das ".formata_hora($linha_trabalho['hora_ini']).
        " às ".formata_hora($linha_trabalho['hora_fim']).
        "</h2></td></tr>"; 
        $avaliadores = "";
        $sql_avaliadores = "SELECT u.nome from usuario u INNER JOIN avaliador_sessao avs ON avs.fk_avaliador = u.id_usuario 
        WHERE avs.fk_sessao =".$linha_trabalho["id_sessao"]." ORDER BY avs.seq";
        $result_avaliadores = mysql_query($sql_avaliadores,$conexao);
        //$num_reg_trabalho= mysql_num_rows($result_trabalho);
		if ($result_avaliadores != false)
			while ($linha_avaliadores= mysql_fetch_array($result_avaliadores)){
				$avaliadores .= $linha_avaliadores["nome"].", ";
			}
        $avaliadores = substr($avaliadores, 0, -2);
        if (isset($col_avaliadores)) {
            $tabela .= "<tr><td colspan=".$num_cols.">Avaliadores: ".$avaliadores."</td></tr>";
        }
              
        $tabela.= $cabecalho_tabela;
      }    
    }
    
    $id_trabalho = $linha_trabalho['id_trabalho'];
    $titulo = $linha_trabalho['titulo'];
    $tematica = $linha_trabalho['fk_tematica'];
    $modalidade = $linha_trabalho['fk_modalidade'];
    $status = $linha_trabalho['status'];
    
    if ($modalidade == "1") 
      $texto_modalidade = "O";
    else if ($modalidade == "2") 
      $texto_modalidade = "P";

    if ($status == 0) 
      $texto_status = "-";
    else if ($status == 1) 
      $texto_status = "P";
    else if ($status == 2) 
      $texto_status = "A";
    else if ($status == 3) 
      $texto_status = "C";
    else if ($status == 5) 
      $texto_status = "R";
    else 
      $texto_status = "?";
      
    $linha = "<tr>";

    $autores = "";
    
    if (isset($col_autor_principal)) {
        $sql_autores="select tac.fk_autor, u.nome from usuario u
        INNER JOIN trabalho_autor_curso tac ON tac.fk_autor = u.id_usuario 
        where tac.fk_trabalho = ".$id_trabalho." ORDER BY tac.seq";
        $result_autores= mysql_query($sql_autores,$conexao);
        //if ( mysql_num_rows($result_autores) > 0);
        while ($linha_autores= mysql_fetch_array($result_autores) ) {
            $autores .= $linha_autores["nome"].", ";
            //break;
            if (!isset($col_coautores)) {
              break;
            }
        }
        //Remove os dois últimos caracteres.
        $autores = substr($autores, 0, -2);
    }

    $orientadores = "";
    if (isset($col_orientadores)) {
        $sql_orientadores="select toc.fk_orientador, u.nome from usuario u
        INNER JOIN trabalho_orientador_campus toc ON toc.fk_orientador = u.id_usuario 
        where toc.fk_trabalho = ".$id_trabalho." ORDER BY toc.seq";
        $result_orientadores= mysql_query($sql_orientadores,$conexao);
        //if ( mysql_num_rows($result_autores) > 0);
        while ($linha_orientadores= mysql_fetch_array($result_orientadores) ) {
            $orientadores .= $linha_orientadores["nome"].", ";
            //break;
            if (!isset($col_orientadores)) {
              break;
            }
        }
        //Remove os dois últimos caracteres.
        $orientadores = substr($orientadores, 0, -2);
    }
    
    if (isset($col_id))
      $linha.="<td>".
      str_pad($linha_trabalho["id_trabalho"],3,"0", STR_PAD_LEFT)."</td>";
    if (isset($col_tematica))
      $linha.="<td align=center>".$tematica."</td>";
    if (isset($col_modalidade))
      $linha.="<td align=center>".$texto_modalidade."</td>";

    $linha.="<td>".$titulo;
    if (isset($col_autor_principal))
      $linha.= " (Autores: ".$autores.")";
    if (isset($col_orientadores))
      $linha.= " (Orientadores: ".$orientadores.")";
    $linha.="</td>";
    
    if (isset($col_status))    
      $linha.="<td align=center><font size=4>".$texto_status."</font></td>";
    if (isset($col_sessao))    
      $linha.="<td align=center>".$linha_trabalho['nome_sessao']."</td>";
    $linha.="</tr>";
    //"<td align=center><a href='trabalho_txt.php?fk_id_trabalho=".$id_trabalho."'>---</a></td>".
    $tabela.= $linha;

    //$linha_trabalho["id_trabalho"]."</a><input type=text style='width:1500px' value='".$titulo."'><br>"; 
    $i--;
    $linha_trabalho= mysql_fetch_array($result_trabalho);
  }
  $tabela.= "</table>";
  
?>
