
<p class="form2">
    <input type="hidden" name="operacao" id="operacao"  value="{$operacao}" />
</p>

<p class="form2">
    <input type="hidden" name="papel" id="papel"  value="{$role}" />
</p>

<p class="form2">
    <input type="hidden" name="id" id="id" value="{if $operacao == 'edit'}{$usuario.id}{/if}" />
</p>

<p class="form2">
    <label>Nome:</label><br /><br />
    <input type="text" id="nome" name="nome" required="required" class="required"
           value="{if $operacao == 'edit'}{$usuario.nome}{/if}" {$disabled}/>
           <span></span> 
    </p>

    <p class="form2">
        <label>Email:</label><br /><br />
        <input type="email" id="email" name="email" required="required" class="required email"
               value="{if $operacao == 'edit'}
               {$usuario.email}
               {/if}" {$disabled}/>
               <span></span>    
        </p>
        {if $operacao == 'add'}
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
        {/if}