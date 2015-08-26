/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function mostrarAut() {
    var id = document.getElementById('id').value;
    $("#pgAutor").load(home + "view/Reload/home_area_autor.php?id=" + id);
    $("#pgAutor").show();
    $("#pgOrientador").hide();
    $("#pgAvaliador").hide();
    $("#pgVoluntario").hide();
    $("#pgOuvinte").hide();
    $("#pgOrganizador").hide();
    $("#pgRevisor").hide();
}

function mostrarOrien() {
    var id = document.getElementById('id').value;
    $("#pgOrientador").load(home + "view/Reload/home_area_orientador.php?id=" + id);
    $("#pgAutor").hide();
    $("#pgOrientador").show();
    $("#pgAvaliador").hide();
    $("#pgVoluntario").hide();
    $("#pgOuvinte").hide();
    $("#pgOrganizador").hide();
    $("#pgRevisor").hide();
}

function mostrarAval() {
    var id = document.getElementById('id').value;
    $("#pgAvaliador").load(home + "view/Reload/home_area_avaliador.php?id=" + id);
    $("#pgAutor").hide();
    $("#pgOrientador").hide();
    $("#pgAvaliador").show();
    $("#pgVoluntario").hide();
    $("#pgOuvinte").hide();
    $("#pgOrganizador").hide();
    $("#pgRevisor").hide();
}

function mostrarVol() {
    var id = document.getElementById('id').value;
    $("#pgVoluntario").load(home + "view/Reload/home_area_voluntario.php?id=" + id);
    $("#pgAutor").hide();
    $("#pgOrientador").hide();
    $("#pgAvaliador").hide();
    $("#pgVoluntario").show();
    $("#pgOuvinte").hide();
    $("#pgOrganizador").hide();
    $("#pgRevisor").hide();
}

function mostrarOuv() {
    var id = document.getElementById('id').value;
    $("#pgOuvinte").load(home + "view/Reload/home_area_ouvinte.php?id=" + id);
    $("#pgAutor").hide();
    $("#pgOrientador").hide();
    $("#pgAvaliador").hide();
    $("#pgVoluntario").hide();
    $("#pgOuvinte").show();
    $("#pgOrganizador").hide();
    $("#pgRevisor").hide();
}

function mostrarOrg() {
    var id = document.getElementById('id').value;
    $("#pgOrganizador").load(home + "view/Reload/home_area_organizador.php?id=" + id);
    $("#pgAutor").hide();
    $("#pgOrientador").hide();
    $("#pgAvaliador").hide();
    $("#pgVoluntario").hide();
    $("#pgOrganizador").show();
    $("#pgOuvinte").hide();
    $("#pgRevisor").hide();
}

function mostrarRev() {
    var id = document.getElementById('id').value;
    $("#pgRevisor").load(home + "view/Reload/home_area_revisor.php?id=" + id);
    $("#pgAutor").hide();
    $("#pgOrientador").hide();
    $("#pgAvaliador").hide();
    $("#pgVoluntario").hide();
    $("#pgOrganizador").hide();
    $("#pgOuvinte").hide();
    $("#pgRevisor").show();
}