<?php

/**
 * Classe de operação da tabela 'parecer_trabalho'. Banco de Dados Mysql.
 * Estas classes não contemplam meu projeto final, por estarem obsoletas, estou contruindo
 * novos templates em Persistent Data Object com definição de prepared statements contra
 * sql injection, utilize para meio de testes, nunca coloque em produção, servindo
 * apenas de trampolin para classe de produção
 *
 * @autor: Alessander Wasem
 * @data: 2014-05-21 21:57
 */
class ParecerTrabalhoMySqlDAO implements ParecerTrabalhoDAO {

    protected $table = 'parecer_trabalho';

    /**
     * Implementa o dominio chave primária na seleção de único registro
     *
     * @parametro String $id primary key
     * @retorna ParecerTrabalhoMySql 
     */
    public function load($id) {
        $sql = "SELECT * FROM $this->table WHERE fk_trabalho = :id";
        $stmt = ConnectionFactory::prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function loadParecer($id, $seq) {
        $sql = "SELECT * FROM $this->table WHERE fk_trabalho = :id AND seq = :seq";
        $stmt = ConnectionFactory::prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':seq', $seq, PDO::PARAM_INT);
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
     * @parametro parecerTrabalho chave primária
     */
    public function delete($id) {
        $sql = "DELETE FROM $this->table WHERE seq = :seq";
        $stmt = ConnectionFactory::prepare($sql);
        $stmt->bindParam(':seq', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    /**
     * Inseri um registro na tabela
     *
     * @parametro ParecerTrabalhoMySql parecerTrabalho
     */
    public function insert(ParecerTrabalho $ParecerTrabalho) {
        $sql = "INSERT INTO $this->table"
                . " (fk_revisor, datahora, status, fk_trabalho, seq,"
                . " status_introducao, status_objetivos,"
                . " status_metodologia, status_resultados, observacoes, observacoes_internas,"
                . " obs_introducao, obs_objetivos, obs_metodologia, obs_resultados) "
                . "VALUES"
                . " (:fkRevisor,  :datahora,  :status, :fkTrabalho, :seq,"
                . " :statusIntroducao, :statusObjetivos,"
                . " :statusMetodologia, :statusResultados, :observacoes, :observacoesInternas,"
                . " :obsIntroducao, :obsObjetivos, :obsMetodologia, :obsResultados)";




        $fkRevisor = $ParecerTrabalho->getFkRevisor();
        $datahora = $ParecerTrabalho->getDatahora();
        $status = $ParecerTrabalho->getStatus();
        $fkTrabalho = $ParecerTrabalho->getFkTrabalho();
        $seq = $ParecerTrabalho->getSeq();
        $statusIntroducao = $ParecerTrabalho->getStatusIntroducao();
        $statusObjetivos = $ParecerTrabalho->getStatusObjetivos();
        $statusMetodologia = $ParecerTrabalho->getStatusMetodologia();
        $statusResultados = $ParecerTrabalho->getStatusResultados();
        $observacoes = $ParecerTrabalho->getObservacoes();
        $observacoesInternas = $ParecerTrabalho->getObservacoesInternas();
        $obsIntroducao = $ParecerTrabalho->getObsIntroducao();
        $obsObjetivos = $ParecerTrabalho->getObsObjetivos();
        $obsMetodologia = $ParecerTrabalho->getObsMetodologia();
        $obsResultados = $ParecerTrabalho->getObsResultados();

        $stmt = ConnectionFactory::prepare($sql);

        $stmt->bindParam(':fkRevisor', $fkRevisor);
        $stmt->bindParam(':datahora', $datahora);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':fkTrabalho', $fkTrabalho);
        $stmt->bindParam(':seq', $seq);
        $stmt->bindParam(':statusIntroducao', $statusIntroducao);
        $stmt->bindParam(':statusObjetivos', $statusObjetivos);
        $stmt->bindParam(':statusMetodologia', $statusMetodologia);
        $stmt->bindParam(':statusResultados', $statusResultados);
        $stmt->bindParam(':observacoes', $observacoes);
        $stmt->bindParam(':observacoesInternas', $observacoesInternas);
        $stmt->bindParam(':obsIntroducao', $obsIntroducao);
        $stmt->bindParam(':obsObjetivos', $obsObjetivos);
        $stmt->bindParam(':obsMetodologia', $obsMetodologia);
        $stmt->bindParam(':obsResultados', $obsResultados);
        return $stmt->execute();
    }

    /**
     * atualiza um registro da tabela
     *
     * @parametro ParecerTrabalhoMySql parecerTrabalho
     */
    public function update(ParecerTrabalho $ParecerTrabalho) {
        $sql = "UPDATE $this->table SET datahora = :datahora, status = :status,"
                . " status_introducao = :statusIntroducao, status_objetivos = :statusObjetivos, "
                . "status_metodologia = :statusMetodologia, status_resultados = :statusResultados, "
                . "observacoes = :observacoes, observacoes_internas = :observacoesInternas,"
                . "obs_introducao = :obsIntroducao, obs_objetivos = :obsObjetivos, "
                . "obs_metodologia = :obsMetodologia, obs_resultados = :obsResultados"
                . " WHERE seq = :seq AND fk_trabalho = :trabalho";
        $trabalho = $ParecerTrabalho->getFkTrabalho();
        $seq = $ParecerTrabalho->getSeq();
        $datahora = $ParecerTrabalho->getDatahora();
        $status = $ParecerTrabalho->getStatus();
        $statusIntroducao = $ParecerTrabalho->getStatusIntroducao();
        $statusObjetivos = $ParecerTrabalho->getStatusObjetivos();
        $statusMetodologia = $ParecerTrabalho->getStatusMetodologia();
        $statusResultados = $ParecerTrabalho->getStatusResultados();
        $observacoes = $ParecerTrabalho->getObservacoes();
        $observacoesInternas = $ParecerTrabalho->getObservacoesInternas();
        $obsIntroducao = $ParecerTrabalho->getObsIntroducao();
        $obsObjetivos = $ParecerTrabalho->getObsObjetivos();
        $obsMetodologia = $ParecerTrabalho->getObsMetodologia();
        $obsResultados = $ParecerTrabalho->getObsResultados();
        $stmt = ConnectionFactory::prepare($sql);
        $stmt->bindParam(':trabalho', $trabalho);
        $stmt->bindParam(':seq', $seq);
        $stmt->bindParam(':datahora', $datahora);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':statusIntroducao', $statusIntroducao);
        $stmt->bindParam(':statusObjetivos', $statusObjetivos);
        $stmt->bindParam(':statusMetodologia', $statusMetodologia);
        $stmt->bindParam(':statusResultados', $statusResultados);
        $stmt->bindParam(':observacoes', $observacoes);
        $stmt->bindParam(':observacoesInternas', $observacoesInternas);
        $stmt->bindParam(':obsIntroducao', $obsIntroducao);
        $stmt->bindParam(':obsObjetivos', $obsObjetivos);
        $stmt->bindParam(':obsMetodologia', $obsMetodologia);
        $stmt->bindParam(':obsResultados', $obsResultados);

        return $stmt->execute();
    }

}
