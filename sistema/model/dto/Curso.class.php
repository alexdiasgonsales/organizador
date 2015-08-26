<?php
/**
* Classe de operação da tabela 'curso'. Banco de Dados Mysql.
* Estas classes não contemplam meu projeto final, por estarem obsoletas, estou contruindo
* novos templates em Persistent Data Object com definição de prepared statements contra
* sql injection, utilize para meio de testes, nunca coloque em produção, servindo
* apenas de trampolin para classe de produção
*
* @autor: Alessander Wasem
* @data: 2014-05-21 21:57
*/
class Curso{
      
    private $idCurso;
    private $nome;
    private $nivel;
    private $fkCampus;

      
    public function getIdCurso(){
        return $this->idCurso;
    }
    public function getNome(){
        return $this->nome;
    }
    public function getNivel(){
        return $this->nivel;
    }
    public function getFkCampus(){
        return $this->fkCampus;
    }
    public function setIdCurso($idCurso){
        $this->idCurso = $idCurso;
    }
    public function setNome($nome){
        $this->nome = $nome;
    }
    public function setNivel($nivel){
        $this->nivel = $nivel;
    }
    public function setFkCampus($fkCampus){
        $this->fkCampus = $fkCampus;
    }

}
