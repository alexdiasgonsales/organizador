<?php
require_once '../../controller/autoloadreload.php';
Login::VerificaLogin();
$orderBy = $_REQUEST['orderBy'];
$id = $_REQUEST['id'];
$ordem = array(
    'trabalho.id_trabalho',
    'trabalho.titulo',
    'trabalho.status',
    'usuario.nome',
    'area.nome',
    'trabalho.fk_categoria',
    'trabalho.fk_modalidade',
    'trabalho_autor_curso.fk_autor',
    'trabalho_orientador_campus.fk_orientador',
    'curso.nome',
    'campus.nome',
    'instituicao.sigla'
);
if ($orderBy === 'null') {
    $orderBytxt = "";
} else {
    $orderBytxt = ' ORDER BY ' . $ordem[$orderBy] . ' ASC';
}
$trabalho = new RevisorMySqlDAO();
$re = $trabalho->queryAllRevisor($orderBytxt);
?>
<tr style="background-color:#CCDAB4;"> 
    <td title="Ordem crescente de identificador de Trabalho" onclick="getListaTrabalhos(0,<?php echo $id; ?>);">ID</td>
    <td title="Ordem crescente de titulo de Trabalho" onclick="getListaTrabalhos(1,<?php echo $id; ?>);">Título</td>
    <td title="Ordem crescente de status de Trabalho" onclick="getListaTrabalhos(2,<?php echo $id; ?>);">Status</td>
    <td title="Ordem crescente de Revisor" onclick="getListaTrabalhos(3,<?php echo $id; ?>);">Revisor</td>
    <td title="Ordem crescente de identificador de Área" onclick="getListaTrabalhos(4,<?php echo $id; ?>);">Área</td>
    <td title="Ordem crescente de Modalidade" onclick="getListaTrabalhos(5,<?php echo $id; ?>);">M</td>
    <td title="Ordem crescente de Categoria" onclick="getListaTrabalhos(6,<?php echo $id; ?>);">C</td>
    <td title="Ordem crescente de Autor" onclick="getListaTrabalhos(7,<?php echo $id; ?>);">Aut</td>
    <td title="Ordem crescente de Orientador"onclick="getListaTrabalhos(8,<?php echo $id; ?>);">Ori</td>
    <td title="Ordem crescente de Campus"onclick="getListaTrabalhos(9,<?php echo $id; ?>);">Curso</td>
    <td title="Ordem crescente de identificador de Campus" onclick="getListaTrabalhos(10,<?php echo $id; ?>);">Campus</td>
    <td title="Ordem crescente de Sigla" onclick="getListaTrabalhos(11,<?php echo $id; ?>);">Sigla<br>(Inst.)</td>
</tr>
<?php foreach ($re as $rev): ?>
    <tr><td title="Idenficador do Trabalho número: <?php echo $rev->trabalho_id; ?>">
            <?php echo $rev->trabalho_id ?>
        </td><td title="Titulo Completo do Trabalho: <?php echo OtherFuctions::lmWord($rev->trabalho_titulo, 20); ?>">
            <?php echo $rev->trabalho_titulo; ?>
        </td><td title="Status do Trabalho">
            <?php echo $rev->trabalho_status; ?>
        </td><td td title="Nome completo do Revisor: <?php echo OtherFuctions::lmWord($rev->revisor_nome, 20); ?>">
            <?php echo substr($rev->revisor_nome, 0, 10); ?>
        </td><td title="<?php echo $rev->area_nome; ?>">
            <?php echo OtherFuctions::lmWord($rev->area_nome, 20); ?>
        </td><td title="M = Modalidade (O=Oral, P=Pôster)">
            <?php echo $rev->modalidade_trabalho; ?>
        </td><td title="C = Categoria (P=Pesquisa, E=Experiência, R=Revisão de Literatura/Ensaio)">
            <?php echo $rev->categoria_trabalho; ?>
        </td><td title="Código do Autor">
            <?php echo $rev->fk_autor; ?>
        </td><td title="Código do Orientador">
            <?php echo $rev->fk_orientador; ?>
        </td><td title="<?php echo $rev->nome_curso; ?>">
            <?php echo OtherFuctions::lmWord($rev->nome_curso, 20); ?>
        </td><td title="<?php echo $rev->nome_campus; ?>">
            <?php echo OtherFuctions::lmWord($rev->nome_campus, 20); ?>
        </td><td title="<?php echo $rev->sigla; ?>">
            <?php echo OtherFuctions::lmWord($rev->sigla, 10); ?>
        </td>
        
        <?php
        
        /*
        <td title="Titulo: <?php echo OtherFuctions::lmWord($rev->trabalho_titulo, 20); ?> - Visualize o trabalho e emita seu parecer !!!">
            <a href="#" class="linkBotao" style="padding: 0px;" onclick="getTrabalhos('<?php echo $rev->trabalho_id; ?>', '<?php echo $id; ?>');">T</a>
        </td>
          */      
        ?>
    </tr>
    <?php
endforeach;
?>
<script>
    function getTrabalhos(idTrabalho, idRevisor) {
        var str = new Array();
        str.push("idTrabalho=" + idTrabalho);
        str.push("id=" + idRevisor);
        $.ajax({
            type: "GET",
            url: home + 'view/Reload/mostraTrabalho.php',
            data: str.join("&"),
            success: function(data) {
                document.getElementById("listaTrabalhos").innerHTML = "";
                $("#listaTrabalhos").append(data);
            }
        });
    }
</script>