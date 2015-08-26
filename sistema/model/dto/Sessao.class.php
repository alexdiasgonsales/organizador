<?php
/**
* Classe de operação da tabela 'sessao'. Banco de Dados Mysql.
* Estas classes não contemplam meu projeto final, por estarem obsoletas, estou contruindo
* novos templates em Persistent Data Object com definição de prepared statements contra
* sql injection, utilize para meio de testes, nunca coloque em produção, servindo
* apenas de trampolin para classe de produção
*
* @autor: Alessander Wasem
* @data: 2014-05-21 21:57
*/
class Sessao{
      
    private $idSessao;
    private $numero;
    private $nome;
    private $sala;
    private $nomeSala;
    private $andar;
    private $nomeAndar;
    private $data;
    private $horaIni;
    private $horaFim;
    private $fkModalidade;
    private $status;

      
    public function getIdSessao(){
        return $this->idSessao;
    }
    public function getNumero(){
        return $this->numero;
    }
    public function getNome(){
        return $this->nome;
    }
    public function getSala(){
        return $this->sala;
    }
    public function getNomeSala(){
        return $this->nomeSala;
    }
    public function getAndar(){
        return $this->andar;
    }
    public function getNomeAndar(){
        return $this->nomeAndar;
    }
    public function getData(){
        return $this->data;
    }
    public function getHoraIni(){
        return $this->horaIni;
    }
    public function getHoraFim(){
        return $this->horaFim;
    }
    public function getFkModalidade(){
        return $this->fkModalidade;
    }
    public function getStatus(){
        return $this->status;
    }
    public function setIdSessao($idSessao){
        $this->idSessao = $idSessao;
    }
    public function setNumero($numero){
        $this->numero = $numero;
    }
    public function setNome($nome){
        $this->nome = $nome;
    }
    public function setSala($sala){
        $this->sala = $sala;
    }
    public function setNomeSala($nomeSala){
        $this->nomeSala = $nomeSala;
    }
    public function setAndar($andar){
        $this->andar = $andar;
    }
    public function setNomeAndar($nomeAndar){
        $this->nomeAndar = $nomeAndar;
    }
    public function setData($data){
        $this->data = $data;
    }
    public function setHoraIni($horaIni){
        $this->horaIni = $horaIni;
    }
    public function setHoraFim($horaFim){
        $this->horaFim = $horaFim;
    }
    public function setFkModalidade($fkModalidade){
        $this->fkModalidade = $fkModalidade;
    }
    public function setStatus($status){
        $this->status = $status;
    }

}
