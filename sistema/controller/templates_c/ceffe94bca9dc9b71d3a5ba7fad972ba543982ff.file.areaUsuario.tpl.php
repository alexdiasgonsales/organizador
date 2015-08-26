<?php /* Smarty version Smarty-3.1.18, created on 2015-08-09 23:14:21
         compiled from "../view/templates/areaUsuario.tpl" */ ?>
<?php /*%%SmartyHeaderCode:49259040353eb7edb4663e8-35548992%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ceffe94bca9dc9b71d3a5ba7fad972ba543982ff' => 
    array (
      0 => '../view/templates/areaUsuario.tpl',
      1 => 1439154769,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '49259040353eb7edb4663e8-35548992',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_53eb7edb5483b9_23859586',
  'variables' => 
  array (
    'usuario' => 0,
    'HOME' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53eb7edb5483b9_23859586')) {function content_53eb7edb5483b9_23859586($_smarty_tpl) {?>
<?php echo $_smarty_tpl->getSubTemplate ('../../view/templates/cabecalho.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<div id="form_insc" style="margin-left:15px; margin-top:10px; margin-bottom: 10px;  background-color:#FFFFFF;">

  <div id="info_usuario" >
    <div style="background-color:#CCDAB4;width:98%;height:18px;padding-top:5px;padding-left:10px; padding-right: -10px;">
      <p style="font-weight:bold; margin-top: -2px;">Dados de identificação do usuário: </pl>
    </div>
    <a href="#" onclick="logout();"class="linkBotao" style="float: right; margin-top: 10px;">Sair</a>
    <div style="clear:both;height:10px;"></div>
  </div>
  <div align="left" style="margin-top: -10px;" >
    <table border="0" style="padding: 5px;">
      <tbody>
        <tr>
          <td>CPF</td>
          <td><?php echo $_smarty_tpl->tpl_vars['usuario']->value->cpf;?>
</td>
        </tr>
        <tr>
          <td>Nome</td>
          <td id="campo<?php echo $_smarty_tpl->tpl_vars['usuario']->value->id;?>
"><?php echo $_smarty_tpl->tpl_vars['usuario']->value->nome;?>
</td>
        </tr>
        <tr>
          <td >Email</td>
          <td id="campo_<?php echo $_smarty_tpl->tpl_vars['usuario']->value->id;?>
"><?php echo $_smarty_tpl->tpl_vars['usuario']->value->email;?>
</td>
        </tr>
      </tbody>

    </table>
    <input type="hidden" id="id" value="<?php echo $_smarty_tpl->tpl_vars['usuario']->value->id;?>
">

    <!--
    <span id="enviar<?php echo $_smarty_tpl->tpl_vars['usuario']->value->id;?>
">
      <a href="javascript:editar('<?php echo $_smarty_tpl->tpl_vars['usuario']->value->id;?>
')" class="linkBotao" style="font-size:10px;margin-left:10px; ">Alterar dados de usuário</a>
    </span>  
    
        <span id="trocar_senha">
      <a href="javascript:mostra_trocar_senha()" class="linkBotao" style="font-size:10px;margin-left:10px; ">Trocar senha</a>
    </span>  
-->
    <table name="tabela_trocar_senha" id="tabela_trocar_senha" border="0" style="padding: 5px; display:none;">
      <tbody>
        <tr>
          <td>Digite a nova senha</td>
          <td><input type="password" name="senha1" id="senha1"></td>
        </tr>
        <tr>
          <td>Repetir a nova senha</td>
          <td><input type="password" name="senha2" id="senha2"></td>
        </tr>
        <tr><td>
          <span id="confirma_trocar_senha">
          <a href="javascript:confirma_trocar_senha(<?php echo $_smarty_tpl->tpl_vars['usuario']->value->id;?>
)" class="linkBotao" style="font-size:10px;margin-left:10px; ">Confirmar troca de senha</a>
          </span>  
          <td>
          <span id="cancelar_trocar_senha">
          <a href="javascript:cancelar_trocar_senha()" class="linkBotao" style="font-size:10px;margin-left:10px; ">Cancelar troca de senha</a>
          </span>  
          </td>
          </tr>
      </tbody>

    </table>
          
  </div>

  <div style="background-color:#CCDAB4;width:99%;height:18px;padding-top:5px;padding-left:10px; margin-top: 10px;">
    
    <p style="font-weight:bold; margin-top: -2px; width: 100%;">Clique nos botões abaixo para acessar suas áreas: </p>  </div> 
    
<!--
    <a href="#" class="link1" onclick="mostrarAut();">
      <fieldset id="botaoAut" style="<?php if ($_smarty_tpl->tpl_vars['usuario']->value->autor) {?> display:block; <?php } else { ?> display:none; <?php }?> background-color: #CCDAB4;float:left;margin-top:15px;padding:5px;"> Área do Autor </fieldset>
    </a> &nbsp;
    
    <a href="#" class="link1" onclick="mostrarOrien();">
    <fieldset id="botaoOrien" style="<?php if ($_smarty_tpl->tpl_vars['usuario']->value->orientador) {?> display:block; <?php } else { ?> display:none; <?php }?> background-color: #CCDAB4;float:left;margin-top:15px;padding:5px;"> Área do Orientador </fieldset>
    </a> &nbsp;
    
    <a href="#" class="link1" onclick="mostrarAval();">
    <fieldset id="botaoAval" style="<?php if ($_smarty_tpl->tpl_vars['usuario']->value->avaliador) {?> display:block; <?php } else { ?> display:none; <?php }?> background-color: #CCDAB4;float:left;margin-top:15px;padding:5px;"> Área do Avaliador </fieldset>
    </a> &nbsp;
    
    <a href="#" class="link1" onclick="mostrarOuv();">
    <fieldset id="botaoOuv" style="<?php if ($_smarty_tpl->tpl_vars['usuario']->value->ouvinte) {?> display:block; <?php } else { ?> display:none; <?php }?> background-color: #CCDAB4;float:left;margin-top:15px;padding:5px;"> Área do Ouvinte </fieldset>
    </a> &nbsp;
    
    <a href="#" class="link1" onclick="mostrarVol();">
    <fieldset id="botaoVol" style="<?php if ($_smarty_tpl->tpl_vars['usuario']->value->voluntario) {?> display:block; <?php } else { ?> display:none; <?php }?> background-color: #CCDAB4;float:left;margin-top:15px;padding:5px;"> Área do Voluntário </fieldset>
    </a>

    
    <a href="#" class="link1" onclick="mostrarRev();">
    <fieldset id="botaoRev" style="<?php if ($_smarty_tpl->tpl_vars['usuario']->value->revisor) {?> display:block; <?php } else { ?> display:none; <?php }?> background-color: #CCDAB4;float:left;margin-top:15px;padding:5px;"> Área do Revisor </fieldset>
    </a> 
-->    
    <a href="#" class="link1" onclick="mostrarOrg();">
    <fieldset id="botaoOrg" style="<?php if (($_smarty_tpl->tpl_vars['usuario']->value->organizador&&$_smarty_tpl->tpl_vars['usuario']->value->organizadorStatus=='1')) {?> display:block; <?php } else { ?> display:none; <?php }?> background-color: #CCDAB4;float:left;margin-top:15px;padding:5px;"> Área Organizador </fieldset>
    </a> 

  <div style="clear:both;height:20px;"></div>
    
                                                                                                                                                                                                                    

  <fieldset id="pgAutor" style="display:none;margin-top:15px;background-color: #FFFFFF;"> </fieldset>
  <fieldset id="pgOrientador" style="display:none;margin-top:15px;background-color: #FFFFFF;"> </fieldset>
  <fieldset id="pgAvaliador" style="display:none;margin-top:15px;background-color: #FFFFFF;"> </fieldset>
  <fieldset id="pgVoluntario" style="display:none;margin-top:15px;background-color: #FFFFFF;"> </fieldset>
  <fieldset id="pgOuvinte" style="display:none;margin-top:15px;background-color: #FFFFFF;"> </fieldset>
  <fieldset id="pgOrganizador" style="display:none;margin-top:15px;background-color: #FFFFFF;"> </fieldset>
  <fieldset id="pgRevisor" style="display:none;margin-top:15px;background-color: #FFFFFF;"> </fieldset>

  <div id="msg"> </div>

</div> <!-- form_insc fim -->

<script src="<?php echo $_smarty_tpl->tpl_vars['HOME']->value;?>
js/controllerareas.js" type="text/javascript"></script> 
<?php echo $_smarty_tpl->getSubTemplate ('../../view/templates/dialog.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate ('../../view/templates/rodape.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php }} ?>
