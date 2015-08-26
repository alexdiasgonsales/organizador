<?php /* Smarty version Smarty-3.1.18, created on 2014-08-13 12:47:31
         compiled from "../view/templates/cpf.tpl" */ ?>
<?php /*%%SmartyHeaderCode:59851918753eb889351cea8-19328937%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3968f880536cacfb6c4d4994af893c85d9ea219a' => 
    array (
      0 => '../view/templates/cpf.tpl',
      1 => 1405136645,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '59851918753eb889351cea8-19328937',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'role' => 0,
    'HOME' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_53eb8893532dd9_01157359',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53eb8893532dd9_01157359')) {function content_53eb8893532dd9_01157359($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('../../view/templates/cabecalho.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>



<div id="form">
    <div class="especificos">
        <h3 id="titulo1" align="center">Inscrição de <?php echo $_smarty_tpl->tpl_vars['role']->value;?>
</h3>
        <div id="label1" align="center"> <h4> - Dados Pessoais - </h4> </div>
        <form id="f3" class="validate" method="post" action="<?php echo $_smarty_tpl->tpl_vars['HOME']->value;?>
controller/ControllerInsertUpdate.php">
            
            <p class="form">
                <label id="cpfLabel">CPF:</label>
                <input type="text" name="cpf" id="cpf" class="cpf">
                <span>Campo requerido, informe um CPF válido</span>
            </p>
            <input type="hidden" id="role" value='<?php echo $_smarty_tpl->tpl_vars['role']->value;?>
'>


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

<?php echo $_smarty_tpl->getSubTemplate ('../../view/templates/dialog.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<div id="footer">
    Instituto Federal de Educaçao, Ciência e Tecnologia do Rio Grande do Sul - Campus Porto Alegre<br>
    Rua Cel. Vicente, 281 – Centro – Porto Alegre - CEP 90.030-041 – Rio Grande do Sul – Brasil<br>
    Desenvolvido por: <a href="mailto:marcusams@gmail.com">Marcus Aurélio M. dos Santos</a> e  <a href="mailto:alexandrewasempinto@hotmail.com">Alexandre Wasem Pinto</a>
</div> <!--Fim da DIV FOOTER -->
</body>
</html><?php }} ?>
