<?php

define("STATUS_TRAB_PENDENTE",  0); // visualizar + editar + pdf + enviar
define("STATUS_TRAB_ENVIADO",   1); // visualizar + pdf
define("STATUS_TRAB_ACEITO",    2); // visualizar + pdf
define("STATUS_TRAB_CORRIGIR",  3); // visualizar + editar + pdf + enviar
define("STATUS_TRAB_CORRIGIDO", 4); // visualizar + pdf
define("STATUS_TRAB_RECUSADO",  5); // visualizar + pdf

$arr_status_trab = array();
$arr_status_trab[0] = "Pendente";
$arr_status_trab[1] = "Enviado";
$arr_status_trab[2] = "Aceito";
$arr_status_trab[3] = "Corrigir";
$arr_status_trab[4] = "Corrigido e Enviado";
$arr_status_trab[5] = "Recusado";

$arr_status_trab_completo = array();
$arr_status_trab_completo[0] = "Trabalho Pendente (autor deve enviar trabalho)";
$arr_status_trab_completo[1] = "Trabalho Enviado (aguardando avaliação da comissão)";
$arr_status_trab_completo[2] = "Trabalho Aceito";
$arr_status_trab_completo[3] = "Trabalho pendente de correção (autor deve efetuar correções)";
$arr_status_trab_completo[4] = "Trabalho corrigido e enviado (aguardando avaliação da comissão)";
$arr_status_trab_completo[5] = "Trabalho Recusado";


//Habilita/destabilita Fases ou Etapas
define("ETAPA_CRIACAO_TRABALHO",   "1");
define("ETAPA_EDICAO_TRABALHO",    "1");
define("ETAPA_EXCLUSAO_TRABALHO",  "1");

//-----------------------------------------------
//Habilita/Desabilita Inscricoes de Papéis
//-----------------------------------------------
define("ETAPA_INSCRICAO_AUTOR",       "1");
define("ETAPA_INSCRICAO_ORIENTADOR",  "1");
define("ETAPA_INSCRICAO_AVALIADOR",   "1");
define("ETAPA_INSCRICAO_VOLUNTARIO",  "1");
define("ETAPA_INSCRICAO_OUVINTE",     "1");
define("ETAPA_INSCRICAO_REVISOR", 	  "0");
define("ETAPA_INSCRICAO_ORGANIZADOR", "0");


?>