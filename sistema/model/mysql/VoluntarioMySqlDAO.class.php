<?php

/**
 * Classe de operação da tabela 'voluntario'. Banco de Dados Mysql.
 * Estas classes não contemplam meu projeto final, por estarem obsoletas, estou contruindo
 * novos templates em Persistent Data Object com definição de prepared statements contra
 * sql injection, utilize para meio de testes, nunca coloque em produção, servindo
 * apenas de trampolin para classe de produção
 *
 * @autor: Alessander Wasem
 * @data: 2014-05-21 21:57
 */
class VoluntarioMySqlDAO implements VoluntarioDAO {

    protected $table = 'voluntario';

    /**
     * Implementa o dominio chave primária na seleção de único registro
     *
     * @parametro String $id primary key
     * @retorna VoluntarioMySql 
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
     * @parametro voluntario chave primária
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
     * @parametro VoluntarioMySql voluntario
     */
    public function insert(Voluntario $Voluntario) {
        $sql = "INSERT INTO $this->table (fk_usuario, status, fk_curso, observacoes, manha, tarde, noite, telefone1, telefone2, telefone3, presenca) VALUES (:fkUsuario, :status,  :fkCurso,  :observacoes,  :manha,  :tarde,  :noite,  :telefone1,  :telefone2,  :telefone3,  :presenca)";

        $fkUsuario = $Voluntario->getFkUsuario();
        $status = $Voluntario->getStatus();
        $fkCurso = $Voluntario->getFkCurso();
        $observacoes = $Voluntario->getObservacoes();
        $manha = $Voluntario->getManha();
        $tarde = $Voluntario->getTarde();
        $noite = $Voluntario->getNoite();
        $telefone1 = $Voluntario->getTelefone1();
        $telefone2 = $Voluntario->getTelefone2();
        $telefone3 = $Voluntario->getTelefone3();
        $presenca = $Voluntario->getPresenca();

        $stmt = ConnectionFactory::prepare($sql);

        $stmt->bindParam(':fkUsuario', $fkUsuario);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':fkCurso', $fkCurso);
        $stmt->bindParam(':observacoes', $observacoes);
        $stmt->bindParam(':manha', $manha);
        $stmt->bindParam(':tarde', $tarde);
        $stmt->bindParam(':noite', $noite);
        $stmt->bindParam(':telefone1', $telefone1);
        $stmt->bindParam(':telefone2', $telefone2);
        $stmt->bindParam(':telefone3', $telefone3);
        $stmt->bindParam(':presenca', $presenca);
        return $stmt->execute();
    }

    /**
     * atualiza um registro da tabela
     *
     * @parametro VoluntarioMySql voluntario
     */
    public function update(Voluntario $Voluntario) {
        $sql = "UPDATE $this->table SET status = :status, fk_curso = :fk_curso, observacoes = :observacoes, manha = :manha, tarde = :tarde, noite = :noite, telefone1 = :telefone1, telefone2 = :telefone2, telefone3 = :telefone3, presenca = :presenca WHERE fk_usuario = :id";
        $id = $Voluntario->getFkUsuario();


        $status = $Voluntario->getStatus();
        $fkCurso = $Voluntario->getFkCurso();
        $observacoes = $Voluntario->getObservacoes();
        $manha = $Voluntario->getManha();
        $tarde = $Voluntario->getTarde();
        $noite = $Voluntario->getNoite();
        $telefone1 = $Voluntario->getTelefone1();
        $telefone2 = $Voluntario->getTelefone2();
        $telefone3 = $Voluntario->getTelefone3();
        $presenca = $Voluntario->getPresenca();

        $stmt = ConnectionFactory::prepare($sql);
        $stmt->bindParam(':id', $id);

        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':fkCurso', $fkCurso);
        $stmt->bindParam(':observacoes', $observacoes);
        $stmt->bindParam(':manha', $manha);
        $stmt->bindParam(':tarde', $tarde);
        $stmt->bindParam(':noite', $noite);
        $stmt->bindParam(':telefone1', $telefone1);
        $stmt->bindParam(':telefone2', $telefone2);
        $stmt->bindParam(':telefone3', $telefone3);
        $stmt->bindParam(':presenca', $presenca);

        return $stmt->execute();
    }

    public function updateTurno(Voluntario $Voluntario) {
        $sql = "UPDATE $this->table SET  manha = :manha, tarde = :tarde, noite = :noite WHERE fk_usuario = :id";
        $id = $Voluntario->getFkUsuario();
        $manha = $Voluntario->getManha();
        $tarde = $Voluntario->getTarde();
        $noite = $Voluntario->getNoite();
        $stmt = ConnectionFactory::prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':manha', $manha);
        $stmt->bindParam(':tarde', $tarde);
        $stmt->bindParam(':noite', $noite);
        return $stmt->execute();
    }

    public function loadVoluntarioArea($id) {
        $sql = "SELECT voluntario.manha AS manha,
                           voluntario.tarde as tarde, 
                           voluntario.noite as noite, 
                           voluntario.telefone1 as fone1, 
                           voluntario.telefone2 as fone2, 
                           voluntario.telefone3 as fone3, 
                           campus.nome as campus, 
                           curso.nome as curso,
                           CASE curso.nivel
                            WHEN 2 
                            THEN  '(Técnico) - '
                            WHEN 3 
                            THEN  '(Superior) - '
                            ELSE  null
                            END AS nivel, 
                           instituicao.nome as instituicao,
                           instituicao.sigla as sigla
                           FROM (instituicao 
                           INNER JOIN (
                           campus INNER JOIN curso ON campus.id_campus = curso.fk_campus)
                           ON instituicao.id_instituicao = campus.fk_instituicao) 
                           INNER JOIN voluntario ON curso.id_curso = voluntario.fk_curso 
                           WHERE fk_usuario = :fk_usuario";
        $stmt = ConnectionFactory::prepare($sql);
        $stmt->bindParam(':fk_usuario', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function queryAllVoluntario() {
        $sql = "SELECT
            usuario.id_usuario as usuario_id, 
            usuario.nome as usuario_nome,
            usuario.email as usuario_email,
            curso.nome AS voluntario_curso_nome, 
            campus.nome AS voluntario_campus_nome, 
            instituicao.sigla as voluntario_instituicao_sigla,
            voluntario.Telefone1 as voluntario_fone1,
            voluntario.Telefone2 as voluntario_fone2,
            voluntario.Telefone3 as voluntario_fone3, 
            voluntario.Manha as voluntario_manha,
            voluntario.Tarde as voluntario_tarde, 
            voluntario.Noite as voluntario_noite,
            voluntario.status as voluntario_status
    FROM voluntario INNER JOIN usuario ON (usuario.id_usuario = voluntario.fk_usuario) 
    INNER JOIN curso ON curso.id_curso = voluntario.fk_curso 
    INNER JOIN campus ON campus.id_campus = curso.fk_campus
    INNER JOIN instituicao ON instituicao.id_instituicao = campus.fk_instituicao
    ORDER BY usuario.id_usuario";
        $stmt = ConnectionFactory::prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

}
