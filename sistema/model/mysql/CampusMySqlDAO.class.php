<?php

/**
 * Classe de operação da tabela 'campus'. Banco de Dados Mysql.
 * Estas classes não contemplam meu projeto final, por estarem obsoletas, estou contruindo
 * novos templates em Persistent Data Object com definição de prepared statements contra
 * sql injection, utilize para meio de testes, nunca coloque em produção, servindo
 * apenas de trampolin para classe de produção
 *
 * @autor: Alessander Wasem
 * @data: 2014-05-21 21:57
 */
class CampusMySqlDAO implements CampusDAO {

    protected $table = 'campus';

    /**
     * Implementa o dominio chave primária na seleção de único registro
     *
     * @parametro String $id primary key
     * @retorna CampusMySql 
     */
    public function load($id) {
        $sql = "SELECT * FROM $this->table WHERE id_campus = :id_campus";
        $stmt = ConnectionFactory::prepare($sql);
        $stmt->bindParam(':id_campus', $id, PDO::PARAM_INT);
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
     * @parametro campu chave primária
     */
    public function delete($id) {
        $sql = "DELETE FROM $this->table WHERE id_campus = :id_campus";
        $stmt = ConnectionFactory::prepare($sql);
        $stmt->bindParam(':id_campus', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    /**
     * Inseri um registro na tabela
     *
     * @parametro CampusMySql campu
     */
    public function insert(Campus $Campus) {
        $sql = "INSERT INTO $this->table (nome, cidade, fk_instituicao) VALUES ( :nome,  :cidade,  :fkInstituicao)";

        $nome = $Campus->getNome();
        $cidade = $Campus->getCidade();
        $fkInstituicao = $Campus->getFkInstituicao();

        $stmt = ConnectionFactory::prepare($sql);

        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':cidade', $cidade);
        $stmt->bindParam(':fkInstituicao', $fkInstituicao);
        $stmt->execute();
        
        $sql = "SELECT LAST_INSERT_ID() as last_id";
        $stmt = ConnectionFactory::prepare($sql);
        $stmt->execute();
        $last_id = (array) $stmt->fetch();
        foreach ($last_id as $value) {
            //$_POST['id_campus'] = $value; //<<<<<<<<<<<<<<<<< ver com Alexandre
            return $value;
        }
    }

    /**
     * atualiza um registro da tabela
     *
     * @parametro CampusMySql campu
     */
    public function update(Campus $Campus) {
        $sql = "UPDATE $this->table SET nome = :nome, cidade = :cidade, fk_instituicao = :fk_instituicao WHERE id_campus = :id";
        $id = $Campus->getIdCampus();


        $nome = $Campus->getNome();
        $cidade = $Campus->getCidade();
        $fkInstituicao = $Campus->getFkInstituicao();

        $stmt = ConnectionFactory::prepare($sql);
        $stmt->bindParam(':id', $id);


        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':cidade', $cidade);
        $stmt->bindParam(':fkInstituicao', $fkInstituicao);

        return $stmt->execute();
    }

    public function queryAllSelect($id) {
        $sql = "SELECT id_campus, nome FROM "
                . "$this->table WHERE fk_instituicao = :id_instituicao";
        $stmt = ConnectionFactory::prepare($sql);
        $stmt->bindParam(':id_instituicao', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
