<?php

/**
 * Classe de operação da tabela 'revisor'. Banco de Dados Mysql.
 * Estas classes não contemplam meu projeto final, por estarem obsoletas, estou contruindo
 * novos templates em Persistent Data Object com definição de prepared statements contra
 * sql injection, utilize para meio de testes, nunca coloque em produção, servindo
 * apenas de trampolin para classe de produção
 *
 * @autor: Alessander Wasem
 * @data: 2014-05-21 21:57
 */
class RevisorMySqlDAO implements RevisorDAO {

    protected $table = 'revisor';

    /**
     * Implementa o dominio chave primária na seleção de único registro
     *
     * @parametro String $id primary key
     * @retorna RevisorMySql 
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
     * @parametro revisor chave primária
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
     * @parametro RevisorMySql revisor
     */
    public function insert(Revisor $Revisor) {
        $sql = "INSERT INTO $this->table (fk_campus,fk_usuario) VALUES ( :fkCampus, :fkUsuario)";


        $fkCampus = $Revisor->getFkCampus();
        $fkUsuario = $Revisor->getFkUsuario();
        $stmt = ConnectionFactory::prepare($sql);


        $stmt->bindParam(':fkCampus', $fkCampus);
        $stmt->bindParam(':fkUsuario', $fkUsuario);
        return $stmt->execute();
    }

    /**
     * atualiza um registro da tabela
     *
     * @parametro RevisorMySql revisor
     */
    public function update(Revisor $Revisor) {
        /*  $sql = "UPDATE $this->table SET fk_campus = :fk_campus WHERE fk_usuario = :id";
          $id = $Revisor->getFkUsuario();


          $fkCampus = $Revisor->getFkCampus();

          $stmt = ConnectionFactory::prepare($sql);
          $stmt->bindParam(':id', $id);


          $stmt->bindParam(':fkCampus', $fkCampus);

          return $stmt->execute(); */ //nao implementada
    }

    public function queryAllRevisor($orderBy = NULL) {
        $sql = "SELECT DISTINCT 
            trabalho.id_trabalho as trabalho_id,
            trabalho.titulo as trabalho_titulo, 
            trabalho.status as trabalho_status,
            usuario.nome as revisor_nome,
            area.nome as area_nome,
            curso.nome as nome_curso,
            campus.nome as nome_campus,
            instituicao.sigla,
            trabalho_autor_curso.fk_autor,
            trabalho_orientador_campus.fk_orientador,
            CASE trabalho.fk_categoria
                    WHEN 1 THEN 'E'
                    WHEN 2 THEN 'P'
                    WHEN 3 THEN 'R'
            END as categoria_trabalho,
            CASE trabalho.fk_modalidade
                    WHEN 1 THEN 'O'
                    WHEN 2 THEN 'P'
            END as modalidade_trabalho
            FROM trabalho
            LEFT JOIN area on area.id_area = trabalho.fk_area 
            LEFT JOIN trabalho_autor_curso  on (trabalho_autor_curso.fk_trabalho = trabalho.id_trabalho)
            LEFT JOIN trabalho_orientador_campus on (trabalho_orientador_campus.fk_trabalho = trabalho.id_trabalho)
            LEFT JOIN parecer_trabalho ON parecer_trabalho.fk_trabalho = trabalho.id_trabalho 
            LEFT JOIN revisor on (parecer_trabalho.fk_revisor = revisor.fk_usuario)
            LEFT JOIN usuario on (usuario.id_usuario = revisor.fk_usuario)
            LEFT JOIN curso ON curso.id_curso = trabalho_autor_curso.fk_curso 
            LEFT JOIN campus ON campus.id_campus = curso.fk_campus 
            LEFT JOIN instituicao ON instituicao.id_instituicao = campus.fk_instituicao" . $orderBy;
        $stmt = ConnectionFactory::prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

}
