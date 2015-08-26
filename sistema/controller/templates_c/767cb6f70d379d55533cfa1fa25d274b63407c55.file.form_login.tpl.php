<?php /* Smarty version Smarty-3.1.18, created on 2015-08-09 21:21:01
         compiled from "/opt/lampp/htdocs/2014novo/sistema/view/templates/form_login.tpl" */ ?>
<?php /*%%SmartyHeaderCode:158923775155c7a81d91f3a3-88513996%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '767cb6f70d379d55533cfa1fa25d274b63407c55' => 
    array (
      0 => '/opt/lampp/htdocs/2014novo/sistema/view/templates/form_login.tpl',
      1 => 1410665792,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '158923775155c7a81d91f3a3-88513996',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'HOME' => 0,
    'desabilitarImagem' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_55c7a81d999586_40700848',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55c7a81d999586_40700848')) {function content_55c7a81d999586_40700848($_smarty_tpl) {?>

<div id="form_insc">
    <form id="f1" class="validate" method="post" action="<?php echo $_smarty_tpl->tpl_vars['HOME']->value;?>
controller/ControllerLogin.php"  >
        <!--
          <h3 align="center">Login de Usuário</h3>
        -->

        <h2>Atenção</h2>
        <h3>Todos autores e orientadores devem efetuar a inscrição no sistema<br> para poder ter seu nome vinculado ao trabalho.</h3>

        <h3>Apenas o autor principal (primeiro autor) do trabalho deverá fazer o cadastro e envio do trabalho.</h3>

        <h4>Se você já está cadastrado no sistema, digite seu CPF e senha e clique em Entrar, caso contrário, efetue sua inscrição.</h4>

        <p class="form">
            <label class="lblogin">CPF:</label>
            <input type="text" name="cpf" id="cpf" class="required cpf" value="" />
            <span>Campo requerido, informe um CPF válido</span>
        </p> 

        <p class="form">
            <label class="lblogin">Senha:</label>
            <input type="password" name="senha" id="senha" class="required" />
        </p> 

        <img width="150px" height="150px" style="float: left; margin-top: -75px;" src="<?php echo $_smarty_tpl->tpl_vars['HOME']->value;?>
images/acesso_negado.jpg" <?php echo $_smarty_tpl->tpl_vars['desabilitarImagem']->value;?>
/> 
        <div id="msgSenha" class="form msg" style="width: auto; height: auto;"></div>
        <p class="botoes">
            <button id="reset" class="button gray reset">Limpar</button>
            <button id="submit" class="button blue submit">Entrar</button>
        </p>


    </form>

    <div id="inscricao" style="margin-top: 10px;">

        <p style="margin-bottom: 20px;"><a href="#" class="linkBotao" onclick="mostra_esqueci_senha();">Esqueci a Senha</a></p>

        <!-- Retirado em 09/08/2014
        <p><a href="<?php echo $_smarty_tpl->tpl_vars['HOME']->value;?>
controller/ControllerUsuario.php?role=autor"><h3>Inscrição de Autor</h3></a></p>
        <p><a href="<?php echo $_smarty_tpl->tpl_vars['HOME']->value;?>
controller/ControllerUsuario.php?role=orientador"><h3>Inscrição de Orientador</h3></a></p>
        <p><a href="<?php echo $_smarty_tpl->tpl_vars['HOME']->value;?>
controller/ControllerUsuario.php?role=avaliador" ><h3>Inscrição de Avaliador</h3></a></p>
        <p><a href="<?php echo $_smarty_tpl->tpl_vars['HOME']->value;?>
controller/ControllerUsuario.php?role=voluntario" ><h3>Inscrição de Voluntário</h3></a></p>
        <p><a href="<?php echo $_smarty_tpl->tpl_vars['HOME']->value;?>
controller/ControllerUsuario.php?role=ouvinte" ><h3>Inscrição de Ouvinte</h3></a></p>
        -->
        
        <div id="modal_esqueci_senha" style="display: none;">
            <label style="margin-top: 5px;">CPF:</label>  
            <input type="text" name="cpf" id="cpfEsqueceu" class="cpf"/>
            <p style="margin-bottom: 20px;"><a href="#" class="linkBotao" onclick="enviar_pedido_senha();">Enviar Requisição</a></p>
            <p style="text-align: center;">Por favor, informe o seu cpf vinculado ao seu cadastro na Mostra, para  que  uma  senha temporária seja enviada para o seu email.</p>
        </div><!-- Fim da form inscricao -->
    </div><!-- Fim da DIV inscricao -->
</div><!-- Fim da DIV FORM_INSC -->
<script>
    function mostra_esqueci_senha() {
        $(function() {
            $("#modal_esqueci_senha").dialog({
                width: 350,
                height: 230,
                resizable: false,
                draggable: false,
                modal: true
            });
        });
    }

    function enviar_pedido_senha() {
        $("#modal_esqueci_senha").dialog("close");
        var str = 'cpf=' + $('#cpfEsqueceu').val();
        var destino = home + 'controller/ControllerEnviarSenha.php';
        
       // $(location).attr('href', destino);
        $.ajax({
            type: "GET",
            url: destino,
            data: str,
            success: function() {
                alert('Uma senha temporária será enviada para o seu e-mail. Aguarde alguns minutos.');
                $("#modal_esqueci_senha").dialog("close");
            }
        });
    }

</script><?php }} ?>
