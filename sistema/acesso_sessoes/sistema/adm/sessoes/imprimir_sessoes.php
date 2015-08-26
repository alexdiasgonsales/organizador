<?php
//include("../conexao.php");
//include("../funcoes.php");
// Função para converter o título para maiúsculo 20110911

 session_start();
 
if(!(isset($_SESSION['id_administracao']))) {
    header("Location: index.php?diff=".elDiff());
}

if (!isset($_SESSION['adm2']))
   {
      header("Location: index.php?diff=".elDiff());
   }

 $tabela = $_SESSION['tabela'];

 $tabela = "<html><head><meta http-equiv='Content-Type' content='text/html; charset=utf-8'><LINK rel=stylesheet type=text/css href='mostratec2.css'></head><body><div style='width:17cm;'>". $tabela;
 $tabela.="</div></body></html>";
 
require_once("../../../../dompdf6/dompdf_config.inc.php");

$local = array("::1", "127.0.0.1");
$is_local = in_array($_SERVER['REMOTE_ADDR'], $local);

if ( get_magic_quotes_gpc() )
   {
        $tabela = stripslashes($tabela);
   } 
  $dompdf = new DOMPDF();
  $dompdf->load_html($tabela);
  $dompdf->set_paper("a4","portrait");
  $dompdf->render();

  //$dompdf->stream("dompdf_out.pdf", array("Attachment" => true));
  //$dompdf->stream("dompdf_out.pdf", array("Attachment" => false));
  
  $dompdf->stream("trabalhos".".pdf", array("Attachment" => false));

  exit(0);

?>