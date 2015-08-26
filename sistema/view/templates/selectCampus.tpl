<option value="" selected="on">Selecione um item na lista</option>
{foreach  $campus as $c} 
    <option value="{$c->id_campus}">{$c->nome}</option>
{/foreach} 