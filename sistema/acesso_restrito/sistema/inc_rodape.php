<?php ?>
	   </td>
	   <td background="images/formularios_r2_c3.png" style="background-repeat:repeat-y"><img name="formularios_r2_c3" src="images/formularios_r2_c3.png" width="19" height="70" border="0"></td>
	  </tr>
	</table></td>
  </tr>
  <tr>
   <!--<td><img name="formularios_r3_c1" src="images/formularios_r3_c1.png" width="790" height="78" border="0"></td>-->
   <td width="790" background="images/formularios_r3_c1.png" style="font-family:Arial, Helvetica, sans-serif; font-size:10px; text-align: center; background-repeat:repeat-y">
   <br>
   <br>
   <font color="#999999">
     Instituto Federal de Educa&ccedil;&atilde;o, Ci&ecirc;ncia e Tecnologia do Rio Grande do Sul - Campus Porto Alegre<br>
     Rua Cel. Vicente, 281 – Centro – Porto Alegre - CEP 90.030-041 – Rio Grande do Sul – Brasil<br>
     Desenvolvido por: <a href="mailto:ingridbpeitz@gmail.com" style="font-family:Arial, Helvetica, sans-serif; font-size:10px; color:#999999; text-decoration:none;">Ingrid Peitz</a>
   </font>
   <br>
   <br>
   <td>
   
   
  </tr>
<map name="m_formularios_r1_c1">
<area shape="poly" coords="24,21,120,21,120,117,24,117,24,21" href="http://www.poa.ifrs.edu.br/" target="_blank">
</map>
</table>

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
    var str = "opcao=logout";
        
        $.ajax({
          type: "POST",
          url: 'usuario_op.php',
          data: str,
          success: function(data) {
              if(data==1){
                  window.location = "index.php";
              } else {
                  alert("Erro.");
              }
              
          }
        });
}
</script> 

<?php ?>

