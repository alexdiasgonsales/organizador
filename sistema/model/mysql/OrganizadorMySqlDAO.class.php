<?php

/**
 * Classe de operação da tabela 'organizador'. Banco de Dados Mysql.
 * Estas classes não contemplam meu projeto final, por estarem obsoletas, estou contruindo
 * novos templates em Persistent Data Object com definição de prepared statements contra
 * sql injection, utilize para meio de testes, nunca coloque em produção, servindo
 * apenas de trampolin para classe de produção
 *
 * @autor: Alessander Wasem
 * @data: 2014-05-21 21:57
 */
class OrganizadorMySqlDAO implements OrganizadorDAO {

    protected $table = 'organizador';

    /**
     * Implementa o dominio chave primária na seleção de único registro
     *
     * @parametro String $id primary key
     * @retorna OrganizadorMySql 
     */
    public function load($id) {
        $sql = "SELECT * FROM $this->table WHERE fk_usuario = :fk_usuario";
        $stmt = ConnectionFactory::prepare($sql);
        $stmt->bindParam(':fk_usuario', $id, PDO::PARAM_INT);
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
     * @parametro organizador chave primária
     */
    public function delete($id) {
        $sql = "DELETE FROM $this->table WHERE fk_usuario = :fk_usuario";
        $stmt = ConnectionFactory::prepare($sql);
        $stmt->bindParam(':fk_usuario', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    /**
     * Inseri um registro na tabela
     *
     * @parametro OrganizadorMySql organizador
     */
    public function insert(Organizador $Organizador) {
        $sql = "INSERT INTO $this->table (nivel, status) VALUES ( :nivel,  :status)";


        $nivel = $Organizador->getNivel();
        $status = $Organizador->getStatus();

        $stmt = ConnectionFactory::prepare($sql);


        $stmt->bindParam(':nivel', $nivel);
        $stmt->bindParam(':status', $status);
        return $stmt->execute();
    }

    /**
     * atualiza um registro da tabela
     *
     * @parametro OrganizadorMySql organizador
     */
    public function update(Organizador $Organizador) {
        $sql = "UPDATE $this->table SET nivel = :nivel, status = :status WHERE fk_usuario = :id";
        $id = $Organizador->getFkUsuario();


        $nivel = $Organizador->getNivel();
        $status = $Organizador->getStatus();

        $stmt = ConnectionFactory::prepare($sql);
        $stmt->bindParam(':id', $id);


        $stmt->bindParam(':nivel', $nivel);
        $stmt->bindParam(':status', $status);

        return $stmt->execute();
    }
}
