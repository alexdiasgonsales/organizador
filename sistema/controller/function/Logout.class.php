<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of logout
 *
 * @author alexandre
 */
class Logout {
    public function Logout(){
        $noheader= new NoHeader();
        $noheader->noheader();
        if (isset($_SESSION['authUser'])){
           unset($_SESSION['authUser']);
            $_SESSION = array();
           session_destroy();
           session_commit();
        } 
        //echo HOME;
      header("Location:".HOME.'index.php');
    }
}
