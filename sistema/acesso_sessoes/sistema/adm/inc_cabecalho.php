﻿<?php ?>
<!DOCTYPE html>
<html> 
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=8" />
        <meta HTTP-EQUIV="Pragma" CONTENT="no-cache" /> 
        <meta HTTP-EQUIV="Cache-control" CONTENT="no-cache" /> 
        <meta HTTP-EQUIV="Expires" CONTENT="0" /> 
        <link rel="shortcut icon" href="../images/favicon.png" >
        <meta http-equiv="Content-Type" content="text/html" charset="utf-8">
        <title>15ª Mostra de Pesquisa, Ensino e Extensão - IFRS - Porto Alegre</title>

              <!-- script para IE8 reconhecer as tags do html5 -->
        <!--[if lte IE 8]>
        <script type="text/javascript">
        var htmlshim='abbr,article,aside,audio,canvas,details,figcaption,figure,footer,header,mark,meter,nav,output,progress,section,summary,time,video'.split(',');
        var htmlshimtotal=htmlshim.length;
        for(var i=0;i<htmlshimtotal;i++) document.createElement(htmlshim[i]);
        </script>
        <![endif]-->


        <link rel=stylesheet type=text/css href="../css/estilo_mostratec.css" charset="utf-8">
        <script src="../js/jquery.min.js" type="text/javascript"></script>
        <script src="../js/jquery.validate.js" type="text/javascript"></script>
        <link rel=stylesheet type=text/css href="../css/button.css" charset="utf-8">
        <link rel="stylesheet" href="../css/jquery-ui.css">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
        <script src="../js/jquery-ui.js"></script>
        <script src="../js/tabs.js"></script>
        <script src="../../jscripts/jquery-1.7.2.min.js" type="text/javascript"></script>
        <script src="maskedinput.js" type="text/javascript"></script>
        <script src="../ckeditor/ckeditor.js" charset="utf-8"></script>
        <script src="//code.jquery.com/jquery-1.10.2.js"></script>
        <script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>

    <body>

        <div id="conteudo"> 
           
            <div id="header">
                <div id="logo">
                    <a href="index.php"><img src="../images/logo.png" width="235px" height="70px;"/></a>
                </div>
                <div id="frase">15ª Mostra de Pesquisa, Ensino e Extensão<br>IFRS Câmpus Porto Alegre</div>
            </div>
            
                <div id="cont">
<?php 
if(isset($_SESSION['id_administracao'])) {
        echo "&nbsp;&nbsp;<b>Você está logado como:</b>&nbsp;".$_SESSION['id_administracao']."<br>";   

   }    
?>

