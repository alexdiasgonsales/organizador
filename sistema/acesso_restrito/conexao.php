<?php 

$host_db  = "localhost";
$user_db  = "root";
$senha_db = "";
$dbName = "mostratec2015";

$conexao = mysql_connect($host_db,$user_db,$senha_db);

//Tipos de vers�es (DEBUG, PRODUCAO):
define("CONST_TIPO_VERSAO",  "DEBUG");

//DEBUG
//Utilizada no localhost ou servidor aula.
//N�o envia email.

//PRODUCAO
//Vers�o publicada no servidor mostra.poa.ifrs.edu.br
//Envia email.

if (!$conexao)
   {
	  header("Location: index.php?id_pagina=1");
   }
   
mysql_select_db($dbName, $conexao);
//mysql_select_db("mostratec");

mysql_query("SET NAMES 'utf8'");
mysql_query('SET character_set_connection=utf8');
mysql_query('SET character_set_client=utf8');
mysql_query('SET character_set_results=utf8');

function runSQL($sql){
    return mysql_query($sql);
}



?>
