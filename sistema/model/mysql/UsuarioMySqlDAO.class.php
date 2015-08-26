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
class UsuarioMySqlDAO implements UsuarioDAO {

    protected $table = 'usuario';

    /**
     * Implementa o dominio chave primária na seleção de único registro
     *
     * @parametro String $id primary key
     * @retorna UsuarioMySql 
     */
    public function load($id) {
        $sql = "SELECT * FROM $this->table WHERE id_usuario = :id_usuario";
        $stmt = ConnectionFactory::prepare($sql);
        $stmt->bindParam(':id_usuario', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    /**
     * Obtem todos o registros das Tabelas
     */
    public function queryAll() {
        $sql = "SELECT * FROM $this->table";
        $stmt = ConnectionFactory::prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /**
     * Exclui um registro da tabela
     * @parametro usuario chave primária
     */
    public function delete($id) {
        $sql = "DELETE FROM $this->table WHERE id_usuario = :id_usuario";
        $stmt = ConnectionFactory::prepare($sql);
        $stmt->bindParam(':id_usuario', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    /**
     * Inseri um registro na tabela
     *
     * @parametro UsuarioMySql usuario
     */
    public function insert(Usuario $Usuario) {
        $sql = "INSERT INTO $this->table (cpf, nome, senha, email) VALUES ( :cpf,  :nome,  :senha,  :email)";
        $cpf = $Usuario->getCpf();
        $nome = $Usuario->getNome();
        $senha = $Usuario->getSenha();
        $email = $Usuario->getEmail();
        $stmt = ConnectionFactory::prepare($sql);
        $stmt->bindParam(':cpf', $cpf);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':senha', $senha);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $sql = "SELECT LAST_INSERT_ID() as last_id";
        $stmt = ConnectionFactory::prepare($sql);
        $stmt->execute();
        $last_id = (array) $stmt->fetch();
        foreach ($last_id as $value) {
            $_REQUEST['id'] = $value;
        }
    }

    /**
     * atualiza um registro da tabela
     *
     * @parametro UsuarioMySql usuario
     */
    public function update(Usuario $Usuario) {
        $sql = "UPDATE $this->table SET nome = :nome, email = :email WHERE id_usuario = :id";
        $stmt = ConnectionFactory::prepare($sql);
        $id = $Usuario->getIdUsuario();
        $nome = $Usuario->getNome();
        $email = $Usuario->getEmail();
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        return $stmt->execute();
    }

    public function loadLoginPassword($cpf, $pass) {
        $sql = "SELECT 
usuario.id_usuario AS id, 
autor.fk_usuario AS autor, 
avaliador.fk_usuario AS avaliador, 
orientador.fk_usuario AS orientador, 
ouvinte.fk_usuario AS ouvinte,
usuario.nome AS nome,
usuario.email AS email,
voluntario.fk_usuario AS voluntario, 
revisor.fk_usuario AS revisor, 
organizador.fk_usuario AS organizador,
organizador.status AS organizadorStatus,
usuario.cpf AS cpf
FROM (((((usuario
LEFT JOIN autor ON usuario.id_usuario = autor.fk_usuario)
LEFT  JOIN avaliador ON usuario.id_usuario = avaliador.fk_usuario)
LEFT JOIN orientador ON usuario.id_usuario = orientador.fk_usuario)
LEFT  JOIN ouvinte ON usuario.id_usuario = ouvinte.fk_usuario)
LEFT  JOIN revisor ON usuario.id_usuario = revisor.fk_usuario)
LEFT  JOIN voluntario ON usuario.id_usuario = voluntario.fk_usuario
LEFT  JOIN organizador ON usuario.id_usuario = organizador.fk_usuario
WHERE usuario.cpf = :cpf AND usuario.senha = :senha";
        $stmt = ConnectionFactory::prepare($sql);
        $stmt->bindParam(':senha', $pass, PDO::PARAM_STR);
        $stmt->bindParam(':cpf', $cpf, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function loadCPF($cpf) {
        $sql = "SELECT cpf FROM $this->table WHERE cpf = :cpf";
        $stmt = ConnectionFactory::prepare($sql);
        $stmt->bindParam(':cpf', $cpf, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function loadCPFEsqueceu($cpf) {
        $sql = "SELECT * FROM $this->table WHERE cpf = :cpf";
        $stmt = ConnectionFactory::prepare($sql);
        $stmt->bindParam(':cpf', $cpf, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function updateSenha($senha,$id) {
        $sql = "UPDATE $this->table SET senha = :senha WHERE id_usuario = :id";
        $stmt = ConnectionFactory::prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':senha', $senha);
        return $stmt->execute();
    }

}
