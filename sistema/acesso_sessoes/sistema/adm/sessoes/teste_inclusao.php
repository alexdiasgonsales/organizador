<?php
	  
	  
      /***** Incluir Avaliador *******************************************************/
	  if ($acao=="incluir_avaliador") {
	  		//***********copiar esta consulta***********
 		     $fk_id_avaliador=(int)$_REQUEST['fk_id_avaliador'];
 		     $fk_id_orientador=(int)$_REQUEST['fk_id_orientador'];
			 $sql_orientador="SELECT * FROM trabalho_orientador_campus toc
			 WHERE toc.fk_orientador = ".$fk_id_avaliador."
			 AND toc.fk_trabalho IN (SELECT id_trabalho 
									FROM trabalho 
									WHERE fk_sessao=".$_SESSION['id_sessao'].")";
             $result_orientador = mysql_query($sql_orientador,$conexao);
			 $num_reg_orientador = mysql_num_rows($result_orientador);

			 if ((int)$num_reg_orientador<=0) { 
				/*conferir horario da sessão:*/
				$sql_data_e_hora_da_sessao = "SELECT data, hora_ini, hora_fim FROM sessao WHERE id_sessao=".$_SESSION['id_sessao']; 
				$data_e_hora_sessao = runSQL($sql_data_e_hora_da_sessao);
				$linha_sessao = mysql_fetch_array($data_e_hora_sessao);
				$data_sessao = $linha_sessao["data"];
				$inicio_sessao = $linha_sessao["hora_ini"];
				$fim_sessao = $linha_sessao["hora_fim"];
				
				/*conferir sessões do avaliador que for inserir:*/
				$sql_colisao_orientador = 
				"SELECT s.data, s.hora_ini, s.hora_fim
				FROM sessao s, trabalho_orientador_campus toc
				WHERE toc.fk_ = ".$fk_id_orientador." AND s.id_sessao = avs.fk_sessao";
                $data_e_hora_orientador = runSQL($sql_colisao_orientador);
				
				/*percorre sessões do avaliador, em busca de colisão de horários:*/
				while($linha_avaliador = mysql_fetch_array($data_e_hora_avaliador)) {
					$data_avaliador = $linha_avaliador["data"];
					$inicio_avaliador = $linha_avaliador["hora_ini"];
					$fim_avaliador = $linha_avaliador["hora_fim"];
	
					if($data_avaliador == $data_sessao) {
						/*mesmo horário: erro.*/
						if($inicio_avaliador == $inicio_sessao) {
							$n_mens = 10;
						/*esta sessão começa depois:*/
						} else if($inicio_sessao > $inicio_avaliador) {
							/*fim da outra sessão é depois do início dessa: colide!*/
							if($fim_avaliador > $inicio_sessao)
								$n_mens = 10;
						/*esta sessão começa antes:*/
						} else {
							/*fim desta sessão é depois do começo da outra: colide!*/
							if($fim_sessao > $inicio_avaliador)
								$n_mens = 10;
						}
					}
						
				}//while
		
				if($n_mens != 10) {

				   if (!(($fim_avaliador < $inicio_sessao) || ($inicio_avaliador > $fim_sessao))) {
				   	$n_mens = 13; //ATENÇÃO! operação cancelada: Este Avaliador é Orientador de um trabalho em outra sessão neste mesmo horário.
				   }
				   else {
                   //inclui avaliador.
				   $sql_conta_num_aval = "SELECT * FROM avaliador_sessao WHERE fk_sessao=".$_SESSION['id_sessao'];
				   $exec_sql = mysql_query($sql_conta_num_aval, $conexao);
				   $contagem = mysql_num_rows($exec_sql);
				   $contagem++;
                   $sql_avaliador = "INSERT INTO avaliador_sessao (fk_avaliador,fk_sessao,seq,status) values(".$fk_id_avaliador.",".$_SESSION['id_sessao'].",".$contagem.",0) ";
                   $result_avaliador = mysql_query($sql_avaliador,$conexao);
			       $n_mens=4; // "Avaliador incluido com sucesso"
			       }//13
				}//10
			
			} else {
			       $n_mens=6; // "Erro ao incluir o avaliador, é orientador de um ou mais trabalhos nesta sessão"
			       }//else (num_reg_orientador>0)
	}//incluir avaliador

	?>





 		     $fk_id_avaliador=(int)$_REQUEST['fk_id_avaliador'];
			 $sql_teste_orientador="SELECT * FROM trabalho_orientador_campus toc
			 WHERE toc.fk_orientador = ".$fk_id_avaliador."
			 AND toc.fk_trabalho IN (SELECT id_trabalho 
									FROM trabalho 
									WHERE fk_sessao=".$_SESSION['id_sessao'].")";
             $result_teste_orientador = mysql_query($sql_teste_orientador,$conexao);
			 $num_reg_teste_orientador = mysql_num_rows($result_teste_orientador);