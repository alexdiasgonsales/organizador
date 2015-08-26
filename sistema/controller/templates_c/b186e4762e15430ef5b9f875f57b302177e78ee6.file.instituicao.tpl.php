<?php /* Smarty version Smarty-3.1.18, created on 2014-08-13 13:31:11
         compiled from "/home/mostratec/site/2014/sistema/view/templates/instituicao.tpl" */ ?>
<?php /*%%SmartyHeaderCode:42217456153eb92cf101967-05869511%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b186e4762e15430ef5b9f875f57b302177e78ee6' => 
    array (
      0 => '/home/mostratec/site/2014/sistema/view/templates/instituicao.tpl',
      1 => 1405136645,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '42217456153eb92cf101967-05869511',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'required' => 0,
    'instituicao' => 0,
    'i' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_53eb92cf113da5_41289677',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53eb92cf113da5_41289677')) {function content_53eb92cf113da5_41289677($_smarty_tpl) {?><div id="especificos" style="float: left; text-align: center;"> <h4> - Dados Específicos - </h4> 

    <p class="form2">

        <label>Instituição:</label> <br /><br />
        <select id="f_instituicao" name="f_instituicao"  onchange="getCampus(); return false;" <?php echo $_smarty_tpl->tpl_vars['required']->value;?>
>
            <option value="">Selecione um item da lista</option>
            <?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['i']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['instituicao']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value) {
$_smarty_tpl->tpl_vars['i']->_loop = true;
?>
            <option value="<?php echo $_smarty_tpl->tpl_vars['i']->value->id_instituicao;?>
"><?php echo $_smarty_tpl->tpl_vars['i']->value->nome;?>
</option>
            <?php } ?>
            <span>Selecione um item</span>
        </select>
       
     <input type="button" value="Cadastrar Outra Instituição ..." class="button red" style="float: left; font-size: 12px; font-weight: bold;" onclick="show_dialog_instituicao();">
            <!--
       <a href="#" class="links linkBotao" style="float: left;" onclick="nova();">Nova Instituição</a> 
            -->
    </p>
    
    <?php }} ?>
