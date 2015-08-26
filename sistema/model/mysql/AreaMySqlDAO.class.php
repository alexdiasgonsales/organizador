<?php

/**
 * Classe de operação da tabela 'tematica'. Banco de Dados Mysql.
 * Estas classes não contemplam meu projeto final, por estarem obsoletas, estou contruindo
 * novos templates em Persistent Data Object com definição de prepared statements contra
 * sql injection, utilize para meio de testes, nunca coloque em produção, servindo
 * apenas de trampolin para classe de produção
 *
 * @autor: Alessander Wasem
 * @data: 2014-05-21 21:57
 */
class AreaMySqlDAO implements AreaDAO {

    protected $table = 'area';

    /**
     * Implementa o dominio chave primária na seleção de único registro
     *
     * @parametro String $id primary key
     * @retorna TematicaMySql 
     */
    public function load($id) {
        $sql = "SELECT * FROM $this->table WHERE id_area = :id_area";
        $stmt = ConnectionFactory::prepare($sql);
        $stmt->bindParam(':id_area', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    /**
     * Obtem todos o registros das Tabelas
     */
    public function queryAll() {
        $sql = "SELECT * FROM $this->table ORDER BY id_area";
        $stmt = ConnectionFactory::prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /**
     * Exclui um registro da tabela
     * @parametro tematica chave primária
     */
    public function delete($id) {
        $sql = "DELETE FROM $this->table WHERE id_area = :id_area";
        $stmt = ConnectionFactory::prepare($sql);
        $stmt->bindParam(':id_area', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    /**
     * Inseri um registro na tabela
     *
     * @parametro TematicaMySql tematica
     */
    public function insert(Area $area) {
        $sql = "INSERT INTO $this->table (nome) VALUES ( :nome)";


        $nome = $area->getNome();

        $stmt = ConnectionFactory::prepare($sql);


        $stmt->bindParam(':nome', $nome);
        return $stmt->execute();
    }

    /**
     * atualiza um registro da tabela
     *
     * @parametro TematicaMySql tematica
     */
    public function update(Area $area) {
        $sql = "UPDATE $this->table SET nome = :nome WHERE id_area = :id";
        $id = $Tematica->getIdArea();


        $nome = $Tematica->getNome();

        $stmt = ConnectionFactory::prepare($sql);
        $stmt->bindParam(':id', $id);


        $stmt->bindParam(':nome', $nome);

        return $stmt->execute();
    }

    public function queryAllSelect() {
        $sql = "SELECT id_area, nome FROM $this->table";
        $stmt = ConnectionFactory::prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

}
