<option value="" selected="on">Selecione um item na lista</option>
{foreach  $cursos as $cc} 
    <option value="{$cc->id_curso}">{$cc->nivelDesc}{$cc->nome}</option>
{/foreach} 

