<?php
/**
* Classe de operação da tabela 'permissao'. Banco de Dados Mysql.
* Estas classes não contemplam meu projeto final, por estarem obsoletas, estou contruindo
* novos templates em Persistent Data Object com definição de prepared statements contra
* sql injection, utilize para meio de testes, nunca coloque em produção, servindo
* apenas de trampolin para classe de produção
*
* @autor: Alessander Wasem
* @data: 2014-05-21 21:57
*/
class Permissao{
      
    private $idPermissao;
    private $nomePermissao;

      
    public function getIdPermissao(){
        return $this->idPermissao;
    }
    public function getNomePermissao(){
        return $this->nomePermissao;
    }
    public function setIdPermissao($idPermissao){
        $this->idPermissao = $idPermissao;
    }
    public function setNomePermissao($nomePermissao){
        $this->nomePermissao = $nomePermissao;
    }

}
