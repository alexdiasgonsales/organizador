﻿<?php

  require_once("../../../../dompdf6/dompdf_config.inc.php");

  require_once("gera_ficha_avaliacao.php");

  $var_html="<html><head><meta http-equiv='Content-Type' content='text/html; charset=utf-8' /><style>
 p {  text-align: justify; } td {border-style:solid;border-color:#000;border-width:1px;padding:1px:margin:1px;} </style>
 </head><body style='width:210mm;margin-left:0mm;padding:0px;'>".$var_html."</body></html>";

 
  require_once("imprimir_pdf.php");

  $nome = "ficha_avaliacao_".str_pad($id_trabalho, 3, "0", STR_PAD_LEFT)."_".$nome_avaliador.".pdf";
  $dompdf->stream($nome, array("Attachment" => 0));

?>