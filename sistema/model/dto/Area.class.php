<?php
/**
* Classe de operação da tabela 'tematica'. Banco de Dados Mysql.
* Estas classes não contemplam meu projeto final, por estarem obsoletas, estou contruindo
* novos templates em Persistent Data Object com definição de prepared statements contra
* sql injection, utilize para meio de testes, nunca coloque em produção, servindo
* apenas de trampolin para classe de produção
*
* @autor: Alessander Wasem
* @data: 2014-05-21 21:57
*/
class Area{
      
    private $idArea;
    private $nome;

      
    public function getIdArea(){
        return $this->idArea;
    }

    public function getNome(){
        return $this->nome;
    }

    public function setIdArea($idArea){
        $this->idArea = $idArea;
    }

    public function setNome($nome){
        $this->nome = $nome;
    }


}
