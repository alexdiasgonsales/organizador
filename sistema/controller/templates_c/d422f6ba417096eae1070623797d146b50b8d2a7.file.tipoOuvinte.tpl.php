<?php /* Smarty version Smarty-3.1.18, created on 2014-08-13 16:33:46
         compiled from "/home/mostratec/site/2014/sistema/view/templates/tipoOuvinte.tpl" */ ?>
<?php /*%%SmartyHeaderCode:205523674053ebbd9a2d49f7-75010217%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd422f6ba417096eae1070623797d146b50b8d2a7' => 
    array (
      0 => '/home/mostratec/site/2014/sistema/view/templates/tipoOuvinte.tpl',
      1 => 1405136643,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '205523674053ebbd9a2d49f7-75010217',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_53ebbd9a2d69a3_03755476',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53ebbd9a2d69a3_03755476')) {function content_53ebbd9a2d69a3_03755476($_smarty_tpl) {?><p class="form2">
    <label>Tipo: </label><br /> <br />
    <select id="tipoOuvinte" name="tipoOuvinte" required="required">
        <option value="">Selecione</option>
        <option value="1">Docente</option>
        <option value="2">Técnico Administrativo</option>
        <option value="3">Aluno</option>
        <option value="4">Outro</option>
        <span>Selecione um item</span>
    </select>
</p>
<p class="form2">
    <label>Tipo: Outro: </label><br /> <br />
    <input type="text" id="outro" name="outro"/> 
</p>
<p class="form2">
    <label>Empresa: </label><br /> <br />
    <input type="text" id="empresa" name="empresa"/> 
</p>

<?php }} ?>
