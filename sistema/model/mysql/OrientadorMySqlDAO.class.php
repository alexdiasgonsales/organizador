<?php

/**
 * Classe de operação da tabela 'orientador'. Banco de Dados Mysql.
 * Estas classes não contemplam meu projeto final, por estarem obsoletas, estou contruindo
 * novos templates em Persistent Data Object com definição de prepared statements contra
 * sql injection, utilize para meio de testes, nunca coloque em produção, servindo
 * apenas de trampolin para classe de produção
 *
 * @autor: Alessander Wasem
 * @data: 2014-05-21 21:57
 */
class OrientadorMySqlDAO implements OrientadorDAO {

    protected $table = 'orientador';

    /**
     * Implementa o dominio chave primária na seleção de único registro
     *
     * @parametro String $id primary key
     * @retorna OrientadorMySql 
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
     * @parametro orientador chave primária
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
     * @parametro OrientadorMySql orientador
     */
    public function insert(Orientador $Orientador) {
        $sql = "INSERT INTO $this->table (fk_usuario, tipo_servidor, status) VALUES (:fk_usuario, :tipoServidor,  :status)";
        $tipoServidor = $Orientador->getTipoServidor();
        $status = $Orientador->getStatus();
        $fkUsuario = $Orientador->getFkUsuario();
        $stmt = ConnectionFactory::prepare($sql);
        $stmt->bindParam(':fk_usuario', $fkUsuario);
        $stmt->bindParam(':tipoServidor', $tipoServidor);
        $stmt->bindParam(':status', $status);
        return $stmt->execute();
    }

    /**
     * atualiza um registro da tabela
     *
     * @parametro OrientadorMySql orientador
     */
    public function update(Orientador $Orientador) {
        $sql = "UPDATE $this->table SET tipo_servidor = :tipo_servidor, status = :status WHERE fk_usuario = :id";
        $id = $Orientador->getFkUsuario();


        $tipoServidor = $Orientador->getTipoServidor();
        $status = $Orientador->getStatus();

        $stmt = ConnectionFactory::prepare($sql);
        $stmt->bindParam(':id', $id);


        $stmt->bindParam(':tipoServidor', $tipoServidor);
        $stmt->bindParam(':status', $status);

        return $stmt->execute();
    }

    public function findOrientadorCampus($id) {
        $sql = "SELECT oc.fk_campus, ca.nome as nomeCampus, ca.fk_instituicao, i.nome as nomeInst, i.sigla
			FROM orientador_campus oc
			INNER JOIN campus ca on (ca.id_campus = oc.fk_campus)
			INNER JOIN instituicao i on (i.id_instituicao = ca.fk_instituicao)
			WHERE oc.fk_orientador = :id";
        $stmt = ConnectionFactory::prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function findTipoServidor($id) {
        $sql = "SELECT tipo_servidor,
				CASE tipo_servidor
					WHEN 1 THEN ' Docente'
					WHEN 2 THEN ' Técnico Administrativo'
					ELSE '' 
					END as tipo
				FROM orientador
				WHERE fk_usuario= :id";
        $stmt = ConnectionFactory::prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function queryOrientadoresCampusByName($nome_orientador) {
        $sql = "SELECT u.id_usuario, u.nome as nome_usuario, oc.fk_campus, 
            ca.nome as nome_campus, 
            ca.fk_instituicao, i.sigla 
            FROM usuario u 
            INNER JOIN orientador_campus oc ON (oc.fk_orientador = u.id_usuario) 
            INNER JOIN campus ca ON (ca.id_campus = oc.fk_campus)
            INNER JOIN instituicao i ON (i.id_instituicao = ca.fk_instituicao)
            WHERE u.nome LIKE '%" . $nome_orientador . "%'";
        $stmt = ConnectionFactory::prepare($sql);
        //$stmt->bindParam(':nome_autor', $nome_autor.'%');
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function queryTrabalhosOrientadorPrincipal($id_orientador) {
        $sql = "SELECT * from trabalho t "
                . "INNER JOIN trabalho_orientador_campus toc ON t.id_trabalho = toc.fk_trabalho "
                . "INNER JOIN campus cam ON cam.id_campus = toc.fk_campus "
                . "INNER JOIN area a ON a.id_area = t.fk_area "
                . "INNER JOIN categoria cat ON cat.id_categoria = t.fk_categoria "
                . "INNER JOIN modalidade m ON m.id_modalidade = t.fk_modalidade "
                . "WHERE toc.fk_orientador = :fk_orientador AND toc.seq = 1 ";
        $stmt = ConnectionFactory::prepare($sql);
        $stmt->bindParam(':fk_orientador', $id_orientador);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function queryTrabalhosCoorientador($id_orientador) {
        $sql = "SELECT * from trabalho t "
                . "INNER JOIN trabalho_orientador_campus toc ON t.id_trabalho = toc.fk_trabalho "
                . "INNER JOIN campus cam ON cam.id_campus = toc.fk_campus "
                . "INNER JOIN area a ON a.id_area = t.fk_area "
                . "INNER JOIN categoria cat ON cat.id_categoria = t.fk_categoria "
                . "INNER JOIN modalidade m ON m.id_modalidade = t.fk_modalidade "
                . "WHERE toc.fk_orientador = :fk_orientador AND toc.seq <> 1 ";
        $stmt = ConnectionFactory::prepare($sql);
        $stmt->bindParam(':fk_orientador', $id_orientador);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function updateStatus(Orientador $orientador) {
        $sql = "UPDATE $this->table SET status = :status WHERE fk_usuario = :id";
        $id = $orientador->getFkUsuario();
        $status = $orientador->getStatus();
        $stmt = ConnectionFactory::prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':status', $status);
        return $stmt->execute();
    }

    public function queryAllHomologacaoOrientador() {
        $sql = "SELECT 
                usuario.id_usuario as usuario_id,
                usuario.nome as usuario_nome,
                usuario.email as usuario_email,
                campus.nome as campus_nome,
                orientador.status as orientador_status,
                instituicao.sigla as sigla_instituicao,
                orientador.tipo_servidor as orientador_tipo_servidor,
                CASE orientador.tipo_servidor
                  WHEN 1 THEN 'D'
                  WHEN 2 THEN 'T'
                  WHEN 3 THEN 'X'
                  WHEN 4 THEN 'O'
                  ELSE '-'
                END as orientador_tipo_servidor_char
                FROM usuario
                INNER JOIN orientador ON usuario.id_usuario = orientador.fk_usuario
                INNER JOIN orientador_campus  ON orientador_campus.fk_orientador = orientador.fk_usuario 
                INNER JOIN campus ON campus.id_campus = orientador_campus.fk_campus
                INNER JOIN instituicao ON instituicao.id_instituicao=campus.fk_instituicao 
                WHERE orientador_campus.seq = 1 ";
        $stmt = ConnectionFactory::prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

}
