<?php ?>

<div id="footer">
    Instituto Federal de Educaçao, Ciência e Tecnologia do Rio Grande do Sul - Campus Porto Alegre<br>
    Rua Cel. Vicente, 281 – Centro – Porto Alegre - CEP 90.030-041 – Rio Grande do Sul – Brasil<br>
    Desenvolvido por: <a href="mailto:alexandrewasempinto@hotmail.com">Alexandre Wasem Pinto</a> e <a href="mailto:marcusams@gmail.com">Marcus Aurélio M. dos Santos</a>
</div> <!--Fim da DIV FOOTER -->
</body>
</html>

<script type="text/javascript"> 
jQuery(function($){
   //$("#data").mask("99/99/9999");
   $("#data").mask("*9/99/9999",{completed:function(){alert("You typed the following: "+this.val());}});
  //$("#data").mask("99/99/9999",{placeholder:" "});
   $("#telefone").mask("(099) 999-9999");
   $("#cpf").mask("999.999.999-99");
   $("#cep").mask("99999 - 999"); 
   $("#cnpj").mask("99.999.999/9999-99");
   $("#placa").mask("aaa - 9999"); 
});

function logout(){
    var str = "opcao=sair";
        
        $.ajax({
          type: "POST",
          data: str,
          url: 'usuario_op.php',
          success: function(data) {
              if(data==1){
                  window.location = "http://localhost/mostra_2/2014/sistema/antigo_restrito/sistema/adm/";
              } else {
                  alert("Erro.");
              }
              
          }
        });
}
</script> 

<?php ?>