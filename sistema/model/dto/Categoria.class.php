<?php
/**
* Classe de operação da tabela 'categoria'. Banco de Dados Mysql.
* Estas classes não contemplam meu projeto final, por estarem obsoletas, estou contruindo
* novos templates em Persistent Data Object com definição de prepared statements contra
* sql injection, utilize para meio de testes, nunca coloque em produção, servindo
* apenas de trampolin para classe de produção
*
* @autor: Alessander Wasem
* @data: 2014-05-21 21:57
*/
class Categoria{
      
    private $idCategoria;
    private $nome;

      
    public function getIdCategoria(){
        return $this->idCategoria;
    }

        return $this->nome;
    }

        $this->idCategoria = $idCategoria;
    }

        $this->nome = $nome;
    }

}