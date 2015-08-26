<?php
/**
* Classe de operação da tabela 'adm2'. Banco de Dados Mysql.
* Estas classes não contemplam meu projeto final, por estarem obsoletas, estou contruindo
* novos templates em Persistent Data Object com definição de prepared statements contra
* sql injection, utilize para meio de testes, nunca coloque em produção, servindo
* apenas de trampolin para classe de produção
*
* @autor: Alessander Wasem
* @data: 2014-05-21 21:57
*/
class Adm2{
      
    private $idAdministrador;
    private $nivel;
    private $usuario;
    private $senha;

      
    public function getIdAdministrador(){
        return $this->idAdministrador;
    }
    public function getNivel(){
        return $this->nivel;
    }
    public function getUsuario(){
        return $this->usuario;
    }
    public function getSenha(){
        return $this->senha;
    }
    public function setIdAdministrador($idAdministrador){
        $this->idAdministrador = $idAdministrador;
    }
    public function setNivel($nivel){
        $this->nivel = $nivel;
    }
    public function setUsuario($usuario){
        $this->usuario = $usuario;
    }
    public function setSenha($senha){
        $this->senha = $senha;
    }

}
