<?php
/**
* Classe de operação da tabela 'campus'. Banco de Dados Mysql.
* Estas classes não contemplam meu projeto final, por estarem obsoletas, estou contruindo
* novos templates em Persistent Data Object com definição de prepared statements contra
* sql injection, utilize para meio de testes, nunca coloque em produção, servindo
* apenas de trampolin para classe de produção
*
* @autor: Alessander Wasem
* @data: 2014-05-21 21:57
*/
class Campus{
      
    private $idCampus;
    private $nome;
    private $cidade;
    private $fkInstituicao;

      
    public function getIdCampus(){
        return $this->idCampus;
    }

    public function getNome(){
        return $this->nome;
    }

    public function getCidade(){
        return $this->cidade;
    }

    public function getFkInstituicao(){
        return $this->fkInstituicao;
    }

    public function setIdCampus($idCampus){
        $this->idCampus = $idCampus;
    }

    public function setNome($nome){
        $this->nome = $nome;
    }

    public function setCidade($cidade){
        $this->cidade = $cidade;
    }

    public function setFkInstituicao($fkInstituicao){
        $this->fkInstituicao = $fkInstituicao;
    }


}
