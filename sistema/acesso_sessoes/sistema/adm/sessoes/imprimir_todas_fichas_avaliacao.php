<?php
    require_once '../../../conexao.php';



            $sql_nome = mysql_query("SELECT  m.nome AS Modalidade, s.id_sessao, t.id_trabalho,
             t.titulo_ordenar AS Titulo, ar.nome AS area, c.nome AS Categoria, t.nivel AS Nivel, 
             u.nome AS Nome_Autor, u1.nome AS Nome_Avaliador, u1.id_usuario as id_avaliador
            
            FROM sessao s

            INNER JOIN trabalho t ON s.id_sessao = t.fk_sessao
            INNER JOIN trabalho_autor_curso ta ON t.id_trabalho = ta.fk_trabalho
            INNER JOIN autor_curso ac ON ta.fk_autor = ac.fk_autor AND ta.fk_curso = ac.fk_curso
            INNER JOIN autor au ON ac.fk_autor = au.fk_usuario
            INNER JOIN usuario u ON au.fk_usuario = u.id_usuario

            INNER JOIN avaliador_sessao avs ON s.id_sessao = avs.fk_sessao
            INNER JOIN avaliador a ON avs.fk_avaliador = a.fk_usuario
            INNER JOIN usuario u1 ON a.fk_usuario = u1.id_usuario

            INNER JOIN modalidade m ON t.fk_modalidade = m.id_modalidade
            INNER JOIN categoria c ON t.fk_categoria = c.id_categoria
            INNER JOIN AREA ar ON t.fk_area = ar.id_area

            WHERE ta.seq = 1 ");


    $total = "";
    $var_html = "";
	$cont = mysql_num_rows($sql_nome);
        if($cont == 0)
            echo "Não há Avaliadores Aceitos.";
        else 
            {


			$i = 1;
                while ($linha1 = mysql_fetch_array($sql_nome)) 
                {
				//$linha1 = mysql_fetch_array($sql_nome);
				//$i++;
				//if (i > 1 ) 
				  //break;
                $_REQUEST['id_sessao']=$linha1['id_sessao'];
                $_REQUEST['id_trabalho']=$linha1['id_trabalho'];
                $_REQUEST['id_avaliador']=$linha1['id_avaliador'];

                //*********** Incluir o arquivo que gera os HTMLs ************\\
                    

                    include "gera_ficha_avaliacao.php";
                //*********** Acumular HTML criadas na variável $total ************\\
                    $total = $total.$var_html;

                }

                //*********** Transformar a variável $total para $var_html novamente ************\\


                    $var_html="<!DOCTYPE html><head><meta http-equiv='Content-Type' content='text/html; charset=utf-8' /><style>
                            p {  text-align: justify; } td {border-style:solid;border-color:#000;border-width:1px;padding:1px:margin:1px;} </style>
                            </head><body style='width:210mm;margin-left:0mm;padding:0px;'>";

                    $var_html.= $total;

                    $var_html.="</body></html>";

                    include "imprimir_pdf.php";
                    
                    $nome = "Todas_Fichas_Avaliacao.pdf";
                    $dompdf->stream($nome, array("Attachment" => 0));
            }
?>