<?php
/**
* Classe de operação da tabela 'instituicao'. Banco de Dados Mysql.
* Estas classes não contemplam meu projeto final, por estarem obsoletas, estou contruindo
* novos templates em Persistent Data Object com definição de prepared statements contra
* sql injection, utilize para meio de testes, nunca coloque em produção, servindo
* apenas de trampolin para classe de produção
*
* @autor: Alessander Wasem
* @data: 2014-05-21 21:57
*/
class Instituicao{
      
    private $idInstituicao;
    private $nome;
    private $sigla;
    private $cidade;
    private $estado;
    private $site;
    private $tipo;

      
    public function getIdInstituicao(){
        return $this->idInstituicao;
    }

        return $this->nome;
    }

        return $this->sigla;
    }

        return $this->cidade;
    }

        return $this->estado;
    }

        return $this->site;
    }

        return $this->tipo;
    }

        $this->idInstituicao = $idInstituicao;
    }

        $this->nome = $nome;
    }

        $this->sigla = $sigla;
    }

        $this->cidade = $cidade;
    }

        $this->estado = $estado;
    }

        $this->site = $site;
    }

        $this->tipo = $tipo;
    }

}