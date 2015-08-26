<?php /* Smarty version Smarty-3.1.18, created on 2014-08-13 12:06:04
         compiled from "view/templates/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:192186212753eb7edcd88732-38270511%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5df6254b46d261e43d5040048899e7ed1aa05ec5' => 
    array (
      0 => 'view/templates/index.tpl',
      1 => 1405136647,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '192186212753eb7edcd88732-38270511',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_53eb7edcd9b075_38141131',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53eb7edcd9b075_38141131')) {function content_53eb7edcd9b075_38141131($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('view/templates/cabecalho.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate ('view/templates/form_login.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate ('view/templates/rodape.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
