<?php /* Smarty version Smarty-3.1.18, created on 2014-08-14 18:59:08
         compiled from "/home/mostratec/site/2014/sistema/view/templates/voluntarioComplemento.tpl" */ ?>
<?php /*%%SmartyHeaderCode:189227202853ed312c218597-56178369%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '33b43554e5b3e6391088a5e4f001e5f005fd53df' => 
    array (
      0 => '/home/mostratec/site/2014/sistema/view/templates/voluntarioComplemento.tpl',
      1 => 1405136645,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '189227202853ed312c218597-56178369',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_53ed312c224a70_34131542',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53ed312c224a70_34131542')) {function content_53ed312c224a70_34131542($_smarty_tpl) {?>
<div class="form" align="center">
    <h2> - Turnos Disponíveis - </h2> 
    <p class="form">   
        <input type="checkbox" value="M" name="chk[]" id="cbManha" class="required inpCheck"><label for="cbManhaD" class = "turno">Manhã</label>
        <input type="checkbox" value="T" name="chk[]" id="cbTarde" class="required inpCheck"><label for="cbTardeD" class = "turno">Tarde</label>
        <input type="checkbox" value="N" name="chk[]" id="cbNoite" class="required inpCheck"><label for="cbNoiteD" class = "turno">Noite</label>
        <span></span>
    </p>
</div>

<div class="form" align="center">
    <h2> - Contato - </h2>
    <p align="left">        
        <label>Telefone (obrigatório):</label>
        <input type="text" id="telefone" class="phoneNumber"  name="telefone1" required="required"/>
        <span></span>
    </p> 
    <p class="formAjust"> 
        <label>Telefone:</label>
        <input type="text" id="telefone2" class="phoneNumber"  name="telefone2"/>
        <span></span>
    </p>
    <p  align="left">  
        <label>Telefone:</label>
        <input type="text" id="telefone3" class="phoneNumber" name="telefone3"/>
        <span></span>
    </p>
</div>
<?php }} ?>
