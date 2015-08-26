<?php

/* ---------------------- Montar lista de autores/orientadores  ou com o e_mail dos mesmos ---------------------- */
function montar_lista($id_quest,$campo,$conexao)
{
	    $virgula="";
	    $lista_do_grupo_nome="";
		$indice=0;
        $tabela=array();
		$tabela[0]="tb_mostratec_autor";
		$tabela[1]="tb_mostratec_orientador"; //f_email f_nome
        while($indice<=1)
           {
                $sql_lista = "SELECT * FROM ".$tabela[$indice]." WHERE id_quest=".$id_quest." ";
                $result_lista = mysql_query($sql_lista,$conexao) or die(mysql_error());
                $num_reg_lista = mysql_num_rows($result_lista);
                while($linha_lista = mysql_fetch_array($result_lista))
                   {
		              if (trim($linha_lista[$campo])!="")
			             {
				            $lista_do_grupo_nome=$lista_do_grupo_nome.$virgula.$linha_lista[$campo];
							if (($campo!="f_email")&&($tabela[$indice]=="tb_mostratec_orientador"))
							   {
							       $lista_do_grupo_nome=$lista_do_grupo_nome."(orient)";
							   }
				            $virgula=", ";
				         }
	               }
				$indice++;
           }
        //mysql_close($conexao);
		return ($lista_do_grupo_nome);

 }

function unix_data($data)
{
   //$data no formato: aaaa-mm-dd hh:mm:ss
   //para segundos
   $segundo=(int)substr($data,17,2);
   $minuto=(int)substr($data,14,2);
   $hora=(int)substr($data,11,2);
   $dia=(int)substr($data,8,2);
   $mes=(int)substr($data,5,2);
   $ano=(int)substr($data,0,4);
   return mktime($hora,$minuto,$segundo,$mes,$dia,$ano);
}

function formata_data2($data_parm)
{
   $dias_semana = array('Domingo','Segunda-feira','Ter&ccedil;a-feira','Quarta-feira','Quinta-feira','Sexta-feira','S&aacute;bado');
   $mes_nome = array('janeiro','fevereiro','mar&ccedil;o','abril','maio','junho','julho','agosto','setembro','outubro','novembro','dezembro');
   $Data1 = unix_data($data_parm);
   $Data_array1=getdate($Data1);
   $mes_numero=(int)substr($data_parm,5,2);
   return $dias_semana[$Data_array1['wday']].", ".substr($data_parm,8,2)." de ".$mes_nome[$mes_numero-1]." de ".substr($data_parm,0,4).".";
}

function formata_data3($data)
{
  return substr($data, 8,2)."/".substr($data, 5,2)."/".substr($data, 0,4);
}

function formata_hora($hora)
{
  return substr($hora, 0, 2)."h".substr($hora, 3,2);
}

function elDiff()
   {
	  return $strdata=str_replace(" ", "",str_replace(":", "",str_replace("-", "",date("Y-m-d H:i:s"))));
   }

function inclui_zeros($numero,$tamanho)
  {
     $numero2=trim($numero);
	 $numero2=str_replace("-", "",$numero2);
	 $numero2=str_replace(".", "",$numero2);
     $tamanho1=(int)$tamanho;
     $tamanho2=strlen($numero2);
     $contador=1;
     $numero3=$numero2;
     if ($tamanho2<$tamanho1)
        {
          for($contador=$tamanho2;$contador<$tamanho1;$contador++)
             {
                $numero3="0".$numero3;
             }
        }
     return $numero3;
  }

// Funcao que verifica a presença de um cpf na tabela de usuários
// Retorno: ID ou ZERO, caso não exista o usuário
function confereExistencia ($cpf, $conexao)
{
	$query = "SELECT id_usuario
				FROM usuario
				WHERE cpf = ".$cpf;
	$sql = mysql_query($query, $conexao);
	$qnt = mysql_num_rows($sql);
	
	//CASO 01: pessoa não cadastrada: retorna ZERO
	if($qnt == 0) {
		return 0;
	//CASO 02: pessoa cadastrada: retorna ID
	} else {
		$arr = mysql_fetch_array($sql);
		$id = $arr['id_usuario'];
		return $id;
	}
}

// Funcao que verifica cadastro como 'papel' a partir de cpf
// Retorno: ID ou ZERO, caso não exista o papel
function conferePapel ($cpf, $table, $conexao)
{
	$id = confereExistencia($cpf, $conexao);
	if($id == 0) {
		return 0;
	} else {
		$query = "SELECT * 
					FROM ".$table."
					WHERE fk_usuario = ".$id;
		$sql = mysql_query($query, $conexao);
		$qnt = mysql_num_rows($sql);
		// CASO 01: Pessoa não cadastrada como 'papel'
		if($qnt == 0) {
			return 0;
		// CASO 02: Pessoa cadastrada como 'papel'
		} else {
			return $id;
		}
	}
}

// Funcao que verifica cadastro como 'papel' a partir de id
// Retorno: ID ou ZERO, caso não exista o papel

function conferePapelId ($id, $table, $conexao)
{
	$query = "SELECT * 
				FROM ".$table."
				WHERE fk_usuario = ".$id;
		$sql = mysql_query($query, $conexao);
		$qnt = mysql_num_rows($sql);
		// CASO 01: Pessoa não cadastrada como 'papel'
		if($qnt == 0) {
			return 0;
		// CASO 02: Pessoa cadastrada como 'papel'
		} else {
			return $id;
		}
}

// Funcao que seleciona linha desejada
// Retorno: array - linha da tabela com dados
function recLinha ($value, $coluna, $table, $conexao)
{
	$query = "SELECT *
				FROM ".$table."
				WHERE ".$coluna." = ".$value;
    
    $result = mysql_query($query, $conexao);
    
    $arr = mysql_fetch_array($result);
    
    return $arr;
}

//adicionado alexdg
// Função que informa quantidade de linhas de uma consulta
// Retorno: numero de linhas encontradas na consulta
function recNumLinhas($query, $conexao)
{
    $result = mysql_query($query, $conexao);
    $qnt = mysql_num_rows($result);
    return $qnt;
}

// Funcao que informa quantidade de linhas de uma consulta
// Retorno: numero de linhas encontradas na consulta

function recNumRows ($value, $coluna, $table, $conexao)
{
	$query = "SELECT *
				FROM ".$table."
				WHERE ".$coluna." = ".$value;
    
    $result = mysql_query($query, $conexao);
    
    $qnt = mysql_num_rows($result);
    
    return $qnt;
}

// Funcao que verifica se usuario é autor principal de trabalho
// Retorno: 1=positivo -1=negativo
function validaAutor($id_autor, $id_trab, $conexao) {

	$sql = "SELECT fk_autor 
			FROM trabalho_autor_curso 
			WHERE fk_trabalho=".$id_trab." 
			AND seq = 1";
	
	$query = mysql_query($sql, $conexao);
	$qnt = mysql_num_rows($query);
	
	if($qnt == 1) {
		$linha = mysql_fetch_array($query);
		if($linha["fk_autor"] == $id_autor) {
			$resp = 1;
		} else {
			$resp = -1;
		}
	} else {
		$resp = -1;
	}

	return $resp;
}

// Funcao que verifica se usuario possui acesso aos dados de trabalho
// Retorno: 1=positivo -1=negativo

function validaUserTrab($id_user, $id_trab, $conexao) {
	$sql = "SELECT * 
			FROM trabalho_autor_curso
			WHERE fk_autor=".$id_user." AND fk_trabalho=".$id_trab;
	$result = mysql_query($sql, $conexao);
	
	$sql2 = "SELECT * 
			FROM trabalho_orientador_campus
			WHERE fk_orientador=".$id_user." AND fk_trabalho=".$id_trab;
	$result2 = mysql_query($sql2, $conexao);
	
	$qnt1 = mysql_num_rows($result);
	$qnt2 = mysql_num_rows($result2);
	if($qnt1==1 || $qnt2==1){
		$str = 1;
	} else {
		$str = -1;
	}
	return $str;
}

//Funcao que retorna o MAX(seq), ou seja, o último SEQ de um trabalho da tabela CORRECOES_TRABALHO
// Retorno: -1 = erro ou o valor de MAX(seq)

function correcoes_trabalho_max_seq($id_trabalho, $conexao){
    $sql = "SELECT MAX(seq) from correcoes_trabalho WHERE fk_trabalho = ".$id_trabalho;
    $resultado = mysql_query($sql, $conexao);
    if ($resultado == false) {
      $seq = -1;
    } else {
		$linha = mysql_fetch_array($resultado);
		if ($linha == false) {
			$seq = -1;
		}
	}
    $seq = $linha["seq"];
    return $seq;
}

//Funcao que verifica se o usuário ID_USUARIO é um administrador
// Retorno: 1  = é um administrador,  -1 = não é um administrador

function testa_usuario_adm($id_usuario, $conexao) {
    $sql = "SELECT * FROM adm a ".
    "INNER JOIN usuario u ON u.id_usuario = a.fk_usuario ".
    "WHERE u.id_usuario = ".$id_usuario;
    $num = recNumLinhas($sql, $conexao);
    if ($num == 1)
      return 1; //ok
    else
      return -1; //erro
}

// Verifica se é um administrador

function testa_adm($id_admin, $conexao) {
    $sql = "SELECT * FROM adm2 WHERE id_administrador =".$id_admin;
    $num = recNumLinhas($sql, $conexao);
    if ($num == 1)
      return 1; //ok
    else
      return -1; //erro
}

//Funcao que recupera o STATUS de um trabalho
// Retorno: -1 = erro ou o STATUS do trabalho

function get_status_trabalho($id_trab, $conexao) {
    $sql = "SELECT status FROM trabalho WHERE id_trabalho = ".$id_trab;
    $resultado = mysql_query($sql, $conexao);
    if ($resultado != false) {
      $linha = mysql_fetch_array($resultado);
      $status = $linha["status"];
      return $status;
    }
    else {
      return -1;
    }
}

//Funcao que modifica o STATUS de um trabalho
// Retorno: -1 = erro, 1 = ok

function muda_status_trabalho($id_trab, $status, $conexao) {
    $sql = "UPDATE trabalho SET status = ".$status." WHERE id_trabalho = ".$id_trab;
    $resultado = mysql_query($sql, $conexao);
    if ($resultado == false) {
        return -1; //erro
    }
    else {
        return 1; //ok
    }
}


//Funcao que insere um registro na tabela CORRECOES_TRABALHO e atualiza o STATUS do TRABALHO

function insere_correcoes_trabalho($id_trab, $id_adm, $status, 
                                   $s_introducao, $s_objetivos, $s_metodologia, $resultados,  
                                   $observacoes, $observacoes_internas, $autor_ciente,
                                   $conexao) {
    $seq = correcoes_trabalho_max_seq($id_trab, $conexao);
    if ($seq == -1)
        $seq = 1; //Primeiro registro a ser adicionado.
    else
        $seq++; //Incrementa o valor do último seq adicionado.
    //Insere registro na tabela correcoes_trabalho
    $sql = "INSERT INTO correcoes_trabalho ".
    "(fk_trabalho, seq, fk_adm, datahora, status, ".
    "status_introducao, status_objetivos, status_metodologia, status_resultados, ".
    "observacoes, observacoes_internas, autor_ciente) ".
    "values (".
    $id_trab.",".
    $seq.",".
    $id_adm.",".    
    "sysdate(),".
    $datahora.",".
    $status.",".
    $s_introducao.",".
    $s_objetivos.",".
    $s_metodologia.",".
    $s_resultados.",".
    $observacoes.",".
    $observacoes_internas.",".
    $autor_ciente.") ";
    $resultado = mysql_query($sql, $conexao);
    
    muda_status_trabalho($id_trab, $status, $conexao);
}


function valida_tamanho_resumo($resumo) {
    //$num_cars = count(str_split(strip_tags(html_entity_decode($resumo))));
  
    //Tem que fazer primeiro strip_tags() para depois html_entity_decode().
    $str = html_entity_decode(strip_tags($resumo));
    //$str = strip_tags(html_entity_decode($resumo));
    $str = str_replace("\n", "", $str); 
    $str = str_replace("\r", "", $str);
    
    $array1 = array( "á", "à", "â", "ã", "ä", "é", "è", "ê", "ë", "í", "ì", "î", "ï", "ó", "ò", "ô", "õ", "ö", "ú", "ù", "û", "ü", "ç"
    , "Á", "À", "Â", "Ã", "Ä", "É", "È", "Ê", "Ë", "Í", "Ì", "Î", "Ï", "Ó", "Ò", "Ô", "Õ", "Ö", "Ú", "Ù", "Û", "Ü", "Ç" );
    $array2 = array( "a", "a", "a", "a", "a", "e", "e", "e", "e", "i", "i", "i", "i", "o", "o", "o", "o", "o", "u", "u", "u", "u", "c"
    , "A", "A", "A", "A", "A", "E", "E", "E", "E", "I", "I", "I", "I", "O", "O", "O", "O", "O", "U", "U", "U", "U", "C" ); 
    $str = str_replace( $array1, $array2, $str); 
    $num_cars = count(str_split($str));
    if($num_cars <= 3000)
        return 1;
    else
        return -$num_cars;
}

function quantidade_trabalhos_autor_principal($id_autor, $conexao) {
    $quant = recNumLinhas("SELECT fk_trabalho FROM trabalho_autor_curso WHERE fk_autor =".$id_autor." AND seq = 1", $conexao);
    return $quant;
}

function valida_modalidade_trabalho_autor($id_autor, $id_trabalho, $modalidade, $conexao){
    $quant_trab = quantidade_trabalhos_autor_principal($id_autor, $conexao);
    if ($quant_trab == 0) {
        return 0; //ok
    }
    else if ($quant_trab == 1) {
        //Tem apenas um trabalho
        //Verifica se é um trabalho diferente
        $sql = "SELECT t.id_trabalho, t.fk_modalidade FROM trabalho t ".
            "INNER JOIN trabalho_autor_curso tac ON tac.fk_trabalho = t.id_trabalho ".
            "WHERE tac.fk_autor =".$id_autor." AND tac.seq = 1";
        $resultado = mysql_query($sql, $conexao);
        $linha = mysql_fetch_array($resultado);
        $fk_trabalho = $linha["id_trabalho"];
        $modalidade_trabalho = $linha["fk_modalidade"];
        if ( ($id_trabalho!= "") && ($fk_trabalho == $id_trabalho) ) {
            //Se estiver atualizando esse trabalho ok.
            return 0; //ok
        }
        else {
            //Está inserindo outro trabalho
            if ($modalidade_trabalho != $modalidade) {
                //Se a modalidade for diferente do atual atrabalho ok.
                return 0;
            }
            else {
                //Está tentando colocar uma modalidade de um trabalho já existente.
                return -1;
            }
        }
    }
    else if ($quant_trab == 2) {
        //Já é autor de 2 trabalhos.
        //Por enquanto não é permitido mudar a modalidade.
        $sql = "SELECT t.id_trabalho, t.fk_modalidade FROM trabalho t ".
            "INNER JOIN trabalho_autor_curso tac ON tac.fk_trabalho = t.id_trabalho ".
            "WHERE tac.fk_autor =".$id_autor." AND tac.seq = 1 AND t.id_trabalho=".$id_trabalho;
        $resultado = mysql_query($sql, $conexao);
        $linha = mysql_fetch_array($resultado);
        $fk_trabalho = $linha["id_trabalho"];
        $modalidade_trabalho = $linha["fk_modalidade"];
        if ($modalidade_trabalho == $modalidade)
            return 0;//ok
        else        
            return -2;//Tentando mudar a modalidade do trabalho.
    }
    else {
        //Mais de 2 trabalhos, algum ERRO de consistência no sistema.
        return -3;
    }
}

/*-------------------------------------------------------------*/
//Verifica se o trabalho possui todos os campos ok.
//Retorno
// -1 : nao eh autor do trabalho
// -2 : modalidade nao definida.
// -3 : modalidade igual a outro trabalho.
// -4 : nao possui orientador.
//  1 : ok.
/*-------------------------------------------------------------*/
function valida_trabalho($id_autor, $id_trabalho, $conexao){
    //Verifica se eh autor do trabalho
    $valida_autor = validaAutor($id_autor, $id_trabalho, $conexao);
    if ($valida_autor <> 1){
        return -1;
    }
    else {
        //Verifica se o campo modalidade está preenchido. ???????? verificar se no banco está com default 0.
		$sql = "SELECT t.fk_modalidade	FROM trabalho t WHERE t.id_trabalho = ".$id_trabalho;
		$result = runSQL($sql);
		$str = array();
		$arr = mysql_fetch_array($result);
        $modalidade = $arr["fk_modalidade"];
        if ($modalidade < 1) {
            return -2;
        }
        else {
            //Verifica se este autor possui outro trabalho com mesma modalidade.
            $sql = "SELECT t.fk_modalidade	FROM trabalho t INNER JOIN trabalho_autor_curso tac ON t.id_trabalho=tac.fk_trabalho ".
            "WHERE t.id_trabalho <> ".$id_trabalho." AND tac.fk_autor = ".$id_autor." AND tac.seq=1 AND t.fk_modalidade=".$modalidade;
            $num_linhas = recNumLinhas($sql, $conexao);

            if ($num_linhas >= 1) {
                return -3;
            }
            else {
                //Verifica se o trabalho possui orientador.
                $sql = "SELECT * FROM trabalho t INNER JOIN trabalho_orientador_campus toc ON t.id_trabalho=toc.fk_trabalho ".
                "WHERE t.id_trabalho = ".$id_trabalho;
                $num_linhas = recNumLinhas($sql, $conexao);
                if ($num_linhas < 1){
                    return -4;
                }
                else {
                    return 1; //ok
                }
            }
        }
    }
    return -9;
}//valida_trabalho

/*
 * Funcao que verifica a partir do id do usuario
 * e da id da permissao a autorizacao do usuario 
 * para executar a acao
 */
function verificaPermissaoUsuario($usuario, $permissao){
   $sqlPerm = "select 1 from usuario_permissao
               where id_permissao = $permissao
               and fk_usuario = $usuario";
   $resultPerm = runSQL($sqlPerm);
   $nmLinhas = mysql_num_rows($resultPerm);
   return $nmLinhas;    
}

/*
 * Retorna um array com as permissoes do usuario
 */
function retornaPermissoesUsuario($usuario){
    $sql = "select id_permissao
                from permissao";
    $result = runSQL($sql);
    while ($linha = mysql_fetch_array($result)){
        $resposta[$linha['id_permissao']] = 0;
    }
    $sqlPerm = "select up.id_permissao, p.nome_permissao
                from usuario_permissao up
                inner join permissao p on (p.id_permissao = up.id_permissao)
                where up.fk_usuario = $usuario";
    $resultPerm = runSQL($sqlPerm);
    while ($linha = mysql_fetch_array($resultPerm)){
        $resposta[$linha['id_permissao']] = 1;
    }
    return $resposta;
}

?>