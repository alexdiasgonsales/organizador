<?php /* Smarty version Smarty-3.1.18, created on 2014-08-13 16:33:46
         compiled from "/home/mostratec/site/2014/sistema/view/templates/inscricao_especifico_ouvinte.tpl" */ ?>
<?php /*%%SmartyHeaderCode:84946477453ebbd9a2ab1c2-74243897%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'fc0cec192f003fad3b195f626a8cbc18a8cf87b3' => 
    array (
      0 => '/home/mostratec/site/2014/sistema/view/templates/inscricao_especifico_ouvinte.tpl',
      1 => 1405136646,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '84946477453ebbd9a2ab1c2-74243897',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_53ebbd9a2b9356_01770730',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53ebbd9a2b9356_01770730')) {function content_53ebbd9a2b9356_01770730($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('../../view/templates/instituicao.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate ('../../view/templates/campus.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate ('../../view/templates/curso.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate ('../../view/templates/tipoOuvinte.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php }} ?>
