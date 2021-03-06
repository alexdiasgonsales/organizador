<?php
session_start();

include("../../../conexao.php");
include("funcoes_sessoes.php");
require_once("../../../../dompdf6/dompdf_config.inc.php");
/*
if(!(isset($_SESSION['id_administracao']))) {
    header("Location: index.php?diff=".elDiff());
}*/
$html = "<html>
    <head>
        <title>Trabalhos nas sessões por turno</title>
        <style>
            table.borda1{
                page-break-after: always;
                margin-bottom: 10px;
            }
            table.borda1 td{
                
                margin:0;
                
            }
        </style>
        <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />
    </head>
    <body>
        <div id=\"conteudo\">
            <div id=\"cont\">";


    $sql = "SELECT s.id_sessao, s.numero, s.nome_sala, s.nome AS nome_sessao, date_format(s.data, '%d/%c/%Y') as data,
              case s.fk_modalidade when 1 then 'Oral' else 'Pôster' end as modalidade,
              date_format(s.hora_ini, '%H:%i') as hora_ini, date_format(s.hora_fim,'%H:%i') as hora_fim 
              FROM sessao s
              ORDER BY s.id_sessao";

    $rs = mysql_query($sql, $conexao);
    $html .= "<table class=\"borda1\" \"width: 90%\">";
    while($linha = mysql_fetch_array($rs)){
        
        /*
         * verificar o turno da sessao
         */
        /*
        if($linha['hora_ini'] < 12){
          $indManha = true;
        }else{
          $indManha = false;
        }
        if ($auxTurno != $indManha){
            $auxTurno = $indManha;
            if(!$fL)//apenas para controle de exibicao
              $html .= "</table><table class=\"borda1\">";
            
        }*/
        $avaliadores = "";
        /* Recupera avaliadores da sesssao */
        $sql_avaliadores = "SELECT u.nome from usuario u INNER JOIN avaliador_sessao avs ON avs.fk_avaliador = u.id_usuario 
        WHERE avs.fk_sessao =".$linha["id_sessao"]." ORDER BY avs.seq";
        $result_avaliadores = mysql_query($sql_avaliadores,$conexao);
        //$num_reg_trabalho= mysql_num_rows($result_trabalho);
        if ($result_avaliadores != false)
        while ($linha_avaliadores= mysql_fetch_array($result_avaliadores)){
                $avaliadores .= $linha_avaliadores["nome"].", ";
        }
        $avaliadores = substr($avaliadores, 0, -2);
        
        $html .= "<tr><td colspan=4><h3>Sessão ".$linha['id_sessao'].". Sala ".$linha['nome_sala'].". Dia ".$linha['data'].". Das ".
                    $linha['hora_ini']."h às ".$linha['hora_fim']."h</h3></td></tr>";
        
        
        //$html .= "<tr><td><b>ID</b></td><td><b>Título</b></td><td><b>Autores</b></td><td><b>Orientadores</b></td></tr>";
        /*Recupera trabalhos da sessao*/
        $sql_trabalho = "select id_trabalho, titulo_ordenar as titulo
                         from trabalho
                         where fk_sessao = ".$linha['id_sessao'];
        
        $rs_trabalhos = mysql_query($sql_trabalho, $conexao);
       
                
        while ($linha_trabalho = mysql_fetch_array($rs_trabalhos)){
            /*Recupera autores do trabalho*/
            $sql_autores="select tac.fk_autor, u.nome from usuario u
            INNER JOIN trabalho_autor_curso tac ON tac.fk_autor = u.id_usuario 
            where tac.fk_trabalho = ".$linha_trabalho['id_trabalho']." ORDER BY tac.seq";
            $result_autores= mysql_query($sql_autores,$conexao);
            //if ( mysql_num_rows($result_autores) > 0);
            $autores = "";
            while ($linha_autores= mysql_fetch_array($result_autores) ) {
                $autores .= "<tr><td>".$linha_autores["nome"]."</td><td colspan=3>______________________________</td></tr> ";
            }
            

            /* Recupera orientadores */
            $orientadores = "";

            $sql_orientadores="select toc.fk_orientador, u.nome from usuario u
            INNER JOIN trabalho_orientador_campus toc ON toc.fk_orientador = u.id_usuario 
            where toc.fk_trabalho = ".$linha_trabalho['id_trabalho']." ORDER BY toc.seq";
            $result_orientadores= mysql_query($sql_orientadores,$conexao);
            //if ( mysql_num_rows($result_autores) > 0);
            while ($linha_orientadores= mysql_fetch_array($result_orientadores) ) {
                $orientadores .= "<tr><td>".$linha_orientadores["nome"]."</td><td colspan=3>______________________________</td></tr>";
            }
            
            
            $html .= "<tr><td colspan=2><b>".$linha_trabalho['id_trabalho']." - ".$linha_trabalho['titulo']."</b></td>";            
            $html .= $autores;
            $html .= $orientadores;    
            $html .= "<tr><td colspan=4><br/></td></tr>";
            
        }
        
        //$fL = false;
        
    }
    $html .= "</table></div</div></body></html>";
    
    if ( get_magic_quotes_gpc() )
    {
         $html = stripslashes($html);
    } 
    $dompdf = new DOMPDF();
    $dompdf->load_html($html);
    $dompdf->set_paper("a4","portrait");
    $dompdf->render();

    //$dompdf->stream("dompdf_out.pdf", array("Attachment" => true));
    //$dompdf->stream("dompdf_out.pdf", array("Attachment" => false));

    $dompdf->stream("trabalhos".".pdf", array("Attachment" => false));

    exit(0);
  ?>
