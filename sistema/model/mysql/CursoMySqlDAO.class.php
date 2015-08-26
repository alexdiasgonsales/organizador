<?php

/**
 * Classe de operação da tabela 'curso'. Banco de Dados Mysql.
 * Estas classes não contemplam meu projeto final, por estarem obsoletas, estou contruindo
 * novos templates em Persistent Data Object com definição de prepared statements contra
 * sql injection, utilize para meio de testes, nunca coloque em produção, servindo
 * apenas de trampolin para classe de produção
 *
 * @autor: Alessander Wasem
 * @data: 2014-05-21 21:57
 */
class CursoMySqlDAO implements CursoDAO {

    protected $table = 'curso';

    /**
     * Implementa o dominio chave primária na seleção de único registro
     *
     * @parametro String $id primary key
     * @retorna CursoMySql 
     */
    public function load($id) {
        $sql = "SELECT * FROM $this->table WHERE id_curso = :id_curso";
        $stmt = ConnectionFactory::prepare($sql);
        $stmt->bindParam(':id_curso', $id, PDO::PARAM_INT);
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
     * @parametro curso chave primária
     */
    public function delete($id) {
        $sql = "DELETE FROM $this->table WHERE id_curso = :id_curso";
        $stmt = ConnectionFactory::prepare($sql);
        $stmt->bindParam(':id_curso', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    /**
     * Inseri um registro na tabela
     *
     * @parametro CursoMySql curso
     */
    public function insert(Curso $Curso) {
        $sql = "INSERT INTO $this->table (nome, nivel, fk_campus) VALUES ( :nome,  :nivel,  :fkCampus)";

        $nome = $Curso->getNome();
        $nivel = $Curso->getNivel();
        $fkCampus = $Curso->getFkCampus();

        $stmt = ConnectionFactory::prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':nivel', $nivel);
        $stmt->bindParam(':fkCampus', $fkCampus);
        $stmt->execute();
        
        $sql = "SELECT LAST_INSERT_ID() as last_id";
        $stmt = ConnectionFactory::prepare($sql);
        $stmt->execute();
        $last_id = (array) $stmt->fetch();
        foreach ($last_id as $value) {
          return $value;
        }
    }//insert

    /**
     * atualiza um registro da tabela
     *
     * @parametro CursoMySql curso
     */
    public function update(Curso $Curso) {
        $sql = "UPDATE $this->table SET nome = :nome, nivel = :nivel, fk_campus = :fk_campus WHERE id_curso = :id";
        $id = $Curso->getIdCurso();


        $nome = $Curso->getNome();
        $nivel = $Curso->getNivel();
        $fkCampus = $Curso->getFkCampus();

        $stmt = ConnectionFactory::prepare($sql);
        $stmt->bindParam(':id', $id);


        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':nivel', $nivel);
        $stmt->bindParam(':fkCampus', $fkCampus);

        return $stmt->execute();
    }

    public function queryAllSelect($id_campus) {
        $sql = "SELECT id_curso, nome, nivel,
            CASE nivel WHEN 2 THEN '(Técnico) - 
              ' WHEN 3 THEN '(Superior) - '
                ELSE '' END as nivelDesc
            FROM ".$this->table. "
            WHERE fk_campus = :id_campus
            ORDER BY nivel DESC, nome DESC";
        $stmt = ConnectionFactory::prepare($sql);
        $stmt->bindParam(':id_campus', $id_campus, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

}
