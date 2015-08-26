<?php /* Smarty version Smarty-3.1.18, created on 2014-08-13 13:31:11
         compiled from "/home/mostratec/site/2014/sistema/view/templates/tipoServidorOrientador.tpl" */ ?>
<?php /*%%SmartyHeaderCode:32995027553eb92cf11b064-70320398%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b1544dafc50b3f64e9f58e0eb18534156f8b1109' => 
    array (
      0 => '/home/mostratec/site/2014/sistema/view/templates/tipoServidorOrientador.tpl',
      1 => 1405136643,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '32995027553eb92cf11b064-70320398',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_53eb92cf11bfb3_39706762',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53eb92cf11bfb3_39706762')) {function content_53eb92cf11bfb3_39706762($_smarty_tpl) {?><p class="form2">
    <label>Tipo de Servidor:</label> <br /> <br />
    <select id="orServ" name="orServ" class="required" required="required">
        <option value="">Selecione um item da lista</option>
        <option value="1">Docente</option>
        <option value="2">Técnico Administrativo</option>
        <span>Selecione um item</span>
    </select>
</p>

<?php }} ?>
