<?php
session_start();

include("../../../conexao.php");
include("../../../funcoes.php");

if(!(isset($_SESSION['id_administracao']))) {
    header("Location: index.php?diff=".elDiff());
}

if (!isset($_SESSION['adm2']))
   {
      header("Location: index.php?diff=".elDiff());
   }


?>

<?php
include("../inc_cabecalho.php");
?>


<script language="javascript">
function valida_campo()
{
  if (document.form_index.cpf.value=="")
     {
        alert('Digite o CPF.');
        document.form_index.cpf.focus();
        return false;
     }

  if ((document.form_index.tipo_ouvinte[0].checked==false)&&(document.form_index.tipo_ouvinte[1].checked==false)&&(document.form_index.tipo_ouvinte[2].checked==false)&&(document.form_index.tipo_ouvinte[3].checked==false))
     {
        alert('Selecione o tipo de ouvinte');
        //document.form_index.cpf.focus();
        return false;
     }

	 return true;
}

function retorna_numero()
  {
    if (event.keyCode >= 48 && event.keyCode <= 57)
     {
     return true
     }
    else
     {
     return false
     }
  }
  
</script>
<div id="cont">
<input type="button" value="Voltar" onclick="self.open('lista.php?diff=<?php echo elDiff(); ?>','_self')" style="width:160px"><br />
<hr>
<br />
<table width="100%" border="0" cellpadding="3" cellspacing="0" align="center">
<tr>
<td valign="top">


<form method="post" name="form_index" action="informacoes.php?diff=<?php echo elDiff(); ?>" target="_self" onsubmit="return valida_campo()" >

<table width="200" border="0" cellpadding="3" cellspacing="0" align="center">

  <tr>
    <td align="center" bgcolor="#ffffff" colspan="2" valign="top">
       <b style="font-size:14px">Inscrições - Ouvintes</b><br><br>
    </td>
  </tr>

  <tr>
    <td bgcolor="#ffffff" colspan="2" align="center">
      <table width="200" border="0" cellpadding="3" cellspacing="0" align="center">
 	     <tr>
            <td>
              &nbsp;<strong>CPF:</strong>
            </td>
            <td>
              &nbsp;<input type="text" name="cpf" id="cpf" maxlength="11" size="11" style="width:150px" value="" onKeyPress="return retorna_numero();">
            </td>
         </tr>
         <tr>
		    <td valign="top">
              &nbsp;<strong>Ouvinte:</strong>
            </td>
            <td>
              &nbsp;<input type="radio" name="tipo_ouvinte" value="1">&nbsp;Docente (professor)<br/>    
              &nbsp;<input type="radio" name="tipo_ouvinte" value="2">&nbsp;Técnico Administrativo<br/>    
              &nbsp;<input type="radio" name="tipo_ouvinte" value="3">&nbsp;Discente (estudante)<br/>    
              &nbsp;<input type="radio" name="tipo_ouvinte" value="4">&nbsp;Outro<br />
            </td>
         </tr>
      </table>    
    </td>
  </tr>
  <tr>
    <td bgcolor="#ffffff" align="center" colspan="2">
       <br>
       <input type="submit" value="Enviar" class="button blue">
       <br /><br />
    </td>
  </tr>

</table>
</form>

</td>
<td>
<td valign="top">

<?php
  // Ouvintes autores
  $sql_autores= "SELECT u.* 
  FROM usuario u, autor a, ouvinte o, trabalho_autor_curso tac, trabalho t 
  WHERE (u.id_usuario=o.fk_usuario) 
  AND (a.fk_usuario=u.id_usuario)
  AND (tac.fk_autor = u.id_usuario)
  AND (t.id_trabalho=tac.fk_trabalho)
  AND (t.status=2) 
  ORDER BY u.nome ASC"; // Autores somente com trabalhos aceitos
  //$sql_autores= "SELECT autor.* FROM autor ORDER BY autor.nome ASC ;"; // Todos os autores
  $result_autores= mysql_query($sql_autores,$conexao);
  $num_reg_autores= mysql_num_rows($result_autores);

  // Ouvintes não-autores
  $sql_nao_autores= "SELECT u.* FROM ouvinte o, usuario u WHERE o.fk_usuario NOT IN (SELECT fk_usuario FROM autor) AND (u.id_usuario = o.fk_usuario) ORDER BY nome ASC ;";
  $result_nao_autores= mysql_query($sql_nao_autores,$conexao);
  $num_reg_nao_autores= mysql_num_rows($result_nao_autores);
  if($result_nao_autores==false)
	echo mysql_error();
?>

<table border=1 width="410px" align='center'>
<tr>
<td align='center'>
<strong>Ouvintes autores</strong>
</tr>
<tr>
<td align='center' valign="top">
<br />
<select name="id_autor" size="10" style="width: 400px;">
<?php
  while ($linha_autores = mysql_fetch_array($result_autores))
     {
         echo "<option value='".$linha_autores['id_autor']."'>".$linha_autores['nome']." - ".$linha_autores['cpf']."</option>";
	 }
?>
</select><br />
</td>
</tr>
<tr>
<td align='center'>
<strong>Ouvintes não-autores</strong>
</tr>
<tr>
<td align='center' valign="top">
<!--<form name="editar_ouvinte" method="post" action="execute_editar_ouvinte.php?acao=editar_ouvinte">-->
<br />
<select name="id_ouvinte" size="10" style="width: 400px;">
<?php
  while ($linha_nao_autores = mysql_fetch_array($result_nao_autores))
     {
         echo "<option value='".$linha_nao_autores['id_ouvinte']."'>".$linha_nao_autores['nome']." - ".$linha_nao_autores['cpf']."</option>";
	 }
?>
</select><br />
<!--<input type="submit" value="Editar" class="button red">
</form>-->
</td>
</tr>


</table><br />

</td>
</tr>
</table>
</div>
<?php
include("../inc_rodape.php");
?>
