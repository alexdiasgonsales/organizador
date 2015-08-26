<?php /* Smarty version Smarty-3.1.18, created on 2014-08-13 13:31:11
         compiled from "/home/mostratec/site/2014/sistema/view/templates/usuario.tpl" */ ?>
<?php /*%%SmartyHeaderCode:200804105253eb92cf0d2868-57710736%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a7dded24d7febde3cb9520f35a5b104a67d91b03' => 
    array (
      0 => '/home/mostratec/site/2014/sistema/view/templates/usuario.tpl',
      1 => 1405136642,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '200804105253eb92cf0d2868-57710736',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'operacao' => 0,
    'role' => 0,
    'usuario' => 0,
    'disabled' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_53eb92cf0f7a50_17028776',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53eb92cf0f7a50_17028776')) {function content_53eb92cf0f7a50_17028776($_smarty_tpl) {?>
<p class="form2">
    <input type="hidden" name="operacao" id="operacao"  value="<?php echo $_smarty_tpl->tpl_vars['operacao']->value;?>
" />
</p>

<p class="form2">
    <input type="hidden" name="papel" id="papel"  value="<?php echo $_smarty_tpl->tpl_vars['role']->value;?>
" />
</p>

<p class="form2">
    <input type="hidden" name="id" id="id" value="<?php if ($_smarty_tpl->tpl_vars['operacao']->value=='edit') {?><?php echo $_smarty_tpl->tpl_vars['usuario']->value['id'];?>
<?php }?>" />
</p>

<p class="form2">
    <label>Nome:</label><br /><br />
    <input type="text" id="nome" name="nome" required="required" class="required"
           value="<?php if ($_smarty_tpl->tpl_vars['operacao']->value=='edit') {?><?php echo $_smarty_tpl->tpl_vars['usuario']->value['nome'];?>
<?php }?>" <?php echo $_smarty_tpl->tpl_vars['disabled']->value;?>
/>
           <span></span> 
    </p>

    <p class="form2">
        <label>Email:</label><br /><br />
        <input type="email" id="email" name="email" required="required" class="required email"
               value="<?php if ($_smarty_tpl->tpl_vars['operacao']->value=='edit') {?>
               <?php echo $_smarty_tpl->tpl_vars['usuario']->value['email'];?>

               <?php }?>" <?php echo $_smarty_tpl->tpl_vars['disabled']->value;?>
/>
               <span></span>    
        </p>
        <?php if ($_smarty_tpl->tpl_vars['operacao']->value=='add') {?>
            <p class="form2">
                <label>Senha:</label><br /><br />
                <input type="password" id="senha" name="senha" required="required" class="required password" value=""/>
                <span></span>  
            </p>

            <p class="form2">
                <label>Contra-Senha:</label><br /><br />
                <input type="password" id="rsenha" name="rsenha"  required="required" class="required password" value=""/>
                <span></span> 
            </p>
        <?php }?><?php }} ?>
