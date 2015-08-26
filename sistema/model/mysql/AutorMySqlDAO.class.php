<?php

/**
 * Classe de operação da tabela 'autor'. Banco de Dados Mysql.
 * Estas classes não contemplam meu projeto final, por estarem obsoletas, estou contruindo
 * novos templates em Persistent Data Object com definição de prepared statements contra
 * sql injection, utilize para meio de testes, nunca coloque em produção, servindo
 * apenas de trampolin para classe de produção
 *
 * @autor: Alessander Wasem
 * @data: 2014-05-21 21:57
 */
class AutorMySqlDAO implements AutorDAO {

    protected $table = 'autor';

    /**
     * Implementa o dominio chave primária na seleção de único registro
     *
     * @parametro String $id primary key
     * @retorna AutorMySql 
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
    
    public function queryAllAutor() {
        $sql = <<<SQL
            select usuario.id_usuario as usuario_id, 
            usuario.nome as usuario_nome,
            usuario.email as usuario_email,
            curso.nome AS autor_curso_nome, 
            campus.nome AS autor_campus_nome, 
            instituicao.sigla as autor_instituicao_sigla,
            autor_curso.status as autor_status
            from usuario
 
            inner join autor on usuario.id_usuario = autor.fk_usuario
            inner join autor_curso on autor.fk_usuario = autor_curso.fk_autor
            inner join curso on autor_curso.fk_curso = curso.id_curso
            inner join campus on curso.fk_campus = campus.id_campus
            inner join instituicao on campus.fk_instituicao = instituicao.id_instituicao
 
            order by usuario.id_usuario;
SQL;
        $stmt = ConnectionFactory::prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /**
     * Exclui um registro da tabela
     * @parametro autor chave primária
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
     * @parametro AutorMySql autor
     */
    public function insert(Autor $Autor) {
        $sql = "INSERT INTO `$this->table`(`fk_usuario`) VALUES (:fk_usuario)";
        $id = $Autor->getFkUsuario();
        $stmt = ConnectionFactory::prepare($sql);
        $stmt->bindParam(':fk_usuario', $id);
        return $stmt->execute();
    }

    /**
     * atualiza um registro da tabela
     *
     * @parametro AutorMySql autor
     */
    public function update(Autor $Autor) {
        $sql = "UPDATE $this->table SET  WHERE fk_usuario = :id";
        $id = $Autor->getFkUsuario();
        $stmt = ConnectionFactory::prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function findAutorCurso($id) {
        $sql = "SELECT ac.fk_autor, ac.fk_curso, c.nome as nomeCurso, c.nivel, c.fk_campus, ca.nome as nomeCampus, ca.fk_instituicao, i.sigla,
				CASE c.nivel
					WHEN 2 THEN '(Técnico) - '
					WHEN 3 THEN '(Superior) - '
					ELSE '' 
					END as nivelCurso
			FROM autor_curso ac
			INNER JOIN curso c on (c.id_curso = ac.fk_curso)
			INNER JOIN campus ca on (ca.id_campus = c.fk_campus)
			INNER JOIN instituicao i on (i.id_instituicao = ca.fk_instituicao)
			WHERE ac.fk_autor= :id"; 
        $stmt = ConnectionFactory::prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    
  //------------------------ Metodos Alex ----------------------------
    
  public function queryCursosDoAutor($id_autor) {
    $sql = "SELECT * FROM autor a INNER JOIN autor_curso ac ON a.fk_usuario = ac.fk_autor " .
            "INNER JOIN curso c ON c.id_curso = ac.fk_curso " .
            "WHERE a.fk_usuario=" . $id_autor;
    $stmt = ConnectionFactory::prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
  }

  public function queryQuantidadeTrabalhosAutorPrincipal($id_autor) {
    $sql = "SELECT count(fk_trabalho) as quant FROM trabalho_autor_curso WHERE fk_autor = :fk_autor AND seq = 1";
    $stmt = ConnectionFactory::prepare($sql);
    $stmt->bindParam(':fk_autor', $id_autor);
    $stmt->execute();
    $result = $stmt->fetch();
    return $result->quant;
  }

  public function queryTrabalhosAutorPrincipal($id_autor) {
    $sql = "SELECT * from trabalho t "
            . "INNER JOIN trabalho_autor_curso tac ON t.id_trabalho = tac.fk_trabalho "
            . "INNER JOIN curso c ON c.id_curso = tac.fk_curso "
            . "INNER JOIN area a ON a.id_area = t.fk_area "
            . "INNER JOIN categoria cat ON cat.id_categoria = t.fk_categoria "
            . "INNER JOIN modalidade m ON m.id_modalidade = t.fk_modalidade "
            . "WHERE fk_autor = :fk_autor AND tac.seq = 1 ";
    $stmt = ConnectionFactory::prepare($sql);
    $stmt->bindParam(':fk_autor', $id_autor);
    $stmt->execute();
    return $stmt->fetchAll();
  }

  public function queryTrabalhosCoAutor($id_autor) {
    $sql = "SELECT * from trabalho t "
            . "INNER JOIN trabalho_autor_curso tac ON t.id_trabalho = tac.fk_trabalho "
            . "INNER JOIN curso c ON c.id_curso = tac.fk_curso "
            . "INNER JOIN area a ON a.id_area = t.fk_area "
            . "INNER JOIN categoria cat ON cat.id_categoria = t.fk_categoria "
            . "INNER JOIN modalidade m ON m.id_modalidade = t.fk_modalidade "
            . "WHERE fk_autor = :fk_autor AND tac.seq <> 1 ";
    $stmt = ConnectionFactory::prepare($sql);
    $stmt->bindParam(':fk_autor', $id_autor);
    $stmt->execute();
    return $stmt->fetchAll();
  }

  public function queryAutoresCursosByName($nome_autor) {
    $sql = "SELECT u.id_usuario, u.nome as nome_usuario, ac.fk_curso, 
            c.nome as nome_curso, ca.nome as nome_campus, 
            ca.fk_instituicao, i.sigla 
            FROM usuario u 
            INNER JOIN autor_curso ac ON (ac.fk_autor = u.id_usuario) 
            INNER JOIN curso c ON (c.id_curso = ac.fk_curso) 
            INNER JOIN campus ca ON (ca.id_campus = c.fk_campus)
            INNER JOIN instituicao i ON (i.id_instituicao = ca.fk_instituicao)
            WHERE u.nome LIKE '%".$nome_autor."%'";
    $stmt = ConnectionFactory::prepare($sql);
    //$stmt->bindParam(':nome_autor', $nome_autor.'%');
    $stmt->execute();
    return $stmt->fetchAll();
  }

  
 
    
}//AutorMySqlDAO
