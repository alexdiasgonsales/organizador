    <p class="form2">

        <label>Área Temática: </label><br /><br />
        
        <select id="areaTematica" name="areaTematica" class="required" required="required">
            <option value="">Selecione um item da lista</option>
            {foreach $tematica as $area}
            <option value="{$area->id_area}">{$area->nome}</option>
            {/foreach}
            <span>Selecione um item</span>
        </select>

    </p>