<?php /* Smarty version Smarty-3.1.18, created on 2014-08-13 16:33:46
         compiled from "/home/mostratec/site/2014/sistema/view/templates/curso.tpl" */ ?>
<?php /*%%SmartyHeaderCode:48167494653ebbd9a2c2076-33645278%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e67bd4a41745d2575ac7118b896ab74e74567833' => 
    array (
      0 => '/home/mostratec/site/2014/sistema/view/templates/curso.tpl',
      1 => 1405136643,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '48167494653ebbd9a2c2076-33645278',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'required' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_53ebbd9a2d2b90_61826460',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53ebbd9a2d2b90_61826460')) {function content_53ebbd9a2d2b90_61826460($_smarty_tpl) {?> <p class="form2">

        <label>Curso:</label><br /><br />

        <select id="f_curso" name="f_curso"  <?php echo $_smarty_tpl->tpl_vars['required']->value;?>
 >
            <option value="">Selecione um item da lista</option>
            <span>Selecione um item</span>
        </select>
       
        <input type="button" value="Cadastrar Outro Curso ..." class="button red" style="float: left; font-size: 12px; font-weight: bold;" onclick="show_dialog_curso();">    
       <!--<a href="#" class="links linkBotao" style="float: left;" onclick="show_dialog_curso();">Novo Curso</a> -->
            
 </p><?php }} ?>
