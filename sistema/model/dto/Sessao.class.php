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

        return $this->numero;
    }

        return $this->nome;
    }

        return $this->sala;
    }

        return $this->nomeSala;
    }

        return $this->andar;
    }

        return $this->nomeAndar;
    }

        return $this->data;
    }

        return $this->horaIni;
    }

        return $this->horaFim;
    }

        return $this->fkModalidade;
    }

        return $this->status;
    }

        $this->idSessao = $idSessao;
    }

        $this->numero = $numero;
    }

        $this->nome = $nome;
    }

        $this->sala = $sala;
    }

        $this->nomeSala = $nomeSala;
    }

        $this->andar = $andar;
    }

        $this->nomeAndar = $nomeAndar;
    }

        $this->data = $data;
    }

        $this->horaIni = $horaIni;
    }

        $this->horaFim = $horaFim;
    }

        $this->fkModalidade = $fkModalidade;
    }

        $this->status = $status;
    }

}