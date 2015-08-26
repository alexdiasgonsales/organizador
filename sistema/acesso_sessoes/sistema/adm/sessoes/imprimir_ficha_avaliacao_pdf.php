<?php

  require_once("../../../../dompdf6/dompdf_config.inc.php");
  
  $local = array("::1", "127.0.0.1");
  $is_local = in_array($_SERVER['REMOTE_ADDR'], $local);
  
  if ( get_magic_quotes_gpc() )
   {
        $var_html = stripslashes($var_html);
   } 
  $dompdf = new DOMPDF();
  $dompdf->load_html($var_html);
  $dompdf->set_paper("a4","portrait");
  $dompdf->render();

  //$dompdf->stream("dompdf_out.pdf", array("Attachment" => true));
  //$dompdf->stream("dompdf_out.pdf", array("Attachment" => false));
  
  
?>