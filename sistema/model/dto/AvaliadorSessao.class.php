<?php
/**
* Classe de operação da tabela 'avaliador_sessao'. Banco de Dados Mysql.
* Estas classes não contemplam meu projeto final, por estarem obsoletas, estou contruindo
* novos templates em Persistent Data Object com definição de prepared statements contra
* sql injection, utilize para meio de testes, nunca coloque em produção, servindo
* apenas de trampolin para classe de produção
*
* @autor: Alessander Wasem
* @data: 2014-05-21 21:57
*/
class AvaliadorSessao{
      
    private $fkSessao;
    private $fkAvaliador;
    private $seq;
    private $status;

      
    public function getFkSessao(){
        return $this->fkSessao;
    }

        return $this->fkAvaliador;
    }

        return $this->seq;
    }

        return $this->status;
    }

        $this->fkSessao = $fkSessao;
    }

        $this->fkAvaliador = $fkAvaliador;
    }

        $this->seq = $seq;
    }

        $this->status = $status;
    }

}