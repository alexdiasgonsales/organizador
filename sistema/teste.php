<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
  <head>
    <title>TODO supply a title</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>
  <body>
    <div>TODO write content</div>
    
    <?php

    require_once 'controller/funcoes_envia_email.php';

    $r = envia_email("alex.gonsales@poa.ifrs.edu.br", "teste assunto", "texto do email");
    if ($r)
      echo "email enviado";
    else
      echo "erro ao enviar email";

    ?>

    <br>
    
    teste 1<br>
    
    <?php if (false): ?>
    teste 2 <br>
    
    <?php  else : ?>
    
    teste 3 <br>
    <?php endif; ?>
  </body>
</html>
