<?php
    require_once '../../../conexao.php';



            $sql_nome = mysql_query("SELECT t.id_trabalho, t.titulo_ordenar, u.nome, u.email, u2.nome, u2.email, t.resumo, t.palavra1, t.palavra2, t.palavra3, t.apoiadores, c.nome AS curso, cp.nome AS campus, ins.nome AS instituicao
										FROM trabalho t
										INNER JOIN trabalho_autor_curso tac ON t.id_trabalho = tac.fk_trabalho
										INNER JOIN autor_curso ac ON tac.fk_autor = ac.fk_autor
										INNER JOIN autor a ON ac.fk_autor = a.fk_usuario
										INNER JOIN usuario u ON a.fk_usuario = u.id_usuario
										INNER JOIN usuario u1 ON a.fk_usuario = u1.id_usuario
										INNER JOIN curso c ON c.id_curso = ac.fk_curso
										INNER JOIN campus cp ON c.fk_campus = cp.id_campus
										INNER JOIN instituicao ins ON cp.fk_instituicao = ins.id_instituicao

										INNER JOIN sessao s ON t.fk_sessao = s.id_sessao
										INNER JOIN avaliador_sessao avs ON s.id_sessao = avs.fk_sessao
										INNER JOIN avaliador av ON avs.fk_avaliador = av.fk_usuario
										INNER JOIN usuario u2 ON av.fk_usuario = u2.id_usuario

										WHERE t.status = 4 and tac.seq=1 AND ac.seq=1 AND avs.seq=1");


    $total = "";
    $var_html = "";
	$cont = mysql_num_rows($sql_nome);
        if($cont == 0)
            echo "Não há Trabalhos Aceitos.";
        else 
            {


                while ($linha1 = mysql_fetch_array($sql_nome)) 
                {

				$_REQUEST['id_trabalho']=$linha1['id_trabalho'];

                //*********** Incluir o arquivo que gera os HTMLs ************\\
                    

                    include "gera_trabalho.php";
                //*********** Acumular HTML criadas na variável $total ************\\
                    
                    $total = $total.$var_html;
                    
                    $var_html="<html><head><meta http-equiv='Content-Type' content='text/html; charset=utf-8'><style> p {  text-align: justify; } </style></head><body>";

                //*********** Transformar a variável $total para $var_html novamente ************\\

                    $var_html.= $total;

                    $var_html.="</body></html>";

                    include "imprimir_pdf.php";
                    
                    
  					$nome = "trab_".str_pad($id_trabalho, 3, "0", STR_PAD_LEFT).".pdf";

					    $output = $dompdf->output();
					    $file_to_save = './arquivos_pdf/'.$nome;
					    file_put_contents($file_to_save, $output);
					    $var_html = "";
					    $total = "";

                }
					    echo '<script>alert("Todos os trabalhos foram salvos no diretório <arquivos_pdf> ");</script>';
            }
?>