<?php
/**
* Classe de operação da tabela 'avaliador'. Banco de Dados Mysql.
* Estas classes não contemplam meu projeto final, por estarem obsoletas, estou contruindo
* novos templates em Persistent Data Object com definição de prepared statements contra
* sql injection, utilize para meio de testes, nunca coloque em produção, servindo
* apenas de trampolin para classe de produção
*
* @autor: Alessander Wasem
* @data: 2014-05-21 21:57
*/
class Avaliador{
      
    private $fkUsuario;
    private $fkCampus;
    private $tipoServidor;
    private $formacao;
    private $status;

      
    public function getFkUsuario(){
        return $this->fkUsuario;
    }

        return $this->fkCampus;
    }

        return $this->tipoServidor;
    }

        return $this->formacao;
    }

        return $this->status;
    }

        $this->fkUsuario = $fkUsuario;
    }

        $this->fkCampus = $fkCampus;
    }

        $this->tipoServidor = $tipoServidor;
    }

        $this->formacao = $formacao;
    }

        $this->status = $status;
    }

}