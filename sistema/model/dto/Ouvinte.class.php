<?php
/**
* Classe de operação da tabela 'ouvinte'. Banco de Dados Mysql.
* Estas classes não contemplam meu projeto final, por estarem obsoletas, estou contruindo
* novos templates em Persistent Data Object com definição de prepared statements contra
* sql injection, utilize para meio de testes, nunca coloque em produção, servindo
* apenas de trampolin para classe de produção
*
* @autor: Alessander Wasem
* @data: 2014-05-21 21:57
*/
class Ouvinte{
      
    private $fkUsuario;
    private $fkInstituicao;
    private $fkCampus;
    private $fkCurso;
    private $tipoOuvinte;
    private $outro;
    private $empresa;

      
    public function getFkUsuario(){
        return $this->fkUsuario;
    }

        return $this->fkInstituicao;
    }

        return $this->fkCampus;
    }

        return $this->fkCurso;
    }

        return $this->tipoOuvinte;
    }

        return $this->outro;
    }

        return $this->empresa;
    }

        $this->fkUsuario = $fkUsuario;
    }

        $this->fkInstituicao = $fkInstituicao;
    }

        $this->fkCampus = $fkCampus;
    }

        $this->fkCurso = $fkCurso;
    }

        $this->tipoOuvinte = $tipoOuvinte;
    }

        $this->outro = $outro;
    }

        $this->empresa = $empresa;
    }

}