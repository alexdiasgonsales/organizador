<?php
/**
* Classe de operação da tabela 'modalidade'. Banco de Dados Mysql.
* Estas classes não contemplam meu projeto final, por estarem obsoletas, estou contruindo
* novos templates em Persistent Data Object com definição de prepared statements contra
* sql injection, utilize para meio de testes, nunca coloque em produção, servindo
* apenas de trampolin para classe de produção
*
* @autor: Alessander Wasem
* @data: 2014-05-21 21:57
*/
class Modalidade{
      
    private $idModalidade;
    private $nome;

      
    public function getIdModalidade(){
        return $this->idModalidade;
    }
    public function getNome(){
        return $this->nome;
    }
    public function setIdModalidade($idModalidade){
        $this->idModalidade = $idModalidade;
    }
    public function setNome($nome){
        $this->nome = $nome;
    }

}
