<option value="" selected="on">Selecione um item na lista</option>
{foreach  $instituicoes as $i} 
    <option value="{$i->id_instituicao}">{$i->nome}</option>
{/foreach} 