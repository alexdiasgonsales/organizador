<?php /* Smarty version Smarty-3.1.18, created on 2014-09-11 15:59:05
         compiled from "/home/mostratec/site/2014/sistema/view/templates/inscricao_especifico_avaliador.tpl" */ ?>
<?php /*%%SmartyHeaderCode:20669085805411f0f9b99178-44558485%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b076b0534992af6c894ba08e6638949456e1cce9' => 
    array (
      0 => '/home/mostratec/site/2014/sistema/view/templates/inscricao_especifico_avaliador.tpl',
      1 => 1405136645,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '20669085805411f0f9b99178-44558485',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_5411f0f9badef4_19179278',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5411f0f9badef4_19179278')) {function content_5411f0f9badef4_19179278($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('../../view/templates/instituicao.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate ('../../view/templates/campus.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate ('../../view/templates/tipoServidorAvaliador.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate ('../../view/templates/nivelFormacao.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate ('../../view/templates/areaTematica.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<?php }} ?>
