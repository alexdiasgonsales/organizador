<?php
/**
* Classe de operação da tabela 'organizador'. Banco de Dados Mysql.
* Estas classes não contemplam meu projeto final, por estarem obsoletas, estou contruindo
* novos templates em Persistent Data Object com definição de prepared statements contra
* sql injection, utilize para meio de testes, nunca coloque em produção, servindo
* apenas de trampolin para classe de produção
*
* @autor: Alessander Wasem
* @data: 2014-05-21 21:57
*/
class Organizador{
      
    private $fkUsuario;
    private $nivel;
    private $status;

      
    public function getFkUsuario(){
        return $this->fkUsuario;
    }

        return $this->nivel;
    }

        return $this->status;
    }

        $this->fkUsuario = $fkUsuario;
    }

        $this->nivel = $nivel;
    }

        $this->status = $status;
    }

}