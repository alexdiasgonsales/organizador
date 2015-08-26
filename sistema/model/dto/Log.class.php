<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/**
 * Description of Log
 *
 * @author alexdg
 */
class Log {
      
    private $idLog;
    private $fkUsuario;
    private $tabela;
    private $acao;
    private $descricao;
      
    function __construct($fk_usuario, $tabela, $acao, $descricao ) {
      $this->fkUsuario = $fk_usuario;
      $this->tabela = $tabela;
      $this->acao = $acao;
      $this->descricao = $descricao;
    }
    
    public function getIdLog(){
        return $this->idLog;
    }

    public function setIdLog($idLog){
        $this->idLog = $idLog;
    }

    public function getFkUsuario(){
        return $this->fkUsuario;
    }

    public function setFkUsuario($fkUsuario){
        $this->fkUsuario = $fkUsuario;
    }

    public function getTabela(){
        return $this->tabela;
    }

    public function setTabela($tabela){
        $this->$tabela = $tabela;
    }

    public function getAcao(){
        return $this->acao;
    }

    public function setAcao($acao){
        $this->$acao = $acao;
    }
    
    public function getDescricao(){
        return $this->descricao;
    }

    public function setDescricao($descricao){
        $this->descricao = $descricao;
    }


}