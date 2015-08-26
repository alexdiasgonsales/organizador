<?php /* Smarty version Smarty-3.1.18, created on 2014-09-11 15:59:05
         compiled from "/home/mostratec/site/2014/sistema/view/templates/areaTematica.tpl" */ ?>
<?php /*%%SmartyHeaderCode:20160822305411f0f9bce618-20365944%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e37714b020e81a0e7c32346f52f110058e360e14' => 
    array (
      0 => '/home/mostratec/site/2014/sistema/view/templates/areaTematica.tpl',
      1 => 1405136644,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '20160822305411f0f9bce618-20365944',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'tematica' => 0,
    'area' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_5411f0f9c19074_33540149',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5411f0f9c19074_33540149')) {function content_5411f0f9c19074_33540149($_smarty_tpl) {?>    <p class="form2">

        <label>Área Temática: </label><br /><br />
        
        <select id="areaTematica" name="areaTematica" class="required" required="required">
            <option value="">Selecione um item da lista</option>
            <?php  $_smarty_tpl->tpl_vars['area'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['area']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['tematica']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['area']->key => $_smarty_tpl->tpl_vars['area']->value) {
$_smarty_tpl->tpl_vars['area']->_loop = true;
?>
            <option value="<?php echo $_smarty_tpl->tpl_vars['area']->value->id_area;?>
"><?php echo $_smarty_tpl->tpl_vars['area']->value->nome;?>
</option>
            <?php } ?>
            <span>Selecione um item</span>
        </select>

    </p><?php }} ?>
