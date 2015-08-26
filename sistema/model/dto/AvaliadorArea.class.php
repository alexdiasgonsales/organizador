<?php
/**
* Classe de operação da tabela 'avaliador_area'. Banco de Dados Mysql.
* Estas classes não contemplam meu projeto final, por estarem obsoletas, estou contruindo
* novos templates em Persistent Data Object com definição de prepared statements contra
* sql injection, utilize para meio de testes, nunca coloque em produção, servindo
* apenas de trampolin para classe de produção
*
* @autor: Alessander Wasem
* @data: 2014-05-21 21:57
*/
class AvaliadorArea{
      
    private $fkArea;
    private $fkAvaliador;

      
    public function getFkArea(){
        return $this->fkArea;
    }
    public function getFkAvaliador(){
        return $this->fkAvaliador;
    }
    public function setFkArea($fkArea){
        $this->fkArea = $fkArea;
    }
    public function setFkAvaliador($fkAvaliador){
        $this->fkAvaliador = $fkAvaliador;
    }

}
