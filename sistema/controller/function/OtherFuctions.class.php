<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of OtherFuctions
 *
 * @author alexandre
 */
class OtherFuctions {
    
    static function dateOutputFormat($date) {
        $date = new DateTime($date);
        return $date->format('d/m/Y');
    }

    static function timeOutputFormat($date) {
        $date = new DateTime($date);
        return $date->format('H:i');
    }
    
    static function lmWord($string, $words = '100') {
        $string = strip_tags($string);
        $count = strlen($string);

        if ($count <= $words) {
            return $string;
        } else {
            $strpos = strrpos(substr($string, 0, $words), ' ');
            return substr($string, 0, $strpos) . '...';
        }
        return $string;
    }

    static function verffyOrg() {

        $noheader = new NoHeader();
        $noheader->noheader();
        if (isset($_SESSION['authUser'])) {
            if ($_SESSION['authUser']->organizador) {
                return;
            }
        }
        unset($_SESSION['authUser']);
        $_SESSION = array();
        session_destroy();
        session_commit();
        header("Location:" . HOME . 'index.php');
    }

}
