<?php /* Smarty version Smarty-3.1.18, created on 2014-08-14 18:59:08
         compiled from "/home/mostratec/site/2014/sistema/view/templates/inscricao_especifico_voluntario.tpl" */ ?>
<?php /*%%SmartyHeaderCode:120033551553ed312c207c90-02303267%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b61088a29f9a51a8478dd5dfbd6be2de00a463f3' => 
    array (
      0 => '/home/mostratec/site/2014/sistema/view/templates/inscricao_especifico_voluntario.tpl',
      1 => 1405136646,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '120033551553ed312c207c90-02303267',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_53ed312c215aa1_03694524',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53ed312c215aa1_03694524')) {function content_53ed312c215aa1_03694524($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('../../view/templates/voluntarioComplemento.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate ('../../view/templates/instituicao.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate ('../../view/templates/campus.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate ('../../view/templates/curso.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php }} ?>
