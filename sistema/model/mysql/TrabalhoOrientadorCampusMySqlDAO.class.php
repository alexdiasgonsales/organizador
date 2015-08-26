<?php
/**
 * Classe de operação da tabela 'trabalho_orientador_campus'. Banco de Dados Mysql.
 * Estas classes não contemplam meu projeto final, por estarem obsoletas, estou contruindo
 * novos templates em Persistent Data Object com definição de prepared statements contra
 * sql injection, utilize para meio de testes, nunca coloque em produção, servindo
 * apenas de trampolin para classe de produção
 *
 * @autor: Alessander Wasem
 * @data: 2014-05-21 21:57
 */
class TrabalhoOrientadorCampusMySqlDAO implements TrabalhoOrientadorCampusDAO {
  protected $table = 'trabalho_orientador_campus';
  /**
   * Implementa o dominio chave primária na seleção de único registro
   *
   * @parametro String $id primary key
   * @retorna TrabalhoOrientadorCampusMySql 
   */
  public function load($id_trabalho, $id_orientador) {
    $sql = "SELECT * FROM $this->table WHERE fk_trabalho = :fk_trabalho AND fk_orientador = :fk_orientador";
    $stmt = ConnectionFactory::prepare($sql);
    $stmt->bindParam(':fk_trabalho', $id_trabalho, PDO::PARAM_INT);
    $stmt->bindParam(':fk_orientador', $id_orientador, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch();
  }
  
    public function loadOrientador($id) {
    $sql = "SELECT * FROM $this->table WHERE fk_trabalho = :id";
    $stmt = ConnectionFactory::prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
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
   * @parametro trabalhoOrientadorCampu chave primária
   */
  public function delete($id_trabalho, $id_orientador) {
    //Pega a seq deste trabalho_autor_curso
    $trab_ori_cam = $this->load($id_trabalho, $id_orientador);
    $seq = $trab_ori_cam->seq;

    //Diminui de 1 todos os trabalho_orientador_campus que tem seq maior.
    $sql = "UPDATE $this->table SET seq = seq - 1 WHERE "
            . "fk_trabalho = :fk_trabalho AND seq > :seq";
    $stmt = ConnectionFactory::prepare($sql);
    $stmt->bindParam(':fk_trabalho', $id_trabalho, PDO::PARAM_INT);
    $stmt->bindParam(':seq', $seq, PDO::PARAM_INT);
    $stmt->execute();

    $sql = "DELETE FROM $this->table WHERE fk_trabalho = :fk_trabalho AND fk_orientador = :fk_orientador";
    $stmt = ConnectionFactory::prepare($sql);
    $stmt->bindParam(':fk_trabalho', $id_trabalho, PDO::PARAM_INT);
    $stmt->bindParam(':fk_orientador', $id_orientador, PDO::PARAM_INT);
    return $stmt->execute();
  }
  /**
   * Inseri um registro na tabela
   *
   * @parametro TrabalhoOrientadorCampusMySql trabalhoOrientadorCampu
   */
  public function insert(TrabalhoOrientadorCampus $trabalhoOrientadorCampus) {
    $sql = "INSERT INTO $this->table (fk_trabalho, fk_orientador, fk_campus, seq, email_trabalho) VALUES ( :fk_trabalho, :fk_orientador, :fk_campus,  :seq, :email_trabalho )";

    //$sql = "INSERT INTO $this->table (fk_trabalho, fk_orientador, fk_campus, seq, email_trabalho) VALUES (203, 603, 2,  1,  'asdf')";

    $fkTrabalho = $trabalhoOrientadorCampus->getFkTrabalho();
    $fkOrientador = $trabalhoOrientadorCampus->getFkOrientador();
    $fkCampus = $trabalhoOrientadorCampus->getFkCampus();
    $seq = $trabalhoOrientadorCampus->getSeq();
    $emailTrabalho = $trabalhoOrientadorCampus->getEmailTrabalho();


    $stmt = ConnectionFactory::prepare($sql);

    $stmt->bindParam(':fk_trabalho', $fkTrabalho);
    $stmt->bindParam(':fk_orientador', $fkOrientador);
    $stmt->bindParam(':fk_campus', $fkCampus);
    $stmt->bindParam(':seq', $seq);
    $stmt->bindParam(':email_trabalho', $emailTrabalho);

    //return $stmt;
    //exit;

    return $stmt->execute();
  }
  /**
   * atualiza um registro da tabela
   *
   * @parametro TrabalhoOrientadorCampusMySql trabalhoOrientadorCampu
   */
  public function update(TrabalhoOrientadorCampus $TrabalhoOrientadorCampus) {
    $sql = "UPDATE $this->table SET fk_campus = :fk_campus, seq = :seq, email_trabalho = :email_trabalho WHERE fk_orientador = :id";
    $id = $TrabalhoOrientadorCampus->getFkOrientador();


    $fkCampus = $TrabalhoOrientadorCampus->getFkCampus();
    $seq = $TrabalhoOrientadorCampus->getSeq();
    $emailTrabalho = $TrabalhoOrientadorCampus->getEmailTrabalho();

    $stmt = ConnectionFactory::prepare($sql);
    $stmt->bindParam(':id', $id);


    $stmt->bindParam(':fkCampus', $fkCampus);
    $stmt->bindParam(':seq', $seq);
    $stmt->bindParam(':emailTrabalho', $emailTrabalho);

    return $stmt->execute();
  }
}