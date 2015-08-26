
function carrega_cursos_e_select_curso(id_curso) {
      str = new Array();
      str.push("opcao=getCursos");
      str.push("id_campus="+$("#f_campus").val());
      $.ajax({
        type: "GET",
        url: home + 'controller/ControllerCursoAjax.php',
        data: str.join("&"),
        success: function(data) {
          $("#f_curso").html(data);
          //$("#f_curso").append("<option value='"+data+"'>"+$("#nome_curso").val()+"</option>" );
          $("#f_curso").val(id_curso);
        }
      });
}//carrega_cursos_e_select_curso

function carrega_campi_e_select_campus(id_campus) {
      str = new Array();
      str.push("opcao=getCampi");
      str.push("id_instituicao="+$("#f_instituicao").val());
      $.ajax({
        type: "GET",
        url: home + 'controller/ControllerCampusAjax.php',
        data: str.join("&"),
        success: function(data) {
          $("#f_campus").html(data);
          $("#f_campus").val(id_campus);
        }
      });
}//carrega_campi_e_select_campus()

function carrega_instituicoes_e_select_instituicao(id_instituicao) {
      str = new Array();
      str.push("opcao=getInstituicoes");
      $.ajax({
        type: "GET",
        url: home + 'controller/ControllerInstituicaoAjax.php',
        data: str.join("&"),
        success: function(data) {
          $("#f_instituicao").html(data);
          $("#f_instituicao").val(id_instituicao);
        }
      });
}//carrega_instituicoes_e_select_instituicao()

function inserir_curso() {
    var str = new Array();
    str.push("opcao=inserir_curso");
    str.push("id_campus="+$("#f_campus").val());
    str.push("nome_curso="+$("#nome_curso").val());
    str.push("nivel_curso="+$("#nivel_curso").val());
    var id_curso = 0;
    $.ajax({
        type: "GET",
        url: home + 'controller/ControllerCursoAjax.php',
        data: str.join("&"),
        success: function(data) {
          id_curso = data;
          if (id_curso > 0) {
            show_dialog_alert_msg('O novo curso foi cadastrado.');
            carrega_cursos_e_select_curso(id_curso);
          }
        }
    });
}//inserir_curso()

function inserir_campus() {
    var str = new Array();
    str.push("opcao=inserir_campus");
    str.push("id_instituicao="+$("#f_instituicao").val());
    str.push("nome_campus="+$("#nome_campus").val());
    str.push("cidade_campus="+$("#cidade_campus").val());
    var id_campus = 0;
    $.ajax({
        type: "GET",
        url: home + 'controller/ControllerCampusAjax.php',
        data: str.join("&"),
        success: function(data) {
          id_campus = data;
          if (id_campus > 0) {
            show_dialog_alert_msg('O novo campus foi cadastrado.');
            carrega_campi_e_select_campus(id_campus);
          }
        }
    });
}//inserir_campus()

function inserir_instituicao() {
    var str = new Array();
    str.push("opcao=inserir_instituicao");
    str.push("nome_inst="+$("#nome_inst").val());
    str.push("sigla_inst="+$("#sigla_inst").val());
    str.push("cidade_inst="+$("#cidade_inst").val());
    str.push("estado_inst="+$("#estado_inst").val());
    str.push("site_inst="+$("#site_inst").val());
    str.push("tipo_inst="+$("#tipo_inst").val());
    var id_instituicao = 0;
    $.ajax({
        type: "GET",
        url: home + 'controller/ControllerInstituicaoAjax.php',
        data: str.join("&"),
        success: function(data) {
          id_instituicao = data;
          if (id_instituicao > 0) {
            show_dialog_alert_msg('A nova instituição foi cadastrada.');
            carrega_instituicoes_e_select_instituicao(id_instituicao);
          }
        }
    });
}//inserir_instituicao()

//----------------- Dialogs Instituicao ---------------------------

function show_dialog_instituicao() {
    //Popula o select f_instituicao_2 com o mesmo conteúdo de f_instituicao.
    $("#f_instituicao_2").html($("#f_instituicao").html());
    $("#f_instituicao_2").val($("#f_instituicao").val());
    $(function() {
        $("#dialog_instituicao").dialog({
            width: 640,
            height: 480,
            resizable: false,
            draggable: false,
            modal: true,
            buttons: {
                "Escolher": function() {
                  if ($("#f_instituicao_2").val() > 0) {
                    $("#f_instituicao").val($("#f_instituicao_2").val());
                    $(this).dialog("close");
                    getCampus();
                  }
                  else {
                    show_dialog_alert_msg("Escolha uma instituição.");
                  }
                },
                "Cadastrar Nova Instituição ...": function() {
                    show_dialog_cad_instituicao();
                },
                "Cancelar": function() {
                    $(this).dialog("close");
                }
            }
        });
    });
}//show_dialog_instituicao()

function show_dialog_cad_instituicao() {
  $(function() {
    $("#dialog_cad_instituicao").dialog({
            width: 640,
            height: 480,
            resizable: false,
            draggable: false,
      modal: true,
      buttons: {
          "Cadastrar": function() {
            //Testar se nome está preenchido
            //????????????
            //Cadastrar no banco.
            inserir_instituicao();
            $(this).dialog("close");
            $("#dialog_instituicao").dialog("close");
          },
          "Cancelar": function() {
              $(this).dialog("close");
          }
      }
    });
  });
}//show_dialog_cad_instituicao()

//----------------- Dialogs Campus ---------------------------

function show_dialog_campus() {
  if($("#f_instituicao").val()==0) {
    show_dialog_alert_msg("Selecione uma Instituição.");
  } 
  else {
    //Popula o select f_campus_2 com o mesmo conteúdo de f_campus.
    $("#f_campus_2").html($("#f_campus").html());;
    $("#f_campus_2").val($("#f_campus").val());;
    $(function() {
        $("#dialog_campus").dialog({
            width: 640,
            height: 480,
            resizable: false,
            draggable: false,
            modal: true,
            buttons: {
                "Escolher": function() {
                  if ($("#f_campus_2").val() > 0 ) {
                    $("#f_campus").val($("#f_campus_2").val());
                    $(this).dialog("close");
                    getCursos();
                  }
                  else {
                    show_dialog_alert_msg("Escolha um campus.");
                  }
                },
                "Cadastrar Novo Campus ...": function() {
                    show_dialog_cad_campus();
                },
                "Cancelar": function() {
                    $(this).dialog("close");
                }
            }
        });
    });
  }
}//show_dialog_campus()

function show_dialog_cad_campus() {
  $(function() {
    $("#dialog_cad_campus").dialog({
            width: 640,
            height: 480,
            resizable: false,
            draggable: false,
      modal: true,
      buttons: {
          "Cadastrar": function() {
            //Testar se nome está preenchido
            //????????????
            //Cadastrar no banco.
            inserir_campus();
            $(this).dialog("close");
            $("#dialog_campus").dialog("close");
          },
          "Cancelar": function() {
              $(this).dialog("close");
          }
      }
    });
  });
}//show_dialog_cad_campus()

//----------------- Dialogs Cursos ---------------------------

function show_dialog_curso() {
  if($("#f_instituicao").val()==0) {
    show_dialog_alert_msg("Selecione uma Instituição.");
  } else if($("#f_campus").val()==0){
    show_dialog_alert_msg("Selecione um Campus.");
  } else {
    //Popula o select f_curso_2 com o mesmo conteúdo de f_curso.
    $("#f_curso_2").html($("#f_curso").html());
    $("#f_curso_2").val($("#f_curso").val());
    $(function() {
        $("#dialog_curso").dialog({
            width: 640,
            height: 480,
            resizable: false,
            draggable: false,
            modal: true,
            buttons: {
                "Escolher": function() {
                  if ($("#f_curso_2").val() > 0 ) {
                    $("#f_curso").val($("#f_curso_2").val());
                    $(this).dialog("close");
                  }
                  else {
                    show_dialog_alert_msg("Escolha um Curso.");
                  }
                },
                "Cadastrar Novo Curso ...": function() {
                    show_dialog_cad_curso();
                },
                "Cancelar": function() {
                    $(this).dialog("close");
                }
            }
        });
    });
  }
}//show_dialog_curso()

function show_dialog_cad_curso() {
    $(function() {
        $("#dialog_cad_curso").dialog({
            width: 640,
            height: 480,
            resizable: false,
            draggable: false,
            modal: true,
            buttons: {
                "Cadastrar": function() {
                  if ($("#nivel_curso").val() <= 0) {
                    show_dialog_alert_msg('Escolha o nível do curso.');
                    return;
                  }
                  //Cadastrar no banco.
                  inserir_curso();
                  $(this).dialog("close");
                  $("#dialog_curso").dialog("close");
                },
                "Cancelar": function() {
                    $(this).dialog("close");
                }
            }
        });
    });
}//show_dialog_cad_curso()

function show_dialog_alert_msg(msg){
  $(function() {
    $( "#dialog_msg").html(msg);
    $( "#dialog_alert_all" ).dialog({
      width: 320,
      height: 180,
      resizable: false,
      draggable: false,
      modal: true,
      buttons: {
        Ok: function() {
          $( this ).dialog( "close" );
        }
      }
    });
  });
}//show_dialog_alert_msg()

/*
function show_dialog_alert_all(){
  $(function() {
    $( "#dialog_msg").html(msg);
    $( "#dialog_alert_all" ).dialog({
      width: 320,
      height: 180,
      resizable: false,
      draggable: false,
      modal: true,
      buttons: {
        Ok: function() {
          $( this ).dialog( "close" );
        }
      }
    });
  });
}//Alerta Genérico.

function show_dialog_alert_instituicao(){
  $(function() {
    $( "#dialog_alert_instituicao" ).dialog({
      width: 320,
      height: 180,
      resizable: false,
      draggable: false,
      modal: true,
      buttons: {
        Ok: function() {
          $( this ).dialog( "close" );
        }
      }
    });
  });
}//Alerta Instituição

function show_dialog_alert_campus(){
  $(function() {
    $( "#dialog_alert_campus" ).dialog({
      width: 320,
      height: 180,
      resizable: false,
      draggable: false,
      modal: true,
      buttons: {
        Ok: function() {
          $( this ).dialog( "close" );
        }
      }
    });
  });
}//Alerta Campus
*/