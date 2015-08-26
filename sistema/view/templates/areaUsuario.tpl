
{include '../../view/templates/cabecalho.tpl'}

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
          <td>{$usuario->cpf}</td>
        </tr>
        <tr>
          <td>Nome</td>
          <td id="campo{$usuario->id}">{$usuario->nome}</td>
        </tr>
        <tr>
          <td >Email</td>
          <td id="campo_{$usuario->id}">{$usuario->email}</td>
        </tr>
      </tbody>

    </table>
    <input type="hidden" id="id" value="{$usuario->id}">

    <!--
    <span id="enviar{$usuario->id}">
      <a href="javascript:editar('{$usuario->id}')" class="linkBotao" style="font-size:10px;margin-left:10px; ">Alterar dados de usuário</a>
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
          <a href="javascript:confirma_trocar_senha({$usuario->id})" class="linkBotao" style="font-size:10px;margin-left:10px; ">Confirmar troca de senha</a>
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
      <fieldset id="botaoAut" style="{if $usuario->autor} display:block; {else} display:none; {/if} background-color: #CCDAB4;float:left;margin-top:15px;padding:5px;"> Área do Autor </fieldset>
    </a> &nbsp;
    
    <a href="#" class="link1" onclick="mostrarOrien();">
    <fieldset id="botaoOrien" style="{if $usuario->orientador} display:block; {else} display:none; {/if} background-color: #CCDAB4;float:left;margin-top:15px;padding:5px;"> Área do Orientador </fieldset>
    </a> &nbsp;
    
    <a href="#" class="link1" onclick="mostrarAval();">
    <fieldset id="botaoAval" style="{if $usuario->avaliador} display:block; {else} display:none; {/if} background-color: #CCDAB4;float:left;margin-top:15px;padding:5px;"> Área do Avaliador </fieldset>
    </a> &nbsp;
    
    <a href="#" class="link1" onclick="mostrarOuv();">
    <fieldset id="botaoOuv" style="{if $usuario->ouvinte} display:block; {else} display:none; {/if} background-color: #CCDAB4;float:left;margin-top:15px;padding:5px;"> Área do Ouvinte </fieldset>
    </a> &nbsp;
    
    <a href="#" class="link1" onclick="mostrarVol();">
    <fieldset id="botaoVol" style="{if $usuario->voluntario} display:block; {else} display:none; {/if} background-color: #CCDAB4;float:left;margin-top:15px;padding:5px;"> Área do Voluntário </fieldset>
    </a>

    
    <a href="#" class="link1" onclick="mostrarRev();">
    <fieldset id="botaoRev" style="{if $usuario->revisor} display:block; {else} display:none; {/if} background-color: #CCDAB4;float:left;margin-top:15px;padding:5px;"> Área do Revisor </fieldset>
    </a> 
-->    
    <a href="#" class="link1" onclick="mostrarOrg();">
    <fieldset id="botaoOrg" style="{if ($usuario->organizador && $usuario->organizadorStatus eq '1')} display:block; {else} display:none; {/if} background-color: #CCDAB4;float:left;margin-top:15px;padding:5px;"> Área Organizador </fieldset>
    </a> 

  <div style="clear:both;height:20px;"></div>
    
  {* 4 - O botão "Area do Organizador" ficou desalinhado.  Verifica o que pode ser. *}                                                                                                                                                                                                                  

  <fieldset id="pgAutor" style="display:none;margin-top:15px;background-color: #FFFFFF;"> </fieldset>
  <fieldset id="pgOrientador" style="display:none;margin-top:15px;background-color: #FFFFFF;"> </fieldset>
  <fieldset id="pgAvaliador" style="display:none;margin-top:15px;background-color: #FFFFFF;"> </fieldset>
  <fieldset id="pgVoluntario" style="display:none;margin-top:15px;background-color: #FFFFFF;"> </fieldset>
  <fieldset id="pgOuvinte" style="display:none;margin-top:15px;background-color: #FFFFFF;"> </fieldset>
  <fieldset id="pgOrganizador" style="display:none;margin-top:15px;background-color: #FFFFFF;"> </fieldset>
  <fieldset id="pgRevisor" style="display:none;margin-top:15px;background-color: #FFFFFF;"> </fieldset>

  <div id="msg"> </div>

</div> <!-- form_insc fim -->

<script src="{$HOME}js/controllerareas.js" type="text/javascript"></script> 
{include '../../view/templates/dialog.tpl'}
{include '../../view/templates/rodape.tpl'}
