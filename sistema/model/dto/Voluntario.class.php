<?php
/**
* Classe de operação da tabela 'voluntario'. Banco de Dados Mysql.
* Estas classes não contemplam meu projeto final, por estarem obsoletas, estou contruindo
* novos templates em Persistent Data Object com definição de prepared statements contra
* sql injection, utilize para meio de testes, nunca coloque em produção, servindo
* apenas de trampolin para classe de produção
*
* @autor: Alessander Wasem
* @data: 2014-05-21 21:57
*/
class Voluntario{
      
    private $fkUsuario;
    private $status;
    private $fkCurso;
    private $observacoes;
    private $manha;
    private $tarde;
    private $noite;
    private $telefone1;
    private $telefone2;
    private $telefone3;
    private $presenca;

      
    public function getFkUsuario(){
        return $this->fkUsuario;
    }

        return $this->status;
    }

        return $this->fkCurso;
    }

        return $this->observacoes;
    }

        return $this->manha;
    }

        return $this->tarde;
    }

        return $this->noite;
    }

        return $this->telefone1;
    }

        return $this->telefone2;
    }

        return $this->telefone3;
    }

        return $this->presenca;
    }

        $this->fkUsuario = $fkUsuario;
    }

        $this->status = $status;
    }

        $this->fkCurso = $fkCurso;
    }

        $this->observacoes = $observacoes;
    }

        $this->manha = $manha;
    }

        $this->tarde = $tarde;
    }

        $this->noite = $noite;
    }

        $this->telefone1 = $telefone1;
    }

        $this->telefone2 = $telefone2;
    }

        $this->telefone3 = $telefone3;
    }

        $this->presenca = $presenca;
    }

}