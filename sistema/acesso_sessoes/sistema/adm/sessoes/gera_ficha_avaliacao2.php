<?php
//include("../funcoes.php");
// Função para converter o título para maiúsculo 20110911

$id_sessao=$_REQUEST['id_sessao'];
$id_trabalho=$_REQUEST['id_trabalho'];
$id_avaliador=$_REQUEST['id_avaliador'];

//$seq=$_REQUEST['seq'];

/*
   $sql = "SELECT s.id_sessao, t.id_trabalho, t.titulo_ordenar, 
    av.fk_usuario as id_avaliador, u.nome as nome_avaliador
    FROM trabalho t 
    INNER JOIN sessao s ON s.id_sessao = t.fk_sessao 
    INNER jOIN avaliador_sessao avs ON avs.fk_sessao = s.id_sessao 
    INNER JOIN avaliador av ON av.fk_usuario = avs.fk_avaliador
    INNER JOIN usuario u ON av.fk_usuario = u.id_usuario
    WHERE
    s.id_sessao =".$id_sessao." AND ".
    "u.id_usuario =".$id_avaliador." AND ".
    "t.id_trabalho =".$id_trabalho.
    "order by s.id_sessao, avs.seq, t.id_trabalho";
  */
  
$sql_trab= "SELECT t.id_trabalho, t.titulo_ordenar, t.fk_area, t.fk_categoria, t.fk_modalidade, c.nivel, u.nome AS nome_autor
FROM trabalho t, trabalho_autor_curso tac, usuario u, curso c
WHERE (t.id_trabalho = ".$id_trabalho." AND t.status = 4) AND (tac.fk_trabalho = t.id_trabalho AND tac.seq = 1) AND u.id_usuario = tac.fk_autor AND (c.id_curso = tac.fk_curso)
ORDER BY t.id_trabalho";

$result_trab = runSQL($sql_trab);
if($result_trab == false)
	echo mysql_error();
$linha_trab = mysql_fetch_array($result_trab);

$sql_avaliador = 
"SELECT u.nome as nome_avaliador
FROM usuario u, avaliador_sessao avs, trabalho t
WHERE t.id_trabalho = ".$id_trabalho." AND avs.fk_sessao=t.fk_sessao AND u.id_usuario=avs.fk_avaliador 
AND u.id_usuario =".$id_avaliador.
" ORDER BY avs.fk_avaliador";

$result_avaliador = runSQL($sql_avaliador);
if($result_avaliador == false)
	echo mysql_error();

//$result = mysql_query($sql,$conexao) or die(mysql_error());
//$num_reg = mysql_num_rows($result);

//Fazer um laço de repeticao enquanto tiver avaliador dessa sessao desse trabalho.
while ($linha_avaliador = mysql_fetch_array($result_avaliador)) { 

	$titulo = $linha_trab['titulo_ordenar'];
	$tematica= $linha_trab['fk_area'];
	$categoria=$linha_trab['fk_categoria'];
	$modalidade=$linha_trab['fk_modalidade'];
	$nivel=$linha_trab['nivel'];
	$nome_apresentador = $linha_trab['nome_autor'];
	$nome_avaliador = $linha_avaliador['nome_avaliador'];
	
	# array : área temática :
	$array_tematica = array();
$array_tematica[0]  = " - ";
$array_tematica[1]  = "Ciências Exatas e da Terra";
$array_tematica[2]  = "Ciências Biológicas";
$array_tematica[3]  = "Engenharias";
$array_tematica[4]  = "Ciências da Saúde";
$array_tematica[5]  = "Ciências Agrárias";
$array_tematica[6]  = "Ciências Sociais Aplicadas";
$array_tematica[7]  = "Ciências Humanas";
$array_tematica[8]  = "Lingüística, Letras e Artes";

	#array : categoria :
	$array_categoria = array();
	$array_categoria[0] = " - ";
	$array_categoria[1] = "Relato de Experiência";
	$array_categoria[2] = "Relato de Pesquisa";
	$array_categoria[3] = "Revisão de Literatura/Ensaio";

	#array : modalidade :
	$array_modalidade = array();
	$array_modalidade[0] = " - ";
	$array_modalidade[1] = "Apresentação Oral";
	$array_modalidade[2] = "Apresentação de Pôster";

	#array : nivel do curso do autor :
	$array_nivel = array();
	$array_nivel[0] = " - ";
	$array_nivel[1] = "-";
	$array_nivel[2] = "Técnico";
	$array_nivel[3] = "Superior";

$var_html="<html><head><meta http-equiv='Content-Type' content='text/html; charset=utf-8'><style> p {  text-align: justify; } td {border-style:solid;border-color:#000;border-width:1px;padding:1px:margin:1px;} </style></head><body style='width:210mm;margin-left:0mm;padding:0px;'>";

$var_html=$var_html."<div style='width:170mm;margin-left:10mm;'>";
  
$cabecalho_tabela = "<table border='0' cellpadding='3' cellspacing='0' align='center' style='margin-left:1cm;font-family:arial;font-size:11pt;'>";
$var_html=$var_html.$cabecalho_tabela;
$var_html=$var_html."<tr>
<td style='width:200px;' align='left' bgcolor='#ffffff'>
<img src='images/Logo_IF_Campus_POA_2cm.png' border='0' align='left'><br><br></td>

<td align='center' valign=top bgcolor='#ffffff' style='font-weight:bold;font-size:16pt;'>15ª Mostra de Pesquisa, Ensino e Extensão<br>
IFRS - Câmpus Porto Alegre<br></td>
</tr>

<tr><td colspan=2 align=center style='font-weight:bold;'>
FICHA DE AVALIAÇÃO DE TRABALHO<br><br>
<b>Modalidade:</b> ".$array_modalidade[$modalidade]."<br><br>".
"</td>
</tr>";

$var_html=$var_html."<tr><td colspan=2 align=justify><b>Nº do trabalho:</b> ".str_pad($id_trabalho, 3, "0", STR_PAD_LEFT)."<br>".
"<b>Título do trabalho:</b> ".$titulo."<br>".
"<b>Nome do apresentador:</b> ".$nome_apresentador."<br>".
"<b>Área temática:</b> ".$array_tematica[$tematica]."<br>".
"<b>Categoria:</b> ".$array_categoria[$categoria]."<br>".
"<b>Nível de Ensino:</b> ".$array_nivel[$nivel]."<br>".
"</td></tr></table>";


//------------------------------------------- Tabela  Resumo

$var_html=$var_html."<p align=center>Avalie o resumo:</p>
<table border=1 cellspacing=0 cellpadding=3 align=center style='font-family:arial;font-size:10pt;border-style:solid;border-width:1px;border-spacing:0px;
border-collapse:collapse;border-color:#000'>
<tr bgcolor=#C0C0C0>
<td>
RESUMO
</td>
<td align=center>
NOTA<br>
(valor de 0 a 10)
</td>
</tr>

<tr><td>Introdução
</td>
<td>
&nbsp;
</td>
</tr>

<tr><td>Delimitação do problema</td>
<td>
&nbsp;
</td>
</tr>

<tr><td>Objetivo(s)</td>
<td>
&nbsp;
</td>
</tr>

<tr><td>Descrição da metodologia</td>
<td>
&nbsp;
</td>
</tr>

<tr><td>Resultados (parciais ou finais)</td>
<td>
&nbsp;
</td>
</tr>

<tr><td align=right>Média
</td>
<td>
&nbsp;
</td>
</tr>

</table>";

//-------------------------------------------------- Tabela  modalidade


//Modalidade Oral
if ($modalidade == 1) {

$var_html=$var_html."<p align=center><br><br>Avalie a apresentação:</p>
<table border=1 >
<tr bgcolor=#C0C0C0>
<td align=center>
APRESENTAÇÃO ORAL
</td>
<td align=center>
NOTA<br>
(valor de 0 a 10)
</td>
</tr>

<tr><td>Tempo (7 a 10 min.)</td>
<td>
&nbsp;
</td>
</tr>


<tr><td>Apresentação lógica e organizada (adequando o conteúdo ao tempo disponível)</td>
<td>
&nbsp;
</td>
</tr>

<tr><td>Qualidade visual (resolução de imagem, diagramação e disposição das informações)</td>
<td>
&nbsp;
</td>
</tr>

<tr><td>Conteúdo obrigatório (conforme regulamento)</td>
<td>
&nbsp;
</td>
</tr>

<tr><td>Clareza e desenvoltura na exposição</td>
<td>
&nbsp;
</td>
</tr>

<tr><td>Domínio do assunto</td>
<td>
&nbsp;
</td>
</tr>

<tr><td align=right>Média
</td>
<td>
&nbsp;
</td>
</tr>

</table>";
}

else {

//Modalidade Pôster

$var_html=$var_html."<p align=center><br><br>Avalie a apresentação:</p>
<table border=1 cellspacing=0 cellpadding=3 align=center style='font-family:arial;font-size:10pt;border-style:solid;border-width:3px;border-spacing:0px;border-collapse:collapse;'>
<tr bgcolor=#C0C0C0>
<td align=center>
APRESENTAÇÃO PÔSTER
</td>
<td align=center>
NOTA<br>
(valor de 0 a 10)
</td>
</tr>

<tr><td>Apresentação lógica e organizada</td>
<td>
&nbsp;
</td>
</tr>

<tr><td>Qualidade visual (resolução de imagem, diagramação e disposição das informações)</td>
<td>
&nbsp;
</td>
</tr>

<tr><td>Conteúdo obrigatório (conforme regulamento)</td>
<td>
&nbsp;
</td>
</tr>

<tr><td>Clareza e desenvoltura na exposição</td>
<td>
&nbsp;
</td>
</tr>

<tr><td>Domínio do assunto</td>
<td>
&nbsp;
</td>
</tr>

<tr><td align=right>Média
</td>
<td>
&nbsp;
</td>
</tr>

</table>";

}

$var_html=$var_html."<br><br><br>Tempo de Apresentação: ____________<br>".
"Nome do(a) Avaliador(a): ".$nome_avaliador."<br>".
"Assinatura do(a) Avaliador(a): _________________________________________________"."<br>".
"Data: ____ /____ / _____";

$var_html=$var_html."</div></body></html>";
  
  
}//Para cada avaliador

	

?>