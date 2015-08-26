<?php 



?>
<div>
	<div style="clear:both; height:30px;"></div>
	<label> Alterar Status do Trabalho: </label>
	<div style="clear:both; height:5px;"></div>
	<select id="status">
		<option value="0"> Pendente </option>
		<option value="1"> Enviado </option>
		<option value="2"> Aceito </option>
		<option value="3"> Pendente Correção </option>
		<option value="4"> Reenviado </option>
		<option value="5"> Recusado </option>
	</select>

	<div style="clear:both; height:30px;"></div>
	<label> Motivo: </label>
	<div style="clear:both; height:5px;"></div>
	<textarea id="motivo" type="textarea" width="1000px;" height="150px" maxlength="100" > </textarea>

	<div style="clear:both; height:30px;"></div>
	<label> Observações: </label>
	<div style="clear:both; height:5px;"></div>
	<textarea id="observacoes" type="textarea" width="1000px;" height="150px" maxlength="200" > </textarea>

	<div style="clear:both; height:30px;"></div>
	<a href="" style="button blue"> Atualizar </a>
</div>