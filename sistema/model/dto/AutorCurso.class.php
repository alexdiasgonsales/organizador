<?php
/**
* Classe de operação da tabela 'autor_curso'. Banco de Dados Mysql.
* Estas classes não contemplam meu projeto final, por estarem obsoletas, estou contruindo
* novos templates em Persistent Data Object com definição de prepared statements contra
* sql injection, utilize para meio de testes, nunca coloque em produção, servindo
* apenas de trampolin para classe de produção
*
* @autor: Alessander Wasem
* @data: 2014-05-21 21:57
*/
class AutorCurso{
      
    private $fkAutor;
    private $fkCurso;
    private $seq;
    private $status;

      
    public function getFkAutor(){
        return $this->fkAutor;
    }

        return $this->fkCurso;
    }

        return $this->seq;
    }

        return $this->status;
    }

        $this->fkAutor = $fkAutor;
    }

        $this->fkCurso = $fkCurso;
    }

        $this->seq = $seq;
    }

        $this->status = $status;
    }

}