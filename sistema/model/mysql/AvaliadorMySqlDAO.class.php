<?php

/**
 * Classe de operação da tabela 'avaliador'. Banco de Dados Mysql.
 * Estas classes não contemplam meu projeto final, por estarem obsoletas, estou contruindo
 * novos templates em Persistent Data Object com definição de prepared statements contra
 * sql injection, utilize para meio de testes, nunca coloque em produção, servindo
 * apenas de trampolin para classe de produção
 *
 * @autor: Alessander Wasem
 * @data: 2014-05-21 21:57
 */
class AvaliadorMySqlDAO implements AvaliadorDAO {

    protected $table = 'avaliador';

    /**
     * Implementa o dominio chave primária na seleção de único registro
     *
     * @parametro String $id primary key
     * @retorna AvaliadorMySql 
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
     * @parametro avaliador chave primária
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
     * @parametro AvaliadorMySql avaliador
     */
    public function insert(Avaliador $Avaliador) {
        $sql = "INSERT INTO $this->table (fk_usuario, fk_campus, tipo_servidor, formacao, status) VALUES (:fk_usuario, :fkCampus,  :tipoServidor,  :formacao,  :status)";
        $fkCampus = $Avaliador->getFkCampus();
        $tipoServidor = $Avaliador->getTipoServidor();
        $formacao = $Avaliador->getFormacao();
        $status = $Avaliador->getStatus();
        $fk_usuario = $Avaliador->getFkUsuario();
        $stmt = ConnectionFactory::prepare($sql);
        $stmt->bindParam(':fk_usuario', $fk_usuario);
        $stmt->bindParam(':fkCampus', $fkCampus);
        $stmt->bindParam(':tipoServidor', $tipoServidor);
        $stmt->bindParam(':formacao', $formacao);
        $stmt->bindParam(':status', $status);
        return $stmt->execute();
    }

    /**
     * atualiza um registro da tabela
     *
     * @parametro AvaliadorMySql avaliador
     */
    public function update(Avaliador $Avaliador) {
        $sql = "UPDATE $this->table SET fk_campus = :fk_campus, tipo_servidor = :tipo_servidor, formacao = :formacao, status = :status WHERE fk_usuario = :id";
        $id = $Avaliador->getFkUsuario();


        $fkCampus = $Avaliador->getFkCampus();
        $tipoServidor = $Avaliador->getTipoServidor();
        $formacao = $Avaliador->getFormacao();
        $status = $Avaliador->getStatus();

        $stmt = ConnectionFactory::prepare($sql);
        $stmt->bindParam(':id', $id);


        $stmt->bindParam(':fkCampus', $fkCampus);
        $stmt->bindParam(':tipoServidor', $tipoServidor);
        $stmt->bindParam(':formacao', $formacao);
        $stmt->bindParam(':status', $status);

        return $stmt->execute();
    }

    public function loadDataAvaliador($id) {
        $sql = "SELECT a.tipo_servidor as tipo, 
                       a.formacao as form,
                       a.fk_campus,
                       ca.nome as campus, 
                       ca.fk_instituicao, 
                       i.nome as instituicao, 
                       i.sigla as sigla,
			CASE tipo_servidor
				WHEN 1 THEN ' Docente'
				WHEN 2 THEN ' Técnico Administrativo'
				WHEN 3 THEN ' Estudande de Pós-graduação'
				ELSE '' END as tipo,
			CASE formacao
				WHEN 3 THEN ' Superior' 
				WHEN 4 THEN ' Especialização'
				WHEN 5 THEN ' Mestrado'
				WHEN 6 THEN ' Doutorado'
				ELSE '' END as form
			FROM avaliador a
			INNER JOIN campus ca on (ca.id_campus = a.fk_campus)
			INNER JOIN instituicao i on (i.id_instituicao = ca.fk_instituicao)
			WHERE a.fk_usuario= :fk_usuario";
        $stmt = ConnectionFactory::prepare($sql);
        $stmt->bindParam(':fk_usuario', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function updateStatus(Avaliador $avaliador) {
        $sql = "UPDATE $this->table SET status = :status WHERE fk_usuario = :id";
        $id = $avaliador->getFkUsuario();
        $status = $avaliador->getStatus();
        $stmt = ConnectionFactory::prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':status', $status);
        return $stmt->execute();
    }
    
    public function countAvaliadoresByArea() {
        $sql =<<<SQL
                select count(fk_usuario) as avaliadores,
                area.id_area,
                area.nome as area

                from avaliador
                left join avaliador_area on avaliador.fk_usuario = avaliador_area.fk_avaliador
                left join area on avaliador_area.fk_area = area.id_area

                group by area.nome;
SQL;
        $stmt = ConnectionFactory::prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
        
    }
    
    public function countAvaliadoresByStatus() {
        
        $sql =<<<SQL
                select count(fk_usuario) as avaliadores,

                case avaliador.status

                when 0 then 'Pendente'
                when 1 then 'Aceito'
                when 2 then 'Recusado'

                end as status

                from avaliador
                group by avaliador.status;
SQL;
        
        $stmt = ConnectionFactory::prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function queryAllAvaliadores() {
        $sql = "SELECT
                usuario.id_usuario as usuario_id,
                usuario.nome as usuario_nome,
                usuario.email as usuario_email, 
                campus.nome as avaliador_campus_nome, 
                avaliador.status as avaliador_status,
                instituicao.sigla as avaliador_instituicao_sigla,
                area.id_area as area_id,
                area.nome as area_nome,
                avaliador.tipo_servidor as avaliador_tipo_servidor,
	CASE avaliador.tipo_servidor
		WHEN 1 THEN 'D' 
		WHEN 2 THEN 'T'
		WHEN 3 THEN 'E'
		ELSE '-'
		END as avaliador_tipo_servidor_char,
                avaliador.formacao as avaliador_formacao
	FROM usuario
                INNER JOIN avaliador ON usuario.id_usuario = avaliador.fk_usuario
                INNER JOIN campus  ON campus.id_campus = avaliador.fk_campus
                INNER JOIN instituicao ON instituicao.id_instituicao=campus.fk_instituicao 
                INNER JOIN avaliador_area ON avaliador_area.fk_avaliador = avaliador.fk_usuario
                INNER JOIN area ON area.id_area = avaliador_area.fk_area";
        $stmt = ConnectionFactory::prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

}
