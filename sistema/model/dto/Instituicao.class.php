<?php
/**
* Classe de operação da tabela 'instituicao'. Banco de Dados Mysql.
* Estas classes não contemplam meu projeto final, por estarem obsoletas, estou contruindo
* novos templates em Persistent Data Object com definição de prepared statements contra
* sql injection, utilize para meio de testes, nunca coloque em produção, servindo
* apenas de trampolin para classe de produção
*
* @autor: Alessander Wasem
* @data: 2014-05-21 21:57
*/
class Instituicao{
      
    private $idInstituicao;
    private $nome;
    private $sigla;
    private $cidade;
    private $estado;
    private $site;
    private $tipo;

      
    public function getIdInstituicao(){
        return $this->idInstituicao;
    }
    public function getNome(){
        return $this->nome;
    }
    public function getSigla(){
        return $this->sigla;
    }
    public function getCidade(){
        return $this->cidade;
    }
    public function getEstado(){
        return $this->estado;
    }
    public function getSite(){
        return $this->site;
    }
    public function getTipo(){
        return $this->tipo;
    }
    public function setIdInstituicao($idInstituicao){
        $this->idInstituicao = $idInstituicao;
    }
    public function setNome($nome){
        $this->nome = $nome;
    }
    public function setSigla($sigla){
        $this->sigla = $sigla;
    }
    public function setCidade($cidade){
        $this->cidade = $cidade;
    }
    public function setEstado($estado){
        $this->estado = $estado;
    }
    public function setSite($site){
        $this->site = $site;
    }
    public function setTipo($tipo){
        $this->tipo = $tipo;
    }

}
