<?php

/**
 * Classe de operação da tabela 'avaliador_area'. Banco de Dados Mysql.
 * Estas classes não contemplam meu projeto final, por estarem obsoletas, estou contruindo
 * novos templates em Persistent Data Object com definição de prepared statements contra
 * sql injection, utilize para meio de testes, nunca coloque em produção, servindo
 * apenas de trampolin para classe de produção
 *
 * @autor: Alessander Wasem
 * @data: 2014-05-21 21:57
 */
class AvaliadorAreaMySqlDAO implements AvaliadorAreaDAO {

    protected $table = 'avaliador_area';

    /**
     * Implementa o dominio chave primária na seleção de único registro
     *
     * @parametro String $id primary key
     * @retorna AvaliadorAreaMySql 
     */
    public function load($id) {
        $sql = "SELECT * FROM $this->table WHERE fk_avaliador = :fk_avaliador";
        $stmt = ConnectionFactory::prepare($sql);
        $stmt->bindParam(':fk_avaliador', $id, PDO::PARAM_INT);
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
     * @parametro avaliadorArea chave primária
     */
    public function delete($id) {
        $sql = "DELETE FROM $this->table WHERE fk_avaliador = :fk_avaliador";
        $stmt = ConnectionFactory::prepare($sql);
        $stmt->bindParam(':fk_avaliador', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    /**
     * Inseri um registro na tabela
     *
     * @parametro AvaliadorAreaMySql avaliadorArea
     */
    public function insert(AvaliadorArea $AvaliadorArea) {
        $sql = "INSERT INTO $this->table (fk_area, fk_avaliador) VALUES (:fk_area, :fk_avaliador)";
        $fk_area = $AvaliadorArea->getFkArea();
        $fk_avaliador = $AvaliadorArea->getFkAvaliador();
        $stmt = ConnectionFactory::prepare($sql);
        $stmt->bindParam(':fk_avaliador', $fk_avaliador);
        $stmt->bindParam(':fk_area', $fk_area);
        return $stmt->execute();
    }

    /**
     * atualiza um registro da tabela
     *
     * @parametro AvaliadorAreaMySql avaliadorArea
     */
    public function update(AvaliadorArea $AvaliadorArea) {
        $sql = "UPDATE $this->table SET fk_area = :area WHERE fk_avaliador = :id";
        $id = $AvaliadorArea->getFkAvaliador();
        $area = $AvaliadorArea->getFkArea();
        $stmt = ConnectionFactory::prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':area', $area);
        return $stmt->execute();
    }

     public function queryAllAreaAvaliador($id) {
        $sql = "SELECT aa.fk_area as area FROM area a JOIN avaliador_area aa ON a.id_area = aa.fk_area AND fk_avaliador = :id";
        $stmt = ConnectionFactory::prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }
}
