<?php /* Smarty version Smarty-3.1.18, created on 2014-09-11 15:59:05
         compiled from "/home/mostratec/site/2014/sistema/view/templates/nivelFormacao.tpl" */ ?>
<?php /*%%SmartyHeaderCode:6636813385411f0f9bbef85-66730018%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3f825b2a620c76b5ce12ce6bf66c58f82dec0bbb' => 
    array (
      0 => '/home/mostratec/site/2014/sistema/view/templates/nivelFormacao.tpl',
      1 => 1405136644,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6636813385411f0f9bbef85-66730018',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_5411f0f9bccea9_26547363',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5411f0f9bccea9_26547363')) {function content_5411f0f9bccea9_26547363($_smarty_tpl) {?><p class="form2">

    <label>Nível de formação:</label><br /><br />

    <select name="servForm" id="servForm" required="required">
        <option value="">Selecione um item na lista</option>
        <option value="3">Superior</option>
        <option value="4">Especialização</option>
        <option value="5">Mestrado</option>
        <option value="6">Doutorado</option>
        <span>Selecione um item</span>
    </select>
    
</p>    


<?php }} ?>
