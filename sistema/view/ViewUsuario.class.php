<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ViewUsuario
 *
 * @author alexandre
 */
class ViewUsuario {

    public static function inscricao() {
        $smarty = new Smarty();
        $disabled = 'disabled="disabled"';
        $smarty->assign('role', $_REQUEST['role']);
        $smarty->assign('cpf', $_REQUEST['cpf']);
        $smarty->assign('operacao', $_REQUEST['operacao']);
        if ($_REQUEST['operacao'] == 'add') {
            $disabled = "";
        } else {
            $smarty->assign('usuario', $_REQUEST['authUser']);
        }
        if ($_REQUEST['role'] == 'avaliador'){
           $smarty->assign('tematica', ViewUsuario::selectTematic()); 
        }
        $required='required';
        if ($_REQUEST['role'] == 'ouvinte'){
            $required='';
        }
        $smarty->assign('required', $required);
        $smarty->assign('instituicao', ViewUsuario::selectInstitution());
        $smarty->assign('disabled', $disabled);
        $smarty->assign('HOME', HOME);
        $smarty->display(VIEW . 'templates/inscricao_' . $_REQUEST['role'] . '.tpl');
    }

    public static function inscricaoCPF() {
        $smarty = new Smarty();
        $smarty->assign('HOME', HOME);
        $smarty->assign('role', $_REQUEST['role']);
        $smarty->display(VIEW . 'templates/cpf.tpl');
    }

    public static function inscricaoCPFSenha() {
        $smarty = new Smarty();
        $smarty->assign('HOME', HOME);
        $smarty->assign('role', $_REQUEST['role']);
        $smarty->assign('cpf', $_REQUEST['cpf']);
        $smarty->display(VIEW . 'templates/cpfSenha.tpl');
    }

    public static function selectInstitution() {
        $array = new InstituicaoMySqlDAO();
        return $array->queryAllSelect();
    }
    
    public static function selectTematic() {
        $array = new AreaMySqlDAO();
        return $array->queryAllSelect();
    }

    public static function viewCampusAjax() {
        $smarty = new Smarty();
        $campus = new CampusMySqlDAO();
        $smarty->assign('campus', $campus->queryAllSelect($_REQUEST['id_instituicao']));
        $smarty->display(VIEW . 'templates/selectCampus.tpl');
    }

    public static function viewCursosAjax() {
        $smarty = new Smarty();
        $cursos = new CursoMySqlDAO();
        $smarty->assign('cursos', $cursos->queryAllSelect($_REQUEST['id_campus']));
        $smarty->display(VIEW . 'templates/selectCursos.tpl');
    }

    public static function viewInstituicoesAjax() {
        $smarty = new Smarty();
        $inst = new InstituicaoMySqlDAO();
        $smarty->assign('instituicoes', $inst->queryAll());
        $smarty->display(VIEW . 'templates/selectInstituicoes.tpl');
    }

    public static function viewMsgError($msg) {
        $smarty = new Smarty();
        $smarty->assign('msg', $msg);
        $smarty->display(VIEW . 'templates/msgError.tpl');
    }

    public static function viewLoginNoAuth() {
        $smarty = new Smarty();
        $smarty->assign('HOME', HOME);
        $smarty->assign('desabilitarImagem', '');
        $smarty->display(VIEW . 'templates/loginNoAuth.tpl');
    }

    public static function viewAreaUsuario() {
        $smarty = new Smarty();
        $smarty->assign('HOME', HOME);
        $smarty->assign('usuario', $_SESSION['authUser']);
        $smarty->display(VIEW . 'templates/areaUsuario.tpl');
    }

}
