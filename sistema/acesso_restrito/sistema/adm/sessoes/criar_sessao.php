<?php

session_start();

include("../../../conexao.php");
if (!isset($_SESSION['id_administracao'])) {
      header("Location: index.php?diff=".elDiff());
}

$acao = $_GET["acao"];

if ($acao =="criar")   {
    $id_sessao = "";
    $numero_sessao = "";
    $nome_sessao = "";
    $sala = "";
    $nome_sala = "";
    $andar = "";
    $nome_andar = "";
    $data = "";
    $hora_ini = "";
    $hora_fim = "";
    $modalidade = "";
}
else if ($acao =="editar")   {
    $id_sessao = $_REQUEST["id_sessao"];
    $sql = "select * from sessao where id_sessao= ".$id_sessao;
    $result = runSQL($sql);
    if($result == false) {
        echo "Erro ao consultar sessão<br>";
        echo mysql_error();
        exit();
    }
    $row = mysql_fetch_array($result);
    $id_sessao = $row["id_sessao"];
    $numero_sessao = $row["numero"];
    $nome_sessao = $row["nome"];
    $sala = $row["sala"];
    $nome_sala = $row["nome_sala"];
    $andar = $row["andar"];
    $nome_andar = $row["nome_andar"];
    $data = $row["data"];
    $hora_ini = $row["hora_ini"];
    $hora_fim = $row["hora_fim"];
    $modalidade = $row["fk_modalidade"];
    
}

$titulo = "CS (Criar Sessão)";
include("../inc_cabecalho.php");
?>

<form name="form_criar" method="post" action="executa_criar_sessao.php?acao=<?php echo $acao;?>">


<?php 

if ($acao == "criar") {
  echo "<label>ID:</label><input id='id_sessao' name='id_sessao' type='text' value='".$id_sessao."' style='margin-left:10px;'><br><br>";
}
else {
    echo "<label>ID: ".$id_sessao."</label><br><br>";
    echo "<input id='id_sessao' name='id_sessao' type='hidden' value='".$id_sessao."'><br><br>";
}


?>

<!--
<label>Número:</label>
<input id="numero_sessao" name="numero_sessao" type="text" value="<?php echo $numero_sessao; ?>" style="margin-left:10px;" />
<div style="clear:both; height:15px;"></div>
-->

<label>Numero:</label>
<input id="nome_sessao" name="nome_sessao" type="text" value="<?php echo $nome_sessao;?>" style="margin-left:10px;" />
<div style="clear:both; height:15px;"></div>

<!--
<label>Sala:</label>
<input id="sala_sessao" name="sala_sessao" type="text" value="<?php echo $sala;?>" style="margin-left:10px;" />
<div style="clear:both; height:15px;"></div>
-->

<label>Sala:</label>
<input id="nome_sala_sessao" name="nome_sala_sessao" type="text" value="<?php echo $nome_sala;?>" style="margin-left:10px;" />
<div style="clear:both; height:15px;"></div>

<!--
<label>Andar:</label>
<input id="andar_sessao" name="andar_sessao" type="text" value="<?php echo $andar;?>" style="margin-left:10px;" />
<div style="clear:both; height:15px;"></div>
-->

<label>Andar:</label>
<input id="nome_andar_sessao" name="nome_andar_sessao" type="text" value="<?php echo $nome_andar;?>" style="margin-left:10px;" />
<div style="clear:both; height:15px;"></div>

<label>Data (aaaa-mm-dd):</label>
<input id="data_sessao" name="data_sessao" type="text" value="<?php echo $data;?>" style="margin-left:10px;" />
<div style="clear:both; height:15px;"></div>

<label>Horário de Início:</label>
<input id="hora_inicio_sessao" name="hora_inicio_sessao" type="text" value="<?php echo $hora_ini;?>" style="margin-left:10px;" />
<div style="clear:both; height:15px;"></div>

<label>Horário de Fim:</label>
<input id="hora_fim_sessao" name="hora_fim_sessao" type="text" value="<?php echo $hora_fim;?>" style="margin-left:10px;" />
<div style="clear:both; height:15px;"></div>

<label>Modalidade:</label>
<select id="modalidade_sessao" name="modalidade_sessao"> 
	<option value="1" <?php if ($modalidade==1) echo "selected"; ?> >Oral</option>
	<option value="2" <?php if ($modalidade==2) echo "selected"; ?>>Pôster</option>
</select>
<div style="clear:both; height:15px;"></div>

<input type="submit" value="Enviar" />

</form>

<h2>Modificar ID da Sessão</h2>
<form name="mudar_id" method="POST" action="executa_criar_sessao.php?acao=atualizar_id">

ID antiga: <input type="text" id="id_sessao" name="id_sessao"><br>
ID Nova: <input type="text" id="id_sessao_nova" name="id_sessao_nova"><br>
<input type="submit" value="Enviar Dados">

</form>

<a href="sessoes.php" class="link1" style="margin-left:10px;font-size:10px;text-decoration:underline;">Sessões </a>

<?php
include("../inc_rodape.php");
?>

