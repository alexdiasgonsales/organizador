<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NoHeader
 *
 * @author alexandre
 */
class NoHeader {
    public function noheader(){
       header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
       header("Cache-Control: no-cache");
       header("Pragma: no-cache");
    }
}
