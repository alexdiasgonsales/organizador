<?php
session_start();

include("../../../conexao.php");
include("../../../funcoes.php");

if(!(isset($_SESSION['id_administracao']))) {
    header("Location: index.php?diff=".elDiff());
}

if (!isset($_SESSION['adm2']))
   {
      header("Location: index.php?diff=".elDiff());
   }

$n_mens=0;
   
if (isset($_REQUEST['acao'])) {
  $acao=$_REQUEST['acao'];
      
  /***** Remover Trabalho *******************************************************/
  if ($acao=="remover_trabalho") {
		     $id_trabalho=(int)$_REQUEST['id_trabalho'];
         
			$sql_trabalho = "SELECT seq_sessao FROM trabalho WHERE id_trabalho=".$id_trabalho." ";
			$result_trabalho = mysql_query($sql_trabalho,$conexao);         
			$linha = mysql_fetch_array($result_trabalho);
			$seq = $linha['seq_sessao'];
         
			$sql_trabalho = "UPDATE trabalho SET seq_sessao = seq_sessao - 1 WHERE fk_sessao = ".
							$_SESSION['id_sessao']." AND seq_sessao > ".$seq." ";
			$result_trabalho = mysql_query($sql_trabalho,$conexao);         
         
			$sql_trabalho = "UPDATE trabalho SET seq_sessao=0, fk_sessao = null WHERE id_trabalho=".$id_trabalho." ";
			$result_trabalho = mysql_query($sql_trabalho,$conexao);
    
			$n_mens=1; // "Trabalho removido com sucesso" 
	}//$acao=="remover_trabalho"
	  
  /***** Incluir Trabalho *******************************************************/
	if ($acao=="incluir_trabalho") {
		$id_trabalho=(int)$_REQUEST['id_trabalho'];
		
    //Verificar se os orientadores estao como avaliadores na sessao.
    $sql_teste_orientador=
      "SELECT a.* 
  		FROM avaliador a, avaliador_sessao avs
    	WHERE (a.fk_usuario=avs.fk_avaliador)
      AND (avs.fk_sessao=".$_SESSION['id_sessao'].")
      AND avs.fk_avaliador IN 
      (SELECT toc.fk_orientador FROM trabalho_orientador_campus toc WHERE toc.fk_trabalho=".$id_trabalho.")";
    $result_teste_orientador = mysql_query($sql_teste_orientador,$conexao);
    $num_reg_teste_orientador = mysql_num_rows($result_teste_orientador);
    
    $n_mens = 0;
    
		if ((int)$num_reg_teste_orientador>0) {
		  $n_mens=5; // "Erro ao incluir o trabalho, um ou mais orientadores é avaliador nesta sessão" 
    }
    
    if ($n_mens == 0 ) {
		  $id_trabalho=(int)$_REQUEST['id_trabalho'];
		  $id_sessao = $_SESSION['id_sessao'];
		  $sql_trabalho="SELECT fk_modalidade FROM trabalho t WHERE t.id_trabalho=".$id_trabalho;
		  $sql_sessao="SELECT fk_modalidade FROM sessao s WHERE id_sessao=".$id_sessao;
		  $result_trabalho = mysql_query($sql_trabalho,$conexao);
      if (mysql_num_rows($result_trabalho) == 0) {
        $n_mens = 11;
      }
    }
    
    if ($n_mens == 0 ) {
      //Verificar se a modalidade do trabalho é igual à modalidade da sessao.
  			$result_sessao = mysql_query($sql_sessao,$conexao);
    		$linha_trabalho = mysql_fetch_array($result_trabalho);
      	$linha_sessao = mysql_fetch_array($result_sessao);
        if ($linha_trabalho['fk_modalidade'] != $linha_sessao['fk_modalidade']) {
          $n_mens=7; 
        }
    }
    
    if ($n_mens == 0 ) {
          $sql_data_e_hora_da_sessao = "SELECT data, hora_ini, hora_fim FROM sessao WHERE id_sessao=".$id_sessao; 
    			$data_e_hora_sessao = runSQL($sql_data_e_hora_da_sessao);
      		$linha_sessao = mysql_fetch_array($data_e_hora_sessao);
        	$data_sessao = $linha_sessao["data"];
          $inicio_sessao = $linha_sessao["hora_ini"];
  				$fim_sessao = $linha_sessao["hora_fim"];
				
          //Pega o ID do autor principal do trabalho.
  				$sql_id_autor_princ = "SELECT tac.fk_autor FROM trabalho_autor_curso tac WHERE tac.fk_trabalho =".$id_trabalho." AND tac.seq = 1";
    			$exec = runSQL($sql_id_autor_princ);
      		$linha_id_autor = mysql_fetch_array($exec);
				
          //Pega todas as sessões que esse autor é apresentador.
        	$sql_colisao_autor_princ = 
          "SELECT s.data, s.hora_ini, s.hora_fim
  				FROM sessao s, trabalho_autor_curso tac, trabalho t
    			WHERE (tac.fk_autor = ".$linha_id_autor["fk_autor"]." AND tac.seq = 1) AND t.id_trabalho = tac.fk_trabalho AND s.id_sessao = t.fk_sessao";
          $data_e_hora_autor = runSQL($sql_colisao_autor_princ);
				
          //Percorre aquela lista de sessões para ver se alguma delas conflita com o horário desta sessão.
  				while($linha_autor = mysql_fetch_array($data_e_hora_autor)) {
    				$data_autor = $linha_autor["data"];
      			$inicio_autor = $linha_autor["hora_ini"];
        		$fim_autor = $linha_autor["hora_fim"];
						if($data_autor == $data_sessao) {
    					if( ($inicio_autor >= $inicio_sessao) && ($inicio_autor < $fim_sessao) ) {
      					$n_mens = 9;
        			}
              else if( ($inicio_sessao >= $inicio_autor) && ($inicio_sessao < $fim_autor)) {
                $n_mens = 9;
              } 
            }
          }//while
    }
    
    if ($n_mens == 0) {
      //Verifica se o orientador deste trabalho é avaliador em outra sessao de mesmo horário.
        
      //Pega todas as sessoes em que o orientador principal deste trabalho é avaliador.
			$sql_colisao_orientador = 
				"SELECT s.data, s.hora_ini, s.hora_fim
				FROM sessao s, avaliador_sessao avs
				WHERE s.id_sessao = avs.fk_sessao AND avs.fk_avaliador IN ( select fk_orientador from trabalho_orientador_campus toc where toc.fk_trabalho = " .$id_trabalho . " AND toc.seq = 1 )";
      $data_e_hora_avaliador = runSQL($sql_colisao_avaliador);
      $data_e_hora_orientador = runSQL($sql_colisao_orientador);
			/*percorre sessões do orientador, em busca de colisão de horários:*/
			while($linha_orientador = mysql_fetch_array($data_e_hora_orientador)) {
				$data_orientador = $linha_orientador["data"];
				$inicio_orientador = $linha_orientador["hora_ini"];
				$fim_orientador = $linha_orientador["hora_fim"];
        if (! ( ($fim_orientador < $inicio_sessao) || ($inicio_orientador > $fim_sessao) ) ) {
          $n_mens = 12; //ATENÇÃO! operação cancelada: Orientador deste trabalho já é Avaliador em outra sessão neste mesmo horário";
        }
			}//Fim do While do Erro 12.
    }

    if ($n_mens == 0) {
      //Verifica se o orientador deste trabalho é orientador de trabalho em outra sessao de mesmo horário.
			$sql_colisao_orientador = 
  			"SELECT s.data, s.hora_ini, s.hora_fim
				FROM sessao s, trabalho t, trabalho_orientador_campus toc
				WHERE s.id_sessao = t.fk_sessao AND t.id_trabalho = toc.fk_trabalho AND toc.seq = 1 AND s.id_sessao <> ".$id_sessao." toc.fk_orientador IN 
        (select fk_orientador from trabalho_orientador_campus toc2 where toc2.fk_trabalho = ".$id_trabalho." AND toc.seq=1 ) ";
      $data_e_hora_orientador = runSQL($sql_colisao_orientador);
				
			/*percorre sessões do orientador, em busca de colisão de horários:*/
			while($linha_orientador = mysql_fetch_array($data_e_hora_orientador)) {
				$data_orientador = $linha_orientador["data"];
				$inicio_orientador = $linha_orientador["hora_ini"];
				$fim_orientador = $linha_orientador["hora_fim"];
        if (! ( ($fim_orientador < $inicio_sessao) || ($inicio_orientador > $fim_sessao) ) ) {
          $n_mens = 14; //ATENÇÃO! operação cancelada: Orientador deste trabalho é Orientador de trabalho em outra sessão neste mesmo horário";
        }
			}//Fim do While do Erro 14.
    }

    if ($n_mens == 0 ) {
	    //Não há conflito de horários, pode adicionar o trabalho.
			$id_trabalho=(int)$_REQUEST['id_trabalho'];
			$sql_trabalho = "SELECT MAX(seq_sessao) as maximo FROM trabalho WHERE fk_sessao = ".$_SESSION['id_sessao'];
 			$result_trabalho = mysql_query($sql_trabalho,$conexao);
   		$num_reg = mysql_num_rows($result_trabalho);
     	if ($num_reg > 0) {
       	$linha = mysql_fetch_array($result_trabalho);
        $maximo = $linha['maximo'];
      }
      else {
        $maximo = 0;
      }
      $maximo++;
      $sql_trabalho = "UPDATE trabalho SET seq_sessao = ".$maximo.", fk_sessao = ".$_SESSION['id_sessao'].
                      " WHERE id_trabalho = ".$id_trabalho;
      $result_trabalho = mysql_query($sql_trabalho,$conexao);
      $n_mens=2; // "Trabalho incluído com sucesso" 
    }
    
  }//$acao=="incluir_trabalho"
	  
  /***** Excluir Avaliador *******************************************************/
  if ($acao=="excluir_avaliador") {
    $fk_id_avaliador=(int)$_REQUEST['fk_id_avaliador'];
             
    $sql_avaliador = "SELECT seq FROM avaliador_sessao WHERE fk_sessao=".$_SESSION['id_sessao']." AND fk_avaliador=".$fk_id_avaliador;
  	$result_avaliador = mysql_query($sql_avaliador,$conexao);         
		$linha = mysql_fetch_array($result_avaliador);
		$seq = $linha['seq'];

             $sql_avaliador = "DELETE FROM avaliador_sessao WHERE (fk_avaliador=".$fk_id_avaliador.") AND (fk_sessao = ".$_SESSION['id_sessao'].") ";
             $result_avaliador = mysql_query($sql_avaliador,$conexao);
            
            //Modificar ordem dos avaliadores.            
            $sql_avaliador = "UPDATE avaliador_sessao SET seq = seq - 1 WHERE fk_sessao = ".
							$_SESSION['id_sessao']." AND seq > ".$seq." ";
			$result_avaliador = mysql_query($sql_avaliador,$conexao);         
             
			 $n_mens=3; // "Avaliador removido com sucesso" 
  }//excluir avaliador
	  
  /***** Incluir Avaliador *******************************************************/
	if ($acao=="incluir_avaliador") {

      $n_mens = 0;
      
      $fk_id_avaliador=(int)$_REQUEST['fk_id_avaliador'];
      $sql_teste_orientador="SELECT * FROM trabalho_orientador_campus toc
			WHERE toc.fk_orientador = ".$fk_id_avaliador."
			AND toc.fk_trabalho IN (SELECT id_trabalho 
									FROM trabalho 
									WHERE fk_sessao=".$_SESSION['id_sessao'].")";
      $result_teste_orientador = mysql_query($sql_teste_orientador,$conexao);
			$num_reg_teste_orientador = mysql_num_rows($result_teste_orientador);

			if ((int)$num_reg_teste_orientador>0) {
			  $n_mens=6; // "Erro ao incluir. O avaliador é orientador de um ou mais trabalhos nesta sessão" 
			}
      
      if ($n_mens == 0) {
				/*conferir horario da sessão:*/
				$sql_data_e_hora_da_sessao = "SELECT data, hora_ini, hora_fim FROM sessao WHERE id_sessao=".$_SESSION['id_sessao']; 
				$data_e_hora_sessao = runSQL($sql_data_e_hora_da_sessao);
				$linha_sessao = mysql_fetch_array($data_e_hora_sessao);
				$data_sessao = $linha_sessao["data"];
				$inicio_sessao = $linha_sessao["hora_ini"];
				$fim_sessao = $linha_sessao["hora_fim"];
				
				/*conferir sessões do avaliador que for inserir:*/
				$sql_colisao_avaliador = 
				"SELECT s.data, s.hora_ini, s.hora_fim
				FROM sessao s, avaliador_sessao avs
				WHERE avs.fk_avaliador = ".$fk_id_avaliador." AND s.id_sessao = avs.fk_sessao";
        $data_e_hora_avaliador = runSQL($sql_colisao_avaliador);
				
				/*percorre sessões do avaliador, em busca de colisão de horários:*/
				while($linha_avaliador = mysql_fetch_array($data_e_hora_avaliador)) {
					$data_avaliador = $linha_avaliador["data"];
					$inicio_avaliador = $linha_avaliador["hora_ini"];
					$fim_avaliador = $linha_avaliador["hora_fim"];
					if($data_avaliador == $data_sessao) {
				    if(! ( ($fim_avaliador < $inicio_sessao) || ($inicio_avaliador > $fim_sessao) ) ) {
				   	  $n_mens = 10; // ATENÇÃO! operação cancelada: avaliador já está vinculado a uma sessão neste horário.
					  }
          }
				}//Fim do While do Erro 10
      }
      
      if ($n_mens == 0) {
        //Verifica se este avaliador é orientador principal de algum trabalho em outra sessão no mesmo horário.
				$sql_colisao_orientador = 
				"SELECT s.data, s.hora_ini, s.hora_fim
				FROM sessao s, trabalho_orientador_campus toc, trabalho t
				WHERE toc.fk_orientador = ".$fk_id_avaliador." AND t.id_trabalho = toc.fk_trabalho AND s.id_sessao = t.fk_sessao AND toc.seq=1 ";
        $data_e_hora_orientador = runSQL($sql_colisao_orientador);
				
				/*percorre sessões do orientador, em busca de colisão de horários:*/
				while($linha_orientador = mysql_fetch_array($data_e_hora_orientador)) {
					$data_orientador = $linha_orientador["data"];
					$inicio_orientador = $linha_orientador["hora_ini"];
					$fim_orientador = $linha_orientador["hora_fim"];
          if (! ( ($fim_orientador < $inicio_sessao) || ($inicio_orientador > $fim_sessao) ) ) {
            $n_mens = 13; // ATENÇÃO! operação cancelada: Este Avaliador é Orientador de um trabalho em outra sessão neste mesmo horário.
          }
				}//Fim do While do Erro 13.
      }

      if ($n_mens == 0) {
        //inclui avaliador.
			  $sql_conta_num_aval = "SELECT * FROM avaliador_sessao WHERE fk_sessao=".$_SESSION['id_sessao'];
				$exec_sql = mysql_query($sql_conta_num_aval, $conexao);
				$contagem = mysql_num_rows($exec_sql);
				$contagem++;
        $sql_avaliador = "INSERT INTO avaliador_sessao (fk_avaliador,fk_sessao,seq,status) values(".$fk_id_avaliador.",".$_SESSION['id_sessao'].",".$contagem.",0) ";
        $result_avaliador = mysql_query($sql_avaliador,$conexao);
        $n_mens=4; // "Avaliador incluido com sucesso"
	    }

    }//incluir avaliador

    /***** Confirmar Avaliador *******************************************************/
    if ($acao =="confirmar_avaliador") {
		  $fk_id_avaliador=(int)$_REQUEST['fk_id_avaliador'];
      $sql_avaliador = "UPDATE avaliador_sessao SET status=1 WHERE (fk_avaliador=".
                        $fk_id_avaliador.") and (fk_sessao = ".$_SESSION['id_sessao'].") ";
      $result_avaliador = mysql_query($sql_avaliador,$conexao);
		  $n_mens=8; // "Avaliador confirmado com sucesso" 
      
      echo $sql_avaliador;
      exit(0);
    }
    
   }//isset()
 
header("Location: abrir_sessao.php?n_mens=".$n_mens."&diff=".elDiff());

?>
