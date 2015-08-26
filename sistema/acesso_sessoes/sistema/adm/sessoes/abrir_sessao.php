<?php
session_start();

include("../../../conexao.php");
include("funcoes_sessoes.php");

if(!(isset($_SESSION['id_administracao']))) {
    header("Location: index.php?diff=".elDiff());
} 

if (!isset($_SESSION['adm2'])) {
      header("Location: index.php?diff=".elDiff());
}
if (isset($_REQUEST['id_sessao'])) {
      $_SESSION['id_sessao']=$_REQUEST['id_sessao'];
}

$id_sessao=$_SESSION['id_sessao'];   

// Filtro Area Trabalho
if (isset($_REQUEST['id_area'])) {
      $_SESSION['id_area']=$_REQUEST['id_area'];
}
$req_id_area = $_SESSION['id_area'];

// Filtro Area Avaliador
if (isset($_REQUEST['id_area_ava'])) {
      $_SESSION['id_area_ava']=$_REQUEST['id_area_ava'];
}
$req_id_area_ava = $_SESSION['id_area_ava'];

$mensagem="<b>Área de Avisos.</b>";

$array_modalidade[0]="x";
$array_modalidade[1]="Oral";
$array_modalidade[2]="Pôster";

$n_mens=0;

if (isset($_REQUEST['n_mens'])) {
       $n_mens=(int)$_REQUEST['n_mens'];
}


if ($n_mens==1)
   $mensagem=" Trabalho removido com sucesso"; 
if ($n_mens==2)
   $mensagem=" Trabalho incluído com sucesso"; 
if ($n_mens==3)
   $mensagem=" Avaliador removido com sucesso"; 
if ($n_mens==4)
   $mensagem=" Avaliador incluido com sucesso"; 
if ($n_mens==5)
   $mensagem=" Erro ao incluir o trabalho: Um ou mais orientadores é avaliador nesta sessão"; 
if ($n_mens==6)
   $mensagem=" Erro ao incluir: O avaliador é orientador de um ou mais trabalhos nesta sessão"; 
if ($n_mens==7)
   $mensagem=" Erro ao incluir o trabalho: Modalidade do trabalho diferente da modalidade da sessão"; 
if ($n_mens==8)
   $mensagem=" Avaliador confirmado"; 
if ($n_mens==9)
   $mensagem=" ATENÇÃO! operação cancelada: Autor principal já está vinculado a uma sessão neste horário"; 
if ($n_mens==10)
   $mensagem=" ATENÇÃO! operação cancelada: Avaliador já está vinculado a uma sessão neste horário"; 
if ($n_mens==11)
   $mensagem=" Selecione um trabalho"; 
if ($n_mens==12)
   $mensagem=" ATENÇÃO! operação cancelada: Orientador deste trabalho já é Avaliador em outra sessão neste mesmo horário";
if ($n_mens==13)
   $mensagem=" ATENÇÃO! operação cancelada: Este Avaliador é Orientador de um trabalho em outra sessão neste mesmo horário";
if ($n_mens==14)
   $mensagem = "ATENÇÃO! operação cancelada: Orientador deste trabalho é Orientador de trabalho em outra sessão neste mesmo horário";
  
$color = "#FFF";

if ($n_mens == 1 || $n_mens == 2 || $n_mens == 3 || $n_mens == 4 || $n_mens == 8)
    $color = "#CCDAB4";
if ($n_mens == 5 || $n_mens == 6 || $n_mens == 7 || $n_mens == 9 || $n_mens == 10 || $n_mens == 11 || $n_mens == 12 || $n_mens == 13 || $n_mens == 14 )
    $color = "#FA8072";
   
$titulo = "Sessão";
?>
<style>
  td{
  border: 1px solid #CCDAB4;
  border-radius: 7px;
  width:400px;
  padding: 5px;
  margin: 5px;
  height: auto;
  }
  select{
    border-radius: 7px;
    background-color: #FFF;
    border: 1px solid #CCDAB4;
    width: 98%;
    padding: 5px;
    margin: 5px;
  }
</style>

<script language="javascript"> </script>
<?php
include("../inc_cabecalho.php");
?>

<a href='sessoes.php' class='button blue'>Sessões</a>

<a href='sessoes_avaliadores.php' class='button blue'>Sessões e Avaliadores</a>

<a href='criar_sessao.php?acao=editar&id_sessao=<?php echo $id_sessao;?>' class='button blue'>Editar Dados da Sessão</a>
  
<?php 
    
  $sql_sessao= "SELECT *,
                 CASE fk_modalidade 
                 WHEN 1 THEN 'Oral' WHEN 2 THEN 'Pôster' END as modalidade
               FROM sessao WHERE id_sessao=".$id_sessao." ;";
  $result_sessao= mysql_query($sql_sessao,$conexao);
  $linha_sessao= mysql_fetch_array($result_sessao);
  echo "<table width=100% align='center'>";
  echo "<tr><td align='left' colspan='2'><h3>Sessão:&nbsp;ID=".$linha_sessao['id_sessao'].", Nome=".$linha_sessao['nome'].", Sala: ".$linha_sessao['nome_sala']."<br>Data - Hora : ".formata_data3($linha_sessao['data'])." - ".formata_hora($linha_sessao['hora_ini'])." às ".formata_hora($linha_sessao['hora_fim'])."<br>Modalidade: ".$array_modalidade[$linha_sessao['fk_modalidade']]."</h3></td></tr>";

  // Trabalhos na sessão
  $sql_trabalho_sessao= "SELECT *, 
						CASE fk_modalidade 
            WHEN 1 THEN 'O' WHEN 2 THEN 'P' END
						FROM trabalho WHERE fk_sessao=".$id_sessao." ORDER BY seq_sessao ASC ;";
  $result_trabalho_sessao= mysql_query($sql_trabalho_sessao,$conexao);

  //if (isset($_REQUEST["id_area"]))
    //$req_id_area = $_REQUEST["id_area"];
  //else
    //$req_id_area = 0;
  
  if($req_id_area != 0) {
  //if($_REQUEST["id_area"] != 0) {
	  $sql_trabalho= "SELECT * FROM trabalho 
					WHERE status=4 AND fk_modalidade = ".$linha_sessao["fk_modalidade"]." AND fk_sessao IS NULL AND fk_area=".$req_id_area."
					ORDER BY id_trabalho ASC";
  } else {
    // Lista de todos os trabalhos aceitos mas que ainda não possuem nenhuma sessão.
    $sql_trabalho= "SELECT * FROM trabalho 
					WHERE status=4 AND fk_modalidade = ".$linha_sessao["fk_modalidade"]." AND fk_sessao IS NULL 
					ORDER BY id_trabalho ASC";
  }
  $result_trabalho= mysql_query($sql_trabalho,$conexao);

  // Avaliadores na sessão
  $sql_avaliador_sessao= "SELECT u.id_usuario, u.nome, avs.seq 
						FROM avaliador a, usuario u, avaliador_sessao avs 
						WHERE (avs.fk_sessao=".$id_sessao.") 
						AND (a.fk_usuario = avs.fk_avaliador)
						AND (u.id_usuario= avs.fk_avaliador) ORDER BY avs.seq ASC;";
  $result_avaliador_sessao= mysql_query($sql_avaliador_sessao,$conexao);

  // Lista de todos os avaliadores mas que ainda não estão associados a esta sessão
  if($req_id_area_ava != 0) {
    $sql_avaliador= "SELECT u.nome, a.fk_usuario FROM usuario u 
				INNER JOIN avaliador a ON a.fk_usuario = u.id_usuario 
                INNER JOIN avaliador_area aa ON aa.fk_avaliador = a.fk_usuario
				WHERE a.fk_usuario NOT IN (SELECT avs.fk_avaliador 
				FROM avaliador_sessao avs WHERE avs.fk_sessao=".$id_sessao.") 
				AND status = 1
				AND aa.fk_area = ".$req_id_area_ava." ORDER BY u.nome ASC";
  } else {
      $sql_avaliador= "SELECT u.nome, a.fk_usuario FROM usuario u 
				INNER JOIN avaliador a ON a.fk_usuario = u.id_usuario 
				WHERE a.fk_usuario NOT IN (SELECT avs.fk_avaliador 
					FROM avaliador_sessao avs WHERE avs.fk_sessao=".$id_sessao.")
				AND status = 1
				ORDER BY u.nome ASC";
  }
  $result_avaliador= mysql_query($sql_avaliador,$conexao);
  $num_reg_avaliador= mysql_num_rows($result_avaliador);
  if($result_avaliador==false)
	echo mysql_error();
 
?>

    <tr>
      <td align='left'>Trabalhos na sessão</td>
      <td align='left'>Lista de trabalhos (Modalidade = <?php echo $linha_sessao['modalidade']; ?> )</td>
    </tr>

<tr>
  <!--Formulário de remoção de trabalho -->
  <td align='left'>

  <form name="remover_trabalho" method="post" action="execute_abrir_sessao.php?acao=remover_trabalho">
 (Posição) ID - Área - Título <br />
      <div style="width:auto; height: auto;">
          <select name="id_trabalho" size="10">
          <?php
            while ($linha_trabalho_sessao= mysql_fetch_array($result_trabalho_sessao))
               {
                   echo "<option value='".$linha_trabalho_sessao['id_trabalho']."' title='".$linha_trabalho_sessao['titulo']."'>(".$linha_trabalho_sessao['seq_sessao'].
                   ") ".$linha_trabalho_sessao['id_trabalho']." - ".$linha_trabalho_sessao['fk_area']." - ".$linha_trabalho_sessao['turno1'].$linha_trabalho_sessao['turno2'].$linha_trabalho_sessao['turno3']." - ".$linha_trabalho_sessao['titulo']."</option>";
          	 }
          ?>
          </select>
      </div><br />
  <input type="submit" value="Remover trabalho" class="button red">
  </form>
  </td>
<!-- Fim do formulario de remoção de trabalho -->

<td align='left'>
<!-- Formulario de inclusão de trabalho -->
<form id="incluir_trabalho" name="incluir_trabalho" method="post" action="execute_abrir_sessao.php?acao=incluir_trabalho">
<br /> ID - Área - Turnos - Título <br /><br />
<div style="width:auto;">
<select name="id_trabalho" size="10">
<?php
  while ($linha_trabalho= mysql_fetch_array($result_trabalho))
     {
         $trab = sprintf("%5s", $linha_trabalho['id_trabalho']);
         $area = sprintf("%5s", $linha_trabalho['fk_area']);
         echo "<option value='".$linha_trabalho["id_trabalho"]."'title='".$linha_trabalho['titulo_ordenar']."'>".$trab." - ".$area." - ".$linha_trabalho['turno1'].$linha_trabalho['turno2'].$linha_trabalho['turno3']." - ".$linha_trabalho['titulo_ordenar']."</option>";
	 }
?>
</select></div><br />
	<label>Áreas:</label> 
        <select id="filtro_area" name="filtro_area" form="filtro">
		<option value="0">Todas</option>
                <?php
                $sql_area = "select id_area, nome from area";
                $result_area = mysql_query($sql_area);

                while($linha_area = mysql_fetch_array($result_area)){
                    if($req_id_area == $linha_area['id_area'])
                        $selected = "selected=\"selected\"";
                    else
                        $selected = "";
                    ?>
                    <option value="<?php echo $linha_area['id_area'] ?>" <?php echo $selected ?>><?php echo $linha_area['id_area'] ?>- <?php echo $linha_area['nome'] ?></option> 
                <?php
                }
                ?>	
	</select>
	<input type="button" value="Filtrar Trabalhos" onclick="filtrar_trabs(<?php echo $_SESSION["id_sessao"]; ?>);" class="button gray"/>
<input type="submit" value="Adicionar trabalho" class="button blue" form="incluir_trabalho"/><br />
</form>
</td>
</tr>

<tr>
<td align='left' colspan='2' style="background-color: <?php echo $color ?>;"><br />
Mensagem: <?php echo $mensagem; ?><br /><br />
</td>
</tr>

<tr><td align='left'>Avaliadores na sessão</td> 
<td align='left'>Lista de avaliadores</td></tr>

<tr>
<td align='left'>
<p>(Posição) ID - Nome </p>
<form name="excluir_avaliador" method="post" action="execute_abrir_sessao.php?acao=excluir_avaliador">

<select name="fk_id_avaliador" size="10">
<?php
  while ($linha_avaliador_sessao= mysql_fetch_array($result_avaliador_sessao))
     {
         echo "<option value='".$linha_avaliador_sessao['id_usuario']."' title='".$linha_avaliador_sessao['nome']."'> (".$linha_avaliador_sessao['seq'].") ".$linha_avaliador_sessao['id_usuario']." - ".$linha_avaliador_sessao['nome']."</option>";
	 }
?>
</select><br /><br />
<input type="submit" value="Remover Avaliador" class="button red">
<!--<input type="button" value="Confirmar avaliador" class="button blue" onclick="self.open('execute_abrir_sessao.php?acao=confirmar_avaliador&diff=<?php //echo elDiff(); ?>','_self')"> -->
</form>
</td>

<td align='left'>
<form name="incluir_avaliador" method="post" action="execute_abrir_sessao.php?acao=incluir_avaliador">
<br /> ID - Nome <br /><br />
<select name="fk_id_avaliador" size="10">
<?php
  while ($linha_avaliador= mysql_fetch_array($result_avaliador))
     {
         echo "<option value=".$linha_avaliador['fk_usuario']." title='".$linha_avaliador['nome']."'> ".$linha_avaliador['fk_usuario']." - ".$linha_avaliador['nome']."</option>";
	 }
?>
</select><br /><br />

	<label>Áreas:</label> 
	<select id="filtro_area_ava" name="filtro_area_ava" form="filtro_ava">
		<option value="0">Todas</option>
                <?php
                $result_area = mysql_query($sql_area);
                while($linha_area = mysql_fetch_array($result_area)){
                    if($req_id_area_ava == $linha_area['id_area'])
                        $selected = "selected=\"selected\"";
                    else
                        $selected = "";
                    ?>
                    <option value="<?php echo $linha_area['id_area']?>" <?php echo $selected?>><?php echo $linha_area['id_area']?>- <?php echo $linha_area['nome']?></option> 
                <?php
                }
                ?>
  </select>

    <input type="button" class="button gray" value="Filtrar Avaliador" onclick="filtrar_ava(<?php echo $_SESSION["id_sessao"]; ?>);"/>
<input type="submit" value="Incluir Avaliador" class="button blue">
</form>
</td>
</tr>


<?php
  echo "</table><br /><br />";
  $_SESSION['adm2'] = true;

?>


</div>
  



<script>

function filtrar_trabs(id) {
	//area = $("#filtro_area").val();
    //area = document.filtro_area.val();
    //alert("1");
    area = document.getElementById("filtro_area").selectedIndex; 
    //alert("2");
	self.open('abrir_sessao.php?id_sessao='+id+'&id_area='+area,'_self');
    //alert("3");
}

function filtrar_ava(id) {
	//area = $("#filtro_area").val();
    //area = document.filtro_area.val();
    //alert("1");
    area = document.getElementById("filtro_area_ava").selectedIndex; 
    //alert("2");
	self.open('abrir_sessao.php?id_sessao='+id+'&id_area_ava='+area,'_self');
    //alert("3");
}

</script>
  
<?php
include("../inc_rodape.php");
?>
