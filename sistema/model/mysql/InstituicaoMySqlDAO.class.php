<?php

/**
 * Classe de operação da tabela 'instituicao'. Banco de Dados Mysql.
 * Estas classes não contemplam meu projeto final, por estarem obsoletas, estou contruindo
 * novos templates em Persistent Data Object com definição de prepared statements contra
 * sql injection, utilize para meio de testes, nunca coloque em produção, servindo
 * apenas de trampolin para classe de produção
 *
 * @autor: Alessander Wasem
 * @data: 2014-05-21 21:57
 */
class InstituicaoMySqlDAO implements InstituicaoDAO {

    protected $table = 'instituicao';

    /**
     * Implementa o dominio chave primária na seleção de único registro
     *
     * @parametro String $id primary key
     * @retorna InstituicaoMySql 
     */
    public function load($id) {
        $sql = "SELECT * FROM $this->table WHERE id_instituicao = :id_instituicao";
        $stmt = ConnectionFactory::prepare($sql);
        $stmt->bindParam(':id_instituicao', $id, PDO::PARAM_INT);
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
     * @parametro instituicao chave primária
     */
    public function delete($id) {
        $sql = "DELETE FROM $this->table WHERE id_instituicao = :id_instituicao";
        $stmt = ConnectionFactory::prepare($sql);
        $stmt->bindParam(':id_instituicao', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    /**
     * Inseri um registro na tabela
     *
     * @parametro InstituicaoMySql instituicao
     */
    public function insert(Instituicao $Instituicao) {
        $sql = "INSERT INTO $this->table (nome, sigla, cidade, estado, site, tipo) VALUES ( :nome,  :sigla,  :cidade,  :estado,  :site,  :tipo)";


        $nome = $Instituicao->getNome();
        $sigla = $Instituicao->getSigla();
        $cidade = $Instituicao->getCidade();
        $estado = $Instituicao->getEstado();
        $site = $Instituicao->getSite();
        $tipo = $Instituicao->getTipo();

        $stmt = ConnectionFactory::prepare($sql);


        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':sigla', $sigla);
        $stmt->bindParam(':cidade', $cidade);
        $stmt->bindParam(':estado', $estado);
        $stmt->bindParam(':site', $site);
        $stmt->bindParam(':tipo', $tipo);
        $stmt->execute();
        $sql = "SELECT LAST_INSERT_ID() as last_id";
        $stmt = ConnectionFactory::prepare($sql);
        $stmt->execute();
        $last_id = (array) $stmt->fetch();
        foreach ($last_id as $value) {
            //$_POST['id_instituicao'] = $value; //<<<<<<<<<<<<<<<<< ver com Alexandre
            return $value;
        }
    }

    /**
     * atualiza um registro da tabela
     *
     * @parametro InstituicaoMySql instituicao
     */
    public function update(Instituicao $Instituicao) {
        $sql = "UPDATE $this->table SET nome = :nome, sigla = :sigla, cidade = :cidade, estado = :estado, site = :site, tipo = :tipo WHERE id_instituicao = :id";
        $id = $Instituicao->getIdInstituicao();


        $nome = $Instituicao->getNome();
        $sigla = $Instituicao->getSigla();
        $cidade = $Instituicao->getCidade();
        $estado = $Instituicao->getEstado();
        $site = $Instituicao->getSite();
        $tipo = $Instituicao->getTipo();

        $stmt = ConnectionFactory::prepare($sql);
        $stmt->bindParam(':id', $id);


        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':sigla', $sigla);
        $stmt->bindParam(':cidade', $cidade);
        $stmt->bindParam(':estado', $estado);
        $stmt->bindParam(':site', $site);
        $stmt->bindParam(':tipo', $tipo);

        return $stmt->execute();
    }

    public function queryAllSelect() {
        $sql = "SELECT id_instituicao, nome FROM $this->table ORDER BY nome ";
        $stmt = ConnectionFactory::prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

}
