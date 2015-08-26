<?php
/**
* Classe de operação da tabela 'usuario_permissao'. Banco de Dados Mysql.
* Estas classes não contemplam meu projeto final, por estarem obsoletas, estou contruindo
* novos templates em Persistent Data Object com definição de prepared statements contra
* sql injection, utilize para meio de testes, nunca coloque em produção, servindo
* apenas de trampolin para classe de produção
*
* @autor: Alessander Wasem
* @data: 2014-05-21 21:57
*/
class UsuarioPermissao{
      
    private $idPermissao;
    private $fkUsuario;

      
    public function getIdPermissao(){
        return $this->idPermissao;
    }
    public function getFkUsuario(){
        return $this->fkUsuario;
    }
    public function setIdPermissao($idPermissao){
        $this->idPermissao = $idPermissao;
    }
    public function setFkUsuario($fkUsuario){
        $this->fkUsuario = $fkUsuario;
    }

}
