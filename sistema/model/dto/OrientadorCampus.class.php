<?php
/**
* Classe de operação da tabela 'orientador_campus'. Banco de Dados Mysql.
* Estas classes não contemplam meu projeto final, por estarem obsoletas, estou contruindo
* novos templates em Persistent Data Object com definição de prepared statements contra
* sql injection, utilize para meio de testes, nunca coloque em produção, servindo
* apenas de trampolin para classe de produção
*
* @autor: Alessander Wasem
* @data: 2014-05-21 21:57
*/
class OrientadorCampus{
      
    private $fkOrientador;
    private $fkCampus;
    private $seq;
    private $status;

      
    public function getFkOrientador(){
        return $this->fkOrientador;
    }

    public function getFkCampus(){
        return $this->fkCampus;
    }

    public function getSeq(){
        return $this->seq;
    }

    public function getStatus(){
        return $this->status;
    }

    public function setFkOrientador($fkOrientador){
        $this->fkOrientador = $fkOrientador;
    }

    public function setFkCampus($fkCampus){
        $this->fkCampus = $fkCampus;
    }

    public function setSeq($seq){
        $this->seq = $seq;
    }

    public function setStatus($status){
        $this->status = $status;
    }


}
