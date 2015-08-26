<?php
/**
* Classe de operação da tabela 'voluntario'. Banco de Dados Mysql.
* Estas classes não contemplam meu projeto final, por estarem obsoletas, estou contruindo
* novos templates em Persistent Data Object com definição de prepared statements contra
* sql injection, utilize para meio de testes, nunca coloque em produção, servindo
* apenas de trampolin para classe de produção
*
* @autor: Alessander Wasem
* @data: 2014-05-21 21:57
*/
class Voluntario{
      
    private $fkUsuario;
    private $status;
    private $fkCurso;
    private $observacoes;
    private $manha;
    private $tarde;
    private $noite;
    private $telefone1;
    private $telefone2;
    private $telefone3;
    private $presenca;

      
    public function getFkUsuario(){
        return $this->fkUsuario;
    }
    public function getStatus(){
        return $this->status;
    }
    public function getFkCurso(){
        return $this->fkCurso;
    }
    public function getObservacoes(){
        return $this->observacoes;
    }
    public function getManha(){
        return $this->manha;
    }
    public function getTarde(){
        return $this->tarde;
    }
    public function getNoite(){
        return $this->noite;
    }
    public function getTelefone1(){
        return $this->telefone1;
    }
    public function getTelefone2(){
        return $this->telefone2;
    }
    public function getTelefone3(){
        return $this->telefone3;
    }
    public function getPresenca(){
        return $this->presenca;
    }
    public function setFkUsuario($fkUsuario){
        $this->fkUsuario = $fkUsuario;
    }
    public function setStatus($status){
        $this->status = $status;
    }
    public function setFkCurso($fkCurso){
        $this->fkCurso = $fkCurso;
    }
    public function setObservacoes($observacoes){
        $this->observacoes = $observacoes;
    }
    public function setManha($manha){
        $this->manha = $manha;
    }
    public function setTarde($tarde){
        $this->tarde = $tarde;
    }
    public function setNoite($noite){
        $this->noite = $noite;
    }
    public function setTelefone1($telefone1){
        $this->telefone1 = $telefone1;
    }
    public function setTelefone2($telefone2){
        $this->telefone2 = $telefone2;
    }
    public function setTelefone3($telefone3){
        $this->telefone3 = $telefone3;
    }
    public function setPresenca($presenca){
        $this->presenca = $presenca;
    }

}
