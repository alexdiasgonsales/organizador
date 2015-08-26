function getInstituicoes() {
    var str = "opcao=getInstituicoes";

    $.ajax({
        type: "GET",
        url: home + 'controller/ControllerInstituicaoAjax.php',
        data: str,
        success: function(data) {
            $("#f_instituicao").html(data);
            var instituicao = '<option value="">Selecione um item da lista</option>';
            $("#f_instituicao").html(instituicao);
            $("#selectInst").html(data);
        }
    });
}

function getCampus() {

    var str = "opcao=getCampus";
    str += ("&id_instituicao=" + $("#f_instituicao").val());

    $.ajax({
        type: "GET",
        url: home + 'controller/ControllerCampusAjax.php',
        data: str,
        success: function(data) {
            $("#f_campus").html(data);
            var curso = '<option value="">Selecione um item da lista</option>';
            $("#f_curso").html(curso);
            $("#selectCamp").html(data);
        }
    });
}

function getCursos() {
    var str = new Array();
    str.push("opcao=getCursos");
    str.push("id_campus=" + $("#f_campus").val());

    $.ajax({
        type: "GET",
        url: home + 'controller/ControllerCursoAjax.php',
        data: str.join("&"),
        success: function(data) {
            $("#f_curso").html(data);
            $("#selectCurs").html(data);
        }
    });
}
// 225.523.111-56
function verificaCpf() {
    var str = "opcao=verificaCpf";
    str += ("&cpf=" + $("#cpf").val());
    str += ("&senha=" + $("#senha").val());
    str += ("&role=" + $("#role").val());

    $.ajax({
        type: "GET",
        url: home + 'controller/ControllerVerificaCPF.php',
        data: str,
        success: function(data) {

            if (data === 'false') {
                alert("Cpf Invalido, Digite Novamente...");
                return;
            }

            if (data === 'existe') {
                $('#cpfBotao').hide();
                $('#passwordBotao').show();
                $('#password').show();
                return;
            }
            $('#cpfLabel').hide();
            $('#cpf').hide();
            $('#cpfBotao').hide();
            $('#mostrarCampos').html(data);
            $('#red').show();
            $('#blue').show();
            $('#voltarHome').hide();
        }

    });

}

function verificaCpfSenha() {
    var str = "opcao=verificaCpfSenha";
    str += ("&cpf=" + $("#cpf").val());
    str += ("&senha=" + $("#senha").val());
    str += ("&role=" + $("#role").val());
    $.ajax({
        type: "GET",
        url: home + 'controller/ControllerVerificaCPFSenha.php',
        data: str,
        success: function(data) {

            if (data === 'invalido') {
                alert("Cpf ou Senhas invalido, Digite Novamente...");
                return;
            }
            var destino = home + 'controller/ControllerLogin.php';
            if (data === 'cadastrado') {
                $.ajax({
                    type: "GET",
                    url: home + 'controller/ControllerLogin.php',
                    data: str,
                    success: function(data) {
                        $(location).attr('href', destino);
                    }
                });
                return;
            }
            $('#cpfLabel').hide();
            $('#cpf').hide();
            $('#password').hide();
            $('#cpfBotao').hide();
            $('#mostrarCampos').html(data);
            $('#passwordBotao').hide();
            $('#red').show();
            $('#blue').show();
            $('#voltarHome').hide();
        }

    });

}

