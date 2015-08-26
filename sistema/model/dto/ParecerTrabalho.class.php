<?php
/**
* Classe de operação da tabela 'parecer_trabalho'. Banco de Dados Mysql.
* Estas classes não contemplam meu projeto final, por estarem obsoletas, estou contruindo
* novos templates em Persistent Data Object com definição de prepared statements contra
* sql injection, utilize para meio de testes, nunca coloque em produção, servindo
* apenas de trampolin para classe de produção
*
* @autor: Alessander Wasem
* @data: 2014-05-21 21:57
*/
class ParecerTrabalho{
      
    private $fkTrabalho;
    private $seq;
    private $fkRevisor;
    private $datahora;
    private $status;
    private $statusIntroducao;
    private $statusObjetivos;
    private $statusMetodologia;
    private $statusResultados;
    private $observacoes;
    private $observacoesInternas;
    private $autorCiente;
    private $obsIntroducao;
    private $obsObjetivos;
    private $obsMetodologia;
    private $obsResultados;

      
    public function getFkTrabalho(){
        return $this->fkTrabalho;
    }
    public function getSeq(){
        return $this->seq;
    }
    public function getFkRevisor(){
        return $this->fkRevisor;
    }
    public function getDatahora(){
        return $this->datahora;
    }
    public function getStatus(){
        return $this->status;
    }
    public function getStatusIntroducao(){
        return $this->statusIntroducao;
    }
    public function getStatusObjetivos(){
        return $this->statusObjetivos;
    }
    public function getStatusMetodologia(){
        return $this->statusMetodologia;
    }
    public function getStatusResultados(){
        return $this->statusResultados;
    }
    public function getObservacoes(){
        return $this->observacoes;
    }
    public function getObservacoesInternas(){
        return $this->observacoesInternas;
    }
    public function getAutorCiente(){
        return $this->autorCiente;
    }
    public function getObsIntroducao(){
        return $this->obsIntroducao;
    }
    public function getObsObjetivos(){
        return $this->obsObjetivos;
    }
    public function getObsMetodologia(){
        return $this->obsMetodologia;
    }
    public function getObsResultados(){
        return $this->obsResultados;
    }
    public function setFkTrabalho($fkTrabalho){
        $this->fkTrabalho = $fkTrabalho;
    }
    public function setSeq($seq){
        $this->seq = $seq;
    }
    public function setFkRevisor($fkRevisor){
        $this->fkRevisor = $fkRevisor;
    }
    public function setDatahora($datahora){
        $this->datahora = $datahora;
    }
    public function setStatus($status){
        $this->status = $status;
    }
    public function setStatusIntroducao($statusIntroducao){
        $this->statusIntroducao = $statusIntroducao;
    }
    public function setStatusObjetivos($statusObjetivos){
        $this->statusObjetivos = $statusObjetivos;
    }
    public function setStatusMetodologia($statusMetodologia){
        $this->statusMetodologia = $statusMetodologia;
    }
    public function setStatusResultados($statusResultados){
        $this->statusResultados = $statusResultados;
    }
    public function setObservacoes($observacoes){
        $this->observacoes = $observacoes;
    }
    public function setObservacoesInternas($observacoesInternas){
        $this->observacoesInternas = $observacoesInternas;
    }
    public function setAutorCiente($autorCiente){
        $this->autorCiente = $autorCiente;
    }
    public function setObsIntroducao($obsIntroducao){
        $this->obsIntroducao = $obsIntroducao;
    }
    public function setObsObjetivos($obsObjetivos){
        $this->obsObjetivos = $obsObjetivos;
    }
    public function setObsMetodologia($obsMetodologia){
        $this->obsMetodologia = $obsMetodologia;
    }
    public function setObsResultados($obsResultados){
        $this->obsResultados = $obsResultados;
    }

}
