<div id="especificos" style="float: left; text-align: center;"> <h4> - Dados Específicos - </h4> 

    <p class="form2">

        <label>Instituição:</label> <br /><br />
        <select id="f_instituicao" name="f_instituicao"  onchange="getCampus(); return false;" {$required}>
            <option value="">Selecione um item da lista</option>
            {foreach $instituicao as $i}
            <option value="{$i->id_instituicao}">{$i->nome}</option>
            {/foreach}
            <span>Selecione um item</span>
        </select>
       
     <input type="button" value="Cadastrar Outra Instituição ..." class="button red" style="float: left; font-size: 12px; font-weight: bold;" onclick="show_dialog_instituicao();">
            <!--
       <a href="#" class="links linkBotao" style="float: left;" onclick="nova();">Nova Instituição</a> 
            -->
    </p>
    
    