<?php

define('QUANT_MAX_CARS_RESUMO', 3000);

define("STATUS_TRAB_PENDENTE",    0);
define("STATUS_TRAB_ENVIADO",     1);
define("STATUS_TRAB_VALIDADO",    2);
define("STATUS_TRAB_INVALIDADO",  3);
define("STATUS_TRAB_ACEITO",      4);
define("STATUS_TRAB_CORRIGIR",    5);
define("STATUS_TRAB_EM_CORRECAO", 6);
define("STATUS_TRAB_CORRIGIDO",   7);
define("STATUS_TRAB_RECUSADO",    8);

$arr_status_trab = array();
$arr_status_trab[0] = "Pendente";
$arr_status_trab[1] = "Enviado";
$arr_status_trab[2] = "Validado";
$arr_status_trab[3] = "Invalidado";
$arr_status_trab[4] = "Aceito";
$arr_status_trab[5] = "Corrigir";
$arr_status_trab[6] = "Em Correção";
$arr_status_trab[7] = "Corrigido e Enviado";
$arr_status_trab[8] = "Recusado";

$arr_status_trab_completo = array();
$arr_status_trab_completo[0] = "Trabalho pendente (autor principal deve entrar no sistema e confirmar o envio do trabalho).";
$arr_status_trab_completo[1] = "Trabalho enviado (orientador deve entrar no sistema e efetuar a validação do trabalho).";
$arr_status_trab_completo[2] = "Trabalho validado pelo orientador (aguardando homologação da comissão organizadora).";
$arr_status_trab_completo[3] = "Trabalho invalidado pelo orientador.";
$arr_status_trab_completo[4] = "Trabalho foi aceito para apresentação no evento. Aguardar publicação da data de apresentação.";
$arr_status_trab_completo[5] = "Trabalho à corrigir (autor deve efetuar correções).";
$arr_status_trab_completo[6] = "Trabalho em correção (autor está efetuando as correções).";
$arr_status_trab_completo[7] = "Trabalho corrigido e enviado (aguardando homologação da comissão organizadora).";
$arr_status_trab_completo[8] = "Trabalho não foi aceito para apresentação no evento. O parecer pode ser consultado no sistema.";

$arr_turnos= array();
$arr_turnos["M"] = "Manhã";
$arr_turnos["T"] = "Tarde";
$arr_turnos["N"] = "Noite";
$arr_turnos["X"] = "-----";

$GLOBALS["arr_status_trab"] = $arr_status_trab;
$GLOBALS["arr_status_trab_completo"] = $arr_status_trab_completo;

//return "Você deve efetuar o Login no sistema"; 
//return "Etapa para inscrição de trabalhos encerrada"; 
//return "Somente autores (estudantes) podem enviar trabalho"; 
//return "Resumo tem mais que 3000 caracteres (total = $tam caracteres) ";
//return "Você já possui um trabalho com essa modalidade";

?>