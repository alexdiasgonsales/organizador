<?php /* Smarty version Smarty-3.1.18, created on 2014-08-13 13:32:16
         compiled from "../view/templates/selectCursos.tpl" */ ?>
<?php /*%%SmartyHeaderCode:162786048753eb93109c4970-54798368%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a92ad18a5be4909eb02ec254cd1539af210c1e0f' => 
    array (
      0 => '../view/templates/selectCursos.tpl',
      1 => 1405136644,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '162786048753eb93109c4970-54798368',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'cursos' => 0,
    'cc' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_53eb93109e8141_05302307',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53eb93109e8141_05302307')) {function content_53eb93109e8141_05302307($_smarty_tpl) {?><option value="" selected="on">Selecione um item na lista</option>
<?php  $_smarty_tpl->tpl_vars['cc'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['cc']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['cursos']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['cc']->key => $_smarty_tpl->tpl_vars['cc']->value) {
$_smarty_tpl->tpl_vars['cc']->_loop = true;
?> 
    <option value="<?php echo $_smarty_tpl->tpl_vars['cc']->value->id_curso;?>
"><?php echo $_smarty_tpl->tpl_vars['cc']->value->nivelDesc;?>
<?php echo $_smarty_tpl->tpl_vars['cc']->value->nome;?>
</option>
<?php } ?> 

<?php }} ?>
