<?php
require_once './autoload.php';

$status_int = $_POST['status_int'];
$trabalho = new TrabalhoMySqlDAO();
$trabalho->enviarEmailParaAutoresEOrientadoresByTrabalhoStatus($status_int);

echo 'Emails enviados com sucesso!';