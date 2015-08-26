{include '../../view/templates/cabecalho.tpl'}


<div id="form">
    <div class="especificos">
        <h3 id="titulo1" align="center">Inscrição de {$role}</h3>
        <div id="label1" align="center"> <h4> - Dados Pessoais - </h4> </div>
        <form id="f3" class="validate" method="post" action="{$HOME}controller/ControllerInsertUpdate.php">
            
            <p class="form">
                <label id="cpfLabel">CPF:</label>
                <input type="text" name="cpf" id="cpf" class="cpf">
                <span>Campo requerido, informe um CPF válido</span>
            </p>
            <input type="hidden" id="role" value='{$role}'>


            <p class="form" id="password" style="display:none;">
                <label id="senhaLabel">Senha:</label>
                <input type="password" id="senha" name="senha"/>
                <span>Campo requerido, Senha válida com 5 letras</span>
            </p>
            <div class="botoes">
                <a href="#" id="voltarHome"style="float: right;margin-left: 80px;" onclick="$(location).attr('href', home);" class="linkBotao" >voltar</a> 
                <a href="#" id="passwordBotao"onclick="verificaCpfSenha();" style="float: right; display:none; margin-left: 80px" class="linkBotao" >Continuar</a>
                <a href="#" id="cpfBotao"style="float: right;margin-left: 80px;" onclick="verificaCpf()" class="linkBotao" >Verificar CPF</a>      
            </div>
            <div id="mostrarCampos">
                <form id="f4" class="validate" method="post" >

            </div>
            <p class="botoes" style="float: right;">
                <button class="button red home" id="red"  style="display: none;">Voltar</button>
                <button class="button blue submit" id="blue" style="display:none;">Enviar</button>   
            </p>
        </form>
        </form>


    </div> <!-- Fim  da especificos -->



</div> <!-- Fim da DIV FORM -->

{include '../../view/templates/dialog.tpl'}

<div id="footer">
    Instituto Federal de Educaçao, Ciência e Tecnologia do Rio Grande do Sul - Campus Porto Alegre<br>
    Rua Cel. Vicente, 281 – Centro – Porto Alegre - CEP 90.030-041 – Rio Grande do Sul – Brasil<br>
    Desenvolvido por: <a href="mailto:marcusams@gmail.com">Marcus Aurélio M. dos Santos</a> e  <a href="mailto:alexandrewasempinto@hotmail.com">Alexandre Wasem Pinto</a>
</div> <!--Fim da DIV FOOTER -->
</body>
</html>