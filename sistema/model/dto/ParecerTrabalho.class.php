<?php
/**
* Classe de operação da tabela 'parecer_trabalho'. Banco de Dados Mysql.
* Estas classes não contemplam meu projeto final, por estarem obsoletas, estou contruindo
* novos templates em Persistent Data Object com definição de prepared statements contra
* sql injection, utilize para meio de testes, nunca coloque em produção, servindo
* apenas de trampolin para classe de produção
*
* @autor: Alessander Wasem
* @data: 2014-05-21 21:57
*/
class ParecerTrabalho{
      
    private $fkTrabalho;
    private $seq;
    private $fkRevisor;
    private $datahora;
    private $status;
    private $statusIntroducao;
    private $statusObjetivos;
    private $statusMetodologia;
    private $statusResultados;
    private $observacoes;
    private $observacoesInternas;
    private $autorCiente;
    private $obsIntroducao;
    private $obsObjetivos;
    private $obsMetodologia;
    private $obsResultados;

      
    public function getFkTrabalho(){
        return $this->fkTrabalho;
    }

        return $this->seq;
    }

        return $this->fkRevisor;
    }

        return $this->datahora;
    }

        return $this->status;
    }

        return $this->statusIntroducao;
    }

        return $this->statusObjetivos;
    }

        return $this->statusMetodologia;
    }

        return $this->statusResultados;
    }

        return $this->observacoes;
    }

        return $this->observacoesInternas;
    }

        return $this->autorCiente;
    }

        return $this->obsIntroducao;
    }

        return $this->obsObjetivos;
    }

        return $this->obsMetodologia;
    }

        return $this->obsResultados;
    }

        $this->fkTrabalho = $fkTrabalho;
    }

        $this->seq = $seq;
    }

        $this->fkRevisor = $fkRevisor;
    }

        $this->datahora = $datahora;
    }

        $this->status = $status;
    }

        $this->statusIntroducao = $statusIntroducao;
    }

        $this->statusObjetivos = $statusObjetivos;
    }

        $this->statusMetodologia = $statusMetodologia;
    }

        $this->statusResultados = $statusResultados;
    }

        $this->observacoes = $observacoes;
    }

        $this->observacoesInternas = $observacoesInternas;
    }

        $this->autorCiente = $autorCiente;
    }

        $this->obsIntroducao = $obsIntroducao;
    }

        $this->obsObjetivos = $obsObjetivos;
    }

        $this->obsMetodologia = $obsMetodologia;
    }

        $this->obsResultados = $obsResultados;
    }

}