<?php
/**
* Classe de operação da tabela 'usuario'. Banco de Dados Mysql.
* Estas classes não contemplam meu projeto final, por estarem obsoletas, estou contruindo
* novos templates em Persistent Data Object com definição de prepared statements contra
* sql injection, utilize para meio de testes, nunca coloque em produção, servindo
* apenas de trampolin para classe de produção
*
* @autor: Alessander Wasem
* @data: 2014-05-21 21:57
*/
class Usuario{
      
    private $idUsuario;
    private $cpf;
    private $nome;
    private $senha;
    private $email;

      
    public function getIdUsuario(){
        return $this->idUsuario;
    }

        return $this->cpf;
    }

        return $this->nome;
    }

        return $this->senha;
    }

        return $this->email;
    }

        $this->idUsuario = $idUsuario;
    }

        $this->cpf = $cpf;
    }

        $this->nome = $nome;
    }

        $this->senha = $senha;
    }

        $this->email = $email;
    }

}