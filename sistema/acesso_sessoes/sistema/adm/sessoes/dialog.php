

<!------------------ Escolher Instituicao --------------------->
<div id="dialog_instituicao" title="Escolher Instituição" style="display: none;">

    <p>Certifique-se de que sua instituição não consta na lista abaixo antes de cadastrar uma nova instituição.</p>

    <p>Se a instituição estiver na lista, selecione a mesma e clique em 'Escolher'.</p>
    
    <p>Se a instituição não estiver na lista, clique em 'Cadastrar Nova instituição ...'</p>

    <select id="f_instituicao_2" name="f_instituicao_2" class="n_instituicao" >
        <option value="0">Selecione uma opcão</option>
    </select>

</div>

<!------------------ Nova Instituicao --------------------->

<div id="dialog_cad_instituicao" title="Cadastrar uma nova instituição" style="display: none;">
    <p>ATENÇÃO: Somente cadastre uma nova Instituição se ela ainda não estiver cadastrada.</p>

    <label>Nome: </label>
    <input type="text" id="nome_inst" name="nome_inst" class="dia_cad"/>  <br /><br /> 
    <label>Sigla: </label>
    <input type="text" id="sigla_inst" name="sigla_inst" class="dia_cad"/>  <br /><br /> 
    <label>Cidade: </label>
    <input type="text" id="cidade_inst" name="cidade_inst" class="dia_cad"/> <br /><br /> 
    <label>Estado: </label>
    <input type="text" id="estado_inst" name="estado_inst" class="dia_cad"/> <br /><br /> 
    <label>Site: </label>
    <input type="text" id="site_inst" name="site_inst" class="dia_cad"/>  <br /><br /> 

    <label>Tipo:</label>
    <select name="tipo_inst" class = "dia_cad">
        <option value="0">Selecione uma opcao</option>
        <option value="1">Instituto Federal</option>
        <option value="2">Escola Técnica</option>
        <option value="3">Instituição de Ensino Superior</option>
        <option value="4">Empresa</option>
        <option value="5">Outro tipo</option>
    </select>

</div>

<!------------------ Escolher Campus --------------------->

<div id="dialog_campus" title="Escolher Campus" style="display: none;">
    <p>Certifique-se de que seu campus não consta na lista abaixo antes de cadastrar um novo campus.</p>

    <p>Se o campus estiver na lista, selecione o mesmo e clique em 'Escolher'.</p>
    
    <p>Se o campus não estiver na lista, clique em 'Cadastrar Novo Campus ...'</p>

    <select id="f_campus_2" name="f_campus_2" class="n_campus" >
        <option value="0">Selecione uma opção</option>
    </select>

</div>

<!------------------ Novo Campus --------------------->

<div id="dialog_cad_campus" title="Cadastrar Campus" style="display: none;">
    <p>Obs: Tenha certeza de ter selecionado a Instituição correta.</p>

    <label>Nome do Campus: </label>
    <input type="text" id="nome_campus" name="nome_campus" class="dia_cad"/>  <br /><br />

    <label>Cidade: </label>
    <input type="text" id="cidade_campus" name="cidade_campus" class="dia_cad"/>  <br /><br />
    
</div>

<!------------------ Escolher Curso --------------------->

<div id="dialog_curso" title="Escolher Curso" 
 style="display: none; width:auto;">
    <p>Certifique-se de que seu Curso não consta na lista abaixo antes de cadastrar um novo curso.</p>

    <p>Se o curso estiver na lista, selecione o mesmo e clique em 'Escolher'.</p>
    
    <p>Se o curso não estiver na lista, clique em 'Cadastrar Novo Curso ...'</p>
    
    <select id="f_curso_2" name="f_curso_2" class="n_curso" style="width:auto;">
        <option value="0">Selecione</option>
    </select>
<!--
    <p class="min_texto"><a href="#" class = "links" >Escolher</a>&nbsp;&nbsp;
        <a href="#" class = "links" onclick="Cancelar()">Cancelar</a><br /><br />
        <a href="#" class = "links" onclick="cadNovoCurso()">Cadastrar Novo Curso</a></p>
-->
</div>

<!------------------ Novo Curso --------------------->

<div id="dialog_cad_curso" title="Cadastrar Novo Curso" style="display: none;">
    <p>ATENÇÃO: Somente cadastre um novo curso se ele ainda não estiver cadastrado.</p>

    <label>Nome do curso: </label>
    <input type="text" id="nome_curso" name="nome_curso" class="dia_cad"/>  <br /><br /><br /> 

    <label>Nível: </label>
    <select id="nivel_curso" name="nivel_curso" class = "dia_cad" style="width:auto;">
        <option value="0">Selecione</option>
        <option value="2">Técnico</option>
        <option value="3">Superior</option>
    </select>

    <!--
    <p class="min_texto"><a href="#" class = "links" >Cadastrar</a>&nbsp;&nbsp;
        <a href="#" class = "links" onclick="Cancelar()">Cancelar Cadastro</a><br /><br /><p>
-->

</div>

<!------------------ ALERTA PADRÃO --------------------->
<div id="dialog_alert_all" title="Alerta!!!" style="display: none;">
  <p id="dialog_msg">
    Você esqueceu alguma informação anterior. Por favor, verifique!
  </p>
</div>
