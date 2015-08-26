<?php

//error_reporting(E_ALL);

//***********************************************
//Etapas do Evento
//***********************************************
//Habilita as etapas de inscrições dos diversos papéis de Usuários.
define("ETAPA_INSCRICAO_AUTOR", 1);
define("ETAPA_INSCRICAO_ORIENTADOR", 1);
define("ETAPA_INSCRICAO_AVALIADOR", 1);
define("ETAPA_INSCRICAO_OUVINTE", 1);
define("ETAPA_INSCRICAO_VOLUNTÁRIO", 1);
define("ETAPA_INSCRICAO_REVISOR", 1);
define("ETAPA_INSCRICAO_ORGANIZADOR", 1);

//Habilita as etapas de inscrição, análise e correção de trabalhos.
//Autor efetua inscrição e edição de trabalho.
define("ETAPA_INSCRICAO_TRABALHO", 1);

//Não utilizada
//Orientador efetua validação do trabalho.
define("ETAPA_VALIDACAO_TRABALHO", 0);

//Revisor analisa trabalhos e emite o primeiro paracer.
define("ETAPA_ANALISE_TRABALHO_1", 0);

//Autor efetua edição (correção) de trabalho.
define("ETAPA_CORRECAO_TRABALHO_1", 0);

//Revisor analisa trabalhos e emite o segundo (último) paracer.
define("ETAPA_ANALISE_TRABALHO_2", 0);

//Todas etapas finalizadas.
define("ETAPA_TRABALHOS_HOMOLOGADOS", 0);

//Nivel Curso:
define("NIVEL_CURSO_TECNICO", 2);
define("NIVEL_CURSO_SUPERIOR", 3);

$arr_nivel_curso = array();
$arr_nivel_curso[0] = "---";
$arr_nivel_curso[1] = "---";
$arr_nivel_curso[2] = "Técnico";
$arr_nivel_curso[3] = "Superior";

//Status Usuário:
define("STATUS_USUARIO_PENDENTE", 0);
define("STATUS_USUARIO_ACEITO", 1);
define("STATUS_USUARIO_RECUSADO", 2);

$arr_status_usuario = array();
$arr_status_usuario[0] = "Pendente";
$arr_status_usuario[1] = "Aceito";
$arr_status_usuario[2] = "Recusado";

//Formação
define("FORMACAO_SUPERIOR", 3);
define("FORMACAO_ESPECIALIZACAO", 4);
define("FORMACAO_MESTRADO", 5);
define("FORMACAO_DOUTORADO", 6);

$arr_formacao = array();
$arr_formacao[0] = "---";
$arr_formacao[1] = "---";
$arr_formacao[2] = "---";
$arr_formacao[3] = "Superior";
$arr_formacao[4] = "Especialização";
$arr_formacao[5] = "Mestrado";
$arr_formacao[6] = "Doutorado";

//Tipos de avaliadores:
define("TIPO_AVALIADOR_DOCENTE", 1);
define("TIPO_AVALIADOR_TECNICO_ADMINISTRATIVO", 2);
define("TIPO_AVALIADOR_ESTUDANTE_POS_GRADUACAO", 3);

$arr_tipo_avaliador = array();
$arr_tipo_avaliador[0] = "---";
$arr_tipo_avaliador[1] = "Docente";
$arr_tipo_avaliador[2] = "Técnico Administrativo";
$arr_tipo_avaliador[3] = "Estudante de Pós-graduação";

//Tipos de orientadores:
define("TIPO_ORIENTADOR_DOCENTE", 1);
define("TIPO_ORIENTADOR_TECNICO_ADMINISTRATIVO", 2);
define("TIPO_ORIENTADOR_INVALIDO", 3); //Não utilizado, para manter compatibilidade com TIPO_AVALIADOR_ESTUDANTE_POS_GRADUACAO.
define("TIPO_ORIENTADOR_OUTRO", 4); //Somente para co-orientador.

$arr_tipo_orientador = array();
$arr_tipo_orientador[0] = "---";
$arr_tipo_orientador[1] = "Docente";
$arr_tipo_orientador[2] = "Técnico Administrativo";
$arr_tipo_orientador[4] = "---";
$arr_tipo_orientador[3] = "Outro";

//Tipos de ouvintes:
define("TIPO_OUVINTE_DOCENTE", 1);
define("TIPO_OUVINTE_TECNICO_ADMINISTRATIVO", 2);
define("TIPO_OUVINTE_ESTUDANTE", 3);
define("TIPO_OUVINTE_OUTRO", 4);

$arr_tipo_ouvinte = array();
$arr_tipo_ouvinte[0] = "---";
$arr_tipo_ouvinte[1] = "Docente";
$arr_tipo_ouvinte[2] = "Técnico Administrativo";
$arr_tipo_ouvinte[3] = "Estudante";
$arr_tipo_ouvinte[4] = "Outro";

$GLOBALS['statusTrabalhoSimples'] = array(
    0 => 'Pedente',
    1 => 'Enviado',
    2 => 'Aceito',
    3 => 'Corrigir',
    4 => 'Corrigido e Enviado',
    5 => 'Recusado'
);
$GLOBALS['turnos'] = array(
    'M' => 'Manhã',
    'T' => 'Tarde',
    'N' => 'Noite',
    'X' => '-----'
);

$GLOBALS['statusTrabalho'][0] = "Trabalho pendente (autor principal deve entrar no sistema e confirmar o envio do trabalho).";
$GLOBALS['statusTrabalho'][1] = "Trabalho enviado (orientador deve entrar no sistema e efetuar a validação do trabalho).";
$GLOBALS['statusTrabalho'][2] = "Trabalho validado pelo orientador (aguardando homologação da comissão organizadora).";
$GLOBALS['statusTrabalho'][3] = "Trabalho invalidado pelo orientador.";
$GLOBALS['statusTrabalho'][4] = "Trabalho foi aceito para apresentação no evento. Aguardar publicação da data de apresentação.";
$GLOBALS['statusTrabalho'][5] = "Trabalho pendente de correção (autor deve efetuar correções).";
$GLOBALS['statusTrabalho'][6] = "Trabalho em correção (autor está efetuando as correções).";
$GLOBALS['statusTrabalho'][7] = "Trabalho corrigido e enviado (aguardando homologação da comissão organizadora).";
$GLOBALS['statusTrabalho'][8] = "Trabalho não foi aceito para apresentação no evento. O parecer pode ser consultado no sistema.";


$GLOBALS['email']['pendentes']['assunto'] = "aqui vai o assundo do e-mail";
$GLOBALS['email']['pendentes']['corpo'] = "aqui vai o corpo do e-mail";

$GLOBALS['email']['enviados']['assunto'] = "aqui vai o assunto do e-mail";
$GLOBALS['email']['enviados']['corpo'] = "aqui vai o corpo do e-mail";

define('STATUS_AVALIADOR_SESSAO_TALVEZ', 0);
define('STATUS_AVALIADOR_SESSAO_ACEITA', 1);
define('STATUS_AVALIADOR_SESSAO_REJEITADA', 2);
