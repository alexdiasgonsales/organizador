<?php /* Smarty version Smarty-3.1.18, created on 2014-08-13 13:31:45
         compiled from "../view/templates/selectCampus.tpl" */ ?>
<?php /*%%SmartyHeaderCode:106802079153eb92f1896bc4-46274805%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '88620cbc9c0a4d7987584de3743bc0aa50ec2456' => 
    array (
      0 => '../view/templates/selectCampus.tpl',
      1 => 1405136646,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '106802079153eb92f1896bc4-46274805',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'campus' => 0,
    'c' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_53eb92f18aa234_50960981',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53eb92f18aa234_50960981')) {function content_53eb92f18aa234_50960981($_smarty_tpl) {?><option value="" selected="on">Selecione um item na lista</option>
<?php  $_smarty_tpl->tpl_vars['c'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['c']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['campus']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['c']->key => $_smarty_tpl->tpl_vars['c']->value) {
$_smarty_tpl->tpl_vars['c']->_loop = true;
?> 
    <option value="<?php echo $_smarty_tpl->tpl_vars['c']->value->id_campus;?>
"><?php echo $_smarty_tpl->tpl_vars['c']->value->nome;?>
</option>
<?php } ?> <?php }} ?>
