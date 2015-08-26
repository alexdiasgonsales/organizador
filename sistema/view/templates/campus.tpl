<p class="form2">

    <label>Campus:</label><br /><br />
    
    <select id="f_campus" name="f_campus"  onchange="getCursos(); return false;" {$required}>
        <option value="">Selecione um item da lista</option>       
        <span>Selecione um item</span>
    </select>
        
     <input type="button" value="Cadastrar Outro Campus ..." class="button red" style="float: left; font-size: 12px; font-weight: bold;" onclick="show_dialog_campus();">
     <!--<a href="#" class="links linkBotao" style="float: left;" onclick="show_dialog_campus();">Novo Campus</a> -->
        
</p>