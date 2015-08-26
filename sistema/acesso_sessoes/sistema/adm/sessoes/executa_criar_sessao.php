<?php

session_start();

include("../../../conexao.php");
if (!isset($_SESSION['id_administracao'])) {
      header("Location: index.php?diff=".elDiff());
}

$acao = $_GET["acao"];

if ($acao == "criar") {
    $id_sessao = (int)$_POST["id_sessao"];
    //$nro = (int)$_POST["numero_sessao"];
    $nro = "null";
    $nome = mysql_real_escape_string($_POST["nome_sessao"]);
    //$sala = (int)$_POST["sala_sessao"];
    $sala = "null";
    $nome_sala = mysql_real_escape_string($_POST["nome_sala_sessao"]);
    //$andar = (int)$_POST["andar_sessao"];
    $andar = "null";
    $nome_andar = mysql_real_escape_string($_POST["nome_andar_sessao"]);
    $data = $_POST["data_sessao"];
    $inicio = $_POST["hora_inicio_sessao"];
    $fim = $_POST["hora_fim_sessao"];
    $modalidade = (int)$_POST["modalidade_sessao"];

    $sql_insert = "INSERT INTO sessao (id_sessao, numero, nome, sala, nome_sala, andar, nome_andar, data, hora_ini, hora_fim, fk_modalidade, status)";
    $sql_insert .= "VALUES (".$id_sessao.",".$nro.", '".$nome."', ".$sala.", '".$nome_sala."', ".$andar.", '".$nome_andar."', '".$data."', '".$inicio."', '".$fim."', ".$modalidade.", 0)";
    $execute_insert = runSQL($sql_insert);

    if($execute_insert == false) {
        echo "<script>alert('Ocorreu um erro.');</script>";
        echo mysql_error();
    } else {
        $mostra = "<script> alert('Sessao criada com sucesso!.');";
        $mostra .= 'location.href="sessoes.php";</script>';
        echo $mostra;
    }
}//criar

else if ($acao == "editar") {
    $id_sessao = (int)$_POST["id_sessao"];
    //$nro = (int)$_POST["numero_sessao"];
    $nome = mysql_real_escape_string($_POST["nome_sessao"]);
    //$sala = (int)$_POST["sala_sessao"];
    $nome_sala = mysql_real_escape_string($_POST["nome_sala_sessao"]);
    //$andar = (int)$_POST["andar_sessao"];
    $nome_andar = mysql_real_escape_string($_POST["nome_andar_sessao"]);
    $data = $_POST["data_sessao"];
    $inicio = $_POST["hora_inicio_sessao"];
    $fim = $_POST["hora_fim_sessao"];
    $modalidade = (int)$_POST["modalidade_sessao"];

    $sql = "update sessao set
     nome ='".$nome."',
     nome_sala='".$nome_sala."',
     nome_andar='".$nome_andar."',
     data='".$data."',
     hora_ini='".$inicio."',
     hora_fim='".$fim."',
     fk_modalidade=".$modalidade.",
     status=0 
     where id_sessao = ".$id_sessao;
    $result = runSQL($sql);

    if($result == false) {
        echo "Erro ao atualizar sessão.";
        echo mysql_error();
    } else {
        $mostra = "<script> alert('Sessão atualizada com sucesso!.');";
        $mostra .= 'location.href="sessoes.php";</script>';
        echo $mostra;
    }
}//editar.

else if ($acao == "atualizar_id"){
    $id_sessao = $_POST["id_sessao"];
    $id_sessao_nova = $_POST["id_sessao_nova"];
    
    //Cria uma c�pia da sess�o.
    $sql = "INSERT into sessao (id_sessao, numero, nome, sala, nome_sala, andar, nome_andar, data, hora_ini, hora_fim, fk_modalidade, status) SELECT ".$id_sessao_nova.", numero, nome, sala, nome_sala, andar, nome_andar, data, hora_ini, hora_fim, fk_modalidade, status from sessao S2 where S2.id_sessao = ".$_SESSION["id_sessao"];
    $result = runSQL($sql);
    if($result == false) {
        echo "Erro ao criar nova sessão<br>";
        echo mysql_error();
    }
    
    //Atualizar trabalhos nessa sessao.
    $sql = "update trabalho set fk_sessao = ".$id_sessao_nova." where fk_sessao = ".$id_sessao;
    $result = runSQL($sql);
    if($result == false) {
        echo "Erro ao atualizar trabalhos na nova sessão.<br>";
        echo mysql_error();
    }    
    
    //Atualizar avaliadores nessa sessao.
    $sql = "update avaliador_sessao set fk_sessao = ".$id_sessao_nova." where fk_sessao = ".$id_sessao;
    $result = runSQL($sql);
    if($result == false) {
        echo "Erro ao atualizar avaliadores na nova sessão.<br>";
        echo mysql_error();
    }    
        
    //Remover sessao antiga.
    $sql = "delete from sessao where id_sessao = ".$id_sessao;
    $result = runSQL($sql);
    if($result == false) {
        echo "Erro ao remover sessão antiga.<br>";
        echo mysql_error();
    }    
 
    echo "ok";
}//atualizar_id_sessao




?>