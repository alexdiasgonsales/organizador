<?php /* Smarty version Smarty-3.1.18, created on 2014-08-18 22:39:59
         compiled from "../view/templates/selectInstituicoes.tpl" */ ?>
<?php /*%%SmartyHeaderCode:24633340153f2aaef7ef2b4-71142132%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2ea953653f122458392b1a5471c9db2b5b10b775' => 
    array (
      0 => '../view/templates/selectInstituicoes.tpl',
      1 => 1405136642,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '24633340153f2aaef7ef2b4-71142132',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'instituicoes' => 0,
    'i' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_53f2aaef8978e0_05479718',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53f2aaef8978e0_05479718')) {function content_53f2aaef8978e0_05479718($_smarty_tpl) {?><option value="" selected="on">Selecione um item na lista</option>
<?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['i']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['instituicoes']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value) {
$_smarty_tpl->tpl_vars['i']->_loop = true;
?> 
    <option value="<?php echo $_smarty_tpl->tpl_vars['i']->value->id_instituicao;?>
"><?php echo $_smarty_tpl->tpl_vars['i']->value->nome;?>
</option>
<?php } ?> <?php }} ?>
