<?php
/**
* Classe de operação da tabela 'avaliador'. Banco de Dados Mysql.
* Estas classes não contemplam meu projeto final, por estarem obsoletas, estou contruindo
* novos templates em Persistent Data Object com definição de prepared statements contra
* sql injection, utilize para meio de testes, nunca coloque em produção, servindo
* apenas de trampolin para classe de produção
*
* @autor: Alessander Wasem
* @data: 2014-05-21 21:57
*/
class Avaliador{
      
    private $fkUsuario;
    private $fkCampus;
    private $tipoServidor;
    private $formacao;
    private $status;

      
    public function getFkUsuario(){
        return $this->fkUsuario;
    }
    public function getFkCampus(){
        return $this->fkCampus;
    }
    public function getTipoServidor(){
        return $this->tipoServidor;
    }
    public function getFormacao(){
        return $this->formacao;
    }
    public function getStatus(){
        return $this->status;
    }
    public function setFkUsuario($fkUsuario){
        $this->fkUsuario = $fkUsuario;
    }
    public function setFkCampus($fkCampus){
        $this->fkCampus = $fkCampus;
    }
    public function setTipoServidor($tipoServidor){
        $this->tipoServidor = $tipoServidor;
    }
    public function setFormacao($formacao){
        $this->formacao = $formacao;
    }
    public function setStatus($status){
        $this->status = $status;
    }

}
