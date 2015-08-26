<?php /* Smarty version Smarty-3.1.18, created on 2014-08-13 13:31:11
         compiled from "/home/mostratec/site/2014/sistema/view/templates/campus.tpl" */ ?>
<?php /*%%SmartyHeaderCode:61744018153eb92cf1162f0-11334925%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2272a2c28670fa2f46ad93c963d57074c677bf4d' => 
    array (
      0 => '/home/mostratec/site/2014/sistema/view/templates/campus.tpl',
      1 => 1405136643,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '61744018153eb92cf1162f0-11334925',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'required' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_53eb92cf119740_61066181',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53eb92cf119740_61066181')) {function content_53eb92cf119740_61066181($_smarty_tpl) {?><p class="form2">

    <label>Campus:</label><br /><br />
    
    <select id="f_campus" name="f_campus"  onchange="getCursos(); return false;" <?php echo $_smarty_tpl->tpl_vars['required']->value;?>
>
        <option value="">Selecione um item da lista</option>       
        <span>Selecione um item</span>
    </select>
        
     <input type="button" value="Cadastrar Outro Campus ..." class="button red" style="float: left; font-size: 12px; font-weight: bold;" onclick="show_dialog_campus();">
     <!--<a href="#" class="links linkBotao" style="float: left;" onclick="show_dialog_campus();">Novo Campus</a> -->
        
</p><?php }} ?>
