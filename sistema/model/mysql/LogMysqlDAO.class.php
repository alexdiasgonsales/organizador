<?php

class LogMysqlDAO  {

    protected $table = 'log';

    /**

     */
    public function load($id) {
        $sql = "SELECT * FROM $this->table WHERE id_log = :id_log";
        $stmt = ConnectionFactory::prepare($sql);
        $stmt->bindParam(':id_log', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    /**
     * Obtem todos o registros das Tabelas
     */
    public function queryAll() {
        $sql = "SELECT * FROM $this->table ORDER BY id_log";
        $stmt = ConnectionFactory::prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /**
     * Exclui um registro da tabela
     * @parametro tematica chave primária
     */
    public function delete($id) {
        $sql = "DELETE FROM $this->table WHERE id_log = :id_log";
        $stmt = ConnectionFactory::prepare($sql);
        $stmt->bindParam(':id_log', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    /**
     * Inseri um registro na tabela
     *
     * @parametro TematicaMySql tematica
     */
    public function insert(Log $log) {
        $sql = "INSERT INTO $this->table (fk_usuario, tabela, acao, descricao) VALUES ( :fk_usuario, :tabela, :acao, :descricao)";

        $fk_usuario = $log->getFkUsuario();
        $tabela     = $log->getTabela();
        $acao       = $log->getAcao();
        $descricao  = $log->getDescricao();

        $stmt = ConnectionFactory::prepare($sql);

        $stmt->bindParam(':fk_usuario', $fk_usuario);
        $stmt->bindParam(':tabela', $tabela);
        $stmt->bindParam(':acao', $acao);
        $stmt->bindParam(':descricao', $descricao);
        return $stmt->execute();
    }

    /**
     * atualiza um registro da tabela
     *
     * @parametro TematicaMySql tematica
     */
    public function update(Log $log) {
        $sql = "UPDATE $this->table SET tabela = :tabela, acao = :acao, descricao=:descricao WHERE id_log = :id";
        $id = $log->getIdLog();
        $stmt = ConnectionFactory::prepare($sql);
        $stmt->bindParam(':id_log', $id);
        return $stmt->execute();
    }

}
