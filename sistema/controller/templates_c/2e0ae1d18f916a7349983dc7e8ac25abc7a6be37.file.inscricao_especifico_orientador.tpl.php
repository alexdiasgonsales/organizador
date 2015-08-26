<?php /* Smarty version Smarty-3.1.18, created on 2014-08-13 13:31:11
         compiled from "/home/mostratec/site/2014/sistema/view/templates/inscricao_especifico_orientador.tpl" */ ?>
<?php /*%%SmartyHeaderCode:29104716053eb92cf0f99f9-55694165%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2e0ae1d18f916a7349983dc7e8ac25abc7a6be37' => 
    array (
      0 => '/home/mostratec/site/2014/sistema/view/templates/inscricao_especifico_orientador.tpl',
      1 => 1405136644,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '29104716053eb92cf0f99f9-55694165',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_53eb92cf100098_63348055',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53eb92cf100098_63348055')) {function content_53eb92cf100098_63348055($_smarty_tpl) {?>
<?php echo $_smarty_tpl->getSubTemplate ('../../view/templates/instituicao.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate ('../../view/templates/campus.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate ('../../view/templates/tipoServidorOrientador.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
       
<?php }} ?>
