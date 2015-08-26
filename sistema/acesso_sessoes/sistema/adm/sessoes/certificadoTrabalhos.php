<?php
session_start();

include("../../../conexao.php");
include("funcoes_sessoes.php");
require_once("../../../../dompdf6/dompdf_config.inc.php");

if(!(isset($_SESSION['id_administracao']))) {
    header("Location: index.php?diff=".elDiff());
}

$html = "<html>
    <head>
        <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />
        <style>
            *{font-size:18px;font-family: arial}
            table.border1{
               page-break-after: always;
            
            }
            .head{
              height: 220px;
              padding-left: 500px;
              padding-right: 500px;
            }
            .identificacao{
              height: 100px;
              font-weight: bold;
              vertical-align: bottom;
              padding-bottom: 15px; 
            }
            .data{
              height: 80px;
            }
            .assinatura{
              height: 120px;
              vertical-align: bottom;
            }
        </style>
    </head>";

$sql = "select t.titulo, u.nome
        from usuario u
        join autor a on (a.fk_usuario = u.id_usuario)
		inner join trabalho_autor_curso
		where a.status=1 
        order by u.nome
        ";
$rs = mysql_query($sql,$conexao);
$cont = 1;
$totalLinhas = mysql_num_rows($rs);

while($linha = mysql_fetch_array($rs)){
    if ($cont < $totalLinhas){
        $class = "border1";
    }else{
        $class = "";
    }

	$sql = "select t.titulo, u.nome
        from usuario u
        join autor a on (a.fk_usuario = u.id_usuario)
		inner join trabalho_autor_curso
		where a.status=1 
        order by u.nome
        ";

    $html .= "       
        <table class=\"".$class."\" >
            <tr>
                <td class=\"head\" colspan='2'></td>
            </tr>
            <tr>
                <td colspan='2' align=\"center\">O Instituto Federal de Educação, Ciência e Tecnologia do Rio Grande do Sul,</td>
            </tr>
            <tr>
                <td colspan='2' align=\"center\">Câmpus Porto Alegre, conforme os termos da Lei nº 9394/96 e do Decreto nº 5154/2004, certifica que</td>
            </tr>
            <tr>
                <td colspan='2' class=\"identificacao\" align=\"center\">".$linha['nome']."</td>
            </tr>
            <tr>
                <td colspan='2' align=\"center\">atuou como avaliador(a) na <i>14ª Mostra de Pesquisa, Ensino e Extensão do IFRS - Câmpus Porto Alegre</i>, realizada</td>
            </tr>
            <tr>
                <td colspan='2' align=\"center\">nos dias 04, 05 e 06 de novembro de 2013, totalizando 12 horas.</td>
            </tr>
            <tr>
                <td colspan='2' class='data' align=\"center\">Porto Alegre, ".date("j")." de Novembro de 2013.</td>
            </tr>
            <tr>
                <td class=\"assinatura\" align=\"center\">Paulo Roberto Sangoi<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Diretor Geral</td>
                <td class=\"assinatura\" align=\"center\">Cibele Schwanke <br/>Diretora de Extensão</td>
            </tr>
        </table>        
            ";
    $cont++;
}

$html .= "</body></html>";
    
    if ( get_magic_quotes_gpc() )
    {
         $html = stripslashes($html);
    } 
    $dompdf = new DOMPDF();
    $dompdf->load_html($html);
    $dompdf->set_paper("a4","landscape");
    $dompdf->render();

    //$dompdf->stream("dompdf_out.pdf", array("Attachment" => true));
    //$dompdf->stream("dompdf_out.pdf", array("Attachment" => false));

    $dompdf->stream("certificado_avaliador".".pdf", array("Attachment" => false));

    exit(0);

?>
