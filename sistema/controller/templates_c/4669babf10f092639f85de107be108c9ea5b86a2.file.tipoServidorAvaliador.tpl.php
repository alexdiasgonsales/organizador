<?php /* Smarty version Smarty-3.1.18, created on 2014-09-11 15:59:05
         compiled from "/home/mostratec/site/2014/sistema/view/templates/tipoServidorAvaliador.tpl" */ ?>
<?php /*%%SmartyHeaderCode:14110046555411f0f9bb3547-97113520%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4669babf10f092639f85de107be108c9ea5b86a2' => 
    array (
      0 => '/home/mostratec/site/2014/sistema/view/templates/tipoServidorAvaliador.tpl',
      1 => 1405136644,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '14110046555411f0f9bb3547-97113520',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_5411f0f9bbd838_89267087',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5411f0f9bbd838_89267087')) {function content_5411f0f9bbd838_89267087($_smarty_tpl) {?><p class="form2">
    <label>Tipo de Servidor:</label> <br /><br />
    <select id="orServ" name="orServ" class="required" required="required">
        <option value="">Selecione um item da lista</option>
        <option value="1">Docente</option>
        <option value="2">Técnico Administrativo</option>
        <option value="3">Estudande de Pós-graduação</option>
        <span>Selecione um item</span>
    </select>
</p>

<?php }} ?>
