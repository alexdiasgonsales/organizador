<?php
/**
* Classe de operação da tabela 'ouvinte'. Banco de Dados Mysql.
* Estas classes não contemplam meu projeto final, por estarem obsoletas, estou contruindo
* novos templates em Persistent Data Object com definição de prepared statements contra
* sql injection, utilize para meio de testes, nunca coloque em produção, servindo
* apenas de trampolin para classe de produção
*
* @autor: Alessander Wasem
* @data: 2014-05-21 21:57
*/
class Ouvinte{
      
    private $fkUsuario;
    private $fkInstituicao;
    private $fkCampus;
    private $fkCurso;
    private $tipoOuvinte;
    private $outro;
    private $empresa;

      
    public function getFkUsuario(){
        return $this->fkUsuario;
    }
    public function getFkInstituicao(){
        return $this->fkInstituicao;
    }
    public function getFkCampus(){
        return $this->fkCampus;
    }
    public function getFkCurso(){
        return $this->fkCurso;
    }
    public function getTipoOuvinte(){
        return $this->tipoOuvinte;
    }
    public function getOutro(){
        return $this->outro;
    }
    public function getEmpresa(){
        return $this->empresa;
    }
    public function setFkUsuario($fkUsuario){
        $this->fkUsuario = $fkUsuario;
    }
    public function setFkInstituicao($fkInstituicao){
        $this->fkInstituicao = $fkInstituicao;
    }
    public function setFkCampus($fkCampus){
        $this->fkCampus = $fkCampus;
    }
    public function setFkCurso($fkCurso){
        $this->fkCurso = $fkCurso;
    }
    public function setTipoOuvinte($tipoOuvinte){
        $this->tipoOuvinte = $tipoOuvinte;
    }
    public function setOutro($outro){
        $this->outro = $outro;
    }
    public function setEmpresa($empresa){
        $this->empresa = $empresa;
    }

}
