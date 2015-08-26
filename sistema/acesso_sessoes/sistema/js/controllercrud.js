
function ajax() {
}
;

ajax.prototype.iniciar = function() {

    try {
        this.xmlhttp = new XMLHttpRequest();
    } catch (ee) {
        try {
            this.xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
        } catch (e) {
            try {
                this.xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            } catch (E) {
                this.xmlhttp = false;
            }
        }
    }
    return true;
};

ajax.prototype.ocupado = function() {
    estadoAtual = this.xmlhttp.readyState;
    return (estadoAtual && (estadoAtual < 4));
};

ajax.prototype.processa = function() {
    if (this.xmlhttp.readyState === 4 && this.xmlhttp.status === 200) {
        return true;
    }
};

ajax.prototype.enviar = function(url, metodo, modo) {
    if (!this.xmlhttp) {
        this.iniciar();
    }
    if (!this.ocupado()) {
        if (metodo === "GET") {
            this.xmlhttp.open("GET", url, modo);
            this.xmlhttp.send(null);
        } else {
            this.xmlhttp.open("POST", url, modo);
            this.xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded; charset=UTF-8");
            this.xmlhttp.setRequestHeader("Cache-Control", "no-store, no-cache, must-revalidate");
            this.xmlhttp.setRequestHeader("Cache-Control", "post-check=0, pre-check=0");
            this.xmlhttp.setRequestHeader("Pragma", "no-cache");
            this.xmlhttp.send(url);
        }

        if (this.processa) {
            return unescape(this.xmlhttp.responseText.replace(/\+/g, " "));
        }
    }
    return false;
};


function editar(id) {
    elem = document.getElementById('campo' + id);
    elem2 = document.getElementById('campo_' + id);
    bot = document.getElementById("enviar" + id);
    elem.innerHTML = "<input type=\"text\" value=\"" + elem.innerHTML + "\" id='" + id + "_c' />";
    elem2.innerHTML = "<input type=\"email\" value=\"" + elem2.innerHTML + "\" id='" + id + "d_c' />";
    bot.innerHTML = '<a href="javascript:editado(\'' + id + '\')" class="linkBotao">enviar dados do usuário</a>';
}


function editado(id) {
    envia = document.getElementById('enviar' + id);
    campo = document.getElementById(id + '_c').value;
    campod = document.getElementById(id + 'd_c').value;
    ecampo = escape(campo);
    ecampod = escape(campod);
    document.getElementById('campo' + id).innerHTML = campo;
    document.getElementById('campo_' + id).innerHTML = campod;
    envia.innerHTML = '<a href="javascript:editar(\'' + id + '\')" class="linkBotao">alterar dados do usuário</a>';
    xmlhttp = new ajax();
    var destino = home + 'controller/ControllerUsuarioArea.php?acao=edit&id=' + id + '&nome=' + ecampo + '&email=' + ecampod;
    // $(location).attr('href', destino);
    javascript:window.history.forward(1);
    noBack();
    xmlhttp.enviar(destino, "POST", false);

}

function addrow(id) {
    tb = document.getElementById('tabelaCurso');
    idcurso = document.getElementById('f_curso').value;
    idautor = document.getElementById('id').value;
    campox = document.getElementById('f_instituicao').value;
    campod = $('#f_campus').find('option').filter(':selected').text();
    campo = $('#f_curso').find('option').filter(':selected').text();
    xmlhttp = new ajax();
    var destino = home + 'controller/ControllerSigla.php?acao=load&id=' + campox;
    // $(location).attr('href', destino);
    campoe = xmlhttp.enviar(destino, "POST", false);
    var x = tb.insertRow(-1);
    var z = x.insertCell(0);
    var w = x.insertCell(1);
    var b = x.insertCell(2);
    var y = x.insertCell(3);

    z.innerHTML = "<span id=\"campo" + id + "\">" + campo + "</span>";
    w.innerHTML = "<span id=\"campo_" + id + "\">" + campod + "</span>";
    b.innerHTML = "<span id=\"campo__" + id + "\">" + campoe + "</span>";
    y.innerHTML = '<span><a href="#" class="link1" onclick="apagar(' + idautor + ',' + idcurso + ', this.parentNode.parentNode.rowIndex);" style="font-size:10px;margin-left:15px;">Remover </a></span>';
}

function add() {
    campo = document.getElementById('f_instituicao').value;
    if (!campo) {
        alert('Informe uma instituição valida');
        return;
    }
    campod = document.getElementById('f_campus').value;

    if (!campod) {
        alert('Informe um campus valido');
        return;
    }
    campoe = document.getElementById('f_curso').value;
    if (!campoe) {
        alert('Informe um curso valido');
        return;
    }
    ecampo = escape(campo);
    ecampod = escape(campod);
    ecampoe = escape(campoe);
    idcampo = document.getElementById('id').value;
    var destino = home + 'controller/ControllerNovoCurso.php?acao=add&id=' + idcampo + '&curso=' + campoe;
    xmlhttp = new ajax();
    id = xmlhttp.enviar(destino, "POST ", false); //manda adicionar
    if (id === 'false') {
        alert("Voce já está cadastrado neste curso !!!");
        return;
    }
    addrow(id);
    campo.value = "";
    campod.value = "";
    campoe.value = "";
}

function apagar(id, curso, rowIndex)
{
    if (confirm('Deseja excluir este registro?'))
    {
        alert('Funcao ainda não está pronta por favor aguarda-la!!!');
        return;
        document.getElementById("tabela").deleteRow(rowIndex);
        xmlhttp = new ajax();
        var destino = home + 'controller/ControllerUsuarioEspecifico.php?acao=del&fk_usuario=' + id + '&fk_curso=' + curso;
        // $(location).attr('href', destino);
        xmlhttp.enviar(destino, "POST", false);
    }
}
function logout() {
    var destino = home + 'controller/ControllerLogout.php?acao=logout';
    javascript:window.history.forward(1);
    noBack();
    $(location).attr('href', destino);
}
function mostraDadosInstituicao() {
    $('#cursos').show();
    $('#mostrar').hide();
    $('#ocultar').show();
    $('#enviar').show();
    $('#ignorar').show();

}

function ocultaDadosInstituicao() {
    $('#cursos').hide();
    $('#mostrar').show();
    $('#ocultar').hide();
    $('#enviar').hide();
    $('#ignorar').show();
}

function in_array(needle, haystack, argStrict) {


    var key = '',
            strict = !!argStrict;

    if (strict) {
        for (key in haystack) {
            if (haystack[key] === needle) {
                return true;
            }
        }
    } else {
        for (key in haystack) {
            if (haystack[key] == needle) {
                return true;
            }
        }
    }

    return false;
}

function noBack() {
    window.history.forward();
}

window.onload = noBack;

window.onpageshow = function(evt) {
    if (evt.persisted)
        noBack();
};

window.onunload = function() {
    void(0);
};

function validaCheck() {
    var ck = false;
    if (jQuery("input[name='cbManha']:checked").length > 0) {
        ck = true;
    }
    if (jQuery("input[name='cbTarde']:checked").length > 0) {
        ck = true;
    }
    if (jQuery("input[name='cbNoite']:checked").length > 0) {
        ck = true;
    }
    if (!ck) {
        alert("Marque pelo menos um ckBox!");
        return false;
    } else {
        return true;
    }
}

function alteraArea() {
    if (confirm('Deseja alterar sua Area Tematica?'))
    {
        var id = document.getElementById('id').value;
        var area = $('#areaTematic option:selected').val();
        xmlhttp = new ajax();
        var destino = home + 'controller/ControllerAlterarArea.php?id=' + id + '&area=' + area;
        xmlhttp.enviar(destino, "POST", false);
    }
}

function alteraTurno(id) {

    var manha = $("#cbManha").is(":checked");
    var tarde = $("#cbTarde").is(":checked");
    var noite = $("#cbNoite").is(":checked");
    if (!manha && !tarde && !noite){
        alert("Sua Opcao é invalida !!! Marque ao menos uma opcao !!!");
        return;
    }
    if (manha){
        var cbManha = 'M';
    } else{
        var cbManha = null;
    }
    if (tarde){
        var cbTarde = 'T';
    } else {
        var cbTarde = null;
    }
    if (noite){
        var cbNoite = 'N';
    } else {
        var cbNoite = null;
    }
    xmlhttp = new ajax();
    var destino = home + 'controller/ControllerAlterarTurno.php?id=' + id 
            + '&manha='+cbManha + '&tarde='+cbTarde + '&noite='+cbNoite;
    xmlhttp.enviar(destino, "POST", false);

}