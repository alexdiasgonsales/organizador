<?php
/**
* Classe de operação da tabela 'revisor'. Banco de Dados Mysql.
* Estas classes não contemplam meu projeto final, por estarem obsoletas, estou contruindo
* novos templates em Persistent Data Object com definição de prepared statements contra
* sql injection, utilize para meio de testes, nunca coloque em produção, servindo
* apenas de trampolin para classe de produção
*
* @autor: Alessander Wasem
* @data: 2014-05-21 21:57
*/
class Revisor{
      
    private $fkUsuario;
    private $fkCampus;

      
    public function getFkUsuario(){
        return $this->fkUsuario;
    }
    public function getFkCampus(){
        return $this->fkCampus;
    }
    public function setFkUsuario($fkUsuario){
        $this->fkUsuario = $fkUsuario;
    }
    public function setFkCampus($fkCampus){
        $this->fkCampus = $fkCampus;
    }

}
